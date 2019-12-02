<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
date_default_timezone_set('America/Sao_Paulo');  

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
		$talk_simulador = $ln_verifc->TALK_SIMULADOR; 
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL;
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
} 

try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$icon = $ln->ICO_FAVICON_LINK;  
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 

	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
	}
	
$passo1 = 	$_POST["passo1"];
$passo2 = 	$_POST["passo2"];
$passo3 = 	$_POST["passo3"];
$dia = date('Y-m-d');


if ($passo1 == "" || $passo1 == "0" ) { 
	 
	 echo ("<script type='text/javascript'> alert('Antes de Finalizar as Dicas di\u00e1rias, veja primeiro a Dica 1 !!!'); location.href='iniciar_dicas.php';</script>");
	exit;
} 
if ($passo2 == "" || $passo2 == "0" ) { 
	 
	 echo ("<script type='text/javascript'> alert('Antes de Finalizar as Dicas di\u00e1rias, veja primeiro a Dica 2 !!!'); location.href='iniciar_dicas2.php';</script>");
	exit;
}
if ($passo3 == "" || $passo3 == "0" ) { 
	 
	 echo ("<script type='text/javascript'> alert('Antes de Finalizar as Dicas di\u00e1rias, veja primeiro a Dica 3 !!!'); location.href='iniciar_dicas3.php';</script>");
	exit;
}  
	
	
	// adm config anuncios
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$pontos_ganhos = $ln_config->PONTOS_GANHOS;
		$total_pontos_gravados = $ln_config->QTS_PONTOS_GRAVADOS_ATUAL;
		$total_pontos_a_ser_gerados = $ln_config->QTS_PONTOS_GERADOS;
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
	}	


				// buscando qts pontos ele tem esse mes, antes de gravar os novos pontos
				$mes_atual_antes = date("m");
				$ano_atual_antes = date("Y");	
				$sql_verifc_antes = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente'");
				$sql_verifc_antes->execute();
				$res_verifc_antes = $sql_verifc_antes->fetchAll(PDO::FETCH_OBJ); 
				$i_antes = 0;  
				
				foreach($res_verifc_antes as $ln_config_antes) { 
					$data_antes = $ln_config_antes->DATA;
					$arrayData_antes = explode("-",$data_antes); 
					if ($arrayData_antes[0] == $ano_atual_antes && $arrayData_antes[1] == $mes_atual_antes){
						$i_antes++;
					} 
				}
				
				
				
				
if ($total_pontos_gravados < $total_pontos_a_ser_gerados) {

	
	// verifica se ja foi registrado 
	$dia = date('Y-m-d');
	$ip = $_SERVER['REMOTE_ADDR'];
	$hora = date('H:i:s');
	
	$sql_his = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente' AND DATA = '$dia' AND IP != ''");
	$sql_his->execute();
	$res_his = $sql_his->fetchAll(PDO::FETCH_OBJ);
	$qts_21 = count( $res_his );
	 
	 if ($qts_21 <= 0) {
		// grava PONTOS
		
		$ponto_novo = $pontos_ganhos; 
		
		$sql_his = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_cliente'");
		$sql_his->execute();
		$res_his = $sql_his->fetchAll(PDO::FETCH_OBJ);
		$qts_20 = count( $res_his );
		 if ($qts_20 <= 0) {
			// inserindo novo cliente na pontuacao
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $id_cliente, ':PONTOS' => $ponto_novo, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
			
			
			
		 } else {
			// alterando pontuacao  
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_cliente'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_ganhos; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$id_cliente)); 
		 } 
		 // gravando ponto no historico 
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {
				foreach($res_alt as $ln_alt) {  
					$ultimo_dia = $ln_alt->DIA_ULTIMO_VISTO;
					if ($ultimo_dia < 30) {
						$novo_dia = $ultimo_dia+1;
					} else {
						$novo_dia = "1";
					}
				}
			}
			
			if ($pontos_ganhos > 1) {
				// grava + de 1 ponto no historico, caso a atividade seja mais que 1 ponto, roda o loop
				for( $q=1; $q <= $pontos_ganhos; $q++) { 
					$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
					$dados = array(':ID_CLIENTE' => $id_cliente, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
					$cadastra = $run->execute($dados);
				} 
				
			} else {
				// grava 1 ponto no historico
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $id_cliente, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			} 
			// soma novo ponto na pontuacao gravadas
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados+$pontos_ganhos;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
			
			// adm config 
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			
			
			
			// VERIFICA SE PROMOÇÃO ESTA LIBERADA
			$sql_verifc = $con->prepare("SELECT * FROM $tabela23 WHERE ID = '1'");
			$sql_verifc->execute();
			$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);  
			foreach($res_verifc as $ln_config) { 
				$qts_pontos1_promocao = $ln_config->PONTOS1;  
				$qts_pontos2_promocao = $ln_config->PONTOS2;
				$qts_pontos3_promocao = $ln_config->PONTOS3;
				$qts_pontos4_promocao = $ln_config->PONTOS4;
				$qts_pontos5_promocao = $ln_config->PONTOS5;
				$qts_pontos6_promocao = $ln_config->PONTOS6;
				$qts_pontos7_promocao = $ln_config->PONTOS7;
				$qts_pontos8_promocao = $ln_config->PONTOS8;
				$qts_pontos9_promocao = $ln_config->PONTOS9;
				$qts_pontos10_promocao = $ln_config->PONTOS10;
				
				$qts_adpacks1_promocao = $ln_config->QTS_ADPACKS1;
				$qts_adpacks2_promocao = $ln_config->QTS_ADPACKS2;
				$qts_adpacks3_promocao = $ln_config->QTS_ADPACKS3;
				$qts_adpacks4_promocao = $ln_config->QTS_ADPACKS4;
				$qts_adpacks5_promocao = $ln_config->QTS_ADPACKS5;
				$qts_adpacks6_promocao = $ln_config->QTS_ADPACKS6;
				$qts_adpacks7_promocao = $ln_config->QTS_ADPACKS7;
				$qts_adpacks8_promocao = $ln_config->QTS_ADPACKS8;
				$qts_adpacks9_promocao = $ln_config->QTS_ADPACKS9;
				$qts_adpacks10_promocao = $ln_config->QTS_ADPACKS10;
				 
				$status = "PENDENTE";
				
				$liberado_promocao = $ln_config->LIBERADO_PONTOS;
			} 
			if ($liberado_promocao == "SIM") {
				// VERIFICA SE GANHOU A PROMOCAO
				// buscando qts pontos esse mes 
				$mes_atual = date("m");
				$ano_atual = date("Y");	
				$sql_verifc = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente'");
				$sql_verifc->execute();
				$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
				$pontos_mes_atual = count( $res_verifc );
				$i = 0;  
				
				foreach($res_verifc as $ln_config) { 
					$data = $ln_config->DATA;
					$arrayData = explode("-",$data); 
					if ($arrayData[0] == $ano_atual && $arrayData[1] == $mes_atual){
						$i++;
					} 
				}
				if ($i_antes < $qts_pontos1_promocao && $i >= $qts_pontos1_promocao){
					 // registra 1 Adpack ganhado 
					$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
					$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks1_promocao, ':STATUS' => $status, ':DATA' => $dia);
					$cadastra = $run->execute($dados);
					 
				} else if ($i_antes < $qts_pontos2_promocao && $i >= $qts_pontos2_promocao){
					// registra 2 Adpack ganhado
					$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
					$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks2_promocao, ':STATUS' => $status, ':DATA' => $dia);
					$cadastra = $run->execute($dados);
					
				} else if ($i_antes < $qts_pontos3_promocao && $i >= $qts_pontos3_promocao){
						// registra 3 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks3_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos4_promocao && $i >= $qts_pontos4_promocao){
						// registra 4 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks4_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos5_promocao && $i >= $qts_pontos5_promocao){
						// registra 5 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks5_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos6_promocao && $i >= $qts_pontos6_promocao){
						// registra 6 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks6_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos7_promocao && $i >= $qts_pontos7_promocao){
						// registra 7 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks7_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos8_promocao && $i >= $qts_pontos8_promocao){
						// registra 8 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks8_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos9_promocao && $i >= $qts_pontos9_promocao){
						// registra 9 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks9_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
						
				} else if ($i_antes < $qts_pontos10_promocao && $i >= $qts_pontos10_promocao){
						// registra 10 Adpack ganhado
						$run = $con->prepare("INSERT INTO $tabela24 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
						$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks10_promocao, ':STATUS' => $status, ':DATA' => $dia);
						$cadastra = $run->execute($dados);
				}
				
				 		
	
			}
			 
	
			
			
			if ($total_pontos_gravados >= $total_pontos_a_ser_gerados) {
				// FINALIZA TEMPORADA
				$id_1 = "1";
				$liberado = "NAO";
				$altera = "UPDATE $tabela19 SET LIBERADO=? WHERE ID=?";
				$alt_q = $con->prepare($altera);
				$alt_q->execute(array($liberado,$id_1));
				
				// FINALIZA A  PROMOCAO
				$id_1 = "1";
				$liberado_pontos = "NAO"; 
				$altera = "UPDATE $tabela23 SET LIBERADO_PONTOS=? WHERE ID=?";
				$alt_q = $con->prepare($altera);
				$alt_q->execute(array($liberado_pontos,$id_1));
			}
			
		 
	 } else {
		// ja ganhou o ponto 
	 }
} else {
	// FINALIZA TEMPORADA
	$id_1 = "1";
	$liberado = "NAO";
	$altera = "UPDATE $tabela19 SET LIBERADO=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($liberado,$id_1));
	
	// FINALIZA A  PROMOCAO
				$id_1 = "1";
				$liberado_pontos = "NAO"; 
				$altera = "UPDATE $tabela23 SET LIBERADO_PONTOS=? WHERE ID=?";
				$alt_q = $con->prepare($altera);
				$alt_q->execute(array($liberado_pontos,$id_1));
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
        <link href="css/estilo.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		 
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]--> 
							
		 
    </head> 
    <body class="skin-blue" onload="start();">
        <?php  include("topo.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php  include("menue_dicas.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
						<li><a href="resumo_dicas.php"><i class="fa fa-dedent"></i> Resumo</a></li>
                        <li class="active">Dicas Di&aacute;rias Finalizadas</li>
                    </ol>
                </section>
 
                <!-- Main content -->
                <section class="content">
				<div style="border:1px solid #CCC; width:800px; height:120px; margin:0% 0% 0% 10%;">
				<?php 
					$sql_config = $con->prepare("SELECT * FROM $tabela18 WHERE ID = '1'");
					$sql_config->execute();
					$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
					foreach($res_config as $ln_config) {  
						$img_anuncio = $ln_config->ANUNCIO_URL;
						$link_anuncio = $ln_config->ANUNCIO_LINK;
						$data_vencimento = $ln_config->DATA_VENCIMENTO;
						$timestamp_dt_expira	= strtotime($data_vencimento); // converte para timestamp Unix						
						$dt_atual = date('Y-m-d');
						$timestamp_dt_atual 	= strtotime($dt_atual); // converte para timestamp Unix
						
						if ($img_anuncio != "") { 
							// data atual é maior que a data de expiração
							if ($timestamp_dt_atual > $timestamp_dt_expira) { // true ?>
							  <a href="#" title="Banner"><img  src="../img/banner-anuncie-aqui-comunidade-multinivel.jpg" width="800" height="120" alt="LOGO TALK FUSION"  /> </a>
							<?php } else { // false ?>
							  <a href="<?php echo $link_anuncio; ?>" title="Banner"><img  src="<?php echo $img_anuncio; ?>" width="800" height="120" alt="banner"  /> </a>
							<?php } 
						}  else { ?>
							<a href="#" title="Banner"><img  src="../img/banner-anuncie-aqui-comunidade-multinivel.jpg" width="800" height="120" alt="banner"  /> </a>
						<?php }
					}	
				?>
				</div>
				<br>
<div class="box box-primary">
<BR> 
<?php
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO; 
	}	
	if ($liberado == "NAO") {
?> 
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> Essa temporada foi finalizada, aguarde os administradores da ComunidadeMultiN&iacute;vel, retornar as atividades das, Dicas Di&aacute;rias, para continuar os seus trabalhos.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; financiar <?php echo $total_pacotes_pagos; ?> pacote(s) EXECUTIVO(s) para <?php echo $total_pacotes_pagos; ?> NOVO(s) afiliado(s) em nossa REDE PRINCIPAL.</b> Se voc&ecirc; n&atilde;o est&aacute; entre os premiados, aproveite a oportunidade e entre agora mesmo em nossa REDE PRINCIPAL, pois esses <?php echo $total_pacotes_pagos; ?> novo(s) afiliado(s) podem j&aacute; entrar abaixo de voc&ecirc;.<br>
		Ou <br>
		Aguarde o retorno das atividades das, "dicas di&aacute;rias" para continuar subindo no RANK, consequentemente chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores iram lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
	<br>
<?php } ?>		
	<div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>Parab&eacute;ns !!! </b> Voc&ecirc; acabou de ganhar  <b><?php echo $pontos_ganhos; ?></b> PONTO(s), mantenha-se di&aacute;riamente informado e sempre participando de nossas dicas di&aacute;rias.
    </div> 
	<div id="publicidade_dica">
	<i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i> <i>Publicidades</i> <i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i>
	<hr>
	<?php 
	// aq vai buscar do BD os anuncios que serao colocado pelo ADMIN em ordem de dias do mes.. serao 3 anuncios CPC por dia
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$ultimo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
				$sql_1 = $con->prepare("SELECT * FROM $tabela16 WHERE DIA = '$ultimo_dia'");
				$sql_1->execute();
				$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ);
				foreach($res_1 as $ln_1) {   
					$codigos_banners = html_entity_decode((string)$ln_1->ANUNCIO_CPC, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
				?>	
				<div style="position:relativo;float:left;margin:5px 5px 5px 5px;border:3px solid #666;">
					<?php echo $codigos_banners; ?>  
				</div>
				<?php
				}  
			}
	
	
	?> 
	<hr style="clear:both;">
	<i class="fa fa-arrow-up"> </i> <i class="fa fa-arrow-up"> </i> <i>Publicidades</i> <i class="fa fa-arrow-up"> </i> <i class="fa fa-arrow-up"> </i>
	<br><br>
	</div>
	<br style="clear:both;">
	
</div>	 
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
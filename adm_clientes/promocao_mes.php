<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS; 		
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
 
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO;
		$pontos_ganhos = $ln_config->PONTOS_GANHOS;		
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
		
		$pontos_ganhos_tms_clientes = $ln_config->TMS_PONTOS_CLIENTE;
		$pontos_ganhos_tms_nivel1 = $ln_config->TMS_PONTOS_NIVEL1;
		$pontos_ganhos_tms_nivel2 = $ln_config->TMS_PONTOS_NIVEL2;
		$pontos_ganhos_tms_nivel3 = $ln_config->TMS_PONTOS_NIVEL3;
		$pontos_ganhos_tms_nivel4 = $ln_config->TMS_PONTOS_NIVEL4;
		$pontos_ganhos_tms_nivel5 = $ln_config->TMS_PONTOS_NIVEL5;
		
	}	
	
	// adm config da promocao 
	$sql_config = $con->prepare("SELECT * FROM $tabela24 WHERE ID = '1'"); 
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln) {  
		$qts_pontos = $ln->PONTOS;  
		  
		$qts_adpacks_comprar1 = $ln->BONUS_COMPRA_ADPACKS1;
		$qts_adpacks_comprar2 = $ln->BONUS_COMPRA_ADPACKS2;
		$qts_adpacks_comprar3 = $ln->BONUS_COMPRA_ADPACKS3;
		$qts_adpacks_comprar4 = $ln->BONUS_COMPRA_ADPACKS4;
		$qts_adpacks_comprar5 = $ln->BONUS_COMPRA_ADPACKS5;
		$qts_adpacks_comprar6 = $ln->BONUS_COMPRA_ADPACKS6;
		$qts_adpacks_comprar7 = $ln->BONUS_COMPRA_ADPACKS7;
		$qts_adpacks_comprar8 = $ln->BONUS_COMPRA_ADPACKS8;
		$qts_adpacks_comprar9 = $ln->BONUS_COMPRA_ADPACKS9;
		$qts_adpacks_comprar10 = $ln->BONUS_COMPRA_ADPACKS10;
		
		$qts_adpacks_brinde1 = $ln->BONUS_BRINDE_ADPACKS1; 
		$qts_adpacks_brinde2 = $ln->BONUS_BRINDE_ADPACKS2;
		$qts_adpacks_brinde3 = $ln->BONUS_BRINDE_ADPACKS3;
		$qts_adpacks_brinde4 = $ln->BONUS_BRINDE_ADPACKS4;
		$qts_adpacks_brinde5 = $ln->BONUS_BRINDE_ADPACKS5;
		$qts_adpacks_brinde6 = $ln->BONUS_BRINDE_ADPACKS6;
		$qts_adpacks_brinde7 = $ln->BONUS_BRINDE_ADPACKS7;
		$qts_adpacks_brinde8 = $ln->BONUS_BRINDE_ADPACKS8;
		$qts_adpacks_brinde9 = $ln->BONUS_BRINDE_ADPACKS9;
		$qts_adpacks_brinde10 = $ln->BONUS_BRINDE_ADPACKS10;
		
		 
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
		
	}
	 
	
	// busca quantos pontos vc tem
	$sql_b = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_cliente'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$pontos_ganhos = $ln_b->PONTOS; 
		$data_dica = $ln_b->DATA;
		$data_dica = implode("/",array_reverse(explode("-",$data_dica)));
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
		
		
		
		
		 <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris charts -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
		
		
		
    </head>
    <body class="skin-blue">
        <?php  include("topo.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php  include("menue.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li class="active">Promo&ccedil;&otilde;es do M&ecirc;s</li>
                    </ol>
                </section>
 	
                <!-- Main content -->
                <section class="content">

				
<div style="text-align:center;width:100%;">				
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
</div> 	
 
<!-- centro -->	 
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Promo&ccedil;&otilde;es do M&ecirc;s</h3>
    </div><!-- /.box-header --> 
	<br>
<?php
	if ($liberado == "NAO") {
?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> Essa temporada foi Completada, aguarde os administradores da ComunidadeMultiN&iacute;vel, retornar as atividades das, Dicas Di&aacute;rias, para continuar os seus trabalhos.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; financiar <?php echo $total_pacotes_pagos; ?> pacote(s) EXECUTIVO(s) para <?php echo $total_pacotes_pagos; ?> NOVO(s) afiliado(s) em uma empresa de MMN totalmente legalizada.</b> Se voc&ecirc; n&atilde;o est&aacute; entre os premiados, aproveite a oportunidade e entre agora mesmo para nossa rede de afiliados em umas das empresas de MMN que estamos trabalhando, pois esses <?php echo $total_pacotes_pagos; ?> novo(s) afiliado(s) podem j&aacute; entrar abaixo de voc&ecirc;.<br>
		Ou <br>
		Aguarde o retorno das atividades das, "dicas di&aacute;rias" para continuar subindo no RANK, consequentemente chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores iram lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
<?php } ?>

<?php
	if ($liberado_pontos == "NAO") {
?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> A promo&ccedil;&atilde;o do m&ecirc;s "Troque seus Pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPack(s) da empresa de publicidade TrafficMonsoon" est&aacute; temporariamente DESATIVADA.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; analisar a propor&ccedil;&atilde;o do crescimento da equipe, para possivelmente a promo&ccedil;&atilde;o retornar o mais r&aacute;pido poss&iacute;vel.<br>
		 <br>
		Mantenha suas participa&ccedil;&otilde;es diariamente em todas as atividades di&aacute;rias que a ferramenta de trabalho "dicas di&aacute;rias" lhe proporciona, para voc&ecirc; continuar subindo no RANK de PREMIA&Ccedil;&Atilde;O e conseq&uuml;entemente, chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico com sua pergunta, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
<?php } else { ?>	
	
	<div class="box box-solid box-primary">  
		<div class="box-header"> 	 
				<h3 class="box-title">Troque seus Pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPack(s) da empresa de publicidade TrafficMonsoon</a></h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body">  
		<br>
			<div class="alert alert-info alert-dismissable">
					<i class="fa fa-info"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i>Lan&ccedil;amos uma &oacute;tima promo&ccedil;&atilde;o para voc&ecirc; aumentar seus rendimentos na empresa TrafficMonsoon !!!<i> <br>
					<b>Agora, voc&ecirc; pode acumular seus pontos do RANK de PREMIA&Ccedil;&Atilde;O e trocar por ADPack com posicionamento de lucro da empresa de publicidade TrafficMonsoon, sendo que cada ADPack que voc&ecirc; obter, aumentar&aacute; seus rendimentos em </b><b style="color:red;">+&#36;1,00 d&oacute;lar por dia</b> <b>na empresa TrafficMonsoon ? </b> 
					<br><br>
					O que &eacute;, e como funciona o ADPack com posicionamento de lucro da empresa TrafficMonsoon ?
					<a href="https://www.youtube.com/watch?v=OBHr-9AXddw" title="Como Funciona essa Promo&ccedil;&atilde;o do M&ecirc;s ?">Clique aqui e veja Como Funciona o ADPack</a>
			</div>
			<div class="row">
				<div class="col-lg-3 col-xs-6">
				<!-- small box -->
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3>  
								<?php echo $pontos_ganhos; ?>
							</h3>
							<p>
                                sua pontua&ccedil;&atilde;o atual
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-retweet"></i>
                        </div>  
                    </div>
                </div><!-- ./col -->
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner"> 
							<p>
                                Troque 
                            </p>
                            <h3>  
                                <?php  echo $qts_pontos;   ?> 
                            </h3>
                            <p>
                                pontos por cada ADPack
                            </p>
                        </div>
						<div class="icon">
							<i class="fa fa-retweet"></i>
						</div> 							
					</div>
				</div><!-- ./col --> 
				<div class="col-lg-5 col-xs-6"> 
                            - <a href="trafficmonsoon.php" title="O que &eacute; TrafficMonsoon">O que &eacute; TrafficMonsoon ? </a> <br>
							- <a href="https://www.youtube.com/watch?v=OBHr-9AXddw" title="O que &eacute; ADPacks da TrafficMonsoon" target="_blank">O que &eacute; ADPacks da TrafficMonsoon ? </a> <br>
							- <a href="promocao_trocapontos_regras.php" title="Entenda as regras dessa promo&ccedil;&atilde;o">Quais s&atilde;o as regras dessa promo&ccedil;&atilde;o ?</a> <br>
							- <a href="http://www.comunidademultinivel.com.br/forum/topico/20-Como-ganhar-muitos-pontos-no-RANK-de-PREMIACAO-da-ferramenta-de-trabalho-dicas-diarias" title="Veja como ganhar muitos pontos no RANK de PREMIA&Ccedil;&Atilde;O" target="_blank">Como ganhar dezenas e centenas de PONTOS no RANK de PREMIA&Ccedil;&Atilde;O todos os dias ? </a><br>
							<i> Ainda com d&uacute;vidas ?</i> <a href="http://www.comunidademultinivel.com.br/forum/trafficmonsoon_tutoriais.php" title="Crie seu t&oacute;pico com sua pergunta, que os moderadores da ComunidadeMultiN&iacute;vel ir&atilde;o lhe responder o mais r&aacute;pido poss&iacute;vel" target="_blank">Clique aqui</a> e fa&ccedil;a sua pergunta no F&Oacute;RUN da ComunidadeMultiN&iacute;vel.
				</div><!-- ./col --> 
						
			</div><!-- /.row -->
<?php
	// busca quantos ADPacks PENDENTES na promocao de TROCA
	$sql_b = $con->prepare("SELECT * FROM $tabela23 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'PENDENTE'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$total_adpacks_pendentes = 0;
	foreach($res_b as $ln_b) {  
		$total_adpacks_pendentes += $ln_b->QTS_ADPACKS;  
	}  
	
	if ($total_adpacks_pendentes >= 1) {
?>

			
			<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-warning"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b> No momento Voc&ecirc; tem </b><b style="color:red;font-size:20px;">(<?php echo $total_adpacks_pendentes; ?>)</b> <b>ADPacks PENDENTES para ser premiado, aguarde os moderadores da ComunidadeMultiN&iacute;vel entrar em contato com voc&ecirc;, para efetaur os procedimentos do pagamento do seu ADPack com posicionamento de lucro da empresa TrafficMonsoon. </b>
			</div>
<?php
	}

$qts_pontos2 = $qts_pontos*2;
$qts_pontos3 = $qts_pontos*3;

?>


<Script type = "text/javascript">

function SomenteNumero(e){
    var tecla=(window.event)?event.keyCode:e.which;   
    if((tecla>47 && tecla<58)) return true;
    else{
    	if (tecla==8 || tecla==0) return true;
	else  return false;
    }
}



function verifica() { 
	if (form.qts_adpacks_troca.value == "" || form.qts_adpacks_troca.value <= 0) { 
		alert("Digite uma quantidade de ADPack que deseja efetuar a troca de seus pontos");  
		return false;   
    }   
	
	var qts_adp_pontos = form.qts_adpacks_troca.value;
	var qts_pontos_troca = <?php echo $qts_pontos; ?>;
	var soma_pontos = qts_adp_pontos*qts_pontos_troca; 
	var qts_pontos_atual = <?php echo $pontos_ganhos; ?>; 
	
	if (qts_pontos_atual < soma_pontos) { 
		alert("Voc\u00ea n\u00e3o possui pontos suficientes para aderir "+ qts_adp_pontos + " ADPack(s). Cada ADPack custa "+ qts_pontos_troca +" Pontos. ("+qts_adp_pontos+ "x"+ qts_pontos_troca +" = "+soma_pontos+")"); 
		return false;   
    }   
}
</script>				 
			
			
			<div style="width:50%; float:left;">
				 <div class="callout callout-info"> 
					<h4>Troque aqui seus PONTOS por ADPack(s) da empresa TrafficMonsoon</h4>
					<div class="input-group input-group-sm" style="width:80%;"> 
						 Coloque aqui a quantidade de ADPack(s) que deseja
					</div><!-- /input-group --> 
					<div class="input-group input-group-sm" style="width:40%;"> 
						 <form id="form" name="form" method="post" action="promocao_troca_pontos.php">
							<input type="text" class="form-control" name="qts_adpacks_troca" placeholder="Digite um n&uacute;mero de ADPacks" onkeypress='return SomenteNumero(event)' />  
								<span class="input-group-btn" >
								<i class="fa fa-arrow-right"></i> <i class="fa fa-arrow-right"></i> <i class="fa fa-arrow-right"></i>	 
								<button class="btn btn-success btn-flat" type="submit"  Onclick="return verifica()">Trocar AGORA</button> 
								<i class="fa fa-arrow-left"></i> <i class="fa fa-arrow-left"></i> <i class="fa fa-arrow-left"></i>
								</span>
						</form>
					</div><!-- /input-group --> 
				</div>
			</div> 
		
			<div style="width:50%; float:right;">
				 <div class="callout callout-info">  
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Veja Aqui a tabela de pontua&ccedil;&otilde;es na troca por ADPack(s)</h3>
						</div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tr>
									<th style="width: 50%;text-align:center;">Quantidade de ADPack(s)</th>
                                    <th style="width: 50%;text-align:center;">Quantidade de PONTOS</th> 
                                </tr>
                                <tr style="text-align:center;">
                                    <td>1</td>
                                    <td><?php echo $qts_pontos; ?></td> 
                                </tr>
                                <tr style="text-align:center;">
                                    <td>2</td>
                                    <td><?php echo $qts_pontos2; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td>3</td>
                                    <td><?php echo $qts_pontos3; ?></td> 
                                </tr>
                            </table> 
                        </div><!-- /.box-body -->
						<i>..etc Voc&ecirc; poder&aacute; efetuar quantas trocas estiver a seu alcan&ccedil;e, sendo que cada ADPack custar&aacute; <b><?php echo $qts_pontos; ?> PONTOS</b> <i>do seu RANK de PREMIA&Ccedil;&Atilde;O</i>
                    </div><!-- /.box -->  
				</div>
			</div> 
			<div style="width:45%; float:left;">
				<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-warning"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>- </b>Ap&oacute;s solicitar a troca de seus pontos por ADPack da TrafficMonsoon, aguarde os moderadores da ComunidadeMultiN&iacute;vel entrarem em contato com voc&ecirc;, para efetuarem a compra do seu ADPack, Isso poder&aacute; demorar alguns dias. <br>
					<b>- </b>Uma vez que a troca tenha sido efetuada, n&atilde;o haver&aacute; mais retorno de sua pontua&ccedil;&atilde;o.
				</div>
			</div> 			
		<br>
		</div><!-- /.box-body -->
		
		<br style="clear:both;"> <br>
    </div><!-- /.box --> 
<?php }  
	if ($liberado_brindes == "NAO") {
?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> A promo&ccedil;&atilde;o do m&ecirc;s "Troque seus Pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPack(s) da empresa de publicidade TrafficMonsoon" est&aacute; temporariamente DESATIVADA.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; analisar a propor&ccedil;&atilde;o do crescimento da equipe, para possivelmente a promo&ccedil;&atilde;o retornar o mais r&aacute;pido poss&iacute;vel.<br>
		 <br>
		Mantenha suas participa&ccedil;&otilde;es diariamente em todas as atividades di&aacute;rias que a ferramenta de trabalho "dicas di&aacute;rias" lhe proporciona, para voc&ecirc; continuar subindo no RANK de PREMIA&Ccedil;&Atilde;O e conseq&uuml;entemente, chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico com sua pergunta, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
<?php } else { ?>	
	
	<div class="box box-solid box-primary">  
		<div class="box-header"> 	 
				<h3 class="box-title">Compre ADPacks na empresa TrafficMonsoon e ganhe at&eacute; +10 ADPacks de BRINDEs</a></h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body">  
		<br>
			<div class="alert alert-info alert-dismissable">
					<i class="fa fa-info"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<i>Lan&ccedil;amos uma &oacute;tima promo&ccedil;&atilde;o para voc&ecirc; aumentar seus rendimentos na empresa TrafficMonsoon !!!<i> <br>
					<b>Agora, Comprando ADPacks com posicionamento de lucro da empresa de publicidade TrafficMonsoon, Voc&ecirc; poder&aacute; aumentar seus rendimentos em at&eacute; <b style="color:red;">+&#36;<?php echo $qts_adpacks_brinde10; ?>,00 d&oacute;lares por dia</b> <b>na empresa TrafficMonsoon, pois a ComunidadeMultiN&iacute;vel ir&aacute; lhe financiar at&eacute; <?php echo $qts_adpacks_brinde10; ?> ADPacks de BRINDE. </b>
					<br><br>
					O que &eacute;, e como funciona o ADPack com posicionamento de lucro da empresa TrafficMonsoon ?
					<a href="https://www.youtube.com/watch?v=OBHr-9AXddw" title="Como Funciona essa Promo&ccedil;&atilde;o do M&ecirc;s ?">Clique aqui e veja Como Funciona o ADPack</a>
					
			</div>
			<div class="row"> 
                <div style="width:50%; float:left;">
				 <div class="callout callout-info">  
					<div class="box">
						<div class="box-header">
							<h3 class="box-title">Veja Nessa Tabela Quantos ADPacks voc&ecirc; precisa comprar para ganhar os ADPack(s) de BRINDE</h3>
						</div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped">
                                <tr>
									<th style="width: 50%;text-align:center;">Quantidade de ADPacks Comprado</th>
                                    <th style="width: 50%;text-align:center;">Quantidade de ADPack(s) de BRINDE </th> 
                                </tr>
                                <tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar1; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde1; ?></td> 
                                </tr>
                                <tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar2; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde2; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar3; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde3; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar4; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde4; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar5; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde5; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar6; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde6; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar7; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde7; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar8; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde8; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar9; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde9; ?></td> 
                                </tr>
								<tr style="text-align:center;">
                                    <td><?php echo $qts_adpacks_comprar10; ?></td>
                                    <td>+<?php echo $qts_adpacks_brinde10; ?></td> 
                                </tr>
                            </table> 
                        </div><!-- /.box-body -->
						<i></i>
                    </div><!-- /.box -->  
				</div>
			</div>  
				<div class="col-lg-5 col-xs-6"> 
                            - <a href="trafficmonsoon.php" title="O que &eacute; TrafficMonsoon">O que &eacute; TrafficMonsoon ? </a> <br>
							- <a href="https://www.youtube.com/watch?v=OBHr-9AXddw" title="O que &eacute; ADPacks da TrafficMonsoon" target="_blank">O que &eacute; ADPacks da TrafficMonsoon ? </a> <br>
							- <a href="promocao_brindes_regras.php" title="Entenda as regras dessa promo&ccedil;&atilde;o">Quais s&atilde;o as regras dessa promo&ccedil;&atilde;o ?</a> <br>
							- <a href="https://www.youtube.com/watch?v=OBHr-9AXddw" title="Veja como ganhar muitos pontos no RANK de PREMIA&Ccedil;&Atilde;O" target="_blank">Como Compro ADPacks com posicionamento de lucro da empresa TrafficMonsoon ? </a><br>
							<i> Ainda com d&uacute;vidas ?</i> <a href="http://www.comunidademultinivel.com.br/forum/trafficmonsoon_tutoriais.php" title="Crie seu t&oacute;pico com sua pergunta, que os moderadores da ComunidadeMultiN&iacute;vel ir&atilde;o lhe responder o mais r&aacute;pido poss&iacute;vel" target="_blank">Clique aqui</a> e fa&ccedil;a sua pergunta no F&Oacute;RUN da ComunidadeMultiN&iacute;vel.
							<hr>
					<div class="alert alert-warning alert-dismissable">
						<i class="fa fa-warning"></i>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<b>ATEN&Ccedil;&Atilde;O:</b> <br>
						<b>- </b>  Para Voc&ecirc; ganhar uns desses BRINDEs da tabela ao lado, voc&ecirc; ter&aacute; que efetuar a compra da quantidade de ADPacks tudo de uma vez. EXEMPLO: Se voc&ecirc; quer ganhar "+<?php echo $qts_adpacks_brinde10; ?> ADPacks de BRINDE" Voc&ecirc; ter&aacute; que efetuar a compra de <?php echo $qts_adpacks_comprar10; ?> ADPacks em sua conta no site da TrafficMonsoon TUDO DE UMA S&Oacute; VEZ. <br><br>
						<b style="font-size:20px; color:green;">-   Clique no Bot&atilde;o VERDE abaixo, somente se voc&ecirc; realmente j&aacute; efetuou a compra de seus ADPacks no site da TrafficMonsoon</b> <br>
						<b>- </b> Ap&oacute;s clicar no bot&atilde;o verde abaixo, os moderadores da ComunidadeMultiN&iacute;vel ir&atilde;o certificar se voc&ecirc; realmente efetuou a compra dos ADPacks da TrafficMonsoon de acordo com as <a href="promocao_brindes_regras.php" title="Entenda as regras dessa promo&ccedil;&atilde;o">regras exigidas</a>. 
					</div>
					
					
					
					
					<div class="callout callout-info"> 
						<h4 style="color:red;">Voc&ecirc; J&aacute; est&aacute; pronto para ganhar seu BRINDE ?</h4> 
						Eu Comprei  
						<div class="input-group input-group-sm" style="width:100%;"> 
							 <form id="form" name="form" method="post" action="promocao_brindes.php">
										<div class="form-group" style="float:left;width:30%;"> 
                                            <select class="form-control" name="qts_adpacks_comprados" >
                                                <option value="<?php echo $qts_adpacks_comprar1; ?>"><?php echo $qts_adpacks_comprar1; ?> ADPack</option>
                                                <option value="<?php echo $qts_adpacks_comprar2; ?>"><?php echo $qts_adpacks_comprar2; ?> ADPacks</option>
                                                <option value="<?php echo $qts_adpacks_comprar3; ?>"><?php echo $qts_adpacks_comprar3; ?> ADPacks</option>
                                                <option value="<?php echo $qts_adpacks_comprar4; ?>"><?php echo $qts_adpacks_comprar4; ?> ADPacks</option>
                                                <option value="<?php echo $qts_adpacks_comprar5; ?>"><?php echo $qts_adpacks_comprar5; ?> ADPacks</option>
												<option value="<?php echo $qts_adpacks_comprar6; ?>"><?php echo $qts_adpacks_comprar6; ?> ADPacks</option>
												<option value="<?php echo $qts_adpacks_comprar7; ?>"><?php echo $qts_adpacks_comprar7; ?> ADPacks</option>
												<option value="<?php echo $qts_adpacks_comprar8; ?>"><?php echo $qts_adpacks_comprar8; ?> ADPacks</option>
												<option value="<?php echo $qts_adpacks_comprar9; ?>"><?php echo $qts_adpacks_comprar9; ?> ADPacks</option>
												<option value="<?php echo $qts_adpacks_comprar10; ?>"><?php echo $qts_adpacks_comprar10; ?> ADPacks</option>
                                            </select>
                                        </div> 
									<button style="float:right; width:60%;" class="btn btn-success btn-lg" type="submit"  >Solicite seu BRINDE</button>	 
							</form>
						</div><!-- /input-group --> 
					</div>
				</div><!-- ./col --> 
						
			</div><!-- /.row -->
			<br>
<?php
	// busca quantos ADPacks PENDENTES na promocao de TROCA
	$sql_b = $con->prepare("SELECT * FROM $tabela25 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'PENDENTE'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$total_solicitacao_pendentes = count( $res_b );
	  
	
	if ($total_solicitacao_pendentes >= 1) {
?>

			
			<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-warning"></i>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<b> No momento Voc&ecirc; tem </b><b style="color:red;font-size:20px;">(<?php echo $total_solicitacao_pendentes; ?>)</b> <b>Solicita&ccedil;&atilde;o PENDENTES para ser premiado, aguarde os moderadores da ComunidadeMultiN&iacute;vel analisarem e entrarem em contato com voc&ecirc;, para efetaur os procedimentos do(s) pagamento(s) do(s) seu(s) ADPack(s) com posicionamento(s) de lucro da empresa TrafficMonsoon. </b>
			</div>
<?php }  ?>			
			
			 
		</div><!-- /.box-body -->
		
		<br style="clear:both;"> <br>
    </div><!-- /.box --> 

<?php }   ?>		  
	 <!-- Small boxes (Stat box) --> 
		 
</div><!-- /.box -->
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
       
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
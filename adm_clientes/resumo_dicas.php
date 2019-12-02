<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

date_default_timezone_set('America/Sao_Paulo');  
$time = time();
$hoje = date('Y-m-d');	 

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
                        <li class="active">RESUMO Dicas do Dia</li>
                    </ol>
                </section>
<?php	
// seu rank				
try {
	$sql2 = $con->prepare("SELECT * FROM $tabela20  ORDER BY PONTOS DESC, ID ASC");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	$i = 1;
	foreach($res2 as $ln2) {
		if ($ln2->ID_CLIENTE == $id) { 
			$seurank = $i;
		}
		$i++;
	} 
} catch(PODException $e2) {
	echo "Erro:/n".$e2->getMessage();
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
	
	
	// progresso porcentagens
	$sql_b = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$qts_pacotes_premiados = $ln_b->QTS_PACOTES_PAGOS;
		$adm_pontos_a_ser_gerado = $ln_b->QTS_PONTOS_GERADOS; 
		$adm_pontos_gravados = $ln_b->QTS_PONTOS_GRAVADOS_ATUAL; 
	}  
	$restam_pontos = $adm_pontos_a_ser_gerado-$adm_pontos_gravados;
	 
	
	 
	 
	// Função de porcentagem: N é X% de N
	function porcentagem_nx ( $parcial, $total ) {
		return ( $parcial * 100 ) / $total;
	}  
	
	$porcentagem = porcentagem_nx($adm_pontos_gravados, $adm_pontos_a_ser_gerado);  
	$porcentagem = floor($porcentagem*100)/100;
	$porcentagem = number_format( $porcentagem,  2,',','.'); 
	 
	$porcentagem2 = floor($porcentagem);  
	 
	// total de pessoas
	$sql_b = $con->prepare("SELECT * FROM $tabela20");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$qts_b = count( $res_b ); 
	 
?>			
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

<?php
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO; 
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
	}	
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


                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $pontos_ganhos; ?>
                                    </h3>
                                    <p>
                                        Sua Pontua&ccedil;&atilde;o no RANK
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-angle-double-up"></i>
                                </div> 
								<a href="rank_dicas.php" class="small-box-footer" title="Seu Posicionamento no RANK dicas do dia">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $seurank; ?>&deg;
                                    </h3>
                                    <p>
                                        Sua posi&ccedil;&atilde;o no RANK 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
								<a href="rank_dicas.php" class="small-box-footer" title="Seu Posicionamento no RANK dicas do dia">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>								
                            </div>
                        </div><!-- ./col --> 

						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3>
                                        <?php echo $qts_pacotes_premiados; ?>  
                                    </h3>
                                    <p>
                                        Posi&ccedil;&otilde;es PREMIADAS 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-trophy"></i>
                                </div> 
								<br>								
                            </div>
                        </div><!-- ./col -->  
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3>
                                        <?php echo $qts_b; ?> 
                                    </h3>
                                    <p>
                                        Total de Participantes 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div> 
								<br>								
                            </div>
                        </div><!-- ./col -->  
						
						<div class="col-lg-12 col-xs-6">
							<div class="callout callout-info" style="background:#c8d9e5;">
								<p style="float:left;font:18px ;"><b> Progresso em Equipe </b></p>
								<p style="float:right;font:18px ;"> <b> Restam Apenas <?php echo $restam_pontos; ?> pontos.</b>  </p>
								<br style="clear:both;">
								<div class="progress" style="text-align:center;"> 
									<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $porcentagem2; ?>" aria-valuemin="0" aria-valuemax="100"  style="width: <?php echo $porcentagem2."%"; ?>;"> 
									</div>  
								</div>
								<span style="float:right;"><div class="badge bg-green"><?php echo $porcentagem."%"; ?> </div><b> Completado </b>(<i><?php echo $adm_pontos_gravados; ?> / <?php echo $adm_pontos_a_ser_gerado; ?> </i>)</span> <br>
							</div>
						</div><!-- ./col --> 
						
						
						<BR style="clear:both;">

<div class="col-md-10"> 
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
					</ol>
					<div class="carousel-inner" >
						<div class="item active">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-1.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
							 
						</div>
						<div class="item">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-2.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
						</div>
						<div class="item">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-3.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
						</div>
						<div class="item">
							<a href="promocao_mes.php" title="Troque seus pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPacks da empresa TrafficMonsoon" ><img src="img/Como-Funciona-os-financiado-adpack-da-empresa-trafficmonsoon-equipe-financia-adpack.jpg"    alt="Seja Financiado para aderir ADPacks da empresa trafficmonsoon"></a>
						</div> 
					</div>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div> 
<!-- BANNER --> 		
<BR style="clear:both;">
<BR style="clear:both;">
						
                    </div><!-- /.row -->
					<br>
<?php 

// ultimos 30 dias 
$dia2 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 1 ,date("Y", $time)));	
$dia3 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 2 ,date("Y", $time)));
$dia4 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 3 ,date("Y", $time)));
$dia5 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 4 ,date("Y", $time)));
$dia6 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 5 ,date("Y", $time)));
$dia7 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 6 ,date("Y", $time)));
$dia8 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 7 ,date("Y", $time)));
$dia9 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 8 ,date("Y", $time)));
$dia10 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 9 ,date("Y", $time)));
$dia11 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 10 ,date("Y", $time)));
$dia12 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 11 ,date("Y", $time)));
$dia13 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 12 ,date("Y", $time)));
$dia14 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 13 ,date("Y", $time)));
$dia15 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 14 ,date("Y", $time)));
$dia16 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 15 ,date("Y", $time)));
$dia17 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 16 ,date("Y", $time)));
$dia18 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 17 ,date("Y", $time)));
$dia19 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 18 ,date("Y", $time)));
$dia20 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 19 ,date("Y", $time)));
$dia21 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 20 ,date("Y", $time)));
$dia22 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 21 ,date("Y", $time)));
$dia23 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 22 ,date("Y", $time)));
$dia24 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 23 ,date("Y", $time)));
$dia25 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 24 ,date("Y", $time)));
$dia26 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 25 ,date("Y", $time)));
$dia27 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 26 ,date("Y", $time)));
$dia28 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 27 ,date("Y", $time)));
$dia29 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 28 ,date("Y", $time)));
$dia30 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 29 ,date("Y", $time)));

// Peultimos 30 dias
$dia31 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 30 ,date("Y", $time)));  
$dia32 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 31 ,date("Y", $time))); 
$dia33 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 32 ,date("Y", $time))); 
$dia34 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 33 ,date("Y", $time))); 
$dia35 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 34 ,date("Y", $time))); 
$dia36 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 35 ,date("Y", $time))); 
$dia37 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 36 ,date("Y", $time))); 
$dia38 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 37 ,date("Y", $time))); 
$dia39 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 38 ,date("Y", $time))); 
$dia40 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 39 ,date("Y", $time))); 
$dia41 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 40 ,date("Y", $time))); 
$dia42 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 41 ,date("Y", $time))); 
$dia43 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 42 ,date("Y", $time))); 
$dia44 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 43 ,date("Y", $time))); 
$dia45 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 44 ,date("Y", $time))); 
$dia46 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 45 ,date("Y", $time))); 
$dia47 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 46 ,date("Y", $time))); 
$dia48 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 47 ,date("Y", $time))); 
$dia49 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 48 ,date("Y", $time))); 
$dia50 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 49 ,date("Y", $time))); 
$dia51 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 50 ,date("Y", $time))); 
$dia52 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 51 ,date("Y", $time))); 
$dia53 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 52 ,date("Y", $time))); 
$dia54 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 53 ,date("Y", $time))); 
$dia55 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 54 ,date("Y", $time))); 
$dia56 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 55 ,date("Y", $time))); 
$dia57 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 56 ,date("Y", $time))); 
$dia58 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 57 ,date("Y", $time))); 
$dia59 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 58 ,date("Y", $time))); 
$dia60 = date("Y-m-d", mktime(0,0,0,date("n", $time),date("j",$time)- 59 ,date("Y", $time))); 

// participantes hoje
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$hoje'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_hoje = count( $res );

// participantes dia 2
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia2'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia2 = count( $res );

// participantes dia 3
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia3'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia3 = count( $res );

// participantes dia 4
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia4'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia4 = count( $res );

// participantes dia 5
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia5'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia5 = count( $res );

// participantes dia 6
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia6'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia6 = count( $res );

// participantes dia 7
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia7'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia7 = count( $res );

// participantes dia 8
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia8'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia8 = count( $res );

// participantes dia 9
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia9'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia9 = count( $res );

// participantes dia 10
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia10'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia10 = count( $res );

// participantes dia 11
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia11'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia11 = count( $res );

// participantes dia 12
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia12'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia12 = count( $res );

// participantes dia 13
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia13'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia13 = count( $res );

// participantes dia 14
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia14'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia14 = count( $res );

// participantes dia 15
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia15'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia15 = count( $res );

// participantes dia 16
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia16'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia16 = count( $res );

// participantes dia 17
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia17'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia17 = count( $res );

// participantes dia 18
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia18'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia18 = count( $res );

// participantes dia 19
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia19'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia19 = count( $res );

// participantes dia 20
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia20'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia20 = count( $res );

// participantes dia 21
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia21'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia21 = count( $res );

// participantes dia 22
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia22'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia22 = count( $res );

// participantes dia 23
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia23'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia23 = count( $res );

// participantes dia 24
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia24'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia24 = count( $res );

// participantes dia 25
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia25'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia25 = count( $res );

// participantes dia 26
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia26'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia26 = count( $res );

// participantes dia 27
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia27'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia27 = count( $res );

// participantes dia 28
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia28'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia28 = count( $res );

// participantes dia 29
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia29'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia29 = count( $res );

// participantes dia 30
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia30'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia30 = count( $res );

// participantes dia 31
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia31'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia31 = count( $res );

// participantes dia 32
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia32'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia32 = count( $res );

// participantes dia 33
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia33'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia33 = count( $res );

// participantes dia 34
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia34'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia34 = count( $res );

// participantes dia 35
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia35'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia35 = count( $res );

// participantes dia 36
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia36'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia36 = count( $res );

// participantes dia 37
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia37'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia37 = count( $res );

// participantes dia 38
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia38'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia38 = count( $res );

// participantes dia 39
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia39'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia39 = count( $res );

// participantes dia 40
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia40'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia40 = count( $res );

// participantes dia 41
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia41'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia41 = count( $res );

// participantes dia 42
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia42'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia42 = count( $res );

// participantes dia 43
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia43'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia43 = count( $res );

// participantes dia 44
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia44'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia44 = count( $res );

// participantes dia 45
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia45'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia45 = count( $res );

// participantes dia 46
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia46'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia46 = count( $res );

// participantes dia 47
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia47'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia47 = count( $res );

// participantes dia 48
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia48'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia48 = count( $res );

// participantes dia 49
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia49'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia49 = count( $res );

// participantes dia 50
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia50'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia50 = count( $res );

// participantes dia 51
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia51'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia51 = count( $res );

// participantes dia 52
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia52'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia52 = count( $res );

// participantes dia 53
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia53'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia53 = count( $res );

// participantes dia 54
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia54'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia54 = count( $res );

// participantes dia 55
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia55'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia55 = count( $res );

// participantes dia 56
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia56'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia56 = count( $res );

// participantes dia 57
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia57'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia57 = count( $res );

// participantes dia 58
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia58'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia58 = count( $res );

// participantes dia 59
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia59'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia59 = count( $res );

// participantes dia 60
$sql = $con->prepare("SELECT * FROM $tabela21 WHERE DATA = '$dia60'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$qts_dia60 = count( $res );

// recorde 
$recorde = max($qts_dia2, $qts_dia3, $qts_dia4, $qts_dia5,
				$qts_dia6, $qts_dia7, $qts_dia8, $qts_dia9, $qts_dia10,
				$qts_dia11, $qts_dia12, $qts_dia13, $qts_dia14, $qts_dia15,
				$qts_dia16, $qts_dia17, $qts_dia18, $qts_dia19, $qts_dia20,
				$qts_dia21, $qts_dia22, $qts_dia23, $qts_dia24, $qts_dia25,
				$qts_dia26, $qts_dia27, $qts_dia28, $qts_dia29, $qts_dia30,
				$qts_dia31, $qts_dia32, $qts_dia33, $qts_dia34, $qts_dia35,
				$qts_dia36, $qts_dia37, $qts_dia38, $qts_dia39, $qts_dia40,
				$qts_dia41, $qts_dia42, $qts_dia43, $qts_dia44, $qts_dia45,
				$qts_dia46, $qts_dia47, $qts_dia48, $qts_dia49, $qts_dia50,
				$qts_dia51, $qts_dia52, $qts_dia53, $qts_dia54, $qts_dia55,
				$qts_dia56, $qts_dia57, $qts_dia58, $qts_dia59, $qts_dia60
);
$recorde = $recorde+1;
$recorde_restam = $recorde-$qts_hoje;
?>	
<!-- centro -->	 

<i>Hor&aacute;rio de Brasil, S&atilde;o Paulo: <?php echo date('H:i:s'); ?></i> 
<div class="box box-primary">
	 
	<div class="box-header" style="text-align:center;">
	 
	<?php 
		$vazio = "";
		$sql_b = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_cliente' && DATA = '$hoje' && IP != '$vazio'");
		$sql_b->execute();
		$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ); 
		$verifica_partic_dica = count( $res_b );   
		if ($verifica_partic_dica >= 1) { ?>
			<h3 class="badge bg-green" style="font-size:18px;border:1px solid #000;">Sua participa&ccedil;&atilde;o nas 'Dicas Di&aacute;rias' j&aacute; foi efetuada hoje, mantenha sua participa&ccedil;&atilde;o diariamente! </h3>
		<?php } else { ?>
			<h3 class="badge bg-red" style="font-size:18px;border:1px solid #000;">Vo&ccedil;e ainda n&atilde;o efetuou suas atividades nas 'Dicas Di&aacute;rias', visualize as Dicas agora mesmo, mantenha sua participa&ccedil&atilde;o diariamente!</h3>
		<?php }
	?>
		
		

		
    </div><!-- /.box-header --> 
	<br>
	<?php if ($qts_hoje >= $recorde) { ?>
	<div class="col-md-6 box-solid bg-green"   >
		<div class="box box-solid box-success">
			<div class="box-header">
				<h5 class="box-title">Parab&eacute;ns Equipe, Meta Conquistada! </h5>
				<div class="box-tools pull-right"> 
					<button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div  style="color:#000;margin:5px 5px 5px 5px;"> 
				<h4>Hoje Conquistamos o novo recorde de <b><?php echo $qts_hoje; ?> participa&ccedil;&otilde;es</b>.</h4>
				<div class="badge bg-green" style="font-size:18px;">Juntos Somos Mais Fortes.</div> 
				<br><br>
			</div><!-- /.box-body -->
		</div>
	</div>
	<?php } else { ?>
	<div class="col-md-6  box-solid bg-red"   >
		<div class="box box-solid box-danger">
			<div class="box-header">
				<h3 class="box-title"><b>Meta do Dia: </b> Ajude-nos a bater essa simples meta </h3>
				<div class="box-tools pull-right"> 
					<button class="btn btn-danger btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div style="color:#000;margin:5px 5px 5px 5px;"> 
				<h4>Hoje temos <b><?php echo $qts_hoje; ?></b> participa&ccedil;&otilde;es.</h4>
				<h4>Junte-se a nossa luta, e ajude-nos a bater um novo recorde, <b>de <?php echo $recorde; ?> participa&ccedil;&otilde;es</b>. Convide seus amigos agora mesmo!</h4>
				<div class="badge bg-yellow" style="font-size:18px;">Restam <b><?php echo $recorde_restam; ?> participa&ccedil;&otilde;es</b> </div> 
				<br><br>
			</div><!-- /.box-body -->
		</div>
	</div>
	<?php } ?>
<?php 
 // somar cadstrados na TrafficMonsoon ... 100, 200, 300, 400, 500, 1000. 2000..etc
	$sql_b = $con->prepare("SELECT * FROM $tabela22 WHERE STATUS = 'ATIVO'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$qts_ativo = count( $res_b );
	
	if ($qts_ativo < 100) {
		$quantidade = 100;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 100 && $qts_ativo < 200) {
		$quantidade = 200;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 200 && $qts_ativo < 300) {
		$quantidade = 300;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 300 && $qts_ativo < 400) {
		$quantidade = 400;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 400 && $qts_ativo < 500) {
		$quantidade = 500;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 500 && $qts_ativo < 1000) {
		$quantidade = 1000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 1000 && $qts_ativo < 1500) {
		$quantidade = 1500;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 1500 && $qts_ativo < 2000) {
		$quantidade = 2000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 2000 && $qts_ativo < 2500) {
		$quantidade = 2500;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 2500 && $qts_ativo < 3000) {
		$quantidade = 3000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 3000 && $qts_ativo < 3500) {
		$quantidade = 3500;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 3500 && $qts_ativo < 4000) {
		$quantidade = 4000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 4000 && $qts_ativo < 4500) {
		$quantidade = 4500;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 4500 && $qts_ativo < 5000) {
		$quantidade = 5000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 5000 && $qts_ativo < 6000) {
		$quantidade = 6000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 6000 && $qts_ativo < 7000) {
		$quantidade = 7000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 7000 && $qts_ativo < 8000) {
		$quantidade = 8000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 8000 && $qts_ativo < 9000) {
		$quantidade = 9000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 9000 && $qts_ativo < 10000) {
		$quantidade = 10000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 10000 && $qts_ativo < 15000) {
		$quantidade = 15000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 15000 && $qts_ativo < 20000) {
		$quantidade = 20000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 20000 && $qts_ativo < 25000) {
		$quantidade = 25000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 25000 && $qts_ativo < 30000) {
		$quantidade = 30000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 30000 && $qts_ativo < 35000) {
		$quantidade = 35000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 35000 && $qts_ativo < 40000) {
		$quantidade = 40000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 40000 && $qts_ativo < 45000) {
		$quantidade = 45000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 45000 && $qts_ativo < 50000) {
		$quantidade = 50000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 50000 && $qts_ativo < 60000) {
		$quantidade = 60000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 60000 && $qts_ativo < 70000) {
		$quantidade = 70000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 70000 && $qts_ativo < 80000) {
		$quantidade = 80000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 80000 && $qts_ativo < 90000) {
		$quantidade = 90000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 90000 && $qts_ativo < 100000) {
		$quantidade = 100000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 100000 && $qts_ativo < 200000) {
		$quantidade = 200000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 200000 && $qts_ativo < 300000) {
		$quantidade = 300000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 300000 && $qts_ativo < 400000) {
		$quantidade = 400000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 400000 && $qts_ativo < 500000) {
		$quantidade = 500000;
		$qts_restam = $quantidade-$qts_ativo;
	} else if ($qts_ativo > 500000 && $qts_ativo < 1000000) {
		$quantidade = 1000000;
		$qts_restam = $quantidade-$qts_ativo;
	}
	// 1 milhao de cadastro na trafficmonsoon
	
	// qts cadstro esse cliente tem
	$sql_b = $con->prepare("SELECT * FROM $tabela22 WHERE STATUS = 'ATIVO'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ); 
	$i = 0;
	foreach($res_b as $ln_b) {  
		$indcs_id = $ln_b->ID_CLIENTE;  
		$sql_b = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$indcs_id'");
		$sql_b->execute();
		$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_b as $ln_b) {
			$id_de_indcs = $ln_b->ID_INDICACAO;  
			if ($id_cliente == $id_de_indcs) {
				$i++; 
			}   
		}  
	} 
?>	
	
	
	<div style="margin:0px 0px 0px 10px;" class="col-md-5 box-solid bg-blue"   >
		<div class="box box-solid box-primary">
			<div class="box-header">
				<h5 class="box-title">Cadastrados na TrafficMonsoon ! </h5>
				<div class="box-tools pull-right"> 
					<button class="btn btn-primary btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
				</div>
			</div>
			<div  style="color:#000;margin:5px 5px 5px 5px;"> 
				<h4>Restam apenas <b><?php echo $qts_restam; ?></b> participantes, para alcan&ccedil;armos <b><?php echo $quantidade; ?></b> participantes na TrafficMonsoon.</h4>
				<div class="badge bg-aqua" style="font-size:18px;">Voc&ecirc; indicou <?php echo $i; ?> pessoas na TrafficMonsoon.</div> 
				<br><br>
			</div><!-- /.box-body -->
		</div>
	</div>
	
	
	
	
	
	<br style="clear:both;">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<style type="text/css">
${demo.css}
	</style>
	<script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'areaspline'
        },
        title: {
            text: 'Grafico Di\u00e1rios de Participa\u00e7\u00f5es'
        },
        legend: {
            layout: 'vertical',
            align: 'left',
            verticalAlign: 'top',
            x: 150,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
        },
        xAxis: {
            categories: [
                '30',
                '29',
                '28',
                '27',
                '26',
                '25',
				'24',
				'23',
				'22',
				'21',
				'20',
				'19',
				'18', 
				'17',
				'16',
				'15',
				'14',
				'13',
				'12',
				'11',
				'10',
				'9',
				'8',
				'7',
				'6',
				'5',
				'4',
				'3',
				'2',
                'hoje'
            ],
            plotBands: [{ // visualize the weekend
                from: 4,
                to: 6,
                color: 'rgba(68, 170, 213, .2)'
            }]
        },
        yAxis: {
            title: {
                text: ' Participa\u00e7\u00f5es'
            }
        },
        tooltip: {
            shared: true,
            valueSuffix: ' Participa\u00e7\u00f5es'
        },
        credits: {
            enabled: false
        },
        plotOptions: {
            areaspline: {
                fillOpacity: 0.5
            }
        },
        series: [{
			name: '\u00daltimos 30 dias',
            data: [<?php echo $qts_dia30; ?>, <?php echo $qts_dia29; ?>, <?php echo $qts_dia28; ?>, <?php echo $qts_dia27; ?>, <?php echo $qts_dia26; ?>, 
						<?php echo $qts_dia25; ?>, <?php echo $qts_dia24; ?>, <?php echo $qts_dia23; ?>, <?php echo $qts_dia22; ?>, <?php echo $qts_dia21; ?>, 
						<?php echo $qts_dia20; ?>, <?php echo $qts_dia19; ?>, <?php echo $qts_dia18; ?>, <?php echo $qts_dia17; ?>, <?php echo $qts_dia16; ?>, 
						<?php echo $qts_dia15; ?>, <?php echo $qts_dia14; ?>, <?php echo $qts_dia13; ?>, <?php echo $qts_dia12; ?>, <?php echo $qts_dia11; ?>, 
						<?php echo $qts_dia10; ?>, <?php echo $qts_dia9; ?>, <?php echo $qts_dia8; ?>, <?php echo $qts_dia7; ?>, <?php echo $qts_dia6; ?>, 
						<?php echo $qts_dia5; ?>, <?php echo $qts_dia4; ?>, <?php echo $qts_dia3; ?>, <?php echo $qts_dia2; ?>, <?php echo $qts_hoje; ?>]
            
        }, {
			name: 'Pen\u00faltimos 30 dias',
            data: [<?php echo $qts_dia60; ?>, <?php echo $qts_dia59; ?>, <?php echo $qts_dia58; ?>, <?php echo $qts_dia57; ?>, <?php echo $qts_dia56; ?>, 
						<?php echo $qts_dia55; ?>, <?php echo $qts_dia54; ?>, <?php echo $qts_dia53; ?>, <?php echo $qts_dia52; ?>, <?php echo $qts_dia51; ?>, 
						<?php echo $qts_dia50; ?>, <?php echo $qts_dia49; ?>, <?php echo $qts_dia48; ?>, <?php echo $qts_dia47; ?>, <?php echo $qts_dia46; ?>, 
						<?php echo $qts_dia45; ?>, <?php echo $qts_dia44; ?>, <?php echo $qts_dia43; ?>, <?php echo $qts_dia42; ?>, <?php echo $qts_dia41; ?>, 
						<?php echo $qts_dia40; ?>, <?php echo $qts_dia39; ?>, <?php echo $qts_dia38; ?>, <?php echo $qts_dia37; ?>, <?php echo $qts_dia36; ?>, 
						<?php echo $qts_dia35; ?>, <?php echo $qts_dia34; ?>, <?php echo $qts_dia33; ?>, <?php echo $qts_dia32; ?>, <?php echo $qts_dia31; ?>]
			
        }]
    });
});
		</script>
		
	<script src="js/highcharts.js"></script>

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>	
		
	<br><br> 
	<section class="box" style="text-align:center;">
	  <div class="box-header">
		<h3 class="badge bg-green" style="font-size:20px;border:1px solid #000;">Trabalhando em equipe, iremos conseguir bater nossas metas, ajude-nos a manter nosso gr&aacute;fico em crescimento!</h3>
      </div><!-- /.box-header -->
	</section>
	<br> 
	
	
	
		<br style="clear:both;">
		<div class="alert alert-info alert-dismissable">
			<i class="fa fa-info"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p>A Comunidade MultiN&iacute;vel ir&aacute; disponibilizar <B><?php echo $qts_pacotes_premiados; ?></B> pacote(s) EXECUTIVO(s) para os <B><?php echo $qts_pacotes_premiados; ?>&deg;</B> primeiro(s) colocado(s) do RANK de Premiados, Ap&oacute;s o t&eacute;rmino do progresso em equipe. <br> 
			<i>(lembrando que a quantidade de pacote(s) a ser financiados pela ComunidadeMultiN&iacute;vel, podem ser alterados a qualquer momento, dependendo do crescimento e do rendimento que alcan&ccedil;armos</i>. </p>
			<br>
			<b>Alguma D&uacute;vida ?</b> Acesse a p&aacute;gina explicativa de <a href="como_funciona_dicas.php" title="Entenda Como funciona esse recurso"><b>Como Funciona Aqui</b></a>, ou <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank"><b>Clique aqui em nosso F&Oacute;RUM </b></a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
        </div> 
	<section class="content">
                     
    </section><!-- /.content --> 
</div><!-- /.box -->
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

       
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
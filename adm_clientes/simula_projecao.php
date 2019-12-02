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

	$sql_verifc = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$dolar_hj = $ln_verifc->DOLARHOJE;  
	}	 

	$projecao_esquerda = $_POST['projecao_esquerda'];
    $projecao_direita = $_POST['projecao_direita'];
 
	 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
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
						<li> <a href="projesao_de_ganhos.php"><i class="fa fa-table"></i>Proje&ccedil;&atilde;o de Ganhos</a></li>
                        <li class="active"><b>SIMULANDO RENDAS</b></li>
                    </ol>
                </section>
<?php
 // comissao direta  
	$comissao_direta_executivo = 20;
	$comissao_direta_elite = 60;
	$comissao_direta_propak = 120;
// criador de bronze
$criador_bronze_esquerda = 0;
$criador_bronze_direita = 0;

if ($projecao_esquerda >= 3) {
	$criador_bronze_esquerda = 20;
}
if ($projecao_direita >= 3) {
	$criador_bronze_direita = 20;
}
// -----------------------------------------------------------------------------------
//BINARIO
if ($projecao_direita > $projecao_esquerda) {
	$total_menor = $projecao_esquerda;
} else if ($projecao_direita < $projecao_esquerda) {
	$total_menor = $projecao_direita;
} if ($projecao_direita == $projecao_esquerda) {
	$total_menor = $projecao_direita;
}
 // soma pontos 
$total_pontos_executivo = floor($total_menor*120);
$total_pontos_elite = floor($total_menor*320);
$total_pontos_propak = floor($total_menor*620); 
 
// Total de Ciclos 
$total_ciclos_executivo = floor($total_pontos_executivo/100);
$total_ciclos_elite = floor($total_pontos_elite/100);
$total_ciclos_propak = floor($total_pontos_propak/100);

// Total em valores 
$total_binario_executivo = floor($total_ciclos_executivo*25);
$total_binario_elite = floor($total_ciclos_elite*25);
$total_binario_propak = floor($total_ciclos_propak*25);
 
// -----------------------------------------------------------------------------------
// bonus Mega Combinassoes 10%
$total_binario_mega_direita_executivo = 0;
$total_binario_mega_direita_elite = 0;
$total_binario_mega_direita_propak = 0;

if ($projecao_direita >= 3) {
	$pacotes_direita_mega = floor($projecao_direita/2);
	
	$total_pontos_direita_mega_executivo = floor($pacotes_direita_mega*120);
	$total_pontos_direita_mega_elite = floor($pacotes_direita_mega*320);
	$total_pontos_direita_mega_propak = floor($pacotes_direita_mega*620);
	
	$total_ciclos_direita_mega_executivo = floor($total_pontos_direita_mega_executivo/100);
	$total_ciclos_direita_mega_elite = floor($total_pontos_direita_mega_elite/100);
	$total_ciclos_direita_mega_propak = floor($total_pontos_direita_mega_propak/100);
	  
	$total_binario_mega_direita_executivo = floor($total_ciclos_direita_mega_executivo*25*10/100);
	$total_binario_mega_direita_elite = floor($total_ciclos_direita_mega_elite*25*10/100);
	$total_binario_mega_direita_propak = floor($total_ciclos_direita_mega_propak*25*10/100);
	
} 

$total_binario_mega_esquerda_executivo = 0;
$total_binario_mega_esquerda_elite = 0;
$total_binario_mega_esquerda_propak = 0;

if ($projecao_esquerda >= 3) {
	$pacotes_esquerda_mega = floor($projecao_esquerda/2);
	
	$total_pontos_esquerda_mega_executivo = floor($pacotes_esquerda_mega*120);
	$total_pontos_esquerda_mega_elite = floor($pacotes_esquerda_mega*320);
	$total_pontos_esquerda_mega_propak = floor($pacotes_esquerda_mega*620);
	
	$total_ciclos_esquerda_mega_executivo = floor($total_pontos_esquerda_mega_executivo/100);
	$total_ciclos_esquerda_mega_elite = floor($total_pontos_esquerda_mega_elite/100);
	$total_ciclos_esquerda_mega_propak = floor($total_pontos_esquerda_mega_propak/100);
	  
	$total_binario_mega_esquerda_executivo = floor($total_ciclos_esquerda_mega_executivo*25*10/100);
	$total_binario_mega_esquerda_elite = floor($total_ciclos_esquerda_mega_elite*25*10/100);
	$total_binario_mega_esquerda_propak = floor($total_ciclos_esquerda_mega_propak*25*10/100); 
}   
// -----------------------------------------------------------------------------------
// bonus de avanco
 
if ($total_ciclos_executivo >= 100){ $bonus_avanco_executivo = 1000;}
if ($total_ciclos_executivo >= 150){ $bonus_avanco_executivo = 3000;}
if ($total_ciclos_executivo >= 200){ $bonus_avanco_executivo = 6000;}
if ($total_ciclos_executivo >= 250){ $bonus_avanco_executivo = 11000;}

if ($total_ciclos_elite >= 100){ $bonus_avanco_elite = 1000;}
if ($total_ciclos_elite >= 150){ $bonus_avanco_elite = 3000;}
if ($total_ciclos_elite >= 200){ $bonus_avanco_elite = 6000;}
if ($total_ciclos_elite >= 250){ $bonus_avanco_elite = 11000;}

if ($total_ciclos_propak >= 100){ $bonus_avanco_propak = 1000;}
if ($total_ciclos_propak >= 150){ $bonus_avanco_propak = 3000;}
if ($total_ciclos_propak >= 200){ $bonus_avanco_propak = 6000;}
if ($total_ciclos_propak >= 250){ $bonus_avanco_propak = 11000;}

// -----------------------------------------------------------------------------------
// bonus de mercedes 
if ($total_ciclos_executivo >= 100){ $bonus_mercedes_executivo = 300;}
if ($total_ciclos_elite >= 100){ $bonus_mercedes_elite = 300;}
if ($total_ciclos_propak >= 100){ $bonus_mercedes_propak = 300;}
 
if ($total_ciclos_executivo >= 200){ $bonus_mercedes_executivoe = 600;}
if ($total_ciclos_elite >= 200){ $bonus_mercedes_elite = 600;}
if ($total_ciclos_propak >= 200){ $bonus_mercedes_propak = 600;}

// -----------------------------------------------------------------------------------
// bonus de fundo de lideranca 
if ($total_ciclos_executivo >= 500){ $bonus_lider_executivo = "1%";}
if ($total_ciclos_elite >= 500){ $bonus_lider_elite = "1%";}
if ($total_ciclos_propak >= 500){ $bonus_lider_propak = "1%";}
 
if ($total_ciclos_executivo >= 1000){ $bonus_lider_executivo = "1,25%";}
if ($total_ciclos_elite >= 1000){ $bonus_lider_elite = "1,25%";}
if ($total_ciclos_propak >= 1000){ $bonus_lider_propak = "1,25%";}
 
if ($total_ciclos_executivo >= 1500){ $bonus_lider_executivo = "1,5%";}
if ($total_ciclos_elite >= 1500){ $bonus_lider_elite = "1,5%";}
if ($total_ciclos_propak >= 1500){ $bonus_lider_propak = "1,5%";}
 
if ($total_ciclos_executivo >= 2500){ $bonus_lider_executivo = "1,75%";}
if ($total_ciclos_elite >= 2500){ $bonus_lider_elite = "1,75%";}
if ($total_ciclos_propak >= 2500){ $bonus_lider_propak = "1,75%";}
 
if ($total_ciclos_executivo >= 5000){ $bonus_lider_executivo = "2%";}
if ($total_ciclos_elite >= 5000){ $bonus_lider_elite = "2%";}
if ($total_ciclos_propak >= 5000){ $bonus_lider_propak = "2%";}
 
if ($total_ciclos_executivo >= 7500){ $bonus_lider_executivo = "2,25%";}
if ($total_ciclos_elite >= 7500){ $bonus_lider_elite = "2,25%";}
if ($total_ciclos_propak	 >= 7500){ $bonus_lider_propak = "2,25%";}

// -----------------------------------------------------------------------------------
 
// TOTAL EXECUTIVO
$comissao_direta_executivo = floor($comissao_direta_executivo*2);
$comissao_criador_bromze_executivo = floor($criador_bronze_esquerda+$criador_bronze_direita); 
$total_executivo = floor($comissao_direta_executivo+$comissao_criador_bromze_executivo+$total_binario_executivo+$total_binario_mega_esquerda_executivo+$total_binario_mega_direita_executivo+$bonus_avanco_executivo+$bonus_mercedes_executivo);
$total_executivo_reais = floor($total_executivo*$dolar_hj);
// TOTAL ELITE
$comissao_direta_elite = floor($comissao_direta_elite*2);
$comissao_criador_bromze_elite = floor($criador_bronze_esquerda+$criador_bronze_direita); 
$total_elite = floor($comissao_direta_elite+$comissao_criador_bromze_elite+$total_binario_elite+$total_binario_mega_esquerda_elite+$total_binario_mega_direita_elite+$bonus_avanco_elite+$bonus_mercedes_elite);
$total_elite_reais = floor($total_elite*$dolar_hj);
// TOTAL PROPAK 
$comissao_direta_propak = floor($comissao_direta_propak*2);
$comissao_criador_bromze_propak = floor($criador_bronze_esquerda+$criador_bronze_direita); 
$total_propak = floor($comissao_direta_propak+$comissao_criador_bromze_propak+$total_binario_propak+$total_binario_mega_esquerda_propak+$total_binario_mega_direita_propak+$bonus_avanco_propak+$bonus_mercedes_propak);
$total_propak_reais = floor($total_propak*$dolar_hj);
// -----------------------------------------------------------------------------------
// TOTAL MENSALIDADES
// soma pontos cada lado
$planoA_pontos_cada_lado  = floor($total_menor*20);
$planoB_pontos_cada_lado  = floor($total_menor*35);
$planoC_pontos_cada_lado  = floor($total_menor*60);
$planoD_pontos_cada_lado  = floor($total_menor*85);
$planoE_pontos_cada_lado  = floor($total_menor*110);

// Total de Ciclos
$planoA_ciclos  = floor($planoA_pontos_cada_lado/100);
$planoB_ciclos  = floor($planoB_pontos_cada_lado/100);
$planoC_ciclos  = floor($planoC_pontos_cada_lado/100);
$planoD_ciclos  = floor($planoD_pontos_cada_lado/100);
$planoE_ciclos  = floor($planoE_pontos_cada_lado/100);

// Total em valores
$planoA_binario = floor($planoA_ciclos*25);
$planoB_binario = floor($planoB_ciclos*25);
$planoC_binario = floor($planoC_ciclos*25);
$planoD_binario = floor($planoD_ciclos*25);
$planoE_binario = floor($planoE_ciclos*25);
 
?> 	
	 
  

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
<br>


<div class="box-header">
	<h3 class="box-title">SIMULANDO Refer&ecirc;nte a toda equipe aderindo o pacote abaixo</h3>
</div><!-- /.box-header -->	 
<!-- Custom Tabs -->
<div class="nav-tabs-custom"> 
	<ul class="nav nav-tabs"> 
        <li class="active"><a href="#tab_2" data-toggle="tab">EXECUTIVO</a></li>
		<li><a href="#tab_3" data-toggle="tab">ELITE</a></li>
		<li><a href="#tab_4" data-toggle="tab">PRO-PAK</a></li>  
	</ul>
    <div class="tab-content">
  
		<div class="tab-pane active" id="tab_2"> 
		<!-- Main content --> 
				<table id="fundo_renda">
					<tr><td>
					<table style="position:relative;top:5px; left:35px; width:1080px;height:25px; font:16px bold Arial, Tahoma, sans-serif; ">
						<tr>
							<td style="width:130px;">&#x24; <?php echo $comissao_direta_executivo.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_executivo.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_mega_esquerda_executivo+$total_binario_mega_direita_executivo.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp; &#x24; <?php echo $comissao_criador_bromze_executivo.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp;&nbsp;&nbsp; &#x24; <?php echo $bonus_avanco_executivo.",00"; ?></td>
							<td style="width:140px; font:12px bold Arial, Tahoma, sans-serif; color:red;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $bonus_lider_executivo; ?></td>
							<td style="width:150px;">&#x24; <?php echo $bonus_mercedes_executivo.",00"; ?></td>
						</tr> 
					</table> 
					</td></tr>
					<tr><td>
					<table>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
						</tr> 
					</table> 
					</td></tr>
				</table>
				<br>
				<table style="border:2px solid #e6e6e6;text-align:center;float:right; font:20px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:350px; height:60px; ">Compensa&ccedil;&atilde;o Total</td>
						<td></td>
					</tr>
					<tr>
						<td>Total em D&oacute;lares: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">&#x24; <?php echo $total_executivo.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><br></td>
					</tr>
					<tr>
						<td>Total em Reais: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">R&#x24; <?php echo $total_executivo_reais.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><i style="font-size:10px; color:red;">D&oacute;lar a <?php echo $dolar_hj; ?>R&#x24;</i></td>
					</tr>
				</table>
				
				
				
				<table style="border:2px solid #e6e6e6;text-align:center;float:left; font:15px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:200px; height:60px; "><b>Total de ganhos Mensal se toda equipe aderir </b></td>
						<td></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano A: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoA_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano B: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoB_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano C: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoC_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano D: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoD_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano E: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoE_binario.",00"; ?></td>
					</tr>
				</table>
				
				<br style="clear:both;"><br>
				<div class="box box-primary">
					<div style="float:left;">
						<h3 class="box-title">Plano Carreira Conquistado</h3>
						<i>Parte em Verde, j&aacute; conquistadas </i>
					</div>
					<br>
					<table style="float:right;">
						<tr>	
							<td>
								<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width=100&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:65px;" allowTransparency="true"></iframe>
							</td>
							<td>
								<script src="https://apis.google.com/js/platform.js"></script> 
								<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
							</td>
						</tr>
				</table>
				
				<table id="example1" class="table table-bordered table-striped" >
					<thead>
						<tr>
							<th></th> 
							<th>AVAN&Ccedil;O NA POSI&Ccedil;&Atilde;O</th> 
							<th>CLICOS FORMADOS</th>
							<th>DETALHES</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 1) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center;" ><img src="img/bronze_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">BRONZE</th> 
							<th style="text-align:center; vertical-align: middle;">1</th>
							<th style="text-align:center; vertical-align: middle;">Primera posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 5) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/prata_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">PRATA</th> 
							<th style="text-align:center; vertical-align: middle;">5</th>
							<th style="text-align:center; vertical-align: middle;">Segunda posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 10) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/ouro_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">OURO</th> 
							<th style="text-align:center; vertical-align: middle;">10</th>
							<th style="text-align:center; vertical-align: middle;">Terceira posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 20) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/1estrela_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">1 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">20</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 30) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/2estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">2 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">30</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 50) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/3estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">3 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">50</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							Dirigir uma elegante e prestigiosa Mercedes &eacute; uma demonstra&ccedil;&atilde;o poderosa de como voc&ecirc; realmente pode <br>  
							viver o sonho atrav&eacute;s da TALK FUSION. Com o Mercedes Madness, isso &eacute; um marco que voc&ecirc; pode alvancar na sua  <br>
							jornada at&eacute; as classifica&ccedil;&otilde;es como associado. Uma nova Mercedes Benz &eacute; um incentivo impressionante e voc&ecirc; <br>
							  parecer&aacute; cada vez mais impressionante atr&aacute;s do volante!<br>
							
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/1rJ5b5ga_RQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_executivo >= 100) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">DIAMANTE</th> 
							<th style="text-align:center; vertical-align: middle;">100</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							<b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;1.000</b> <br>
							Os sonhos podem se tornar realidades <br>  
							&Eacute; realmente um sonho que se torna realidade. A estadia no lindo Grand Wailea Resort em Maui, 5 dias, 4 noites, duas vezes por<br>
							ano do programa Dream Getaway &eacute; a maneira sensacional da TALK FUSION para premiar os associados de classifica&ccedil;&atilde;o  <br>
							mais alta pela dedica&ccedil;&atilde;o e o trabalho bem feito. <br> 
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/6OQyMZ5c84g?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
				<thead <?php if ($total_ciclos_executivo >= 150) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/duplo_diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE DUPLO</th> 
						<th style="text-align:center; vertical-align: middle;">150</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;2.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 200) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/triplo_diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE TRIPLO</th> 
						<th style="text-align:center; vertical-align: middle;">200</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;3.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 250) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_elite_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE ELITE</th> 
						<th style="text-align:center; vertical-align: middle;">250</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;5.000</b> <br>
						Voc&ecirc; tamb&eacute;m &eacute; recompen&ccedil;ado com uma incr&iacute;vel mercedes benz QUITADA pela empresa TALK FUSION.
						<img style="border:2px solid #000;" src="img/mercedes-benz-slk-talkfusion-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes-comunidade-multinivel-talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/premiacao-talkfusion-mmn-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" /> 
						<br>
						Voc&ecirc; tamb&eacute;m ser&aacute; recompen&ccedil;ado com um moderno rel&oacute;gio da marca ROLEX com um valor aproximado h&aacute; 10 mil d&oacute;lares. <br>
						<img style="border:2px solid #000;" src="img/talkfusiom-rolex-comunidade-multinivel.png" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL</th> 
						<th style="text-align:center; vertical-align: middle;">500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1%</b> <br>
						O fundo de lideran&ccedil;a &eacute; um rendimento compartilhado de B&ocirc;nus ganhos por<br>
						S&oacute;cios Qualificados que atingiram a categoria de Diamante Azul e dividem uma percentagem do total <br>  
						do Volume de Vendas gerado atrav&eacute;s da Talk Fusion no mundo todo. 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 1000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/grande_diamente_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL GRANDE</th> 
						<th style="text-align:center; vertical-align: middle;">1000</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,25%</b> <br>
						
						<iframe width="640" height="380" src="//www.youtube.com/embed/JpJncSkIpsU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 1500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/royal_diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL ROYAL</th> 
						<th style="text-align:center; vertical-align: middle;">1500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,5%</b> <br>
						<img style="border:2px solid #000;" src="img/ferrari_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/talkfusion-indenesia-3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 2500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_presidente.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL PRESIDENTE</th> 
						<th style="text-align:center; vertical-align: middle;">2500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,75%</b> <br>
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion1.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 5000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_embaixador.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMBAIXADOR</th> 
						<th style="text-align:center; vertical-align: middle;">5000</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2%</b> <br>
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_executivo >= 7500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamente_azul_emperial.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMPERIAL</th> 
						<th style="text-align:center; vertical-align: middle;">7500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2,25%</b> <br>
						<img style="border:2px solid #000;" src="img/iate_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/luxo_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/milhonario_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				
				</table>
			</div><!-- /.box-header -->
 
		 
		<hr style="clear:both;">
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="tab_3"> 
		<!-- Main content --> 
				<table id="fundo_renda">
					<tr><td>
					<table style="position:relative;top:5px; left:35px; width:1080px;height:25px; font:16px bold Arial, Tahoma, sans-serif; ">
						<tr>
							<td style="width:130px;">&#x24; <?php echo $comissao_direta_elite.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_elite.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_mega_esquerda_elite+$total_binario_mega_direita_elite.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp; &#x24; <?php echo $comissao_criador_bromze_elite.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp;&nbsp;&nbsp; &#x24; <?php echo $bonus_avanco_elite.",00"; ?></td>
							<td style="width:140px; font:12px bold Arial, Tahoma, sans-serif; color:red;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $bonus_lider_elite; ?></td>
							<td style="width:150px;">&#x24; <?php echo $bonus_mercedes_elite.",00"; ?></td>
						</tr> 
					</table> 
					</td></tr>
					<tr><td>
					<table>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
						</tr> 
					</table> 
					</td></tr>
				</table>
				<br>
				<table style="border:2px solid #e6e6e6;text-align:center;float:right; font:20px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:350px; height:60px; ">Compensa&ccedil;&atilde;o Total</td>
						<td></td>
					</tr>
					<tr>
						<td>Total em D&oacute;lares: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">&#x24; <?php echo $total_elite.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><br></td>
					</tr>
					<tr>
						<td>Total em Reais: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">R&#x24; <?php echo $total_elite_reais.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><i style="font-size:10px; color:red;">D&oacute;lar a <?php echo $dolar_hj; ?>R&#x24;</i></td>
					</tr>
				</table>
				
				
				
				<table style="border:2px solid #e6e6e6;text-align:center;float:left; font:15px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:200px; height:60px; "><b>Total de ganhos Mensal se toda equipe aderir </b></td>
						<td></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano A: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoA_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano B: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoB_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano C: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoC_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano D: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoD_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano E: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoE_binario.",00"; ?></td>
					</tr>
				</table>
				
				<br style="clear:both;"><br>
				<div class="box box-primary">
					<div style="float:left;">
						<h3 class="box-title">Plano Carreira Conquistado</h3>
						<i>Parte em Verde, j&aacute; conquistadas </i>
					</div>
					<br>
					<table style="float:right;">
						<tr>	
							<td>
								<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width=100&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:65px;" allowTransparency="true"></iframe>
							</td>
							<td>
								<script src="https://apis.google.com/js/platform.js"></script> 
								<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
							</td>
						</tr>
				</table>
				
				<table id="example1" class="table table-bordered table-striped" >
					<thead>
						<tr>
							<th></th> 
							<th>AVAN&Ccedil;O NA POSI&Ccedil;&Atilde;O</th> 
							<th>CLICOS FORMADOS</th>
							<th>DETALHES</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 1) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center;" ><img src="img/bronze_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">BRONZE</th> 
							<th style="text-align:center; vertical-align: middle;">1</th>
							<th style="text-align:center; vertical-align: middle;">Primera posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 5) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/prata_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">PRATA</th> 
							<th style="text-align:center; vertical-align: middle;">5</th>
							<th style="text-align:center; vertical-align: middle;">Segunda posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 10) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/ouro_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">OURO</th> 
							<th style="text-align:center; vertical-align: middle;">10</th>
							<th style="text-align:center; vertical-align: middle;">Terceira posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 20) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/1estrela_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">1 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">20</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 30) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/2estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">2 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">30</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 50) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/3estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">3 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">50</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							Dirigir uma elegante e prestigiosa Mercedes &eacute; uma demonstra&ccedil;&atilde;o poderosa de como voc&ecirc; realmente pode <br>  
							viver o sonho atrav&eacute;s da TALK FUSION. Com o Mercedes Madness, isso &eacute; um marco que voc&ecirc; pode alvancar na sua  <br>
							jornada at&eacute; as classifica&ccedil;&otilde;es como associado. Uma nova Mercedes Benz &eacute; um incentivo impressionante e voc&ecirc; <br>
							  parecer&aacute; cada vez mais impressionante atr&aacute;s do volante!<br>
							
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/1rJ5b5ga_RQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_elite >= 100) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">DIAMANTE</th> 
							<th style="text-align:center; vertical-align: middle;">100</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							<b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;1.000</b> <br>
							Os sonhos podem se tornar realidades <br>  
							&Eacute; realmente um sonho que se torna realidade. A estadia no lindo Grand Wailea Resort em Maui, 5 dias, 4 noites, duas vezes por<br>
							ano do programa Dream Getaway &eacute; a maneira sensacional da TALK FUSION para premiar os associados de classifica&ccedil;&atilde;o  <br>
							mais alta pela dedica&ccedil;&atilde;o e o trabalho bem feito. <br> 
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/6OQyMZ5c84g?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
				<thead <?php if ($total_ciclos_elite >= 150) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/duplo_diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE DUPLO</th> 
						<th style="text-align:center; vertical-align: middle;">150</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;2.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 200) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/triplo_diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE TRIPLO</th> 
						<th style="text-align:center; vertical-align: middle;">200</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;3.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 250) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_elite_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE ELITE</th> 
						<th style="text-align:center; vertical-align: middle;">250</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;5.000</b> <br>
						Voc&ecirc; tamb&eacute;m &eacute; recompen&ccedil;ado com uma incr&iacute;vel mercedes benz QUITADA pela empresa TALK FUSION.
						<img style="border:2px solid #000;" src="img/mercedes-benz-slk-talkfusion-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes-comunidade-multinivel-talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/premiacao-talkfusion-mmn-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" /> 
						<br>
						Voc&ecirc; tamb&eacute;m ser&aacute; recompen&ccedil;ado com um moderno rel&oacute;gio da marca ROLEX com um valor aproximado h&aacute; 10 mil d&oacute;lares. <br>
						<img style="border:2px solid #000;" src="img/talkfusiom-rolex-comunidade-multinivel.png" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL</th> 
						<th style="text-align:center; vertical-align: middle;">500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1%</b> <br>
						O fundo de lideran&ccedil;a &eacute; um rendimento compartilhado de B&ocirc;nus ganhos por<br>
						S&oacute;cios Qualificados que atingiram a categoria de Diamante Azul e dividem uma percentagem do total <br>  
						do Volume de Vendas gerado atrav&eacute;s da Talk Fusion no mundo todo. 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 1000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/grande_diamente_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL GRANDE</th> 
						<th style="text-align:center; vertical-align: middle;">1000</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,25%</b> <br>
						
						<iframe width="640" height="380" src="//www.youtube.com/embed/JpJncSkIpsU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 1500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/royal_diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL ROYAL</th> 
						<th style="text-align:center; vertical-align: middle;">1500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,5%</b> <br>
						<img style="border:2px solid #000;" src="img/ferrari_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/talkfusion-indenesia-3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 2500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_presidente.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL PRESIDENTE</th> 
						<th style="text-align:center; vertical-align: middle;">2500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,75%</b> <br>
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion1.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 5000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_embaixador.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMBAIXADOR</th> 
						<th style="text-align:center; vertical-align: middle;">5000</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2%</b> <br>
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_elite >= 7500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamente_azul_emperial.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMPERIAL</th> 
						<th style="text-align:center; vertical-align: middle;">7500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2,25%</b> <br>
						<img style="border:2px solid #000;" src="img/iate_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/luxo_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/milhonario_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				
				</table> 
			</div><!-- /.box-header -->
		 
		<hr style="clear:both;">
		</div><!-- /.tab-pane -->
		<div class="tab-pane" id="tab_4"> 
		<!-- Main content --> 
				<table id="fundo_renda">
					<tr><td>
					<table style="position:relative;top:5px; left:35px; width:1080px;height:25px; font:16px bold Arial, Tahoma, sans-serif; ">
						<tr>
							<td style="width:130px;">&#x24; <?php echo $comissao_direta_propak.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_propak.",00"; ?></td>
							<td style="width:130px;">&nbsp;&nbsp; &#x24; <?php echo $total_binario_mega_esquerda_propak+$total_binario_mega_direita_propak.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp; &#x24; <?php echo $comissao_criador_bromze_propak.",00"; ?></td>
							<td style="width:130px; ">&nbsp;&nbsp;&nbsp;&nbsp; &#x24; <?php echo $bonus_avanco_propak.",00"; ?></td>
							<td style="width:140px; font:12px bold Arial, Tahoma, sans-serif; color:red;">&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $bonus_lider_propak; ?></td>
							<td style="width:150px;">&#x24; <?php echo $bonus_mercedes_propak.",00"; ?></td>
						</tr> 
					</table> 
					</td></tr>
					<tr><td>
					<table>
						<tr>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
							<td> </td>
						</tr> 
					</table> 
					</td></tr>
				</table>
				<br>
				<table style="border:2px solid #e6e6e6;text-align:center;float:right; font:20px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:350px; height:60px; ">Compensa&ccedil;&atilde;o Total</td>
						<td></td>
					</tr>
					<tr>
						<td>Total em D&oacute;lares: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">&#x24; <?php echo $total_propak.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><br></td>
					</tr>
					<tr>
						<td>Total em Reais: </td>
						<td style="background:#123244; color:#FFF; width:300px; height:50px;">R&#x24; <?php echo $total_propak_reais.",00"; ?></td>
					</tr>
					<tr>
						<td><br></td>
						<td><i style="font-size:10px; color:red;">D&oacute;lar a <?php echo $dolar_hj; ?>R&#x24;</i></td>
					</tr>
				</table>
				
				
				
				<table style="border:2px solid #e6e6e6;text-align:center;float:left; font:15px bold Arial, Tahoma, sans-serif;;">
					<tr>
						<td style=" width:200px; height:60px; "><b>Total de ganhos Mensal se toda equipe aderir </b></td>
						<td></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano A: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoA_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano B: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoB_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano C: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoC_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano D: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoD_binario.",00"; ?></td>
					</tr>
					<tr>
						<td>Mensalidade do Plano E: </td>
						<td style="background:#123244; color:#FFF; width:200px; height:30px; border:3px solid #FFF;">&#x24; <?php echo $planoE_binario.",00"; ?></td>
					</tr>
				</table>
				
				<br style="clear:both;"><br>
				<div class="box box-primary">
					<div style="float:left;">
						<h3 class="box-title">Plano Carreira Conquistado</h3>
						<i>Parte em Verde, j&aacute; conquistadas </i>
					</div>
					<br>
					<table style="float:right;">
						<tr>	
							<td>
								<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width=100&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:65px;" allowTransparency="true"></iframe>
							</td>
							<td>
								<script src="https://apis.google.com/js/platform.js"></script> 
								<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
							</td>
						</tr>
				</table>
				
				
				<table id="example1" class="table table-bordered table-striped" >
					<thead>
						<tr>
							<th></th> 
							<th>AVAN&Ccedil;O NA POSI&Ccedil;&Atilde;O</th> 
							<th>CLICOS FORMADOS</th>
							<th>DETALHES</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 1) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center;" ><img src="img/bronze_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">BRONZE</th> 
							<th style="text-align:center; vertical-align: middle;">1</th>
							<th style="text-align:center; vertical-align: middle;">Primera posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 5) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/prata_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">PRATA</th> 
							<th style="text-align:center; vertical-align: middle;">5</th>
							<th style="text-align:center; vertical-align: middle;">Segunda posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 10) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/ouro_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">OURO</th> 
							<th style="text-align:center; vertical-align: middle;">10</th>
							<th style="text-align:center; vertical-align: middle;">Terceira posi&ccedil;&atilde;o</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 20) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/1estrela_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">1 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">20</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 30) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/2estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">2 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">30</th>
							<th style="text-align:center; vertical-align: middle;">Reconhecimento de Associados no Site.</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 50) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/3estrelas_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">3 ESTRELA</th> 
							<th style="text-align:center; vertical-align: middle;">50</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							Dirigir uma elegante e prestigiosa Mercedes &eacute; uma demonstra&ccedil;&atilde;o poderosa de como voc&ecirc; realmente pode <br>  
							viver o sonho atrav&eacute;s da TALK FUSION. Com o Mercedes Madness, isso &eacute; um marco que voc&ecirc; pode alvancar na sua  <br>
							jornada at&eacute; as classifica&ccedil;&otilde;es como associado. Uma nova Mercedes Benz &eacute; um incentivo impressionante e voc&ecirc; <br>
							  parecer&aacute; cada vez mais impressionante atr&aacute;s do volante!<br>
							
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/1rJ5b5ga_RQ?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
					<thead <?php if ($total_ciclos_propak >= 100) { ?> style="background:#d8f0ce;" <?php } ?>>
						<tr>
							<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
							<th style="text-align:center; vertical-align: middle;">DIAMANTE</th> 
							<th style="text-align:center; vertical-align: middle;">100</th>
							<th style="text-align:center; vertical-align: middle; font-size:12px;" >
							<b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;1.000</b> <br>
							Os sonhos podem se tornar realidades <br>  
							&Eacute; realmente um sonho que se torna realidade. A estadia no lindo Grand Wailea Resort em Maui, 5 dias, 4 noites, duas vezes por<br>
							ano do programa Dream Getaway &eacute; a maneira sensacional da TALK FUSION para premiar os associados de classifica&ccedil;&atilde;o  <br>
							mais alta pela dedica&ccedil;&atilde;o e o trabalho bem feito. <br> 
							<br>							
							<iframe width="640" height="480" src="//www.youtube.com/embed/6OQyMZ5c84g?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
							</th> 
						</tr>
					</thead>
				<thead <?php if ($total_ciclos_propak >= 150) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/duplo_diamante_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE DUPLO</th> 
						<th style="text-align:center; vertical-align: middle;">150</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;2.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 200) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_elite_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE TRIPLO</th> 
						<th style="text-align:center; vertical-align: middle;">200</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;3.000</b></th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 200) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_elite_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE ELITE</th> 
						<th style="text-align:center; vertical-align: middle;">250</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">Recompensado com um B&ocirc;nus de &#x24;5.000</b> <br>
						Voc&ecirc; tamb&eacute;m &eacute; recompen&ccedil;ado com uma incr&iacute;vel mercedes benz QUITADA pela empresa TALK FUSION.
						<img style="border:2px solid #000;" src="img/mercedes-benz-slk-talkfusion-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes-comunidade-multinivel-talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/premiacao-talkfusion-mmn-comunidade-multinivel.jpg" width="200" height="154" alt="" class="fl" /> 
						<br>
						Voc&ecirc; tamb&eacute;m ser&aacute; recompen&ccedil;ado com um moderno rel&oacute;gio da marca ROLEX com um valor aproximado h&aacute; 10 mil d&oacute;lares. <br>
						<img style="border:2px solid #000;" src="img/talkfusiom-rolex-comunidade-multinivel.png" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead> 
				<thead <?php if ($total_ciclos_propak >= 500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL</th> 
						<th style="text-align:center; vertical-align: middle;">500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1%</b> <br>
						O fundo de lideran&ccedil;a &eacute; um rendimento compartilhado de B&ocirc;nus ganhos por<br>
						S&oacute;cios Qualificados que atingiram a categoria de Diamante Azul e dividem uma percentagem do total <br>  
						do Volume de Vendas gerado atrav&eacute;s da Talk Fusion no mundo todo. 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 1000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/grande_diamente_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL GRANDE</th> 
						<th style="text-align:center; vertical-align: middle;">1000</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,25%</b> <br>
						
						<iframe width="640" height="380" src="//www.youtube.com/embed/JpJncSkIpsU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 1500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/royal_diamante_azul_talkfusion.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL ROYAL</th> 
						<th style="text-align:center; vertical-align: middle;">1500</th>
						<th style="text-align:center; vertical-align: middle;"><b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,5%</b> <br>
						<img style="border:2px solid #000;" src="img/ferrari_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/mercedes_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/talkfusion-indenesia-3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 2500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_presidente.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL PRESIDENTE</th> 
						<th style="text-align:center; vertical-align: middle;">2500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 1,75%</b> <br>
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion1.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/casas_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" /> 
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 5000) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamante_azul_embaixador.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMBAIXADOR</th> 
						<th style="text-align:center; vertical-align: middle;">5000</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2%</b> <br>
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion2.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/viagens_dos_sonhos_talkfusion3.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				<thead <?php if ($total_ciclos_propak >= 7500) { ?> style="background:#d8f0ce;" <?php } ?>>
					<tr>
						<th style="text-align:center; vertical-align: middle;"><img src="img/diamente_azul_emperial.jpg"  class="img-circle" width="80" alt="Sua Imagem" /></th> 
						<th style="text-align:center; vertical-align: middle;">DIAMANTE AZUL EMPERIAL</th> 
						<th style="text-align:center; vertical-align: middle;">7500</th>
						<th style="text-align:center; vertical-align: middle;">
						<b style="font-size:20px; color:red;">FUNDO DE LIDERAN&Ccedil;A de 2,25%</b> <br>
						<img style="border:2px solid #000;" src="img/iate_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						<img style="border:2px solid #000;" src="img/luxo_talkfusion.jpg" width="200" height="154" alt="" class="fl" /> 
						<img style="border:2px solid #000;" src="img/milhonario_talkfusion.jpg" width="200" height="154" alt="" class="fl" />
						</th> 
					</tr>
				</thead>
				
				</table>
			</div><!-- /.box-header -->
 
		 
		<hr style="clear:both;">
		</div><!-- /.tab-pane -->
	</div><!-- /.tab-content -->
</div><!-- nav-tabs-custom --> 
 
 
				
				
				
				
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
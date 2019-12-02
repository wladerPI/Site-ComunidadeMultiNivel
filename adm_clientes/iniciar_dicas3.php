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

	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
	}
	
$passo1 = 	$_POST["passo1"];
$passo2 = 	$_POST["passo2"];

if ($passo1 == "" || $passo1 == "0" ) { 
	 
	 echo ("<script type='text/javascript'> alert('Antes de visualizar a Dica 3, veja primeiro a Dica 1 !!!'); location.href='iniciar_dicas.php';</script>");
	exit;
} 
if ($passo2 == "" || $passo2 == "0" ) { 
	 
	 echo ("<script type='text/javascript'> alert('Antes de visualizar a Dica 3, veja primeiro a Dica 2 !!!'); location.href='iniciar_dicas2.php';</script>");
	exit;
}  


// buscando pag3 PopUP 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '27'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_popup = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}	
// buscando pag3 banner 1 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '28'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner1 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}	
// buscando pag3 banner 2 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '29'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner2 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}	
// buscando pag3 banner 3 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '30'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner3 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 4 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '31'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner4 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}	
// buscando pag3 banner 5 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '32'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner5 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 6 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '33'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner6 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 7 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '34'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner7 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 8 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '35'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner8 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 9 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '36'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner9 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 10 
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '37'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner10 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 11
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '38'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner11 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}
// buscando pag3 banner 12
	$sql_anuncios = $con->prepare("SELECT * FROM $tabela17 WHERE ID = '39'");
	$sql_anuncios->execute();
	$res_anuncios = $sql_anuncios->fetchAll(PDO::FETCH_OBJ);
	foreach($res_anuncios as $ln_anuncios) {  
		$pa3_banner12 = html_entity_decode((string)$ln_anuncios->SCRIPT, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
	}	


// adm config anuncios
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$tempo_espera = $ln_config->TEMPO_ESPERA;
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
							<!--  pag 3 popup  -->	
							<?php echo $pa3_popup; ?> 
							

<!-- CODIGO DA POPUP FOADOR -->
<script src='http://yourjavascript.com/01114252230/jquery-min.js'></script>
<script src="http://yourjavascript.com/18530532124/jquery-colorbox-min.js"></script> 
<script type="text/javascript" src="http://yourjavascript.com/14222701305/google-jquery-min.js"></script>
<script language="JavaScript" type="text/javascript">
  
if (document.all){}
else document.captureEvents(Event.MOUSEMOVE);
document.onmousemove=mouse;
function mouse(e)
{
if (navigator.appName == 'Netscape'){
xcurs = e.pageX;
ycurs = e.pageY;
} else {
xcurs = event.clientX;
ycurs = event.clientY;
}
document.getElementById('position').style.left = (xcurs-150)+'px';
document.getElementById('position').style.top = (ycurs-125)+'px';
}
</script>
 <style type="text/css">
#lightbox {
    background-color: #000;
    float: left;
    height: 100%;
    opacity: 0.7;
    -moz-opacity: 0.70;
    filter: alpha(opacity=70);
    position: fixed;
    width: 100%;
	z-index:998;    
}   
 
#lightboxContent {
    background-image: url("img/fundo-popup-facebook-comunidade-multinivel-dicas-diarias.png");
	background-repeat:no-repeat;
    margin: 0 auto;
    opacity: 997;
    padding-top: 43px;
    width: 370px;
    height: 370px;
    z-index:999;
    cursor:pointer;
    margin-left: -157px; /* metade da largura */
    margin-top: -145px; /* metade da altura */
    position: fixed;
    top: 40%;
    left: 50%;
    text-align: center;
}
#fechar {
z-index:10;
}
</style>
<style type="text/css">
<!--
#curtir {
z-index:998;
}
--> 
<!--
#position {
position: absolute;
z-index:999999;
filter:alpha(opacity=0); 
opacity:0.0;
}
-->
</style> 
<!-- FIM CODIGO DA POPUP FOADOR -->								
    </head> 
    <body class="skin-blue">
	
<!-- CODIGO DA POPUP FOADOR -->
<div id="divteste"> 
	<div id='subscribe'>
		<div id="position">
			<div id="samuellins">

<?php
// busca qual anuncio CPC popup ira aparecer 
 
	$sql_config = $con->prepare("SELECT * FROM $tabela27 WHERE ID_CLIENTE = '$id_cliente' order by ID desc LIMIT 1");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	$qts_anuncios = count( $res_config );
	
	if ($qts_anuncios <= 0) {
		$dia_anuncio_popup = "1";
	} else {
		foreach($res_config as $ln_config) {  
			$dia_anuncio_popup = $ln_config->ULTIMO_ANUNCIO;
		}
	} 
	$sql_1 = $con->prepare("SELECT * FROM $tabela28 WHERE DIA = '$dia_anuncio_popup'");
	$sql_1->execute();
	$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ);
	$tem_anuncios = count( $res_config );
 
		foreach($res_1 as $ln_1) {   
			$codigos_banners_popup_cpc = html_entity_decode((string)$ln_1->ANUNCIO_CPC_POPUP, ENT_QUOTES, 'utf-8'); // assim faz popup ser usada
		} 
		
 
			
			
			
			// imprimindo o anuncio CPC no POPUP
			echo $codigos_banners_popup_cpc; 
			
 
 
 
 
 
 
// gravando proximo anuncio, proximo dia
			$sql_alt = $con->prepare("SELECT * FROM $tabela27 WHERE ID_CLIENTE = '$id_cliente' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
 
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {
				foreach($res_alt as $ln_alt) {  
					$ultimo_dia = $ln_alt->ULTIMO_ANUNCIO;
					if ($ultimo_dia < 30) {
						$novo_dia = $ultimo_dia+1;
					} else {
						$novo_dia = "1";
					}
				}
			}
	$dia = date('Y-m-d');
	$ip = $_SERVER['REMOTE_ADDR'];
	$hora = date('H:i:s');
	// grava proximo anuncio popup a aparecer
	$run = $con->prepare("INSERT INTO $tabela27 (ID_CLIENTE, ULTIMO_ANUNCIO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :ULTIMO_ANUNCIO, :DATA, :IP, :HORAS)");
	$dados = array(':ID_CLIENTE' => $id_cliente, ':ULTIMO_ANUNCIO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
	$cadastra = $run->execute($dados);
?>						 
			</div>
		</div>
		<div id="lightbox"></div>
		<div id="lightboxContent">
			<div id="curtir" style="margin:25px 0px 0px 0px;"> 
				<iframe src="http://www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel/?ref=tn_tnmn1&amp;width=315&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23ffffff&amp;stream=false&amp;header=false&amp;height=290" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:315px; height:290px;" allowtransparency="true" ></iframe>
				<div id="fechar">  </div> 
			</div>
		</div>
	</div>
</div>
<!-- FIM CODIGO DA POPUP FOADOR -->
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
                        <li class="active">Terceira Dica</li>
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
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
	}	
	if ($liberado == "NAO") {
?>
<BR>  
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


<?php
	$sql_dicas = $con->prepare("SELECT * FROM $tabela10 WHERE DICA = 'SIM' ORDER BY rand() LIMIT 1");
	$sql_dicas->execute();
	$res_dicas = $sql_dicas->fetchAll(PDO::FETCH_OBJ);
	foreach($res_dicas as $ln_dicas) {
		 $id_dica = $ln_dicas->ID;
		 $titulo_dica = $ln_dicas->TITULO_TOPICO; 
		  $categoria_dica = $ln_dicas->CATEGORIA;
		 $texto_dica =    html_entity_decode($ln_dicas->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
		 $visitas_dica = $ln_dicas->CONTADOR; 
		 $data_dica = $ln_dicas->DATA_TOPICO;
		 $data_dica = implode("/",array_reverse(explode("-",$data_dica)));
	}
	   
	$str = $titulo_dica;
	include_once "funcao_url.php";
 
?>	
	<div id="anuncios_top">
		<div id="top_left">
			<!--- banner 1 --->
			<?php  echo $pa3_banner1;  ?> 
		</div>
		<div id="top_right">
			<!-- banner 2 -->
			<?php  echo $pa3_banner2; 
			?>  
		</div>
		<div id="top_centro">
			 <!-- banner 3  --> 
			<?php  echo $pa3_banner3; 
			?> 
		</div>
		<br style="clear:both;"> 
		<div class="callout callout-info">
				<div style="float:left;width:50%;">
					<h2>Segunda Dica do dia!</h2>
				</div>
				<div style="float:right;width:50%;"> 
					<?php 
						if ($categoria_dica == "COMUNIDADE") { ?>
							<h5>Categoria: <b style="color:red;"><?php echo "COMUNIDADE MULTIN&Iacute:VEL"; ?></b> </h5>
							<img src="../img/logotipo.gif"  class="img-circle" alt="Sua Imagem" height="70" />
					<?php } else if ($categoria_dica == "TALKFUSION") { ?>
							<h5>Categoria: <b style="color:red;"><?php echo $categoria_dica; ?></b> </h5>
							<img src="../talkfusion/images/talk.gif"  class="img-circle" alt="Sua Imagem" height="70"  />
					<?php } else if ($categoria_dica == "TRAFFICMONSOON") { ?>
							<h5>Categoria: <b style="color:red;"><?php echo $categoria_dica; ?></b> </h5>
							<img src="../trafficmonsoon/images/logo-trafficmonsoon-comunidade-multinivel-ganhe-dinheiro-seja-financiado-com-adpacks.jpg"  class="img-circle" alt="Sua Imagem" height="70"  />
					<?php }
					?>
					
				</div>  
				<br style="clear:both;">
            </div> 	
		<br style="clear:both;">
    </div> 
	<br style="clear:both;">
	<br>
	<div id="anuncios_left">
		<!--  banner 4 -->  
		<?php echo $pa3_banner4; ?>
		
		<!---  banner 5 --->
		<?php echo $pa3_banner5; ?>
    </div>  
	<div id="dica_centro">
<?php
	$sql_dicas = $con->prepare("SELECT * FROM $tabela15 ORDER BY rand() LIMIT 1");
	$sql_dicas->execute();
	$res_dicas = $sql_dicas->fetchAll(PDO::FETCH_OBJ);
	foreach($res_dicas as $ln_dicas) {
		 $id_dica = $ln_dicas->ID;
		 $titulo_dica = $ln_dicas->TITULO; 
		 $texto_dica =    html_entity_decode($ln_dicas->TEXTO, ENT_QUOTES, 'utf-8'); 
		 $visitas_dica = $ln_dicas->VISUALIZACOES; 
		 $data_dica = $ln_dicas->DATA;
		 $data_dica = implode("/",array_reverse(explode("-",$data_dica)));
	}
?>	
	 
		<h1><?php echo $titulo_dica; ?></h1>
		<p> <?php echo $texto_dica; ?> </p>
		<p> <?php echo "Data de Publica&ccedil;&atilde;o: <b>".$data_dica; ?></b> </p>
		<p> Veja essa Dica no F&Oacute;RUM, clique aqui:  <b style="color:#666;font-size:11px;"><a href="../forum/topico/<?php echo $id_dica."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO" target="_blank"><?php echo $titulo_dica; ?></a></b> </p>
<?php
	$nova_visitas = $visitas_dica+1;

	$altera = "UPDATE $tabela15 SET VISUALIZACOES=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($nova_visitas,$id_dica));
?>		
		
<script type="text/javascript">
  
function verifica() {  
	alert("Na pr\u00f3xima p\u00e1gina, lembre-se de clicar em todos an\u00fancios que esteja abaixo da mensagem 'Publicidades', mantenha sua participa\u00e7\u00e3o corretamente!");   
}
</script>


		<hr> 
		<div id="tempo" style="float:left;font:25px bold; color:red; width:50%;  margin:5% 20% 0% 0%; text-align:center;">N&atilde;o tenha pressa! Leia nossa Dica.</div>
		<div id="botao_continuar" style="float:right; margin:5% 5% 5% 0%;">
		<form id='form' name='form' method='post' action='iniciar_dicas_finaliza.php'>
			<INPUT TYPE='hidden' NAME='passo1' VALUE='<?php echo $passo1; ?>'>
			<INPUT TYPE='hidden' NAME='passo2' VALUE='<?php echo $passo2; ?>'> 
			<INPUT TYPE='hidden' NAME='passo3' VALUE='ok'>
			<button type='submit' class='btn btn-warning btn-lg' Onclick="return verifica()" title='Clique aqui para FINALIZAR SEU ESTUDO POR HOJE'>Continuar</button> 
		</form>
		</div>
		<br style="clear:both;">
    </div>	
	<div id="anuncios_rodape">
		<div style="float:left;margin:0px 0px 0px 0px;">
			 <!--  banner  6 --> 
			<?php echo $pa3_banner6; ?> 
		</div>
		<div style="float:left;margin:0px 0px 0px 4%;">
			<!-- banner 7 -->
			<?php echo $pa3_banner7; ?>
		</div>
		<div style="float:left;margin:0px 0px 0px 4%;">
			<!-- Banner 8 -->
			<?php echo $pa3_banner8; ?>
		</div>
		<div style="clear:both;margin:0px 0px 0px 5px;">
			<div style="float:left;margin:0px 10px 0px 0px;">
			 <!--  banner 9 -->  
			<?php echo $pa3_banner9; ?>	
			</div>
			<div style="float:right;margin:0px 0px 0px 10px;">
			<!-- banner 10 -->   
			<?php echo $pa3_banner10; ?>
			</div>		
		</div> 
    </div>	
	<!-- banner 11 -->
		<?php echo $pa3_banner11; ?>
		
		<!--  banner 12-->   
		<?php echo $pa3_banner12; ?>
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
<!--  CODIGO DA POPUP FOADOR -->	 
<script language="JavaScript" type="text/javascript">
 
function teste(){
	document.getElementById("divteste").style.display="none";
}
setTimeout("teste()",25000); 
 
</script>
<!-- FIM CODIGO DA POPUP FOADOR -->	 
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
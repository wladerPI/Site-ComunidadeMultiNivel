<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
date_default_timezone_set('America/Sao_Paulo');  

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	header("Location: ../index.php");
}
 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS; 
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
 
	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
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
    <body class="skin-blue"  onLoad="initTimer();">
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
                        <li class="active">FAQ - Como Funciona a Rede do Simulador</li>
                    </ol>
                </section>
 
                <!-- Main content -->
                <section class="content">

				
<div style="text-align:center;width:100%;">				
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pagina-centro-clientes -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="3776313246"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> 	 

<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i>
	<h4><b>Essa Ferramenta de trabalho da ComunidadeMultiN&iacute;vel lhe da a oportunidade, para voc&ecirc; entrar em nossa REDE PRINCIPAL com uma rede de afil&iacute;ados j&aacute; pronta.</b><h4>
</div>	
<div style="float:left;width:50%;">
	<iframe class="video" style="margin:10px 0px 0px 10px;"  width="520" height="400" src="//www.youtube.com/embed/JnXq9X5LFAs" frameborder="0" allowfullscreen></iframe>	
</div>
<div style="float:right;width:50%; ">
	<div class="callout callout-warning">
	<h1>Ferramenta de trabalho "REDE do SIMULADOR"</h1>
	<h4>- A REDE do SIMULADOR &eacute; uma rede criada gratuitamente por todos os afiliados da Comunidade MultiN&iacute;vel, em uma matrix for&ccedil;ada<b>(cada pessoa ter&aacute; apenas 2 diretos, sendo 1 cada lado)</b>. </h4><br>
	<h4>- O objetivo dessa REDE &eacute; criar um pr&eacute;-cadastro e Simular as rendas dos participantes referente as formas de ganhos da empresa TalkFusion, quando um determinado tempo de trabalho ser atingido, iremos fazer a migra&ccedil;&atilde;o da REDE do SIMULADOR para a REDE PRINCIPAL dentro da empresa TALK FUSION, fazendo com que <b>suas rendas simuladas se torne uma renda real</b>.</h4><br>
	<h4>- Os posicionamentos s&atilde;o determinados por pontua&ccedil;&otilde;es, ao decorrer dos trabalhos, sempre que um indicado seu, direto ou indireto, indicar algu&eacute;m para tamb&eacute;m participar da rede do simulador, voc&ecirc; ganhar&aacute; automaticamente uma quantidade de pontos para que possa investir no RANK do SIMULADOR, fazendo com que voc&ecirc; fique no topo da rede, e quando chegar o momento da migra&ccedil;&atilde;o da REDE do SIMULADOR para a REDE PRINCIPAL, <b>voc&ecirc; entrar&aacute; na empresa TALK FUSION com uma rede de afil&iacute;ados j&aacute; pronta</b>.</h4> 
												
												
	<?php  if ($talk_simulador_status == "SIM") { 
		if ($talk_simulador == "SIM") { ?>
			<b style="color:red;">Voc&ecirc; j&aacute; est&aacute; participando !!!</b><br>
			<a href="rank_talk_simulador.php">Veja aqui seu posicionamento</a>.<br>
		<?php } else {?>	
			<a href="entrar_talk_simulador.php"><img src="img/participar-pesquisa.jpg" width="250" height="80" alt="Quero Participar do SIMULADOR da TALK FUSION"   /></a>
		<?php } 
	} else { ?>
		<br>
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i> 
			<b>Para participar dessa ferramenta de trabalho, Aguarde a migra&ccedil;&atilde;o para a REDE PRINCIPAL ser efetuada e a REDE do SIMULADOR ser relan&ccedil;ada</b> 
			<!-- <i>Migra&ccedil;&atilde;o da REDE do SIMULADOR est&aacute; em andamento...</i> -->
			<br>
			<i>ESSA FERRAMENTA EST&Aacute; TEMPORARIAMENTE EM MANUTEN&Ccedil;&Atilde;O</i>
			<br>
		</div>	 
	<?php } ?>  
		<br style="clear:both;">
	</div> 
</div>
<br style="clear:both;"> 
										
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
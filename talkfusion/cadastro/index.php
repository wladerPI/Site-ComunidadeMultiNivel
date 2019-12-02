<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE); 
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

 
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

 
$url  = isset($_GET['url']) ? $_GET['url'] : 'home';
	
	$separar  = explode('/', $url);
    $pagina   = (isset($separar[0])) ? $separar[0] : 'home';
	$sub_pagina   = (isset($separar[1])) ? $separar[1] : 'home';
	$sub2_pagina   = (isset($separar[2])) ? $separar[2] : '0';
	$sub3_pagina   = (isset($separar[3])) ? $separar[3] : '0';
     
	try {
		$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pagina'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $ln) { 
			$id_clients = $ln->ID;
		} 
	} catch(PODException $e) {
		echo "Erro:/n".$e->getMessage();
	} 	 
			if ($pagina == $id_clients){
				 
			
	

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | F&Oacute;RUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, tutoriais, como funciona, ganhar dinheiro na internet, MMN"/>
		<meta name="robots" content="all">
		
		<Meta Name="Description" Content="ComunidadeMultiN&iacute;vel, a melhores estrat&eacute;gias de trabalho inteligentemente elaboradas para o alavancamento e crescimento do rendimento de toda nossa equipe. SEU SUCESSO EST&Aacute; EM NOSSA UNI&Atilde;O !!!">
		<meta property='og:image' content='http://www.comunidademultinivel.com.br/adm_clientes/img/talkfusion-indenesia-3.jpg'/>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
        <link href="../../adm_clientes/css/estilo.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../../adm_clientes/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../adm_clientes/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../adm_clientes/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../adm_clientes/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../adm_clientes/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../../adm_clientes/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../../adm_clientes/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../adm_clientes/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../adm_clientes/css/AdminLTE.css" rel="stylesheet" type="text/css" />

		<link href="../../css/css.css" rel="stylesheet" type="text/css" />
		
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		
		
		
		
		
		<!-- 2 POP UPS PARA PARA TESTAR OS GANHOS -->
	  
		<!-- PopAds.net Popunder Code for www.comunidademultinivel.com.br -->
<script type="text/javascript">
  var _pop = _pop || [];
  _pop.push(['siteId', 632406]);
  _pop.push(['minBid', 0.000000]);
  _pop.push(['popundersPerIP', 0]);
  _pop.push(['delayBetween', 0]);
  _pop.push(['default', false]);
  _pop.push(['defaultPerDay', 0]);
  _pop.push(['topmostLayer', false]);
  (function() {
    var pa = document.createElement('script'); pa.type = 'text/javascript'; pa.async = true;
    var s = document.getElementsByTagName('script')[0]; 
    pa.src = '//c1.popads.net/pop.js';
    pa.onerror = function() {
      var sa = document.createElement('script'); sa.type = 'text/javascript'; sa.async = true;
      sa.src = '//c2.popads.net/pop.js';
      s.parentNode.insertBefore(sa, s);
    };
    s.parentNode.insertBefore(pa, s);
  })();
</script>
<!-- PopAds.net Popunder Code End -->
		
		
	<!-- 2 POP UPS PARA PARA TESTAR OS GANHOS -->
	
	
	
	
	
	 
    </head>
    <body class="skin-blue">
        <?php  
		if ($id_cliente != "" || $id_cliente != 0) {
			include("topo_logado.php");
		} else {
			include("topo_normal.php");
		}
		  
		?>
 

 
 <Div class="videoContainer">
		<video autoplay="autoplay" loop="loop" autobuffer="autobuffer" muted="muted" poster="img/bg.jpg" allowFullScreen="true" >
		    <source src="../../css/lib/video/video_de_fundo_comunidade_multinivel37.mp4" type="video/mp4"/>
		    <source src="../../css/lib/video/video_de_fundo_comunidade_multinivel37.webm" type="video/webm" />  
		    <object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
		        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
		        <param name="allowFullScreen" value="true" />
		        <param name="wmode" value="transparent" />
		        
		        <img alt="Big Buck Bunny" src="../../img/bg.jpg" title="Video N&atilde;o foi suportado" width="100%" height="100%" />
		    </object>
		</video>
		 
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="../../css/lib/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="../../css/lib/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">
$(function(){
	// Helper function to Fill and Center the HTML5 Video
	jQuery('video, object').maximage('maxcover');
});
		</script>
	 
<div id="geral" style="text-align:center;"> 

<iframe width="685" height="400" src="//www.youtube.com/embed/KA-ZofIFdfk?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
<!--
<img  src="dicas-diarias-comunidademultinivel-cadastro-estrategia-de-trabalho-mmn.jpg" width="685"  height="500" alt="Cadastre-se GRATUITAMENTE"  /> 
-->
<div id="form2">
	<a href="../<?php echo $id_clients; ?>" title="Cadastre-se GRATUITAMENTE"> 
		<img  src="../images/bot_cadastro.gif" width="420" height="100" alt="Cadastre-se GRATUITAMENTE"  /> 
	</a> 
</div>   			
</div>
 
 
 
 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../../adm_clientes/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts --> 
        <script src="../../adm_clientes/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../../adm_clientes/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../../adm_clientes/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../../adm_clientes/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../../adm_clientes/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../adm_clientes/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../../adm_clientes/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../adm_clientes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../adm_clientes/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../../adm_clientes/js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../../adm_clientes/js/AdminLTE/demo.js" type="text/javascript"></script>

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
<?php
	} else if ($pagina == "home"){
		echo "<script type='text/javascript'> alert('Para visualizar essa p\u00e1gina voc\u00ea precisar\u00e1 de um patrocinador, pe\u00e7a o link de indica\u00e7\u00e3o do seu patrocinador ou entre em contato com a Comunidade MultiN\u00edvel solicitando um link de cadastro !!!'); location.href='../contato';</script>";
		exit;
	}   else 	{
		echo "<script type='text/javascript'> alert('Para visualizar essa p\u00e1gina voc\u00ea precisar\u00e1 de um patrocinador, pe\u00e7a o link de indica\u00e7\u00e3o do seu patrocinador ou entre em contato com a Comunidade MultiN\u00edvel solicitando um link de cadastro !!!'); location.href='../contato';</script>";
		exit;
	}
?>
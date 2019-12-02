<?php 
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php"); 
	header("Content-Type: text/html; charset=ISO-8859-1",true);
try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
	<TITLE> TALK FUSION Como funciona, MMN Conectando e mudando vidas, Comunidade MultiN&iacute;vel   </TITLE> 
	<META NAME="description" CONTENT="TALK FUSION &eacute; uma empresa de Marketing MultiN&iacute;vel (MMN) que foi adaptada no projeto da Comunidade MultiN&iacute;vel, possibilitando que voc&ecirc; e todos seus indicados diretos e indiretos sejam FINANCIADOS para entrar em sua pr&oacute;pria rede abaixo da empresa">
	<META NAME="keywords" CONTENT="MMN, talk fusion brasil, empresa talk fusion, como funciona a TalkFusion, talkfusion &eacute; piramide financeira, plano de negocio da talk fusion, como ganhar dinheiro na talk fusion">
	
	<link rel="icon" href="<?php echo $ln->ICO_FAVICON_LINK; ?>" type="image/x-icon" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
	<script type="text/javascript" src="js/cufon-yui.js"></script>
	<script type="text/javascript" src="js/cufon-georgia.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/coin-slider.min.js"></script>
	 
	
</head>
<body>
<div id="geral">
<?php
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
				include("cadastros.php");
			} else if ($pagina == "home"){
				include("home.php");
			}  else if ($pagina == "contato") {
				include("contato.php");
			} else if ($pagina == "faq") {
				include("faq.php");
			} else if ($pagina == "empresa") {
				include("empresa.php");
			} else if ($pagina == "contato") {
				include("contato.php");
			} else if ($pagina == "mercedes") {
				include("mercedes.php");
			} else if ($pagina == "viagemhawaii") {
				include("viagemhawaii.php");
			} else if ($pagina == "pagamento") {
				include("pagamento.php");
			} else if ($pagina == "solicitar_senha") {
				include("solicitar_senha.php");
			} else if ($pagina == "cadastrando") {
				include("cadastrando.php");
			} else if ($pagina == "solicitando_senha") {
				include("solicitando_senha.php");
			} else if ($pagina == "termos_de_uso") {
				include("termos_de_uso.php");
			}   else if ($pagina == "plano_marketing") {
				include("plano_marketing.php");
			} else if ($pagina == "produtos_talkfusion") {
				include("produtos_talkfusion.php");
			} else if ($pagina == "connect-talkfusion") {
				include("connect-talkfusion.php");
			} else if ($pagina == "videos-email-talkfusion") {
				include("videos-email-talkfusion.php");
			} else if ($pagina == "videos-newsletters-talkfusion") {
				include("videos-newsletters-talkfusion.php");
			} else if ($pagina == "assinatura-eletronica-talkfusion") {
				include("assinatura-eletronica-talkfusion.php");
			} else if ($pagina == "video-auto-resposta-talkfusion") {
				include("video-auto-resposta-talkfusion.php");
			} else if ($pagina == "fusion-on-the-go-talkfusion") {
				include("fusion-on-the-go-talkfusion.php");
			} else if ($pagina == "video-share-talkfusion") {
				include("video-share-talkfusion.php");
			} else if ($pagina == "video-blog-talkfusion") {
				include("video-blog-talkfusion.php");
			} else if ($pagina == "fusion-wall-talkfusion") {
				include("fusion-wall-talkfusion.php");
			} else if ($pagina == "dsa") {
				include("dsa.php");
			} else if ($pagina == "sucesso-talkfusion") {
				include("sucesso-talkfusion.php");
			}  else 	{
				include("erro.php");
			}
?>
</div>
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
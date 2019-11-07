<?PHP
include("config/config.php"); 
header("Content-Type: text/html; charset=ISO-8859-1",true);
try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) {
?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" class='no-js' lang='en'> 
<head>

<!-- PIXEL do FACEBOOK -->
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','//connect.facebook.net/en_US/fbevents.js');

fbq('init', '1561949827462922');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1561949827462922&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code --> 

<!-- PIXEL do FACEBOOK -->

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="icon" href="<?php echo $ln->ICO_FAVICON_LINK; ?>" type="image/x-icon" />
	<TITLE> .: Comunidade MultiN&iacute;vel - Sua Rede Faz Parte De Sua Vida :. </TITLE>
	<META NAME="author" CONTENT="Wlader">
	<META NAME="description" CONTENT="Comunidade MultiN&iacute;vel - As Melhores Estrat&eacute;gias de trabalho dentro do mercado MultiN&iacute;vel (MMN)">
	<META NAME="keywords" CONTENT="MMN, trabalho em casa, dinheiro extra, empresa de marketing multinivel, marketing de rede no brasil">
 <meta name="ero_verify" content="4cdcd609196ffe90317918983dc3ad12" />
	
<?php
	} 
	
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
}
?> 

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script> 

<script>
function verifica() {
	if (form.name.value == "") { 
		alert("O seu Nome \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email.value == "") { 
		alert("O E-mail \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.forms[0].email");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    }
}
</script> 
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>
<body> 
<Div class="videoContainer">
		<video autoplay="autoplay" loop="loop" autobuffer="autobuffer" muted="muted" poster="img/bg.jpg" allowFullScreen="true" >
		    <source src="css/lib/video/video_de_fundo_comunidade_multinivel37.mp4" type="video/mp4"/>
		    <source src="css/lib/video/video_de_fundo_comunidade_multinivel37.webm" type="video/webm" />  
		    <object type="application/x-shockwave-flash" data="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf">
		        <param name="movie" value="http://releases.flowplayer.org/swf/flowplayer-3.2.1.swf" />
		        <param name="allowFullScreen" value="true" />
		        <param name="wmode" value="transparent" />
		        
		        <img alt="Big Buck Bunny" src="img/bg.jpg" title="Video N&atilde;o foi suportado" width="100%" height="100%" />
		    </object>
		</video>
		 
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.js'></script>
		<script src="css/lib/js/jquery.cycle.all.js" type="text/javascript" charset="utf-8"></script>
		<script src="css/lib/js/jquery.maximage.js" type="text/javascript" charset="utf-8"></script>
		
		<script type="text/javascript" charset="utf-8">
$(function(){
	// Helper function to Fill and Center the HTML5 Video
	jQuery('video, object').maximage('maxcover');
});
		</script>
	 
<div id="geral"> 
		<iframe width="585"  height="400" src="//www.youtube.com/embed/e7YgHOSYK4A?rel=0&amp;controls=0&amp;showinfo=0&autoplay=1" frameborder="0" allowfullscreen></iframe>
		<hr> 
		<b>Seja Bem-Vindo ao in&iacute;cio de sua nova vida !!! ComunidadeMultiN&iacute;vel \o/ </b> <br>
		<form name="form" id="form" method="post" action="registrar_email.php">
		<div class="field">
				<label for="name">Nome:* </label><input style="margin-left:5px;" class="input" name="name" id="name" type="text"   value="" /> <br> <p class="hint">Qual Seu Nome ?</p>
				<label for="email">E-mail:*</label> <input style="margin-left:2px;" class="input" name="email" id="email"  type="text"  value="" /> <p class="hint">Vamos Conversar via E-mail (N&atilde;o fazemos SPAM)</p>
		</div>	 
			<input class="bot" type="image" src="img/oab_botao.png" alt="Submit button" value="" Onclick="return verifica()"  width="180" height="90" /> 		
		</form>  
	
</div>
</div>
</body> 
</html>
 
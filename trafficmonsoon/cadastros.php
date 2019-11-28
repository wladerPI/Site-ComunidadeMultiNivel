<?php 
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php"); 
	header("Content-Type: text/html; charset=ISO-8859-1",true);
 
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pagina'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) {
		$nome =	$ln->NOME;  
		$email =	$ln->EMAIL;  
		$facebook =	$ln->FACEBOOK;  
		$skype =	$ln->SKYPE;
		$foto_perfil =	$ln->FOTO_PERFIL;		
	} 
	
	
	$sql = $con->prepare("SELECT * FROM $tabela2 WHERE ID = '1'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
 ?>
<script>
function verifica_cadastro() {
	if (form.nome.value == "") { 
		alert("O Nome \xE9 obrigat\xF3rio"); 
		return false;   
    }   
	if (form.tel.value == "" && form.cel.value == "" && form.skype.value == "" && form.facebook.value == "") { 
		alert("Pelo menos um dos camos (Telefone, Celular, Skype ou Facebook) \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.form.email");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    } 
	
<?php
try {
		$sql_verifc = $con->prepare("SELECT * FROM $tabela3");
		$sql_verifc->execute();
		$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc as $ln_verifc) {
?>
	if (form.email.value == "<?php echo $ln_verifc->EMAIL; ?>") { 
		alert("Esse E-mail ja esta cadastrado no sistema."); 
		return false;   
    } 

<?php  
} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
} 
?>		 
	if (form.senha.value == "") { 
		alert("O campo Senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.senha_r.value == "") { 
		alert("O campo Confirma\u00e7\u00e3o da Senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.senha.value != form.senha_r.value){
		alert("Os Formul\xE1rios: Senha e Repita a senha est\xE3o diferentes, \xE9 obrigat\xF3rio."); 
		return false;   
	}  
	if (form.pais.value == "") { 
		alert("O campo Pa\u00eds \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.estado.value == "") { 
		alert("O campo Estado \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.cidade.value == "") { 
		alert("O campo Cidade \xE9 obrigat\xF3rio"); 
		return false;   
    } 
} 
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>TrafficMonsoon como funciona, cadastre-se no projeto da Comunidade MultiN&iacute;vel e seja financiado com os ADPACKS. </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="A equipe da Comunidade MultiN&iacute;vel constantemente vem aprimorando o sistema e as estrat&eacute;gias de trabalho para sempre estar ajudando e facilitando ao m&aacute;ximo o crescimento do seu rendimento dentro das empresas de publicidades(PTC) e das empresas de Marketing MultiN&iacute;vel(MMN) LEGALIZADAS.  ">
	<META NAME="keywords" CONTENT="Essa Pagina nao existe, erro na pagina, Como Funciona TrafficMonsoon, empresas de PTCs, melhores equipe de PTC, empresas de publicidade, ganhar dinheiro com PTC, ganhar dinheiro no MMN, TrafficMonsoon funciona, TrafficMonsoon piramide financeira">
	
	<link rel="icon" href="<?php echo $ln->ICO_FAVICON_LINK; ?>" type="image/x-icon" />
	<link href="css/style.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
	<script type="text/javascript" src="js/cufon-yui.js"></script>
	<script type="text/javascript" src="js/cufon-georgia.js"></script>
	<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/coin-slider.min.js"></script>
	 
    <meta name="viewport" content="width=device-width">

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/templatemo_misc.css">
    <link rel="stylesheet" href="css/templatemo_style.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
 <?php 
	} 
?>
</head>
<body>
    <!--[if lt IE 7]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->
    <div id="front">
        <div class="site-header">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-sm-6 col-xs-6" >
						<div id="topo1"  class="col-md-4">
							<a href="../home" title="Acesse a p&aacute;gina inicial da Comunidade MultiN&iacute;vel"><img src="../img/logotipo.gif" alt="Comunidade MultiN&iacute;vel maior e melhor equipe de PTC do brasil" width="130"></a> 
							<h1>Comunidade MultiN&iacute;vel maior e melhor equipe de PTC do brasil</h1>
						</div>
						
						<div id="topo2" class="col-md-8">
							<a href="home" title="Acesse a p&aacute;gina inicial da TrafficMonsoon no site da Comunidade MultiN&iacute;vel"><img src="images/logo-surf.png" alt="Comunidade MultiN&iacute;vel maior e melhor equipe de PTC do brasil" width="300"></a> 
							<h1>TrafficMonsoon maior empresa de PTC publicidade do mundo Comunidade MultiN&iacute;vel</h1>
						</div>
						
                        <!-- /.logo -->
                    </div> <!-- /.col-md-4 -->
<script>
function verifica_login() { 
	if (formlogin.email_login.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    }   
	//Validacao de Emails	
	var obj = eval("document.formlogin.email_login");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    }
	if (formlogin.senha_login.value == "") { 
		alert("O Campo senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
}
</script>						
                    <div class="col-md-7"> 
						<a href="solicitar_senha" title="esqueceu sua senha" style="color:#FFF;float:right;font-size:15px;"> Esqueceu sua Senha ? </a> 
                        <div ID="searchform"> 
							<i>Escrit&oacute;rio Virtual da Comunidade MultiN&iacute;vel</i>
							<form id="formlogin" name="formlogin" method="post" action="logando.php">
								<b>Email:* </b><input type="text" name="email_login" class="email_login" id="email_login" onfocus="this.className='email_login_foco'" onBlur="this.className='email_login'"  /> <br>
								<b>Senha:* </b><input type="password" name="senha_login" class="senha_login" onfocus="this.className='senha_login_foco'" onBlur="this.className='senha_login'" />
								<input type="submit" value="Entrar" Onclick="return verifica_login()"   name="but_login" class="but_login" onfocus="this.className='but_login_foco'" onBlur="this.className='but_login'" />
							</form> 
						</div>
                    </div> <!-- /.col-md-8 -->
                </div> <!-- /.row -->
               
            </div> <!-- /.container -->
       
     
	 
 	<div id="menu" class="col-md-12" >
		<ul>
            <li><a href="equipe">A equipe</a></li> |
			<li><a href="empresa">A Empresa</a></li> |
            <li><a href="como-funciona">Como Funciona</a></li> |
			<li><a href="produtos">Produtos</a></li> |
			<li><a href="como-ganhar-mais-dinheiro">Como Ganhar +Dinheiro</a></li> |
			<li><a href="../forum/trafficmonsoon_tutoriais.php" title="Tire suas d&uacute;vidas no f&oacute;rum da Comunidade MultiN&iacute;vel" target="_blank" >F&Oacute;RUM</a></li> |
            <li><a href="contato">Contato</a></li>   
        </ul>                
	</div>
		 </div> <!-- /.site-header -->
	</div> <!-- /#front -->
	<br><br><br><br><br>  <br><br><br> <br> 
                <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Quer ser financiado com os ADPACKS da empresa TrafficMonsoon ?</h1>
                </div> <!-- /.col-md-12 --> 
	
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-8 col-sm-6">
	
                    <iframe width="750" height="480" src="//www.youtube.com/embed/1Qh3iar8RLw?rel=0&amp;controls=0&amp;showinfo=0;&autoplay=1" frameborder="1" allowfullscreen></iframe>  
					 <br><hr> 
					<h2 style="font-size:15px;">Cadastre-se agora mesmo e aproveite nossas promo&ccedil;&otilde;es da Comunidade MultiN&iacute;vel</h2>
					<p> (*) Indica um campo obrigat&oacute;rio</p>
					
					
<style>					
#form input{
	margin:5px 0px 2px 0px;
	padding:0px 0px 0px 0px; 
	width:50%;
	height:30px;
	background:#e6eff6;
	font-size:17px;
	color:#000;
	border:2px solid #0f3661;
}  
</style>
					<form action="cadastrando" method="post" id="form" name="form">
						<input TYPE="HIDDEN" id="id_indicado" name="id_indicado"  value="<?php echo $ln->ID; ?>" /> 
						<b style="margin:0px 0px 0px 90px;">Nome*: </b><input id="nome" name="nome"   />  
						<br>
						<i>* Pelo menos 1 dos 4 formul&aacute;rios de contatos abaixo ser&aacute; obrigat&oacute;rio.<i>
						<BR>
						<b style="margin:0px 0px 0px 3px;">DDD + Telefone (FIXO): </b><input id="tel" name="tel"  /> <i>(xx) xxxxxxxx </i>
						<BR>						
						<b style="margin:0px 0px 0px 52px;">DDD + Celular: </b> <input id="cel" name="cel"   /><i>(xx) xxxxxxxx </i> 
						<br>
						<b style="margin:0px 0px 0px 100px;">Skyke: </b> <input id="skype" name="skype"  />  
						<br>
						<b style="margin:0px 0px 0px 41px;">Facebook: (URL)  </b> <input id="facebook" name="facebook"  /> <i>Coloque aqui a URL do seu perfil do Facebook, veja o exemplo na imagem abaixo</i> 
						<br>
						<div style="text-align:center; border:3px solid #000;"><img src="images/copiando-url-do-perfil-do-facebook-comunidade-multinivel.jpg" width="500" height="300" alt="exemplo de como pegar a URL do seu perfil do facebook" class="fl" /></div>
						<hr>
						<b style="margin:0px 0px 0px 80px;">Email*: </b> <input id="email" name="email" class="text" /> <i class="red">*Por Favor Registre-se com um E-mail do GMAIL ou HOTMAIL</i> 
						<br>
						<b style="margin:0px 0px 0px 78px;">Senha*: </b> <input  type="password" name="senha" />
						<br>
						<b style="margin:0px 0px 0px 0px;">Confirma&ccedil;&atilde;o da Senha*:  </b><input  type="password" name="senha_r" />
						<br>
						<hr> 
						<b style="margin:0px 0px 0px 94px;">Pa&iacute;s* </b> <input id="pais" name="pais" class="text" />
						<br>
						<b style="margin:0px 0px 0px 75px;">Estado*: </b> <input id="estado" name="estado" class="text" />
						<br>
						<b style="margin:0px 0px 0px 75px;">Cidade*: </b> <input id="cidade" name="cidade" class="text" />
						<br><br>
						<input type="submit"  value="Registrar no Sistema" style="background:#298d15;color:#FFF;border:2px solid #0f3661;float:right;" Onclick="return verifica_cadastro()"  />
					 
					  </form>
					
					
					
                </div> <!-- /.col-md-8 -->
 

                <div class="col-md-4 col-sm-3">
                    <div class="item-small">
						<?php if ($foto_perfil  == "") { ?>
						<div class="img"><img src="../adm_clientes/img_perfil/sem_foto.png"    alt="foto de perfil" style="width:200px;height:auto;border:10px double #e6eff6;"  /></div>
						<?php } else { ?>
						<div class="img"><img src="../adm_clientes/img_perfil/<?php echo $foto_perfil ;?>"   alt="foto de perfil" style="width:200px;height:auto;border:10px double #e6eff6;"  /></div>
						<?php }  ?> 
                        <h4>Voc&ecirc; est&aacute; sendo indicado por: </h4> 
						<b><?php echo $nome; ?></b>
						<hr>
						<p>Email de Contato:</p>  <b><?php echo $email; ?></b>
						<hr>
						<?php if ($facebook != "") { ?>
						<p>Facebook: </p>  <b><?php echo $facebook; ?></b>
						<hr>
						<?php }  if ($skype != "") { ?>
						<p>Skype: </p> <b><?php echo $skype; ?></b>
						<hr>
						<?php }    ?>
                    </div> <!-- /.item-small -->
                </div> <!-- /.col-md-2 --> 
 
            </div> <!-- /.row -->
        </div> <!-- /.container --> 
	
	
	<br>
	<div style="margin:0px 0px 0px 40px;">
		<a href="como-ganhar-mais-dinheiro" title="Estrat&eacute;gia de crescimento do seu rendimento" style="color:red; font-size:20px;font-weight: bold;"> Clique aqui e veja como voc&ecirc; poder&aacute; aumentar seus rendimentos em at&eacute; &#36;100, &#36;1.000 d&oacute;lares por dia, utilizando uma estrat&eacute;gia de crescimento na TrafficMonsoon</a>
	</div>
	<br><br><br>
	<div id="rede_sociais">
			<div id="anuncio" style="float:left;">	
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Comudade -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:250px"
					 data-ad-client="ca-pub-2025377467503276"
					 data-ad-slot="1441103642"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<div id="anuncio" style="float:right;">	
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- Comudade -->
				<ins class="adsbygoogle"
					 style="display:inline-block;width:300px;height:250px"
					 data-ad-client="ca-pub-2025377467503276"
					 data-ad-slot="1441103642"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<table>
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
		  </div> 

    <div class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-6">
					<div style="float:left;width:40%;">
						<span>
							&copy; Todos Direitos Reservados: <a href="../index.php" title="P&aacute;gina Inicial">COMUNIDADE MULTIN&Iacute;NIVEL</a> 
						</span> 
						<span>
							<i>O in&iacute;cio do seu sucesso est&aacute; em nossa uni&atilde;o !!!</i><br>
							<i>Juntos Somos Mais Fortes !!!</i>
						</span>
					</div>
					<div style="float:right;width:50%;">
                    <ul class="social">
                        <li><a href="https://www.facebook.com/ComunidadeMultiNivel" class="fa fa-facebook" title="P&aacute;gina no Facebook Oficial da Comunidade MultiN&iacute;vel" target="_blank"></a></li>
                        <li><a href="http://goo.gl/4zDgYr" class="fa  fa-youtube-play" title="Canal do YOUTUBE Oficial da Comunidade MultiN&iacute;vel" target="_blank"></a></li>
                        <li><a href="../forum/trafficmonsoon_tutoriais.php" title="Acesse o F&oacute;rum da Comunidade MultiN&iacute;vel" target="_blank" ><img src="../adm_clientes/img/logo_forum_comunidademultinivel.png" alt="" height="40"></a></li>
                        <li><a href="https://www.facebook.com/groups/simuladortalkfusion/" title="Acesse o grupo no Facebook da Comunidade MultiN&iacute;vel" target="_blank"><img src="../adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg" alt="" height="100" width="300"></a></li> 
                    </ul>
					</div>
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /.site-footer -->

    
    <script src="js/vendor/jquery-1.10.1.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.1.min.js"><\/script>')</script>
    <script src="js/jquery.easing-1.3.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <!-- templatemo 401 sprint -->



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
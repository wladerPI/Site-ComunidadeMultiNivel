<?php 
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php"); 
	header("Content-Type: text/html; charset=ISO-8859-1",true);
 
	$sql = $con->prepare("SELECT * FROM $tabela2 WHERE ID = '1'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]><html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><![endif]-->
    <title>TrafficMonsoon Como Funciona e como ganhar dinheiro com publicidades, umas das maiores empresas de PTCs do mundo, Comunidade MultiN&iacute;vel </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="O TrafficMonsoon &eacute; uma mistura de AutoSurf (Troca de Tr&aacute;fego) e PTC (Pago por Clique). O site foi considerado o site destaque desde 2015 e possui &oacute;timas rentabilidades com publicidades. Em termos simples, a empresa ganha dinheiro vendendo diferentes formas de an&uacute;ncios na internet; os anunciantes faturam com membros cadastrados que visitam o site diariamente e clicam em seus an&uacute;ncios; por fim os membros cadastrados ganham por clicar nesses an&uacute;ncios e visualizarem, seja por 5 segundos, 15, 30 ou 60 segundos..  ">
	<META NAME="keywords" CONTENT="Como Funciona TrafficMonsoon, empresas de PTCs, melhores equipe de PTC, empresas de publicidade, ganhar dinheiro com PTC, ganhar dinheiro no MMN, TrafficMonsoon funciona, TrafficMonsoon piramide financeira">
	
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
        </div> <!-- /.site-header -->
    </div> <!-- /#front -->

    
    <?php include("topo.php"); ?>
	
 	<div id="menu" class="col-md-12" >
		<ul>
            <li><a href="equipe">A equipe</a></li> |
			<li><a href="empresa">A Empresa</a></li> |
            <li><a href="como-funciona">Como Funciona</a></li> |
			<li><a href="produtos">Produtos</a></li> |
			<li><a href="como-ganhar-mais-dinheiro">Como Ganhar +Dinheiro</a></li> |
			<li><a href="../forum/trafficmonsoon_tutoriais.php" title="Tire suas d&uacute;vidas no f&oacute;rum da Comunidade MultiN&iacute;vel" target="_blank">F&Oacute;RUM</a></li> |
            <li><a href="contato">Contato</a></li>  
        </ul>                
	</div>
	<br>
    <div id="services" class="content-section">
		
		
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
		  
		  
        <div class="container"> 
            <div class="row"> 
                <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Como Funciona a TrafficMonsoon</h1>
                </div> <!-- /.col-md-12 -->

<p> Muitas pessoas falam, principalmente nas redes sociais, pessoas ganhando muito dinheiro, mas afinal, o que &eacute; a Trafficmonsoon? Como funciona? </p>		
<p> O TrafficMonsoon &eacute; uma mistura de AutoSurf (Troca de Tr&aacute;fego) e PTC (Pago por Clique). O site foi considerado o site destaque desde 2015 e possui &oacute;timas rentabilidades com publicidades. Em termos simples, a empresa ganha dinheiro vendendo diferentes formas de an&uacute;ncios na internet; os anunciantes faturam com membros cadastrados que visitam o site diariamente e clicam em seus an&uacute;ncios; por fim os membros cadastrados ganham por clicar nesses an&uacute;ncios e visualizarem, seja por 5 segundos, 15, 30 ou 60 segundos. </p>	

				<div style="text-align:center;">	
					<img src="images/trafficmonsoon-rendimento-clique-anuncios-cash-links-dinheiro-comunidade-multinivel.jpg" style="width:500px;" > 
				</div>
<p> O site entrou em funcionamento em Outubro de 2014. Seu presidente &eacute; o Charles Scoville, conhecido profissionalmente no ramo de publicidade na internet, a empresa &eacute; sediada nos EUA. </p>	
<p> Todos os dias, milhares de pessoas acessam o site e clicam em an&uacute;ncios para ganharem dinheiro por fazerem apenas isso. </p>	
<p> Esse tipo de trabalho n&atilde;o &eacute; novidade, pois j&aacute; existem sites famosos no ramo de PTC que j&aacute; atuam h&aacute; mais de 15 anos, muitos como Neobux, Clixsense...etc entre outros. Por&eacute;m o grande diferencial da Trafficmonsson &eacute; que ela disponibiliza a oportunidade de obtermos maiores rendimentos em um prazo de tempo menor e a cada ADPACK(Pacote de publicidade) que compramos, temos um compartilhamento de lucro com a empresa e ainda os membros podem fazer saques a partir de no m&iacute;nimo &#36;2,00 d&oacute;lares, sendo que conseguem esse valor de imediato ap&oacute;s a solicita&ccedil;&atilde;o de saque. </p>	
<p> Membros ativos obt&ecirc;m lucros maiores por investirem em servi&ccedil;os que o site oferece, como por exemplo os AdPack(Pacote de publicidade), onde com um investimento de &#36;50,00 na compra de 1 pacote, o membro tem um retorno de 110&#37; em dinheiro, al&eacute;m de outros benef&iacute;cios. Existem pessoas que com esse servi&ccedil;o faturam &#36;10, &#36;100, &#36;300 d&oacute;lares por dia. Existem membros ao redor do mundo que j&aacute; faturam cerca de &#36;2.000 d&oacute;lares por dia (isso mesmo, &#36;2.000 d&oacute;lares ao dia). </p>	
				<div style="text-align:center;">	
					<img src="images/trafficmonsoon-renda-extra-ganhe-dinheiro-na-internert-comunidade-multinivel.jpg" style="width:500px;" > 
				</div>
<p> Al&eacute;m de todos os benef&iacute;cios que a empresa de publicidade(PTC) Trafficmonsson oferece para voc&ecirc;, a equipe da Comunidade MultiN&iacute;vel faz com que essa oportunidade seja ainda melhor. </p>	
<p> Voc&ecirc; sendo indicado atrav&eacute;s do link de indica&ccedil;&atilde;o da pr&oacute;pria Comunidade MultiN&iacute;vel, voc&ecirc; ir&aacute; fazer parte das promo&ccedil;&oacute;es da Comunidade MultiN&iacute;vel, podendo assim ser FINANCIADO com os AdPack(Pacote de publicidade) com compartilhamento de lucro da empresa, cada ADPACK custar&aacute; &#36;50,00 d&oacute;lares que a pr&oacute;pria Comunidade ir&aacute; FINANCIAR para voc&ecirc;, o objetivo da Comunidade &eacute; ajudar e facilitar o crescimento do seu rendimento, pois 100&#37; de todas as comiss&otilde;es que voc&ecirc; gerar para a Comunidade na empresa Trafficmonsson ser&atilde;o remuneradas para voc&ecirc;. </p>	
<p style="color:blue;font:18px bold;text-align:center;"> Veja abaixo, o quanto os ADPACKS com compartilhamento de lucro podem ser rent&aacute;veis para voc&ecirc; tamb&eacute;m. </p>	
<div style="text-align:center;">	
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
    <img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
</div>            
			<div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:15px;">Pacotes de Publicidades com compartilhamento de lucro </h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row --> 
                <div class="col-md-3 col-sm-6">
                  <div class="product-item">
                        <div class="item-thumb">
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="como-ganhar-mais-dinheiro" class="view-detail">Saiba Mais</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product1.png" alt="1 AdPack lhe proporciona">
                        </div> <!-- /.item-thumb -->
                    <h3>1 AdPack</h3>
                        <span>Valor da Compra <em class="h3">&#36;50,00</em></span>
                    </div> 
                    <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb"> 
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="como-ganhar-mais-dinheiro" class="view-detail">Saiba Mais</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product2.png" alt="100 AdPacks lhe proporciona">
                        </div> <!-- /.item-thumb -->
                        <h3>100 AdPack</h3>
                        <span>Valor da Compra <em class="h3">&#36;5.000,00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                  <div class="product-item">
                        <div class="item-thumb"> 
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="como-ganhar-mais-dinheiro" class="view-detail">Saiba Mais</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product3.png" alt="1.000 AdPacks lhe proporciona">
                        </div> <!-- /.item-thumb -->
                    <h3>1.000 AdPack</h3>
                        <span>Valor da Compra <em class="h3">&#36;50.000,00</em></span>
                    </div> 
                    <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="product-item">
                        <div class="item-thumb"> 
                            <div class="overlay">
                                <div class="overlay-inner">
                                    <a href="como-ganhar-mais-dinheiro" class="view-detail">Saiba Mais</a>
                                </div>
                            </div> <!-- /.overlay -->
                            <img src="images/products/product4.png" alt="10.000 AdPack lhe proporciona">
                        </div> <!-- /.item-thumb -->
                         <h3>10.000 AdPack</h3>
                        <span>Valor da Compra <em class="h3">&#36;500.000,00</em></span>
                    </div> <!-- /.product-item -->
                </div> <!-- /.col-md-3 -->  

 
				
            </div> <!-- /.row -->
        </div> <!-- /.container -->
	<br><br>		
		<div id="rede_sociais2">
			<div id="anuncio2" style="float:left;">	
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
		</div> 
		
		<br><br><br><br><br>	
		
    </div> <!-- /#services -->

      

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
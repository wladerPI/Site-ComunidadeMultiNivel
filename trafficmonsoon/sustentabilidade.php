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
    <title>TrafficMonsoon &eacute; sustetavel, sustentabilidade, piramide financeira, fraude, legalizada, objetivo , estrat&eacute;gias, umas das maiores empresas de PTCs do mundo, Comunidade MultiN&iacute;vel </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="A TrafficMonsoon foi criada com uma miss&atilde;o clara em mente: para prestar servi&ccedil;os de an&uacute;ncios de alta qualidade a pre&ccedil;os acess&iacute;veis, e compartilhar receitas para uma perfeita combina&ccedil;&atilde;o vencedora que vai levar ao sucesso de nossos clientes  ">
	<META NAME="keywords" CONTENT="sustetavel, sustentabilidade, piramide financeira, fraude, legalizada, Como Funciona TrafficMonsoon, empresas de PTCs, melhores equipe de PTC, empresas de publicidade, ganhar dinheiro com PTC, ganhar dinheiro no MMN, TrafficMonsoon funciona, TrafficMonsoon piramide financeira">
	
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
						<a href="../solicitar_senha" title="esqueceu sua senha" style="color:#FFF;float:right;font-size:15px;"> Esqueceu sua Senha ? </a> 
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
                    <h1 class="section-title" style="font-size:20px;">Traffic Monsoon &eacute; Sustent&aacute;vel? Quanto tempo vai durar?</h1>
                </div> <!-- /.col-md-12 -->
				 

<p> Qualquer neg&oacute;cio tem o seus riscos e eu n&atilde;o lhe posso dar garantias de nada no que toca &aacute; longevidade da companhia, a &uacute;nica pessoa que o pode fazer &eacute; o Charles Scoville, dono da TrafficMonsoon. </p>
<p> No entanto existem alguns pontos importantes que me fazem ver a TrafficMonsoon como um neg&oacute;cio de grande pontencial, com muito futuro e que pode ficar por muitos e muitos anos no mercado! Veja abaixo os pontos primordiais da empresa para manter sua sustentabilidade: </p>
<p> Porque eu acho que a TrafficMonsoon tem sustentabilidade: Pontos que me fazem acreditar nisso! </p>
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Primeiro Ponto - Login Ads e Buy Start Pages</h1>
                </div> <!-- /.col-md-12 -->
<p> Foi preciso percorrer o calend&aacute;rio at&eacute; 2 de Fevereiro de 2017 para ter um espa&ccedil;o de publicidade dispon&iacute;vel no "Login Ads" dentro da TrafficMonsoon. Para quem n&atilde;o sabe, esta &eacute; a publicidade que aparece no site logo que fazemos Login e j&aacute; est&aacute; esgotada at&eacute; 2017. Cada espa&ccedil;o destes custa &#36;35,00 d&oacute;lares por dia! Se contabilizarmos todos os dias de 2016 que faltam, mais todos os de 2017, s&oacute; aqui a companhia j&aacute; arrecadou mais de &#36;15.050 d&oacute;lares de ganhos (35 d&oacute;lares x 430dias)! </p>
<div style="text-align:center;">	
	<img src="images/traffic-monsoon-sustentavel-login-ads-e-buy-start-pages-comunidade-multinivel.png" alt="Acessaando login ads e buy start pages" style="width:800px;border:3px solid #000;" > 
</div>  
<p style="font-weight: bold;"> <a href="produto/buy-login-ads.php" title="Saiba Como Funciona login ads">Saiba mais sobre Login Ads</a></p>
<p style="font-weight: bold;"> <a href="produto/buy-start-pages.php" title="Saiba Como Funciona buy start pages">Saiba mais sobre Buy Start Pages</a></p>
				
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Segundo Ponto - Text Ads</h1>
                </div> <!-- /.col-md-12 -->
<div style="text-align:center;">	
	<img src="images/traffic-monsoon-sustentavel-text-ads-comunidade-multinivel.png" alt="Imagem do Text Ads" style="width:800px;border:3px solid #000;" > 
</div>  
<p> Outra forma da empresa ganhar dinheiro sem ser com a compra de AdPacks dos membros &eacute; atrav&eacute;s dos "Text Ads", ou seja, an&uacute;ncios de texto. Cada pacote destes, custa &#36;10,00 d&oacute;lares e fornece 40 cliques ao membro que o compra. Tendo em conta que a TrafficMonsoon j&aacute; conta com mais de 2 Milh&oacute;es de membros, acredito que este an&uacute;ncios durem apenas algumas horas, o que significa tamb&eacute;m que a empresa est&aacute; recorrentemente aumentando cada vez mais sua produtividade de vendas dos pacotes de "Text Ads" e consequentemente lhe sustentando a empresa! </p>
<p style="font-weight: bold;"> <a href="produto/text-ads.php" title="Saiba Como Funciona Text Ads">Saiba mais sobre Text Ads</a></p>
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Terceiro Ponto - Pacotes de Cr&eacute;ditos de Visualiza&ccedil;&otilde;es.</h1>
                </div> <!-- /.col-md-12 -->
<p> Muitos membros da TrafficMonsoon, realmente est&atilde;o em busca de tr&aacute;fego digital e alguns n&atilde;o tem tempo ou paci&ecirc;ncia de ficar visualizando os an&uacute;ncios de outros membros para ir ganhando Cr&eacute;ditos de Visualiza&ccedil;&otilde;es, por tanto optam por comprar os pacotes de Cr&eacute;ditos de Visualiza&ccedil;&otilde;es que s&atilde;o constantemente comercializado no valor de &#36;5,95 at&eacute; &#36;449,95 d&oacute;lares, sendo que 90&#37; dessas vendas tamb&eacute;m est&atilde;o contabilizados na sustentabilidade da empresa. </p>
<p style="font-weight: bold;"> <a href="produto/creditos_visualizacoes.php" title="Saiba Como Funciona Cr&eacute;ditos de Visualiza&ccedil;&otilde;es">Saiba mais sobre Cr&eacute;ditos de Visualiza&ccedil;&otilde;es </a></p>

				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Quarto Ponto - A Popularidade</h1>
                </div> <!-- /.col-md-12 -->
<div style="text-align:center;">	
	<img src="images/traffic-monsoon-sustentavel-rank-alexa-popularidade-trafego-digital-comunidade-multinivel.png" alt="Imagem do do Alexa RANK" style="width:800px;border:3px solid #000;" > 
</div> 				
<p> Este ponto parece-me l&oacute;gico, um site que est&aacute; atualmente na posi&ccedil;&atilde;o 954&#176; do Alexa &eacute; imposs&iacute;vel n&atilde;o ser rent&aacute;vel. Afinal, qual &eacute; a empresa que n&atilde;o quer divulgar os seus produtos e servi&ccedil;os num site que tem mais de 2 Milh&otilde;es de membros e &eacute; acessado por dezenas de milhares por hora? J&aacute; imaginou as parcerias que a TrafficMonsson pode vir a fazer com grandes marcas? </p>
<p> Hoje, arranjar um espa&ccedil;o publicit&aacute;rio na TrafficMonsoon j&aacute; &eacute; uma excelente op&ccedil;&atilde;o para qualquer empresa, que por estarem a fazer mais vendas, voltar&atilde;o a comprar publicidade na TrafficMonsoon e assim sucessivamente, dando logicamente mais lucro e sustentabilidade a empresa. </p>
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Quinto Ponto - Os AdPacks com compartilhamento de lucro</h1>
                </div> <!-- /.col-md-12 -->
<div style="text-align:center;">	
	<img src="images/TrafficMonsoon-rendimentos-adpacks-por-hora-e-verdade-e-real-comunidade-multinivel.jpg" alt="Imagem rendimento de adpacks por hora" style="width:800px;border:3px solid #000;" > 
</div>
<p> Este &eacute; o ponto que tr&aacute;s mais pessoas para o neg&oacute;cio, mas tamb&eacute;m &eacute; aquele que deixa algumas pessoas com d&uacute;vidas no que toca &agrave; sustentabilidade da TrafficMonsoon! &Eacute; atrav&eacute;s deste ponto que podemos investir no neg&oacute;cio, comprando AdPacks, e ter um retorno de 110&#37;. </p>
<p style="font-weight: bold;"> <a href="produto/adPack-com-compartilhamento-de-lucro.php" title="Saiba Como Funciona AdPacks com compartilhamento de lucro">Saiba mais sobre AdPacks com compartilhamento de lucro  </a></p>
<p> Mesmo com esta caracter&iacute;stica eu acredito na sustentabilidade da TrafficMonsoon e passo a explicar porque. </p> 
<p> A primeira coisa que voc&ecirc; precisa saber &eacute; que quando est&aacute; comprando um Adpacks, est&aacute; comprando um servi&ccedil;o de publicidade, neste caso est&aacute; comprando tr&aacute;fego para o seu Site/P&aacute;gina/blog, que lhe &eacute; fornecido atrav&eacute;s de diferentes pacotes publicit&aacute;rios (clicks em banners, clicks no site, Cr&eacute;ditos de Visualiza&ccedil;&otilde;es, etc..)</p>
<p> &Eacute; verdade que voc&ecirc; recebe 110&#37; sobre o seu investimento, mas tamb&eacute;m s&oacute; o recebe durante 55 dias, ao final desse per&iacute;odo o seu Adpack expira e j&aacute; n&atilde;o lhe d&aacute; mais retorno algum. Ou seja, por exemplo, se voc&ecirc; comprar 1 Adpack (custa &#36;50,00 d&oacute;lares) ao final de 55 dias voc&ecirc; tem &#36;55,00 d&oacute;lares, concluindo um ganho liquido de &#36;5,00 d&oacute;lares.</p>
<p> Como voc&ecirc; pode perceber n&atilde;o &eacute; um valor muito alto e talvez n&atilde;o seja t&atilde;o rent&aacute;vel assim, certo ? N&Atilde;OOO ERRADO hehe, <b><a href="como-ganhar-mais-dinheiro" title="Saiba como voc&ecirc; pode ganhar muito dinheiro na trafficmonsoon">clique aqui</a></b> e veja essa estrat&eacute;gia de crescimento do seu rendimento, e entenda o quanto pode ser lucrativo para voc&ecirc; tamb&eacute;m.</p>
<p> &Eacute; por esse motivo que os membros optam por reinvestir no neg&oacute;cio, comprando novos Adpacks quando alcan&ccedil;am &#36;50,00 d&oacute;lares no "balance", para assim, conseguirem chegar a um n&uacute;mero mais avultado de Adpacks, que lhes d&ecirc; um retorno di&aacute;rio mais interessante. Isto significa tamb&eacute;m que ap&oacute;s o investimento do membro v&atilde;o passar longos meses at&eacute; que este comece a sacar valores mais altos do que o seu investimento.</p>
<p> Voc&ecirc; imagina quantos membros v&atilde;o comprar Adpacks durante esse per&iacute;odo? Sabe quantos Adpacks s&atilde;o comprados ao dia? Certamente Milhares !!! </p>
<p> E isto diz-nos que h&aacute; mais entrada do que sa&iacute;da de dinheiro! </p>
<p> Ah! e tem outra coisa, para ganhar dinheiro com os AdPacks &eacute; necess&aacute;rio estar qualificado (visualizando 10 an&uacute;ncios ao dia) e eu sinceramente n&atilde;o acredito que todos os membros cumpram esta obriga&ccedil;&atilde;o (por atraso, ou esquecimento, por falta de paci&ecirc;ncia, desist&ecirc;ncia, etc). e por n&atilde;o o fazerem, o dinheiro que poderiam estar ganhando, v&atilde;o sendo acumulados para a empresa!</p>
<p> Estes s&atilde;o os pontos que juntos me fazem acreditar que a TrafficMonsoon assim como outras empresas de PTCs est&aacute; para ficar durante muitos e muitos anos, contudo e como disse acima.</p>
<br>
<a href="como-ganhar-mais-dinheiro" title="Estrat&eacute;gia de crescimento do seu rendimento" style="color:red; font-size:20px;font-weight: bold;"> Clique aqui e veja como voc&ecirc; poder&aacute; aumentar seus rendimentos em at&eacute; &#36;100, &#36;1.000 d&oacute;lares por dia, utilizando uma estrat&eacute;gia de crescimento na TrafficMonsoon</a>


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
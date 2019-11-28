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
    <title>TrafficMonsoon A Empresa, objetivo, estrat&eacute;gias, umas das maiores empresas de PTCs do mundo, Comunidade MultiN&iacute;vel </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="A TrafficMonsoon foi criada com uma miss&atilde;o clara em mente: para prestar servi&ccedil;os de an&uacute;ncios de alta qualidade a pre&ccedil;os acess&iacute;veis, e compartilhar receitas para uma perfeita combina&ccedil;&atilde;o vencedora que vai levar ao sucesso de nossos clientes  ">
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
                    <h1 class="section-title" style="font-size:20px;">Objetivo</h1>
                </div> <!-- /.col-md-12 -->
				<div style="text-align:center;">	
					<img src="images/TrafficMonsoon-Evento-a-empresa-palestra-comunidade-multinivel.jpg" style="width:300px;height;430px;" > 
				</div>

<p> A TrafficMonsoon foi criada com uma miss&atilde;o clara em mente: para prestar servi&ccedil;os de an&uacute;ncios de alta qualidade a pre&ccedil;os acess&iacute;veis, e compartilhar receitas para uma perfeita combina&ccedil;&atilde;o vencedora que vai levar ao sucesso de nossos clientes.</p>
<p> Cada um de n&oacute;s j&aacute; passou por um caminho dif&iacute;cil, e enfrentou lutas e desafios no nosso caminho. Cada uma dessas experi&ecirc;ncias deram-nos for&ccedil;a e desejo de oferecer solu&ccedil;&otilde;es para outras pessoas que possam estar lutando para obter servi&ccedil;os de qualidade e torn&aacute;-lo mais f&aacute;cil para as pessoas a finalmente ganhar dinheiro online.</p>
				<div style="text-align:center;">	
					<img src="images/Traffic-Monsoon-Charity-Unicef-evento-palestra-premiacao-comunidade-multinivel-cheque.png" style="width:300px;height;430px;"> 
				</div>
<p> Aspiramos a ir al&eacute;m dos padr&otilde;es estabelecidos por outros e avan&ccedil;ar para a frente para elevar o n&iacute;vel de excel&ecirc;ncia. Acreditamos que a verdadeira prosperidade e sucesso pode ser realizado como nossa comunidade compartilhando seus objetivos e se concentra em esfor&ccedil;os para trazer esses serv&ccedil;os para as m&atilde;os daqueles que mais precisam deles. </p>
<p> Se tivermos sucesso em nossa miss&atilde;o, consequentemente os servi&ccedil;os que oferecemos ter&aacute; cada vez  mais compradores, devido &agrave; qualidade e capacidade de entregar grandes quantidades de tr&aacute;fego, o que gerar&aacute; compartilhamento de receitas com aqueles que participam no programa. </p>
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Hist&oacute;ria da empresa</h1>
                </div> <!-- /.col-md-12 -->
<p> Em 2014 decidimos abrir um servi&ccedil;o de publicidade com uma rela&ccedil;&atilde;o de compartilhamento de lucro com os nossos anunciantes, porque tivemos a vis&atilde;o das necessidades destes servi&ccedil;os podem atender na ind&uacute;stria de marketing na internet. N&oacute;s aprendemos com a experi&ecirc;ncia qu&atilde;o dif&iacute;cil pode ser a de encontrar servi&ccedil;os de an&uacute;ncios online de qualidade, mas sempre teve grande motiva&ccedil;&atilde;o para aprender, explorar e experimentar novos servi&ccedil;os de publicidade para expandir nossos sucessos online. A partir deste fundo, temos o conhecimento e experi&ecirc;ncia para prestar servi&ccedil;os de publicidade n&iacute;vel superior para voc&ecirc;. </p>
<p> Nossa equipe combinou experi&ecirc;ncia em: Atendimento ao Cliente, Design Gr&aacute;fico, Programa&ccedil;&atilde;o, Internet Marketing, Gest&atilde;o de Neg&oacute;cios, Gest&atilde;o de Banco de Dados, Internet Security e Network Marketing. </p>				
<p> Em 2008 assistimos a um aumento na crise econ&ocirc;mica global. Centenas de milhares, se n&atilde;o milh&otilde;es, de pessoas em todo o mundo de hoje est&atilde;o &agrave; procura de uma maneira de fazer mais dinheiro para substituir ou complementar uma renda a tempo completo. Pessoas de todas as esferas da vida foram confrontados por um novo desafio para a gera&ccedil;&atilde;o de renda, e com ele veio v&aacute;rias novas oportunidades para participar nas estruturas da comiss&atilde;o de refer&ecirc;ncia com base. A oportunidade de ganhar uma renda adicional ou renda a tempo inteiro on-line j&aacute; foi realizado por v&aacute;rios milhares de pessoas ao redor do mundo. </p>				
<p> Expans&atilde;o de gera&ccedil;&atilde;o de renda na internet de qualquer um dentro de todas as oportunidades de renda com base de refer&ecirc;ncia requer foco e desenvolvimento da habilidade de aumentar a sua exposi&ccedil;&atilde;o internet. Atingir o mercado-alvo de pessoas que procuram oportunidades de neg&oacute;cio baseado em casa, ferramentas e recursos pode representar como uma grande dificuldade. Al&eacute;m disso, continuamente pagando para mais produtos, ferramentas e servi&ccedil;os de publicidade sem ganhar um centavo pode ser extremamente frustrante. TrafficMonsoon foi constru&iacute;do para tornar mais f&aacute;cil para as suas ofertas para alcan&ccedil;ar a comunidade de renda na internet, enquanto ao mesmo tempo dar-lhe oportunidade de come&ccedil;ar a ganhar, basta participar de nossos servi&ccedil;os de troca de tr&aacute;fego. </p>				
				<div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Dr Amin Forati &eacute; o CFO da TrafficMonsoon</h1>
                </div> <!-- /.col-md-12 -->
				<div style="text-align:center;">	
					<img src="images/dr-amin-forati-e-o-cfo-do-TrafficMonsoon-comunidade-multinivel.jpg" style="width:300px;height;430px;" > 
				</div>
<p> Para muitos n&atilde;o quer dizer nada, mas vou falar aqui um pouco de quem &eacute; o Dr Amin Forati. </p>
<p> Nasceu em 1969, e recebeu o doutorado em medicina em 1995 na universidade de ci&ecirc;ncia m&eacute;dica de Shiraz.
Foi auditor l&iacute;der em sistemas de gest&atilde;o de qualidade ISO 9000 e apontado como o mais jovem conselheiro do sector industrial em 1998.
Tamb&eacute;m nesse ano trabalhou como consultor de uma empresa financeira e foi nomeado secret&aacute;rio geral da C&acirc;mara de Com&eacute;rcio.
Em 1999 estabeleceu o grupo D&B, com sede nos Emirados &Aacute;rabes e tornou-se num dos maiores conglomerados financeiro e de com&eacute;rcio mundial.
Em 2007 recebeu o doutoramento em economia e gest&atilde;o empresarial da universidade de Oxford e foi nomeado conselheiro econ&oacute;mico para as companhias de petr&oacute;leo.
Em 2008 foi nomeado consultor s&eacute;nior para o programa de desenvolvimento EABAFF EU-Arab States Economic Interest Grouping
 </p>
<p>  &Eacute; Embaixador de Malta e tem uma enorme experi&ecirc;ncia com a Banca e Sistemas Financeiros. </p>
<p> Para al&eacute;m do seu impressionante curr&iacute;culo, &eacute; descrito como uma pessoa de um car&aacute;cter extraordin&aacute;rio, &iacute;ntegro e que gosta de ajudar os desprivilegiados e dar uma igual chance de crescimento, independentemente da sua situa&ccedil;&atilde;o. </p>
<p>Ele &eacute; o nosso CFO no TrafficMonsoon</p>
<p>O que &eacute; isso de Chief Financial Officer?</p>
<p> &Eacute; simplesmente o maior respons&aacute;vel pelo controlo financeiro e de planeamento de uma empresa ou projecto. Tem a seu cargo todas as fun&ccedil;&otilde;es de contabilidade, e pelas provas que este senhor j&aacute; deu ao mundo, a parte financeira do TM est&aacute; em muitos boas m&atilde;os. </p>
            </div> <!-- /.row -->
        </div> <!-- /.container -->
		
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
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
    <title>TrafficMonsoon Como Funciona os ADPACK, Como Ganhar Muito Dinheiro na TrafficMonsoon, estrat&eacute;gias Comunidade MultiN&iacute;vel </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="TrafficMonsoon faz parte do projeto da Comunidade MultIN&iacute;vel, essa empresa de publicidade PTC foi adaptada na ferramenta de trabalho Dicas Di&aacute;rias aonde sua simples participa&ccedil;&atilde;o gratuitamente ir&aacute; fazer com que seus rendimentos financeiros aumentem, pois toda a renda de comiss&otilde;es que voc&ecirc; gerar para Comunidade MultiN&iacute;vel ser&atilde;o remuneradas para voc&ecirc;.  ">
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
			<li><a href="../forum/trafficmonsoon_tutoriais.php" title="Tire suas d&uacute;vidas no f&oacute;rum da Comunidade MultiN&iacute;vel" target="_blank" >F&Oacute;RUM</a></li> |
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
                    <h1 class="section-title" style="font-size:20px;">Como Ganhar MUITO Dinheiro na TrafficMonsoon</h1>
                </div> <!-- /.col-md-12 -->
<div style="text-align:center;">	
	<img src="images/adpack-trafficmonsoon-como-funcioa-como-ganhar-dinheiro-comunidade-multinivel.jpg" alt="Como Ganhar Mais Dinheiro na TrafficMonsoon" style="width:800px;border:3px solid #000;" > 
</div>
<p> Se voc&ecirc; &eacute; uma pessoa com grande vis&atilde;o de negocio e est&aacute; determinado a conquistar grandes resultados financeiros para sua vida, continue lendo esse artigo, pois voc&ecirc; ir&aacute; conhecer agora, uma estrat&eacute;gia de trabalho que est&aacute; impulsionando o crescimento do rendimento dos maiores empreendedores da empresa de publicidade TrafficMonsoon.  </p> 
<p> A TrafficMonsoon &eacute; uma empresa superior a outros sites de PTCs(publicidades), n&atilde;o oferece nenhum tipo de ganho diferente na compra de pacotes. O &uacute;nico pacote que tem um ganho diferenciado &eacute; o ADPACK com compartilhamento de lucro da empresa, vou explicar como se pode gerar uma renda de at&eacute; &#36;100 d&oacute;lares por dia com ele. </p>				 
<p> Os AdPacks w/Sharing (Com partilha de lucro) Oferece; </p>				 
<b> - 20 Cr&eacute;ditos de Pay Per Click.  </b> <br>				 
<b> - 1000 Cr&eacute;ditos de Compartilhamento de visitas.  </b> <br>
<b> - 1 posicionamento na partilha de lucros </b> <br>
<p> E cada ADPACK ir&aacute; lhe custar &#36;50.00 d&oacute;lares. </p>
<p> Quando voc&ecirc; compra um pacote, al&eacute;m dos cr&eacute;ditos de publicidade, voc&ecirc; receber&aacute; uma m&eacute;dia de &#36;1,00 d&oacute;lar por dia, por ADPACK adquirido e cada ADPACK ir&aacute; render todos os dias para voc&ecirc; at&eacute; que chegue totalizar um lucro de &#36;55.00 d&oacute;lares por ADPACK adquirido. </p>
<br>
<b> Agora, vamos falar em n&uacute;meros! </b>
<br>
<p> - Se voc&ecirc; comprar 5 ADPACKs, voc&ecirc; ir&aacute; pagar &#36;50x5 = &#36;250,00 eles ir&atilde;o lhe gerar &#36;5.00 por dia X 55 dias = &#36;275.00 voc&ecirc; ter&aacute; um lucro liquido de &#36;25.00 d&oacute;lares (+100 cr&eacute;ditos de PayPer Click + 5.000 Cr&eacute;ditos de visualiza&ccedil;&otilde;es) </p>
<p> - Se voc&ecirc; comprar 10 ADPACKs, voc&ecirc; ir&aacute; pagar &#36;50x10 = &#36;500,00 eles ir&atilde;o lhe gerar &#36;10.00 por dia X 55 dias = &#36;550.00 voc&ecirc; ter&aacute; um lucro liquido de &#36;50.00 d&oacute;lares (+200 cr&eacute;ditos de PayPer Click + 10.000 Cr&eacute;ditos de visualiza&ccedil;&otilde;es)</p>
<p> - Se voc&ecirc; comprar 100 ADPACKs, voc&ecirc; ir&aacute; pagar &#36;50x100 = &#36;5.000,00 eles ir&atilde;o lhe gerar &#36;100.00 por dia X 55 dias = &#36;5.500.00 voc&ecirc; ter&aacute; um lucro liquido de &#36;500.00 d&oacute;lares (+2.000 cr&eacute;ditos de PayPer Click + 100.000 Cr&eacute;ditos de visualiza&ccedil;&otilde;es)</p>
<div style="text-align:center;">	
	<img src="images/traffic-monsoon-rendimento-diario-adpack-simulador-comunidade-multinivel.jpg" alt="Simulador de Rendimentos dos ADPACKS da TrafficMonsoon" style="width:1000px;border:3px solid #000;" > 
</div>
<p> Agora que voc&ecirc; entendeu como os ADPACKS com compartilhamento de lucro da empresa TrafficMonsoon funciona, veja esse v&iacute;deo abaixo, e entenda como os membros da TrafficMonsoon est&atilde;o obtendo rendas superiores em at&eacute; &#36;1.000 d&oacute;lares POR DIA de lucro liquido, utilizando uma valiosa estrat&eacute;gia de crescimento dentro da empresa. </p>
<div style="text-align:center;">	
	<iframe class="video" width="750" height="460" src="//www.youtube.com/embed/BfPFMnilsok?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
</div>
<p> <b><a href="../banners/trafficmonsoon_adpack_calculator.xls" title="Baixe a Planilha de Simula&ccedil;&atilde;o, agora mesmo">Clique aqui </a> e baixe essa planilha para voc&ecirc; fazer a simula&ccedil;&atilde;o de renda que voc&ecirc; deseja. </b></p>
<p> Para se cadastrar na empresa TrafficMonsoon e aproveitar todas as promo&ccedil;&otilde;es da Comunidade MultiN&iacute;vel na empresa, acesse seu escrit&oacute;rio virtual da Comunidade e no menu esquerdo clique em "Dicas Di&aacute;rias" e depois em "TrafficMonsoon" veja os v&iacute;deos explicativos e siga o passo a passo de como se cadastrar na empresa TrafficMonsoon CORRETAMENTE. </p>
<p> Se voc&ecirc; ainda n&atilde;o tem um cadastro na Comunidade MultiN&iacute;vel, entre em contato com um de nossos afiliados para se cadastrar atrav&eacute;s de um link de indica&ccedil;&atilde;o da Comunidade, caso voc&ecirc; n&atil;o conhe&ccedil;a nenhum afiliado da Comunidade, entre em contato com a pr&oacute;pria Comunidade que n&oacute;s iremos lhe encaminhar um LINK de cadastro. </p>

				  
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
	  
	<div id="contact" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="section-title" style="font-size:20px;">O seu sucesso est&aacute; em Nossa uni&atilde;o !!!</h2>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row"> 
                <div class="col-md-7 col-sm-6">
                    <div >
					<iframe class="video" width="650" height="460" src="//www.youtube.com/embed/OHUgRBAnufw?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-6">
                    <br><br><br><br><br>
                    <div class="row contact-form">
						<b style="font-size:15px;">Mais importante que a vontade de vencer &eacute; a coragem de come&ccedil;ar.</b>
 
                    </div> <!-- /.contact-form -->
                    
                </div> <!-- /.col-md-6 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#products -->
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
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
    <title>TrafficMonsoon Como Funciona, umas das maiores empresas de PTCs do mundo, Comunidade MultiN&iacute;vel </title> 
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
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon first"></span>
                        <h3>J&aacute; s&atilde;o mais de 3 milh&otilde;es de clientes</h3>
                        <p>O site da TrafficMonsoon j&aacute; alcan&ccedil;ou mais de 1 bilh&atilde;o e meio de acessos at&eacute; o momento. Estamos absolutamente capaz de fornecer-lhe um fluxo maci&ccedil;o de visitantes em um baixo custo e um &oacute;timo retorno. </p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon second"></span>
                        <h3>Entre os 1500 sites mais visitados do mundo</h3>
                        <p>A ferramenta de monitoramento de Tr&aacute;fego e Audi&ecirc;ncia (Alexa Ranking), aponta a incr&iacute;vel credibilidade que o site da TrafficMonsoon nos proporciona. </p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item">
                        <span class="service-icon third"></span>
						<h3> <a href="como-funciona" title="">Melhor site de publicidade(PTC) do mundo </a></h3>
                        <p>A Empresa TrafficMonsoon divide 100% do lucro de vendas de publicidades com seus membros afiliados, com o plano gratuito, basta voc&ecirc; acessar o site da TrafficMonsoon  diariamente, clicar nos an&uacute;cios dispon&iacute;veis e a empresa ir&aacute; dividir 50% das vendas para voc&ecirc; e mais 50% para seu Patrocinador(UP-LINE).</p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
                <div class="col-md-3 col-sm-6">
                    <div class="service-item"> 
						<span class="service-icon fourth"></span>
						<h3><a href="como-ganhar-mais-dinheiro" title="">Uma combina&ccedil;&atilde;o perfeita de publicidade e Participa&ccedil;&atilde;o nos Lucros</a></h3>
                        <p>Adquirindo um pacote de publicidade da empresa TrafficMonsoon no valor de &#36;50,00 d&oacute;lares, al&eacute;m de voc&ecirc; divulgar seu an&uacute;ncio para milhares de pessoas em seu p&uacute;blico-alvo, voc&ecirc; tamb&eacute;m ter&aacute; uma posi&ccedil;&atilde;o de compartilhamento de lucro com a empresa. </p>
                    </div> <!-- /.service-item -->
                </div> <!-- /.col-md-3 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#services -->

     <div id="product-promotion" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Somos a melhor equipe da TrafficMonsoon</h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">
                <div class="col-md-2 col-sm-3">
                    <div class="item-small">
                        <img src="images/como-funciona-trafficmonsoon-piramide-financeira-legalizada-ptc-trafego-digital-comunidade-multinivel.jpg" alt="tr&aacute;fego para sua p&aacute;gina e dinheiro no seu bolso">
                        <h4>TrafficMonsoon </h4> Melhor op&ccedil;&atilde;o para gerar tr&aacute;fego para sua p&aacute;gina, unindo o &uacute;til ao agradavel. Tr&aacute;fego &#43; &#36;&#36;&#36;
                    </div> <!-- /.item-small -->
                </div> <!-- /.col-md-2 -->
                <div class="col-md-8 col-sm-6">
                    <div class="item-large">
                        <iframe width="750" height="480" src="//www.youtube.com/embed/1Qh3iar8RLw?rel=0&amp;controls=0&amp;showinfo=0;&autoplay=0" frameborder="1" allowfullscreen></iframe>  
                        <div class="item-large-content">
                            <div class="item-header">
                                <h2 class="pull-left">Entre para a Equipe da Comunidade MultiN&iacute;vel na TrafficMonsoon e voc&ecirc; tamb&eacute;m poder&aacute; se beneficiar com nossas promo&ccedil;&otilde;es  </h2>
                                
                                <div class="clearfix"></div>
                            </div> <!-- /.item-header -->
<p> A equipe da Comunidade MultiN&iacute;vel &eacute; a melhor equipe do mundo da TrafficMonsoon, pois somos a &uacute;nica equipe que <b>dividimos 100&#37; dos lucros de comiss&otilde;es com todos nossos afiliados</b>, para que possamos ajudar no crescimento do seu rendimento. </p>
<p> Foram elaboradas grandes e inovadoras estrat&eacute;gias de trabalho, para que possamos <b>facilitar ao m&aacute;ximo o crescimento do seu rendimento</b>, a empresa de publicidade TrafficMonsoon foi adaptada em nossa INOVADORA ferramenta de trabalho "Dicas Di&aacute;rias", para que a Comunidade MultiN&iacute;vel possa conquistar um maior rendimento de publicidade e consequentemente <b>FINANCIAR voc&ecirc; e todos seus indicados diretos e indiretos</b> nas empresas na qual foram adaptadas em todo o projeto da Comunidade MultiN&iacute;vel. </p>
<p> (Quer entender melhor, como funciona? cadastre-se na Comunidade MultiN&iacute;vel e veja os v&iacute;deos e artigos explicativos dentro de seu escrit&oacute;rio virtual, caso voc&ecirc; n&atilde;o tenha um link de indica&ccedil;&atilde;o para se cadastrar na Comunidade MultiN&iacute;vel, entre em contato com a Comunidade, que iremos lhe encaminhar um link de cadastro).</p>
<p style="color:blue;font:18px bold;"> Veja abaixo os pacotes de publicidades com compartilhamento de lucro da empresa TrafficMonsoon, que a equipe da Comunidade MultiN&iacute;vel estar&aacute; FINANCIANDO para todos os afiliados da Comunidade MultiN&iacute;vel na TrafficMonsoon (CADASTRE-SE AGORA MESMO E APROVEITE ESSA PROMO&Ccedil;&Atilde;O). </p>
<div style="text-align:center;">	
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
	<img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
    <img src="images/seta-verde-icone-icon-comunidade-multinivel-trafficmonsoon.jpg" style="width:100px;height;130px;" >
</div>
                        </div> <!-- /.item-large-content -->
                    </div> <!-- /.item-large -->
                </div> <!-- /.col-md-8 -->
                <div class="col-md-2 col-sm-3">
                    <div class="item-small">
                        <img src="images/sustentabilidade-trafficmonsoon-como-funciona-comunidade-multinivel.jpg" alt="Sustentabilidade da Empresa trafficmonsoon">
                        <h4>Sustent&aacute;vel</h4> <a href="sustentabilidade" title="Como Funciona a Sustentabilidade da empresa trafficmonsoon">Clique aqui </a> e entenda como funciona a sustatabilidade da empresa
                    </div> <!-- /.item-small -->
                </div> <!-- /.col-md-2 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </div> <!-- /#product-promotion -->


    <div id="products" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:15px;">Pacotes de Publicidades com compartilhamento de lucro </h1>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row">
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
			</div>
		</div>
	</div>        
	
	<br><br><br>
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
	
	<br><br><br><br><br><br>
	
    <div id="contact" class="content-section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2 class="section-title" style="font-size:20px;">Acreditamos em seu Potencial</h2>
                </div> <!-- /.col-md-12 -->
            </div> <!-- /.row -->
            <div class="row"> 
                <div class="col-md-6 col-sm-6">
                    <div >
					<iframe class="video" width="550" height="460" src="//www.youtube.com/embed/KJwetY17Gjo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-6 col-sm-6">
                    
                    <div class="row contact-form">
						<p>Existe Tr&ecirc;s tipos de pessoas. Os verdes, amarelados e os vermelhos. Cada um tem sua forma de encarar suas oportunidades e desafios da vida.</p>
						<br>
                       <i style="color:red;"> - Os Vermelhos, falam mal de Tudo e Todos, Nunca est&atilde;o satisfeitos ou positivos com Nada. Enxergam apenas desgra&ccedil;a e defeitos em tudo e todos. </i>
						<br><br>
						<i style="color:#f4c92f;"> - Os Amarelados, o tipo do TALVES, Vou Pensar, um dia desses quem sabe, depois eu vejo ... etc etc etc s&atilde;o pessoas mentalmente acomodadas e sem for&ccedil;a de vontate nem determina&ccedil;&atilde;o para conquistar seus objetivos.</i>
						<br><br>
						<i style="color:green;"> - Os Verdes, s&atilde;o pessoas que acreditam em seus potenciais, vencem adversidades, rompem obst&aacute;culos e insistem em seus conceitos e lutas diariamente, at&eacute; que finalmente chegam ao glorioso sabor da vit&oacute;ria.</i>
						<p style="font-size:40px;">E voc&ecirc;, qual &eacute; seu tipo ? </p>
 
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
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
    <title>TrafficMonsoon A equipe da Comunidade MultiN&iacute;vel </title> 
	<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />  
	<META NAME="description" CONTENT="A equipe da Comunidade MultiN&iacute;vel constantemente vem aprimorando o sistema e as estrat&eacute;gias de trabalho para sempre estar ajudando e facilitando ao m&aacute;ximo o crescimento do seu rendimento dentro das empresas de publicidades(PTC) e das empresas de Marketing MultiN&iacute;vel(MMN) LEGALIZADAS.  ">
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
                    <h1 class="section-title" style="font-size:20px;">A Equipe da Comunidade MULTIN&Iacute;vel</h1>
                </div> <!-- /.col-md-12 -->
<p> A equipe da Comunidade MultiN&iacute;vel constantemente vem aprimorando o sistema e as estrat&eacute;gias de trabalho para sempre estar ajudando e facilitando ao m&aacute;ximo o crescimento do seu rendimento dentro das empresas de publicidades(PTC) e das empresas de Marketing MultiN&iacute;vel(MMN) LEGALIZADAS. </p>
<p> Orgulhosamente temos o prazer de sermos a primeira e &uacute;nica equipe do mundo, a oferecer uma nova oportunidade de trabalho para voc&ecirc;, foi desenvolvida uma ferramenta de trabalho que est&aacute; dispon&iacute;vel GRATUITAMENTE para todos os afiliados da Comunidade MultiN&iacute;vel no escrit&oacute;rio virtual da Comunidade e essa ferramenta est&aacute; facilitando e mudando o conceito de trabalho das pessoas, ela &eacute; uma esp&eacute;cie de "FINANCIADORA SUSTENTADA PELOS PR&Oacute;PRIOS PARTICIPANTES", isso mesmo!!! N&atilde;o se trata de nenhum investidor que financia as pessoas e depois que acaba o dinheiro, deixa os restantes das pessoas a ver navios, essa ferramenta de trabalho ir&aacute; FINANCIAR voc&ecirc; e todos seus indicados diretos e indiretos para SEMPRE, pois ela &eacute; sustenta pelos pr&oacute;prios participantes. Quanto mais pessoas participando mais pessoas sendo financiadas. E &eacute; tudooo gratuitoooo !!! </p>
<p> Voc&ecirc; quer saber mais sobre essa ferramenta de trabalho? </p>
<p> Cadastre-se no site da Comunidade MultiN&iacute;vel atrav&eacute;s da indica&ccedil;&atilde;o de um de nossos afiliados(a), caso voc&ecirc; n&atilde;o tenha um link de cadastro, entre em contato com a pr&oacute;pria Comunidade, que iremos passar um LINK de cadastro para voc&ecirc;. E depois do seu cadastro, acesse seu escrit&oacute;rio virtual da Comunidade e no menu esquerdo clique em "Dicas Di&aacute;rias" veja os links, v&iacute;deos e artigos explicativos com muita ATEN&Ccedil;&Atilde;O, para entender todos os procedimentos. </p>
<br>
<b> Somos Quem Queremos Ser! </b> <br>
<p> Talvez voc&ecirc; 'ainda' pode n&atilde;o ter reparado, mas voc&ecirc;, assim como dezenas e centenas de afiliados da Comunidade MultiN&iacute;vel temos algo em comum, 'ainda' n&atilde;o somos grandes lideres nesse mercado, 'ainda' n&atilde;o temos grandes redes de afiliados para que possamos conquistar grandes resultados em apenas 2 ou 3 meses de trabalho, mas o que realmente diferencia as pessoas &eacute; o quanto 'ainda', elas est&atilde;o disposta a persistir e se empenhar em nossa constante batalha para batermos nossas metas e conquistarmos nossos objetivos, para finalmente abra&ccedil;ar nosso futuro e se tornarmos, o que 'ainda' n&atilde;o somos, mas sim quem queremos ser. </p>
 
				 
				  <div class="col-md-12 text-center">
                    <h1 class="section-title" style="font-size:20px;">Promo&Ccedil;&otilde;es da Comunidade MULTIN&Iacute;vel na TrafficMonsoon</h1>
                </div> <!-- /.col-md-12 -->
				
<p> Voc&ecirc; sendo indicado atrav&eacute;s do link de indica&ccedil;&atilde;o da pr&oacute;pria Comunidade MultiN&iacute;vel na empresa Trafficmonsson, voc&ecirc; ir&aacute; fazer parte das promo&ccedil;&otilde;es da Comunidade MultiN&iacute;vel, podendo assim ser FINANCIADO com os AdPack(Pacote de publicidade) com compartilhamento de lucro da empresa, cada ADPACK custar&aacute; &#36;50,00 d&oacute;lares que a pr&oacute;pria Comunidade ir&aacute; FINANCIAR para voc&ecirc;, o objetivo da Comunidade &eacute; ajudar e facilitar o crescimento do seu rendimento, pois 100&#37; de todas as comiss&otilde;es que voc&ecirc; gerar para a Comunidade na empresa Trafficmonsson ser&aacute; remuneradas para voc&ecirc;. </p>
 	
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

	<div style="text-align:center;">	
		<a href="como-funciona"  title="Entenda Como Funciona a empresa Trafficmonsson" ><img  src="images/como-funciona-Trafficmonsson-ganhar-dinheiro-na-internet-comunidade-multinivel.png" alt="Entenda Como Funciona a empresa Trafficmonsson" style="width:40%;border:3px solid #000;" >  </a>
	</div> 
      
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
					<iframe class="video" width="650" height="460" src="//www.youtube.com/embed/yiT1G8V732U?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div> <!-- /.col-md-6 -->
                <div class="col-md-4 col-sm-6">
                    <br><br><br><br><br>
                    <div class="row contact-form">
						<b style="font-size:15px;">Tente uma, duas, tr&ecirc;s vezes e se poss&iacute;vel tente a quarta, a quinta e quantas vezes for necess&aacute;rio. S&oacute; n&atilde;o desista nas primeiras tentativas, a persist&ecirc;ncia &eacute; amiga da conquista. E se voc&ecirc; quer chegar aonde a maioria n&atilde;o chega, fa&ccedil;a aquilo que a maioria n&atilde;o faz.</b>
 
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
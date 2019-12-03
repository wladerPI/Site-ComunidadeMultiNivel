<?php
session_start(); 
include("../../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../../../index.php';</script>");
	exit;
}
 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS; 		
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




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | Quais s&atilde;o os valores dos pacotes da TALK FUSION</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php  include("topo.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php  include("../../menue_art.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li class="active"><a href="../../tutoriais_talk.php" title="Veja outros Atigos">ARTIGOS </a></li>
						<li class="active">Valores Dos Pacotes da TALK FUSION</li>
                    </ol>
                </section> 
                <!-- Main content -->
                <section class="content">
				
 <div style="text-align:center;width:100%;">				
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pagina-centro-clientes -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="3776313246"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> 	


<!-- centro -->		
<div class="box-header">
	<h3 class="box-title">Quais s&atilde;o os valores dos pacotes da TALK FUSION  ?</h3>
</div><!-- /.box-header -->			
<p>A TALK FUSION possui 4 pacotes dispon&iacute;veis</p>
<img src="../../img/valores_dos_pacotes_talkfusion.jpg" width="800" height="300" alt="Valores Dos Pacotes Da TALK FUSION"   />
<br>
<div class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i> 
    <b>Lembrando que na hora da compra, somar&aacute;; </b> <br>
	<b>- o Valor do Ades&atilde;o de $30,00 d&oacute;lares </b> <br>
	<b>+ o valor do pacote escolhido  </b> <br>
	<b>+ o valor da primeira mensalidade   </b> <br>
	<b>pequenas taxas, como, taxa administrativas e imposto de c&acirc;mbios internacionais </b> <br>
	<b>sempre bom mandar de 10,00 a 30,00 Reais a mais, para n&atilde;o ter problemas.</b> 
</div>  

<br>
<div class="callout callout-info">
	<h4><b style="color:red;">Pacote INICIANTE (Starter Package)</b></h4>
    - Valor total de cada pacote INICINTE: <b style="color:red;font-size:30px;">$175,00 d&oacute;lares</b>, aproximadamente <b style="color:red;font-size:30px;"> 400,00 Reais</b><br>
	- Valor da mensalidade: $20,00 d&oacute;lares, aproximadamente 40,00 Reais<br><br>
	- Produtos Adquiridos <br>
	<b><a href="../../../talkfusion/videos-email-talkfusion" title="Sobre Video Email">Video Email: </a> 1 usu&aacute;rio do Video Email  
</div>
<hr> 

<div class="callout callout-info">
	<h4><b style="color:red;">Pacote EXECUTIVO (Executive Package)</b></h4>
    - Valor total de cada pacote EXECUTIVO: <b style="color:red;font-size:30px;">$315,00 d&oacute;lares</b>, aproximadamente <b style="color:red;font-size:30px;">630,00 Reais</b><br>
	- Valor da mensalidade: $35,00 d&oacute;lares, aproximadamente 70,00 Reais<br><br>
	- Produtos Adquiridos <br>
	<b><a href="../../../talkfusion/connect-talkfusion" title="Sobre Connect">Connect: </a></b> Excelente para reuni&otilde;es com 25 participantes e 5 apresentadores.<br>
	<b><a href="../../../talkfusion/videos-email-talkfusion" title="Sobre Video Email">Video Email: </a></b>5 usu&aacute;rios do Video Email, 1000+ modelos e 1 modelo personalizados.<br>
	<b><a href="../../../talkfusion/videos-newsletters-talkfusion" title="Sobre Video Newsletters">Video Newsletters: </a></b> 600+ modelos. <br>
	<b><a href="../../../talkfusion/fusion-on-the-go-talkfusion" title="Sobre Fusion On the Go">Fusion On the Go </a></b><br>
	<b><a href="../../../talkfusion/assinatura-eletronica-talkfusion" title="Sobre E-Subscription Forms">E-Subscription Forms </a></b><br>
	<b><a href="../../../talkfusion/video-auto-resposta-talkfusion" title="Sobre Video Auto Responders">Video Auto Responders: </a></b> Etiqueta privada<br>
	<b><a href="../../../talkfusion/fusion-wall-talkfusion" title="Sobre Fusion Wall">Fusion Wall </a></b><br>
	<b><a href="../../../talkfusion/video-blog-talkfusion" title="Sobre Video Blog">Video Blog </a></b><br>
	<b><a href="../../../talkfusion/video-share-talkfusion" title="Sobre Video Share">Video Share </a></b><br>
</div>
<hr> 


<div class="callout callout-info">
	<h4><b style="color:red;">Pacote ELITE (Elite Package)</b></h4>
    - Valor total de cada pacote ELITE: <b style="color:red;font-size:30px;">$815,00 d&oacute;lares</b>, aproximadamente <b style="color:red;font-size:30px;">1.630,00 Reais</b><br>
	- Valor da mensalidade: $35,00 d&oacute;lares, aproximadamente 70,00 Reais<br>
	- Produtos Adquiridos <br><br>
	<b><a href="../../../talkfusion/connect-talkfusion" title="Sobre Connect">Connect: </a></b> Excelente para reuni&otilde;es com 250 participantes e 10 apresentadores.<br>
	<b><a href="../../../talkfusion/videos-email-talkfusion" title="Sobre Video Email">Video Email: </a> </b>10 usu&aacute;rios do Video Email, 1000+ modelos e 3 etiquetas privadas de modelos personalizados.<br>
	<b><a href="../../../talkfusion/videos-newsletters-talkfusion" title="Sobre Video Newsletters">Video Newsletters: </a> </b> 600+ modelos. <br>
	<b><a href="../../../talkfusion/fusion-on-the-go-talkfusion" title="Sobre Fusion On the Go">Fusion On the Go </a></b><br>
	<b><a href="../../../talkfusion/assinatura-eletronica-talkfusion" title="Sobre E-Subscription Forms">E-Subscription Forms </a></b><br>
	<b><a href="../../../talkfusion/video-auto-resposta-talkfusion" title="Sobre Video Auto Responders">Video Auto Responders: </a></b> Etiqueta privada<br>
	<b><a href="../../../talkfusion/fusion-wall-talkfusion" title="Sobre Fusion Wall">Fusion Wall </a></b><br>
	<b><a href="../../../talkfusion/video-blog-talkfusion" title="Sobre Video Blog">Video Blog </a></b><br>
	<b><a href="../../../talkfusion/video-share-talkfusion" title="Sobre Video Share">Video Share </a></b><br>
</div>
<hr> 

<div class="callout callout-info">
	<h4><b style="color:red;">Pacote PRO PAK (PRO PAK)</b></h4>
   - Valor total de cada pacote PRO PAK: <b style="color:red;font-size:30px;">$1,564,00 d&oacute;lares</b>, aproximadamente <b style="color:red;font-size:30px;">3.130,00 Reais</b><br>
	- Valor da mensalidade: $35,00 d&oacute;lares, aproximadamente 70,00 Reais<br>
	- Produtos Adquiridos <br><br>
	<b><a href="../../../talkfusion/connect-talkfusion" title="Sobre Connect">Connect: </a></b> Excelente para reuni&otilde;es com 500 participantes e 15 apresentadores.<br>
	<b><a href="../../../talkfusion/videos-email-talkfusion" title="Sobre Video Email">Video Email: </a></b>15 usu&aacute;rios do Video Email, 1000+ modelos e 3 etiquetas privadas de modelos personalizados.<br>
	<b><a href="../../../talkfusion/videos-newsletters-talkfusion" title="Sobre Video Newsletters">Video Newsletters: </a></b> 600+ modelos e 1 Etiqueta privada de modelo personalizado<br>
	<b><a href="../../../talkfusion/fusion-on-the-go-talkfusion" title="Sobre Fusion On the Go">Fusion On the Go </a></b><br>
	<b><a href="../../../talkfusion/assinatura-eletronica-talkfusion" title="Sobre E-Subscription Forms">E-Subscription Forms </a></b><br>
	<b><a href="../../../talkfusion/video-auto-resposta-talkfusion" title="Sobre Video Auto Responders">Video Auto Responders: </a></b> Etiqueta privada<br>
	<b><a href="../../../talkfusion/fusion-wall-talkfusion" title="Sobre Fusion Wall">Fusion Wall </a></b><br>
	<b><a href="../../../talkfusion/video-blog-talkfusion" title="Sobre Video Blog">Video Blog </a></b><br>
	<b><a href="../../../talkfusion/video-share-talkfusion" title="Sobre Video Share">Video Share </a></b><br>
</div>
<hr> 
   
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <i>*Os valores s&atilde;o mostrados em d&oacute;lares americanos (USD), e a cota&ccedil;&atilde;o est&aacute; sendo exemplificada no valor de 2,00 Reais.</i>
</div>   
<br> 
 
<br>  
<p>Pontua&ccedil;&atilde;o de ganhos de equipe por PACOTE ADQUIRIDO (detalhes dos pacotes).</p>
<table id="example1" class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>Detalhes</th>
            <th>PRO PAK</th>
            <th>ELITE</th>
            <th>EXECUTIVE</th>
            <th>INICIANTE</th>
        </tr>
    </thead>
	<tbody>
		<tr>   
			<td>Limite M&aacute;ximo de Ganhos de Equipe(ciclos)</td>
            <td><b style="color:red;">$ 50.000,00 d&oacute;lares por semana.</b></td>
            <td><b style="color:red;">$ 25.000,00 d&oacute;lares por semana.</b></td>
            <td><b style="color:red;">$ 1.000,00 d&oacute;lares por semana.</b></td>
			<td><b style="color:red;">$ 500,00 d&oacute;lares por semana.</b></td>
        </tr>  
		<tr>
			<td>Se um pacote INICIANTE entrar em sua rede, voc&ecirc; ganha</td>
            <td>50 pontos</td>
            <td>50 pontos</td>
            <td>50 pontos</td>
			<td>50 pontos</td>
        </tr>  
		<tr>
			<td>Se um pacote EXECUTIVO entrar em sua rede, voc&ecirc; ganha</td>
            <td>100 pontos</td>
            <td>100 pontos</td>
            <td>100 pontos</td>
			<td>50 pontos</td>
        </tr>  
		<tr>
			<td>Se um pacote ELITE entrar em sua rede, voc&ecirc; ganha</td>
            <td>300 pontos</td>
            <td>300 pontos</td>
            <td>100 pontos</td>
			<td>50 pontos</td>
        </tr>  
		<tr>
			<td>Se um pacote PRO-PAK entrar em sua rede, voc&ecirc; ganha</td>
            <td>600 pontos</td>
            <td>300 pontos</td>
            <td>100 pontos</td>
			<td>50 pontos</td>
        </tr>  
    </tbody>
</table>
<br>
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <i>Lembrando que a cada 100 pontos cada lado de sua equipe, voc&ecirc; ganhar&aacute; $25,00 d&oacute;lares de imediato.<i> <br>
<i>E sempre quando alguem fazer UP-GRADE em sua equipe, a pontua&ccedil;&atilde;o de um pacote para o outro, tamb&eacute;m ser&atilde;o contabilizadas.</i> 
</div> 
 
<br>
<h3>Est&aacute; sem dinheiro ?</h3>
<b>Tamb&eacute;m estamos disponibilizando o parcelamento em at&eacute; 12x no cart&atilde;o de cr&eacute;dito.</b><br>
<b><a href="#" title="como parcelar pacote da talk fusion">Qual Procedimento do Parcelamento ?</a></b><br>
<img src="../../img/12x-parcelamento-nocartao.jpg" width="250" height="80" alt="Estou PRONTO para Participar"   /> <br>
<b>Entre em contato com o controlador do projeto ou <a href="../../../talkfusion/contato.php" target="_blank" title="Contate-nos para efetuar o parcelamento">contate-nos </a></b>
<b>ou contate-nos atrav&eacute;s do <a href="https://www.facebook.com/messages/1502642069991162" target="_blank" title="Contate-nos para efetuar o parcelamento">Facebook</a></b>
<br><br>
<hr>
 
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="../..///cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../../js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../../js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../../js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../../js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
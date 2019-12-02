<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
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
		$talk = $ln_verifc->TALK_FUSION;
		$talk_simulador = $ln_verifc->TALK_SIMULADOR; 
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
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

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
            <?php  include("menue.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li class="active">Seus LINKS de Indica&ccedil;&otilde;es</li>
                    </ol>
                </section>
 	
                <!-- Main content -->
                <section class="content">

				 <div style="text-align:center;width:100%;">				
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
 <div class="box box-primary">
 <br>
<!-- centro -->	



<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Seus LINKs e Banners de Divulga&ccedil;&otilde;es da TALK FUSION</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
					 LINK: <a href="../talkfusion/<?php echo $id; ?>" title="Acesse seu link de indica&ccedil;&atilde;o" target="_blank">http://www.comunidademultinivel.com.br/talkfusion/<?php echo $id; ?></a>
                    <p>Para que voc&ecirc; possa cadastrar no sistema uma pessoa diretamente de sua indica&ccedil;&atilde;o, a pessoa ter&aacute; que se cadastrar atrav&eacute;s do seu link de indica&ccedil;&atilde;o, ap&oacute;s o cadastro, essa pessoa estar&aacute; sempre em sua rede, e todas as atividades que seus indicados efetuar, voc&ecirc; ser&aacute; beneficiado.</p>
					  
					LINK: <a href="../talkfusion/cadastro/<?php echo $id; ?>" title="Acesse seu link de indica&ccedil;&atilde;o" target="_blank">http://www.comunidademultinivel.com.br/talkfusion/cadastro/<?php echo $id; ?></a>
                    <p>Esse Link Cont&eacute;m um v&iacute;deo explicativo de como funciona a ferramenta de trabalho "Dicas Di&aacute;ria" e tamb&eacute;m um bot&atilde;o de cadastro que ir&aacute; redirecionar os seus indicados para a p&aacute;gina de cadastro.</p>
                 
				
				<hr>
                <h3 class="box-title">Banner de divulga&ccedil;&atilde;o 125x125</h3>  
                URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-125x125.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-125x125.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-125x125.jpg" width="125" height="125" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/talkfusion/cadastro/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-125x125.jpg&quot; width=&quot;125&quot; height=&quot;125&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
                              
							
				<hr>
				<h3 class="box-title">Banner de divulga&ccedil;&atilde;o 468x60</h3> 
				URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-468x60.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-468x60.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-468x60.jpg" width="468" height="60" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/talkfusion/cadastro/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-468x60.jpg&quot; width=&quot;468&quot; height=&quot;60&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
                <hr>
                <h3 class="box-title">Banner de divulga&ccedil;&atilde;o 728x90</h3> 
                URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-728x90.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-728x90.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-728x90.jpg" width="728" height="90" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/talkfusion/cadastro/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/Comunidade-multinivel-728x90.jpg&quot; width=&quot;728&quot; height=&quot;90&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
				
                </div><!-- /.box-body -->
			</div>  
</div><!-- /.col --> 









<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Seus LINKs e Banners de Divulga&ccedil;&otilde;es da TRAFFICMONSOON</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
					 LINK: <a href="../trafficmonsoon/<?php echo $id; ?>" title="Acesse seu link de indica&ccedil;&atilde;o" target="_blank">http://www.comunidademultinivel.com.br/trafficmonsoon/<?php echo $id; ?></a>
                    <p>Para que voc&ecirc; possa cadastrar no sistema uma pessoa diretamente de sua indica&ccedil;&atilde;o, a pessoa ter&aacute; que se cadastrar atrav&eacute;s do seu link de indica&ccedil;&atilde;o, ap&oacute;s o cadastro, essa pessoa estar&aacute; sempre em sua rede, e todas as atividades que seus indicados efetuar, voc&ecirc; ser&aacute; beneficiado.</p>
					  
				<hr>
                <h3 class="box-title">Banner de divulga&ccedil;&atilde;o 125x125</h3>  
                URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-125x125.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-125x125.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-125x125.jpg" width="125" height="125" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/trafficmonsoon/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-125x125.jpg&quot; width=&quot;125&quot; height=&quot;125&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
                              
							
				<hr>
				<h3 class="box-title">Banner de divulga&ccedil;&atilde;o 468x60</h3> 
				URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-468x60.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-468x60.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-468x60.jpg" width="468" height="60" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/trafficmonsoon/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-468x60.jpg&quot; width=&quot;468&quot; height=&quot;60&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
                <hr>
                <h3 class="box-title">Banner de divulga&ccedil;&atilde;o 728x90</h3> 
                URL da Imagem: <a href="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-728x90.jpg" title="Veja a Imagem" target="_blank">http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-728x90.jpg</a> <br>
                <img style="border:2px solid #000000;" src="http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-728x90.jpg" width="728" height="90" alt="Propaganda da Comunidade MultiNivel"  /> 
				<textarea rows="8" cols="80">&lt;a href=&quot;http://www.comunidademultinivel.com.br/trafficmonsoon/<?php echo $id; ?>&quot; title=&quot;Veja a Imagem&quot; target=&quot;_blank&quot;&gt; 
&lt;img src=&quot;http://www.comunidademultinivel.com.br/banners/trafficmonsoon-Comunidade-multinivel-financiado-adpack-728x90.jpg&quot; width=&quot;728&quot; height=&quot;90&quot; alt=&quot;Propaganda da Comunidade MultiNivel&quot; /&gt;
&lt;/a&gt;</textarea>
				
                </div><!-- /.box-body -->
			</div>  
</div><!-- /.col --> 


 
						
						
						
						
	 <br style="clear:both;">
</div>
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
 


        <!-- add new calendar event modal --> 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

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
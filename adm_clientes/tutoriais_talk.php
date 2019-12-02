<?php
session_start(); 
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
		<!-- meu css -->
        <link href="../../css/estilo.css" rel="stylesheet" type="text/css" />
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
                        <li class="active">Tutoriais Referente ao Pojeto TALK FUSION</li>
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
<br>
<!-- centro -->		
<div class="box-header">
	<h3 class="box-title">Links Explicativos referente a ComunidadeMultiN&iacute;vel</h3>
</div><!-- /.box-header -->						 
<ul>
	<li><b> 1 - </b><a href="artigos/talk/cadastrando.php" title="Procedimentos de cadastro na REDE PRINCIPAL da TALK FUSION" target="_blank" >Qual ser&aacute; o procedimentos de cadastro na REDE PRINCIPAL da TALK FUSION ?</a></li>
	<li><b> 2 - </b><a href="artigos/talk/estrategia_principal.php" title="Entenda Como Funciona Nossa Estrat&eacute;gia Principal" target="_blank" >Como Funciona Nossa Estrat&eacute;gia Principal ?</a></li>
	<li><b> 3 - </b><a href="artigos/talk/transferencia_pontos_projeto.php" title="Como Transferir pontua&ccedil;&atilde;o do Saldo Geral para um Projeto" target="_blank" >Como Transferir pontua&ccedil;&atilde;o do Saldo Geral para um Projeto ?</a></li>
	<li><b> 4 - </b><a href="artigos/talk/posicionamento_talk_simulador.php" title="Como Ser&atilde;o distribu&iacute;dos os posicionamentos na rede do SIMULADOR da TALK FUSION" target="_blank" >Como Ser&atilde;o distribu&iacute;dos os posicionamentos na rede do SIMULADOR da TALK FUSION ?</a></li>
	 
</ul>



<div class="box-header">
	<h3 class="box-title">Links Explicativos referente a TALK FUSION</h3>
</div><!-- /.box-header -->	
<ul>
	<li><b> 5 - </b><a href="artigos/talk/valores_pacotes.php" title="Quais s&atilde;o os valores dos pacotes" target="_blank" >Quais s&atilde;o os valores dos pacotes da TALK FUSION ?</a></li>
	<li><b> 6 - </b><a href="artigos/talk/valores_pacotes_simulador.php" title="Quanto Custar&aacute; Cada Pacote INICIANTE na TALK FUSION" target="_blank" >Quanto Custar&aacute; Cada Pacote INICIANTE na TALK FUSION ?</a></li>
	<li><b> 7 - </b> <a href="artigos/talk/cadastrando.php" title="Procedimentos de cadastro na REDE PRINCIPAL da TALK FUSION" target="_blank">Qual ser&aacute; o procedimento do cadastro na REDE PRINCIPAL ? </a></li>
</ul>




<div class="box-header">
	<h3 class="box-title">Links Explicativos referente aos PRODUTOS da TALK FUSION</h3>
</div><!-- /.box-header -->		
<ul>
	<li><b> 8 - </b><a href="artigos/talk/video_email.php" title="Aprenda Como usar o produto Video-Email" target="_blank" >Como Usar o Video-Email ?</a></li>
	<li><b> 9 - </b><a href="artigos/talk/video_newsletter.php" title="Aprenda Como usar o produto Video-Newsletter" target="_blank" >Como Usar o Video-Newsletter ?</a></li>
	<li><b> 10 - </b><a href="artigos/talk/video_subscricao_automaticos.php" title="Aprenda Como usar o produto Formul&aacute;rios de Subscri&ccedil;&atilde;o e Resposta Autom&aacute;tica" target="_blank" >Como Usar o Formul&aacute;rios de Subscri&ccedil;&atilde;o e Resposta Autom&aacute;tica ?</a></li>
	<li><b> 11 - </b><a href="artigos/talk/video_share.php" title="Aprenda Como usar o produto Video-Share" target="_blank" >Como Usar o Video-Share ?</a></li> 
	<li><b> 12 - </b><a href="artigos/talk/connect.php" title="Aprenda Como usar o produto CONNECT" target="_blank" >Como Usar o CONNECT ?</a></li>   
</ul>		
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
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
		<!--  meu css  -->
		<link href="css/estilo.css" rel="stylesheet" type="text/css" />
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
        <!-- header logo: style can be found in header.less -->
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
                        <li class="active">Contatos</li>
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
<!-- centro -->	
<br>
<div id="div_face"> 
	<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width&amp;height=290&amp;colorscheme=dark&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:290px;" allowTransparency="true"></iframe>
</div>
<div id="div_canal">
	<h2>GRUPO NO FACEBOOK</h2>
	<a href="https://www.facebook.com/groups/simuladortalkfusion/" title="Grupo oficial da Comunidade MultiN&iacute;vel"  target="_blank"><img src="img/grupo-facebook-comunidade-multinivel.jpg" width="450" height="120" alt="Grupo oficial da Comunidade MultiN&iacute;vel" /></a>
</div>
<div id="div_canal">
	<h2>Canal do YOUTUBE</h2>
	<script src="https://apis.google.com/js/platform.js"></script> 
	<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
</div>

<div id="div_contato">
	<br><br>
	<h2><span>Contato</span> com Moderadores da ComunidadeMultin&iacute;vel</h2>
	<p>Os Moderadores da Comunidada Estar&atilde;o disposto para ajudar sempre que poss&iacute;vel e tirar todas suas duvidas referente a todos nossos projetos, contate-os e junte-se a rede mais unida do MultiN&iacute;vel.</p> 
	<br>
	Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    <br><br>
	<span>E-mail oficial da Comunidade: </span> <i>contato@comunidademultinivel.com.br </i>
	 <br><br>
<?php 	
$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = 'SIM'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$tel = $ln_verifc->TELEFONE;
		$cel = $ln_verifc->CELULAR;
		$skype = $ln_verifc->SKYPE;
		$face = $ln_verifc->FACEBOOK;
		$email = $ln_verifc->EMAIL;
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL; 
?>
<div class="col-md-16">
	<div class="box box-solid box-primary">  
		<div class="box-header"> 		 
				<h3 class="box-title"><a style="color:#FFF;" href="completo.php?perfil=<?php echo $id; ?>" title="Veja o perfil desse moderador" ><?php echo $nome; ?></a></h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body">  
			<div style="float:left; width:19%; border:1px solid #CCC; margin:0px 5px 0px 0px;text-align:center;">
				<?php if ($foto_perfil == "") { ?>
					<img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" />
				<?php } else { ?>
					<img src="img_perfil/<?php echo $foto_perfil; ?>"  class="img-circle" alt="Sua Imagem" width="100" />
				<?php } ?>
				<br>
				<b><a href="completo.php?perfil=<?php echo $id; ?>" title="Veja o Perfil" target="_blank"><?php echo $nome; ?></a></b>
				<br>
			</div>
			<div  style="float:right; width:80%; ">
			<h2>Contatos</h2>
			<b>E-mail: </b> <?php echo $email; ?><br>
			<b>Celular (Whatsapp): </b> <?php echo $cel; ?><br>
			<b>Telefone: </b> <?php echo $tel; ?><br>
			<b>Skype: </b> <?php echo $skype; ?><br>
			<b>Facebook: </b> <?php echo $face; ?><br>
			</div> 
		</div><!-- /.box-body -->
		
		<br style="clear:both;"> <br>
    </div><!-- /.box -->
	
</div> 	
	
<?php } ?>
	 
</div> 


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
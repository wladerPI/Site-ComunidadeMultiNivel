<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
 

$id_adm = $_SESSION['ID'];

if ($id_adm == "" || $id_adm == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
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
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do ADM</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu CSS -->
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
		<script src="js/functions.js" type="text/javascript"></script>
		
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../../index.php" class="logo" target="_blank" >
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                CM Painel ADM 
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Administrador <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
									<img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" />
                                    <p> 
                                        <small>Membro Administrador e controlador</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="dadosgerais.php" class="btn btn-default btn-flat">Dados do Site</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="sair.php" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
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
                        <li class="active">An&uacute;cios CPM</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->		 
 <div class="box-header">
		<h3 class="box-title">An&uacute;cios Custo por Mil Impress&otilde;es</h3>
</div><!-- /.box-header -->	 
<div class="box box-primary"> 
	 <label for="exampleInputEmail1"><form name="frmMudar" method="post">
			 An&uacute;ncio CPM: <select name="sltMudar" onchange="fMudarPagina()" class="form-control">
				<option selected>Selecione
				<option value="anuncio_cpm.php?anuncio=1">Pagina 1 PopUP
				<option value="anuncio_cpm.php?anuncio=2">Pagina 1 Banner 1
				<option value="anuncio_cpm.php?anuncio=3">Pagina 1 Banner 2
				<option value="anuncio_cpm.php?anuncio=4">Pagina 1 Banner 3
				<option value="anuncio_cpm.php?anuncio=5">Pagina 1 Banner 4
				<option value="anuncio_cpm.php?anuncio=6">Pagina 1 Banner 5
				<option value="anuncio_cpm.php?anuncio=7">Pagina 1 Banner 6
				<option value="anuncio_cpm.php?anuncio=8">Pagina 1 Banner 7
				<option value="anuncio_cpm.php?anuncio=9">Pagina 1 Banner 8
				<option value="anuncio_cpm.php?anuncio=10">Pagina 1 Banner 9
				<option value="anuncio_cpm.php?anuncio=11">Pagina 1 Banner 10
				<option value="anuncio_cpm.php?anuncio=12">Pagina 1 Banner 11
				<option value="anuncio_cpm.php?anuncio=13">Pagina 1 Banner 12 
				<option disabled> -- --
				<option value="anuncio_cpm.php?anuncio=14">Pagina 2 PopUP
				<option value="anuncio_cpm.php?anuncio=15">Pagina 2 Banner 1
				<option value="anuncio_cpm.php?anuncio=16">Pagina 2 Banner 2
				<option value="anuncio_cpm.php?anuncio=17">Pagina 2 Banner 3
				<option value="anuncio_cpm.php?anuncio=18">Pagina 2 Banner 4
				<option value="anuncio_cpm.php?anuncio=19">Pagina 2 Banner 5
				<option value="anuncio_cpm.php?anuncio=20">Pagina 2 Banner 6
				<option value="anuncio_cpm.php?anuncio=21">Pagina 2 Banner 7
				<option value="anuncio_cpm.php?anuncio=22">Pagina 2 Banner 8
				<option value="anuncio_cpm.php?anuncio=23">Pagina 2 Banner 9
				<option value="anuncio_cpm.php?anuncio=24">Pagina 2 Banner 10
				<option value="anuncio_cpm.php?anuncio=25">Pagina 2 Banner 11
				<option value="anuncio_cpm.php?anuncio=26">Pagina 2 Banner 12
				<option disabled> -- --
				<option value="anuncio_cpm.php?anuncio=27">Pagina 3 PopUP
				<option value="anuncio_cpm.php?anuncio=28">Pagina 3 Banner 1
				<option value="anuncio_cpm.php?anuncio=29">Pagina 3 Banner 2
				<option value="anuncio_cpm.php?anuncio=30">Pagina 3 Banner 3
				<option value="anuncio_cpm.php?anuncio=31">Pagina 3 Banner 4
				<option value="anuncio_cpm.php?anuncio=32">Pagina 3 Banner 5
				<option value="anuncio_cpm.php?anuncio=33">Pagina 3 Banner 6
				<option value="anuncio_cpm.php?anuncio=34">Pagina 3 Banner 7
				<option value="anuncio_cpm.php?anuncio=35">Pagina 3 Banner 8
				<option value="anuncio_cpm.php?anuncio=36">Pagina 3 Banner 9
				<option value="anuncio_cpm.php?anuncio=37">Pagina 3 Banner 10
				<option value="anuncio_cpm.php?anuncio=38">Pagina 3 Banner 11
				<option value="anuncio_cpm.php?anuncio=39">Pagina 3 Banner 12
			</select>
	</form></label> 	
	<hr>
<?php 

$anuncio = $_GET['anuncio']; 

if ($anuncio == "" || $anuncio == 0 || $anuncio > 39) {
	echo "<b style='color:red;'>Selecione Um an&uacute;ncio acima, para que possa edita-lo</b>";
} else {
	$sql_conta = $con->prepare("SELECT * FROM $tabela17 WHERE ID = $anuncio");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) {
		$banner_titulo = $ln->TITULO;
		$detalhe = $ln->DETALHE;
		$codigo_banner = htmlspecialchars_decode($ln->SCRIPT); 
	}
?>
<form id="form1" name="form1" method="post" action="anuncio_cpm_alterando.php">
	<div class="box-body">
        <div class="form-group">
			<label><?php echo "<b style='red'>".$detalhe."</b>"; ?>
				<i class="fa fa-arrow-down"></i> 
				<input type="text" name="banner_titulo" value="<?php echo $banner_titulo; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Qual Banner &eacute; esse ?" />
			</label>
			<textarea class="form-control" name="codigo_banner" id="codigo_banner"  placeholder="Codigo do PopUP"><?php echo $codigo_banner; ?></textarea>
        </div> 
	</div><!-- /.box-body -->
	<INPUT TYPE="hidden" NAME="id_anuncio" VALUE="<?php echo $anuncio; ?>"> 
	<div class="box-footer">
		<input type="submit" class="btn btn-primary" value="Alterar" /> 
    </div>
</form>		

<?php
}

?>

	
</div><!-- /.box -->



<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

         <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="../../adm_clientes/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="../../adm_clientes/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="../../adm_clientes/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="../../adm_clientes/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="../../adm_clientes/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="../../adm_clientes/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../../adm_clientes/js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- Page script -->
        <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
                //Datemask2 mm/dd/yyyy
                $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

                //Date range picker
                $('#reservation').daterangepicker();
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
                //Date range as a button
                $('#daterange-btn').daterangepicker(
                        {
                            ranges: {
                                'Today': [moment(), moment()],
                                'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                                'Last 7 Days': [moment().subtract('days', 6), moment()],
                                'Last 30 Days': [moment().subtract('days', 29), moment()],
                                'This Month': [moment().startOf('month'), moment().endOf('month')],
                                'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                            },
                            startDate: moment().subtract('days', 29),
                            endDate: moment()
                        },
                function(start, end) {
                    $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
                );

                //iCheck for checkbox and radio inputs
                $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
                    checkboxClass: 'icheckbox_minimal',
                    radioClass: 'iradio_minimal'
                });
                //Red color scheme for iCheck
                $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
                    checkboxClass: 'icheckbox_minimal-red',
                    radioClass: 'iradio_minimal-red'
                });
                //Flat red color scheme for iCheck
                $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
                    checkboxClass: 'icheckbox_flat-red',
                    radioClass: 'iradio_flat-red'
                });

                //Colorpicker
                $(".my-colorpicker1").colorpicker();
                //color picker with addon
                $(".my-colorpicker2").colorpicker();

                //Timepicker
                $(".timepicker").timepicker({
                    showInputs: false
                });
            });
        </script>
		<!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>      
        <!-- CK Editor -->
        <script src="js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
			// textarea pag 1 popup 1
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
              
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
				 
				CKEDITOR.config.startupMode= 'source';
                CKEDITOR.replace( 'codigo_banner', { 
                    toolbar:  [                          
                ], height: 100
				});
				 
            });
			
			// textarea pag 1 banner 1
			$(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration. 
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5(); 
				CKEDITOR.config.startupMode= 'source';
                CKEDITOR.replace( 'codigo_banner1', { 
                    toolbar:  [                          
                ], height: 100
				});  
            }); 
        </script>

    </body>
</html>
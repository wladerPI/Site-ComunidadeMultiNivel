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
                        <li class="active">Configura&ccedil;&atilde;o Geral da aba DICAS</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->		 
 <div class="box-header">
		<h3 class="box-title">Configura&ccedil;&atilde;o Geral da aba DICAS</h3>
</div><!-- /.box-header -->	 
<div class="box box-primary"> 
<?php 
	$sql_conta = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) { 
		$pontos_ganhos = $ln->PONTOS_GANHOS;
		$tempo_espera = $ln->TEMPO_ESPERA;  
		$qts_pacotes_premiados = $ln->QTS_PACOTES_PAGOS; 
		$qts_pontos_gerados = $ln->QTS_PONTOS_GERADOS; 
		$qts_pontos_gravados = $ln->QTS_PONTOS_GRAVADOS_ATUAL;
		
		$pontos_ganhos_tms_clientes = $ln->TMS_PONTOS_CLIENTE;
		$pontos_ganhos_tms_nivel1 = $ln->TMS_PONTOS_NIVEL1;
		$pontos_ganhos_tms_nivel2 = $ln->TMS_PONTOS_NIVEL2;
		$pontos_ganhos_tms_nivel3 = $ln->TMS_PONTOS_NIVEL3;
		$pontos_ganhos_tms_nivel4 = $ln->TMS_PONTOS_NIVEL4;
		$pontos_ganhos_tms_nivel5 = $ln->TMS_PONTOS_NIVEL5;
		
		$liberado = $ln->LIBERADO;
	} 
?> 
 <form id="form" name="form" method="post" action="anuncio_config_alterando.php">
		<div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Quantidade de pontos ganhos por atividade di&aacute;ria concu&iacute;da*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos" value="<?php echo $pontos_ganhos; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Tempo de espera por P&aacute;gina de DICAS*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="tempo_espera" value="<?php echo $tempo_espera; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque a quantidade de segundos de espera" />
				<label for="exampleInputEmail1">Quantidade de pacotes premiados*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_pacotes_premiados" value="<?php echo $qts_pacotes_premiados; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque a quantidade de pacotes que ser&aacute; disponibilizados nas premia&ccedil;&otidel;es" />
				<label for="exampleInputEmail1">Quantidade de pontos gerados por Temporada*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_pontos_gerados" value="<?php echo $qts_pontos_gerados; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque a quantidade de pontos a ser gerados por reme&ccedil;a" />
				<label for="exampleInputEmail1">Quantidade de pontos gravados na Temporada:</label> <i class="fa fa-arrow-right"></i>  <?php echo $qts_pontos_gravados; ?>
				<br> <hr>
 <div class="box-header">
		<h3 class="box-title">Configura&ccedil;&atilde;o de pontua&ccedil;&atilde;o da TrafficMonsoon</h3>
</div><!-- /.box-header -->					
				<br>
				<label for="exampleInputEmail1">Quantidade de pontos ganhos quando um cliente se cadastra na TrafficMonsoon*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_clientes" value="<?php echo $pontos_ganhos_tms_clientes; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de pontos ganhos no n&iacute;vel 1*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_nivel1" value="<?php echo $pontos_ganhos_tms_nivel1; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de pontos ganhos no n&iacute;vel 2*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_nivel2" value="<?php echo $pontos_ganhos_tms_nivel2; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de pontos ganhos no n&iacute;vel 3*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_nivel3" value="<?php echo $pontos_ganhos_tms_nivel3; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de pontos ganhos no n&iacute;vel 4*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_nivel4" value="<?php echo $pontos_ganhos_tms_nivel4; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de pontos ganhos no n&iacute;vel 5*:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="pontos_ganhos_tms_nivel5" value="<?php echo $pontos_ganhos_tms_nivel5; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<br> <hr> <br>
				<label for="exampleInputEmail1">LIBERADO*: </label> <i class="fa fa-arrow-down"></i> 	
				<select name="liberado" class="form-control"> 
					<option value="<?php echo $liberado; ?>"><?php echo $liberado; ?></option>  
					<?php if ($liberado == "SIM") { ?>
					<option value="NAO">NAO</option>
					<?php } else { ?>
					<option value="SIM">SIM</option>
					<?php }   ?>	
				</select>
				<hr>
            </div>
        </div><!-- /.box-body -->
		<div class="box-footer">
			<input type="submit" class="btn btn-primary" value="ALTERAR Configura&ccedil;&otilde;es" /> 
        </div>
</form>		                   
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

    </body>
</html>
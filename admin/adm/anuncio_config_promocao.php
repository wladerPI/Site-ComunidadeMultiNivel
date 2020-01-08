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
                        <li class="active">Configura&ccedil;&otilde;es de promo&ccedil;&otilde;es do m&ecirc;s da aba DICAS</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
		 
<!-- centro -->		 
 <div class="box-header">
		<h3 class="box-title">Configura&ccedil;&otilde;es de promo&ccedil;&otilde;es do m&ecirc;s da aba DICAS</h3>
</div><!-- /.box-header -->	 
<div class="box box-primary"> 
<?php 
	$sql_conta = $con->prepare("SELECT * FROM $tabela24 WHERE ID = '1'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) { 
		$qts_pontos = $ln->PONTOS; 
		  
		$qts_adpacks_comprar1 = $ln->BONUS_COMPRA_ADPACKS1;
		$qts_adpacks_comprar2 = $ln->BONUS_COMPRA_ADPACKS2;
		$qts_adpacks_comprar3 = $ln->BONUS_COMPRA_ADPACKS3;
		$qts_adpacks_comprar4 = $ln->BONUS_COMPRA_ADPACKS4;
		$qts_adpacks_comprar5 = $ln->BONUS_COMPRA_ADPACKS5;
		$qts_adpacks_comprar6 = $ln->BONUS_COMPRA_ADPACKS6;
		$qts_adpacks_comprar7 = $ln->BONUS_COMPRA_ADPACKS7;
		$qts_adpacks_comprar8 = $ln->BONUS_COMPRA_ADPACKS8;
		$qts_adpacks_comprar9 = $ln->BONUS_COMPRA_ADPACKS9;
		$qts_adpacks_comprar10 = $ln->BONUS_COMPRA_ADPACKS10;
		
		$qts_adpacks_brinde1 = $ln->BONUS_BRINDE_ADPACKS1; 
		$qts_adpacks_brinde2 = $ln->BONUS_BRINDE_ADPACKS2;
		$qts_adpacks_brinde3 = $ln->BONUS_BRINDE_ADPACKS3;
		$qts_adpacks_brinde4 = $ln->BONUS_BRINDE_ADPACKS4;
		$qts_adpacks_brinde5 = $ln->BONUS_BRINDE_ADPACKS5;
		$qts_adpacks_brinde6 = $ln->BONUS_BRINDE_ADPACKS6;
		$qts_adpacks_brinde7 = $ln->BONUS_BRINDE_ADPACKS7;
		$qts_adpacks_brinde8 = $ln->BONUS_BRINDE_ADPACKS8;
		$qts_adpacks_brinde9 = $ln->BONUS_BRINDE_ADPACKS9;
		$qts_adpacks_brinde10 = $ln->BONUS_BRINDE_ADPACKS10;
		
		 
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
	} 
?> 
 <form id="form" name="form" method="post" action="anuncio_config_promocao_alterando.php">
		<div class="box-body">
            <div class="form-group">
 <div class="box-header">
		<h3 class="box-title" style="color:red;">Configura&ccedil;&otilde;es de trocas de pontos por ADPacks</h3>
</div><!-- /.box-header -->	
<?php
	$sql_alt = $con->prepare("SELECT * FROM $tabela23 WHERE STATUS = 'PENDENTE'");
	$sql_alt->execute();
	$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
	$qts_premiados_pendentes = count( $res_alt );
	
	$sql_alt = $con->prepare("SELECT * FROM $tabela23 WHERE STATUS = 'PAGO'");
	$sql_alt->execute();
	$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
	$qts_premiados_pagos = 0;
	foreach($res_alt as $ln_verifc) { 
		$qts_premiados_pagos += $ln_verifc->QTS_ADPACKS;
	}
?>
<br>
	<a class="btn btn-app" href="promocao_premiados_pendentes.php" title="Quantidade de PENDENTES">
	<span class="badge bg-yellow"><?php echo $qts_premiados_pendentes; ?></span>
    <i class="fa fa-align-justify"></i> Trocas PENDENTES
     </a> 
	
	<a class="btn btn-app" href="promocao_premiados_pagos.php" title="Quantidade de Adpacks PAGOS">
	<span class="badge bg-green"><?php echo $qts_premiados_pagos; ?></span>
    <i class="fa fa-align-justify"></i> Trocas PAGOS
     </a>
		
	<hr> 
                <label for="exampleInputEmail1">Quantidade de pontos na troca por ADPacks *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_pontos" value="<?php echo $qts_pontos; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<br> 
				<label for="exampleInputEmail1">LIBERADO PREMIA&Ccedil;&Atilde:O POR PONTOS? *: </label> <i class="fa fa-arrow-down"></i> 	
				<select name="liberado_pontos" class="form-control"> 
					<option value="<?php echo $liberado_pontos; ?>"><?php echo $liberado_pontos; ?></option>  
					<?php if ($liberado_pontos == "SIM") { ?>
					<option value="NAO">NAO</option>
					<?php } else { ?>
					<option value="SIM">SIM</option>
					<?php }   ?>	
				</select>
				<br>
				<hr>
				
 <div class="box-header">
		<h3 class="box-title" style="color:red;">Configura&ccedil;&otilde;es de BRINDES</h3>
</div><!-- /.box-header -->	

<?php
	$sql_alt = $con->prepare("SELECT * FROM $tabela25 WHERE STATUS = 'PENDENTE'");
	$sql_alt->execute();
	$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
	$qts_premiados_pendentes_brindes = count( $res_alt );
	
	$sql_alt = $con->prepare("SELECT * FROM $tabela25 WHERE STATUS = 'PAGO'");
	$sql_alt->execute();
	$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
	$qts_premiados_pagos_brindes = 0;
	foreach($res_alt as $ln_verifc) { 
		$qts_premiados_pagos_brindes += $ln_verifc->QTS_ADPACKS_BRINDES;
	}
?>
<br>
	<a class="btn btn-app" href="promocao_premiados_pendentes_brindes.php" title="Quantidade de PENDENTES">
	<span class="badge bg-yellow"><?php echo $qts_premiados_pendentes_brindes; ?></span>
    <i class="fa fa-align-justify"></i> BRINDES PENDENTES
     </a> 
	
	<a class="btn btn-app" href="promocao_premiados_pago_brindes.php" title="Quantidade de Adpacks PAGOS">
	<span class="badge bg-green"><?php echo $qts_premiados_pagos_brindes; ?></span>
    <i class="fa fa-align-justify"></i> BRINDES PAGOS
     </a>
		
	<hr> 				
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 1 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar1" value="<?php echo $qts_adpacks_comprar1; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 2 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar2" value="<?php echo $qts_adpacks_comprar2; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 3 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar3" value="<?php echo $qts_adpacks_comprar3; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 4 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar4" value="<?php echo $qts_adpacks_comprar4; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 5 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar5" value="<?php echo $qts_adpacks_comprar5; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 6 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar6" value="<?php echo $qts_adpacks_comprar6; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 7 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar7" value="<?php echo $qts_adpacks_comprar7; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 8 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar8" value="<?php echo $qts_adpacks_comprar8; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 9 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar9" value="<?php echo $qts_adpacks_comprar9; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de ADPacks a ser comprado 10 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_comprar10" value="<?php echo $qts_adpacks_comprar10; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<br> <hr>
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 1 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde1" value="<?php echo $qts_adpacks_brinde1; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" /> 
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 2 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde2" value="<?php echo $qts_adpacks_brinde2; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 3 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde3" value="<?php echo $qts_adpacks_brinde3; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 4 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde4" value="<?php echo $qts_adpacks_brinde4; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 5 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde5" value="<?php echo $qts_adpacks_brinde5; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 6 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde6" value="<?php echo $qts_adpacks_brinde6; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 7 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde7" value="<?php echo $qts_adpacks_brinde7; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 8 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde8" value="<?php echo $qts_adpacks_brinde8; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 9 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde9" value="<?php echo $qts_adpacks_brinde9; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<label for="exampleInputEmail1">Quantidade de Adpacks(trafficmonsoon) de BRINDE 10 *:</label> <i class="fa fa-arrow-down"></i> <input type="text" name="qts_adpacks_brinde10" value="<?php echo $qts_adpacks_brinde10; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Coloque um n&uacute;mero aqui" />
				<hr>
				<label for="exampleInputEmail1">LIBERADO BRINDES POR COMPRAS DE ADPacks? *: </label> <i class="fa fa-arrow-down"></i> 	
				<select name="liberado_brindes" class="form-control"> 
					<option value="<?php echo $liberado_brindes; ?>"><?php echo $liberado_brindes; ?></option>  
					<?php if ($liberado_brindes == "SIM") { ?>
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
<?php
session_start(); 
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
try {
	$sql = $con->prepare("SELECT * FROM $tabela5 WHERE ID = $id_adm");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$indc_nivel1 = $ln->PONTOS_NIVEL_1;
		$indc_nivel2 = $ln->PONTOS_NIVEL_2;
		$indc_nivel3 = $ln->PONTOS_NIVEL_3;
		$indc_nivel4 = $ln->PONTOS_NIVEL_4;
		$indc_nivel5 = $ln->PONTOS_NIVEL_5;
		$dolar_hj = $ln->DOLARHOJE;
		$talk_simulador_status = $ln->TALK_SIMULADOR;
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
                        <li class="active">Dados do Projeto</li>
                    </ol>
                </section>
 
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->		 
<Script type = "text/javascript">
function verifica() {   
	if (form.indc_nivel1.value == "") { 
		alert("O Campo 1 N\u00edvel \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.indc_nivel2.value == "") { 
		alert("O Campo 2 N\u00edvel \xE9 obrigat\xF3rio"); 
		return false;   
    }
	if (form.indc_nivel3.value == "") { 
		alert("O Campo 3 N\u00edvel \xE9 obrigat\xF3rio"); 
		return false;   
    }
	if (form.indc_nivel4.value == "") { 
		alert("O Campo 4 N\u00edvel \xE9 obrigat\xF3rio"); 
		return false;   
    }
	if (form.indc_nivel5.value == "") { 
		alert("O Campo 5 N\u00edvel \xE9 obrigat\xF3rio"); 
		return false;   
    }
	if (form.dolar_hj.value == "") { 
		alert("O Campo Dolar hoje \xE9 obrigat\xF3rio"); 
		return false;   
    }
}
</script>
<form id="form" name="form" method="post" action="dadosprojeto_alterando.php">
		<div class="box-body">
            <div class="form-group">
				<h2>Pontua&ccedil&atilde;o por Indica&ccedil;&atilde;o no projeto TALK FUSION</h2>
                <label for="exampleInputEmail1">1&#176; N&iacute;vel*:</label> <i class="fa fa-angle-double-up"></i> <input type="text" name="indc_nivel1" value="<?php echo $indc_nivel1; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite a quantidade de pontos" />
				<label for="exampleInputEmail1">2&#176; N&iacute;vel*: </label> <i class="fa fa-angle-double-up"></i> <input type="text" name="indc_nivel2" value="<?php echo $indc_nivel2; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite a quantidade de pontos" />
				<label for="exampleInputEmail1">3&#176; N&iacute;vel*: </label> <i class="fa fa-angle-double-up"></i> <input type="text" name="indc_nivel3" value="<?php echo $indc_nivel3; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite a quantidade de pontos" />
				<label for="exampleInputEmail1">4&#176; N&iacute;vel*: </label> <i class="fa fa-angle-double-up"></i> <input type="text" name="indc_nivel4" value="<?php echo $indc_nivel4; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite a quantidade de pontos" />
				<label for="exampleInputEmail1">5&#176; N&iacute;vel*: </label> <i class="fa fa-angle-double-up"></i> <input type="text" name="indc_nivel5" value="<?php echo $indc_nivel5; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite a quantidade de pontos" />
				<br> 
				<label for="exampleInputEmail1">D&oacute;lar Hoje*: (0.00)</label> <i class="fa fa-dollar"></i> <input type="text" name="dolar_hj" value="<?php echo $dolar_hj; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite o valor do d&oacute;lar de hoje" />
				<hr>
					 <label for="exampleInputEmail1">Status Do SIMULADOR da TALK FUSION *: <i>(simulador est&aacute; ATIVO ?) </i></label> 
					<select class="form-control" name="status_talk_simulador">  
							<option value="<?php echo $talk_simulador_status; ?>"><?php echo $talk_simulador_status; ?></option>  
							<?php if ($talk_simulador_status == "SIM") { ?>
								<option value="NAO">NAO</option>
							<?php } else { ?>
								<option value="SIM">SIM</option>
							<?php }   ?> 
					</select> 
				
					 <label for="exampleInputEmail1">RENICIAR SIMULADOR da TALK FUSION *: </label> 
					<select class="form-control" name="reniciar_talk_simulador">  
							<option value="NAO">NAO</option> 
							<option value="SIM">SIM</option>
					</select> 
				<hr>
				<br>
            </div>
        </div><!-- /.box-body -->
		<div class="box-footer">
			<input type="submit" class="btn btn-primary" Onclick="return verifica()"  value="ALTERAR DADOS" /> 
        </div>
</form>						


	
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
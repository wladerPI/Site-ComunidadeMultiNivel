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
 
$dia = $_GET['dia'];
$id_anunciocpc = $_GET['id_anunciocpc'];


if ($dia == "" || $dia == 0 || $dia > 30) {
	echo("<script type='text/javascript'> alert('Esse Dia n\u00e3o existe !!!'); location.href='anuncio_cpc.php';</script>");
	exit;	
}  
if ($id_anunciocpc == "" || $id_anunciocpc == 0 ) {
	echo("<script type='text/javascript'> alert('Esse Anuncio n\u00e3o existe !!!'); location.href='anunciocpc_dia.php?dia=$dia';</script>"); 
	exit;
}  
 
 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel  &Aacute;rea Administrativa do ADM</title>
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
						<li class="active">Editando An&uacute;cio CPCs</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->		 
 <div class="box-header">
		<h3 class="box-title">An&uacute;ncios Custo por Clique</h3>
</div><!-- /.box-header -->	 
<div class="box box-primary">  
	<label for="exampleInputEmail1"><form name="frmMudar" method="post">
			 An&uacute;ncio CPC do DIA: <select name="sltMudar" onchange="fMudarPagina()" class="form-control">
				<option selected>Selecione
				<option value="anunciocpc_dia.php?dia=1">1
				<option value="anunciocpc_dia.php?dia=2">2
				<option value="anunciocpc_dia.php?dia=3">3
				<option value="anunciocpc_dia.php?dia=4">4
				<option value="anunciocpc_dia.php?dia=5">5
				<option value="anunciocpc_dia.php?dia=6">6
				<option value="anunciocpc_dia.php?dia=7">7
				<option value="anunciocpc_dia.php?dia=8">8
				<option value="anunciocpc_dia.php?dia=9">9
				<option value="anunciocpc_dia.php?dia=10">10
				<option value="anunciocpc_dia.php?dia=11">11
				<option value="anunciocpc_dia.php?dia=12">12
				<option value="anunciocpc_dia.php?dia=13">13
				<option value="anunciocpc_dia.php?dia=14">14
				<option value="anunciocpc_dia.php?dia=15">15
				<option value="anunciocpc_dia.php?dia=16">16
				<option value="anunciocpc_dia.php?dia=17">17
				<option value="anunciocpc_dia.php?dia=18">18
				<option value="anunciocpc_dia.php?dia=19">19
				<option value="anunciocpc_dia.php?dia=20">20
				<option value="anunciocpc_dia.php?dia=21">21
				<option value="anunciocpc_dia.php?dia=22">22
				<option value="anunciocpc_dia.php?dia=23">23
				<option value="anunciocpc_dia.php?dia=24">24
				<option value="anunciocpc_dia.php?dia=25">25
				<option value="anunciocpc_dia.php?dia=26">26
				<option value="anunciocpc_dia.php?dia=27">27
				<option value="anunciocpc_dia.php?dia=28">28
				<option value="anunciocpc_dia.php?dia=29">29
				<option value="anunciocpc_dia.php?dia=30">30
			</select>
	</form></label> 	
	<hr> 
<?php
	$sql_conta = $con->prepare("SELECT * FROM $tabela16");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
?>	 
	 <a class="btn btn-app" href="#" title="Quantidade de An&uacute;ncios registrados">
	<span class="badge bg-yellow"><?php echo $quantreg; ?></span>
    <i class="fa fa-align-justify"></i> Quantidade Total de An&uacute;ncios
     </a> 
	
	<a class="btn btn-app" href="anuncioscpc_add.php" title="Add Novo An&uacute;ncio CPC no dia <?php echo $dia; ?>">
    <i class="fa fa-plus"></i> Adicionar NOVO An&uacute;ncio 
    </a> 

	
	<section class="content"> 
 <div class='row'>

<script>
function verifica() { 
	if (form_res.titulo.value == "") { 
		alert("O Titulo da Dica \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	 
}    
 
 
</script>
<?php  
	$sql_conta = $con->prepare("SELECT * FROM $tabela16 WHERE ID = '$id_anunciocpc'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) { 
		$titulo = $ln->ANUNCIO_TITULO; 
		
		$texto = htmlspecialchars_decode($ln->ANUNCIO_CPC); // assim vai mostrar o codigo do anuncio
		$texto = htmlspecialchars($texto); // assim vai mostrar o codigo do anuncio
		 
		$dia_do_anuncio = $ln->DIA; 
		$data = $ln->DATA;
		$data = implode("/",array_reverse(explode("-",$data))); 
	} 
	 
?>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Editar An&uacute;ncio <small> \O/ </small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
									<form id="form_res" name="form_res" method="post" action="editando_anunciocpc.php">
										<div style="width:35%; float:left;"> 
										 <br> <br>
											<b>Titulo *</b>
											<div class="input-group"> 
												<input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>"> <span class="input-group-addon"><i class="fa fa-check"></i></span>
											</div>	
											<div class="form-group">
                                            <label>Dia</label>
												<select class="form-control" name="dia_do_anuncio">
													<option value="<?php echo $dia_do_anuncio; ?>"><?php echo $dia_do_anuncio; ?></option>
													<option value="1">1</option>
													<option value="2">2</option>
													<option value="3">3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
													<option value="10">10</option>
													<option value="11">11</option>
													<option value="12">12</option>
													<option value="13">13</option>
													<option value="14">14</option>
													<option value="15">15</option>
													<option value="16">16</option>
													<option value="17">17</option>
													<option value="18">18</option>
													<option value="19">19</option>
													<option value="20">20</option>
													<option value="21">21</option>
													<option value="22">22</option>
													<option value="23">23</option>
													<option value="24">24</option>
													<option value="25">25</option>
													<option value="26">26</option>
													<option value="27">27</option>
													<option value="28">28</option>
													<option value="29">29</option>
													<option value="30">30</option>
												</select>
											</div> 
											<b>Data de Cadastro: <?php echo $data; ?></b> <br> 
											<INPUT TYPE="hidden" NAME="id_anunciocpc" VALUE="<?php echo $id_anunciocpc; ?>">
										</div>
										<div style="width:60%; float:right;"> 
											<textarea id="editor1" name="editor1" ><?php echo $texto; ?></textarea>
											<br>  
											<button type="submit" Onclick="return verifica()"  style="float:right;" class="btn btn-warning btn-lg" title="Clique aqui para Editar o An&uacute;ncio">Editar An&uacute;ncio </button> 
										</div>
									</form>
									    <br style="clear:both;"> <br> 
                                </div>
                            </div><!-- /.box --> 
                        </div><!-- /.col-->
                    </div><!-- ./row -->                   
	</section><!-- /.content --> 
</div><!-- /.box -->



<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
		
		
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
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
              
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
				 
				CKEDITOR.config.startupMode= 'source';
                CKEDITOR.replace( 'editor1', { 
                    toolbar:  [                          
                ]}  
                );
				 
            });
        </script>
		
		
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
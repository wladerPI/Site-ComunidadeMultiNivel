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
                        <li class="active">Posi&ccedil;&otilde;es PENDENTES</li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->		 
 <div class="box-header">
		<h3 class="box-title">Todas Posi&ccedil;&otilde;es PENDENTES</h3>
</div><!-- /.box-header -->	 
<div class="box box-primary"> 
		<label for="exampleInputEmail1"><form name="frmMudar" method="post">
			 Pesquisar Posi&ccedil;&otilde;es por: <select name="sltMudar" onchange="fMudarPagina()" class="form-control">
				<option selected>Selecione
				<option value="#">ATIVAS
				<option value="posicoes_rede_talk.php">PENDENTES
				<option value="#">DESATIVADAS 
			</select>
		</form></label> 
	<section class="content"> 
                    <div class="row"> 
						<div class="col-xs-12"> 
							<i>Ordem de Registros</i>
                            <div class="box"> 
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr> 
                                                <th>Id da Posi&ccedil;&atilde;o</th>
                                                <th>NOME do Cliente</th>
												<th>Indicado por LINK</th> 
												<th>ATIVAR</th> 
                                                <th>CANCELAR</th> 
												<th>Data De Cadastro</th> 
                                            </tr>
                                        </thead>   
			<?php
//######### INICIO Paginação
	$numreg = 1000; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	  
	$sql = $con->prepare("SELECT * FROM $tabela7 WHERE STATUS = 'PENDENTE' ORDER BY DATA_CADASTRO ASC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela3");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	
				foreach($sql_verifc as $ln_verifc) {
					// busca link do patrocinador
					$id_posicao_indicadopor = floor($ln_verifc->ID_POSICAO/2);  
					$sql_2 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$id_posicao_indicadopor'");
					$sql_2->execute();
					$sql_verifc_2 = $sql_2->fetchAll(PDO::FETCH_OBJ);
					foreach($sql_verifc_2 as $ln_verifc_2) {
						$link_indicadopor = $ln_verifc_2->LINK_INDICACAO;
					} 
					// busca nome do comprador
					$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ln_verifc->ID_CLIENTE'");
					$sql_2->execute();
					$sql_verifc_2 = $sql_2->fetchAll(PDO::FETCH_OBJ);
					foreach($sql_verifc_2 as $ln_verifc_2) {
						$nome_cliente_comprador = $ln_verifc_2->NOME;
					}
					
					$id_posicao = $ln_verifc->ID_POSICAO;
					$id_do_cliente = $ln_verifc->ID_CLIENTE;
					$id_do_patrocinador = $id_posicao_indicadopor;
?>
	<tbody>
        <tr>
						<td> <?php echo $id_posicao; ?>  </td>
						<td class='class1'><?php echo $nome_cliente_comprador; ?></td> 
						<td class='class2'> <?php echo $link_indicadopor; ?></td> 
						<td class='class2'>
						<form id="form1" name="form1" method="post" action="completo_posicao.php?posicao=<?php echo $id_posicao; ?>"> 
								<button type="submit" class="btn btn-success btn-sm" title="ATIVAR ESSE PACOTE AGORA">ATIVAR</button> 
						</form>
						</td>
						<td class='class2'> 
						<form id="form_cancela_1" name="form_cancela_1" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $id_posicao; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_do_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="CANCELAR ESSA COMPRA AGORA"  >Cancelar Compra</button> 
						</form> 
						</td>
						<td class='class2'> <?php echo $ln_verifc->DATA_CADASTRO; ?></td> 
					</tr>	
    </tbody>  	 
				<?php }  ?> 
<tfoot> 
                                            <tr>
                                                <th>Id da Posi&ccedil;&atilde;o</th>
                                                <th>NOME do Cliente</th>
												<th>Indicado por LINK</th> 
												<th>ATIVAR</th> 
                                                <th>CANCELAR</th> 
												<th>Data De Cadastro</th> 
                                            </tr>
                                        </tfoot> 
                                    </table>
<br>
<?php	include("paginacao.php");  ?>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
                    </div> 
                </section><!-- /.content --> 
</div><!-- /.box -->



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
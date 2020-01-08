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
 
 

 // se posciao = 0 ou vazio erro
$posicao = $_GET['posicao'];
if ($posicao == "" || $posicao == 0 ) {
	echo("<script type='text/javascript'> alert('Erro Na Pagina !!!'); location.href='posicoes_rede_talk.php';</script>"); 
	exit;
}

//busca posicao
try {
	$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$quant_clies = count( $res ); 
	
	foreach($res as $ln_clients) { 
		$id_posicao =  $ln_clients->ID_POSICAO;
		$id_clientes_posicao =  $ln_clients->ID_CLIENTE; 		
		$status_posicao =  $ln_clients->STATUS; 		
		$nivel_posicao =  $ln_clients->NIVEL; 		
		$link_indicacao_posicao =  $ln_clients->LINK_INDICACAO; 		 	
		 
		$datacadastro_posicao = $ln_clients->DATA_CADASTRO;
		$datacadastro_posicao = implode("/",array_reverse(explode("-",$datacadastro_posicao)));
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 
 

// verifica se ID do GEt existe
if ($quant_clies == "" || $quant_clies == 0 ) {
	echo("<script type='text/javascript'> alert('Essa posi\u00e7\u00e3o n\u00e3o existe !!!'); location.href='posicoes_rede_talk.php';</script>");
	exit;	
}


// busca clinete que comprou a posicao
try {
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_clientes_posicao");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln_patroc) { 
		$id_cliente =  $ln_patroc->ID;
		$nome_cliente =  $ln_patroc->NOME;
		$foto_cliente =  $ln_patroc->FOTO_PERFIL;		
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 



// busca patrocinador da posicao
$id_posicao_patrocinador = floor($posicao/2); 
try {
	$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$id_posicao_patrocinador'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln_patroc) { 
		$id_posicao_patrocinador =  $ln_patroc->ID_POSICAO; 
		$id_clientes_posicao_patrocinador =  $ln_patroc->ID_CLIENTE; 		
		$status_posicao_patrocinador =  $ln_patroc->STATUS; 		
		$nivel_posicao_patrocinador =  $ln_patroc->NIVEL; 		
		$link_indicacao_posicao_patrocinador =  $ln_patroc->LINK_INDICACAO; 		 	
		 
		$datacadastro_posicao_patrocinador = $ln_patroc->DATA_CADASTRO;
		$datacadastro_posicao_patrocinador = implode("/",array_reverse(explode("-",$datacadastro_posicao_patrocinador)));	
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 

// busca clientes que comprou a posicao do patrocinador da posicao get
try {
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_clientes_posicao_patrocinador'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln_patroc) { 
		$id_cliente_patrocinador =  $ln_patroc->ID;
		$nome_cliente_patrocinador =  $ln_patroc->NOME;
		$foto_cliente_patrocinador =  $ln_patroc->FOTO_PERFIL;		
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
                        <li class="active">Dados da Posi&ccedil;&atilde;o <b><?php echo $posicao; ?></b></li>
                    </ol>
                </section>
                <!-- Main content -->
                <section class="content">
 
<!-- centro -->	
<Script type = "text/javascript">

// funtion  para Formularios com apenas numeros
function Numero(e){  
	navegador = /msie/i.test(navigator.userAgent);
	if (navegador)   
		var tecla = event.keyCode;  
	else   
		var tecla = e.which;    
	if(tecla > 47 && tecla < 58) // numeros de 0 a 9   
		return true;  
	else {      
	if (tecla != 8) // backspace        
		return false;      
	else        
		return true;    
	}
}
//FIM funtion  para Formularios com apenas numeros


function verifica1() {  
	if (form1.id_do_cliente.value == "") { 
		alert("O ID do cliente \xE9 obrigat\xF3rio"); 
		return false;   
    } 

	if (form1.status_da_posicao.value == "DESATIVADO") { 
		if (form1.id_do_cliente.value != "0") { 
			alert("Se for 'DESATIVAR' ESSA POSI\u00c7\u00c3O, O ID DO CLIENTES TEM QUE SER IGUAL A '0'"); 
			return false;   
		} 
		if (form1.link_de_indicacao_da_posicao.value != "") { 
			alert("Se for 'DESATIVAR' ESSA POSI\u00c7\u00c3O, O LINK DE INDICA\u00c7\u00c3O TEM QUE ESTAR VAZIO"); 
			return false;   
		}     
    } 
	
	if (form1.status_da_posicao.value == "ATIVO") { 
		if (form1.id_do_cliente.value == "0") { 
			alert("Se for 'ATIVAR' ESSA POSI\u00c7\u00c3O, O ID DE UM CLIENTES \xE9 obrigat\xF3rio"); 
			return false;   
		} 
		if (form1.link_de_indicacao_da_posicao.value == "") { 
			alert("Se for 'ATIVAR' ESSA POSI\u00c7\u00c3O, O LINK DE INDICA\u00c7\u00c3O \xE9 obrigat\xF3rio"); 
			return false;   
		}   
		// LINK JA EXISTE
		<?php
			$sql_altera = $con->prepare("SELECT * FROM $tabela7 WHERE STATUS = 'ATIVO'");
			$sql_altera->execute();
			$res_altera = $sql_altera->fetchAll(PDO::FETCH_OBJ);
			foreach($res_altera as $ln_altera) { ?>
				if (form1.link_de_indicacao_da_posicao.value != "<?php echo $link_indicacao_posicao; ?>" && form1.link_de_indicacao_da_posicao.value == "<?php echo $ln_altera->LINK_INDICACAO; ?>") { 
					alert("Esse LINK DE INDICA\u00c7\u00c3O ja esta cadastrado no sistema."); 
					return false;   
				}  
			<?php   }  	  ?> 
	} 
}	
 
</script>


	 
 <div class="box-header">
		<h3 class="box-title">Dados do Cliente <b><?php echo $nome_clientes; ?></b></h3>
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
        <div class="nav-tabs-custom"> 
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Dados Do Posi&ccedil;&atilde;o</a></li> 
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    
						<label style="float:left;width:auto;"> 
							<?php if ($foto_cliente_patrocinador == "") { ?>
								<a href="completo.php?id_clients=<?php echo $id_cliente_patrocinador; ?>" title="Veja o Perfil Completo do(a) <?php echo $nome_cliente_patrocinador; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
							<?php } else { ?>
								<a href="completo.php?id_clients=<?php echo $id_cliente_patrocinador; ?>" title="Veja o Perfil Completo do(a) <?php echo $nome_cliente_patrocinador; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $foto_cliente_patrocinador; ?>"  class="img-circle" width="70" alt="Sua Imagem" /> </a>
							<?php } ?>
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Patrocinador <b><?php echo $nome_cliente_patrocinador; ?></b>  <br>
							Posi&ccedil&atilde;o de n&uacute;mero: <b><?php echo $id_posicao_patrocinador; ?></b> <a href="completo_posicao.php?posicao=<?php echo $id_posicao_patrocinador; ?>" title="Veja os Dados Dessa Posi&ccedil&atilde;o"><button class="btn btn-primary btn-sm">TOPO</button></a> <br>
							Status da Posi&ccedil&atilde;o: <?php if ($status_posicao_patrocinador == "ATIVO") { ?> <b style="color:#1dd31d;">ATIVO</b> <?php } else if  ($status_posicao_patrocinador == "PENDENTE") { ?> <b style="color:#e1e314;">PENDENTE</b> <?php } else if ($status_posicao_patrocinador == "DESATIVADO") { ?> <b style="color:RED;">PENDENTE</b> <?php } ?> <BR>
							LINK DE INDICA&Ccedil;&Atilde;O: <b style="color:red;font-size:40px;"><?php echo $link_indicacao_posicao_patrocinador; ?></b> <br>
						</label> 
						<br><br><br><br>
						<label style="float:right;width:auto;" >
						<?php if ($status_posicao != "DESATIVADO") { ?> 
								<?php if ($foto_cliente == "") { ?>
									<img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" />  
								<?php } else { ?>
									<img src="../../adm_clientes/img_perfil/<?php echo $foto_cliente; ?>"  class="img-circle" width="70" alt="Sua Imagem" /> 
								<?php } ?>
								Posi&ccedil&atilde;o do(a) <b><?php echo $nome_cliente; ?></b> <br>
								Posi&ccedil&atilde;o de n&uacute;mero: <b><?php echo $posicao; ?></b>  <br>
								Status da Posi&ccedil&atilde;o: <?php if ($status_posicao == "ATIVO") { ?> <b style="color:#1dd31d;">ATIVO</b> <?php } else if  ($status_posicao == "PENDENTE") { ?> <b style="color:#e1e314;">PENDENTE</b> <?php } else if ($status_posicao == "DESATIVADO") { ?> <b style="color:RED;">DESATIVADO</b> <?php } ?>
							 
						<?php } ELSE  { ?>
							Posi&ccedil&atilde;o de n&uacute;mero: <b><?php echo $posicao; ?></b>  <br>
							<button class="btn btn-danger  btn-lg">DESATIVADO</button>
						<?php } ?>
						</label>
						<br style="clear:both;">
						
						
						
						 <form id="form1" name="form1" method="post" action="alterando_posicao_talk.php">
							<div class="box-body">
								<label for="exampleInputEmail1">ID da Posi&ccedil;&atilde;o </label>  <b style="color:red;font-size:40px;"><?php echo $posicao; ?></b> <br>
								<input type="hidden" name="id_da_posicao" value="<?php echo $posicao; ?>"  />
								<label for="exampleInputEmail1">ID do Cliente COMPRADOR*: </label> <i class="fa fa-level-down"></i> <input type="text" name="id_do_cliente" value="<?php echo $id_cliente; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o ID do Cliente COMPRADOR" onkeypress="return Numero(event);" />
								<label for="exampleInputEmail1">STATUS da Posi&ccedil&atilde;o *: </label> 
								<select class="form-control" name="status_da_posicao">  
										<option value="<?php echo $status_posicao; ?>"><?php echo $status_posicao; ?></option>  
										<?php if ($status_posicao == "ATIVO") { ?>
											<option value="PENDENTE">PENDENTE</option>
											<option value="DESATIVADO">DESATIVADO</option>
										<?php } else if ($status_posicao == "PENDENTE") { ?>
											<option value="ATIVO">ATIVO</option>
											<option value="DESATIVADO">DESATIVADO</option>
										<?php } else if ($status_posicao == "DESATIVADO") { ?>
											<option value="ATIVO">ATIVO</option>
											<option value="PENDENTE">PENDENTE</option>
										<?php }  ?>
								</select>  
								<label for="exampleInputEmail1">LINK de INDICA&Ccedil;&Atilde;O da Posi&ccedil&atilde;o*: </label> <i class="fa fa-user"></i> <input type="text" name="link_de_indicacao_da_posicao" value="<?php echo $link_indicacao_posicao; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o LINK de INDICA&Ccedil;&Atilde;O DESSA Posi&ccedil&atilde;o" onkeypress="return Numero(event);" />
								<br>
								Essa Posi&ccedil&atilde;o foi Cadastra dia <b style="color:red;font-size:40px;"><?php echo $datacadastro_posicao; ?> </b><br>
								<br>
							</div> 
							<div class="box-footer">
								<input type="submit" class="btn btn-primary" Onclick="return verifica1()"  value="ALTERAR DADOS" /> 
							</div>
						</form>		

						
				</div><!-- /.tab-pane --> 
			</div><!-- /.tab-content -->
        </div><!-- nav-tabs-custom -->     

			
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
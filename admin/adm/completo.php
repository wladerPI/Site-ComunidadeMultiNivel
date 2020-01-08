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
 
 
$grava = $_GET['id_clients'];
if ($grava == "" || $grava == 0 ) {
	echo("<script type='text/javascript'> alert('Erro Na Pagina !!!'); location.href='todos_clientes.php';</script>"); 
	exit;
}

try {
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $grava");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$quant_clies = count( $res ); 
	
	foreach($res as $ln_clients) { 
		$id_clientes =  $ln_clients->ID;
		$nome_clientes =  $ln_clients->NOME; 		
		$patrocinador_clientes =  $ln_clients->ID_INDICACAO; 		
		$data_nasc_clientes =  $ln_clients->DATA_NASCIMENTO; 		
		$pais_clientes =  $ln_clients->PAIS; 		
		$estado_clientes =  $ln_clients->ESTADO; 		
		$cidade_clientes =  $ln_clients->CIDADE; 		
		$tel_clientes =  $ln_clients->TELEFONE; 		
		$cel_clientes =  $ln_clients->CELULAR; 		
		$skype_clientes =  $ln_clients->SKYPE; 		
		$face_clientes =  $ln_clients->FACEBOOK; 
		$email_clientes =  $ln_clients->EMAIL; 
		$senha_clientes =  $ln_clients->SENHA; 
		$foto_clientes =  $ln_clients->FOTO_PERFIL; 
		$pontos_clientes =  $ln_clients->PONTOS; 
		$talk_clientes =  $ln_clients->TALK_FUSION; 
		$agn_clientes =  $ln_clients->AGN; 
		$ultimo_acesso_clientes =  $ln_clients->ULTIMOACESSO; 
 
		$data_cadastro_clientes = $ln_clients->DATA_CADASTRO;
		$data_cadastro_clientes = implode("/",array_reverse(explode("-",$data_cadastro_clientes)));
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 

// verifica se ID do GEt existe
if ($quant_clies == "" || $quant_clies == 0 ) {
	echo("<script type='text/javascript'> alert('Esse Cliente n\u00e3o existe !!!'); location.href='todos_clientes.php';</script>");
	exit;	
}


// busca patrocinador
try {
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $patrocinador_clientes");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln_patroc) { 
		$id_patroc =  $ln_patroc->ID;
		$nome_patroc =  $ln_patroc->NOME;
		$foto_patroc =  $ln_patroc->FOTO_PERFIL;		
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 

// busca quantidades de pacotes da TALK
try {
	$sql = $con->prepare("SELECT * FROM $tabela4 WHERE ID_CLIENTES = $id_clientes");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$quant_pacotes = count( $res );
	 
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
                        <li class="active">Dados do Cliente <b><?php echo $nome_clientes; ?></b></li>
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
	if (form1.patrocinador_clientes.value == "") { 
		alert("O ID do Patrocinador \xE9 obrigat\xF3rio"); 
		return false;   
    } 	
	if (form1.nome_clientes.value == "") { 
		alert("O Nome \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form1.pais_clientes.value == "") { 
		alert("O campo Pais \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form1.estado_clientes.value == "") { 
		alert("O campo Estado \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form1.cidade_clientes.value == "") { 
		alert("O campo Cidade \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form1.tel_clientes.value == "" && form1.cel_clientes.value == "" && form1.skype_clientes.value == "" && form1.face_clientes.value == "") { 
		alert("Pelo menos um dos camos (Telefone, Celular, Skype ou Facebook) \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email_clientes.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.form1.email_clientes");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    } 
	
<?php
try {
		$sql_altera = $con->prepare("SELECT * FROM $tabela3");
		$sql_altera->execute();
		$res_altera = $sql_altera->fetchAll(PDO::FETCH_OBJ);
		foreach($res_altera as $ln_altera) {
?>
	
	if (form1.email_altera.value != "<?php echo $email_clientes; ?>" && form1.email_altera.value == "<?php echo $ln_altera->EMAIL; ?>") { 
		alert("Esse E-mail ja esta cadastrado no sistema."); 
		return false;   
    } 

	if (form1.senha_clientes.value == "") { 
		alert("O campo Senha \xE9 obrigat\xF3rio"); 
		return false;   
    }  
<?php  
} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
} 
?>		  
}




function verifica3() {  
	if (form3.add_pontos.value == "") { 
		alert("O Adicionar pontos ADICIONAL \xE9 obrigat\xF3rio"); 
		return false;   
    } 	   
}

function verifica4() {  
	if (form4.retirar_pontos.value == "") { 
		alert("O Retirar pontos  \xE9 obrigat\xF3rio"); 
		return false;   
    } 	   
}
</script>


	 
 <div class="box-header">
		<h3 class="box-title">Dados do Cliente <b><?php echo $nome_clientes; ?></b></h3>
</div><!-- /.box-header -->	 
<div class="box box-primary"> 
		<label for="exampleInputEmail1"><form name="frmMudar" method="post">
			 Pesquisar cliente por: <select name="sltMudar" onchange="fMudarPagina()" class="form-control">
				<option selected>Selecione
				<option value="todos_clientes.php">Todos Clientes
				<option value="pesquisa_client_id.php">ID
				<option value="pesquisa_client_nome.php">Nome
				<option value="pesquisa_client_cidade.php">Cidade
				<option value="pesquisa_client_email.php">E-mail
				<option value="pesquisa_client_pontos.php">Pontos
			</select>
		</form></label>  
                <!-- Custom Tabs -->
                            <div class="nav-tabs-custom"> 
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab">Dados Do Cliente</a></li>
                                    <li><a href="#tab_2" data-toggle="tab">Participa&ccedil;&atilde;o dos Projetos</a></li>
									<li><a href="#tab_3" data-toggle="tab">Rede</a></li>
									<li><a href="#tab_4" data-toggle="tab">Add Pontos Adicionais</a></li>  
									<li><a href="#tab_5" data-toggle="tab">RETIRAR Pontos</a></li> 
									<li><a href="#tab_6" data-toggle="tab">Advert&ecirc;ncias</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_1">
                                         <form id="form1" name="form1" method="post" action="dadosclientes_alterando.php">
												<div class="box-body">
													<div class="form-group"> 
														<label style="float:left;width:auto;"> 
															<?php if ($foto_patroc == "") { ?>
																	<a href="completo.php?id_clients=<?php echo $ln_patroc->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_verifc->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
															<?php } else { ?>
																	<a href="completo.php?id_clients=<?php echo $ln_patroc->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_verifc->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $foto_patroc; ?>"  class="img-circle" width="70" alt="Sua Imagem" /> </a>
															<?php } ?>
															&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Patrocinador <b><?php echo $nome_patroc; ?></b>
														</label> 
														<br><br><br><br>
														<label style="float:right;width:auto;" > 
															<?php if ($foto_clientes == "") { ?>
																	<img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" />  
															<?php } else { ?>
																	<img src="../../adm_clientes/img_perfil/<?php echo $foto_clientes; ?>"  class="img-circle" width="70" alt="Sua Imagem" /> 
															<?php } ?>
															Dados Pessoais do(a) <b><?php echo $nome_clientes; ?></b>
														</label> 
														<br style="clear:both;">
														<label for="exampleInputEmail1">ID do cliente &eacute </label>  (<b><?php echo $id_clientes; ?></b>) <br>
														<input type="hidden" name="id_do_clientes" value="<?php echo $id_clientes; ?>"  />
														<label for="exampleInputEmail1">ID do Patrocinador*: </label> <i class="fa fa-level-down"></i> <input type="text" name="patrocinador_clientes" value="<?php echo $patrocinador_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o ID do Cliente" />
														<label for="exampleInputEmail1">Nome*: </label> <i class="fa fa-user"></i> <input type="text" name="nome_clientes" value="<?php echo $nome_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o nome do Cliente" />
														<label for="exampleInputEmail1">Data de Nascimento: </label> <i class="fa fa-user"></i> <input type="text" name="datanasc_clientes" value="<?php echo $data_nasc_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite a Data de Nascimento, exemplo: 00/00/0000" />
														<label for="exampleInputEmail1">Pa&iacute;s*: </label> <i class="fa fa-arrow-down"></i> <input type="text" name="pais_clientes" value="<?php echo $pais_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o nome do pa&iacute;s" />
														<label for="exampleInputEmail1">Estado*: </label> <i class="fa fa-arrow-down"></i> <input type="text" name="estado_clientes" value="<?php echo $estado_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o nome do estado" />
														<label for="exampleInputEmail1">Cidade*: </label> <i class="fa fa-arrow-down"></i> <input type="text" name="cidade_clientes" value="<?php echo $cidade_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o nome da Cidade" />
														<hr>
														<i>* Pelo menos 1 dos 4 formul&aacute;rios de contatos abaixo ser&aacute; obrigat&oacute;rio.</i><BR>
														<label for="exampleInputEmail1">Telefone: </label> <i class="fa  fa-phone"></i> <input type="text" name="tel_clientes" value="<?php echo $tel_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o um n&uacute;mero de Telefone Fixo Exemplo: (00) 00000000" />
														<label for="exampleInputEmail1">Celular: </label> <i class="fa  fa-phone"></i> <input type="text" name="cel_clientes" value="<?php echo $cel_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o um n&uacute;mero de Celular Exemplo: (00) 00000000" />
														<label for="exampleInputEmail1">Skype: </label> <i class="fa fa-skype"></i> <input type="text" name="skype_clientes" value="<?php echo $skype_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite um endere&ccedil;o do skype" />
														<label for="exampleInputEmail1">Facebook: </label> <i class="fa fa-facebook-square"></i> <input type="text" name="face_clientes" value="<?php echo $face_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite o LINK de seu Perfil do Facebook: exemplo: https://www.facebook.com/ComunidadeMultiNivel" />
														<hr>
														<label for="exampleInputEmail1">Email*: </label> <i class="fa fa-envelope"></i> <input type="text" name="email_clientes" value="<?php echo $email_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite um E-mail" />
														<label for="exampleInputEmail1">Senha*: </label> <i class="fa fa-key"></i> <input type="text" name="senha_clientes" value="<?php echo $senha_clientes; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite uma Senha" />
														<br>
														Esse Cliente foi Cadastro dia <?php echo $data_cadastro_clientes; ?><br>
														<?php if ($ultimo_acesso_clientes == "") {
															echo "<i>Esse Cliente nunca Acesso o painel de controle</i>";
														} else {  ?>
															<i>&Uacute;timo acesso foi <?php echo $ultimo_acesso_clientes; ?></i>	
														<?php } ?>
														<br>
													</div>
												</div><!-- /.box-body -->
												<div class="box-footer">
													<input type="submit" class="btn btn-primary" Onclick="return verifica1()"  value="ALTERAR DADOS" /> 
												</div>
										</form>		
										 
										 
                                    </div><!-- /.tab-pane -->
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
<div class="tab-pane" id="tab_2"> 
	<p><b><?php echo $nome_clientes; ?></b> Est&aacute; Participando dos Seguintes Projetos; </p> 
	<hr>
	<?php if ( $talk_clientes == "SIM") { ?>
<?php
$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_clientes' && STATUS = 'ATIVO'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_ativos_table = count( $res );
?>	
	<img src="img/icon_talkfusion.png" width="100" height="100" alt="Acesse aqui o site da TALK FUSION"   />
	<div class="box-header">
		<h3 class="box-title"><?php echo $nome_clientes; ?></b> est&aacute; registrado(a) na TALK FUSION com (<?php echo $total_ativos_table; ?>) Pacote(s) ATIVO(s)</h3>
    </div><!-- /.box-header --> 
		<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>DATA de Registro</th>  
						<th>LINK de Indica&ccedil;&atilde;o</th>
						<th>Selecione seu LINK Principal</th> 
					</tr>
				</thead>
 <?php
	foreach($res as $ln_verifc) {  
			$ja_esta_cadastrado_id_table = $ln_verifc->ID;
			$data_table = $ln_verifc->DATA_CADASTRO;
			$data_table = implode("/",array_reverse(explode("-",$data_table))); 
			$ja_esta_cadastrado_links_table = $ln_verifc->LINK_INDICACAO; 
			$ja_esta_cadastrado_link_principal_table = $ln_verifc->LINK_PRINCIPAL; 
?>		
			<thead>
				<tr <?php if ($ja_esta_cadastrado_link_principal_table == 'SIM') {?>  style="background:#e6eff6;" <?php } ?> >
						<th><?php echo $data_table; ?></th> 
						<th>http://<?php echo $ja_esta_cadastrado_links_table; ?>.talkfusion.com/pt/</th> 
						<th>
							
						<?php echo $ja_esta_cadastrado_link_principal_table; ?>
						 
						</th> 
					</tr>
				</thead> 
<?php 
	} 
?> 
 
			</table>
	<?php } ?>	
	<hr>
	<br>
</div> 	 
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									<div class="tab-pane" id="tab_3">
									 
<?php
// QUANTIDADE DE PESSOAS NA REDE 

try {	
	// busca nivel 1
	$sql4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id_clientes."'"); 
	$sql4->execute();
	$res4 = $sql4->fetchAll(PDO::FETCH_OBJ);  
	$total_1 = count( $res4 );
	 
	
	$total_nivel_2 = 0;
	$total_nivel_3 = 0;
	$total_nivel_4 = 0;
	$total_nivel_5 = 0;
	// busca nivel 2
	foreach($res4 as $ln4) { 
		$sql5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln4->ID."'"); 
		$sql5->execute();
		$res5 = $sql5->fetchAll(PDO::FETCH_OBJ);  
		$total_2 = count( $res5 );
		 
		if ($total_2 > 0) {
			$total_nivel_2 += $total_2; 
		} 
		
		// busca nivel 3
		foreach($res5 as $ln5) {
			$sql6 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln5->ID."'"); 
			$sql6->execute();
			$res6 = $sql6->fetchAll(PDO::FETCH_OBJ);  
			$total_3 = count( $res6 );  
			  
			if ($total_3 > 0) {
				$total_nivel_3 += $total_3; 
			} 
			
			// busca nivel 4
			foreach($res6 as $ln6) {
				$sql7 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln6->ID."'"); 
				$sql7->execute();
				$res7 = $sql7->fetchAll(PDO::FETCH_OBJ);  
				$total_4 = count( $res7 ); 
				 
				if ($total_4 > 0) { 
					$total_nivel_4 += $total_4; 
				}

				// busca nivel 5
				foreach($res7 as $ln7) {
					$sql8 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln7->ID."'"); 
					$sql8->execute();
					$res8 = $sql8->fetchAll(PDO::FETCH_OBJ);  
					$total_5 = count( $res8 );  
					 
					if ($total_5 > 0) {
						$total_nivel_5 += $total_5; 
					} 
				}
			}
		}
	} 
	$valor_total_niveis = $total_1+$total_nivel_2+$total_nivel_3+$total_nivel_4+$total_nivel_5;  
} catch(PODException $e4) {
	echo "Erro:/n".$e4->getMessage();
}  
 
?>	                                       
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Lista de Seus Indicados Diretos e indiretos no Sistema, UM TOTAL DE <B><?php echo $valor_total_niveis; ?></B> PESSOAS ENTRE SEUS 5 N&Iacute;VEIS DE INDICA&Ccedil;&Otilde;ES.</h3>
    </div><!-- /.box-header -->
	<section class="content">
		<table id="tabela_niveis" class="table table-bordered table-striped">
            <thead>
				<tr>
					<th>N&iacute;veis</th>
					<th>Quantidade de pessoas</th>
                </tr>
            </thead> 
			<tbody> 
				<tr >
					<td > N&iacute;vel 1</td>
					<td><?php echo $total_1; ?></td>
				</tr>
			</tbody> 
			<tbody> 
				<tr>
					<td>N&iacute;vel 2</td>
					<td><?php echo $total_nivel_2; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 3</td>
					<td><?php echo $total_nivel_3; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 4</td>
					<td><?php echo $total_nivel_4; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 5</td>
					<td><?php echo $total_nivel_5; ?></td>
				</tr>
			</tbody>
		</table> 
                    <div class="row"> 
                        <div class="col-xs-12"> 
							<i>Ordem de Indica&ccedil;&atilde;o.</i>
                            <div class="box"> 
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Foto do Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Total de Diretos</th>
												<th>Cliente do N&iacute;vel</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </thead> 									   
<?php
// QUANTIDADE DE PESSOAS NA REDE  
try {	
	// busca nivel 1
	$sql9 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id_clientes."' "); 
	$sql9->execute();
	$res9 = $sql9->fetchAll(PDO::FETCH_OBJ);  
	$total_1 = count( $res9 );
	 
	 
	$total_nivel_2 = 0;
	$total_nivel_3 = 0;
	$total_nivel_4 = 0;
	$total_nivel_5 = 0; 
	foreach($res9 as $ln9) {  
		if ($total_1 > 0) {
			// POSICIONAMENTO DOS SEUS DIRETOS NO RANK 
			try {
				$sql_rank = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
				$sql_rank->execute();
				$res_rank = $sql_rank->fetchAll(PDO::FETCH_OBJ);
				$i_rank = 1;
				foreach($res_rank as $ln_rank) {
					if ($ln_rank->ID == $ln9->ID) { 
						$rankafiliado = $i_rank;
					}
				$i_rank++;
				} 
			} catch(PODException $e_rank) {
				echo "Erro:/n".$e_rank->getMessage();
			}
			// TOTAL DE DIRETOS DOS SEUS DIRETOS
			try {
				$sql_drt = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln9->ID."");
				$sql_drt->execute();
				$res_drt = $sql_drt->fetchAll(PDO::FETCH_OBJ); 
				$total_drt = count( $res_drt );
				
			} catch(PODException $drt) {
				echo "Erro:/n".$drt->getMessage();
			} 
			
			// EXPLODE DATA dos DIRETOS
			$data_drt = $ln9->DATA_CADASTRO;
			$data_drt = implode("/",array_reverse(explode("-",$data_drt)));
	
	
?>	 
<tbody>
        <tr>
			<td> 
				<?php if ($ln9->FOTO_PERFIL == "") { ?>
					<a href="completo.php?id_clients=<?php echo $ln9->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln9->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
				<?php } else { ?>
					<a href="completo.php?id_clients=<?php echo $ln9->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln9->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ln9->FOTO_PERFIL; ?>"  class="img-circle" width="70" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><?php echo $ln9->NOME; ?></a> </td>
            <td><?php echo $rankafiliado; ?> &deg;</td>
            <td><?php echo $ln9->PONTOS; ?></td>
            <td><?php echo $total_drt; ?></td>
			<td><?php echo "N&iacute;vel 1"; ?></td>
            <td><?php echo $data_drt; ?></td>
        </tr>
    </tbody> 
<?php	  
		} 
		// busca nivel 2
		$sql10 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln9->ID."'"); 
		$sql10->execute();
		$res10 = $sql10->fetchAll(PDO::FETCH_OBJ);  
		$total_2 = count( $res10 ); 
		foreach($res10 as $ln10) {
			if ($total_2 > 0) {
				// POSICIONAMENTO DOS SEU nivel 2 no RANK 
				try {
					$sql_rank2 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
					$sql_rank2->execute();
					$res_rank2 = $sql_rank2->fetchAll(PDO::FETCH_OBJ);
					$i_rank2 = 1;
					foreach($res_rank2 as $ln_rank2) {
						if ($ln_rank2->ID == $ln10->ID) { 
							$rankafiliado2 = $i_rank2;
						}
					$i_rank2++;
					} 
				} catch(PODException $e_rank2) {
					echo "Erro:/n".$e_rank2->getMessage();
				}
				
				// TOTAL DE DIRETOS DOS SEUS DIRETOS
				try {
					$sql_drt2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln10->ID."");
					$sql_drt2->execute();
					$res_drt2 = $sql_drt2->fetchAll(PDO::FETCH_OBJ); 
					$total_drt2 = count( $res_drt2 );
					
				} catch(PODException $drt2) {
					echo "Erro:/n".$drt2->getMessage();
				} 
				
				// EXPLODE DATA dos DIRETOS
				$data_drt2 = $ln10->DATA_CADASTRO;
				$data_drt2 = implode("/",array_reverse(explode("-",$data_drt2)));
				 
?>	 		 
	<tbody>
        <tr>
			<td> 
				<?php if ($ln10->FOTO_PERFIL == "") { ?>
					<a href="completo.php?id_clients=<?php echo $ln10->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln10->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
				<?php } else { ?>
					<a href="completo.php?id_clients=<?php echo $ln10->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln10->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ln10->FOTO_PERFIL; ?>"  class="img-circle" width="70" alt="Sua Imagem" /></a>
				<?php } ?>
			</td> 
			<td><?php echo $ln10->NOME; ?></a> </td>
            <td><?php echo $rankafiliado2; ?> &deg;</td>
            <td><?php echo $ln10->PONTOS; ?></td>
            <td><?php echo $total_drt2; ?></td>
			<td><?php echo "N&iacute;vel 2"; ?></td>
            <td><?php echo $data_drt2; ?></td>
        </tr>
    </tbody> 
<?php	
			}   
			// busca nivel 3
			$sql11 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln10->ID."'"); 
			$sql11->execute();
			$res11 = $sql11->fetchAll(PDO::FETCH_OBJ);  
			$total_3 = count( $res11 );
			
			foreach($res11 as $ln11) {
				if ($total_3 > 0) {
					// POSICIONAMENTO DOS SEU nivel 3 no RANK 
					try {
						$sql_rank3 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
						$sql_rank3->execute();
						$res_rank3 = $sql_rank3->fetchAll(PDO::FETCH_OBJ);
						$i_rank3 = 1;
						foreach($res_rank3 as $ln_rank3) {
							if ($ln_rank3->ID == $ln11->ID) { 
								$rankafiliado3 = $i_rank3;
							}
						$i_rank3++;
						} 
					} catch(PODException $e_rank3) {
						echo "Erro:/n".$e_rank3->getMessage();
					}
					
					// TOTAL DE DIRETOS DOS SEUS DIRETOS
					try {
						$sql_drt3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln11->ID."");
						$sql_drt3->execute();
						$res_drt3 = $sql_drt3->fetchAll(PDO::FETCH_OBJ); 
						$total_drt3 = count( $res_drt3 );
						
					} catch(PODException $drt3) {
						echo "Erro:/n".$drt3->getMessage();
					} 
					
					// EXPLODE DATA dos DIRETOS
					$data_drt3 = $ln11->DATA_CADASTRO;
					$data_drt3 = implode("/",array_reverse(explode("-",$data_drt3)));
					 
	?>	  
		<tbody>
			<tr>
				<td> 
					<?php if ($ln11->FOTO_PERFIL == "") { ?>
						<a href="completo.php?id_clients=<?php echo $ln11->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln11->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
					<?php } else { ?>
						<a href="completo.php?id_clients=<?php echo $ln11->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln11->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ln11->FOTO_PERFIL; ?>"  class="img-circle" width="70" alt="Sua Imagem" /></a>
					<?php } ?>
				</td> 
				<td><?php echo $ln11->NOME; ?></a> </td>
				<td><?php echo $rankafiliado3; ?> &deg;</td>
				<td><?php echo $ln11->PONTOS; ?></td>
				<td><?php echo $total_drt3; ?></td>
				<td><?php echo "N&iacute;vel 3"; ?></td>
				<td><?php echo $data_drt3; ?></td>
			</tr>
		</tbody> 
	<?php	
				}  
				 
				// busca nivel 4
				$sql12 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln11->ID."'"); 
				$sql12->execute();
				$res12 = $sql12->fetchAll(PDO::FETCH_OBJ);  
				$total_4 = count( $res12 ); 
				foreach($res12 as $ln12) {
					if ($total_4 > 0) {
						// POSICIONAMENTO DOS SEU nivel 4 no RANK 
						try {
							$sql_rank4 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
							$sql_rank4->execute();
							$res_rank4 = $sql_rank4->fetchAll(PDO::FETCH_OBJ);
							$i_rank4 = 1;
							foreach($res_rank4 as $ln_rank4) {
								if ($ln_rank4->ID == $ln12->ID) { 
									$rankafiliado4 = $i_rank4;
								}
							$i_rank4++;
							} 
						} catch(PODException $e_rank4) {
							echo "Erro:/n".$e_rank4->getMessage();
						}
						
						// TOTAL DE DIRETOS DOS SEUS DIRETOS
						try {
							$sql_drt4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln12->ID."");
							$sql_drt4->execute();
							$res_drt4 = $sql_drt4->fetchAll(PDO::FETCH_OBJ); 
							$total_drt4 = count( $res_drt4 );
							
						} catch(PODException $drt4) {
							echo "Erro:/n".$drt4->getMessage();
						} 
						
						// EXPLODE DATA dos DIRETOS
						$data_drt4 = $ln12->DATA_CADASTRO;
						$data_drt4 = implode("/",array_reverse(explode("-",$data_drt4)));
						 
		?>	  
			<tbody>
				<tr>
					<td> 
						<?php if ($ln12->FOTO_PERFIL == "") { ?>
							<a href="completo.php?id_clients=<?php echo $ln12->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln12->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
						<?php } else { ?>
							<a href="completo.php?id_clients=<?php echo $ln12->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln12->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ln12->FOTO_PERFIL; ?>"  class="img-circle" width="70" alt="Sua Imagem" /></a>
						<?php } ?>
					</td> 
					<td><?php echo $ln12->NOME; ?></a> </td>
					<td><?php echo $rankafiliado4; ?> &deg;</td>
					<td><?php echo $ln12->PONTOS; ?></td>
					<td><?php echo $total_drt4; ?></td>
					<td><?php echo "N&iacute;vel 4"; ?></td>
					<td><?php echo $data_drt4; ?></td>
				</tr>
			</tbody> 
		<?php	
					}
					// busca nivel 5
					$sql13 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln12->ID."'"); 
					$sql13->execute();
					$res13 = $sql13->fetchAll(PDO::FETCH_OBJ);  
					$total_5 = count( $res13 ); 
					foreach($res13 as $ln13) {
						if ($total_5 > 0) {
							// POSICIONAMENTO DOS SEU nivel 5 no RANK 
							try {
								$sql_rank5 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
								$sql_rank5->execute();
								$res_rank5 = $sql_rank5->fetchAll(PDO::FETCH_OBJ);
								$i_rank5 = 1;
								foreach($res_rank5 as $ln_rank5) {
									if ($ln_rank5->ID == $ln13->ID) { 
										$rankafiliado5 = $i_rank5;
									}
								$i_rank5++;
								} 
							} catch(PODException $e_rank5) {
								echo "Erro:/n".$e_rank5->getMessage();
							}
							
							// TOTAL DE DIRETOS DOS SEUS DIRETOS
							try {
								$sql_drt5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln13->ID."");
								$sql_drt5->execute();
								$res_drt5 = $sql_drt5->fetchAll(PDO::FETCH_OBJ); 
								$total_drt5 = count( $res_drt5 );
								
							} catch(PODException $drt5) {
								echo "Erro:/n".$drt5->getMessage();
							} 
							
							// EXPLODE DATA dos DIRETOS
							$data_drt5 = $ln13->DATA_CADASTRO;
							$data_drt5 = implode("/",array_reverse(explode("-",$data_drt5)));
							 
			?>	  
				<tbody>
					<tr>
						<td> 
							<?php if ($ln13->FOTO_PERFIL == "") { ?>
								<a href="completo.php?id_clients=<?php echo $ln13->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln13->NOME; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="70" /> </a>
							<?php } else { ?>
								<a href="completo.php?id_clients=<?php echo $ln13->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln13->NOME; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ln13->FOTO_PERFIL; ?>"  class="img-circle" width="70" alt="Sua Imagem" /></a>
							<?php } ?>
						</td> 
						<td><?php echo $ln13->NOME; ?></a> </td>
						<td><?php echo $rankafiliado5; ?> &deg;</td>
						<td><?php echo $ln13->PONTOS; ?></td>
						<td><?php echo $total_drt5; ?></td>
						<td><?php echo "N&iacute;vel 5"; ?></td>
						<td><?php echo $data_drt5; ?></td>
					</tr>
				</tbody> 
			<?php	
						}   
					}
				}  
			} 
		}	  
	} 
 
} catch(PODException $e9) {
	echo "Erro:/n".$e9->getMessage();
}   	
	
?>										 
                                        <tfoot>
                                            <tr>
												<th>Foto do Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Total de Diretos</th>
												<th>Cliente do N&iacute;vel</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box --> 
							</div><!-- /.col -->			 
        </div> 
    </section><!-- /.content --> 
</div><!-- /.box -->							 

                                    </div><!-- /.tab-pane -->
									
									
									
									
									
									
									
									
									<div class="tab-pane" id="tab_4"> 
											<h3 style="color:red;">Total de pontos: <?php echo $pontos_clientes; ?></h3>
												<form method="post" id="form3" name="form3" action="adicionando_pontos.php">
													<div class="box-body">
														<div class="form-group"> 
															<input type="hidden" name="id_do_clientes3" value="<?php echo $id_clientes; ?>"  />  
																 <label for="exampleInputEmail1">Adicionar pontos ADICIONAL*:   </label> <i class="fa fa-angle-double-up"></i> <input type="text" name="add_pontos"  onkeypress="return Numero(event);" class="form-control" id="exampleInputEmail1" placeholder="Digite a quantidade de pontos adicional que ser&aacute; acrescentada para esse cliente" />
														</div>
													</div><!-- /.box-body -->
													<div class="box-footer">
														<input type="submit" class="btn btn-primary"  Onclick="return verifica3()" value="ADD PONTOS" /> 
													</div>
												</form>		 
                                    </div><!-- /.tab-pane -->
									
									
									
									<div class="tab-pane" id="tab_5"> 
											<h3 style="color:red;">Total de pontos: <?php echo $pontos_clientes; ?></h3>
												<form method="post" id="form4" name="form4" action="retirando_pontos.php">
													<div class="box-body">
														<div class="form-group"> 
															<input type="hidden" name="id_do_clientes4" value="<?php echo $id_clientes; ?>"  />  
																 <label for="exampleInputEmail1">Retirar pontos*:   </label> <i class="fa fa-angle-double-down"></i> <input type="text" name="retirar_pontos" onkeypress="return Numero(event);" class="form-control" id="exampleInputEmail1" style="color:red;font:20px bold;" placeholder="Digite a quantidade de pontos que ser&aacute; RETIRADO desse cliente" />
														</div>
													</div><!-- /.box-body -->
													<div class="box-footer">
														<input type="submit" class="btn btn-primary"  Onclick="return verifica4()" value="RETIRAR PONTOS" /> 
													</div>
												</form>		 
                                    </div><!-- /.tab-pane -->
									
									
									<div class="tab-pane" id="tab_6">
									
<?php
//######### INICIO Paginação
	$numreg = 1000; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	  
	$sql = $con->prepare("SELECT * FROM $tabela6 WHERE ID_CLIENTE = '".$id_clientes."' ORDER BY ID DESC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela6 WHERE ID_CLIENTE = '".$id_clientes."'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	if ($quantreg < 1) {
		echo "<h3 style='color:red;'>$nome_clientes, N&atilde;o tem nenhuma advert&ecirc;ncia.</h3>";
	} else {
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
?>								
									
					 					 
											<h3 style="color:red;">Total de Advert&ecirc;ncias: <?php echo $quantreg; ?></h3>
											<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>DESCRI&Ccedil;&Atilde;O</th>
												<th>Pontos advertidos</th> 
                                                <th>Data de Advert&ecirc;ncia</th> 
                                            </tr>
                                        </thead>   
			<?php
 
				foreach($sql_verifc as $ln_verifc) {
					$data = $ln_verifc->DATA_ADVERTENCIA;
					$data = implode("/",array_reverse(explode("-",$data)));
?>
	<tbody>
        <tr>
						<td class='class1'><?php echo $ln_verifc->ID; ?></td> 
						<td class='class1'><?php echo $ln_verifc->DESCRICAO; ?></td>
						<td class='class2'> <?php echo $ln_verifc->PONTOS_ADVERTIDOS; ?></td>
					    <td class='class1'><?php echo $data; ?></td> 
					</tr>	
    </tbody>  	 
				<?php }  ?> 
<tfoot> 
                                            <tr>
                                                <th>Id</th>
                                                <th>DESCRI&Ccedil;&Atilde;O</th>
												<th>Pontos advertidos</th> 
                                                <th>Data de Advert&ecirc;ncia</th>
                                            </tr>
                                        </tfoot> 
                                    </table>
<br>
<?php	include("paginacao.php");  } ?>
                                </div><!-- /.box-body -->		 
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
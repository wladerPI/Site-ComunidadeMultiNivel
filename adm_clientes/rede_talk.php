<?php
session_start(); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
error_reporting(E_ALL & ~ E_NOTICE); 

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
		$id_patrocinador = $ln_verifc->ID_INDICACAO;
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS; 		
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL;
		$talk = $ln_verifc->TALK_FUSION;
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
 
 $posicao = $_GET['posicao'];
 
if ($posicao == "" || $posicao == 0) {
	// detecta se esse cliente ja tem uma posicao
	$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_cliente' ORDER BY ID_POSICAO ASC LIMIT 1");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$verifica_position = count( $res );
	foreach($res as $ln) { 
		$position = $ln->ID_POSICAO;  
	}  

	if ($verifica_position <= 0) {
		// busca posicao do patrocinador
		$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_patrocinador' ORDER BY ID_POSICAO ASC LIMIT 1 ");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		$verifica_position1 = count( $res );
		foreach($res as $ln) { 
			$position1 = $ln->ID_POSICAO;  
		}
		if ($verifica_position1 <= 0) {
			// busca patrocinador 2
			$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador'");
			$sql_verifc->execute();
			$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
			foreach($res_verifc as $ln_verifc) { 
				$id_patrocinador2 = $ln_verifc->ID_INDICACAO; 
			}	
			// busca posicao do patrocinador 2
			$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_patrocinador2'  ORDER BY ID_POSICAO ASC LIMIT 1");
			$sql->execute();
			$res = $sql->fetchAll(PDO::FETCH_OBJ);
			$verifica_position2 = count( $res );
			foreach($res as $ln) { 
				$position2 = $ln->ID_POSICAO;  
			}
			if ($verifica_position2 <= 0) {
				// busca patrocinador 3
				$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador2'");
				$sql_verifc->execute();
				$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
				foreach($res_verifc as $ln_verifc) { 
					$id_patrocinador3 = $ln_verifc->ID_INDICACAO; 
				}	
				// busca posicao do patrocinador 3
				$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_patrocinador3' ORDER BY ID_POSICAO ASC LIMIT 1 ");
				$sql->execute();
				$res = $sql->fetchAll(PDO::FETCH_OBJ);
				$verifica_position3 = count( $res );
				foreach($res as $ln) { 
					$position3 = $ln->ID_POSICAO;  
				}
				if ($verifica_position3 <= 0) {
					// busca posicao do patrocinador 4 
					$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador3'");
					$sql_verifc->execute();
					$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
					foreach($res_verifc as $ln_verifc) { 
						$id_patrocinador4 = $ln_verifc->ID_INDICACAO; 
					}	
					// busca posicao do patrocinador 4
					$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_patrocinador4' ORDER BY ID_POSICAO ASC LIMIT 1 ");
					$sql->execute();
					$res = $sql->fetchAll(PDO::FETCH_OBJ);
					$verifica_position4 = count( $res );
					foreach($res as $ln) { 
						$position4 = $ln->ID_POSICAO;  
					}
					if ($verifica_position4 <= 0) {
						// busca posicao do patrocinador 5
						$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador4'");
						$sql_verifc->execute();
						$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
						foreach($res_verifc as $ln_verifc) { 
							$id_patrocinador5 = $ln_verifc->ID_INDICACAO; 
						}	
						// busca posicao do patrocinador 5
						$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_CLIENTE = '$id_patrocinador5' ORDER BY ID_POSICAO ASC LIMIT 1 ");
						$sql->execute();
						$res = $sql->fetchAll(PDO::FETCH_OBJ);
						$verifica_position5 = count( $res );
						foreach($res as $ln) { 
							$position5 = $ln->ID_POSICAO;  
						}
						if ($verifica_position5 <= 0) {
							// busca posicao 1
							$posicao = "1";  
						} else {
						 // patrocinador5 tem a posicao
						 $posicao = $position5; 
						}
						
						
					} else {
					 // patrocinador4 tem a posicao
					 $posicao = $position4; 
					}
					
					
				} else {
				 // patrocinador3 tem a posicao
				 $posicao = $position3; 
				}
			} else {
			 // patrocinador2 tem a posicao
			 $posicao = $position2; 
			}
			
			
		} else {
		 // patrocinador1 tem a posicao
		 $posicao = $position1; 
		}
		
	} else {
	 // cliente tem a posicao
	 $posicao = $position;  
		echo("<script type='text/javascript'> location.href='rede_talk.php?posicao=$posicao';</script>");
		exit; 
	}
}


/*
 
	$posicao = $_GET['posicao'];
 
	if (!isset($posicao)) {
		$posicao = 1;
	} 
 */
 
$sql = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = $posicao");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$posicao_verifica = count( $res );

// se posicao nao existe
if ($posicao_verifica <= 0) {
	echo("<script type='text/javascript'> alert('Essa Posi\u00e7\u00e3o Ainda N\u00e3o Esta Registrada no Sistema !!!'); location.href='rede_talk.php';</script>");
	exit;
}
// busca status da posicao
foreach($res as $ln) { 
	$status_da_posicao = $ln->STATUS;  
} 
if ($status_da_posicao == "DESATIVADO" || $status_da_posicao == "PENDENTE") {
	$posicao = floor($posicao/2);  
	echo("<script type='text/javascript'> alert('Pesquisando sua Posi\u00e7\u00e3o ou a Posi\u00e7\u00e3o de seus patrocinadores, iremos redireciona-lo para a Posi\u00e7\u00e3o acima mais pr\u00f3xima !!!'); location.href='rede_talk.php?posicao=$posicao';</script>");
	exit;
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
                        <li class="active">REDE TALK FUSION</li>
                    </ol>
                </section> 
                <!-- Main content -->
                <section class="content">
<Script type = "text/javascript">
function verifica() { 
	if (form.pesquisa.value == "") { 
		alert("\xE9 obrigat\xF3rio Digitar um n\u00famero de uma posi\u00e7\u00e3o"); 
		return false;   
    }
}

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
</script>
<form id="form" name="form" method="post" action="pesquisando_posicao.php" style="float:left;" >				
	<label for="exampleInputEmail1">Ir at&eacute; a posi&ccedil&atilde;o*: </label> <i class="fa  fa-search"></i> <input type="text" name="pesquisa" onkeypress="return Numero(event);" class="ir_pocicao" id="exampleInputEmail1" placeholder="Digite o N&uacute;mero da posi&ccedil&atilde;o" /> 				
	<input type="submit" class="btn btn-primary" Onclick="return verifica()" value="PESQUISAR POSI&Ccedil;&Atilde;O" /> 
</form>
<?php 
// 0 nivel
$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = $posicao");
$sql_1->execute();
$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ);
foreach($res_1 as $ln_1) {
	$posicao1 = $ln_1->ID_POSICAO;
	$nivel1 = $ln_1->NIVEL;
	}

	
$sql_total1 = $con->prepare("SELECT * FROM $tabela7 WHERE NIVEL = '$nivel1' AND STATUS = 'ATIVO'");
$sql_total1->execute();
$res_total1 = $sql_total1->fetchAll(PDO::FETCH_OBJ);
$total1 = count( $res_total1 );

// verifica a qts de pacotes em cada nivel
if ($nivel1 == "0")	{ $total_niveis = 1; }
else if ($nivel1 == "1")	{ $total_niveis = 2; }
else if ($nivel1 == "2")	{ $total_niveis = 4; }
else if ($nivel1 == "3")	{ $total_niveis = 8; }
else if ($nivel1 == "4")	{ $total_niveis = 16; }
else if ($nivel1 == "5")	{ $total_niveis = 32; }
else if ($nivel1 == "6")	{ $total_niveis = 64; }
else if ($nivel1 == "7")	{ $total_niveis = 128; }
else if ($nivel1 == "8")	{ $total_niveis = 256; }
else if ($nivel1 == "9")	{ $total_niveis = 512; }
else if ($nivel1 == "10")	{ $total_niveis = 1024; }
else if ($nivel1 == "11")	{ $total_niveis = 2048; }
else if ($nivel1 == "12")	{ $total_niveis = 4096; }
else if ($nivel1 == "13")	{ $total_niveis = 8192; }
else if ($nivel1 == "14")	{ $total_niveis = 16384;}
else if ($nivel1 == "15")	{ $total_niveis = 32768; }	
else if ($nivel1 == "16")	{ $total_niveis = 65536; }
else if ($nivel1 == "17")	{ $total_niveis = 131072; }
else if ($nivel1 == "18")	{ $total_niveis = 262144; }
else if ($nivel1 == "19")	{ $total_niveis = 524288; }
else if ($nivel1 == "20")	{ $total_niveis = 1048576; }

$rentam = $total_niveis-$total1;

// retorna para posicao acima ou topo
$retornar = floor($posicao1/2);  
 
if ($posicao1 > 1) { ?>

<div style="float:right;">	
	<a href="rede_talk.php?posicao=<?php echo $retornar; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-lg"> <i class="fa fa-arrow-circle-up"></i> Retorne Para Poci&ccedil;&atilde;o <?php echo $retornar; ?></button></a>
	<a href="rede_talk.php?posicao=1" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-lg"> <i class="fa fa-level-up"></i> Retorne Para o TOPO da REDE</button></a>
	<hr>
</div>
<?php
}
 
?>

<table id="tabela_rede" >
	<tr <?php if ($total1 >= $total_niveis) { ?> class="alert alert-success alert-dismissable" <?php } else { ?> class="callout callout-info" <?php } ?>>
		<td class="borda">
		
		 
		<?php 
			if ($nivel1 == "0") {
				echo "<b class='fonte_nivel'>In&iacute;cio</b> <BR>";
			} else {
				echo "<b class='fonte_nivel'>N&iacute;vel ".$nivel1."</b><BR>"; 
			} 
		?>
		
		<?php if ($total1 >= $total_niveis) { ?> <br> <b class="fa fa-check">COMPLETO</b> <?php } else { ?>  Ainda Restam <br><?php echo "<b class='color:red;'>".$rentam."</b>"; ?> <br> Pacotes <?php }    ?>
		
		
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		 
		 
		 
		<td id="posicao1">
		<?php 
		
		// posicao 1
		
		$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao1'");
		$sql_1->execute();
		$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_1 as $ln_1) {
			$pacote_cliente1 = $ln_1->ID_CLIENTE;
			$pacote_status1 = $ln_1->STATUS;
			}
			
		$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente1'");
		$sql_2->execute();
		$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_2 as $ln_2) {
			$pacote_cliente_id = $ln_2->ID;
			$pacote_cliente_nome = $ln_2->NOME;
			$pacote_cliente_foto = $ln_2->FOTO_PERFIL;
			}
			 
		if ($pacote_status1 == "ATIVO") { ?>
			<div id="position_left">
				<?php
				if ($pacote_cliente_foto == "") { ?>
					<a href="completo.php?perfil=<?php echo $pacote_cliente_id; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $pacote_cliente_id; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php }  ?>
			</div>
			<div id="position_right">
				<?php echo "<b>".$posicao1."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
				<a href="rede_talk.php?posicao=<?php echo $posicao1; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
				<a href="posicao.php?info=<?php echo $posicao1; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
			</div>
		<?php
		} else if ($pacote_status1 == "PENDENTE") { ?>
			<div id="position_left">
				<?php
				if ($pacote_cliente_foto == "") { ?>
					<a href="completo.php?perfil=<?php echo $pacote_cliente_id; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $pacote_cliente_id; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php }  ?>
			</div>
			<div id="position_right">
				<?php echo "<b>".$posicao1."&deg; Posi&ccedil;&atilde;o</b> <br>"; 
				 
				if ($pacote_cliente_id == "$id_cliente") { 
					 
					?>
						<form id="form_info_1" name="form_info_1" method="post" action="posicao.php?info=<?php echo $posicao1; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $retornar; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_1" name="form_cancela_1" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao1; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
			</div>
		<?php
		} else if ($pacote_status1 == "DESATIVADO") { ?>
				<?php echo "<b>".$posicao1."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
				<form id="form1" name="form1" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao1; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
				</form>
			 
		<?php 
		} 
		?></td>
		 
		 
		 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>   
	</tr> 
</table>	
	<?php 
	// 1 nivel
	$posicao2 = $posicao1*2;
	$sql_2 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao2'");
	$sql_2->execute();
	$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ);
	foreach($res_2 as $ln_2) {
		$posicao2 = $ln_2->ID_POSICAO; 
		$nivel1 = $ln_2->NIVEL;
	}


	$sql_total1 = $con->prepare("SELECT * FROM $tabela7 WHERE NIVEL = '$nivel1' AND STATUS = 'ATIVO'");
	$sql_total1->execute();
	$res_total1 = $sql_total1->fetchAll(PDO::FETCH_OBJ);
	$total1 = count( $res_total1 );

	// verifica a qts de pacotes em cada nivel
	if ($nivel1 == "0")	{ $total_niveis = 1; }
	else if ($nivel1 == "1")	{ $total_niveis = 2; }
	else if ($nivel1 == "2")	{ $total_niveis = 4; }
	else if ($nivel1 == "3")	{ $total_niveis = 8; }
	else if ($nivel1 == "4")	{ $total_niveis = 16; }
	else if ($nivel1 == "5")	{ $total_niveis = 32; }
	else if ($nivel1 == "6")	{ $total_niveis = 64; }
	else if ($nivel1 == "7")	{ $total_niveis = 128; }
	else if ($nivel1 == "8")	{ $total_niveis = 256; }
	else if ($nivel1 == "9")	{ $total_niveis = 512; }
	else if ($nivel1 == "10")	{ $total_niveis = 1024; }
	else if ($nivel1 == "11")	{ $total_niveis = 2048; }
	else if ($nivel1 == "12")	{ $total_niveis = 4096; }
	else if ($nivel1 == "13")	{ $total_niveis = 8192; }
	else if ($nivel1 == "14")	{ $total_niveis = 16384;}
	else if ($nivel1 == "15")	{ $total_niveis = 32768; }	
	else if ($nivel1 == "16")	{ $total_niveis = 65536; }
	else if ($nivel1 == "17")	{ $total_niveis = 131072; }
	else if ($nivel1 == "18")	{ $total_niveis = 262144; }
	else if ($nivel1 == "19")	{ $total_niveis = 524288; }
	else if ($nivel1 == "20")	{ $total_niveis = 1048576; }

	$rentam = $total_niveis-$total1;

	
	$posicao3 = $posicao2+1;
	$sql_3 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao3'");
	$sql_3->execute();
	$res_3 = $sql_3->fetchAll(PDO::FETCH_OBJ);
	foreach($res_3 as $ln_3) {
		$posicao3 = $ln_3->ID_POSICAO; 
	}
	?> 
<table id="tabela_rede" >
	<tr <?php if ($total1 >= $total_niveis) { ?> class="alert alert-success alert-dismissable" <?php } else { ?> class="callout callout-info" <?php } ?>>
		<td  class="borda">
		<?php  echo "<b class='fonte_nivel'>N&iacute;vel ".$nivel1."</b> <br>"; 
		
		if ($total1 >= $total_niveis) { ?> <br> <i class="fa fa-check">COMPLETO</i> <?php } else { ?> Ainda Restam <br><?php echo "<b class='color:red;'>".$rentam."</b>"; ?> <br> Pacotes <?php }   
		?>
		</td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao1">
		<?php 
			
			// posicao 2
			
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao2'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente2 = $ln_1->ID_CLIENTE;
				$pacote_status2 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente2'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id2 = $ln_2->ID;
				$pacote_cliente_nome2 = $ln_2->NOME;
				$pacote_cliente_foto2 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status1 == "PENDENTE" || $pacote_status1 == "DESATIVADO") {
			echo "<b>".$posicao2."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger btn-lg">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status2 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto2 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id2; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome2; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id2; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome2; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto2; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao2."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao2; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao2; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status2 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto2 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id2; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome2; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id2; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome2; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto2; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao2."&deg; Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id2 == "$id_cliente") { 
					 
					?>
						<form id="form_info_2" name="form_info_2" method="post" action="posicao.php?info=<?php echo $posicao2; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao1; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_2" name="form_cancela_2" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao2; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status2 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao2."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form2" name="form2" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao2; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		
		
		
		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
		<td></td>
		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td id="posicao1">
		<?php  
		
			// posicao 3
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao3'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente3 = $ln_1->ID_CLIENTE;
				$pacote_status3 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente3'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id3 = $ln_2->ID;
				$pacote_cliente_nome3 = $ln_2->NOME;
				$pacote_cliente_foto3 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status1 == "PENDENTE" || $pacote_status1 == "DESATIVADO") {
			echo "<b>".$posicao3."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger btn-lg">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status3 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto3 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id3; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome3; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id3; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome3; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto3; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao3."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao3; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao3; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status3 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto3 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id3; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome3; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id3; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome3; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto3; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao3."&deg; Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id3 == "$id_cliente") { 
					 
					?>
						<form id="form_info_3" name="form_info_3" method="post" action="posicao.php?info=<?php echo $posicao3; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao1; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_3" name="form_cancela_3" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao3; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status3 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao3."&deg; Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form3" name="form3" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao3; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>   
	</tr> 
</table>	
	<?php 
	// 2 nivel
	$posicao4 = $posicao2*2;
	$sql_4 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao4'");
	$sql_4->execute();
	$res_4 = $sql_4->fetchAll(PDO::FETCH_OBJ);
	foreach($res_4 as $ln_4) {
		$posicao4 = $ln_4->ID_POSICAO; 
		$nivel2 = $ln_4->NIVEL;
	}
	
	$posicao5 = $posicao4+1;
	$sql_5 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao5'");
	$sql_5->execute();
	$res_5 = $sql_5->fetchAll(PDO::FETCH_OBJ);
	foreach($res_5 as $ln_5) {
		$posicao5 = $ln_5->ID_POSICAO; 
	}
	
	$posicao6 = $posicao5+1;
	$sql_6 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao6'");
	$sql_6->execute();
	$res_6 = $sql_6->fetchAll(PDO::FETCH_OBJ);
	foreach($res_6 as $ln_6) {
		$posicao6 = $ln_6->ID_POSICAO; 
	}
	
	$posicao7 = $posicao6+1;
	$sql_7 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao7'");
	$sql_7->execute();
	$res_7 = $sql_7->fetchAll(PDO::FETCH_OBJ);
	foreach($res_7 as $ln_7) {
		$posicao7 = $ln_7->ID_POSICAO; 
	}
	
	
	$sql_total2 = $con->prepare("SELECT * FROM $tabela7 WHERE NIVEL = '$nivel2' AND STATUS = 'ATIVO'");
	$sql_total2->execute();
	$res_total2 = $sql_total2->fetchAll(PDO::FETCH_OBJ);
	$total2 = count( $res_total2 );

	// verifica a qts de pacotes em cada nivel
	if ($nivel2 == "0")	{ $total_niveis2 = 1; }
	else if ($nivel2 == "1")	{ $total_niveis2 = 2; }
	else if ($nivel2 == "2")	{ $total_niveis2 = 4; }
	else if ($nivel2 == "3")	{ $total_niveis2 = 8; }
	else if ($nivel2 == "4")	{ $total_niveis2 = 16; }
	else if ($nivel2 == "5")	{ $total_niveis2 = 32; }
	else if ($nivel2 == "6")	{ $total_niveis2 = 64; }
	else if ($nivel2 == "7")	{ $total_niveis2 = 128; }
	else if ($nivel2 == "8")	{ $total_niveis2 = 256; }
	else if ($nivel2 == "9")	{ $total_niveis2 = 512; }
	else if ($nivel2 == "10")	{ $total_niveis2 = 1024; }
	else if ($nivel2 == "11")	{ $total_niveis2 = 2048; }
	else if ($nivel2 == "12")	{ $total_niveis2 = 4096; }
	else if ($nivel2 == "13")	{ $total_niveis2 = 8192; }
	else if ($nivel2 == "14")	{ $total_niveis2 = 16384;}
	else if ($nivel2 == "15")	{ $total_niveis2 = 32768; }	
	else if ($nivel2 == "16")	{ $total_niveis2 = 65536; }
	else if ($nivel2 == "17")	{ $total_niveis2 = 131072; }
	else if ($nivel2 == "18")	{ $total_niveis2 = 262144; }
	else if ($nivel2 == "19")	{ $total_niveis2 = 524288; }
	else if ($nivel2 == "20")	{ $total_niveis2 = 1048576; }

	$rentam2 = $total_niveis2-$total2;
	?>
<table id="tabela_rede" >	
	<tr <?php if ($total2 >= $total_niveis2) { ?> class="alert alert-success alert-dismissable" <?php } else { ?> class="callout callout-info" <?php } ?>>
		<td  class="borda">
		<?php  echo "<b class='fonte_nivel'>N&iacute;vel ".$nivel2."</b> <br>"; 
		
		if ($total2 >= $total_niveis2) { ?> <br> <i class="fa fa-check">COMPLETO</i> <?php } else { ?> Ainda Restam <br><?php echo "<b class='color:red;'>".$rentam2."</b>"; ?> <br> Pacotes <?php }   
		?>
		</td>
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao2">
		<?php  
		
			// posicao 4
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao4'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente4 = $ln_1->ID_CLIENTE;
				$pacote_status4 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente4'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id4 = $ln_2->ID;
				$pacote_cliente_nome4 = $ln_2->NOME;
				$pacote_cliente_foto4 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status2 == "PENDENTE" || $pacote_status2 == "DESATIVADO") {
			echo "<b>".$posicao4."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status4 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto4 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id4; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome4; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id4; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome4; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto4; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao4."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao4; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao4; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status4 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto4 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id4; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome4; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id4; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome4; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto4; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao4."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 
					 
					if ($pacote_cliente_id4 == "$id_cliente") { 
					 
					?>
						<form id="form_info_4" name="form_info_4" method="post" action="posicao.php?info=<?php echo $posicao4; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao2; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_4" name="form_cancela_4" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao4; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status4 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao4."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form4" name="form4" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao4; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		<td></td> 
		<td></td>
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao2">
		<?php  
		
			// posicao 5
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao5'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente5 = $ln_1->ID_CLIENTE;
				$pacote_status5 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente5'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id5 = $ln_2->ID;
				$pacote_cliente_nome5 = $ln_2->NOME;
				$pacote_cliente_foto5 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status2 == "PENDENTE" || $pacote_status2 == "DESATIVADO") {
			echo "<b>".$posicao5."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status5 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto5 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id5; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome5; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id5; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome5; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto5; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao5."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao5; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao5; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status5 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto5 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id5; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome5; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id5; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome5; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto5; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao5."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id5 == "$id_cliente") { 
					 
					?>
						<form id="form_info_5" name="form_info_5" method="post" action="posicao.php?info=<?php echo $posicao5; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao2; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_5" name="form_cancela_5" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao5; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status5 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao5."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form5" name="form5" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao5; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		<td></td> 
		<td></td>
		<td></td>
		
		<td></td>
		
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao2">
		<?php  
		
			// posicao 6
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao6'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente6 = $ln_1->ID_CLIENTE;
				$pacote_status6 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente6'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id6 = $ln_2->ID;
				$pacote_cliente_nome6 = $ln_2->NOME;
				$pacote_cliente_foto6 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status3 == "PENDENTE" || $pacote_status3 == "DESATIVADO") {
			echo "<b>".$posicao6."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status6 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto6 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id6; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome6; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id6; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome6; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto6; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao6."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao6; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao6; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status6 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto6 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id6; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome6; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id6; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome6; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto6; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao6."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id6 == "$id_cliente") { 
					 
					?>
						<form id="form_info_6" name="form_info_6" method="post" action="posicao.php?info=<?php echo $posicao6; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao3; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_6" name="form_cancela_6" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao6; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status6 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao6."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form6" name="form6" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao6; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td> 
		<td></td>
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao2">
		<?php  
		
			// posicao 7
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao7'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente7 = $ln_1->ID_CLIENTE;
				$pacote_status7 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente7'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id7 = $ln_2->ID;
				$pacote_cliente_nome7 = $ln_2->NOME;
				$pacote_cliente_foto7 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status3 == "PENDENTE" || $pacote_status3 == "DESATIVADO") {
			echo "<b>".$posicao7."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status7 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto7 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id7; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome7; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id7; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome7; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto7; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao7."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao7; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao7; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status7 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto7 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id7; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome7; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id7; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome7; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto7; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao7."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>";  

					if ($pacote_cliente_id7 == "$id_cliente") { 
					 
					?>
						<form id="form_info_7" name="form_info_7" method="post" action="posicao.php?info=<?php echo $posicao7; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao3; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_7" name="form_cancela_7" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao7; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status7 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao7."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form7" name="form7" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao7; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
			<?php 
			}
		}
		?></td> 
		<td></td> 
		<td></td>
		<td></td>   
	</tr> 
</table>	
	<?php 
	// 3 nivel
	$posicao8 = $posicao4*2;
	$sql_8 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao8'");
	$sql_8->execute();
	$res_8 = $sql_8->fetchAll(PDO::FETCH_OBJ);
	foreach($res_8 as $ln_8) {
		$posicao8 = $ln_8->ID_POSICAO; 
		$nivel3 = $ln_8->NIVEL;
	}
	
	$posicao9 = $posicao8+1;
	$sql_9 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao9'");
	$sql_9->execute();
	$res_9 = $sql_9->fetchAll(PDO::FETCH_OBJ);
	foreach($res_9 as $ln_9) {
		$posicao9 = $ln_9->ID_POSICAO; 
	}
	
	$posicao10 = $posicao9+1;
	$sql_10 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao10'");
	$sql_10->execute();
	$res_10 = $sql_10->fetchAll(PDO::FETCH_OBJ);
	foreach($res_10 as $ln_10) {
		$posicao10 = $ln_10->ID_POSICAO; 
	}
	
	$posicao11 = $posicao10+1;
	$sql_11 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao11'");
	$sql_11->execute();
	$res_11 = $sql_11->fetchAll(PDO::FETCH_OBJ);
	foreach($res_11 as $ln_11) {
		$posicao11 = $ln_11->ID_POSICAO; 
	}
	
	$posicao12 = $posicao11+1;
	$sql_12 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao12'");
	$sql_12->execute();
	$res_12 = $sql_12->fetchAll(PDO::FETCH_OBJ);
	foreach($res_12 as $ln_12) {
		$posicao12 = $ln_12->ID_POSICAO; 
	}
	
	$posicao13 = $posicao12+1;
	$sql_13 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao13'");
	$sql_13->execute();
	$res_13 = $sql_13->fetchAll(PDO::FETCH_OBJ);
	foreach($res_13 as $ln_13) {
		$posicao13 = $ln_13->ID_POSICAO; 
	}
	
	$posicao14 = $posicao13+1;
	$sql_14 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao14'");
	$sql_14->execute();
	$res_14 = $sql_14->fetchAll(PDO::FETCH_OBJ);
	foreach($res_14 as $ln_14) {
		$posicao14 = $ln_14->ID_POSICAO; 
	}
	
	$posicao15 = $posicao14+1;
	$sql_15 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao15'");
	$sql_15->execute();
	$res_15 = $sql_15->fetchAll(PDO::FETCH_OBJ);
	foreach($res_15 as $ln_15) {
		$posicao15 = $ln_15->ID_POSICAO; 
	}
	
	$sql_total3 = $con->prepare("SELECT * FROM $tabela7 WHERE NIVEL = '$nivel3' AND STATUS = 'ATIVO'");
	$sql_total3->execute();
	$res_total3 = $sql_total3->fetchAll(PDO::FETCH_OBJ);
	$total3 = count( $res_total3 );

	// verifica a qts de pacotes em cada nivel
	if ($nivel3 == "0")	{ $total_niveis3 = 1; }
	else if ($nivel3 == "1")	{ $total_niveis3 = 2; }
	else if ($nivel3 == "2")	{ $total_niveis3 = 4; }
	else if ($nivel3 == "3")	{ $total_niveis3 = 8; }
	else if ($nivel3 == "4")	{ $total_niveis3 = 16; }
	else if ($nivel3 == "5")	{ $total_niveis3 = 32; }
	else if ($nivel3 == "6")	{ $total_niveis3 = 64; }
	else if ($nivel3 == "7")	{ $total_niveis3 = 128; }
	else if ($nivel3 == "8")	{ $total_niveis3 = 256; }
	else if ($nivel3 == "9")	{ $total_niveis3 = 512; }
	else if ($nivel3 == "10")	{ $total_niveis3 = 1024; }
	else if ($nivel3 == "11")	{ $total_niveis3 = 2048; }
	else if ($nivel3 == "12")	{ $total_niveis3 = 4096; }
	else if ($nivel3 == "13")	{ $total_niveis3 = 8192; }
	else if ($nivel3 == "14")	{ $total_niveis3 = 16384;}
	else if ($nivel3 == "15")	{ $total_niveis3 = 32768; }	
	else if ($nivel3 == "16")	{ $total_niveis3 = 65536; }
	else if ($nivel3 == "17")	{ $total_niveis3 = 131072; }
	else if ($nivel3 == "18")	{ $total_niveis3 = 262144; }
	else if ($nivel3 == "19")	{ $total_niveis3 = 524288; }
	else if ($nivel3 == "20")	{ $total_niveis3 = 1048576; }

	$rentam3 = $total_niveis3-$total3;
	
	?>
<table id="tabela_rede" >		
	<tr <?php if ($total3 >= $total_niveis3) { ?> class="alert alert-success alert-dismissable" <?php } else { ?> class="callout callout-info" <?php } ?>>
		<td  class="borda">
		<?php  echo "<b class='fonte_nivel'>N&iacute;vel ".$nivel3."</b> <br>"; 
		
		if ($total3 >= $total_niveis3) { ?> <br> <i class="fa fa-check">COMPLETO</i> <?php } else { ?> Ainda Restam <br><?php echo "<b class='color:red;'>".$rentam3."</b>"; ?> <br> Pacotes <?php }   
		?>
		</td> 
		<td id="posicao2">
		<?php  
		
			// posicao 8
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao8'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente8 = $ln_1->ID_CLIENTE;
				$pacote_status8 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente8'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id8 = $ln_2->ID;
				$pacote_cliente_nome8 = $ln_2->NOME;
				$pacote_cliente_foto8 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status4 == "PENDENTE" || $pacote_status4 == "DESATIVADO") {
			echo "<b>".$posicao8."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status8 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto8 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id8; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome8; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id8; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome8; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto8; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao8."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao8; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao8; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status8 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto8 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id8; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome8; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id8; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome8; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto8; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao8."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>";

					if ($pacote_cliente_id8 == "$id_cliente") { 
					 
					?>	  
						<form id="form_info_8" name="form_info_8" method="post" action="posicao.php?info=<?php echo $posicao8; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao4; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_8" name="form_cancela_8" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao8; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
						
						  
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status8 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao8."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form8" name="form8" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao8; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 9
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao9'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente9 = $ln_1->ID_CLIENTE;
				$pacote_status9 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente9'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id9 = $ln_2->ID;
				$pacote_cliente_nome9 = $ln_2->NOME;
				$pacote_cliente_foto9 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status4 == "PENDENTE" || $pacote_status4 == "DESATIVADO") {
			echo "<b>".$posicao9."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status9 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto9 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id9; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome9; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id9; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome9; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto9; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao9."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao9; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao9; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status9 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto9 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id9; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome9; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id9; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome9; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto9; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao9."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 

					if ($pacote_cliente_id9 == "$id_cliente") { 
					 
					?>
						<form id="form_info_9" name="form_info_9" method="post" action="posicao.php?info=<?php echo $posicao9; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao4; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_9" name="form_cancela_9" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao9; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status9 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao9."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form9" name="form9" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao9; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td> 
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 10
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao10'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente10 = $ln_1->ID_CLIENTE;
				$pacote_status10 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente10'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id10 = $ln_2->ID;
				$pacote_cliente_nome10 = $ln_2->NOME;
				$pacote_cliente_foto10 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status5 == "PENDENTE" || $pacote_status5 == "DESATIVADO") {
			echo "<b>".$posicao10."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status10 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto10 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id10; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome10; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id10; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome10; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto10; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao10."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao10; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao10; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status10 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto10 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id10; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome10; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id10; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome10; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto10; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao10."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id10 == "$id_cliente") { 
					 
					?>
						<form id="form_info_10" name="form_info_10" method="post" action="posicao.php?info=<?php echo $posicao10; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao5; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_10" name="form_cancela_10" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao10; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status10 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao10."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form10" name="form10" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao10; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td>
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 11
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao11'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente11 = $ln_1->ID_CLIENTE;
				$pacote_status11 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente11'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id11 = $ln_2->ID;
				$pacote_cliente_nome11 = $ln_2->NOME;
				$pacote_cliente_foto11 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status5 == "PENDENTE" || $pacote_status5 == "DESATIVADO") {
			echo "<b>".$posicao11."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status11 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto11 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id11; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome11; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id11; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome11; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto11; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao11."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao11; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao11; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status11 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto11 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id11; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome11; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id11; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome11; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto11; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao11."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 

					if ($pacote_cliente_id11 == "$id_cliente") { 
					 
					?>
						<form id="form_info_11" name="form_info_11" method="post" action="posicao.php?info=<?php echo $posicao11; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao5; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_11" name="form_cancela_11" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao11; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status11 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao11."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form11" name="form11" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao11; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		
		<td></td>
		
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 12
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao12'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente12 = $ln_1->ID_CLIENTE;
				$pacote_status12 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente12'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id12 = $ln_2->ID;
				$pacote_cliente_nome12 = $ln_2->NOME;
				$pacote_cliente_foto12 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status6 == "PENDENTE" || $pacote_status6 == "DESATIVADO") {
			echo "<b>".$posicao12."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status12 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto12 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id12; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome12; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id12; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome12; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto12; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao12."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao12; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao12; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status12 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto12 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id12; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome12; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id12; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome12; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto12; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao12."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 

					if ($pacote_cliente_id12 == "$id_cliente") { 
					 
					?>
						<form id="form_info_12" name="form_info_12" method="post" action="posicao.php?info=<?php echo $posicao12; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao6; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_12" name="form_cancela_12" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao12; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status12 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao12."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form12" name="form12" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao12; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td>
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 13
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao13'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente13 = $ln_1->ID_CLIENTE;
				$pacote_status13 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente13'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id13 = $ln_2->ID;
				$pacote_cliente_nome13 = $ln_2->NOME;
				$pacote_cliente_foto13 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status6 == "PENDENTE" || $pacote_status6 == "DESATIVADO") {
			echo "<b>".$posicao13."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status13 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto13 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id13; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome13; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id13; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome13; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto13; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao13."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao13; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao13; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status13 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto13 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id13; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome13; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id13; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome13; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto13; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao13."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 

					if ($pacote_cliente_id13 == "$id_cliente") { 
					 
					?>
						<form id="form_info_13" name="form_info_13" method="post" action="posicao.php?info=<?php echo $posicao13; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao6; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_13" name="form_cancela_13" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao13; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status13 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao13."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form13" name="form13" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao13; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form>
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td> 
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 14
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao14'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente14 = $ln_1->ID_CLIENTE;
				$pacote_status14 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente14'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id14 = $ln_2->ID;
				$pacote_cliente_nome14 = $ln_2->NOME;
				$pacote_cliente_foto14 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status7 == "PENDENTE" || $pacote_status7 == "DESATIVADO") {
			echo "<b>".$posicao14."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status14 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto14 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id14; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome14; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id14; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome14; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto14; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao14."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao14; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao14; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status14 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto14 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id14; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome14; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id14; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome14; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto14; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao14."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 

					if ($pacote_cliente_id14 == "$id_cliente") { 
					 
					?>
						<form id="form_info_14" name="form_info_14" method="post" action="posicao.php?info=<?php echo $posicao14; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao7; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_14" name="form_cancela_14" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao14; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status14 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao14."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form14" name="form14" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao14; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td>
		<td></td>
		<td></td>
		<td id="posicao2">
		<?php  
		
			// posicao 15
		
			$sql_1 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$posicao15'");
			$sql_1->execute();
			$res_1 = $sql_1->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_1 as $ln_1) {
				$pacote_cliente15 = $ln_1->ID_CLIENTE;
				$pacote_status15 = $ln_1->STATUS;
				}
				
			$sql_2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pacote_cliente15'");
			$sql_2->execute();
			$res_2 = $sql_2->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_2 as $ln_2) {
				$pacote_cliente_id15 = $ln_2->ID;
				$pacote_cliente_nome15 = $ln_2->NOME;
				$pacote_cliente_foto15 = $ln_2->FOTO_PERFIL;
				}
		if ($pacote_status7 == "PENDENTE" || $pacote_status7 == "DESATIVADO") {
			echo "<b>".$posicao15."&deg;</b> <br>";  
			echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
			<button class="btn btn-danger  btn-sm">DESATIVADO</button>
		<?php	
		} else { 	 
			if ($pacote_status15 == "ATIVO") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto15 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id15; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome15; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id15; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome15; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto15; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao15."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br><br>"; ?>
					<a href="rede_talk.php?posicao=<?php echo $posicao15; ?>" title="Veja a Rede desse Pacote"><button class="btn btn-primary btn-sm">TOPO</button></a>
					<a href="posicao.php?info=<?php echo $posicao15; ?>" title="Veja informa&ccedil;&otilde;es Desse Pacote"><button class="btn btn-info btn-sm">Info</button> </a>
				</div>
			<?php
			} else if ($pacote_status15 == "PENDENTE") { ?>
				<div id="position_left">
					<?php
					if ($pacote_cliente_foto15 == "") { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id15; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome15; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="30" /> </a>
					<?php } else { ?>
						<a href="completo.php?perfil=<?php echo $pacote_cliente_id15; ?>" title="Perfil do(a) <?php echo  $pacote_cliente_nome15; ?>"><img src="img_perfil/<?php echo $pacote_cliente_foto15; ?>"  class="img-circle" width="30" alt="Sua Imagem" /></a>
					<?php }  ?>
				</div>
				<div id="position_right">
					<?php echo "<b>".$posicao15."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; 
					
					if ($pacote_cliente_id15 == "$id_cliente") { 
					 
					?>
						<form id="form_info_15" name="form_info_15" method="post" action="posicao.php?info=<?php echo $posicao15; ?>">
							<INPUT TYPE="hidden" NAME="indicado_por" VALUE="<?php echo $posicao7; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-warning btn-sm" title="Clique aqui para ver informa&ccedil;&otilde;es da sua posi&ccedil;&otilde;es">Pendente (INFO)</button> 
						</form>
						<form id="form_cancela_15" name="form_cancela_15" method="post" action="cancelando_pacotes.php">
							<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao15; ?>">
							<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
							<button type="submit"  class="btn btn-danger btn-sm" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">Cancelar Compra</button> 
						</form>
					<?php } else { ?>
						<button class="btn btn-warning">PENDENTE</button>
					<?php } ?>
				</div>
			<?php
			} else if ($pacote_status15 == "DESATIVADO") { ?>
					<?php echo "<b>".$posicao15."&deg;</b> <br>"; ?>
					<?php echo "<b> Posi&ccedil;&atilde;o</b> <br>"; ?>
					<form id="form15" name="form15" method="post" action="comprando_pacotes.php">
						<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $posicao15; ?>">
						<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $id_cliente; ?>">
						<button type="submit" class="btn btn-success btn-sm" title="SOLICITAR A COMPRA DESSE PACOTE AGORA">COMPRAR</button> 
					</form> 
				 
			<?php 
			}
		}
		?></td> 
		<td></td>   
	</tr>
</table>	     
<!-- FIM centro -->	
<br><br>
 <div style="text-align:center;width:100%;">				
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pagina-centro-clientes -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="3776313246"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> 					
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
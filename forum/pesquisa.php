<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
		$talk_simulador = $ln_verifc->TALK_SIMULADOR; 
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

	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
	} 
	
$palavra = $_POST["palavra"];

if ($palavra == "") {
	echo("<script type='text/javascript'> alert('ERRO: para pesquisar, digite ao menos uma palavra chave'); location.href='index.php';</script>");
	exit;
}  
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | F&OacuteRUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, tutoriais, como funciona, ganhar dinheiro na internet, MMN"/>
		<meta name="robots" content="all">
		<Meta Name="Description" Content="ComunidadeMultiN&iacute;vel, a melhores estrat&eacute;gias de trabalho inteligentemente elaboradas para o alavancamento e crescimento do rendimento de toda nossa equipe. SEU SUCESSO EST&Aacute: EM NOSSA UNI&Atilde;O !!!">
		<meta property='og:image' content='http://www.comunidademultinivel.com.br/adm_clientes/img/talkfusion-indenesia-3.jpg'/>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
        <link href="../adm_clientes/css/estilo.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../adm_clientes/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../adm_clientes/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../adm_clientes/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../adm_clientes/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../adm_clientes/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../adm_clientes/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../adm_clientes/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../adm_clientes/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../adm_clientes/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
		

    </head>
    <body class="skin-blue">
        <?php  
		if ($id_cliente != "" || $id_cliente != 0) {
			include("topo_logado.php");
		} else {
			include("topo_normal.php");
		}
		  
		?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-question"></i> <a href="index.php" title="Retornar aos F&Oacute;RUNS">FORUM </a> </li>
                        <li class="active">Pesquisando / <?php echo $palavra; ?> </li>
                    </ol>
                </section>
 
            </aside><!-- /.right-side -->
	
		
		
		
<div style="float:left; width:25%; ;margin:5px 0px 0px 10px;">		
		<div class="col-md-14" >
			<div class="box box-solid bg-light-blue">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-folder-open"></i> T&Oacute;PICOS RECENTES</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
<?php
// ultima resposta 
$sql = $con->prepare("SELECT * FROM $tabela11 ORDER BY ID DESC LIMIT 5");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	
	$ultimo_post_id_cliente = $ln->ID_CLIENTE;
	$ultimo_post_id_topico = $ln->ID_TOPICO;
	$ultimo_post_categoria = $ln->CATEGORIA;
	$ultimo_post_subcategoria = $ln->SUB_CATEGORIA;	
	$ultimo_post_data = $ln->DATA_TOPICO;
	$ultimo_post_data = implode("/",array_reverse(explode("-",$ultimo_post_data)));	

	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_post_id_cliente'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ); 
	foreach($res as $ln) { 
		$ultimo_postnome_cliente = $ln->NOME;
		$ultimo_postfoto_cliente = $ln->FOTO_PERFIL; 
	}
	
	$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$ultimo_post_id_topico'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ); 
	foreach($res as $ln) { 
		$ultimo_posttitulo = $ln->TITULO_TOPICO;  
	}
	
?>		 
                <div class="box-body" style="width:100%; border:3px solid #ededed;background:#FFF;">
					<div style="float:left; width:20%;"> 
							<?php if ($ultimo_postfoto_cliente == "") { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_id_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } else { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_id_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultimo_postfoto_cliente; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } ?> 
					</div>
					<div style="float:right; width:80%; color:#000;"> <!-- ultima resposta --> 
							<?php  
							$str = $ultimo_posttitulo;
							include_once "funcao_url.php";
							?>
							<b style="color:#666;font-size:11px;"><a href="topico/<?php echo $ultimo_post_id_topico."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $ultimo_posttitulo; ?></a></b> <br>
							Respondido por <b><?php echo $ultimo_postnome_cliente; ?> </b> <br>
							<i style="color:#666;"><?php echo $ultimo_post_data; ?> </i><br>
						 
					</div>  
					<br style="clear:both;">
                </div><!-- /.box-body -->
<?php }	?>
				
				
            </div><!-- /.box -->
        </div><!-- /.col -->
	<hr style="clear:both;">		
<div class="col-md-14" >
			<div class="box box-solid bg-light-blue">
				<div class="box-header">
					<h3 class="box-title"><i class="fa  fa-trophy"></i> REPUTA&Ccedil;&Atilde;O dos afiliados</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
<?php  
 

$sql = $con->prepare("SELECT count(*) as total, ID_CLIENTE FROM $tabela11 GROUP BY ID_CLIENTE ORDER BY total DESC, ID_CLIENTE ASC LIMIT 5");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	 
	$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ln->ID_CLIENTE'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
	foreach($res2 as $ln2) {
		$reputacao_nome =  $ln2->NOME;
		$reputacao_data =  $ln2->DATA_CADASTRO;
		$reputacao_data = implode("/",array_reverse(explode("-",$reputacao_data)));
		$reputacao_foto =  $ln2->FOTO_PERFIL;
	}	
	// quantidades de respostas 
	$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$ln->ID_CLIENTE'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$total_res = count( $res );	

	// quantidades de topicos criados
	$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID_CLIENTE = '$ln->ID_CLIENTE'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$total_topic = count( $res );
	
?>		 
                <div class="box-body" style="width:100%; border:3px solid #ededed;background:#FFF;">
					<div style="float:left; width:20%;"> 
							<?php if ($reputacao_foto == "") { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ln->ID_CLIENTE; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } else { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ln->ID_CLIENTE; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $reputacao_foto; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } ?> 
					</div>
					<div style="float:right; width:80%; color:#000;"> <!-- ultima resposta --> 
							
							<b>Total de Respostas: </b> <button class="btn btn-warning disabled" data-widget="collapse"><?php echo $total_res; ?></button>  <br>
							<b>Total de T&oacute;picos: </b> <button class="btn btn-warning disabled" data-widget="collapse"><?php echo $total_topic; ?></button> <br>
							<i style="color:#666;">Data de registro <?php echo $reputacao_data; ?> </i><br>
						 
					</div>  
					<br style="clear:both;">
                </div><!-- /.box-body -->
<?php }	?>
				
				
            </div><!-- /.box -->
        </div><!-- /.col -->
	<hr style="clear:both;">



	
<div class="col-md-14" >
			<div class="box box-solid bg-light-blue">
				<div class="box-header">
					<h3 class="box-title"><i class="fa  fa-trophy"></i> ESTAT&Iacute;STICAS DO F&Oacute;RUM</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
<?php
 // quantidades de topicos criados
$sql = $con->prepare("SELECT * FROM $tabela10");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_topic = count( $res );

 // quantidades de repostas 
$sql = $con->prepare("SELECT * FROM $tabela11");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_res = count( $res );

 // quantidades de clientes 
$sql = $con->prepare("SELECT * FROM $tabela3");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_clientes = count( $res );

 // ultimo clientes 
$sql = $con->prepare("SELECT * FROM $tabela3 ORDER BY ID DESC LIMIT 1");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
		$ultimo_id_cliente = $ln->ID; 
		$ultimo_nome_cliente = $ln->NOME;  
	}
?>		 
                <div class="box-body" style="width:100%; border:3px solid #ededed;background:#FFF; color:#000; ">
					 <table style="text-align:right;">
						<tr>
							<td><button  class="btn btn-warning btn-flat" style="font:25px bold;"><?php echo $total_topic; ?> </button> </td>
							<td style="text-align:left;">T&Oacute;PICOS</td>
						</tr>
						<tr>
							<td><button  class="btn btn-warning btn-flat" style="font:25px bold;"><?php echo $total_res; ?> </button></td>
							<td style="text-align:left;">RESPOSTAS</td>
						</tr>
						<tr>
							<td><button  class="btn btn-warning btn-flat" style="font:25px bold;"><?php echo $total_clientes; ?> </button></td>
							<td style="text-align:left;">AFILIADOS</td>
						</tr>
						<tr>
							<td><a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_id_cliente; ?>" title="Ultimo Afiliado Registrado na ComunidadeMultiN&iacute;vel"><button  class="btn btn-warning btn-flat"><?php echo $ultimo_nome_cliente; ?> </button></a></td>
							<td style="text-align:left;">AFILIADOS mais novo</td>
						</tr>
					 </table>
					<br style="clear:both;">
                </div><!-- /.box-body --> 
            </div><!-- /.box -->
        </div><!-- /.col -->
		
	

<div class="col-md-14" >
			<div class="box box-solid bg-light-blue">
				<div class="box-header">
					<h3 class="box-title"><i class="fa  fa-hand-o-down"></i> Moderadores do FORUM</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
<?php  
 

$sql = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = 'SIM' ORDER BY ID ASC");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln2) { 
		$moderadores_nome =  $ln2->NOME;
		$moderadores_data =  $ln2->DATA_CADASTRO;
		$moderadores_data = implode("/",array_reverse(explode("-",$moderadores_data)));
		$moderadores_foto =  $ln2->FOTO_PERFIL;
	 	 
?>		 
                <div class="box-body" style="width:100%; border:3px solid #ededed;background:#FFF;">
					<div style="float:left; width:20%;"> 
							<?php if ($moderadores_foto == "") { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ln2->ID; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } else { ?>
								<a href="../adm_clientes/completo.php?perfil=<?php echo $ln2->ID; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $moderadores_foto; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
							<?php } ?> 
					</div>
					<div style="float:right; width:80%; color:#000;"> <!-- ultima resposta --> 
							
							<b><?php echo $moderadores_nome; ?> </b>  <br> 
							<i style="color:#666;">Data de registro <?php echo $moderadores_data; ?> </i><br>
						 
					</div>  
					<br style="clear:both;">
                </div><!-- /.box-body --> 
<?php } ?>			
				
            </div><!-- /.box -->
        </div><!-- /.col -->
	<hr style="clear:both;">	
		
		
	<div class="col-md-14" > 
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- KeyWord - Dicas Diárias -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:300px;height:250px"
			 data-ad-client="ca-pub-2025377467503276"
			 data-ad-slot="2803005246"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
	</div>		
</div>		
<div style="float:right; width:72%;  margin:5px 10px 0px 10px;  ">		
		<br>
		<div class="col-md-16">
		
		<div class="input-group input-group-sm" style="width:100%;">
			<form name="frmBusca" method="post" action="pesquisa.php" style="width:100%;">
			<ul style="width:100%;">
				<li style="display:inline;width:60%;"><input type="text" class="form-control" style="width:80%;" name="palavra" placeholder="O que voc&ecirc; est&aacute; procurando ? pesquise aqui" /> </li>
				<li style="display:inline;width:40%;"><input class="btn btn-info btn-flat" style="font-size:14px;" type="submit" value="Pesquisar Agora" />  </li>
			</ul>
			</form>
		</div><!-- /input-group -->
		<br>
			<div class="box box-solid bg-light-white">
				<div class="box-header">
					<i style="color:#000;font:10px;">Publicidade</i><br> 
                </div>
                <div class="box-body" style="text-align:center;">
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
		<!-- Go to www.addthis.com/dashboard to customize your tools -->
		 

<div class="col-md-16">
	<div class="box box-solid box-primary"> 			 
				<div class="box-header">
					<h1 class="box-title">Pesquisando / <?php echo $palavra; ?></h1>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
				<table>
			
<?php
######### INICIO Paginação
	$numreg = 100; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	$sql = $con->prepare("SELECT * FROM $tabela10 WHERE TITULO_TOPICO LIKE '%".$palavra."%' ORDER BY ID ASC LIMIT $inicial, $numreg");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ); 
	 
	$sql_topic = $con->prepare("SELECT * FROM $tabela10 WHERE TITULO_TOPICO LIKE '%".$palavra."%' ORDER BY ID ASC LIMIT $inicial, $numreg");
	$sql_topic->execute();
	$res_topic = $sql_topic->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela10 WHERE TITULO_TOPICO LIKE '%".$palavra."%'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	if ($quantreg <= 0) {
		echo "<b style='color:red;'>No momento N&atilde;o temos nenhum Resultado</b> <br>";
	}	
 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	foreach($res as $ln) {
		$id_topico = $ln->ID;
		$id_cliente_topico = $ln->ID_CLIENTE;
		$categoria_topico = $ln->CATEGORIA;
		$topic_dica = $ln->DICA;
		$titulo_topico = $ln->TITULO_TOPICO; 
		$texto_topico =    html_entity_decode((string)$ln->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
		$contador_topico = $ln->CONTADOR;
		$data_topico = $ln->DATA_TOPICO;
		$data_topico = implode("/",array_reverse(explode("-",$data_topico)));
		
		$str = $ln->TITULO_TOPICO;
		include_once "funcao_url.php";

		$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente_topico");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $ln) {
			$nome = $ln->NOME; 
			
		}
		
		$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_TOPICO = '$id_topico'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ); 
		$quants = count( $res );
		
		$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_TOPICO = '$id_topico' ORDER BY ID DESC LIMIT 1");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $ln) {
			$ultima_resposta_id_cliente = $ln->ID_CLIENTE; 
			$ultima_resposta_data = $ln->DATA_TOPICO; 
			$ultima_resposta_data = implode("/",array_reverse(explode("-",$ultima_resposta_data))); 
		}
		
		
		$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultima_resposta_id_cliente'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $ln) {
			$ultima_resposta_id = $ln->ID;
			$ultima_resposta_nome = $ln->NOME; 
			$ultima_resposta_foto = $ln->FOTO_PERFIL;
		}
?>					
 
						<tr>
							<td  style="width:70%;"><b style="color:#666;font-size:16px;"><a href="topico/<?php echo $id_topico."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $titulo_topico; ?></a></b><br>
							<i>Criado por <a href="../adm_clientes/completo.php?perfil=<?php echo $id_cliente_topico; ?>" title="Veja o Perfil"><?php echo $nome; ?></a>, <?php echo $data_topico; ?>. </i>
								<?php if ($topic_dica == "SIM") { ?>
									<b style="color:red;">> DICA <</b>
								<?php } ?> 
								<br><br>	
							</td>
							<td style="width:20%;">
							<b><?php echo $quants; ?> </b> Respostas <br>
							<b><?php echo $contador_topico; ?> </b> Visualiza&ccedil;&otilde;es
							</td>
							<td style="width:10%;"> 
							<div style="float:left; width:40%;">
								<?php  if ($quants == "" || $quants == 0) { ?>
									<i style="color:red;">aguardando</i>
								<?php  } else { ?>
									<?php if ($ultima_resposta_foto == "") { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultima_resposta_id; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } else { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultima_resposta_id; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultima_resposta_foto; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="float:right; width:60%; "> <!-- ultima resposta -->
								<?php  if ($quants == "" || $quants == 0) { ?>
								<?php  } else { ?>
										<b><?php echo $ultima_resposta_nome; ?> </b> <br>
										<i style="color:#666;"><?php echo $ultima_resposta_data; ?> </i><br>
									<?php } ?>  
							</div> 
							
							</td>  
						<tr>
<?php  
	}	
?>
					</table>
					
					 
                </div><!-- /.box-body -->		 
		 
		 
		 
		 
		 
		  


		<div class="col-md-16">
			<div class="box box-solid bg-light-white"> 
                <div class="box-body" style="text-align:center;">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->		
</div>						
		


		
        </div><!-- ./wrapper -->
 
 
 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../adm_clientes/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts --> 
        <script src="../adm_clientes/js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../adm_clientes/js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../adm_clientes/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../adm_clientes/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../adm_clientes/js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../adm_clientes/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../adm_clientes/js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../adm_clientes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../adm_clientes/js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../adm_clientes/js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../adm_clientes/js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
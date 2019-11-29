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
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | F&OacuteRUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, tutoriais, como funciona, ganhar dinheiro na internet, MMN, talkfusion, trafficmonsoon, como funciona trafficmonsoon, trafficmonsoon como funciona, TALK FUSION como funciona"/>
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
                        <li><i class="fa fa-question"></i> FORUM </li>
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
		
		
		
		
		
<?php
// quantidades de topicos em CM tutoriais
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE CATEGORIA = 'COMUNIDADE'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total2 = count( $res );
  
// quantidades de topicos em TF tutoriais
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE CATEGORIA = 'TALKFUSION'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total5 = count( $res );

// quantidades de topicos em Traffic Monsoon tutoriais
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE CATEGORIA = 'TRAFFICMONSOON'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total20 = count( $res );
 
// quantidades de topicos em BLOG 
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE CATEGORIA = 'BLOG'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total6 = count( $res );

// quantidades de RESPOSTAS CM tutoriais
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'COMUNIDADE'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total9 = count( $res );
 
// quantidades de RESPOSTAS TALKFUSION tutoriais
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'TALKFUSION'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total12 = count( $res );

// quantidades de RESPOSTAS TRAFFICMONSOON tutoriais
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'TRAFFICMONSOON'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total121 = count( $res );
 
// quantidades de RESPOSTAS  BLOGS tutoriais
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'BLOG'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total7 = count( $res );


// ultima resposta CM tutoriais
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'COMUNIDADE' ORDER BY ID DESC LIMIT 1");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM = $ln->ID;
	$ultimo_post_CM_cliente = $ln->ID_CLIENTE;
	$ultimo_post_CM_id_topico = $ln->ID_TOPICO;	 
	$ultimo_post_CM_data = $ln->DATA_TOPICO;
	$ultimo_post_CM_data = implode("/",array_reverse(explode("-",$ultimo_post_CM_data)));	
}  
$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_post_CM_cliente'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM_cliente_foto = $ln->FOTO_PERFIL;
	$ultimo_post_CM_cliente_nome = $ln->NOME; 
}
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$ultimo_post_CM_id_topico'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM_titulo_topico = $ln->TITULO_TOPICO; 
}

$str = $ultimo_post_CM_titulo_topico;
include_once "funcao_url.php";


  

// ultima resposta TF TUTORIAL
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'TALKFUSION' ORDER BY ID DESC LIMIT 1");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM_4 = $ln->ID;
	$ultimo_post_CM_cliente4 = $ln->ID_CLIENTE;
	$ultimo_post_CM_id_topico4 = $ln->ID_TOPICO;	 
	$ultimo_post_CM_data4 = $ln->DATA_TOPICO;
	$ultimo_post_CM_data4 = implode("/",array_reverse(explode("-",$ultimo_post_CM_data4)));	
}  
$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_post_CM_cliente4'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM_cliente_foto4 = $ln->FOTO_PERFIL;
	$ultimo_post_CM_cliente_nome4 = $ln->NOME; 
}
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$ultimo_post_CM_id_topico4'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_CM_titulo_topico4 = $ln->TITULO_TOPICO; 
}


// ultima resposta TRAFFICMONSOON TUTORIAL
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'TRAFFICMONSOON' ORDER BY ID DESC LIMIT 1");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_tm_4 = $ln->ID;
	$ultimo_post_tm_cliente4 = $ln->ID_CLIENTE;
	$ultimo_post_tm_id_topico4 = $ln->ID_TOPICO;	 
	$ultimo_post_tm_data4 = $ln->DATA_TOPICO;
	$ultimo_post_tm_data4 = implode("/",array_reverse(explode("-",$ultimo_post_tm_data4)));	
}  
$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_post_tm_cliente4'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_tm_cliente_foto4 = $ln->FOTO_PERFIL;
	$ultimo_post_tm_cliente_nome4 = $ln->NOME; 
}
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$ultimo_post_tm_id_topico4'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_tm_titulo_topico4 = $ln->TITULO_TOPICO; 
}



// ultima resposta BLOG
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE CATEGORIA = 'BLOG' ORDER BY ID DESC LIMIT 1");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_blog = $ln->ID;
	$ultimo_post_blog_cliente = $ln->ID_CLIENTE;
	$ultimo_post_blog_id_topico = $ln->ID_TOPICO;	 
	$ultimo_post_blog_data = $ln->DATA_TOPICO;
	$ultimo_post_blog_data = implode("/",array_reverse(explode("-",$ultimo_post_blog_data)));	
}  
$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_post_blog_cliente'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_blog_cliente_foto = $ln->FOTO_PERFIL;
	$ultimo_post_blog_cliente_nome = $ln->NOME; 
}
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$ultimo_post_blog_id_topico'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln) {
	$ultimo_post_blog_titulo_topico = $ln->TITULO_TOPICO; 
}

$str = $ultimo_post_blog_titulo_topico;
include_once "funcao_url.php";
 
?>			
		<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">BLOG</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
					<table>
						<tr>
							<td style="width:6%;"><img src="../adm_clientes/img/blog-informacao-projeto-comunidade-multi-nivel.png" width="30" height="30" alt="For&uacute;m da TALK FUSION"  /></td>
							<td><b style="color:#666;font-size:20px;"><a href="blog.php" title="Esse Espa&ccedil;o est&aacute; reservado para t&oacute;picos relacionados em divulgar Atualiza&ccedil;&otilde;es e Novidades do projeto da ComunidadeMultiN&iacute;vel. (Somente Moderadores da Comunidade podem criar t&oacute;picos aqui)">BLOG: Atualiza&ccedil;&otilde;es e Novidades de todo o Projeto</a></b><br>
							<i>Esse Espa&ccedil;o est&aacute; reservado para t&oacute;picos relacionados em divulgar Atualiza&ccedil;&otilde;es e Novidades do projeto da ComunidadeMultiN&iacute;vel. (Somente Moderadores da Comunidade podem criar t&oacute;picos aqui)</i>
							<br><br>
							</td>
							<td style="width:15%;">
							<b><?php echo $total6; ?> </b> T&oacute;picos <br>
							<b><?php echo $total7; ?> </b> Respostas
							</td>
							<td style="width:30%;">
							<div style="float:left; width:20%;">
								<?php  if ($ultimo_post_blog == "" || $ultimo_post_blog == 0) { ?>
									
								<?php  } else { ?>
									<?php if ($ultimo_post_blog_cliente_foto == "") { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_blog_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } else { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_blog_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultimo_post_blog_cliente_foto; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="float:right; width:80%; "> <!-- ultima resposta -->
							<?php  if ($ultimo_post_blog == "" || $ultimo_post_blog == 0) { ?>
									 <i style="color:red;">Nenhuma Resposta</i>
							<?php  } else { ?>
								<?php  
									$str = $ultimo_post_blog_titulo_topico;
									include_once "funcao_url.php";
								?>
									<b style="color:#666;font-size:11px;"><a href="topico/<?php echo $ultimo_post_blog_id_topico."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $ultimo_post_blog_titulo_topico; ?></a></b> <br>
									Respondido por <b><?php echo $ultimo_post_blog_cliente_nome; ?> </b> <br>
									<i style="color:#666;"><?php echo $ultimo_post_blog_data; ?> </i><br>
							<?php  } ?>
							</div> 
							</td> 
						</tr>
					</table>
					 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
		
		
		
		
		
		
		<div class="col-md-16">
			<div class="box box-solid bg-light-white">
				<div class="box-header" style="float:right; margin:0px 100px 0px 0px;">
					  <!-- Go to www.addthis.com/dashboard to customize your tools -->
					<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54aaee99684eaec3" async="async"></script>
					<!-- Go to www.addthis.com/dashboard to customize your tools -->
					<div class="addthis_sharing_toolbox"></div>
                </div> 
            </div><!-- /.box -->
			<br style="clear:both;">
        </div><!-- /.col -->	
		
		
		
		
		<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Comunidade Multi N&iacute;vel</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body"> 
					<table>
						<tr>
							<td style="width:6%;"><img src="../img/logotipo.gif" width="50" height="50" alt="For&uacute;m da ComunidadeMultiN&iacute;vel"  /></td>
							<td><b style="color:#666;font-size:20px;"><a href="comunidade_tutoriais.php" title="Espa&ccedil;o aberto para tirar todas as d&uacute;vidas referente ao sistema da ComunidadeMultiN&iacute;vel e Tutoriais, artigos explicativos passo a passo para melhor atendimento de nossos afiliados">D&uacute;vidas Gerais, Tutoriais, Dicas, Sugest&otilde;es, Cr&iacute;ticas e Coment&aacute;rios</a></b><br>
							<i>Espa&ccedil;o aberto para tirar todas as d&uacute;vidas referente ao sistema da ComunidadeMultiN&iacute;vel e Tutoriais, artigos explicativos passo a passo para melhor atendimento de nossos afiliados. </i>
							<br><br>
							</td>
							<td style="width:15%;">
							<b><?php echo $total2; ?> </b> T&oacute;picos <br>
							<b><?php echo $total9; ?> </b> Respostas
							</td>
							<td style="width:30%;">
							<div style="float:left; width:20%;">
								<?php  if ($ultimo_post_CM == "" || $ultimo_post_CM == 0) { ?>
									
								<?php  } else { ?>
									<?php if ($ultimo_post_CM_cliente_foto == "") { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_CM_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } else { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_CM_cliente; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultimo_post_CM_cliente_foto; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="float:right; width:80%; "> <!-- ultima resposta -->
							<?php  if ($ultimo_post_CM == "" || $ultimo_post_CM == 0) { ?>
									 <i style="color:red;">Nenhuma Resposta</i>
							<?php  } else { ?>
								<?php  
									$str = $ultimo_post_CM_titulo_topico;
									include_once "funcao_url.php";
								?> 
									<b style="color:#666;font-size:11px;"><a href="topico/<?php echo $ultimo_post_CM_id_topico."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $ultimo_post_CM_titulo_topico; ?></a></b> <br>
									Respondido por <b><?php echo $ultimo_post_CM_cliente_nome; ?> </b> <br>
									<i style="color:#666;"><?php echo $ultimo_post_CM_data; ?> </i><br>
							<?php  } ?>
							</div> 
							</td> 
						</tr>
					</table>
					 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col --> 
		
		<div class="col-md-16" >
			<div class="box box-solid bg-light-white">
				<div class="box-header">
					 
                </div>
                <div class="box-body" style="float:right;margin:0px 50px 0px 0px;" >
					<table>
						<tr>	
							<td>
								<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width=100&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:65px;" allowTransparency="true"></iframe>
							</td>
							<td>
								<script src="https://apis.google.com/js/platform.js"></script> 
								<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
							</td>
						</tr>
					</table>
                </div><!-- /.box-body -->
				<br style="clear:both;">
            </div><!-- /.box --> 
        </div><!-- /.col -->	
		
		
		
		
		
		<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Traffic Monsoon</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
					<table>
						<tr>
							<td style="width:6%;"><img src="../trafficmonsoon/images/logo-trafficmonsoon-comunidade-multinivel-ganhe-dinheiro-seja-financiado-com-adpacks.jpg" width="120" height="50" alt="For&uacute;m da Traffic Monsoon"  /></td>
							<td><b style="color:#666;font-size:20px;"><a href="trafficmonsoon_tutoriais.php" title="Espa&ccedil;o aberto para cria&ccedil;&atilde;o de artigos explicativos e passo a passo, referente a todo funcionamento da empresa TrafficMmonsoon">D&uacute;vidas Gerais, Tutoriais, Dicas, Sugest&otilde;es, Cr&iacute;ticas e Coment&aacute;rios</a></b><br>
							<i>Espa&ccedil;o aberto para tirar todas as d&uacute;vidas referente a Empresa TrafficMmonsoon e Tutoriais, artigos explicativos passo a passo para melhor atendimento de nossos afiliados. </i>
							<br><br>
							</td>
							<td style="width:15%;">
							<b><?php echo $total20; ?> </b> T&oacute;picos <br>
							<b><?php echo $total121; ?> </b> Respostas
							</td>
							<td style="width:30%;">
							<div style="float:left; width:20%;">
								<?php  if ($ultimo_post_tm_4 == "" || $ultimo_post_tm_4 == 0) { ?>
									
								<?php  } else { ?>
									<?php if ($ultimo_post_tm_cliente_foto4 == "") { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_tm_cliente4; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } else { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_tm_cliente4; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultimo_post_tm_cliente_foto4; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="float:right; width:80%; "> <!-- ultima resposta -->
							<?php  if ($ultimo_post_tm_4 == "" || $ultimo_post_tm_4 == 0) { ?>
									 <i style="color:red;">Nenhuma Resposta</i>
							<?php  } else { ?>
								<?php  
									$str = $ultimo_post_tm_titulo_topico4;
									include_once "funcao_url.php";
								?>
									<b style="color:#666;font-size:11px;"><a href="topico/<?php echo $ultimo_post_tm_id_topico4."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $ultimo_post_tm_titulo_topico4; ?></a></b> <br>
									Respondido por <b><?php echo $ultimo_post_tm_cliente_nome4; ?> </b> <br>
									<i style="color:#666;"><?php echo $ultimo_post_tm_data4; ?> </i><br>
							<?php  } ?>
							</div> 
							</td> 
						</tr>
					</table>
					 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
		
		
		
		
		
		<div class="col-md-16">
			<div class="box box-solid box-primary">
				<div class="box-header">
					<h3 class="box-title">Talk Fusion</h3>
                    <div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div>
                <div class="box-body">
					<table>
						<tr>
							<td style="width:6%;"><img src="../adm_clientes/img/icon_talkfusion.png" width="30" height="30" alt="For&uacute;m da TALK FUSION"  /></td>
							<td><b style="color:#666;font-size:20px;"><a href="talk_fusion_tutoriais.php" title="Espa&ccedil;o aberto para cria&ccedil;&atilde;o de artigos explicativos e passo a passo, referente ao funcionamento do site da TALK FUSION">D&uacute;vidas Gerais, Tutoriais, Dicas, Sugest&otilde;es, Cr&iacute;ticas e Coment&aacute;rios</a></b><br>
							<i>Espa&ccedil;o aberto para tirar todas as d&uacute;vidas referente a Empresa TALK FUSION e Tutoriais, artigos explicativos passo a passo para melhor atendimento de nossos afiliados. </i>
							<br><br>
							</td>
							<td style="width:15%;">
							<b><?php echo $total5; ?> </b> T&oacute;picos <br>
							<b><?php echo $total12; ?> </b> Respostas
							</td>
							<td style="width:30%;">
							<div style="float:left; width:20%;">
								<?php  if ($ultimo_post_CM_4 == "" || $ultimo_post_CM_4 == 0) { ?>
									
								<?php  } else { ?>
									<?php if ($ultimo_post_CM_cliente_foto4 == "") { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_CM_cliente4; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } else { ?>
										<a href="../adm_clientes/completo.php?perfil=<?php echo $ultimo_post_CM_cliente4; ?>" title="Veja o Perfil"><img src="../adm_clientes/img_perfil/<?php echo $ultimo_post_CM_cliente_foto4; ?>"  class="img-circle" alt="Sua Imagem" width="40" /></a>
									<?php } ?>
								<?php } ?>
							</div>
							<div style="float:right; width:80%; "> <!-- ultima resposta -->
							<?php  if ($ultimo_post_CM_4 == "" || $ultimo_post_CM_4 == 0) { ?>
									 <i style="color:red;">Nenhuma Resposta</i>
							<?php  } else { ?>
								<?php  
									$str = $ultimo_post_CM_titulo_topico4;
									include_once "funcao_url.php";
								?>
									<b style="color:#666;font-size:11px;"><a href="topico/<?php echo $ultimo_post_CM_id_topico4."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO"><?php echo $ultimo_post_CM_titulo_topico4; ?></a></b> <br>
									Respondido por <b><?php echo $ultimo_post_CM_cliente_nome4; ?> </b> <br>
									<i style="color:#666;"><?php echo $ultimo_post_CM_data4; ?> </i><br>
							<?php  } ?>
							</div> 
							</td> 
						</tr>
					</table>
					 
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->



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
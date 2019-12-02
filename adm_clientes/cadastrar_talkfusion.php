<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
 

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
		$talk = $ln_verifc->TALK_FUSION;
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

 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
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
                        <li class="active">Seja um Distribuidor da empresa TALK FUSION</li>
                    </ol>
                </section>
			<section class="content">
			
 <div style="text-align:center;width:100%;">				
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
</div> 	
				<div class="box-header">
					<h3 class="box-title">Conecte-se ao estilo de vida que voc&ecirc; merece !!!</h3>
				</div><!-- /.box-header -->
				<HR>

<?php 
$id_patrocinador2 = 0;
$id_patrocinador3 = 0;
$id_patrocinador4 = 0;
$id_patrocinador5 = 0;
$upline = 1;
 
	
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ); 
	foreach($res as $ln_verifc) {  
		$talk = $ln_verifc->TALK_FUSION;
		$id_patrocinador = $ln_verifc->ID_INDICACAO; 
	}  
		// nao esta cadastrado
		// verifica se ID do patrocinador e igual a 0 
		if ($id_patrocinador <= 0) {
			$upline = 1; 
		} else { 
			// busca id_patrocinador 1
			$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador'");
			$sql->execute();
			$res = $sql->fetchAll(PDO::FETCH_OBJ); 
			foreach($res as $ln_verifc) {  
				$id_patrocinador = $ln_verifc->ID; 
				$talk1 = $ln_verifc->TALK_FUSION;
				$id_patrocinador2 = $ln_verifc->ID_INDICACAO;
				$nome_patrocinador = $ln_verifc->NOME;
			}  
			if ($talk1 == "SIM") {
				$upline = $id_patrocinador;
			} else {
				if ($id_patrocinador2 <= 0) {
					$id_patrocinador2 = 1; 
				}
				// busca id_patrocinador 2
				$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador2'");
				$sql->execute();
				$res = $sql->fetchAll(PDO::FETCH_OBJ); 
				foreach($res as $ln_verifc) {  
					$id_patrocinador2 = $ln_verifc->ID; 
					$talk2 = $ln_verifc->TALK_FUSION;
					$id_patrocinador3 = $ln_verifc->ID_INDICACAO; 
				} 
				if ($talk2 == "SIM") {
					$upline = $id_patrocinador2;
				} else {
					if ($id_patrocinador3 <= 0) {
						$id_patrocinador3 = 1; 
					}
					// busca id_patrocinador 3
					$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador3'");
					$sql->execute();
					$res = $sql->fetchAll(PDO::FETCH_OBJ); 
					foreach($res as $ln_verifc) {  
						$id_patrocinador3 = $ln_verifc->ID; 
						$talk3 = $ln_verifc->TALK_FUSION;
						$id_patrocinador4 = $ln_verifc->ID_INDICACAO; 
					} 
					if ($talk3 == "SIM") {
						$upline = $id_patrocinador3;
					} else {
						if ($id_patrocinador4 <= 0) {
							$id_patrocinador4 = 1; 
						}
						// busca id_patrocinador 4
						$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador4'");
						$sql->execute();
						$res = $sql->fetchAll(PDO::FETCH_OBJ); 
						foreach($res as $ln_verifc) {  
							$id_patrocinador4 = $ln_verifc->ID; 
							$talk4 = $ln_verifc->TALK_FUSION;
							$id_patrocinador5 = $ln_verifc->ID_INDICACAO; 
						} 
						if ($talk4 == "SIM") {
							$upline = $id_patrocinador4;
						} else {
							if ($id_patrocinador5 <= 0) {
								$id_patrocinador5 = 1; 
							}
							// busca id_patrocinador 5
							$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador5'");
							$sql->execute();
							$res = $sql->fetchAll(PDO::FETCH_OBJ); 
							foreach($res as $ln_verifc) {  
								$id_patrocinador5 = $ln_verifc->ID; 
								$talk5 = $ln_verifc->TALK_FUSION; 
							} 
							if ($talk5 == "SIM") {
								$upline = $id_patrocinador5;
							} else {
							 // continue fazendo os niveis de indicações aq.. vai que em 5 nivel não tem ninguem na TALK.. tendeu
							} 
						} 
					} 
				} 
			} 
		} 
  

$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$upline'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln_verifc) {  
	$id_upline = $ln_verifc->ID;
	$nome_upline = $ln_verifc->NOME; 	
	$foto_upline = $ln_verifc->FOTO_PERFIL; 
} 

$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$upline' && LINK_PRINCIPAL = 'SIM' && STATUS = 'ATIVO'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln_verifc) {  
	$link_upline = $ln_verifc->LINK_INDICACAO; 
} 
 
 
$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'PENDENTE'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);  
foreach($res as $ln_verifc) {  
	$status_pendente = $ln_verifc->STATUS; 
}

$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'ATIVO'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_ativos = count( $res );  
foreach($res as $ln_verifc) {  
	$ja_esta_cadastrado = $ln_verifc->STATUS; 
	$ja_esta_cadastrado_upline = $ln_verifc->ID_UPLINE; 
} 
// detectar o link principal do afiliado que ja esta cadastrado na TALK
$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'ATIVO' && LINK_PRINCIPAL = 'SIM'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln_verifc) {  
	$ja_esta_cadastrado_link = $ln_verifc->LINK_INDICACAO; 
	
} 
 
$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ja_esta_cadastrado_upline'"); 
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ); 
foreach($res as $ln_verifc) {   
	$ja_esta_cadastrado_upline_nome = $ln_verifc->NOME; 	
	$ja_esta_cadastrado_upline_foto = $ln_verifc->FOTO_PERFIL; 
} 

?>		 
		 
		
<div class="box box-primary">
	<div id="esqueda" class="col-lg-3 col-xs-6" style="border-right:2px solid #000;">
		<a href="../talkfusion" title="Clique Aqui e Saiba Mais sobre a empresa TALK FUSION" target="_blank"> <img src="img/talk-fusion-logo-comunidade-multinivel.jpg" width="300" alt="LOGO da TALK FUSION"   /></a>
		<hr>

<?php
// ja esta cadastrado 
if ($total_ativos >= 1) {  	
?>	
 
<div class="alert alert-success alert-dismissable">
	<i class="fa fa-check"></i>
	<h2>Parab&eacute;ns !!!  <h2>
	<h4>Voc&ecirc; j&aacute; &eacute; um(a) distribuidor(a) da empresa TALK FUSION<h4>
	
	<p> - Seu LINK de indica&ccedil;&atilde;o da TALK FUSION, j&aacute; est&aacute; dispon&iacute;vel para todos seus indicados da ComunidadeMultiN&iacute;vel. </p>
	<p> - Atualmente voc&ecirc; possui  <b><?php echo $total_ativos; ?></b> pacotes de produtos aderido. </p>
</div>
<?php 
	if ($total_ativos >= 2) {
		// buscando a pessoa que e patrociandor desse cliente que possiu  2 ou mais pacotes
		$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && ID_UPLINE <> '$id_cliente' && STATUS = 'ATIVO'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ); 
		foreach($res as $ln_verifc) {  
			$meu_patrocinador_id = $ln_verifc->ID_UPLINE; 
		} 
		$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$meu_patrocinador_id'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ); 
		foreach($res as $ln_verifc) {  
			$meu_patrocinador_nome = $ln_verifc->NOME;
			$meu_patrocinador_foto = $ln_verifc->FOTO_PERFIL; 			
		}   
?>

	<p class="badge bg-green" style="font-size:15px;border:1px solid #000;">Seu UP-LINE da TALK FUSION &eacute; <i class="fa  fa-arrow-down"></i> <i class="fa  fa-arrow-down"></i> </p> 
	<br>
	<div class="pull-left image">
		<?php if ($meu_patrocinador_foto == "") { ?>
            <a href="completo.php?perfil=<?php echo $meu_patrocinador_id; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"> <img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } else { ?>
			<a href="completo.php?perfil=<?php echo $meu_patrocinador_id; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"><img src="img_perfil/<?php echo $meu_patrocinador_foto; ?>"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } ?>
	</div>
	<div id="div-perfil-do-lider">
		<b><?php echo $meu_patrocinador_nome; ?>.</b><br>
		<i class="fa  fa-arrow-left"></i>  Clique para visualizar o perfil dele(a). 
	</div>
<?php 
	} else { 
	 // mostra patrocinador da pessoa que possui apenas 1 pacote
?>	 
	<p class="badge bg-green" style="font-size:15px;border:1px solid #000;">Seu UP-LINE da TALK FUSION &eacute; <i class="fa  fa-arrow-down"></i> <i class="fa  fa-arrow-down"></i> </p> 
	<br>
	<div class="pull-left image">
		<?php if ($ja_esta_cadastrado_upline_foto == "") { ?>
            <a href="completo.php?perfil=<?php echo $ja_esta_cadastrado_upline; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"> <img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } else { ?>
			<a href="completo.php?perfil=<?php echo $ja_esta_cadastrado_upline; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"><img src="img_perfil/<?php echo $ja_esta_cadastrado_upline_foto; ?>"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } ?>
	</div>
	<div id="div-perfil-do-lider">
		<b><?php echo $ja_esta_cadastrado_upline_nome; ?>.</b><br>
		<i class="fa  fa-arrow-left"></i>  Clique para visualizar o perfil dele(a). 
	</div>
<?php 
	}   
 	
} else {  
	//nao esta cadastrado 
if ($talk1 != "SIM") {		
?>	
	
<div class="alert alert-warning alert-dismissable">
	<i class="fa fa-warning"></i>
	<h4> Seu Patrocinador <b>(<a href="completo.php?perfil=<?php echo $id_patrocinador; ?>" title="entre em contato com ele, para fortalecer sua equipe na empresa TALK FUSION"><?php echo $nome_patrocinador; ?></a>)</b> ainda n&atilde;o est&aacute; cadastrado na TALK FUSION.<h4>
	<h5> Por uma quest&atilde;o de &eacute;tica de trabalho, aconselhamos que voc&ecirc; entre em contato com seu patrocinador da Comunidade MultiN&iacute;vel, solicitando o link de indica&ccedil;&atilde;o dele(a), para que ele(a) se mantenha como seu UP-LINE tamb&eacute;m na empresa TALK FUSION.<h5>
</div> 
<i>	Outra alternativa </i><i class="fa  fa-arrow-down"></i><br>
<p>	Facilitamos para voc&ecirc;. Foi detectado no sistema, entre seus UP-LINEs da Comunidade MultiN&iacute;vel, o(a) Lider mais pr&oacute;ximo que j&aacute; seja um(a) distribuidor(a) da empresa TALK FUSION.</p>
<?php  
}	 
?>  
 
	<p class="badge bg-green" style="font-size:17px;border:1px solid #000;">Seu UP-LINE ser&aacute; <i class="fa  fa-arrow-down"></i> <i class="fa  fa-arrow-down"></i> </p> 
	<br>
	<div class="pull-left image">
		<?php if ($foto_upline == "") { ?>
            <a href="completo.php?perfil=<?php echo $id_upline; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"> <img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } else { ?>
			<a href="completo.php?perfil=<?php echo $id_upline; ?>" title="Entre em contato com ele(a) para ampliar seus conhecimentos e compartilhar suas ideias"><img src="img_perfil/<?php echo $foto_upline; ?>"  class="img-circle" alt="Sua Imagem" width="100" /></a>
		<?php } ?>
	</div>	
	<div id="div-perfil-do-lider">
		<b><?php echo $nome_upline; ?>.</b><br>
		<i class="fa  fa-arrow-left"></i>  Clique para visualizar o perfil dele(a). 
	</div>
<?php
}
?>		
	</div>
	
	<div id="direta" class="col-lg-9 col-xs-8" >
<?php
// ja esta cadastrado 
if ($total_ativos >= 1) {  	
?>	 
		<br>
		<iframe width="803" height="450" src="https://www.youtube.com/embed/PG_CmWuFWAI?rel=0" frameborder="0" allowfullscreen></iframe>
		<br>
		<div class="box-header">
			<h3 class="box-title">N&oacute;s n&atilde;o estamos mudando apenas a forma de como o mundo se comunica.</h3>
			<h3 class="box-title">Estamos mudando vidas, e AGORA &eacute; a sua vez, </h3>
			<h3 class="box-title">Traga seus sonhos e n&oacute;s ajudaremos a Realiza-los! </h3>
		</div><!-- /.box-header -->
		<br>
		<h2>Algumas Dicas para iniciar seus trabalhos </h2>
		<p>- <a href="http://www.comunidademultinivel.com.br/forum/topico/19-Quais-estrategias-de-trabalho-que-facilitara-o-meu-crescimento-na-empresa-TALK-FUSION" title="Quais as melhores estrat&eacute;gias de trabalho que posso utilizar para aproveitar do crescimento do meu rendimento">Clique aqui </a>, E saiba como vou ganhar dinheiro na empresa TALK FUSION e quais estrat&eacute;gias de trabalho voc&ecirc; poder&aacute; usar.</p>
		<p>- <a href="http://www.comunidademultinivel.com.br/forum/topico/24-Como-duplicar-seus-rendimentos-na-empresa-TALK-FUSION" title="Estrat&eacute;gia para aumentar sua lucratividade na empresa TALK FUSION">Clique aqui </a>, leia essa dica e entenda como duplicar seus rendimentos na empresa TALK FUSION, obtendo o famoso trip&eacute;.</p>
		<p>- <a href="http://www.comunidademultinivel.com.br/forum/topico/25-Como-indicar-um-amigo-na-Comunidade-MultiNivel-" title="Como Indicar um amigo em meu LINK de indica&ccedil;&atilde;o para o projeto da TALK FUSION">Clique aqui </a>, Para entender quais ser&atilde;o os procedimentos para voc&ecirc; indicar uma pessoa, para fazer parte de sua equipe abaixo na empresa TALK FUSION.</p>
		<p>- <a href="http://www.comunidademultinivel.com.br/forum/topico/3-Como-Solicitar-e-Ativar-meu-Cartao-da-TALK-FUSION" title="Esse &eacute; o cart&atilde;o que a TALK FUSION ir&aacute; lhe pagar suas comiss&otilde;es de IMEDIATO">Clique aqui </a>, E veja como solicitar e ativar seu Cart&atilde;o personalizado da empresa TALK FUSION (As comiss&otilde;es ser&atilde;o pagas de IMEDIATO).</p>
		<br>
		<hr>
<?php if ($status_pendente == "PENDENTE") { ?>
		<div class="alert alert-warning alert-dismissable">
			<i class="fa fa-warning"></i> 
			<h4>Foi detectado no sistema sua tentativa de aderir um NOVO pacote de produtos da empresa TALK FUSION, atrav&eacute;s de sua pr&oacute;pria indica&ccedil;&atilde;o, caso voc&ecirc; tenha completado seu cadastro CORRETAMENTE e efetuado o pagamento de seu pacote de produtos, aguarde os moderadores da ComunidadeMultiN&iacute;vel aprovar o seu cadastro e registrar o seu pr&oacute;ximo link de indica&ccedil;&atilde;o no sistema, para que seu LINK seja disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel. </h4>
			
			<p>Ap&oacute;s os moderadores da ComunidadeMultiN&iacute;vel aprovarem seu cadastro, o seu NOVO LINK de indica&ccedil;&atilde;o da empresa TALK FUSION, ir&aacute; aparecer nesse bot&atilde;o verde abaixo e ser&aacute; disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel tamb&eacute;m se cadastrarem em sua rede abaixo de seu novo pacote da empresa TALK FUSION, fazendo com que seus rendimentos na empresa TALK FUSION sejam duplicados.</p>
			<br>
			<p><a href="http://www.comunidademultinivel.com.br/forum/topico/24-Como-duplicar-seus-rendimentos-na-empresa-TALK-FUSION" title="Estrat&eacute;gia para aumentar sua lucratividade na empresa TALK FUSION">Clique aqui </a>, leia essa dica e entenda como duplicar seus rendimentos na empresa TALK FUSION, obtendo o famoso trip&eacute;</p>
			<br> 
		</div> 
			 
<?php } ?> 
<?php   
	if ($total_ativos >= 2) {
	
		$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'ATIVO'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		$total_ativos_table = count( $res );   
?>
	<div class="box-header">
		<h3 class="box-title">Escolha qual dos seus LINKs de Indica&ccedil;&otilde;es abaixo ser&aacute; dispon&iacute;bilizado para seus indicados da ComunidadeMultiN&iacute;vel.</h3>
    </div><!-- /.box-header --> 
		
		<form id="form" name="form" method="post" action="alterando_link_indicacao_talkfusion.php">
			<input TYPE="HIDDEN" id="id_posicao" name="id_posicao" class="text" value=" " />
			
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
						 <input type="radio" name="link_principal_table" value="<?php echo $ja_esta_cadastrado_id_table; ?>" <?php if ($ja_esta_cadastrado_link_principal_table == 'SIM') {?> checked <?php } ?>  >
						 
						</th> 
					</tr>
				</thead> 
<?php 
	} 
?> 
			</table>
			<i style='color:red;'>O Link que voc&ecirc; selecionar, ser&aacute; disponibilizado no bot&atilde;o verde abaixo para todos seus indicados.</i>
			<div class="box-footer">
				<input type="submit" class="btn btn-primary" value="Confirmar LINK de indica&ccedil;&atilde;o Principal" /> 
			</div>
		</form>
<?php	
	}
?> 		
		<br>
		<hr>
		<div class="alert alert-info alert-dismissable">
			<i class="fa fa-info"></i> 
			
			<form id="form_info_1" name="form_info_1" method="post" action="notificando_cadastro_talkfusion.php" target="_blank">
				<INPUT TYPE="hidden" NAME="id_upline" VALUE="<?php echo $id_cliente; ?>">
				<INPUT TYPE="hidden" NAME="link_upline" VALUE="<?php echo $ja_esta_cadastrado_link; ?>"> 				
				<button type="submit"  class="btn btn-success btn-lg" title="Efetue seu cadastro agora mesmo, atrav&eacute;s da indica&ccedil;&atilde;o do(a) <?php echo $nome; ?>" ><i class="fa  fa-arrow-right"></i> <i class="fa  fa-arrow-right"></i>  LINK de Cadastro: 	http://<?php echo $ja_esta_cadastrado_link; ?>.talkfusion.com/pt/  <i class="fa  fa-arrow-left"></i> <i class="fa  fa-arrow-left"></i></button> 
			</form> 
		</div> 
		<hr>
		<b>Est&aacute; com dificuldades para se cadastrar e aderir seu NOVO pacote de produtos ? </b><a href="http://www.comunidademultinivel.com.br/forum/topico/23-Como-se-cadastrar-na-empresa-TALK-FUSION" title="Tutorial de Como se cadastrar na empresa TALK FUSION, passo a passo.">clique aqui</a> e veja um passo a passo. 
		<br><br> 
		<b style="color:red;font-size:30px;"> Ainda com D&uacute;vidas ? </b> acesse nosso F&Oacute;RUM e fa&ccedil;a sua pergunta criando um t&oacute;pico 
		<a class="login_talk" href="../forum/talk_fusion_tutoriais.php" title="Tire Todas Suas Duvidas no For&uacute;m Da ComunidadeMultiN&iacute;vel" target="_blank"> 
			<img  src="img/logo_forum_comunidademultinivel.png" width="60" height="60" alt="For&uacute;m da ComunidadeMultiN&iacute;vel"  /> 
		</a> 
		<br> 
<?php	
} else {  
	//nao esta cadastrado
?>
		<br>
		<iframe width="803" height="450" src="https://www.youtube.com/embed/M0Xk-yO4vRE?rel=0" frameborder="0" allowfullscreen></iframe>
		<br>
		<div class="box-header">
			<h3 class="box-title">O momento certo &eacute; agora !!! cadastre-se atrav&eacute;s do link de indica&ccedil;&atilde;o abaixo, escolha o seu pacote de produtos, efetue o pagamento e se torne mais um(a) novo(a) distribuidor(a) da empresa TALK FUSION em nossa equipe.  </h3>
		</div><!-- /.box-header -->
		<br> 
<?php if ($status_pendente == "PENDENTE" && $ja_esta_cadastrado != "ATIVO") { ?>
		<div class="alert alert-warning alert-dismissable">
			<i class="fa fa-warning"></i> 
			<h4>Foi detectado no sistema sua tentativa de se cadastrar na empresa TALK FUSION, caso voc&ecirc; tenha completado seu cadastro CORRETAMENTE e efetuado o pagamento de seu pacote de produtos, aguarde os moderadores da ComunidadeMultiN&iacute;vel aprovar o seu cadastro e registrar o seu link de indica&ccedil;&atilde;o no sistema, para que seu LINK seja disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel. </h4>
			
			<p>Ap&oacute;s os moderadores da ComunidadeMultiN&iacute;vel aprovarem seu cadastro, o seu LINK de indica&ccedil;&atilde;o da empresa TALK FUSION, ir&aacute; aparecer nesse bot&atilde;o verde abaixo e ser&aacute; disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel tamb&eacute;m se cadastrarem em sua rede abaixo da empresa TALK FUSION, fazendo com que voc&ecirc; ganhe suas devidas comiss&otilde;es da empresa.</p>
			<br>
			<i>- E se caso voc&ecirc; ainda n&atilde;o tenha completado seu cadastro na empresa TALK FUSION, clique no bot&atilde;o verde abaixo e dessa vez, efetue seu cadastro CORRETAMENTE para se tornar mais um(a) distribuidor(a) da empresa TALK FUSION em nossa equipe.</i>
		</div> 
			 
<?php } ?>

<?php if ($status_pendente == "PENDENTE" && $ja_esta_cadastrado == "ATIVO") { ?>
		<div class="alert alert-warning alert-dismissable">
			<i class="fa fa-warning"></i> 
			<h4>Foi detectado no sistema sua tentativa de aderir um NOVO pacote de produtos da empresa TALK FUSION, atrav&eacute;s de sua pr&oacute;pria indica&ccedil;&atilde;o, caso voc&ecirc; tenha completado seu cadastro CORRETAMENTE e efetuado o pagamento de seu pacote de produtos, aguarde os moderadores da ComunidadeMultiN&iacute;vel aprovar o seu cadastro e registrar o seu pr&oacute;ximo link de indica&ccedil;&atilde;o no sistema, para que seu LINK seja disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel. </h4>
			
			<p>Ap&oacute;s os moderadores da ComunidadeMultiN&iacute;vel aprovarem seu cadastro, o seu NOVO LINK de indica&ccedil;&atilde;o da empresa TALK FUSION, ir&aacute; aparecer nesse bot&atilde;o verde abaixo e ser&aacute; disponibilizado para todos seus indicados da ComunidadeMultiN&iacute;vel tamb&eacute;m se cadastrarem em sua rede abaixo de seu novo pacote da empresa TALK FUSION, fazendo com que seus rendimentos na empresa TALK FUSION sejam duplicados.</p>
			<br>
			<p><a href="http://www.comunidademultinivel.com.br/forum/topico/24-Como-duplicar-seus-rendimentos-na-empresa-TALK-FUSION" title="Estrat&eacute;gia para aumentar sua lucratividade na empresa TALK FUSION">Clique aqui </a>, leia essa dica e entenda como duplicar seus rendimentos na empresa TALK FUSION, obtendo o famoso trip&eacute;</p>
			<br> 
		</div> 
			 
<?php } ?>
		
		<div class="alert alert-info alert-dismissable">
			<i class="fa fa-info"></i> 
			
			<form id="form_info_1" name="form_info_1" method="post" action="notificando_cadastro_talkfusion.php" target="_blank">
				<INPUT TYPE="hidden" NAME="id_upline" VALUE="<?php echo $id_upline; ?>">
				<INPUT TYPE="hidden" NAME="link_upline" VALUE="<?php echo $link_upline; ?>"> 				
				<button type="submit"  class="btn btn-success btn-lg" title="Efetue seu cadastro agora mesmo, atrav&eacute;s da indica&ccedil;&atilde;o do(a) <?php echo $nome_upline; ?>" ><i class="fa  fa-arrow-right"></i> <i class="fa  fa-arrow-right"></i>  LINK de Cadastro: 	http://<?php echo $link_upline; ?>.talkfusion.com/pt/  <i class="fa  fa-arrow-left"></i> <i class="fa  fa-arrow-left"></i></button> 
			</form> 
		</div> 
		<hr>
		<b>Est&aacute; com dificuldades para se cadastrar ? </b><a href="http://www.comunidademultinivel.com.br/forum/topico/23-Como-se-cadastrar-na-empresa-TALK-FUSION" title="Tutorial de Como se cadastrar na empresa TALK FUSION, passo a passo.">clique aqui</a> e veja um passo a passo. 
		<br><br> 
		<b style="color:red;font-size:30px;"> Ainda com D&uacute;vidas ? </b> acesse nosso F&Oacute;RUM e fa&ccedil;a sua pergunta criando um t&oacute;pico 
		<a class="login_talk" href="../forum/talk_fusion_tutoriais.php" title="Tire Todas Suas Duvidas no For&uacute;m Da ComunidadeMultiN&iacute;vel" target="_blank"> 
			<img  src="img/logo_forum_comunidademultinivel.png" width="60" height="60" alt="For&uacute;m da ComunidadeMultiN&iacute;vel"  /> 
		</a> 
		<br>
<?php 
}
?>		
	</div> 
</div>				
 
				
            </section>
                
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
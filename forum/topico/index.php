<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE); 
include("../../config/config.php");
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

	  
	$url  = isset($_GET['url']) ? $_GET['url'] : 'home';
	
	$separar  = explode('-', $url);
    $pagina   = (isset($separar[0])) ? $separar[0] : 'home';
	$sub_pagina   = (isset($separar[1])) ? $separar[1] : 'home';
	$sub2_pagina   = (isset($separar[2])) ? $separar[2] : '0';
	$sub3_pagina   = (isset($separar[3])) ? $separar[3] : '0';
     
	try {
		$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$pagina'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		$total = count( $res );
		foreach($res as $ln) { 
			$id_topico = $ln->ID;
			$id_cliente_topico =  $ln->ID_CLIENTE;
			$categoria_topico =  $ln->CATEGORIA; 
			$topic_dica =  $ln->DICA;
			$titulo_topico =  $ln->TITULO_TOPICO; 
			$texto_topico =    html_entity_decode($ln->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
			$tags_topico =  $ln->TAGS_TOPICO;
			$contador_topico =  $ln->CONTADOR;
			$data = $ln->DATA_TOPICO;
			$data = implode("/",array_reverse(explode("-",$data))); 
		} 
	} catch(PODException $e) {
		echo "Erro:/n".$e->getMessage();
	} 	
	
	$novo_contador = $contador_topico+1;
	 
	$altera = "UPDATE $tabela10 SET CONTADOR=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($novo_contador,$id_topico));
?>	
	 
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $titulo_topico; ?>  | TRAFFICMONSOON | Comunidade MutiN&iacute;vel| F&Oacute;RUM </title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="<?php echo $tags_topico; ?>"/>
		<meta name="robots" content="all">
		<Meta Name="Description" Content="TRAFFICMONSOON: <?php echo $titulo_topico; ?>">
		<meta property='og:image' content='http://www.comunidademultinivel.com.br/adm_clientes/img/talkfusion-indenesia-3.jpg'/>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
        <link href="../../adm_clientes/css/estilo.css" rel="stylesheet" type="text/css" /> 
        <!-- bootstrap 3.0.2 -->
        <link href="../../adm_clientes/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../adm_clientes/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../adm_clientes/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../adm_clientes/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../adm_clientes/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../../adm_clientes/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../../adm_clientes/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../adm_clientes/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../adm_clientes/css/AdminLTE.css" rel="stylesheet" type="text/css" /> 
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
                        <small> </small>
                    </h1>
                    <ol class="breadcrumb">  
						<li><i class="fa fa-question"></i> <a href="../index.php" title="Retornar aos F&Oacute;RUNS">FORUM </a> </li>
						<?php
							if ($categoria_topico == "COMUNIDADE") { ?>
									<li class="active"> <a href="../comunidade_tutoriais.php" title="Retornar aos F&Oacute;RUM ComunidadeMultiN&iacute;vel / Tutoriais e D&uacute;vidas"> ComunidadeMultiN&iacute;vel / Tutoriais e D&uacute;vidas </a></li>	
						<?php		 
							} else if ($categoria_topico == "TALKFUSION") { ?>
									<li class="active"> <a href="../talk_fusion_tutoriais.php" title="Retornar aos F&Oacute;RUM TALK FUSION / Tutoriais e D&uacute;vidas"> TALK FUSION / Tutoriais e D&uacute;vidas </a></li>	
						<?php		 
							} else if ($categoria_topico == "BLOG") { ?>
									<li class="active"> <a href="../blog.php" title="Retornar ao F&Oacute;RUM BLOG"> BLOG </a></li>	
						<?php		 
							}  else if ($categoria_topico == "TRAFFICMONSOON") { ?>
									<li class="active"> <a href="../trafficmonsoon_tutoriais.php" title="Retornar aos F&Oacute;RUM TRAFFIC MONSOON / Tutoriais e D&uacute;vidas"> TRAFFIC MONSOON / Tutoriais e D&uacute;vidas </a></li>
						<?php		 
							} 
						?>  
						
                        
						
						
						<li class="active"><?php echo $titulo_topico; ?> </li>
                    </ol>
                </section>
 
            </aside><!-- /.right-side -->
		  
<div style="float:left; width:25%; ;margin:5px 0px 0px 10px;">		
		 
		<div class="col-md-14" >
			<div class="box box-solid bg-light-blue">
				<div class="box-header">
					<h3 class="box-title"><i class="fa fa-bar-chart-o"></i> ESTAT&Iacute;STICAS DO T&Oacute;PICO</h3>
					<div class="box-tools pull-right">
						<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
                    </div>
                </div> 
                <div class="box-body" style="width:100%; border:3px solid #ededed; background:#FFF; color:#000;">
<?php   
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$pagina'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) {
	$total_visualizacao = $ln->CONTADOR;
}
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_TOPICO = '$pagina'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total_res = count( $res );
?>


					<b>Esse T&oacute;pico foi Visualizado </b> <button class="btn btn-warning disabled" data-widget="collapse"><?php echo $total_visualizacao; ?></button>  <b> vezes.</b> <br>
					<b>Um Total de </b> <button class="btn btn-warning disabled" data-widget="collapse"><?php echo $total_res; ?></button> <b> respostas.</b> <br>
					<i>Esse T&oacute;pico deve a participa&ccedil;&atilde;o dos seguintes afiliados</i> <br>
<?php  
// ultima resposta 
$sql = $con->prepare("SELECT DISTINCT ID_CLIENTE FROM $tabela11 WHERE ID_TOPICO = '$pagina' GROUP BY ID_CLIENTE");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) {  
	 
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ln->ID_CLIENTE'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ); 
	foreach($res as $ln) { 
		$ultimo_postid_cliente = $ln->ID;
		$ultimo_postnome_cliente = $ln->NOME;
		$ultimo_postfoto_cliente = $ln->FOTO_PERFIL; 
	}
?>	
	<div style="float:left;"> 
		<?php if ($ultimo_postfoto_cliente == "") { ?>
			<a href="../../adm_clientes/completo.php?perfil=<?php echo $ultimo_postid_cliente; ?>" title="Veja o Perfil do(a) <?php echo $ultimo_postnome_cliente; ?>"><img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="40" /></a>
		<?php } else { ?>
			<a href="../../adm_clientes/completo.php?perfil=<?php echo $ultimo_postid_cliente; ?>" title="Veja o Perfil do(a) <?php echo $ultimo_postnome_cliente; ?>"><img src="../../adm_clientes/img_perfil/<?php echo $ultimo_postfoto_cliente; ?>"  class="img-circle" alt="Sua Imagem" width="30" /></a>
		<?php } ?> 
	</div> 
<?php
}
?>				 
				<br style="clear:both;">
				<br style="clear:both;">
                </div><!-- /.box-body -->  
				<br style="clear:both;">
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
<?php
	if ($pagina == "" || $total == 0){
?>
<div class="col-md-14">
	<div class="box box-solid box-primary">
		<div class="box-header">
				<h3 class="box-title">ERRO !!! Esse T&Oacute;PICO est&aacute; Inativo</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body"> 
 		<?php include("erro.php");  ?> 
		</div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->  	 
<?php		
	} else if ($pagina == "home"){
?>
<div class="col-md-14">
	<div class="box box-solid box-primary">
		<div class="box-header">
				<h3 class="box-title">ERRO !!! Esse T&Oacute;PICO est&aacute; Inativo</h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body"> 
 		<?php include("erro.php");  ?> 
		</div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.col -->  	 
<?php	 
	} else 	{

	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente_topico'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id_cliente_criou = $ln_verifc->ID; 
		$nome_cliente_criou = $ln_verifc->NOME;
		$pontos_cliente_criou = $ln_verifc->PONTOS;
		$talk_cliente_criou = $ln_verifc->TALK_FUSION;
		$talk_simulador_cliente_criou = $ln_verifc->TALK_SIMULADOR; 
		$data_cliente_criou = $ln_verifc->DATA_CADASTRO;
		$data_cliente_criou = implode("/",array_reverse(explode("-",$data_cliente_criou)));
		$foto_perfil_cliente_criou = $ln_verifc->FOTO_PERFIL;
	}	 



	
// quantos topicos o cliente que crio o topico criou
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID_CLIENTE = '$id_cliente_topico'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total2 = count( $res );	

// quantas respostas o cliente que crio o topico respondeu
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$id_cliente_topico'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total3 = count( $res );	

 

?>
<div class="col-md-16">
	<div class="box box-solid box-primary"> 
		<div class="box-header">
				<h3 class="box-title"><?php echo $titulo_topico;  if ($topic_dica == "SIM") { echo "<b style='color:yellow;'> (DICA)</b>"; } ?></h3>
			<div class="box-tools pull-right">
				<table>
					<tr>
						<td>
							<?php if ($id_cliente == $id_cliente_topico) { ?>
							<form id="form_edit" name="form_edit" method="post" action="editar_topico.php">
								<INPUT TYPE="hidden" NAME="url" VALUE="<?php echo $url; ?>">
								<INPUT TYPE="hidden" NAME="id_cliente_criador" VALUE="<?php echo $id_cliente; ?>">  
								<INPUT TYPE="hidden" NAME="id_topico" VALUE="<?php echo $id_topico; ?>">
								<button type="submit" class="btn btn-primary btn-sm" title="Editar seu T&oacute;pico"><i class="fa fa-edit"></i></button>  
							</form>
							<?php } ?>
						</td>
						<td>
							<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
						</td>
					</tr> 
				</table>
			</div>
        </div>
		<div class="box-body">  
			<div style="float:left; width:19%; border:1px solid #CCC; margin:0px 5px 0px 0px;text-align:center;">
			<?php if ($foto_perfil_cliente_criou == "") { ?>
				<img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" />
			<?php } else { ?>
				<img src="../../adm_clientes/img_perfil/<?php echo $foto_perfil_cliente_criou; ?>"  class="img-circle" alt="Sua Imagem" width="100" />
			<?php } ?>
			<br>
			<b><a href="../../adm_clientes/completo.php?perfil=<?php echo $id_cliente_criou; ?>" title="Veja o Perfil" target="_blank"><?php echo $nome_cliente_criou; ?></a></b>
			<br>
			<b>T&oacute;picos: </b> <?php echo $total2; ?>
			<br>
			<b>Respostas:	</b> <?php echo $total3; ?>
			<br>
			<a href="../../talkfusion/<?php echo $id_cliente_criou; ?>" title="Cadastre-se na ComunidadeMultiN&iacute;vel, atrav&eacute;s de minha indica&ccedil;&atilde;o" target="_blank">Cadastre-se por Minha Indica&ccedil;&atilde;o</a>
			</div>
			<div  style="float:right; width:80%; ">
			<?php  
			
			echo $texto_topico; 
		  
			
			?>
			<hr>
			<?php 
			$sql = $con->prepare("SELECT * FROM $tabela13 WHERE ID_TOPICO = '$id_topico' ORDER BY ID DESC LIMIT 1");
			$sql->execute();
			$res = $sql->fetchAll(PDO::FETCH_OBJ); 
			$total_edit = count( $res );
			
			 
			if ($total_edit >= 1) {
				foreach($res as $ln_edit) { 
					$ultimo_editid_cliente = $ln_edit->ID_CLIENTE;
					$ultimo_editdata = $ln_edit->DATA_EDITADO; 
					$ultimo_editdata = implode("/",array_reverse(explode("-",$ultimo_editdata)));
					
					$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_editid_cliente'");
					$sql->execute();
					$res = $sql->fetchAll(PDO::FETCH_OBJ);
					foreach($res as $ln_edit) { 
						$id_cliente_editou = $ln_edit->ID;
						$nome_cliente_editou = $ln_edit->NOME;
					}
			?>
				<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-warning"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Esse T&oacute;pico foi editado pela &uacute;tima vez por <?php echo $nome_cliente_editou; ?> dia <?php echo $ultimo_editdata; ?>.</b> 
				</div>
			<?php } } ?>
			</div>
			
			<br style="clear:both;"> <br> 
		</div><!-- /.box-body -->
		
		
    </div><!-- /.box -->
	 
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
		
		
<?php
if ($id_cliente == "" || $id_cliente == 0 ) {
?>
<script>
function verifica() { 
	if (formlogin.email_login.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    }   
	//Validacao de Emails	
	var obj = eval("document.formlogin.email_login");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    }
	if (formlogin.senha_login.value == "") { 
		alert("O Campo senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
}
</script>
<div class="alert alert-warning alert-dismissable">
    <i class="fa fa-warning"></i>
	<b>Para que voc&ecirc; possa visualizar as respostas desse t&oacute;pico, voc&ecirc; precisa estar logado na ComunidadeMultiN&iacute;vel !!!</b><br><br>
	
	<div class="searchform">
        <form id="formlogin" name="formlogin" method="post" action="logando.php">
		  <INPUT TYPE="hidden" NAME="url" VALUE="<?php echo $url; ?>">
          <b>Email:* </b><input type="text" name="email_login" class="email_login" id="email_login" onfocus="this.className='email_login_foco'" onBlur="this.className='email_login'"  /> <br>
		  <b>Senha:* </b><input type="password" name="senha_login" class="senha_login" onfocus="this.className='senha_login_foco'" onBlur="this.className='senha_login'" />
          <input type="submit" value="Entrar" Onclick="return verifica()"   name="but_login" class="but_login" onfocus="this.className='but_login_foco'" onBlur="this.className='but_login'" />
		  <a href="../../talkfusion/solicitar_senha" title="esqueceu sua senha"> Esqueceu sua Senha ? </a><br>
		  <p>Caso ainda n&atilde;o seja registrado, entre em contato com algum de nossos represetantes ou <a href="../../talkfusion/contato" title="Entre em contato com a ComunidadeMultiN&iacute;vel">contate-nos</a></p>
        </form>
    </div>
</div>	
<?php	} else {  
	$sql_verifc = $con->prepare("SELECT * FROM $tabela11 WHERE ID_TOPICO = '$id_topico' order by ID ASC");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$total_resposta = count( $res_verifc );
	
	 
	foreach($res_verifc as $ln_verifc) {
		$id_resposta = $ln_verifc->ID; 
		$id_cliente_resposta = $ln_verifc->ID_CLIENTE;
		$id_topico_resposta = $ln_verifc->ID_TOPICO;
		$categoria_resposta = $ln_verifc->CATEGORIA; 
		$texto_resposta =    html_entity_decode((string)$ln_verifc->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
		$data_resposta = $ln_verifc->DATA_TOPICO;
		$data_resposta = implode("/",array_reverse(explode("-",$data_cliente_criou)));
		
		$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente_resposta'");
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
		
// quantos topicos o cliente que crio o topico criou
$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID_CLIENTE = '$id_cliente_resposta'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total2 = count( $res );	

// quantas respostas o cliente que crio o topico respondeu
$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$id_cliente_resposta'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
$total3 = count( $res );
?>		
	<div class="box box-solid box-primary">
		<div class="box-header">
				<h3 class="box-title"><?php echo $nome; ?></h3>
			<div class="box-tools pull-right">
				<table>
					<tr>
						<td>
							<?php if ($id_cliente == $id_cliente_resposta) { ?>
							<form id="form_edit" name="form_edit" method="post" action="editar_resposta.php">
								<INPUT TYPE="hidden" NAME="url" VALUE="<?php echo $url; ?>">
								<INPUT TYPE="hidden" NAME="id_cliente_criador" VALUE="<?php echo $id_cliente_resposta; ?>">  
								<INPUT TYPE="hidden" NAME="id_resposta" VALUE="<?php echo $id_resposta; ?>"> 
								<button type="submit" class="btn btn-primary btn-sm" title="Editar sua Resposta"><i class="fa fa-edit"></i></button>  
							</form>
							<?php } ?>
						</td>
						<td>
							<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
						</td>
					</tr> 
				</table> 
			</div>
        </div>
		<div class="box-body">  
			<div style="float:left; width:19%; border:1px solid #CCC; margin:0px 5px 0px 0px;text-align:center;">
			<?php if ($foto_perfil == "") { ?>
				<img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100" />
			<?php } else { ?>
				<img src="../../adm_clientes/img_perfil/<?php echo $foto_perfil; ?>"  class="img-circle" alt="Sua Imagem" width="100" />
			<?php } ?>
			<br>
			<b><a href="../../adm_clientes/completo.php?perfil=<?php echo $id; ?>" title="Veja o Perfil" target="_blank"><?php echo $nome; ?></a></b>
			<br>
			<b>T&oacute;picos: </b> <?php echo $total2; ?>
			<br>
			<b>Respostas:	</b> <?php echo $total3; ?>
			<br>
			<a href="../../talkfusion/<?php echo $id; ?>" title="Cadastre-se na ComunidadeMultiN&iacute;vel, atrav&eacute;s de minha indica&ccedil;&atilde;o" target="_blank">Cadastre-se por Minha Indica&ccedil;&atilde;o</a>
			</div>
			<div  style="float:right; width:80%; ">
			<?php echo $texto_resposta; 
			
			?> 
			
			<hr>
			<?php 
			$sql = $con->prepare("SELECT * FROM $tabela14 WHERE ID_RESPOSTA = '$id_resposta' ORDER BY ID DESC LIMIT 1");
			$sql->execute();
			$res = $sql->fetchAll(PDO::FETCH_OBJ); 
			$total_edit = count( $res );
			
			 
			if ($total_edit >= 1) {
				foreach($res as $ln_edit) { 
					$ultimo_editid_cliente = $ln_edit->ID_CLIENTE;
					$ultimo_editdata = $ln_edit->DATA_EDITADO; 
					$ultimo_editdata = implode("/",array_reverse(explode("-",$ultimo_editdata)));
					
					$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ultimo_editid_cliente'");
					$sql->execute();
					$res = $sql->fetchAll(PDO::FETCH_OBJ);
					foreach($res as $ln_edit) { 
						$id_cliente_editou = $ln_edit->ID;
						$nome_cliente_editou = $ln_edit->NOME;
					}
			?>
				<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-warning"></i>
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					<b>Esse T&oacute;pico foi editado pela &uacute;tima vez por <?php echo $nome_cliente_editou; ?> dia <?php echo $ultimo_editdata; ?>.</b> 
				</div>
			<?php } } ?>
			
			</div>
			
			<br style="clear:both;"> <br>
		 
		</div><!-- /.box-body -->	
	</div><!-- /.box -->
	 
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
<?php	
	}	

		
?>	
 	
					<div class='row'>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>RESPONDER AGORA <small> \O/ </small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
									<div style="width:81%; float:right;">
                                    <form id="form_res" name="form_res" method="post" action="respondendo_topico.php">
                                        <textarea id="editor1" name="editor1" ></textarea>
										<br> 
										<INPUT TYPE="hidden" NAME="id_cliente_respondendo" VALUE="<?php echo $id_cliente; ?>">
										<INPUT TYPE="hidden" NAME="id_topico" VALUE="<?php echo $id_topico; ?>">
										<INPUT TYPE="hidden" NAME="id_cliente_criador" VALUE="<?php echo $id_cliente_topico; ?>">
										<INPUT TYPE="hidden" NAME="categoria" VALUE="<?php echo $categoria_topico; ?>">  
										<INPUT TYPE="hidden" NAME="url" VALUE="<?php echo $url; ?>">
										<button type="submit" Onclick="return verifica()" style="float:right;" class="btn btn-warning btn-lg" title="Clique aqui para ver Enviar sua resposta">Enviar Resposta </button> 
                                    </form>
									</div>
									    <br style="clear:both;"> <br> 
                                </div>
                            </div><!-- /.box --> 
                        </div><!-- /.col-->
                    </div><!-- ./row -->
		 
    <br style="clear:both;"> <br> 
<?php } ?>
 
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
	
	
	
</div><!-- /.col -->  	 
<?php	 
	}
?>
</div>
 

       <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>      
        <!-- CK Editor -->
        <script src="../../adm_clientes/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../adm_clientes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace('editor1');
                //bootstrap WYSIHTML5 - text editor
                $(".textarea").wysihtml5();
            });
        </script>
		
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
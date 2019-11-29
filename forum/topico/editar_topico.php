<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE); 
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}

$id_cliente_edit = $_POST["id_cliente_criador"];
$id_topico_edit = $_POST["id_topico"]; 
$url_edit = $_POST["url"]; 




	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln) { 
			$cliente_moderador = $ln->MODERADORES;
		} 



try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela10 WHERE ID = $id_topico_edit");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln) { 
			$id_topico = $ln->ID;
			$id_cliente_topico =  $ln->ID_CLIENTE;
			$categoria_topico =  $ln->CATEGORIA;
			$topic_dica =  $ln->DICA; 
			$titulo_topico =  $ln->TITULO_TOPICO; 
			$texto_topico =    html_entity_decode((string)$ln->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
			$tags_topico =  $ln->TAGS_TOPICO;
			$contador_topico =  $ln->CONTADOR;
			$data = $ln->DATA_TOPICO;
			$data = implode("/",array_reverse(explode("-",$data))); 
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
if ($id_cliente != $id_cliente_topico) {
	echo("<script type='text/javascript'> alert('Voc\u00ea n\u00e3o tem permiss\u00e3o para editar esse t\u00f3pico'); location.href='$url_edit';</script>");
	 
	exit;
}
	 
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | TRAFFICMONSOON | TALK FUSION | F&OacuteRUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, tutoriais, como funciona, ganhar dinheiro na internet, MMN, talkfusion, trafficmonsoon, como funciona trafficmonsoon, trafficmonsoon como funciona, TALK FUSION como funciona"/>
		<meta name="robots" content="all">
		<Meta Name="Description" Content="ComunidadeMultiN&iacute;vel, a melhores estrat&eacute;gias de trabalho inteligentemente elaboradas para o alavancamento e crescimento do rendimento de toda nossa equipe. SEU SUCESSO EST&Aacute: EM NOSSA UNI&Atilde;O !!!">
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
                        <small>Editando seu T&oacute;pico, tira suas d&uacute;vidas, compartilhe seu conhecimento com outros internaltas.</small>
                    </h1>
                    <ol class="breadcrumb">  
						<li><i class="fa fa-question"></i> <a href="../index.php" title="Retornar aos F&Oacute;RUNS">FORUM </a> </li>
                        <li class="active">
						<?php
							if ($categoria_topico == "COMUNIDADE") { ?>
									<li class="active"> <a href="../comunidade_tutoriais.php" title="Retornar aos F&Oacute;RUM ComunidadeMultiN&iacute;vel / Tutoriais e D&uacute;vidas"> ComunidadeMultiN&iacute;vel / Tutoriais e D&uacute;vidas </a></li>	
						<?php		 
							} else if ($categoria_topico == "TALKFUSION") { ?>
									<li class="active"> <a href="../talk_fusion_tutoriais.php" title="Retornar aos F&Oacute;RUM TALK FUSION / Tutoriais e D&uacute;vidas"> TALK FUSION / Tutoriais e D&uacute;vidas </a></li>	
						<?php		 
							} else if ($categoria_topico == "TRAFFICMONSOON") { ?>
									<li class="active"> <a href="../talk_fusion_tutoriais.php" title="Retornar aos F&Oacute;RUM TRAFFIC MONSOON / Tutoriais e D&uacute;vidas"> TRAFFIC MONSOON / Tutoriais e D&uacute;vidas </a></li>	
						<?php		 
							} 
						?>  
						 </li>
                    </ol>
                </section>
 
            </aside><!-- /.right-side -->
<div class="col-md-16">
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
<div class='row'>

<script>
function verifica() { 
	if (form_res.titulo.value == "") { 
		alert("O T\u00edtulo do T\u00f3pico \xE9 obrigat\xF3rio"); 
		return false;   
    }   
}
</script>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Editar T&Oacute;PICO <small> \O/ </small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
									<form id="form_res" name="form_res" method="post" action="editando_topico.php">
										<div style="width:35%; float:left;"> 
										 <br> <br>
											<b>T&iacute;tulo do T&oacute;pico *</b>
											<div class="input-group"> 
												<input type="text" name="titulo" class="form-control" value="<?php echo $titulo_topico; ?>"> <span class="input-group-addon"><i class="fa fa-check"></i></span>
											</div>	
											<b>TAGs do T&oacute;pico</b>
											<div class="input-group"> 
												<input type="text" name="tags"  class="form-control" value="<?php echo $tags_topico; ?>"> <span class="input-group-addon"><i class="fa fa-check"></i></span>
											</div>
											<i style="color:red;font-size:14px ;">O que s&atilde;o TAGs ? s&atilde;o palavras ou pequenas frazes relacionadas ao seu t&oacute;pico</i> <br>
											<b> Aten&ccedil;&atilde;o</b><i style="color:red;font-size:14px ;"> preencha no m&aacute;ximo 10 tags e separe-as por virgulas <br>
											exemplo( tag1, essa &eacute; a tag2, tag3)</i>
											
											<?php if ($cliente_moderador == "SIM") { ?>
											<br><br>
											<b>Esse T&oacute;pico &eacute; uma DICA? *</b>
											<select class="form-control" name="topic_dica">
												<option value="<?php echo $topic_dica; ?>" selected><?php echo $topic_dica; ?></option>
                                                <option value="NAO">N&Atilde;O</option>
                                                <option value="SIM">SIM</option> 
                                            </select>
											<?php } else { ?>
												<INPUT TYPE="hidden" NAME="topic_dica" VALUE="<?php echo $topic_dica; ?>"> 
											<?php } ?>
											
										</div>
										<div style="width:60%; float:right;"> 
											<textarea id="editor1" name="editor1" ><?php echo $texto_topico; ?></textarea>
											<br> 
											<INPUT TYPE="hidden" NAME="id_cliente_edit" VALUE="<?php echo $id_cliente_edit; ?>">
											<INPUT TYPE="hidden" NAME="id_topico_edit" VALUE="<?php echo $id_topico_edit; ?>">
											<INPUT TYPE="hidden" NAME="url_edit" VALUE="<?php echo  $url_edit; ?>">	
											<button type="submit" Onclick="return verifica()"  style="float:right;" class="btn btn-warning btn-lg" title="Clique aqui para editar o t&oacute;pico">EDITAR T&Oacute;PICO </button> 
										</div>
									</form>
									    <br style="clear:both;"> <br> 
                                </div>
                            </div><!-- /.box --> 
                        </div><!-- /.col-->
                    </div><!-- ./row -->		
		  
		  
		  
		  
		<div class="col-md-16">
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
		


		
        </div><!-- ./wrapper -->
 
 
 

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
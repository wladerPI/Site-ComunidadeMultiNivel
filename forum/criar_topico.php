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
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
		$talk_simulador = $ln_verifc->TALK_SIMULADOR; 
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL;
		$cliente_moderador = $ln_verifc->MODERADORES;
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
        <title>Criando T&oacute;pico no f&oacute;rum da Comunidade MutiN&iacute;vel | F&OacuteRUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, TrafficMonsoon, tutoriais, como funciona, ganhar dinheiro na internet, MMN, piramide financeira, sites PTC, empresas de MMN, empresas pct, melhores empresas ptc, melhores sites ptc, melhores sistemas ptc"/>
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
                        <small>Criar um T&oacute;pico, tira suas d&uacute;vidas, compartilhe seu conhecimento com outros internaltas.</small>
                    </h1>
                    <ol class="breadcrumb">  
						<li><i class="fa fa-question"></i> <a href="index.php" title="Retornar aos F&Oacute;RUNS">FORUM </a> </li>
                        <li class="active">
						<?php 
						if ($_POST["categoria"] == "COMUNIDADE") {
								echo "Criando T&oacute;pico no F&Oacute;RUM ComunidadeMultiN&iacute;vel / Tutoriais e D&uacute;vidas";
							 
						} else if ($_POST["categoria"] == "TALKFUSION") {
							echo "Criando T&oacute;pico no F&Oacute;RUM Talk Fusion / Tutoriais e D&uacute;vidas"; 
						} else if ($_POST["categoria"] == "TRAFFICMONSOON") {
							echo "Criando T&oacute;pico no F&Oacute;RUM Traffic Monsoon / Tutoriais e D&uacute;vidas"; 
						} 
						?> 
						 </li>
                    </ol>
                </section>
 
            </aside><!-- /.right-side -->
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
<div class='row'>

<script>
function verifica() { 
	if (form_res.titulo.value == "") { 
		alert("O Titulo do Topico \xE9 obrigat\xF3rio"); 
		return false;   
    }   
}
</script>
                        <div class='col-md-12'>
                            <div class='box box-info'>
                                <div class='box-header'>
                                    <h3 class='box-title'>Criar T&Oacute;PICO <small> \O/ </small></h3>
                                    <!-- tools box -->
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-info btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    </div><!-- /. tools -->
                                </div><!-- /.box-header -->
                                <div class='box-body pad'>
									<form id="form_res" name="form_res" method="post" action="criando_topico.php">
										<div style="width:35%; float:left;"> 
										 <br> <br>
											<b>Titulo do T&oacute;pico *</b>
											<div class="input-group"> 
												<input type="text" name="titulo" class="form-control"> <span class="input-group-addon"><i class="fa fa-check"></i></span>
											</div>	
											<b>TAGs do T&oacute;pico</b>
											<div class="input-group"> 
												<input type="text" name="tags"  class="form-control"> <span class="input-group-addon"><i class="fa fa-check"></i></span>
											</div>
											<i style="color:red;font-size:14px ;">O que s&atilde;o TAGs ? s&atilde;o palavras ou pequenas frazes relacionadas ao seu t&oacute;pico</i> <br>
											<b> Aten&ccedil;&atilde;o</b><i style="color:red;font-size:14px ;"> preencha no m&aacute;ximo 10 tags e separe-as por virgulas <br>
											exemplo( tag1, essa &eacute; a tag2, tag3)</i>
											
											<?php if ($cliente_moderador == "SIM") { ?>
											<br><br>
											<b>Esse T&oacute;pico &eacute; uma DICA? *</b>
											<select class="form-control" name="topic_dica">
                                                <option value="NAO">N&Atilde;O</option>
                                                <option value="SIM">SIM</option> 
                                            </select>
											<?php } else { ?>
												<INPUT TYPE="hidden" NAME="topic_dica" VALUE="NAO"> 
											<?php } ?>
											
										</div>
										<div style="width:60%; float:right;"> 
											<textarea id="editor1" name="editor1" ></textarea>
											<br> 
											<INPUT TYPE="hidden" NAME="id_cliente_criador" VALUE="<?php echo $id_cliente; ?>">  
											<INPUT TYPE="hidden" NAME="categoria" VALUE="<?php echo $_POST["categoria"]; ?>"> 
											<button type="submit" Onclick="return verifica()"  style="float:right;" class="btn btn-warning btn-lg" title="Clique aqui para criar o t&oacute;pico">CRIAR T&Oacute;PICO </button> 
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
        <script src="../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>      
        <!-- CK Editor -->
        <script src="../adm_clientes/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../adm_clientes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
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
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



	$perfil = $_GET['perfil'];
 
	if (!isset($perfil)) {
		$perfil = 0;
	}

 
	

try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$perfil'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$total_clientes = count( $res_verifc );
	foreach($res_verifc as $ln_verifc) {
		 $perfil_nome = $ln_verifc->NOME;
		 $perfil_foto = $ln_verifc->FOTO_PERFIL;
		 $perfil_tel = $ln_verifc->TELEFONE;
		 $perfil_cel = $ln_verifc->CELULAR;
		 $perfil_skype = $ln_verifc->SKYPE;
		 $perfil_face = $ln_verifc->FACEBOOK;
		 $perfil_email = $ln_verifc->EMAIL;
		$perfil_acesso = $ln_verifc->ULTIMOACESSO;
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
}   

// se cliente existe 
if ($total_clientes <= 0) {
	echo("<script type='text/javascript'> alert('Esse Clientes N\u00e3o Existe no sistema !!!'); location.href='index.php';</script>");
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
                        <li class="active">Perfil do(a) <b><?php echo $perfil_nome; ?></b></li>
                    </ol>
                </section>
 	
                <!-- Main content -->
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


<div id="capa">
	<div id="perfil_capa">
		<?php if ($perfil_capa == "") { ?>
		<img src="img_capa/sem_foto.jpg"   alt="Sua Imagem" height="200" width="auto" />
		<?php } else { ?>
			<img src="img_perfil/<?php echo $perfil_foto; ?>" width="auto" height="200"   alt="Sua Imagem" style="width:auto;" />
		<?php } ?>
	</div>
	
	
	<h1><?php echo $perfil_nome; ?></h1>
	
	<div class="user-panel" style="position:absolute;top:30px;left:20px;">
		<div class="pull-left image" >
			<?php if ($perfil_foto == "") { ?>
				<img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="100"/>
			<?php } else { ?>
				<img src="img_perfil/<?php echo $perfil_foto; ?>" style="border:3px solid #000;" width="100" class="img-circle" alt="Sua Imagem" />
			<?php } ?>
		</div>
	</div>
	
</div>
<div class="box box-primary">
<?php
// QUANTIDADE DE PESSOAS NA REDE 

$afiliado = "";

try {	
	// busca nivel 1
	$sql4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id."'"); 
	$sql4->execute();
	$res4 = $sql4->fetchAll(PDO::FETCH_OBJ);  
	 
	// busca nivel 2
	foreach($res4 as $ln4) {
		
		if ($perfil == $ln4->ID) {
			$afiliado = "SIM";
			$nivel = "1";
			$indicado_por = "Voc&ecirc;";
		}
	
		$sql5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln4->ID."'"); 
		$sql5->execute();
		$res5 = $sql5->fetchAll(PDO::FETCH_OBJ);  
		   
		// busca nivel 3
		foreach($res5 as $ln5) {
			$sql6 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln5->ID."'"); 
			$sql6->execute();
			$res6 = $sql6->fetchAll(PDO::FETCH_OBJ);  
 			  
			if ($perfil == $ln5->ID) {
				$afiliado = "SIM";
				$nivel = "2";
				$indicado_por = $ln5->ID_INDICACAO;
				
			}
			
			// busca nivel 4
			foreach($res6 as $ln6) {
				$sql7 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln6->ID."'"); 
				$sql7->execute();
				$res7 = $sql7->fetchAll(PDO::FETCH_OBJ);  
				  
				 
				if ($perfil == $ln6->ID) {
					$afiliado = "SIM";
					$nivel = "3";
					$indicado_por = $ln6->ID_INDICACAO;
				}

				// busca nivel 5
				foreach($res7 as $ln7) {
					$sql8 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln7->ID."'"); 
					$sql8->execute();
					$res8 = $sql8->fetchAll(PDO::FETCH_OBJ);  
					  
					if ($perfil == $ln7->ID) {
						$afiliado = "SIM";
						$nivel = "4";
						$indicado_por = $ln7->ID_INDICACAO;
					}
					foreach($res8 as $ln8) {
						if ($perfil == $ln8->ID) {
							$afiliado = "SIM";
							$nivel = "5";
							$indicado_por = $ln8->ID_INDICACAO;
						}
					}
				}
			}
		}
	}   
} catch(PODException $e4) {
	echo "Erro:/n".$e4->getMessage();
} 
	
	if ($indicado_por == "Voc&ecirc;") {
		$indicado_por = "Voc&ecirc;";
	} else {
		$sql4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '".$indicado_por."'"); 
		$sql4->execute();
		$res4 = $sql4->fetchAll(PDO::FETCH_OBJ);  
		 
		// busca nivel 2
		foreach($res4 as $ln4) {
			$indicado_por = $ln4->NOME;
		}
	}
if ($afiliado == "SIM" || $id_cliente == "$perfil") { ?>
<div class="callout callout-info">
	<h2>Dados de Contato do(a) <b><?php echo $perfil_nome; ?></b></h2> 
	<b>Telefone: </b> <?php echo $perfil_tel; ?><br>
	<b>Celular: </b> <?php echo $perfil_cel; ?><br>
	<b>Skype: </b> <?php echo $perfil_skype; ?><br>
	<b>Facebook: </b> <?php echo $perfil_face; ?><br>
	<b>E-mail: </b> <?php echo $perfil_email; ?><br>
	<hr>
	<b>indicado Por: </b> <?php echo $indicado_por; ?><br>
	<b>N&iacute;vel: </b> <?php echo $nivel; ?><br>
	<b>&Uacute;ltimo Acesso no Sistema: </b> <?php echo $perfil_acesso; ?><br>
</div>
<?php } else { ?>
<div class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i> 
	<h1>Aguardem: est&aacute; p&aacute;gina esta em MANUTEN&Ccedil;&Atilde;O, TEMOS GRANDES PLANOS PARA ESSA &Aacute;REA.</h1>
</div>  

<?php } ?>



</div>                      

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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
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
		<!--  meu css  -->
		<link href="css/estilo.css" rel="stylesheet" type="text/css" />
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
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
                        <li class="active">F&Oacute;RUM / Respostas Enviadas</li>
                    </ol>
                </section>
<?php	
// TOTAL DE TOPICOS				
try {
	$sql2 = $con->prepare("SELECT * FROM $tabela10 WHERE ID_CLIENTE = '$id_cliente'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	$total_topic = count( $res2 );
	  
} catch(PODException $e2) {
	echo "Erro:/n".$e2->getMessage();
} 

// TOTAL DE RESPOSTAS
try {	
	$sql3 = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$id_cliente'"); 
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);  
	$total_res = count( $res3 );  
	 
} catch(PODException $e3) {
	echo "Erro:/n".$e3->getMessage();
}  
 
 
// TOTAL DE topicos geral
try {	
	$sql3 = $con->prepare("SELECT * FROM $tabela10"); 
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);  
	$total_topic_geral = count( $res3 );  
	 
} catch(PODException $e3) {
	echo "Erro:/n".$e3->getMessage();
}
 
// TOTAL DE respostas geral
try {	
	$sql3 = $con->prepare("SELECT * FROM $tabela11"); 
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);  
	$total_res_geral = count( $res3 );  
	 
} catch(PODException $e3) {
	echo "Erro:/n".$e3->getMessage();
}
?>			
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

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_topic; ?>
                                    </h3>
                                    <p>
                                        Meus T&oacute;picos Criados
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <a href="topicos_criados.php" class="small-box-footer" title="Veja Seus T&oacute;picos Criados">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $total_res; ?>
                                    </h3>
                                    <p>
                                        Minhas Respostas Enviadas
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-comments"></i>
                                </div>
                                <a href="resposta_enviadas.php" class="small-box-footer" title="Veja Suas Resposta Enviadas">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total_topic_geral; ?>
                                    </h3>
                                    <p>
                                        Total de T&oacute;picos no F&oacute;rum
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-edit"></i>
                                </div>
                                <br> <br>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total_res_geral; ?>
                                    </h3>
                                    <p>
                                        Total de Respostas no F&oacute;rum
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa  fa-comments"></i>
                                </div>
                                <br> <br>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
<div class="box box-primary">
<!-- centro -->	
<?php
######### INICIO Paginação
	$numreg = 15; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	$sql = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$id_cliente' ORDER BY ID DESC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela11 WHERE ID_CLIENTE = '$id_cliente'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta );  
	  
if ($quantreg <= 0)	{
	echo "<i  >Voc&ecirc; ainda n&atilde;o respondeu nenhum t&oacute;pico do f&oacute;rum.</i> <br>";
} else {
?>	
 
		<i>Lista por ordem de ultimas respostas enviadas.</i> <br>
<?php
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >> 
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	foreach($sql_verifc as $ln_verifc) {
		
		$id_topic  = $ln_verifc->ID_TOPICO;
		$categoria = $ln_verifc->CATEGORIA;  
		$texto =    html_entity_decode((string)$ln_verifc->TEXTO_TOPICO, ENT_QUOTES, 'utf-8'); 
		$data  = $ln_verifc->DATA_TOPICO;
		$data  = implode("/",array_reverse(explode("-",$data)));
		
		$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$id_topic'");
		$sql->execute();
		$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($sql_verifc as $ln_verifc) {
			$id  = $ln_verifc->ID; 
			$titulo = $ln_verifc->TITULO_TOPICO;  
			$contador = $ln_verifc->CONTADOR;
		}
		
?>	
<div class="col-md-16">
	<div class="box box-solid box-primary">  
		<div class="box-header">
			<?php
				$str = $titulo;
				include_once "../forum/funcao_url.php";
			?>				 
				<h3 class="box-title"><a style="color:#FFF;" href="../forum/topico/<?php echo $id."-".RemoveAcentos($str); ?>" title="Veja o T&Oacute;PICO" ><?php echo $titulo; ?></a></h3>
			<div class="box-tools pull-right">
				<button class="btn btn-primary btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button> 
			</div>
        </div>
		<div class="box-body">  
			<div style="float:left; width:19%; border:1px solid #CCC; margin:0px 5px 0px 0px;text-align:center;">
				<?php if ($categoria == "COMUNIDADE") { ?>
					<b> ComunidadeMultiN&iacute;vel </b> <br> <b> Tutoriais </b> <br>	 
				<?php  } else  if ($categoria == "TALKFUSION") { ?>
					<b> TALK FUSION </b> <br> <b> Tutoriais </b> <br>   
				<?php } else if ($categoria == "BLOG") { ?>
					<b> BLOG </b> <br>    
				<?php }  ?> 
				<i style="color:red;"><?php echo $contador; ?> </i> <b>Visualiza&ccedil;&atilde;o</b> <br>
				<i style="color:red;"><?php echo $data; ?> </i>  
			</div>
			<div  style="float:right; width:80%; ">
			<?php echo $texto; ?>
			</div> 
		</div><!-- /.box-body -->
		
		<br style="clear:both;"> <br>
    </div><!-- /.box -->
	
</div> 

	<?php } ?>		
	<?php	include("paginacao.php");  ?>	 
<?php } ?>	
 
</div>                                    
 

<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side --> 
</div><!-- ./wrapper --> 
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
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
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
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
                        <li class="active">Melhores L&iacute;deres</li>
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


<BR>
<!-- BANNER --> 		
<div class="col-md-12">
	<div class="box box-solid">
	
		<!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
									<li><a href="#3" data-toggle="tab">De Todos os Tempos</a></li>
                                    <li><a href="#2" data-toggle="tab">Do ANO</a></li>
									<li><a href="#1" data-toggle="tab">Do M&ecirc;s</a></li>									
                                    <li class="pull-left header"><i class="fa fa-inbox"></i> Melhores L&iacute;deres (TALK FUSION)</li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales --> 
                                    <div class="tab-pane active" id="1"  >

									
									
									
									
									
<div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Minhas Posi&ccedil;&otilde;es</th>
                                                <th>Total de Indica&ccedil;&otilde;es Esse M&ecirc;s</th>
                                                <th>Total de Indica&ccedil;&otilde;es Geral</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </thead>
										
<?php
//######### INICIO Paginação
	$numreg = 1000; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	 
	$mes = date("n"); 
	$ano = date("Y");
	/*
	SELECT count(*) as total, ID_CLIENTE FROM $tabela11 GROUP BY ID_CLIENTE ORDER BY total DESC, ID_CLIENTE ASC LIMIT 5
	STATUS = 'ATIVO' AND MONTH(DATA_CADASTRO) = MONTH(CURDATE()) AND YEAR(DATA_CADASTRO) = YEAR(CURDATE()) 
	ORDER BY DATA_CADASTRO ASC 
	LIMIT $inicial, $numreg 
	*/
	
	$sql = $con->prepare("
	SELECT * FROM $tabela7,$tabela3
	WHERE $tabela7.ID_CLIENTE = $tabela3.ID  AND $tabela7.STATUS = 'ATIVO' AND MONTH($tabela7.DATA_CADASTRO) = MONTH(CURDATE()) AND YEAR($tabela7.DATA_CADASTRO) = YEAR(CURDATE()) 
	ORDER BY $tabela3.ID_INDICACAO ASC
	");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela7 WHERE STATUS = 'ATIVO' AND MONTH(DATA_CADASTRO) = MONTH(CURDATE()) AND YEAR(DATA_CADASTRO) = YEAR(CURDATE())");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	
	if ($quantreg <= 0)  {
		echo "<b style='color:red;'> At&eacute; o momento ninguem fez indica&ccedil;&otilde;es esse M&Ecirc;S </b> <br><br>";
		
	} else { 
	foreach($sql_verifc as $ln_td) {
		 echo $ln_td->ID_CLIENTE;
		 
		 
		// TOTAL DE DIRETOS esse mes
		$sql_td3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = ".$ln_td->ID_CLIENTE."");
		$sql_td3->execute();
		$res_td3 = $sql_td3->fetchAll(PDO::FETCH_OBJ); 
		$total_td3 = count( $res_td3 ); 
			
		 
		
		// EXPLODE DATA
		$data = $ln_td->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
?>	
	<tbody>
		<?php if ($ln_td->ID == $id) { ?>
		<tr>  
			<td> 
				<?php if ($ln_td->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln_td->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln_td->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td->NOME; ?>"><img src="img_perfil/<?php echo $ln_td->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><b class="eunorank"><?php echo $ln_td->NOME; ?></b></td>
            <td><b class="eunorank"><?php echo $rankafiliado; ?> &deg;</b></td>
            <td><b class="eunorank"><?php echo $ln_td->PONTOS; ?></b></td>
            <td><b class="eunorank"><?php echo $total_td3; ?></b></td>
            <td><b class="eunorank"><?php echo $data; ?></b></td> 
        </tr> 
		<?php } else { ?> 
		<tr>
			<td> 
				<?php if ($ln_td->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln_td->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln_td->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td->NOME; ?>"><img src="img_perfil/<?php echo $ln_td->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><?php echo $ln_td->NOME; ?></td>
            <td><?php echo $rankafiliado; ?> &deg;</td>
            <td><?php echo $ln_td->PONTOS; ?></td>
            <td><?php echo $total_td3; ?></td>
            <td><?php echo $data; ?></td>
        </tr>  
		<?php } ?>
			
    </tbody>
	
		
<?php		
	} 
 }
?>										 
                                        <tfoot>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Total de Diretos</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </tfoot>
                                    </table>
<br>
<?php	include("paginacao.php");  ?>
                                </div><!-- /.box-body -->									
									
									
									
									
									
									
									
									
									
									
									
									
									
									
									</div>
									<div class="tab-pane" id="2"  >
									2
									</div>
									<div class="tab-pane" id="3"  >
									3
									</div>
                                </div>
                            </div><!-- /.nav-tabs-custom --> 
</div><!-- /.box -->
				
	 	
<!-- centro -->
 


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
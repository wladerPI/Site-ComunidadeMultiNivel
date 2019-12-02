<?php
session_start(); 
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
		$talk = $ln_verifc->TALK_FUSION;
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
} 

// somente clientes do projeto TALK FUSION acessa aq
if ($talk == "NAO") {
	echo("<script type='text/javascript'> alert('Para ter acesso nessa p\u00e1gina, voc\u00ea precisa estar participando do projeto TALK FUSION da COMUNIDADE MULTIN\u00cdVEL !!!'); location.href='index.php';</script>");
	exit;
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
                        <li class="active">SIMULADOR</li>
                    </ol>
                </section>
<?php	
// total de pessoas no projeto
try {
	$sql_total = $con->prepare("SELECT * FROM $tabela3 WHERE TALK_FUSION = 'SIM'");
	$sql_total->execute();
	$res_total = $sql_total->fetchAll(PDO::FETCH_OBJ);
	$total_pess = count( $res_total );
	
} catch(PODException $e_total) {
	echo "Erro:/n".$e_total->getMessage();
} 

// total de pacotes
try {
	$sql_pact = $con->prepare("SELECT * FROM $tabela4");
	$sql_pact->execute();
	$res_pact = $sql_pact->fetchAll(PDO::FETCH_OBJ);
	$total_pact = count( $res_pact );
	
} catch(PODException $e_pact) {
	echo "Erro:/n".$e_pact->getMessage();
} 
// TOTAL DE PONTUACAO				
try {
	$sql2 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	$i = 1;
	foreach($res2 as $ln2) {
		if ($ln2->ID == $id) { 
			$seurank = $i;
		}
		$i++;
	} 
} catch(PODException $e2) {
	echo "Erro:/n".$e2->getMessage();
} 

// TOTAL DE INDICADOS DIRETOS
try {	
	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id."'"); 
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);  
	$total3 = count( $res3 );  
	 
} catch(PODException $e3) {
	echo "Erro:/n".$e3->getMessage();
}  

// QUANTIDADE DE PESSOAS NA REDE 

try {	
	// busca nivel 1
	$sql4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id."'"); 
	$sql4->execute();
	$res4 = $sql4->fetchAll(PDO::FETCH_OBJ);  
	$total_1 = count( $res4 );
	 
	
	$total_nivel_2 = 0;
	$total_nivel_3 = 0;
	$total_nivel_4 = 0;
	$total_nivel_5 = 0;
	// busca nivel 2
	foreach($res4 as $ln4) { 
		$sql5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln4->ID."'"); 
		$sql5->execute();
		$res5 = $sql5->fetchAll(PDO::FETCH_OBJ);  
		$total_2 = count( $res5 );
		 
		if ($total_2 > 0) {
			$total_nivel_2 += $total_2; 
		} 
		
		// busca nivel 3
		foreach($res5 as $ln5) {
			$sql6 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln5->ID."'"); 
			$sql6->execute();
			$res6 = $sql6->fetchAll(PDO::FETCH_OBJ);  
			$total_3 = count( $res6 );  
			  
			if ($total_3 > 0) {
				$total_nivel_3 += $total_3; 
			} 
			
			// busca nivel 4
			foreach($res6 as $ln6) {
				$sql7 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln6->ID."'"); 
				$sql7->execute();
				$res7 = $sql7->fetchAll(PDO::FETCH_OBJ);  
				$total_4 = count( $res7 ); 
				 
				if ($total_4 > 0) { 
					$total_nivel_4 += $total_4; 
				}

				// busca nivel 5
				foreach($res7 as $ln7) {
					$sql8 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln7->ID."'"); 
					$sql8->execute();
					$res8 = $sql8->fetchAll(PDO::FETCH_OBJ);  
					$total_5 = count( $res8 );  
					 
					if ($total_5 > 0) {
						$total_nivel_5 += $total_5; 
					} 
				}
			}
		}
	} 
	$valor_total_niveis = $total_1+$total_nivel_2+$total_nivel_3+$total_nivel_4+$total_nivel_5;  
} catch(PODException $e4) {
	echo "Erro:/n".$e4->getMessage();
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
                    <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
									<h3> 
                                        <?php echo $total_pact; ?> 
                                    </h3>
                                    <p>
                                         Total de Pacotes Registrados.
                                    </p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div> 
								<br><br>
                            </div>
                        </div><!-- ./col -->
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total_pess; ?> 
                                    </h3>
                                    <p>
                                         Total de Pessoas no Projeto
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div> 
								<br><br>
                            </div>
                        </div><!-- ./col --> 
						<div class="col-md-4">	
                            <!-- Default box -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Seu LINK de INDICA&Ccedil;&Atilde;O</h3>
                                    <div class="box-tools pull-right">
                                        <button class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                    LINK: <a href="../talkfusion/<?php echo $id; ?>" title="Acesse seu link de indica&ccedil;&atilde;o" target="_blank">www.comunidademultinivel.com.br/talkfusion/<?php echo $id; ?></a>
                                    <p>
                                        Para que voc&ecirc; possa cadastrar no sistema uma pessoa diretamente de sua indica&ccedil;&atilde;o, a pessoa ter&aacute; que se cadastrar atrav&eacute;s do seu link de indica&ccedil;&atilde;o, ap&oacute;s o cadastro, automaticamente sua pontua&ccedil;&atilde;o ser&aacute; atualizada.
                                    </p>
                                </div><!-- /.box-body --> 
                            </div><!-- /.box -->
                        </div><!-- /.col -->	
<!-- centro -->		
<div id="manutencao"><img src="img/manutencao.jpg" alt="P&aacute;gina em Manuten&ccedil;&atilde;o" /></div>
 
 
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
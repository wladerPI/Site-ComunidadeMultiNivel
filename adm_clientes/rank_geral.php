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
                        <li class="active">RANK GERAL</li>
                    </ol>
                </section>
<?php	
// TOTAL DE PONTUACAO				
try {
	$sql2 = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
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
<br>
<div class="callout callout-warning"> 
		<h3>RANK Geral de Pontua&ccedil;&atilde;o</h3>
		<p>Essa Pontua&ccedil&atilde;o serve para voc&ecirc; investir em umas das temporadas da <b>Rede do SIMULADOR</b>, fazendo com que voc&ecirc; possa usar seus pontos estrat&eacute;gicamente, podendo acumular suas pontua&ccedil&otilde;es de uma temproada para outra e investir tudo seus pontos na temporada que desejar, para que voc&ecirc; entre em nossa REDE PRINCIPAL dentro da empresa TALK FUSION no topo de uma rede.</p>
	 <br> 
</div>  
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $pontos; ?>
                                    </h3>
                                    <p>
                                        Sua Pontua&ccedil;&atilde;o Geral
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-angle-double-up"></i>
                                </div>
                                <a href="rank_geral.php" class="small-box-footer" title="Veja sua Pontua&ccedil;&atilde;o">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-green">
                                <div class="inner">
                                    <h3>
                                        <?php echo $seurank; ?>&deg;
                                    </h3>
                                    <p>
                                        Sua posi&ccedil;&atilde;o no RANK Geral
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="rank_geral.php" class="small-box-footer" title="Seu Posicionamento no RANK em Geral">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total3; ?>
                                    </h3>
                                    <p>
                                        Indicados Diretos
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-users"></i>
                                </div>
                                <a href="indicados_diretos.php" class="small-box-footer" title="Suas indica&ccedil;&otilde;es diretas">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-red">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $valor_total_niveis; ?>
                                    </h3>
                                    <p>
                                        Total em seus 5 N&iacute;veis
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-sitemap"></i>
                                </div>
                                <a href="rank_afiliados.php" class="small-box-footer" title="Resumo de toda sua rede, nos 5 n&iacute;veis de profundidade">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
                    </div><!-- /.row -->
<!-- centro -->		
<?php
// TOTAL DE SEUS DIRETOS
try {
	$sql_td = $con->prepare("SELECT * FROM $tabela3 ");
	$sql_td->execute();
	$res_td = $sql_td->fetchAll(PDO::FETCH_OBJ);
	$total_td  = count( $res_td );
?>
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">LISTA DO RANK EM GERAL, UM TOTAL de <B><?php echo $total_td; ?></B> PESSOAS CADASTRADAS NO PROJETO SIMULADOR NA EMPRESA TALK FUSION</h3>
    </div><!-- /.box-header -->
	<section class="content">
                    <div class="row"> 
                        <div class="col-xs-12"> 
							<i>Ordem de Pontua&ccedil;&atilde;o</i>
                            <div class="box"> 
                                <div class="box-body table-responsive">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Total de Diretos</th>
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
	  
	$sql = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC, ID ASC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela3");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	

	foreach($sql_verifc as $ln_td) {
		// POSICIONAMENTO DOS SEUS DIRETOS NO RANK 
		try {
			$sql_td2 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC, ID ASC");
			$sql_td2->execute();
			$res_td2 = $sql_td2->fetchAll(PDO::FETCH_OBJ);
			$i = 1;
			foreach($res_td2 as $ln_td2) {
				if ($ln_td2->ID == $ln_td->ID) { 
					$rankafiliado = $i;
				}
				$i++;
			} 
		} catch(PODException $e2) {
			echo "Erro:/n".$e2->getMessage();
		} 
		
		// TOTAL DE DIRETOS DOS SEUS DIRETOS
		try {
			$sql_td3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln_td->ID."");
			$sql_td3->execute();
			$res_td3 = $sql_td3->fetchAll(PDO::FETCH_OBJ); 
			$total_td3 = count( $res_td3 );
			
		} catch(PODException $e2) {
			echo "Erro:/n".$e2->getMessage();
		} 
		
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
} catch(PODException $e2) {
	echo "Erro:/n".$e2->getMessage();
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
                            </div><!-- /.box -->
                        </div>
                    </div> 
                </section><!-- /.content --> 
</div><!-- /.box -->
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
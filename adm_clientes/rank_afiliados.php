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
                        <li class="active">RANK entre seus Afiliados DIRETOS e INDIRETOS</li>
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

<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Lista de Seus Indicados Diretos e indiretos, UM TOTAL DE <B><?php echo $valor_total_niveis; ?></B> PESSOAS ENTRE SEUS 5 N&Iacute;VEIS DE INDICA&Ccedil;&Otilde;ES.</h3>
    </div><!-- /.box-header -->
	<section class="content">
		<table id="tabela_niveis" class="table table-bordered table-striped">
            <thead>
				<tr>
					<th>N&iacute;veis</th>
					<th>Quantidade de pessoas</th>
                </tr>
            </thead> 
			<tbody> 
				<tr >
					<td > N&iacute;vel 1</td>
					<td><?php echo $total_1; ?></td>
				</tr>
			</tbody> 
			<tbody> 
				<tr>
					<td>N&iacute;vel 2</td>
					<td><?php echo $total_nivel_2; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 3</td>
					<td><?php echo $total_nivel_3; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 4</td>
					<td><?php echo $total_nivel_4; ?></td>
				</tr>
			</tbody>
			<tbody> 
				<tr>
					<td>N&iacute;vel 5</td>
					<td><?php echo $total_nivel_5; ?></td>
				</tr>
			</tbody>
		</table> 
                    <div class="row"> 
                        <div class="col-xs-12"> 
							<i>Ordem de Indica&ccedil;&atilde;o.</i>
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
												<th>Cliente do N&iacute;vel</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </thead> 
 										
<?php
// QUANTIDADE DE PESSOAS NA REDE  
try {	
	// busca nivel 1
	$sql9 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$id."' "); 
	$sql9->execute();
	$res9 = $sql9->fetchAll(PDO::FETCH_OBJ);  
	$total_1 = count( $res9 );
	 
	 
	$total_nivel_2 = 0;
	$total_nivel_3 = 0;
	$total_nivel_4 = 0;
	$total_nivel_5 = 0; 
	foreach($res9 as $ln9) {  
		if ($total_1 > 0) {
			// POSICIONAMENTO DOS SEUS DIRETOS NO RANK 
			try {
				$sql_rank = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
				$sql_rank->execute();
				$res_rank = $sql_rank->fetchAll(PDO::FETCH_OBJ);
				$i_rank = 1;
				foreach($res_rank as $ln_rank) {
					if ($ln_rank->ID == $ln9->ID) { 
						$rankafiliado = $i_rank;
					}
				$i_rank++;
				} 
			} catch(PODException $e_rank) {
				echo "Erro:/n".$e_rank->getMessage();
			}
			// TOTAL DE DIRETOS DOS SEUS DIRETOS
			try {
				$sql_drt = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln9->ID."");
				$sql_drt->execute();
				$res_drt = $sql_drt->fetchAll(PDO::FETCH_OBJ); 
				$total_drt = count( $res_drt );
				
			} catch(PODException $drt) {
				echo "Erro:/n".$drt->getMessage();
			} 
			
			// EXPLODE DATA dos DIRETOS
			$data_drt = $ln9->DATA_CADASTRO;
			$data_drt = implode("/",array_reverse(explode("-",$data_drt)));
	
	
?>	  
	<tbody>
        <tr>
			<td> 
				<?php if ($ln9->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln9->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln9->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln9->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln9->NOME; ?>"><img src="img_perfil/<?php echo $ln9->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><?php echo $ln9->NOME; ?></td>
            <td><?php echo $rankafiliado; ?> &deg;</td>
            <td><?php echo $ln9->PONTOS; ?></td>
            <td><?php echo $total_drt; ?></td>
			<td><?php echo "N&iacute;vel 1"; ?></td>
            <td><?php echo $data_drt; ?></td>
        </tr>
    </tbody> 
<?php	  
		} 
		// busca nivel 2
		$sql10 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln9->ID."'"); 
		$sql10->execute();
		$res10 = $sql10->fetchAll(PDO::FETCH_OBJ);  
		$total_2 = count( $res10 ); 
		foreach($res10 as $ln10) {
			if ($total_2 > 0) {
				// POSICIONAMENTO DOS SEU nivel 2 no RANK 
				try {
					$sql_rank2 = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
					$sql_rank2->execute();
					$res_rank2 = $sql_rank2->fetchAll(PDO::FETCH_OBJ);
					$i_rank2 = 1;
					foreach($res_rank2 as $ln_rank2) {
						if ($ln_rank2->ID == $ln10->ID) { 
							$rankafiliado2 = $i_rank2;
						}
					$i_rank2++;
					} 
				} catch(PODException $e_rank2) {
					echo "Erro:/n".$e_rank2->getMessage();
				}
				
				// TOTAL DE DIRETOS DOS SEUS DIRETOS
				try {
					$sql_drt2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln10->ID."");
					$sql_drt2->execute();
					$res_drt2 = $sql_drt2->fetchAll(PDO::FETCH_OBJ); 
					$total_drt2 = count( $res_drt2 );
					
				} catch(PODException $drt2) {
					echo "Erro:/n".$drt2->getMessage();
				} 
				
				// EXPLODE DATA dos DIRETOS
				$data_drt2 = $ln10->DATA_CADASTRO;
				$data_drt2 = implode("/",array_reverse(explode("-",$data_drt2)));
				 
?>	  
	<tbody>
        <tr>
			<td> 
				<?php if ($ln10->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln10->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln10->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln10->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln10->NOME; ?>"><img src="img_perfil/<?php echo $ln10->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td> <?php echo $ln10->NOME; ?> </td>
            <td><?php echo $rankafiliado2; ?> &deg;</td>
            <td><?php echo $ln10->PONTOS; ?></td>
            <td><?php echo $total_drt2; ?></td>
			<td><?php echo "N&iacute;vel 2"; ?></td>
            <td><?php echo $data_drt2; ?></td>
        </tr>
    </tbody> 
<?php	
			}   
			// busca nivel 3
			$sql11 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln10->ID."'"); 
			$sql11->execute();
			$res11 = $sql11->fetchAll(PDO::FETCH_OBJ);  
			$total_3 = count( $res11 );
			
			foreach($res11 as $ln11) {
				if ($total_3 > 0) {
					// POSICIONAMENTO DOS SEU nivel 3 no RANK 
					try {
						$sql_rank3 = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
						$sql_rank3->execute();
						$res_rank3 = $sql_rank3->fetchAll(PDO::FETCH_OBJ);
						$i_rank3 = 1;
						foreach($res_rank3 as $ln_rank3) {
							if ($ln_rank3->ID == $ln11->ID) { 
								$rankafiliado3 = $i_rank3;
							}
						$i_rank3++;
						} 
					} catch(PODException $e_rank3) {
						echo "Erro:/n".$e_rank3->getMessage();
					}
					
					// TOTAL DE DIRETOS DOS SEUS DIRETOS
					try {
						$sql_drt3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln11->ID."");
						$sql_drt3->execute();
						$res_drt3 = $sql_drt3->fetchAll(PDO::FETCH_OBJ); 
						$total_drt3 = count( $res_drt3 );
						
					} catch(PODException $drt3) {
						echo "Erro:/n".$drt3->getMessage();
					} 
					
					// EXPLODE DATA dos DIRETOS
					$data_drt3 = $ln11->DATA_CADASTRO;
					$data_drt3 = implode("/",array_reverse(explode("-",$data_drt3)));
					 
	?>	 
		<tbody>
			<tr>
				<td> 
				<?php if ($ln11->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln11->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln11->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln11->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln11->NOME; ?>"><img src="img_perfil/<?php echo $ln11->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
				<td> <?php echo $ln11->NOME; ?> </td>
				<td><?php echo $rankafiliado3; ?> &deg;</td>
				<td><?php echo $ln11->PONTOS; ?></td>
				<td><?php echo $total_drt3; ?></td>
				<td><?php echo "N&iacute;vel 3"; ?></td>
				<td><?php echo $data_drt3; ?></td>
			</tr>
		</tbody> 
	<?php	
				}  
				 
				// busca nivel 4
				$sql12 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln11->ID."'"); 
				$sql12->execute();
				$res12 = $sql12->fetchAll(PDO::FETCH_OBJ);  
				$total_4 = count( $res12 ); 
				foreach($res12 as $ln12) {
					if ($total_4 > 0) {
						// POSICIONAMENTO DOS SEU nivel 4 no RANK 
						try {
							$sql_rank4 = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
							$sql_rank4->execute();
							$res_rank4 = $sql_rank4->fetchAll(PDO::FETCH_OBJ);
							$i_rank4 = 1;
							foreach($res_rank4 as $ln_rank4) {
								if ($ln_rank4->ID == $ln12->ID) { 
									$rankafiliado4 = $i_rank4;
								}
							$i_rank4++;
							} 
						} catch(PODException $e_rank4) {
							echo "Erro:/n".$e_rank4->getMessage();
						}
						
						// TOTAL DE DIRETOS DOS SEUS DIRETOS
						try {
							$sql_drt4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln12->ID."");
							$sql_drt4->execute();
							$res_drt4 = $sql_drt4->fetchAll(PDO::FETCH_OBJ); 
							$total_drt4 = count( $res_drt4 );
							
						} catch(PODException $drt4) {
							echo "Erro:/n".$drt4->getMessage();
						} 
						
						// EXPLODE DATA dos DIRETOS
						$data_drt4 = $ln12->DATA_CADASTRO;
						$data_drt4 = implode("/",array_reverse(explode("-",$data_drt4)));
						 
		?>	  
			<tbody>
				<tr>
					<td> 
						<?php if ($ln12->FOTO_PERFIL == "") { ?>
							<a href="completo.php?perfil=<?php echo $ln12->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln12->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
						<?php } else { ?>
							<a href="completo.php?perfil=<?php echo $ln12->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln12->NOME; ?>"><img src="img_perfil/<?php echo $ln12->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
						<?php } ?>
					</td>
					<td> <?php echo $ln12->NOME; ?> </td>
					<td><?php echo $rankafiliado4; ?> &deg;</td>
					<td><?php echo $ln12->PONTOS; ?></td>
					<td><?php echo $total_drt4; ?></td>
					<td><?php echo "N&iacute;vel 4"; ?></td>
					<td><?php echo $data_drt4; ?></td>
				</tr>
			</tbody> 
		<?php	
					}
					// busca nivel 5
					$sql13 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = '".$ln12->ID."'"); 
					$sql13->execute();
					$res13 = $sql13->fetchAll(PDO::FETCH_OBJ);  
					$total_5 = count( $res13 ); 
					foreach($res13 as $ln13) {
						if ($total_5 > 0) {
							// POSICIONAMENTO DOS SEU nivel 5 no RANK 
							try {
								$sql_rank5 = $con->prepare("SELECT * FROM $tabela3  ORDER BY PONTOS DESC, ID ASC");
								$sql_rank5->execute();
								$res_rank5 = $sql_rank5->fetchAll(PDO::FETCH_OBJ);
								$i_rank5 = 1;
								foreach($res_rank5 as $ln_rank5) {
									if ($ln_rank5->ID == $ln13->ID) { 
										$rankafiliado5 = $i_rank5;
									}
								$i_rank5++;
								} 
							} catch(PODException $e_rank5) {
								echo "Erro:/n".$e_rank5->getMessage();
							}
							
							// TOTAL DE DIRETOS DOS SEUS DIRETOS
							try {
								$sql_drt5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_INDICACAO = ".$ln13->ID."");
								$sql_drt5->execute();
								$res_drt5 = $sql_drt5->fetchAll(PDO::FETCH_OBJ); 
								$total_drt5 = count( $res_drt5 );
								
							} catch(PODException $drt5) {
								echo "Erro:/n".$drt5->getMessage();
							} 
							
							// EXPLODE DATA dos DIRETOS
							$data_drt5 = $ln13->DATA_CADASTRO;
							$data_drt5 = implode("/",array_reverse(explode("-",$data_drt5)));
							 
			?>	  
				<tbody>
					<tr>
						<td> 
							<?php if ($ln13->FOTO_PERFIL == "") { ?>
								<a href="completo.php?perfil=<?php echo $ln13->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln13->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
							<?php } else { ?>
								<a href="completo.php?perfil=<?php echo $ln13->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln13->NOME; ?>"><img src="img_perfil/<?php echo $ln13->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
							<?php } ?>
						</td>
						<td> <?php echo $ln13->NOME; ?> </td>
						<td><?php echo $rankafiliado5; ?> &deg;</td>
						<td><?php echo $ln13->PONTOS; ?></td>
						<td><?php echo $total_drt5; ?></td>
						<td><?php echo "N&iacute;vel 5"; ?></td>
						<td><?php echo $data_drt5; ?></td>
					</tr>
				</tbody> 
			<?php	
						}   
					}
				}  
			} 
		}	  
	} 
 
} catch(PODException $e9) {
	echo "Erro:/n".$e9->getMessage();
}   	
	
?>										 
                                        <tfoot>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Total de Diretos</th>
												<th>Cliente do N&iacute;vel</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
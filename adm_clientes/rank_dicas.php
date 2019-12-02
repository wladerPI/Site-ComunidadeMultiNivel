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
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente'");
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
                        <li class="active">RANK Dicas do Dia</li>
                    </ol>
                </section>
<?php	
// seu rank				
try {
	$sql2 = $con->prepare("SELECT * FROM $tabela20  ORDER BY PONTOS DESC, ID ASC");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	$i = 1;
	foreach($res2 as $ln2) {
		if ($ln2->ID_CLIENTE == $id) { 
			$seurank = $i;
		}
		$i++;
	} 
} catch(PODException $e2) {
	echo "Erro:/n".$e2->getMessage();
} 

	// busca quantos pontos vc tem
	$sql_b = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_cliente'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$pontos_ganhos = $ln_b->PONTOS; 
		$data_dica = $ln_b->DATA;
		$data_dica = implode("/",array_reverse(explode("-",$data_dica)));
	}  
	
	// progresso porcentagens
	$sql_b = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$qts_pacotes_premiados = $ln_b->QTS_PACOTES_PAGOS;
		$adm_pontos_a_ser_gerado = $ln_b->QTS_PONTOS_GERADOS; 
		$adm_pontos_gravados = $ln_b->QTS_PONTOS_GRAVADOS_ATUAL;
	}  
	$restam_pontos = $adm_pontos_a_ser_gerado-$adm_pontos_gravados;
	 
	 
	 
	 
	// Função de porcentagem: N é X% de N
	function porcentagem_nx ( $parcial, $total ) {
		return ( $parcial * 100 ) / $total;
	} 
	$porcentagem = porcentagem_nx($adm_pontos_gravados, $adm_pontos_a_ser_gerado);  
	$porcentagem = floor($porcentagem*100)/100;
	$porcentagem = number_format( $porcentagem,  2,',','.'); 
	 
	$porcentagem2 = floor($porcentagem); 
	 
	// total de pessoas
	$sql_b = $con->prepare("SELECT * FROM $tabela20");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$qts_b = count( $res_b ); 
	
	 
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
<?php
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO; 
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
	}	
	if ($liberado == "NAO") {
?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> Essa temporada foi finalizada, aguarde os administradores da ComunidadeMultiN&iacute;vel, retornar as atividades das, Dicas Di&aacute;rias, para continuar os seus trabalhos.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; financiar <?php echo $total_pacotes_pagos; ?> pacote(s) EXECUTIVO(s) para <?php echo $total_pacotes_pagos; ?> NOVO(s) afiliado(s) em nossa REDE PRINCIPAL.</b> Se voc&ecirc; n&atilde;o est&aacute; entre os premiados, aproveite a oportunidade e entre agora mesmo em nossa REDE PRINCIPAL, pois esses <?php echo $total_pacotes_pagos; ?> novo(s) afiliado(s) podem j&aacute; entrar abaixo de voc&ecirc;.<br>
		Ou <br>
		Aguarde o retorno das atividades das, "dicas di&aacute;rias" para continuar subindo no RANK, consequentemente chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores iram lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
<?php } ?>	

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-aqua">
                                <div class="inner">
                                    <h3>
                                        <?php echo $pontos_ganhos; ?>
                                    </h3>
                                    <p>
                                        Sua Pontua&ccedil;&atilde;o no RANK
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-angle-double-up"></i>
                                </div> 
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
                                        Sua posi&ccedil;&atilde;o no RANK 
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div> 
                            </div>
                        </div><!-- ./col --> 				
						<div class="col-lg-6 col-xs-6">
							<div class="callout callout-info" style="background:#c8d9e5;">
								<p style="float:left;font:18px ;"><b> Progresso em Equipe </b></p>
								<p style="float:right;font:18px ;"> <b> Restam Apenas <?php echo $restam_pontos; ?> pontos.</b>  </p>
								<br style="clear:both;">
								<div class="progress" style="text-align:center;"> 
									<div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="<?php echo $porcentagem2; ?>" aria-valuemin="0" aria-valuemax="100"  style="width: <?php echo $porcentagem2."%"; ?>;"> 
									</div>  
								</div>
								<span style="float:right;"><div class="badge bg-green"><?php echo $porcentagem."%"; ?> </div><b> Completado </b>(<i><?php echo $adm_pontos_gravados; ?> / <?php echo $adm_pontos_a_ser_gerado; ?> </i>)</span> <br>
							</div>
						</div><!-- ./col --> 
                    </div><!-- /.row -->
<!-- centro -->		
<?php

	// total de pessoas
	$sql_b = $con->prepare("SELECT * FROM $tabela20");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	$qts_b = count( $res_b ); 
	 
?>
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Um total de <B><?php echo $qts_b; ?></B> afil&iacute;ados pontuados.</h3><br><br><br>
		<div class="alert alert-info alert-dismissable">
			<i class="fa fa-info"></i>
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			<p>A Comunidade MultiN&iacute;vel ir&aacute; disponibilizar <B><?php echo $qts_pacotes_premiados; ?></B> pacote(s) EXECUTIVO(s) para os <B><?php echo $qts_pacotes_premiados; ?>&deg;</B> primeiro(s) colocado(s) nesse RANK abaixo, Ap&oacute;s o t&eacute;rmino do progresso em equipe. <br> 
			<i>(lembrando que a quantidade de pacote(s) a ser financiados pela ComunidadeMultiN&iacute;vel, podem ser alterados a qualquer momento, dependendo do crescimento e do rendimento que alcan&ccedil;armos</i>. </p>
			<br>
			<b>Alguma D&uacute;vida ?</b> Acesse a p&aacute;gina explicativa de <a href="como_funciona_dicas.php" title="Entenda Como funciona esse recurso"><b>Como Funciona Aqui</b></a>, ou <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank"><b>Clique aqui em nosso F&Oacute;RUM </b></a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
        </div> 
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
                                                <th>Indicado por</th>
                                                <th>Data de Cadastro</th>
                                            </tr>
                                        </thead>
										
<?php
 
//######### INICIO Paginação
	$numreg = 500; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	  
	$sql = $con->prepare("SELECT * FROM $tabela20 ORDER BY PONTOS DESC, ID ASC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela20");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo
	
	$rankafiliado = 1;
	foreach($sql_verifc as $ln_td) {
		$total_pontos_cliente = $ln_td->PONTOS;
		$data_cliente = $ln_td->PONTOS;
		$data_cliente = $ln_td->DATA;
		$data_cliente = implode("/",array_reverse(explode("-",$data_cliente)));
			// cliente 
			$sql_td3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = ".$ln_td->ID_CLIENTE."");
			$sql_td3->execute();
			$res_td3 = $sql_td3->fetchAll(PDO::FETCH_OBJ); 
			foreach($res_td3 as $ln_td3) { 
				$cliente_id = $ln_td3->ID;
				$cliente_id_indicado = $ln_td3->ID_INDICACAO;
				$cliente_nome = $ln_td3->NOME;
				$cliente_foto_perfil = $ln_td3->FOTO_PERFIL;
			}			
			
			if ($cliente_id_indicado == "" || $cliente_id_indicado == "0") {
				$cliente_id_patrocinador = "1";
				$cliente_nome_patrocinador = "Comunidade MultiN&iacute;vel";
				$cliente_foto_perfil_patrocinador = "../../img/logotipo.gif";
			} else {
				
				// cliente indicado por
				$sql_td3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = ".$cliente_id_indicado."");
				$sql_td3->execute();
				$res_td3 = $sql_td3->fetchAll(PDO::FETCH_OBJ); 
				foreach($res_td3 as $ln_td3) {
					 
						$cliente_id_patrocinador = $ln_td3->ID;
						$cliente_nome_patrocinador = $ln_td3->NOME;
						$cliente_foto_perfil_patrocinador = $ln_td3->FOTO_PERFIL; 
				}
			}
?>	
	
	  
	<tbody> 
		<tr>
			<td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> > 
				<?php if ($cliente_foto_perfil == "") { ?>
					<a href="completo.php?perfil=<?php echo $cliente_id; ?>" title="Veja o Perfil Completo do(a) <?php echo $cliente_nome; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $cliente_id; ?>" title="Veja o Perfil Completo do(a) <?php echo $cliente_nome; ?>"><img src="img_perfil/<?php echo $cliente_foto_perfil; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> ><?php echo $cliente_nome; ?></td>
            <td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> ><?php echo $rankafiliado; ?> &deg;</td>
            <td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> ><?php echo $total_pontos_cliente; ?></td>
            <td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> > 
				<?php if ($cliente_foto_perfil_patrocinador == "") { ?>
					<a href="completo.php?perfil=<?php echo $cliente_id_patrocinador; ?>" title="Veja o Perfil Completo do(a) <?php echo $cliente_nome_patrocinador; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $cliente_id_patrocinador; ?>" title="Veja o Perfil Completo do(a) <?php echo $cliente_nome_patrocinador; ?>"><img src="img_perfil/<?php echo $cliente_foto_perfil_patrocinador; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
            <td <?php if ($rankafiliado <= $qts_pacotes_premiados) { ?> style="background:#ffe382;" <?php } ?> ><?php echo $data_cliente; ?></td>
        </tr>   
    </tbody>
	 
<?php	
		$rankafiliado++;
	} 
 
?>										 
                                        <tfoot>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th>
                                                <th>Indicado por</th>
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
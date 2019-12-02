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
                        <li class="active">Painel</li>
                    </ol>
                </section>
<?php
// total de pessoas no projeto TALK FUSION
try {
	$sql_total = $con->prepare("SELECT * FROM $tabela3 WHERE TALK_FUSION = 'SIM'");
	$sql_total->execute();
	$res_total = $sql_total->fetchAll(PDO::FETCH_OBJ);
	$total_pess = count( $res_total );
	
} catch(PODException $e_total) {
	echo "Erro:/n".$e_total->getMessage();
} 

// total de pacotes no projeto TALK FUSION
try {
	$sql_pact = $con->prepare("SELECT * FROM $tabela7 WHERE STATUS = 'ATIVO'");
	$sql_pact->execute();
	$res_pact = $sql_pact->fetchAll(PDO::FETCH_OBJ);
	$total_pact = count( $res_pact );
	
} catch(PODException $e_pact) {
	echo "Erro:/n".$e_pact->getMessage();
} 
	
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


<BR style="clear:both;">

<div class="col-md-10"> 
				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">
						<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						<li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="2" class=""></li>
						<li data-target="#carousel-example-generic" data-slide-to="3" class=""></li>
					</ol>
					<div class="carousel-inner" >
						<div class="item active">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-1.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
							 
						</div>
						<div class="item">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-2.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
						</div>
						<div class="item">
							<a href="trafficmonsoon.php" title="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada" ><img src="img/Como-Funciona-os-financiamentos-no-MMN-da-Comunidade-multinivel-3.jpg"    alt="Como Funciona a Ferramenta de trabalho Dicas Di&aacute;rias, que est&aacute; FINANCIADO todos os afil&iacute;liados em uma empresa de MMN legalizada"></a>
						</div>
						<div class="item">
							<a href="promocao_mes.php" title="Troque seus pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPacks da empresa TrafficMonsoon" ><img src="img/Como-Funciona-os-financiado-adpack-da-empresa-trafficmonsoon-equipe-financia-adpack.jpg"    alt="Seja Financiado para aderir ADPacks da empresa trafficmonsoon"></a>
						</div> 
					</div>
					<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
					</a>
					<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
					</a>
				</div>
			</div> 
<!-- BANNER --> 		
<BR style="clear:both;">
<BR style="clear:both;">
<div class="box-body">
		
		
		
			
		
<div class="col-md-14"> 
	<div class="box box-solid">
		
	
		<!-- Custom tabs (Charts with tabs)-->
                            <div class="nav-tabs-custom">
                                <!-- Tabs within a box -->
                                <ul class="nav nav-tabs pull-right">
									
									<li><a href="#3" data-toggle="tab" style="font-size:25px;">Quer Ganhar sua Ades&atilde;o?</a></li>
                                    <li><a href="#2" data-toggle="tab">Rede do SIMULADOR</a></li>
									<li><a href="#1" data-toggle="tab">Entre em Nossa Rede TALK FUSION</a></li>  
									<li class="pull-left header"> Veja Suas Op&ccedil;&otilde;es <i class="fa fa-arrow-right"></i> </li>
                                </ul>
                                <div class="tab-content no-padding">
                                    <!-- Morris chart - Sales -->
									<div class="tab-pane" id="1"  >
										<div class="alert alert-info alert-dismissable">
											<i class="fa fa-info"></i>
											<h4><b>Com certeza a melhor op&ccedil;&atilde;o.</b> Em nossa REDE PRINCIPAL dentro da empresa TALK FUSION, Trabalhamos com a estrat&eacute;gia de trabalho, onde cada posi&ccedil;&atilde;o ter&aacute; apenas 2 indicados diretos, sendo um cada lado, fazendo com que, sempre daremos seguimento na rede abaixo, ajudando assim as pessoas que acabaram de entrar, portanto quanto mais r&aacute;pido voc&ecirc; garantir sua posi&ccedil;&atilde;o acima, mais rent&aacute;vel ser&aacute; para voc&ecirc;.<h4>
										</div>	
										<div style="float:left;width:50%;">
											<iframe class="video" style="margin:10px 0px 0px 10px;"  width="520" height="400" src="//www.youtube.com/embed/0YIbajtgf-8" frameborder="0" allowfullscreen></iframe>
										</div>
										<div style="float:right;width:50%; ">
											<div class="callout callout-warning">
												<h1>REDE PRINCIPAL (TALK FUSION)</h1>
												<b style="color:red;">Veja abaixo algumas das vantagens para trabalhar com a TALKFUSION em nossa REDE PRINCIAL.</b> 
												<h4>- A empresa <b>TALK FUSION &eacute; uma empresa totalmente legalizada e aprovada</b> pelos principais &oacute;rg&atilde;os regulamentadores de empresas de vendas diretas do mundo, desde 2007 e est&aacute; adaptado o marketing de BIN&Aacute;RIO, sendo uns dos mais agressivos mundialmente entre todas as empresas que trabalham com o plano de marketing de Bin&aacute;rio, <a href="../forum/topico/4-Como-Funciona-a-Talk-fusion-?-plano-de-marketing-multi-nivel"  target="_blank" title="Plano de marketing da TALK FUSION">Clique aqui e conhe&ccedil;a melhor a TALK FUSION</a>.</h4><br>
												<h4>- A Forma de recebimento de nossas comiss&otilde;es, n&atilde;o poderia ser melhor, <b>a TalkFusion &eacute; a primeira empresa do mundo a fazer pagamentos de imediato</b>, exemplo: se voc&ecirc; ganha uma comiss&atilde;o agora, dentro de apenas 3 minutinhos o dinheiro j&aacute; estar&aacute; dispon&iacute;vel para seu uso, em seu cart&atilde;o interncional da VISA, podendo sacar em qualquer caixa eletr&ocirc;nico.</h4><br>
												<h4>- Uns dos bons motivos por termos escolhido a empresa Talk Fusion para trabalharmos, &eacute; o fato de que, tanto no bin&aacute;rio quanto no RESIDUAL, n&atilde;o temos limite de n&iacute;veis, n&atilde;o importa quantos n&iacute;veis de indica&ccedil;&otilde;es tenha alcan&ccedil;ado em sua rede, voc&ecirc; ganhar&aacute; comiss&otilde;es de bin&aacute;rio e RESIDUAL de todos seus n&iacute;veis, at&eacute; que pontencialize um valor m&aacute;ximo de <b>(U$ 50.000.00 d&oacute;lares por semana)</b>, isso faz com que seja totalmente aconselhado, trabalhar em profundidade em nossa rede.</h4> 
												<h4>- Outro bom motivo, foi o fato de que na empresa TalkFuion podemos aderir mais de 1 pacote por pessoa, exemplo: podemos de in&iacute;cio adquerir 3 pacotes, fazendo o famoso trip&eacute;, ou <b>podemos adquerir quantos pacotes quisermos</b>, fazendo com que, quanto mais pacotes voc&ecirc; tiver, maiores ser&atilde;o seus rendimentos, podendo assim, ser duplicados, triplicadas, dependendo a quantidade que aderir.</h4> 
												<h4>- Voc&ecirc; tamb&eacute;m ir&aacute; se beneficiar com nossa estrat&eacute;gia de trabalho na REDE PRINCIPAL, pois como <b>sempre daremos seguimento abaixo na rede, tamb&eacute;m iremos ajudar e indicar pessoas abaixo de voc&ecirc;</b>.</h4> 
												<h4>- A ferramenta REDE do SIMULADOR ser&aacute; re-lan&ccedil;ada a cada migra&ccedil;&atilde;o para REDE PRINCIPAL, e chegar&aacute; o momento, que essa <b>rede do simulador entrar&aacute; toda abaixo de voc&ecirc;</b>, em uma posi&ccedil;&atilde;o abaixo de voc&ecirc; que esteja dispon&iacute;vel, isso far&aacute; com que voc&ecirc; ganhe uma alta quantia em comiss&otilde;es.</h4>
												<h4>- A ferramenta Dicas Di&aacute;rias ser&aacute; re-lan&ccedil;ada a cada temporada de pontua&ccedil;&otilde;es atingida, e todos os seus indicados diretos ou indiretos entram abaixo de voc&ecirc;, em alguma posi&ccedil;&atilde;o dispon&iacute;vel abaixo de voc&ecirc;, fazendo com que <b>al&eacute;m de voc&ecirc; ter tido a facilidade de indicar essas pessoas gratuitamente, em um futuro pr&oacute;ximo, essas pessoas e todas as redes delas, entraram sempre abaixo de voc&ecirc;</b>.</h4>
												
												
												<a href="entrar_talk.php"><img src="img/participar-pesquisa.jpg" width="250" height="80" alt="Quero Participar"   /></a>
												<br style="clear:both;">
											</div> 
										</div>
										<br style="clear:both;">
									
									
									
									
									
									
									
									</div>
                                    <div class="tab-pane" id="2"  >
										<div class="alert alert-info alert-dismissable">
											<i class="fa fa-info"></i>
											<h4><b>Com essa Ferramenta de trabalho a ComunidadeMultiN&iacute;vel lhe da a oportunidade, para voc&ecirc; entrar em nossa REDE PRINCIPAL com uma rede de afil&iacute;ados j&aacute; pronta.</b><h4>
										</div>	
										<div style="float:left;width:50%;">
											<iframe class="video" style="margin:10px 0px 0px 10px;"  width="520" height="400" src="//www.youtube.com/embed/JnXq9X5LFAs" frameborder="0" allowfullscreen></iframe>	
										</div>
										<div style="float:right;width:50%; ">
											<div class="callout callout-warning">
												<h1>Ferramenta de trabalho "REDE do SIMULADOR"</h1>
												<h4>- A REDE do SIMULADOR &eacute; uma rede criada gratuitamente por todos os afiliados da Comunidade MultiN&iacute;vel, em uma matrix for&ccedil;ada<b>(cada pessoa ter&aacute; apenas 2 diretos, sendo 1 cada lado)</b>. </h4><br>
												<h4>- O objetivo dessa REDE &eacute; criar um pr&eacute;-cadastro e Simular as rendas dos participantes referente as formas de ganhos da empresa TalkFusion, quando um determinado tempo de trabalho ser atingido, iremos fazer a migra&ccedil;&atilde;o da REDE do SIMULADOR para a REDE PRINCIPAL dentro da empresa TALK FUSION, fazendo com que <b>suas rendas simuladas se torne uma renda real</b>.</h4><br>
												<h4>- Os posicionamentos s&atilde;o determinados por pontua&ccedil;&otilde;es, ao decorrer dos trabalhos, sempre que um indicado seu, direto ou indireto, indicar algu&eacute;m para tamb&eacute;m participar da rede do simulador, voc&ecirc; ganhar&aacute; automaticamente uma quantidade de pontos para que possa investir no RANK do SIMULADOR, fazendo com que voc&ecirc; fique no topo da rede, e quando chegar o momento da migra&ccedil;&atilde;o da REDE do SIMULADOR para a REDE PRINCIPAL, <b>voc&ecirc; entrar&aacute; na empresa TALK FUSION com uma rede de afil&iacute;ados j&aacute; pronta</b>.</h4> 
												
												
												<?php  if ($talk_simulador_status == "SIM") { 
															if ($talk_simulador == "SIM") { ?>
																<b style="color:red;">Voc&ecirc; j&aacute; est&aacute; participando !!!</b><br>
																<a href="rank_talk_simulador.php">Veja aqui seu posicionamento</a>.<br>
															<?php } else {?>	
																<a href="entrar_talk_simulador.php"><img src="img/participar-pesquisa.jpg" width="250" height="80" alt="Quero Participar do SIMULADOR da TALK FUSION"   /></a>
															<?php } 
												} else { ?>
												<br>
													<div class="alert alert-danger alert-dismissable">
														<i class="fa fa-ban"></i> 
														<b>Para participar dessa ferramenta de trabalho, Aguarde a migra&ccedil;&atilde;o para a REDE PRINCIPAL ser efetuada e a REDE do SIMULADOR ser relan&ccedil;ada</b> 
														<br>
														<i>Migra&ccedil;&atilde;o da REDE do SIMULADOR est&aacute; em andamento...</i>
													</div>	 
												<?php } ?>  
												<br style="clear:both;">
											</div> 
										</div>
										<br style="clear:both;"> 
									
										
									</div>
									<div class="tab-pane active" id="3"  >
										<div class="alert alert-info alert-dismissable">
											<i class="fa fa-info"></i>
											<h4><b>A ComunidadeMultiN&iacute;vel &eacute; a &uacute;nica equipe do brasil, que lhe oferece a oportunidade para voc&ecirc; e todos os seus indicados diretos e indiretos, ganharem o pacote de produtos para entrarem em nossa REDE PRINCIPAL.</b><h4>
										</div>	
										<div style="float:left;width:25%;">
											<a href="como_funciona_dicas.php" style="margin:0px 0px 0px 20px;"><img src="img/mmn-gratis-comunidade-multinivel-trabalhar-sem-investir.jpg " width="250" height="350" alt="Quero Saber Mais"   /></a>
										</div>
										<div style="float:right;width:75%; ">
											<div class="callout callout-warning">
												<h1>Ferramenta de trabalho "Dicas Di&aacute;ria"</h1>
												<h4>- Imagine a possibilidade de <b>criar uma rede gratuitamente em uma empresa de MMN segura e confi&aacute;vel</b>, sendo que a <b>sua ades&atilde;o e de todos seus indicados diretos e indiretos, ser&atilde;o financiadas pela pr&oacute;pria ComunidadeMultiN&iacute;vel</b>. </h4><br>
												<h4>- Para voc&ecirc; que tem dificuldade de indicar pessoas em empresas de MMN. Trabalhando em nossa equipe, com essa ferramenta de crescimento, <b>voc&ecirc; s&oacute; ir&aacute; precisar indicar as pessoas gratuitamente para tamb&eacute;m participarem diariamente dessa ferramenta</b>, e n&oacute;s faremos o resto.</h4><br>
												<h4>- Todos seus indicados diretos e indiretos entraram em sua rede, abaixo de voc&ecirc;, fazendo com que <b>al&eacute;m de voc&ecirc; e todos seus indicados diretos e indiretos, tenham a oportunidade de entrar em nossa rede, sem pagar nada e ainda ir&atilde;o ganhar comiss&otilde;es de imediato com seus indicados abaixo</b>.</h4> 
												
												<iframe width="785" height="400" src="//www.youtube.com/embed/LczNICuBftI?rel=0&amp;controls=1&amp;showinfo=0&autoplay=0" frameborder="0" allowfullscreen></iframe>
												
												
												<h4 style="float:left;margin:20px 10px 10px 10px;color:red;width:60%;">Clique aqui e veja os videos com muita aten&ccedil;&atilde;o para seguir com primeiros passos <i class="fa fa-arrow-right"></i> <i class="fa fa-arrow-right"></i> <i class="fa fa-arrow-right"></i> </h4> 
												<a href="trafficmonsoon.php" style="float:right;margin:0px 10px 10px 10px;width:30%; "><img src="img/botao-quero-saber-mais-verde.png" width="250" height="70" alt="Quero Saber Mais"   /></a>
												<br style="clear:both;">
											</div> 
										</div>
										<br style="clear:both;">
									</div>
                                </div>
                            </div><!-- /.nav-tabs-custom -->
							
							
		
	</div><!-- /.box -->
	 
	
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
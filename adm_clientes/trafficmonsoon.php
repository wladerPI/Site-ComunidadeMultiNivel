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
 
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO;
		$pontos_ganhos = $ln_config->PONTOS_GANHOS;		
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
		
		$pontos_ganhos_tms_clientes = $ln_config->TMS_PONTOS_CLIENTE;
		$pontos_ganhos_tms_nivel1 = $ln_config->TMS_PONTOS_NIVEL1;
		$pontos_ganhos_tms_nivel2 = $ln_config->TMS_PONTOS_NIVEL2;
		$pontos_ganhos_tms_nivel3 = $ln_config->TMS_PONTOS_NIVEL3;
		$pontos_ganhos_tms_nivel4 = $ln_config->TMS_PONTOS_NIVEL4;
		$pontos_ganhos_tms_nivel5 = $ln_config->TMS_PONTOS_NIVEL5;
		
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
		
		
		
		
		 <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris charts -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />
		
		
		
		
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
                        <li class="active">TrafficMonsoon</li>
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
 
<!-- centro -->	 
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">O que &eacute; TrafficMonsoon ?</h3>
    </div><!-- /.box-header --> 
	 
	<div class="callout callout-warning"> 
		<p><b>TrafficMonsoon</b> &eacute; uma empresa que vende com publicidade digital(PTC), que nos paga por visualizar an&uacute;ncios diariamente. E n&oacute;s da ComunidadeMultiN&iacute;vel adaptamos a <b>TrafficMonsoon</b> em nossa ferramenta de trabalho "Dicas Di&aacute;rias", para que possamos levantarmos um maior rendimento di&aacute;rio e proporcionarmos todo esse rendimento para <b>financiarmos a ades&atilde;o e pacote no valor de 324 d&oacute;lares para voc&ecirc; e todos seus indicados diretos e indiretos</b> em nossa REDE PRINCIPAL dentro da empresa <b>TalkFusion</b>. <br>
		Veja maiores detalhes de todo o funcionamento dessa maravilhosa vantagem que somente a ComunidadeMultiN&iacute;vel lhe proporciona, para a facilita&ccedil;&atilde;o do crescimento de sua equipe.</p>
	</div>   
	<div class="box-header">
		<h3 class="box-title">O que exatamente eu vou ter que fazer ?</h3>
    </div><!-- /.box-header --> 
	<div class="callout callout-warning"> 
		<h3>Atualmente temos 2 atividades que voc&ecirc; ter&aacute; que fazer diariamente, elas s&atilde;o bem simples e r&aacute;pidas, e s&atilde;o exatamente essas atividades que ir&atilde;o nos proporcionar um rendimento para que possamos financiarmos os ades&otilde;es/Pacotes para todos os afil&iacute;ados da Comunidade MultiN&iacute;vel.</h3>
		<p><b>1&deg; Visualize as "Dicas Di&aacute;rias" no site da ComunidadeMultiN&iacute;vel: </b> Acesse seu Login na Comunidade, e no menu esquerdo clique em "Dicas D&aacute;rias" e depois em "Iniciar", ap&oacute;s visualizar as 3 dicas do dia, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos; ?></b> ponto(s) no "RANK de Premia&ccedil;&otilde;es" <b style="color:red;">(Efetue esse procedimento todos os dias).</b></p>
		<br>
		<p><b>2&deg; Visualize os an&uacute;ncios no site da TrafficMonsoon: </b> Para que voc&ecirc; tenha acesso para visualizar os an&uacute;ncios da <b>TrafficMonsoon</b>, Voc&ecirc; ter&aacute; que efetuar o seu cadastro no site da <b>TrafficMonsoon</b>, atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel. Ap&oacute;s voc&ecirc; efetuar o seu cadastro na <b>TrafficMonsoon</b>, atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, e os moderadores da ComunidadeMultiN&iacute;vel confirmar seu cadastro, voc&ecirc; ir&aacute; ganhar <b><?php echo $pontos_ganhos_tms_clientes; ?></b> pontos no "RANK de premi&ccedil;&otilde;es", e sempre quando um indicado seu, da ComunidadeMultiN&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; tamb&eacute;m ir&aacute; ganhar mais <b><?php echo $pontos_ganhos_tms_nivel1; ?></b> pontos no "RANK de Premi&ccedil;&otilde;es". Com seu cadastro pronto, para visualizar os an&uacute;ncios da <b>TrafficMonsoon</b>, basta acessar seu login no site da <b>TrafficMonsoon</b> e clicar em TODOS os an&uacute;ncios dispon&iacute;veis. Todos os Dias &agrave;s 21:00 hor&aacute;rio de bras&iacute;lia, voc&ecirc; receber&aacute; novos an&uacute;ncios para clicar. E essa atividade sendo executada diariamente, ir&aacute; gerar uma quantia em dinheiro para voc&ecirc; e outra quantia em dinheiro para a ComunidadeMultiN&iacute;vel, sendo que toda a quantia gerada para ComunidadeMultiN&iacute;vel ser&aacute; convertida em pacotes EXECUTIVOs no valor de 324,00 d&oacute;lares, para voc&ecirc; e todos seus indicados diretos e indiretos entrarem em nossa REDE PRINCIPAL dentro da empresa <b>TALK FUSION</b> <b style="color:red;">(Efetue esse procedimento todos os dias).</b></p>
		
		
		<h3>Veja o Video abaixo para entender melhor, como efetuar suas atividades diariamente.</h3> 
		<div style="text-align:center;">
			<iframe width="640" height="480" src="https://www.youtube.com/embed/00zHxyZcQMk?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
	</div>
	<div class="callout callout-warning"> 
		<h3>Veja o Video abaixo os procedimentos de cadastro na TrafficMonsoon</h3>
		<div style="text-align:center;">
			<iframe width="640" height="480" src="https://www.youtube.com/embed/rps5MrYrLGA?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
	 <br> 
	</div> 
	
	<?php  if ($liberado == "NAO") { ?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> Essa temporada foi finalizada, aguarde os administradores da ComunidadeMultiN&iacute;vel, retornar as atividades das, Dicas Di&aacute;rias, para continuar os seus trabalhos.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; financiar <?php echo $total_pacotes_pagos; ?> pacote(s) EXECUTIVO(s) para <?php echo $total_pacotes_pagos; ?> NOVO(s) afiliado(s) em nossa REDE PRINCIPAL.</b> Se voc&ecirc; n&atilde;o est&aacute; entre os premiados, aproveite a oportunidade e entre agora mesmo em nossa REDE PRINCIPAL, pois esses <?php echo $total_pacotes_pagos; ?> novo(s) afiliado(s) podem j&aacute; entrar abaixo de voc&ecirc;.<br>
		Ou <br>
		Aguarde o retorno das atividades das, "dicas di&aacute;rias" para continuar subindo no RANK, consequentemente chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>	
		
	<?php	} else {
		
				$sql_verifc = $con->prepare("SELECT * FROM $tabela22 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'ATIVO'");
				$sql_verifc->execute();
				$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
				$cliente_existe = count( $res_verifc );
				foreach($res_verifc as $ln_clientes) {
					$id_trafficmonsoon_cliente = $ln_clientes->ID_CLIENTE; 
					$status_trafficmonsoon = $ln_clientes->STATUS; 		
					$data_trafficmonsoon = $ln_clientes->DATA_CADASTRO;
					$data = implode("/",array_reverse(explode("-",$data_trafficmonsoon))); 
				}
				
				if ($cliente_existe <= 0) { ?> 
	<div style="text-align:center;">
		<a href="trafficmonsoon_solicitacao.php" title="Clique aqui para efetuar seu cadastro na TrafficMonsoon"><button class="btn btn-warning btn-lg">Clique aqui para efetuar seu cadastro na TrafficMonsoon atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel</button> </a>
	</div>				
<BR>  
	<b style="font-size:25px;color:red;">DICA: </b> <b>Caso voc&ecirc; j&aacute; tenha um cadastro na TrafficMonsoon e deseja alterar o seu patrocinador para o da Comunidade MultiN&iacute;vel e fazer parte de todas nossas promo&ccedil;&otilde;es, voc&ecirc; ter&aacute; que criar um nova conta na TrafficMonsoon, com um novo usu&aacute;rio e um E-mail diferente, que seja do GMAIL ou YAHOO e lembre-se de efetuar o cadastro atrav&eacute;s do link de indica&ccedil;&atilde;o da Comunidade MultiN&iacute;vel, clicando no bot&atilde;o acima.  </b> (Para conseguir efetuar um novo cadastro, voc&ecirc; precisa ficar 48 horas sem acessar sua conta antiga)
<BR> 
	<b style="font-size:25px;color:red">Observa&ccedil;&otilde;es: </b> <b> Ap&oacute;s voc&ecirc; criar sua nova conta na TrafficMonsoon, sendo indicado diretamente do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; nunca mais poder&aacute; acessar sua conta antiga e todo seu saldo de sua conta antiga ser&aacute; perdido, pois se vc tentar utilizar duas contas o sistema de seguran&ccedil;a da TrafficMonsoon ir&aacute; bloquear suas contas e voc&ecirc; poder&aacute; tudo. por tanto, voc&ecirc; n&atilde;o poder&aacute; nunca mais acessar sua conta da TrafficMonsoon antiga.</b>
<BR> <BR> 
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Caso Voc&ecirc; j&aacute; tenha efetuado o seu registrado na TrafficMonsoon atrav&eacute;s do LINK de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel e ainda n&atilde;o ganhou as pontua&ccedil;&otilde;es prometidas, aguarde os moderadores da ComunidadeMultiN&iacute;vel verificar e aprovar o seu registro.<br>
		<br>
		<b>Mantenha sua participa&ccedil;&atilde;o diariamente e corretamente.</b><br>
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
 
				<?php } else { ?> 
<BR>  
	<div class="alert alert-success alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Voc&ecirc; j&aacute; est&aacute; registrado na TrafficMonsoon, mantenha sua participa&ccedil;&atilde;o diariamente e corretamente.<br>
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
	<?php 		}
			} 
	?>
	<br> 
	
		 
</div><!-- /.box -->
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->
 
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
       
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
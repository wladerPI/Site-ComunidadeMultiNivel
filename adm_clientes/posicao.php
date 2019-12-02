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
 
 // id do  cliente que esta acessando
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



	$info = $_GET['info']; // id do pacote que esta sendo acessado
 
	if (!isset($info)) {
		$info = 0;
	}
	
	$indicacao_por = floor($info/2);  // id do pacote que indicou esse pacote 
	$cliente_pacote = $_POST["id_do_cliente"]; // id do cliente que esta comprando o pacote ou comprou 
	
// pacote sendo acessado
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$info'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$total_clientes = count( $res_verifc );
	foreach($res_verifc as $ln_verifc) {
		 $info_id_cliente = $ln_verifc->ID_CLIENTE;
		 $info_status_pacote = $ln_verifc->STATUS;
		 $info_nivel_pacote = $ln_verifc->NIVEL;
		 $info_link_pacote = $ln_verifc->LINK_INDICACAO;
		 $info_datacadastro_pacote = $ln_verifc->DATA_CADASTRO;
		 $info_datavencimento_pacote = $ln_verifc->DATA_VENCIMENTO; 
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
} 

// pacote de indicacao por
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$indicacao_por'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$total_clientes = count( $res_verifc );
	foreach($res_verifc as $ln_verifc) {
		 $info_id_pacote_indic = $ln_verifc->ID_CLIENTE;
		 $info_status_pacote_indic = $ln_verifc->STATUS;
		 $info_nivel_pacote_indic = $ln_verifc->NIVEL;
		 $info_link_pacote_indic = $ln_verifc->LINK_INDICACAO;
		 $info_datacadastro_pacote_indic = $ln_verifc->DATA_CADASTRO;
		 $info_datavencimento_pacote_indic = $ln_verifc->DATA_VENCIMENTO; 
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
}     
 

// se id do pacote  menor que 0
if ($indicacao_por <= 0 && $info != 1) {
	echo("<script type='text/javascript'> alert('Essa posi\u00e7\u00e3o n\u00e3o existe !!!'); location.href='rede_talk.php';</script>");
	exit;
}

// se pacote acima diferente de ATIVO
if ($indicacao_por > 1) {
	if ($info_status_pacote_indic != "ATIVO") {
		echo("<script type='text/javascript'> alert('Essa posi\u00e7\u00e3o ainda n\u00e3o est\u00e1 dispon\u00edvel, aguarde a posi\u00e7\u00e3o acima ser ativa !!!'); location.href='rede_talk.php';</script>");
		exit;
	}
}

// verifica se a posicao 1 esta ativa
if ($info == "1" && $info_status_pacote != "ATIVO") {
	echo("<script type='text/javascript'> alert('Esse projeto esta indispon\u00edvel !!!'); location.href='index.php';</script>");
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
						<li><a href="rede_talk.php"><i class="fa fa-sitemap"></i> Rede TALK FUSION</a></li>
                        <li class="active">Dados da Posi&ccedil;&atilde;o <b><?php echo $info; ?></b></li>
                    </ol>
                </section>
<!--  centro -->	
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
 if ($info_status_pacote == "ATIVO") { ?>

 
 <h2>Essa P&aacute;gina est&aacute; sendo desenvolvida e aguardando o projeto iniciar a migra&ccedil;&atilde;o para a empresa TALK FUSION<h2>
aguarde ... <br> <br> 
<div id="manutencao"><img src="img/manutencao.jpg" alt="P&aacute;gina em Manuten&ccedil;&atilde;o" /></div>
 
 
 
 <?php } else if ($info_status_pacote == "PENDENTE") { ?>
		<?php if ($info_id_cliente == $id_cliente) { ?>
			 
			<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i> 
				<b>Aten&ccedil;&atilde;o: </b> <i>Agora Voc&ecirc; tem que efetuar o cadastro na empresa TALK FUSION e efetuar o pagamento de seu pacote o mais r&aacute;pido poss&iacute;vel. </i> <br>
				<i> Caso contr&aacute;rio, correr&aacute; o risco de perder sua posi&ccedil;&atilde;o e ela ser cancelada e ficar dispon&iacute;vel para "COMPRA" no sistema.</i> <br><br>
				
			</div>   
			<i class="fa  fa-arrow-down"></i> <i class="fa  fa-arrow-down"></i>  <i class="fa  fa-arrow-down"></i>  <b style="color:red;">Siga os Passos abaixo o mais r&aacute;pido poss&iacute;vel </b> <i class="fa  fa-arrow-down"></i> <i class="fa  fa-arrow-down"></i>  <i class="fa  fa-arrow-down"></i>   
			
			<h3> 1 - Efetue seu cadastro na empresa TALK FUSION atrav&eacute;s do LINK de indica&ccedil;&atilde;o abaixo.</h3>
			<h3>LINK: <a href="http://<?php echo $info_link_pacote_indic; ?>.jointalkfusion.com/pt" title="Cadastre-se Agora Mesmo" target="_blank">http://<?php echo $info_link_pacote_indic; ?>.jointalkfusion.com/pt</a></h3>
			<b><a href="artigos/talk/cadastrando.php" title="COMO SE CADASTRAR ?" target="_blank">Veja Nesse Artigo o PASSO a PASSO de Como se Cadastrar na empresa TALK FUSION</a></b> <br>
			
			<hr>
			<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-warning"></i> 
				<b>Caso j&aacute; tenha efetuado todo esse procedimento: </b> <i> AGUARDE, o</i> <b>Administrador da ComunidadeMultiNivel</b> <i>est&aacute; aguardando a empresa TALK FUSION ativar sua COMPRA, para que ele possa verificar se voc&ecirc; realmente se cadastrou atrav&eacute;s da indica&ccedil;&atilde;o do LINK que lhe proporcionamos.</i> <br>
				<i>Caso tenha alguma duvida, contate seu patrocinador do sistema ou contate-nos.</i>
			</div>

			<div class="alert alert-danger alert-dismissable">
				<i class="fa fa-ban"></i> 
				<b>Por Favor: </b> <i>Efetue seu Cadastro na empresa TALK FUSION, atrav&eacute;s do LINK de indica&ccedil;&atilde;o acima </i>  <b>  IMEDIATAMENTE. </b> <br>
				<i> Caso contr&aacute;rio, CANCELE a Solicita&ccedil&atilde;o de sua compra, clicando no bot&atilde;o abaixo.</i> <br><br>
				<form id="form_cancela_1" name="form_cancela_1" method="post" action="cancelando_pacotes.php">
					<INPUT TYPE="hidden" NAME="id_posicao" VALUE="<?php echo $info; ?>">
					<INPUT TYPE="hidden" NAME="id_do_cliente" VALUE="<?php echo $info_id_cliente; ?>">
					<button type="submit"  class="btn btn-danger .btn-lg" title="SOLICITAR O CANCELAMENTO DESSA COMPRA">CANCELAR COMPRA</button> 
				</form>	 
			</div>   
			
		<?php } else { ?>
			
			
			<h2>Essa P&aacute;gina est&aacute; sendo desenvolvida e aguardando o projeto iniciar a migra&ccedil;&atilde;o para a empresa TALK FUSION<h2>
aguarde ... <br> <br> 
<div id="manutencao"><img src="img/manutencao.jpg" alt="P&aacute;gina em Manuten&ccedil;&atilde;o" /></div>
			
			
			
		<?php }  ?>
 <?php } else if ($info_status_pacote == "DESATIVADO") { ?>
	
	
	<h2>Essa P&aacute;gina est&aacute; sendo desenvolvida e aguardando o projeto iniciar a migra&ccedil;&atilde;o para a empresa TALK FUSION<h2>
aguarde ... <br> <br> 
<div id="manutencao"><img src="img/manutencao.jpg" alt="P&aacute;gina em Manuten&ccedil;&atilde;o" /></div>
	
	
	
 <?php } ?>				
                </section><!-- /.content -->
<!-- FIM centro -->	
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
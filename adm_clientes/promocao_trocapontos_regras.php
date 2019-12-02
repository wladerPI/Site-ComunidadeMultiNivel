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
 
	  
	// adm config da promocao 
	$sql_config = $con->prepare("SELECT * FROM $tabela24 WHERE ID = '1'"); 
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln) {  
		$qts_pontos = $ln->PONTOS;  
		  
		$qts_adpacks_comprar1 = $ln->BONUS_COMPRA_ADPACKS1;
		$qts_adpacks_comprar2 = $ln->BONUS_COMPRA_ADPACKS2;
		$qts_adpacks_comprar3 = $ln->BONUS_COMPRA_ADPACKS3;
		$qts_adpacks_comprar4 = $ln->BONUS_COMPRA_ADPACKS4;
		$qts_adpacks_comprar5 = $ln->BONUS_COMPRA_ADPACKS5;
		$qts_adpacks_comprar6 = $ln->BONUS_COMPRA_ADPACKS6;
		$qts_adpacks_comprar7 = $ln->BONUS_COMPRA_ADPACKS7;
		$qts_adpacks_comprar8 = $ln->BONUS_COMPRA_ADPACKS8;
		$qts_adpacks_comprar9 = $ln->BONUS_COMPRA_ADPACKS9;
		$qts_adpacks_comprar10 = $ln->BONUS_COMPRA_ADPACKS10;
		
		$qts_adpacks_brinde1 = $ln->BONUS_BRINDE_ADPACKS1; 
		$qts_adpacks_brinde2 = $ln->BONUS_BRINDE_ADPACKS2;
		$qts_adpacks_brinde3 = $ln->BONUS_BRINDE_ADPACKS3;
		$qts_adpacks_brinde4 = $ln->BONUS_BRINDE_ADPACKS4;
		$qts_adpacks_brinde5 = $ln->BONUS_BRINDE_ADPACKS5;
		$qts_adpacks_brinde6 = $ln->BONUS_BRINDE_ADPACKS6;
		$qts_adpacks_brinde7 = $ln->BONUS_BRINDE_ADPACKS7;
		$qts_adpacks_brinde8 = $ln->BONUS_BRINDE_ADPACKS8;
		$qts_adpacks_brinde9 = $ln->BONUS_BRINDE_ADPACKS9;
		$qts_adpacks_brinde10 = $ln->BONUS_BRINDE_ADPACKS10;
		
		 
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
		
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
						<li><a href="promocao_mes.php"><i class="fa fa-dashboard"></i> Promo&ccedil;&atilde;o do m&ecirc;s</a></li>
                        <li class="active">Regras da promo&ccedil;&atilde;o: 'Troca pontos por ADPacks da empresa TrafficMonsoon'</li>
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
		<h3 class="box-title">Regras da promo&ccedil;&atilde;o: 'Troque seus Pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPack(s) da empresa de publicidade TrafficMonsoon'</h3>
    </div><!-- /.box-header --> 
	<br>
  
<?php
	if ($liberado_pontos == "NAO") {
?>
<BR>  
	<div class="alert alert-warning alert-dismissable">
        <i class="fa fa-check"></i>
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<b>ATEN&Ccedil;&Atilde;O !!! </b> A promo&ccedil;&atilde;o do m&ecirc;s "Troque seus Pontos do RANK de PREMIA&Ccedil;&Atilde;O por ADPack(s) da empresa de publicidade TrafficMonsoon" est&aacute; temporariamente DESATIVADA.<br>
		<b>A ComunidadeMultiN&iacute;vel ir&aacute; analisar a propor&ccedil;&atilde;o do crescimento da equipe, para possivelmente a promo&ccedil;&atilde;o retornar o mais r&aacute;pido poss&iacute;vel.<br>
		 <br>
		Mantenha suas participa&ccedil;&otilde;es diariamente em todas as atividades di&aacute;rias que a ferramenta de trabalho "dicas di&aacute;rias" lhe proporciona, para voc&ecirc; continuar subindo no RANK de PREMIA&Ccedil;&Atilde;O e conseq&uuml;entemente, chegar&aacute; a sua hora de ser o premiado. <br><br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico com sua pergunta, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
    </div>
<br>
<?php }  ?>	
	 
		<div class="box-body">  
		<br>
		1 - Para ser premiado com os ADPacks com posicionamentos de lucros da empresa de publicidade TrafficMonsoon, voc&ecirc; precisar&aacute; de <?php echo $qts_pontos; ?> pontos. Lembrando que essa quantidade de pontos, podem aumentar ou diminuir a qualquer momento, dependendo da propor&ccedil;&atilde;o do crescimento de toda a equipe. <br><br>
		2 - Far&atilde;o parte dessa promo&ccedil;&atilde;o, somente pessoas que est&atilde;o cadastrada na empresa de publicidade TrafficMonsoon, atrav&eacute;s do LINK de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, portanto seu patrocinador ou Sponsor da TrafficMonsoon ter&aacute; que ser 'ComunidadeMN'. <a href="trafficmonsoon.php" title="Cadastre-se gratuitamente, agora mesmo">Clique aqui</a>, e veja o video explicativo, de como se cadastrar CORRETAMENTE na empresa de publicidade TrafficMonsoon. Caso voc&ecirc; deseja efetuar a troca de patrocinador, entre em contato com uns dos moderadores da ComunidadeMultiN&iacute;vel ou crie um t&oacute;pico com sua pergunta no <a href="../forum/index.php" title="Acesse o F&oacute;rum" target="_blank">f&oacute;rum </a> da ComunidadeMultiN&iacute;vel.<br><br>
		3 - Ap&oacute;s efetuar a troca de seus pontos por ADPacks da empresa TrafficMonsoon, os moderadores da ComunidadeMultiN&iacute;vel ir&atilde;o entrar em contato com voc&ecirc; para efetuar os procedimentos da tranfer&ecirc;ncia do dinheiro para uns dos seguintes dos bancos virtuais, PAYPAL, PAYZA ou SolidTrust PAY. Esse procedimento pode demorar alguns dias.<br><br>
		4 - Caso o afil&iacute;ado ser premiado, receber o dinheiro em seu banco virtual, mas N&Atilde;O efetuar a compra do ADPack(s) da empresa TrafficMonsoon, esse mesmo afil&iacute;ado ir&aacute; receber uma advert&ecirc;ncia no sistema da ComunidadeMultiN&iacute;vel e ser&aacute; banido dessa promo&ccedil;&atilde;o e de todas as outras futuras promo&ccedil;&otilde;es que a ComunidadeMultiN&iacute;vel ir&aacute; proporcionar aos afil&iacute;ados.  <br><br>
		5 - Ap&oacute;s voc&ecirc; efetuar a troca de seus pontos por ADPacks da empresa TrafficMonsoon, n&atilde;o ter&aacute; volta, portanto certifique-se de que voc&ecirc; realmente deseja efetuar a troca de seus pontos por ADPack(s) com posicionamentos de lucros da empresa de publicidade TrafficMonsoon, ap&oacute;s a troca, aguarde os moderadores da ComunidadeMultiN&iacute;vel entrarem em contato com voc&ecirc;, atrav&eacute;s de umas das formas de contatos que voc&ecirc; registrou em seus dados do perfil.<br><br>
		6 - Voc&ecirc; poder&aacute; efetuar quantas trocas desejar, basta possuir a quantidade de pontos exigida por troca de ADPacks com posicionamentos de lucro da empresa de publicidade TrafficMonsoon.<br><br>
		7 - Lembrando que, a ferramenta de trabalho "Dicas Di&aacute;rias" foi desenvolvida exclusivamente para facilitar o crescimento do seu rendimento financeiro, todas as comiss&otilde;es que voc&ecirc; gerar para a ComunidadeMultiN&iacute;vel, ser&atilde;o remuneradas para voc&ecirc;.
		<br><br>
		<h3>Ainda com d&uacute;vidas ?</h3>  
		 <i>Contate seu UP-LINE ou <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank"><b>Clique aqui em nosso F&Oacute;RUM </b></a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.</i>
		</div><!-- /.box-body -->
		
		<br style="clear:both;"> <br> 
		 
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
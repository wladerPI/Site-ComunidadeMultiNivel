<?php
session_start(); 
include("../../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../../../index.php';</script>");
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
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | A melhor Estrat&eacute;gia do MMN</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
        <!-- bootstrap 3.0.2 -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../../css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="../../css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../../css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../../css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../../css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../../css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../../css/AdminLTE.css" rel="stylesheet" type="text/css" />

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
            <?php  include("../../menue_art.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="../../index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li class="active"><a href="../../tutoriais_talk.php" title="Veja outros Atigos">ARTIGOS</a></li>
						<li class="active">Estrat&eacute;gia Principal</li>
                    </ol>
                </section>
 	
                <!-- Main content -->
                <section class="content">
				
 <div style="text-align:center;width:100%;">				
 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- pagina-centro-clientes -->
<ins class="adsbygoogle"
     style="display:inline-block;width:728px;height:90px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="3776313246"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
</div> 	


 
<!-- centro -->		
<div class="box-header">
	<h3 class="box-title">Como Funciona Nossa Estrat&eacute;gia Principal ?</h3>
</div><!-- /.box-header -->	

<div class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i> 
    <p>Bin&aacute;rio Perfeito nunca funciona ?</p>
	<p>Voc&ecirc; ficou posicionado na rede do SIMULADOR entre os &uacute;ltimos ?</p>
	<p>N&atilde;o gostou dos resultados que o SIMULADOR lhe mostrou ?</p>
	
</div> 
	 
	 <div class="alert alert-info alert-dismissable">
		<i class="fa fa-info"></i> 
		<p>N&Atilde;O DESISTA AGORA, NO SLIDE ABAIXO ESTAMOS EXPLICANDO A SOLU&Ccedil;&Atilde;O PARA SEUS PROBLEMAS.</p>
	</div> 
	 
<br>
				 
<p>Veja o Slide explicativo abaixo para entender nossa estrat&eacute;gia de trabalho principal, que ser&aacute; adaptada, a partir do momento em que estivermos com toda a rede dentro da empresa.</p>
<iframe src="//www.slideshare.net/slideshow/embed_code/37836194" width="627" height="500" frameborder="0" marginwidth="0" marginheight="0" scrolling="no" style="border:1px solid #CCC; border-width:1px; margin-bottom:5px; max-width: 100%;" allowfullscreen> </iframe>  	
<p>Como voc&ecirc; pode ver no slide, at&eacute; mesmo as pessoas que ficarem por &uacute;ltimo na rede, v&atilde;o se beneficiar rent&aacute;velmente, a estrat&eacute;gia de trabalho de recrutamento, o SIMULADOR &eacute; apenas o &iacute;nicio de nosso projeto, temos grandes planos para sempre continuar dando seguimento a rede abaixo, para voc&ecirc; e toda nossa equipe. </p>
<p>E se voc&ecirc; est&aacute; trabalhando e acreditando em nosso projeto e se pontuando para ficar bem posicionado no RANK, se prepare, pois voc&ecirc; est&aacute; entrando no &iacute;nicio do projeto e ficar&aacute; em uma  posicionamento privilegiado, que lhe trar&aacute; grandes consquistas.</p>

<br>
<iframe class="video" width="600" height="460" src="//www.youtube.com/embed/KJwetY17Gjo?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
<br> 
<br> 
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <i class="ired">"Tente uma, duas, tr&ecirc;s vezes e se poss&iacute;vel tente a quarta, a quinta e quantas vezes for necess&aacute;rio.<br> 
	S&oacute; n&atilde;o desista nas primeiras tentativas, a persist&ecirc;ncia &eacute; amiga da conquista.<br> 
	E se voc&ecirc; quer chegar aonde a maioria n&atilde;o chega, fa&ccedil;a aquilo que a maioria n&atilde;o faz."</i>
</div> 
<br> 
				
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="../../js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="../../js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="../..///cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="../../js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="../../js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="../../js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="../../js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="../../js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="../../js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="../../js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../../js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="../../js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="../../js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="../../js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="../../js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
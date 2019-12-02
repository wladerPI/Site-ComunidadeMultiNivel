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
                        <li class="active">Resumo TALK FUSION</li>
                    </ol>
                </section> 	 

 <!--  centro -->	
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
	$sql2 = $con->prepare("SELECT * FROM $tabela3 ORDER BY PONTOS DESC, ID ASC");
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

<!-- centro --> 
<?php  if ($talk == "SIM") { ?>		 
<div class="box-header">
		<h3 class="box-title">Dados do PROJETO TALK FUSION</h3>
    </div><!-- /.box-header -->
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
<hr style="clear:both;">				
<?php } else if ($talk == "") { ?>  
<div class="box-header">
	<h3 class="box-title">Dados do PROJETO TALK FUSION ?</h3>
</div><!-- /.box-header -->	 
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <b>N&atilde;o fique de fora !</b> <i> fa&ccedil;a parte agora mesmo dessa equipe de sucesso.</i>
</div> 

	
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
									<h3> 
                                        <?php echo $total_pact; ?> 
                                    </h3>
                                    <p>
                                         Total de Pacotes Em Nossa Rede.
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
                                         Total de Pessoas Em Nossa Rede
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div> 
								<br><br>
                            </div>
                        </div><!-- ./col -->  
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                             <a href="../talkfusion/home"  target="_blank"><img src="img/botao-quero-saber-mais-verde.png" width="250" height="70" alt="Quero Saber Mais"   /></a>
                        </div><!-- ./col -->
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                             <a href="entrar_talk.php"><img src="img/participar-pesquisa.jpg" width="250" height="80" alt="Quero Participar"   /></a>
                        </div><!-- ./col -->
		 
<hr style="clear:both;">
<?php }  
 
// total de pessoas no projeto SIMULADOR TALK FUSION
try {
	$sql_total = $con->prepare("SELECT * FROM $tabela3 WHERE TALK_SIMULADOR = 'SIM'");
	$sql_total->execute();
	$res_total = $sql_total->fetchAll(PDO::FETCH_OBJ);
	$total_pess_simulad = count( $res_total );
	
} catch(PODException $e_total) {
	echo "Erro:/n".$e_total->getMessage();
} 

// total de pacotes no projeto SIMULADOR TALK FUSION
try {
	$sql_pact = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO'");
	$sql_pact->execute();
	$res_pact = $sql_pact->fetchAll(PDO::FETCH_OBJ);
	$total_pact_simulad = count( $res_pact );
	
} catch(PODException $e_pact) {
	echo "Erro:/n".$e_pact->getMessage();
} 
 
if ($talk_simulador == "SIM") { ?> 
<div class="box-header">
	<h3 class="box-title">Dados do PROJETO SIMULADOR na TALK FUSION</h3>
</div><!-- /.box-header -->

<?php  
 if ($talk_simulador_status == "NAO") {
?>	
<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i> 
		<b>Aguarde: </b> <b>o PROJETO SIMULADOR da TALK FUSION est&aacute; efetuando a migra&ccedil&atilde;o para a empresa,</b> </i> logo ele estar&aacute; de volta.</B>(Fique Atento, assim que o SIMULADOR voltar, garanta sua posi&ccedil;&atilde;o o mais r&aacute;pido poss&iacute;vel).</i>
		<br><br>
		Quer saber Como Funciona a ferramenta de trabalho <b>"REDE do SIMULADOR"</b>, <a href="como_funciona_simulador.php" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel">clique aqui</a>.
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
	</div>  
<?php  
}  
?>	


 
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
									<h3> 
                                        <?php echo $total_pact_simulad; ?> 
                                    </h3>
                                    <p>
                                         Total de Pacotes no SIMULADOR.
                                    </p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div> <br>
								<a href="rank_talk_simulador.php" class="small-box-footer" title="Veja sua Pontua&ccedil;&atilde;o">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total_pess_simulad; ?> 
                                    </h3>
                                    <p>
                                         Total de Pessoas no SIMULADOR
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div> 
								<br>
								<a href="rank_talk_simulador.php" class="small-box-footer" title="Veja sua Pontua&ccedil;&atilde;o">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col --> 




<hr style="clear:both;">
<?php }  else if ($talk_simulador == "") { ?>  
<div class="box-header">
	<h3 class="box-title">Dados do PROJETO SIMULADOR na TALK FUSION </h3>
</div><!-- /.box-header -->
 <?php  
if ($talk_simulador_status == "SIM") {
?>	
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <b>Por Essa voc&ecirc; n&atilde;o esperava !</b> <i> garanta sua posi&ccedil;&atilde;o agora mesmo no SIMULADOR &eacute; <B style="color:red;">GRATUITO</B>, voc&ecirc; s&oacute; ir&aacute; pagar se realmente gostar dos resultados que o SIMULADOR lhe mostrar.</i>
</div> 
<?php  
} else if ($talk_simulador_status == "NAO") {
?>	
<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i> 
		<b>Aguarde: </b> <b>o PROJETO SIMULADOR da TALK FUSION est&aacute; efetuando a migra&ccedil&atilde;o para a empresa,</b> </i> logo ele estar&aacute; de volta.</B>(Fique Atento, assim que o SIMULADOR voltar, garanta sua posi&ccedil;&atilde;o o mais r&aacute;pido poss&iacute;vel).</i>
		<br><br>
		Quer saber Como Funciona a ferramenta de trabalho <b>"REDE do SIMULADOR"</b>, <a href="como_funciona_simulador.php" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel">clique aqui</a>.
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
	</div> 
<?php  
}  
?>	
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-purple">
                                <div class="inner">
									<h3> 
                                        <?php echo $total_pact_simulad; ?> 
                                    </h3>
                                    <p>
                                         Total de Pacotes no SIMULADOR.
                                    </p> 
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div> <br>
								<a href="rank_talk_simulador.php" class="small-box-footer" title="Veja sua Pontua&ccedil;&atilde;o">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col -->
						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-blue">
                                <div class="inner">
                                    <h3> 
                                        <?php echo $total_pess_simulad; ?> 
                                    </h3>
                                    <p>
                                         Total de Pessoas no SIMULADOR
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-group"></i>
                                </div> 
								<br>
								<a href="rank_talk_simulador.php" class="small-box-footer" title="Veja sua Pontua&ccedil;&atilde;o">
                                    Mais Informa&ccedil;&otilde;es <i class="fa fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div><!-- ./col --> 
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                             <a href="como_funciona_simulador.php"><img src="img/botao-quero-saber-mais-verde.png" width="250" height="70" alt="Quero Saber Mais"   /></a>
                        </div><!-- ./col -->
<?php  
if ($talk_simulador_status == "SIM") {
?>						
						<div class="col-lg-3 col-xs-6">
                            <!-- small box -->
                             <a href="entrar_talk_simulador.php"><img src="img/participar-pesquisa.jpg" width="250" height="80" alt="Quero Participar do SIMULADOR da TALK FUSION"   /></a>
                        </div><!-- ./col -->
<?php } ?>						
						 
<hr style="clear:both;">						
<?php } ?>  

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
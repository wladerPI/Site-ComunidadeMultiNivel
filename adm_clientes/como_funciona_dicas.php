<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
date_default_timezone_set('America/Sao_Paulo');  

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

// progresso porcentagens
	$sql_b = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$qts_pontos_ganhos = $ln_b->PONTOS_GANHOS;
		$qts_pacotes_premiados = $ln_b->QTS_PACOTES_PAGOS;
		$adm_pontos_a_ser_gerado = $ln_b->QTS_PONTOS_GERADOS; 
		$adm_pontos_gravados = $ln_b->QTS_PONTOS_GRAVADOS_ATUAL;
	} 
$restam_pontos = $adm_pontos_a_ser_gerado-$adm_pontos_gravados; 	
 
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
	<script language="javascript">
  function showTimer() {
  var time=new Date();
  var hour=time.getHours();
  var minute=time.getMinutes();
  var second=time.getSeconds();
  if(hour<10)   hour  ="0"+hour;
  if(minute<10) minute="0"+minute;
  if(second<10) second="0"+second;
  var st=hour+":"+minute+":"+second;
  document.getElementById("timer").innerHTML=st; 
 }
 function initTimer() {
  // O metodo nativo setInterval executa uma determinada funcao em um determinado tempo  
  setInterval(showTimer,1000);
 }
</script>
    </head>
    <body class="skin-blue"  onLoad="initTimer();">
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
                        <li class="active">FAQ - Dicas do Dia</li>
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
 <?php
	// adm config 
	$sql_config = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln_config) {  
		$liberado = $ln_config->LIBERADO; 
		$total_pacotes_pagos = $ln_config->QTS_PACOTES_PAGOS;
		
		$pontos_ganhos_tms_clientes = $ln_config->TMS_PONTOS_CLIENTE;
		$pontos_ganhos_tms_nivel1 = $ln_config->TMS_PONTOS_NIVEL1;
		$pontos_ganhos_tms_nivel2 = $ln_config->TMS_PONTOS_NIVEL2;
		$pontos_ganhos_tms_nivel3 = $ln_config->TMS_PONTOS_NIVEL3;
		$pontos_ganhos_tms_nivel4 = $ln_config->TMS_PONTOS_NIVEL4;
		$pontos_ganhos_tms_nivel5 = $ln_config->TMS_PONTOS_NIVEL5;
		
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
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Entenda Como Funciona a ferramenta de trabalho Dicas do Dia.</h3><br><br><br> 
    </div><!-- /.box-header -->
	<section class="content">
		<div class="row">
		



		<br>
		<p style="text-align:center;"><iframe width="640" height="480" src="https://www.youtube.com/embed/Enz8m16p7Tk" frameborder="0" allowfullscreen></iframe></p>
		<br>
		<h4>Ao iniciar os procedimentos das Dicas Di&aacute;rias, tenho que clicar em todos anuncios ?</h4>
		 <i>N&Atilde;O, voc&ecirc; ter&aacute; que apenas visualizar nossas Dicas Di&aacute;rias,</i> <b>&Eacute; muito import&acirc;nte</b> <i>que, ao terminar o terceiro passo, voc&ecirc; ser&aacute; redirecionado para a p&aacute;gina final, onde ir&aacute; aparecer alguns an&uacute;ncios abaixo da mensagem </i>(<span style="color:red;"><i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i> <i>Publicidades</i> <i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i> </span>), <b>&Eacute; de extrema import&acirc;ncia para o nosso crescimento que voc&ecirc; clique em cada um desses an&uacute;ncios e se poss&iacute;vel navegue um pouco nos sites dos an&uacute;nciantes</b>
		 <br><br>
		  
         <h4>Posso criar mais de uma conta na comunidade para min, para que eu possa ganhar mais pontos ? </h4>
		 <i>N&Atilde;O, A ComunidadeMultin&iacute;vel aprova apenas uma conta por pessoa, caso contr&aacute;rio nosso sistema ir&aacute; detectar, e gravar uma ou mais advert&ecirc;ncias em sua conta, fazendo com que o afiliado corra o risco de perder todos seus trabalhos dentro da Comunidade.  </i>
		 <br><br>		 
		  
		 <h4>Quantos Pacotes ser&atilde;o dispin&iacute;bilizados nas premia&ccedil;&otilde;es ?</h4> 
		 <i>Atualmente ser&atilde;o disponibilizados</i> <b style="color:red;"><?php echo $qts_pacotes_premiados; ?></b> <i>pacote(s), por&eacute;m Essa quantidade poder&aacute; ser elevada a qualquer momento, dependendo do crescimento e rendimento que alcan&ccedil;armos.</i>
		 <br><br>
		 
		 <h4>Qual pacote ser&aacute; dispon&iacute;bilizado pela comunidade ?</h4> 
		 <i>O pacote financiado pela ComunidadeMultin&iacute;vel ser&aacute; o  </i>  <b>EXECUTIVO </b>,  <i>no valor de  </i> <b>U$ 324,00 d&oacute;lares, </b>  <i> da empresa TALK FUSION.</i>
		 <br><br>
		 
		 <h4>Quantos pontos posso ganhar por dia ?</h4>
		 <i>Nas atividades di&aacute;rias, das DICAS DI&Aacute;RIAS, voc&ecirc; ganhar&aacute; <b style="color:red;"><?php echo $qts_pontos_ganhos; ?></b> ponto(s) por dia, mantendo sua participa&ccedil;&atilde;o diariamente. </i>
		 <br>
		 <b style="color:red;">Quer saber como alavancar seu posicionamento no RANK de Premia&ccedil;&atilde;es ?</b>
		 <br>
		 <p>Para conquistar um maior numero de pontua&ccedil;&atilde;o diariamente, participe tamb&eacute;m da <b>TrafficMonsoon</b>, <a href="trafficmonsoon.php" title="Entenda Como Funciona a TrafficMonsoon"><button class="btn btn-warning btn-sm">Clique aqui </button> </a> e entenda como funciona.</p>
		 <br>
		 
		 <h4>Um afiliado que j&aacute; est&aacute; na REDE PRINCIPAL pode participar tamb&eacute;m ?</h4>  
		 <i>SIM, na empresa TALK FUSION podemos adquirir mais de um pacote por pessoa, fazendo com que a empresa seja muito mais rent&aacute;vel na cria&ccedil;&atilde;o de equipe, podendo duplicar, triplicar..etc seus rendimentos, dependendo a quantidade de pacotes aderidos, por&eacute;m vale lembrar que cada pacote que voc&ecirc; aderir, ter&aacute; que manter uma mensalidade de U$35,00 d&oacute;lares para se manter ativo, Caso o afiliado n&atilde;o queira um novo pacote, ele poder&aacute; passar para um amigo.</i>
		 <br><br>
		 
		 <h4>Qual hor&aacute;rio que reseta o sistema, para visualizarmos as dicas di&aacute;riamente ? </h4>
		 <i>O sistema da ComunidadeMultiN&iacute;vel reseta &agrave;s 00:00 hora de todos os dias (hor&aacute;rio de S&atilde;o Paulo/Brasil). hor&aacute;rio atual: <?php echo date('H:i:s'); ?>  </i>
		 <br><br>
		 
		 <h4>O que ir&aacute; determinar o desempate no RANK das Dicas Di&aacute;rias ? </h4>
		 <i>Caso haja afiliados com a mesma quantidades de pontos, o que ir&aacute; determinar os desempates ser&aacute; quem in&iacute;cio a primeira atividade primeiro(No caso, quem ganhou o primerio ponto, primeiro). </i>
		 <br><br>
		  
		 <h4>Quando que ser&aacute; a premia&ccedil;&atilde;o ? Quando a temporada ser&aacute; finalizada ? </h4>
		 <i>Os primeiros colocados do RANK de PREMIA&Ccedil;&Atilde;O ser&atilde;o financiados ap&oacute;s a temporada da ferramenta de trabalho "Dicas Di&aacute;rias" ser completada, Para que a temporada seja completada, no "progresso em equipe", ter&aacute; que ser gerado  </i>  <b> <?php echo $adm_pontos_a_ser_gerado; ?> de pontos </b> ,  <i> somando toda a equipe, atualmente foram gerados  </i>  <b> <?php echo $adm_pontos_gravados; ?> pontos </b>,  <i> portanto restam  </i>  <b> <?php echo $restam_pontos; ?> pontos </b> <i>   a ser gerados pela equipe. </i>
		 <br><br>
		  
		 <h4>Se um indicado meu da comunidade ser premiado, que posi&ccedil;&atilde;o da REDE PRINCIPAL ele ir&aacute; entrar ?</h4> 
		 <i>Se voc&ecirc; j&aacute; estiver ATIVO na REDE PRINCIPAL,</i> <b>seu indicado entrar&aacute; abaixo de voc&ecirc; </b> <i>na posi&ccedil;&atilde;o vaga mais acima poss&iacute;vel. Caso voc&ecirc; ainda n&atilde;o esteja ATIVADO na REDE PRINCIPAL, seu indicado entrar&aacute; na posi&ccedil;&atilde;o vaga mais acima possivel de uns de seus UP-lines que j&atilde; estejam ATIVADOS na REDE PRINCIPAL. </i>
		 <br><br>
		 
		 <h4>Ap&oacute;s o t&eacute;rmino  do progresso em equipe, as pessoas que n&atilde;o serem premiadas, perderam seus pontos ?</h4>  
		 <i>N&Atilde;O, os &uacute;nicos que ter&aacute;o seus pontos zerados, ser&atilde;o os premiados, os afil&iacute;ados que n&atilde;o serem premiados, continuaram somando pontos para as pr&oacute;ximas temporadas de premia&ccedil;&atilde;es, fazendo com que, a cada temporada seja mais f&aacute;cil ser premiado.</i>
		 <br><br>
		  
		 <h4>&Eacute; poss&iacute;vel bater a meta do "t&eacute;rmino do progresso em equipe" em apenas 1 m&ecirc;s ?</h4> 
		 <i>SIM, basta termos pessoas suficientes trabalhando di&aacute;riamente nesse recurso gratuito. </i><br>
		 <b style="color:red;">Exemplo:</b> Se alcan&ccedil;armos a meta de 30 mil afiliados trabalhando di&aacute;riamente por 3 minutinhos nas "Dicas Di&aacute;rias", sendo que cada afiliado ganhe 1 ponto por dia, iremos somar 900 mil pontos em apenas 1 m&ecirc;s. 
		 <br>
		 <b style="color:red;">Outro Exemplo:</b> Se alcan&ccedil;armos a meta de 100 mil afiliados trabalhando di&aacute;riamente por 3 minutinhos nas "Dicas Di&aacute;rias", sendo que cada afiliado ganhe 1 ponto por dia, iremos somar 1 milh&atilde;o de pontos em apenas 10 dias. 
		 <br>
		 <b style="color:red;">Trabalhando com TrafficMonsoon podemos alavancar ainda mais r&aacute;pido o nosso crescimento: </b> Voc&ecirc; se cadastrando na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, ap&oacute;s o moderador da ComunidadeMultiN&iacute;vel confirmar seu cadastro, voc&ecirc; ganhar&aacute; <B><?php echo $pontos_ganhos_tms_clientes; ?></B> pontos no RANK de Premia&ccedil;&otilde;es <br>
		 E sempre que um indicado seu da ComunidadeMultiN&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos_tms_nivel1; ?></b> pontos no RANK de Premia&ccedil;&atilde;es. <br>
		 Se um indicado indireto do seu 2&deg; n&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos_tms_nivel2; ?></b> pontos no RANK de Premia&ccedil;&otilde;es. <br>
		 Se um indicado indireto do seu 3&deg; n&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos_tms_nivel3; ?></b> pontos no RANK de Premia&ccedil;&otilde;es. <br>
		 Se um indicado indireto do seu 4&deg; n&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos_tms_nivel4; ?></b> pontos no RANK de Premia&ccedil;&otilde;es. <br>
		 Se um indicado indireto do seu 5&deg; n&iacute;vel tamb&eacute;m se cadastrar na <b>TrafficMonsoon</b> atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, voc&ecirc; ganhar&aacute; <b><?php echo $pontos_ganhos_tms_nivel5; ?></b> pontos no RANK de Premia&ccedil;&otilde;es. <br>
		 <a href="trafficmonsoon.php" title="Entenda Como Funciona a TrafficMonsoon"><button class="btn btn-warning btn-sm">Clique aqui </button> </a> e entenda maiores detalhes.
		 <br><br>
		  
		 <h4>&Eacute; poss&iacute;vel termos maiores n&uacute;mero de pacotes nas premia&ccedil;&otilde;es ?</h4>  
		 <i>SIM, a quantidade de pacotes que a Comunidade MultiN&iacute;vel poder&aacute; financiada ser&aacute; ILIMITADA, podendo a cada temporada obtermos um maior n&uacute;mero de premiados. basta os participantes trabalharem todos os dias e da maniera correta, visualizando todas as dicas e sempre, mas sempre mesmo, clicando e navegando nos &uacute;timos an&uacute;ncios abaixo de (<span style="color:red;"><i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i> <i>Publicidades</i> <i class="fa fa-arrow-down"> </i> <i class="fa fa-arrow-down"> </i> </span>) ao finalizar as Dicas Di&aacute;rias.</i>
		 <br>
		 <i>E tamb&eacute;m sempre manter a participa&ccedil;&atilde;o DIARIAMENTE, clicando e visualizando todos os an&uacute;ncios da <b>TrafficMonsoon.</b></i>
		 <br><br>
		  
		  <h4 style="color:red;">Alavanque o seu posicionamento no RANK de premia&ccedil;&otilde;es, participando tamb&eacute;m da <b>TrafficMonsoon.</b> </h4>  
		 <i>Participando tamb&eacute;m da <b>TrafficMonsoon.</b> DIARIAMENTE al&eacute;m de voc&ecirc; estar colaborando com um maior rendimento para que possamos aumentar a quantidade de pacotes a serem financiados pela ComunidadeMultiN&iacute;vel, voc&ecirc; tamb&eacute;m ter&aacute; a oportunidade de ganhar muitos pontos com seus indicados diretos e indiretos. <a href="trafficmonsoon.php" title="Entenda Como Funciona a TrafficMonsoon"><button class="btn btn-warning btn-sm">Clique aqui </button> </a> e entenda maiores detalhes.</i>
		 <br> <br>
		 
		 <a href="trafficmonsoon.php" title="Entenda Como Funciona a TrafficMonsoon"><button class="btn btn-warning btn-lg">Ainda n&atilde;o entendeu ? Clique aqui e siga os passos dos videos explicativos COM MUITA ATEN&Ccedil;&Atilde;O </button></A>
		 
		 <h3>Caso eu ainda tenha d&uacute;vida, como tira-las ?</h3>  
		 <i>Contate seu UP-LINE ou <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank"><b>Clique aqui em nosso F&Oacute;RUM </b></a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.</i>
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
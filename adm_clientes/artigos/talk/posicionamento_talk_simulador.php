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
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | Quais s&atilde;o os valores dos pacotes da TALK FUSION</title>
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
                        <li class="active"><a href="../../tutoriais_talk.php" title="Veja outros Atigos">ARTIGOS </a></li>
						<li class="active">Como Ser&atilde;o distribu&iacute;dos os posicionamentos na rede do SIMULADOR da TALK FUSION </li>
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
	<h3 class="box-title">Como Ser&atilde;o distribu&iacute;dos os posicionamentos na rede do SIMULADOR da TALK FUSION ? </h3>
</div><!-- /.box-header -->	
<br> 
<b>O seu posicionamento na rede do SIMULADOR da TALK FUSION, ir&aacute; se definir ao decorrer do projeto SIMULADOR.</b>
<br><br>	
<div class="alert alert-info alert-dismissable">
	<i class="fa fa-info"></i> 
    <b>Os primerios posicionados ser&atilde;o definido por maiores pontua&ccedil;&otilde;es e em caso de empates, o que ir&aacute; definir o desempate, &eacute; quem se registrou primeiro no SIMULADOR.</b>
</div>
<hr>
 



			<b style="color:red;">Exemplo: </b>  
			<br>
			<div class="callout callout-info">
				<h4><b style="color:red;">Como vai funcionar esse RANK ?</b></h4>
				 <p>Sua pontua&ccedil;&atilde;o ser&aacute; somada no RANK conforme voc&ecirc; trabalhe e acrescente pontos no projeto </p>
				<p>O sistema(ComunidadeMultiN&iacute;vel) ir&aacute; lhe pontuar em at&eacute; 5 n&iacute;veis de profundidade de suas indica&ccedil;&otilde;es para quaisquer projeto, veja na Tabela abaixo a quantidade de pontos que voc&ecirc; ganhar&aacute; em cada n&iacute;vel de sua rede do sistema.</p>
			</div>
			<hr> 
			
			<?php 
			try {
				$sql_verifc = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
				$sql_verifc->execute();
				$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
				foreach($res_verifc as $ln_verifc) {
					$pontos_nivel_1 = $ln_verifc->PONTOS_NIVEL_1; 
					$pontos_nivel_2 = $ln_verifc->PONTOS_NIVEL_2;
					$pontos_nivel_3 = $ln_verifc->PONTOS_NIVEL_3;
					$pontos_nivel_4 = $ln_verifc->PONTOS_NIVEL_4;
					$pontos_nivel_5 = $ln_verifc->PONTOS_NIVEL_5;
					
					$soma1 = $pontos_nivel_1*10;
					$soma2 = $pontos_nivel_2*100;
					$soma3 = $pontos_nivel_3*1000;
					$soma4 = $pontos_nivel_4*10000;
					$soma5 = $pontos_nivel_5*100000;
				} 
			} catch(PODException $e_verifc) {
				echo "Erro:/n".$e_verifc->getMessage();
			}  
			?>
			<table id="example1" class="table table-bordered table-striped">
				<tr class="trI">
					<td><b>Seus Niveis</b></td>
					<td><b>Pontua&ccedil;&atilde;o por pessoa</b></td> 
					<td><b>Quantidades de pessoas</b></td>
					<td><b>Total de pontua&ccedil;&atilde;o no RANK</b></td>
				</tr>
				<tr class="tr2">
					<td><b>N&Iacute;VEL 1 (seus diretos)</b></td>
					<td><?php echo $pontos_nivel_1; ?></td>
					<td>10</td>	
					<td><?php echo $soma1; ?></td>	
				</tr>
				<tr class="tr2">
					<td><b>N&Iacute;VEL 2</b></td>
					<td><?php echo $pontos_nivel_2; ?></td>
					<td>100</td>	
					<td><?php echo $soma2; ?></td> 
				</tr>
				<tr class="tr2">
					<td><b>N&Iacute;VEL 3</b></td>
					<td><?php echo $pontos_nivel_3; ?></td>
					<td>1.000</td>	
					<td><?php echo $soma3; ?></td>
				</tr>
				<tr class="tr2">
					<td><b>N&Iacute;VEL 4</b></td>
					<td><?php echo $pontos_nivel_4; ?></td>
					<td>10.000</td>	
					<td><?php echo $soma4; ?></td> 
				</tr>
				<tr class="tr2">
					<td><b>N&Iacute;VEL 5</b></td>
					<td><?php echo $pontos_nivel_5; ?></td>
					<td>100.000</td>	
					<td><?php echo $soma5; ?></td> 
				</tr>
			</table>
			<div class="callout callout-info">
				<h4><b style="color:red;">Nesse Exemplo</b></h4> 
				<p>Voc&ecirc; estaria somando um total de <b class="gratuito">246.900 mil pontos</b> no RANK geral do projeto SIMULADOR na empresa <a href="http://talkfusion.com/pt/" title="Site Oficial da empresa" target="_blank">TALK FUSION</a>.
				<div class="alert alert-warning alert-dismissable">
					<i class="fa fa-warning"></i> 
						<i>Lembrando que as pontua&ccedil;&otilde;es ir&atilde;o ser acrescentada em seu Saldo GERAL automaticamente, sempre quando uma pessoa de sua rede do sistema se registrar em um projeto, voc&ecirc; ser&aacute; ser recompe&ccedil;ado com uma determinada quantia de pontua&ccedil;&atilde;o.</i>
					</div>   
			</div>
			\o/ <a href="transferencia_pontos_projeto.php" title="Veja outros pacotes">Como Transferir Minha Pontua&ccedil;&atilde;o Geral Para Minha Pontua&ccedil;&atilde;o do Projeto SIMULADOR da TALK FUSION ? </a> \o/
			<br>
			<br>
			<div class="callout callout-info">
				<p>Potanto as pessoas ser&atilde;o posicionas por ordem de maiores pontua&ccedil;&otilde;es, caso haja empate entre pontua&ccedil;&otilde;es entre os afiliados, o que determinar&aacute; o desempate &eacute; a data de cadastro da pessoa no sistema, quem se cadastrou primeiro ir&aacute; se prevalecer.</p>
				<p>Vamos fazer um exemplo de como ser&aacute; o RANK</p>
				<p>Na tabela abaixo mostra alguns afiliados e a quantidade de pontos que conquistaram no sistema.</p>
			</div>
			
			
			<table id="example1" class="table table-bordered table-striped"> 
				<tr class="trI">
					<td><b>RANK</b></td>
					<td><b>Nome</b></td>
					<td><b>Quantidade Pontos</b></td>
					<td><b>Data de Cadastro</b></td>
				</tr>
				<tr class="tr2">
					<td><b>1 &deg;</b></td>
					<td>Maria Oliveira</td>
					<td>1.000</td>
					<td>07/10/2014</td>
				</tr>
				<tr class="tr2">
					<td><b>2 &deg;</b></td>
					<td>Mario Luis da Silva</td>
					<td>800</td>
					<td>05/09/2014</td>
				</tr>
				<tr class="tr2">
					<td><b>3 &deg;</b></td>
					<td>Ana Lucia</td>
					<td>500</td>
					<td>10/09/2014</td>
				</tr>
				<tr class="tr2">
					<td><b>4 &deg;</b></td>
					<td>Fernando Ribeiro</td>
					<td>100</td>
					<td>04/08/2014</td>
				</tr>
				<tr class="tr2">
					<td><b>5 &deg;</b></td>
					<td>Felipe Fernandes</td>
					<td>100</td>
					<td>05/08/2014</td>
				</tr>
			</table>
			<div class="img"><img src="../../img/img6.jpg" width="220" height="154" alt="" class="fl" /></div>
			<div class="callout callout-info">
				<p>Repare que os posicionamento ficaram em ordem de quem somou a maior pontua&ccedil;&atilde;o, repare tamb&eacute;m que o Fernando Ribeiro e o Felipe Fernandes, ambos possuem 100 pontos, por&eacute;m o Fernando Ribeiro se cadastrou dia 04/08 e o Felipe Fernandes 05/08, portanto o Fernando Ribeiro ficou uma posi&ccedil;&atilde;o acima. <i class="ired">Os posicionamento ficaria como na imagem acima</i>.</p>
			</div>
			  
			<div class="callout callout-info">
				<h4><b style="color:red;">E em caso da pessoa possuir mais de um pacote</b></h4> 
				<p>SIMPLES: <i class="ired">Cada Pacote aderido por uma pessoa, ter&aacute; sua pontua&ccedil;&atilde;o pr&oacute;pria, por tanto cada pacote ter&aacute; seu posicionamento.</i></p>  
			</div>
			 
			<div class="callout callout-info">
				<h4><b style="color:red;">Como eu vou saber em que posi&ccedil;&atilde;o do RANK estou ?</b></h4> 
				<p> Em sua &aacuterea restrita mostrar&aacute; uma tabela entre os participantes do projeto, atualizando em tempo real o seu posicionamento e de todos os afiliados do projeto. </p>
			</div>
			<br> 
			 
			<div class="alert alert-warning alert-dismissable">
				<i class="fa fa-warning"></i> 
				<p> Quando chegar o momento que a data terminada pela ComunidadeMultiN&iacute;vel ser atingida, iremos antecipadamente comunicarmos todos afiliados do projeto, e avisa-los que chegou o momento de passarmos para o 2&#176; PASSO do projeto, a migra&ccedil&atilde;o de toda a rede do sistema para a empresa <a href="http://talkfusion.com/pt/" title="Site Oficial da empresa" target="_blank">TALK FUSION</a> em nossa REDE PRINCIPAL.   </p>
			</div>   

 
 
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
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
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
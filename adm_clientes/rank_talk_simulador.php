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
	 
	
	<!-- CHAMADA PARA OS ARQUIVOS JQUERY : início -->
	<script src="js/jquery.min.js"></script> 
	<script src="js/jquery.ccountdown.js"></script>
	 
	<!--[if lte IE 7]><script src="css/lte-ie7.js"></script><![endif]-->
	<!-- CHAMADA PARA OS ARQUIVOS JQUERY : fim -->
	
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
                        <li class="active">RANK do SIMULADOR da TALK FUSION</li>
                    </ol>
                </section>
<?php	
/// total de pessoas no projeto SIMULADOR TALK FUSION
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
	if ($talk_simulador_status == "NAO") { 
?>
	 <br>
	<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i> 
		<b>Para participar dessa ferramenta de trabalho, Aguarde a migra&ccedil;&atilde;o para a REDE PRINCIPAL ser efetuada e a REDE do SIMULADOR ser relan&ccedil;ada</b> 
		<br>
		<!-- <i>Migra&ccedil;&atilde;o da REDE do SIMULADOR est&aacute; em andamento...</i> -->
		<i>ESSA FERRAMENTA EST&Aacute; TEMPORARIAMENTE EM MANUTEN&Ccedil;&Atilde;O</i>
		<br><br>
		Quer saber Como Funciona a ferramenta de trabalho <b>"REDE do SIMULADOR"</b>, <a href="como_funciona_simulador.php" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel">clique aqui</a>.
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
	</div>
<?php } ?>	


                    <div class="row">
 
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
                                </div> 
								<br><br>
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
								<br><br>
                            </div>
                        </div><!-- ./col --> 
					</div><!-- /.row -->
					
<Script type = "text/javascript">
function verifica1() { 
	if (form.add_pontos1.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica2() { 
	if (form.add_pontos2.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica3() { 
	if (form.add_pontos3.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica4() { 
	if (form.add_pontos4.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica5() { 
	if (form.add_pontos5.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica6() { 
	if (form.add_pontos6.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
function verifica7() { 
	if (form.add_pontos7.value == "0") { 
		alert("UMA Quantidade de pontos \xE9 obrigat\xF3rio"); 
		return false;   
    }  
}
</script>
<!-- centro -->		
<?php
if ($talk_simulador_status == "SIM") { 
	 ?>
		<div class="box box-primary"> 
		
		
			<div class="box-header">
				<h3 class="box-title">Contagem Regressiva para o lan&ccedil;amento da migra&ccedil;&atilde;o da rede do simulador para a rede principal.</h3>
			</div><!-- /.box-header --> 
		
			 <br>
			<div class="ccounter">
				<!-- 
				Altere as cores das barras de contagem e o tamanho dos círculos modificando os valores em "data-width" (largura/tamanho) e "data-fgColor" (cor da barra)
				-->
				<table style="width:auto; height:200px; margin:0px 0px 0px 10%;" >
					<tr>
						<td>
							<!-- CÍRCULO 1 - DIAS -->
							<input class="knob days" data-width="200" data-min="0" data-max="365" data-displayPrevious=true data-fgColor="#3c8dbc" data-readOnly=true value="1" data-bgcolor="#3c8dbc">
						</td>
						<td>
							<!-- CÍRCULO 2 - HORAS -->
							<input class="knob hour" data-width="200" data-min="0" data-max="24" data-displayPrevious=true data-fgColor="#3c8dbc" data-readOnly=true value="1"  data-bgcolor="#3c8dbc">
						</td>
						<td>
							<!-- CÍRCULO 2 - MINUTOS -->
							<input class="knob minute" data-width="200" data-min="0" data-max="60" data-displayPrevious=true data-fgColor="#3c8dbc" data-readOnly=true value="1"  data-bgcolor="#3c8dbc">
						</td>
						<td>
							<!-- CÍRCULO 2 - SEGUNDOS -->
							<input class="knob second" data-width="200" data-min="0" data-max="60" data-displayPrevious=true data-fgColor="#3c8dbc" data-readOnly=true value="0" data-bgcolor="#3c8dbc"> 
						</td>
					</tr>
					<tr>
						<td style="text-align:center;"> <i>Dias</i> </td>
						<td style="text-align:center;"> <i>Horas</i> </td>
						<td style="text-align:center;"> <i>Minutos</i> </td>
						<td style="text-align:center;"> <i>Segundos</i> </td>
					</tr>
				
				</table>
				
			</div>	 
		<script>
			// Informe a data final da contagem no formato $(".ccounter").ccountdown((ano, mês, dia, 'hora:minuto');
			$(".ccounter").ccountdown(2015,05,10,'00:00');
		</script>
    		<br>
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i> 
			<b>Aten&ccedil;&atilde;o: </b> Ser&aacute; de extrema import&acirc;ncia, que voc&ecirc; j&aacute; esteja com o dinheiro em seu cart&atilde;o internacional pronto para efetuar seu cadastro e pagamento, CASO CONTR&Aacute;RIO VOC&Ecirc; PERDER&Aacute; SUA POSI&Ccedil;&Atilde;O PARA A PESSOA ABAIXO.<br>
			<br>
			<b>1 - </b> <a href="../forum/topico/5-Quais-Sao-os-Valores-dos-pacotes-para-entrar-na-TALK-FUSION" title="Valores dos pacotes da TALK FUSION" target="_blank">Quais S&atilde;o os valores dos Pacotes ? </a>
			<br>
			<b>2 - </b> <a href="artigos/talk/cadastrando.php" title="Procedimentos de cadastro na REDE PRINCIPAL da TALK FUSION" target="_blank">Qual ser&aacute; o procedimento do cadastro na REDE PRINCIPAL ? </a>
			<br>
			<b>3 - </b> <a href="parcela.php" title="Formas de pagamentos dos pacotes da TALK FUSION" target="_blank">Como Efetuar o Parcelamento do meu pacote em at&eacute; 12x no cart&atilde;o  ? </a>  
			N&atilde;o tenho cart&atilde;o internacional, o que eu fa&ccedil;o ?<br> 
			<br>
			Quer saber Como Funciona a ferramenta de trabalho <b>"REDE do SIMULADOR"</b>, <a href="como_funciona_simulador.php" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel">clique aqui</a>.
			<br>
			Duvidas ? 
			<br>
			<b style="color:red;font-size:30px;"> Ainda com D&uacute;vidas ? </b> acesse nosso FORUM e fa&ccedil;a sua pergunta criando um t&oacute;pico 
				<a class="login_talk" href="../forum/index.php" title="Tire Todas Suas Duvidas no For&uacute;m Da ComunidadeMultiN&iacute;vel" target="_blank"> 
					<img  src="img/logo_forum_comunidademultinivel.png" width="60" height="60" alt="For&uacute;m da ComunidadeMultiN&iacute;vel"  /> 
				</a> 
			<br>  
		</div> 
		<hr class="box box-primary"> 
		
		
		 
		
<?php
	// se tal cliente nao estar cadastrado no simulador
	if ($talk_simulador == "") { ?>
	<div class="alert alert-info alert-dismissable">
		<i class="fa fa-info"></i> 
		<b> Voc&ecirc; ainda n&atilde;o est&aacute; cadastrado(a) no SIMULADOR da TALK FUSION, GARANTA SUA POSI&Ccedil;&Atilde;O AGORA MESMO !!! </b>
	</div>  
<?php } else { 	 
	// ADCIONAR PONTOS NO PROJETO
?>	

	<div class="box-header">
		<h3 class="box-title">Deseja Adicionar mais pontos para aumentar o posicionamento de seus pacotes no RANK do SIMULADOR da TALK FUSION </h3>
    </div><!-- /.box-header --> 
	
	<p>Voc&ecirc; possui <b style="color:red;"><?php echo $pontos; ?> </b> Pontos em Geral disponivel.</p>
	
	
	<table id="example1" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th>Seus Pacotes</th> 
                <th>Total de Pontos</th>
                <th>Adicionar Pontos</th>
                <th>Clique no Bot&atilde;o</th> 
            </tr>
        </thead>
<?php
	$sql = $con->prepare("SELECT * FROM $tabela9 WHERE ID_CLIENTE = '$id_cliente'");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	$t = 1; 
	foreach($sql_verifc as $ln_td) { 
?>		
	<form id="form" name="form" method="post" action="addponos_talk_simulador.php">
		<input TYPE="HIDDEN" id="id_posicao" name="id_posicao" class="text" value="<?php echo $ln_td->ID_POSICAO; ?>" />
		<thead>
			<tr>
				<th><?php echo $t; ?></th> 
                <th><?php echo $ln_td->PONTOS_SIMULADOR; ?></th>
                <th>
					<label class="pacotes"><select name="add_pontos<?php echo $t; ?>"> 
						<?php for( $i=0; $i <= $pontos; $i++) { ?>	
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option> 
						<?php	 } ?>		 
					</select></label> 
				</th>
                <th>
					<div class="box-footer">
						<input type="submit" class="btn btn-primary" Onclick="return verifica<?php echo $t; ?>()"  value="ACRESCENTAR PONTOS" /> 
					</div>
				</th> 
            </tr>
        </thead>
	</form>
<?php 
	$t++;
	}
?>		  
	</table>
	<br> 
		<div class="alert alert-danger alert-dismissable">
			<i class="fa fa-ban"></i> 
			<b>OBSSERVA&Ccedil;&Atilde;O: </b> Uma vez que sua pontua&ccedil;&atilde;o seja transferida, n&atilde;o ter&aacute; mais retorno.
		</div>  
	<hr class="box box-primary"> 
<?php } 
} else { ?>
	<br>
	<div class="alert alert-danger alert-dismissable">
		<i class="fa fa-ban"></i> 
		<b>Aguarde: </b> <b>o PROJETO SIMULADOR da TALK FUSION est&aacute; efetuando a migra&ccedil&atilde;o para a empresa,</b> </i> logo ele estar&aacute; de volta.</B>(Fique Atento, assim que o SIMULADOR voltar, garanta sua posi&ccedil;&atilde;o o mais r&aacute;pido poss&iacute;vel).</i>
		<br><br>
		Quer saber Como Funciona a ferramenta de trabalho <b>"REDE do SIMULADOR"</b>, <a href="como_funciona_simulador.php" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel">clique aqui</a>.
		<br>
		Alguma D&uacute;vida ? <a href="../forum" title="F&Oacute;RUM da ComunidadeMultiN&iacute;vel" target="_blank">Clique aqui em nosso F&Oacute;RUM </a> e crie um T&oacute;pico perguntando, que nossos moderadores ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel.
	</div> 
<?php }

if ($total_pess_simulad <= 0) { ?>
		<div class="box-header">
			<h3 class="box-title">Nenhum Cliente Registrado no SIMULADOR da TALK FUSION</h3>
		</div><!-- /.box-header --> 
	<?php } else { 
 ?>
  
<div class="box-header">
		<h3 class="box-title">RANK do SIMULADOR da TALK FUSION </h3>
    </div><!-- /.box-header --> 
<?php
	$sql = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO' ORDER BY PONTOS_SIMULADOR DESC, ID_POSICAO ASC");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta );  $quantreg2 = count( $sql_verifc ); 
  
	$i = 1;
	foreach($sql_verifc as $ln_td) {
		
		$data = $ln_td->DATA_CADASTRO_TALK_SIMULADOR;
		$data = implode("/",array_reverse(explode("-",$data)));
	
		$sql_td2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = ".$ln_td->ID_CLIENTE."");
		$sql_td2->execute();
		$res_td2 = $sql_td2->fetchAll(PDO::FETCH_OBJ);
			 
			 
		foreach($res_td2 as $ln_td2) {
			if ($ln_td2->TALK_FUSION != "SIM") {
				$rankafiliado = $i;
				$i++;
				
				if ($rankafiliado == 1) {  
					$primeiro = $ln_td->ID_CLIENTE;
					 
				?> 
<table id="tabela_rede" ><tr> 
<td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>  <td></td> <td></td> <td></td>
		<td></td>
		  <td id="posicao1">
		  <img src="img/1.gif" width="80" height="100" alt="" /> 
		 </td> 
		<td></td>
<td></td> <td></td> <td></td> <td></td>  <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>   
</tr> 
 
<tr> 
<td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>  <td></td> <td></td> <td></td>
		<td><img src="img/2.gif" width="80" height="100" alt="" /> </td>
		  <td id="posicao1">
		  <?php if ($ln_td2->FOTO_PERFIL == "") { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="80" /> </a>
			<?php } else { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/<?php echo $ln_td2->FOTO_PERFIL; ?>"  class="img-circle" width="80" alt="Sua Imagem" /></a>
			<?php } ?>
			<br>
		 <?php echo "<b>". $ln_td2->NOME. "</b> <br>"; ?> 
		 <a href="simulando.php?simular=<?php echo $rankafiliado; ?>&cliente=<?php echo $ln_td2->ID; ?>" title="Veja o a Rede e a Renda SIMULADA dessa Posi&ccedil&atilde;o"><button class='btn btn-info btn-sm'><b style='font-size:20px;'> <?php echo $ln_td->PONTOS_SIMULADOR; ?></b></button></a><br>  
		 <i><?php echo $data; ?><i> 
		 </td>
		  
		<td><img src="img/3.gif" width="80" height="100" alt="" /> </td>
<td></td> <td></td> <td></td> <td></td>  <td></td> <td></td> <td></td> <td></td> <td></td> <td></td> <td></td>   
	</tr> 
</table>	 
				<?php }  if ($rankafiliado == 2) { 
					$segundo = $ln_td->ID_CLIENTE;
				?>

<table id="tabela_rede" >
						
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td> 
		<td id="posicao1">
		 <?php if ($ln_td2->FOTO_PERFIL == "") { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="80" /> </a>
			<?php } else { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/<?php echo $ln_td2->FOTO_PERFIL; ?>"  class="img-circle" width="80" alt="Sua Imagem" /></a>
			<?php } ?>
			<br>
		 <?php echo "<b>". $ln_td2->NOME. "</b> <br> "; ?> 
		 <a href="simulando.php?simular=<?php echo $rankafiliado; ?>&cliente=<?php echo $ln_td2->ID; ?>" title="Veja o a Rede e a Renda SIMULADA dessa Posi&ccedil&atilde;o"><button class='btn btn-info btn-sm'><b style='font-size:20px;'> <?php echo $ln_td->PONTOS_SIMULADOR; ?></b></button></a><br>  
		 <i><?php echo $data; ?><i> 
		</td>  
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td> 
		<td></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
				<?php }  if ($rankafiliado == 3) { 
					$terceiro = $ln_td->ID_CLIENTE;
				?>
		<td id="posicao1">
		 <?php if ($ln_td2->FOTO_PERFIL == "") { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="80" /> </a>
			<?php } else { ?>
				<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/<?php echo $ln_td2->FOTO_PERFIL; ?>"  class="img-circle" width="80" alt="Sua Imagem" /></a>
			<?php } ?>
			<br>
		 <?php echo "<b>". $ln_td2->NOME. "</b> <br> "; ?> 
		 <a href="simulando.php?simular=<?php echo $rankafiliado; ?>&cliente=<?php echo $ln_td2->ID; ?>" title="Veja o a Rede e a Renda SIMULADA dessa Posi&ccedil&atilde;o"><button class='btn btn-info btn-sm'><b style='font-size:20px;'> <?php echo $ln_td->PONTOS_SIMULADOR; ?></b></button></a><br>  
		 <i><?php echo $data; ?><i> 
		</td> 
		<td></td>
		<td></td> 
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>   
	</tr> 
</table>
				 
				
				<?php }
			}
		}		
		 
 
	}    
 

?> 
                    <div class="row">  
                        <div class="col-xs-12">
							<br>
							<i style="color:red;">As 3 posi&ccedil;&otilde;es acima est&atilde;o reservadas somente para as pessoas que ainda n&atilde;o est&atilde;o na REDE PRINCIPAL da TALK FUSION.</i><br>
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
												<th>Data de Cadastro</th>
                                            </tr>
                                        </thead>
										
<?php




######### INICIO Paginação
	$numreg = 1000; // Quantos registros por página vai ser mostrado
	$pg = $_GET['pg'];
 
	if (!isset($pg)) {
		$pg = 0;
	}
	$inicial = $pg * $numreg;
	
//######### FIM dados Paginação
	  
	$sql = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO' ORDER BY PONTOS_SIMULADOR DESC, ID_POSICAO ASC LIMIT $inicial, $numreg");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);
	
	$sql_conta = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	$quantreg = count( $sql_conta ); 
	   
	 
	include("paginacao.php"); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	
	echo "<br><br>"; // Vai servir só para dar uma linha de espaço entre a paginação e o conteúdo

	$i = 4;
	foreach($sql_verifc as $ln_td) {
	
		$data = $ln_td->DATA_CADASTRO_TALK_SIMULADOR;
		$data = implode("/",array_reverse(explode("-",$data)));
	
	if ($ln_td->ID_CLIENTE != $primeiro && $ln_td->ID_CLIENTE != $segundo && $ln_td->ID_CLIENTE != $terceiro ) { 
		$rankafiliado = $i;
		$i++;
		// POSICIONAMENTO DOS SEUS DIRETOS NO RANK 
		 
			$sql_td2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = ".$ln_td->ID_CLIENTE."");
			$sql_td2->execute();
			$res_td2 = $sql_td2->fetchAll(PDO::FETCH_OBJ);
			 
			foreach($res_td2 as $ln_td2) { 
			 
?>	
	<tbody>
		<?php if ($ln_td2->ID == $id) { ?>
		<tr>  
			<td> 
				<?php if ($ln_td2->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/<?php echo $ln_td2->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><b class="eunorank"><?php echo $ln_td2->NOME; ?></b></td>
            <td><b class="eunorank"><?php echo $rankafiliado; ?> &deg;</b></td>
            <td><a href="simulando.php?simular=<?php echo $rankafiliado; ?>&cliente=<?php echo $ln_td2->ID; ?>" title="Veja o a Rede e a Renda SIMULADA dessa Posi&ccedil&atilde;o"><button class='btn btn-info btn-sm'><b class="eunorank"><?php echo $ln_td->PONTOS_SIMULADOR; ?></b> </button></a></td> 
			<td><i><?php echo $data; ?><i></td>
        </tr> 
		<?php } else { ?> 
		<tr>
			<td> 
				<?php if ($ln_td2->FOTO_PERFIL == "") { ?>
					<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" width="50" /> </a>
				<?php } else { ?>
					<a href="completo.php?perfil=<?php echo $ln_td2->ID; ?>" title="Veja o Perfil Completo do(a) <?php echo $ln_td2->NOME; ?>"><img src="img_perfil/<?php echo $ln_td2->FOTO_PERFIL; ?>"  class="img-circle" width="50" alt="Sua Imagem" /></a>
				<?php } ?>
			</td>
			<td><?php echo $ln_td2->NOME; ?></td>
            <td><?php echo $rankafiliado; ?> &deg;</td>
            <td><a href="simulando.php?simular=<?php echo $rankafiliado; ?>&cliente=<?php echo $ln_td2->ID; ?>" title="Veja o a Rede e a Renda SIMULADA dessa Posi&ccedil&atilde;o"><button class='btn btn-info btn-sm'><?php echo $ln_td->PONTOS_SIMULADOR; ?></button></a></td> 
			<td><i><?php echo $data; ?><i></td>
        </tr>  
		<?php } ?>
			
    </tbody>
	
		
<?php 
	}   
		 }
		 } 
?>										 
                                        <tfoot>
                                            <tr>
												<th>Foto Perfil</th>
                                                <th>Nome Completo</th>
                                                <th>Posicionamento no RANK</th>
                                                <th>Total de Pontos</th> 
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
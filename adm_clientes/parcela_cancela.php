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
 
	// seu patrocinador
	$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ln_verifc->ID_INDICACAO'");
	$sql_verifc2->execute();
	$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc2 as $ln_verifc2) {
		$patrocinador_nome = $ln_verifc2->NOME;
		$patrocinador_id = $ln_verifc2->ID; 
	}	
	
 
	 
	 // ENVIANDO EMAIL PARA OS MODERADORES ------------------------------- 

// busca dados do cliente
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$id_patrocinador = $ln2->ID_INDICACAO; 
	$nomecliente = $ln2->NOME;
	$telcliente = $ln2->TELEFONE;
	$celcliente = $ln2->CELULAR;
	$facecliente = $ln2->FACEBOOK;
	$skypecliente = $ln2->SKYPE;
	$emailcliente = $ln2->EMAIL;
}

// busca email do server
$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
   
date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
 
$body = "
			Prezado MODERADOR(a) da ComunidadeMultiN&iacute;vel.
			<br><br> 
			<i style='color:red;'>Um Afiliado(a), tentou efetuar o parcelamento via PAYPAL de um pacote de produto da empresa TALK FUSION, por&eacute; ele CANCELOU A COMPRA.</i>
			<br>
			Seu suporte ser&aacute; de grande importancia. <br>
			<br><br>
			<b style='color:red;'>Dados do(a) Afiliado(a)</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_cliente' title='Estando logado na Comunidade, acesse o perfil desse afiliado(a)'>$id_cliente</a><br>
			<b>NOME :</b> $nomecliente<br>
			<b>Telefone :</b> $telcliente<br>
			<b>Celular :</b> $celcliente<br>
			<b>Facebook :</b> $facecliente<br>
			<b>Skype :</b> $skypecliente<br>
			<b>E-Mail :</b> $emailcliente<br>
			<br> 
			<b>N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel.</b>		
			<br>
			<hr>
			<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. <br> 
			<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>   <br>
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b> <br>
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Um Afiliado CANCELOU o parcelamento no PAYPAL";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR(a) da ComunidadeMultiN&iacute;vel.
			 
			 Um Afiliado(a), tentou efetuar o parcelamento via PAYPAL de um pacote de produto da empresa TALK FUSION, por&eacute; ele CANCELOU A COMPRA. 
			 
			Seu suporte ser&aacute; de grande importancia. 
			 
			 Dados do(a) Afiliado(a) 
			 ID :http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_cliente 
			 NOME : $nomecliente 
			 Telefone :  $telcliente 
			 Celular :  $celcliente 
			 Facebook :  $facecliente  
			Skype : $skypecliente  
			 E-Mail :  $emailcliente 
			  
			
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 	
			 
			 Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  
			www.comunidademultinivel.com.br   
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 

$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
//Limite de e-mails 5 a cada 10 segundos
$limite = 5; 
$i = 1;
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_moderador = $ln2->ID;
	$name_moderador = $ln2->NOME;  
	$email_moderador = $ln2->EMAIL;
	
	$mail->addAddress($email_moderador, $name_moderador);
    
	if($i == $limite) { 
		sleep(10); //Pausando o script por 10 segundos 
		$i = 0; //Setando o $i = 0, para recomeçar.
	}
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email_moderador) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	$i++; //Aumentando o $i
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
                        <li class="active">Parcelar</li>
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


<!-- BANNER --> 		
<div class="alert alert-danger alert-dismissable">
	<i class="fa fa-ban"></i>
	<H2>Sua Compra e Parcelamento foi CANCELADA</H2>  
	<br> 
	Por que voc&ecirc; desistiu de efetuar a compra e parcelamento de seu pacote de produto da empresa TALK FUSOON ?
	<br>
	<b style="color:red;font-size:30px;"> Ainda com D&uacute;vidas ? </b> acesse nosso F&Oacute;RUM e fa&ccedil;a sua pergunta criando um t&oacute;pico 
		<a class="login_talk" href="../forum/talk_fusion_tutoriais.php" title="Tire Todas Suas Duvidas no For&uacute;m Da ComunidadeMultiN&iacute;vel" target="_blank"> 
			<img  src="img/logo_forum_comunidademultinivel.png" width="60" height="60" alt="For&uacute;m da ComunidadeMultiN&iacute;vel"  /> 
		</a> 
		<br> 
</div> 
<br><br>
 
  
<div class="callout callout-info">
<p>Parcelamento dos Pacotes de produtos da talk fusion</p>
  
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="2VHAN4C9PDA6Y">
<table>
<tr><td><input type="hidden" name="on0" value="Selecione o pacote Desejado">Selecione o pacote Desejado</td></tr><tr><td><select name="os0">
	<option value="EXECUTIVO">EXECUTIVO R$2.100,00</option>
	<option value="ELITE">ELITE R$5.400,00</option>
	<option value="PROPAK">PROPAK R$10.500,00</option>
</select> </td></tr>
</table>
<input type="hidden" name="currency_code" value="BRL">
<input type="image" src="https://www.paypalobjects.com/pt_BR/BR/i/btn/btn_buynowCC_LG.gif" border="0" name="submit" alt="PayPal - A maneira fácil e segura de enviar pagamentos online!">
<img alt="" border="0" src="https://www.paypalobjects.com/pt_BR/i/scr/pixel.gif" width="1" height="1">
</form>



 
<br>
<i>Nos Valores j&aacute; est&atilde;o inclusos; </i> <br>
<i>Valor dos Produto aderido + Primeria Mensalidade + ades&atilde;o de associado da TALK FUSION </i> <br>
<i>+ Taxas e juros de parcelamento do PayPal. </i> <br>
<i>+ Taxa de IOF (Compras Internacionais).</i> <br>
<i>+ declara&ccedil;&atilde;o de imposto de renda da Comunidade MultiN&iacute;vel.</i> <br>
<br><br>
 <div class="alert alert-warning alert-dismissable">
	<i class="fa fa-warning"></i>
	<h4 class="box-title">Procedimentos ap&oacute;s sua compra</h4>
	Ap&oacute;s voc&ecirc; efetuar a compra do seu pacote de produtos da empresa TALK FUSION, utilizando o parcelamento via PAYPAL da Comunidade MultiN&iacute;vel, a solicita&ccedil;&atilde;o de sua compra ficar&aacute; PENDENTE at&eacute; que o procedimento de seguran&ccedil;a do PAYPAL liberar todo o dinheiro do seu parcelamento para a Comunidade MultiN&iacute;vel, ap&oacute;s o dinheiro estar completamente pronto para ser usado, os moderadores do site da Comunidade MultiN&iacute;vel ir&atilde;o entrar em contato com voc&ecirc;, para completar os procedimentos e cadastra-lo(a) no site da TALK FUSION como distribuidor da empresa com o pacote de produto que voc&ecirc; efetuou a compra.
	<br><br>
	<b>Os procedimentos ser&atilde;o completados de 6 a 10 dias &uacute;teis</b>
</div>
  
</div> 




	<div class="box-header">
		<h3 class="box-title">Suas Compras PENDENTES</h3>
    </div><!-- /.box-header --> 
		 
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr>
						<th>DATA da Compra</th>   
						<th>Status</th> 
						<th>Andamento</th>
					</tr>
				</thead>
<?php
	$sql = $con->prepare("SELECT * FROM $tabela12 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'PENDENTE'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$total_result = count( $res );   
	foreach($res as $ln_verifc) {  
		$parcela_status = $ln_verifc->STATUS;
		$parcela_descricao = $ln_verifc->DESCRICAO;
		$data_parcela = $ln_verifc->DATA_CADASTRO;
		$data_parcela = implode("/",array_reverse(explode("-",$data_parcela)));  
?>
				<thead>
					<tr style="background:#fffede; color:red;">
						<th><?php echo $data_parcela; ?> </th> 
						<th><?php echo $parcela_status; ?></th> 
						<th><?php echo $parcela_descricao; ?></th>  
					</tr>
				</thead> 
<?php 
	} 
?> 
			</table>
<?php if ($total_result <= 0) { ?>
	<i style='color:red;'>No momento voc&ecirc; n&atilde;o possu&iacute; nenhuma compra PENDENTE.</i>
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
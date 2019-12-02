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

 

// voce ja esta cadastrado na TrafficMonsoon
	$sql_verifc = $con->prepare("SELECT * FROM $tabela22 WHERE ID_CLIENTE = '$id_cliente'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$cliente_existe = count( $res_verifc );
		foreach($res_verifc as $ln_clientes) {
			$id_trafficmonsoon_cliente = $ln_clientes->ID_CLIENTE; 
			$status_trafficmonsoon = $ln_clientes->STATUS; 		
			$data_trafficmonsoon = $ln_clientes->DATA_CADASTRO;
			$data = implode("/",array_reverse(explode("-",$data_trafficmonsoon))); 
		}
		
	if ($cliente_existe <= 0) {
		$dia = date('Y-m-d');
		$status = "PENDENTE";
		// grava cadastro pentende
		$run = $con->prepare("INSERT INTO $tabela22 (ID_CLIENTE, STATUS, DATA_CADASTRO) VALUES (:ID_CLIENTE, :STATUS, :DATA_CADASTRO)");
		$dados = array(':ID_CLIENTE' => $id_cliente, ':STATUS' => $status, ':DATA_CADASTRO' => $dia);
		$cadastra = $run->execute($dados);
		
// enviando email para os moderadores ------------------------------- 

// busca dados do cliente
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
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
  
	// patrocinador do cliente que esta solicitando
	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador'");
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res3 as $ln3) { 
		$name_patrocinador = $ln3->NOME;  
		$email_patrocinador = $ln3->EMAIL;
	} 

date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 



 // ENVIANDO EMAIL PARA OS MODERADORES
$body = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel.
			<br><br> 
			<i style='color:red;'>Um Afiliado(a), Solicitou o cadastro na TrafficMonsoon.</i>
			<br>
			Entre em contato com o Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, seu suporte ser&aacute; importante. <br>
			<br><br>
			<b style='color:red;'>Dados do Afiliado</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_do_cliente' title='Estando logado na Comunidade, acesse o perfil desse afiliado'> $id_do_cliente </a><br>
			<b>NOME :</b> $nomecliente<br>
			<b>Telefone :</b> $telcliente<br>
			<b>Celular :</b> $celcliente<br>
			<b>Facebook :</b> $facecliente<br>
			<b>Skype :</b> $skypecliente<br>
			<b>E-Mail :</b> $emailcliente<br>
			<br>
			<b style='color:red;'>Dados do Patrocinador do $nomecliente</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_patrocinador' title='Estando logado na Comunidade, acesse o perfil desse afiliado'>$id_patrocinador</a><br>
			<b>NOME :</b> $name_patrocinador<br>
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

$mail->Subject = "Um Afiliado Solicitou o cadastro na TrafficMonsoon";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel.
			 
			Um Afiliado(a), Solicitou o cadastro na TrafficMonsoon.
			 
			Entre em contato com o Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, seu suporte ser&aacute; importante. 
			 
			 Dados do Afiliado 
			 ID : $id_do_cliente  
			 NOME :  $nomecliente 
			 Telefone :  $telcliente 
			 Celular :  $celcliente 
			 Facebook :  $facecliente 
			 Skype :  $skypecliente
			 E-Mail :  $emailcliente 
			 
			Dados do Patrocinador do $nomecliente 
			ID :$id_patrocinador 
			NOME : $name_patrocinador 
			  
			 
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
 

// enviando email para o cliente
$body = "
			Ol&aacute; <b>$nomecliente</b>.
			<br><br> 
			<i style='color:red;'>Mantenha sua Participa&ccedil;&atilde;o diariamente, para que voc&ecirc; tenha maiores possibilidades de ser financiado com o pacote da empresa Talk Fusion, no valor de U$ 324,00 d&oacute;lares, e tamb&eacute;m para nos ajudar a obter maiores rendimentos, proporcionando maiores quantidades de pessoas financiadas.</i>
			<br>
			A sua participa&ccedil;&atilde;o &eacute; nossa maior for&ccedil;a, precisamos da responsabilidade e do empenho de seu trabalho conosco. 
			<br><br>
			<b style='color:red;'>Veja aqui, como voc&ecirc; e todos seus indicados diretos e indiretos podem alavancar suas chances de garantir seus pacotes nas premia&ccedil;&otilde;es.</b> <br>
			<b>Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e no menu esquerdo clique em 'Dicas Di&aacute;rias' e depois em 'TrafficMonsoon', para entender como alavancar suas pontua&ccedil;&otilde;es e ajudarmos a obter maiores rendimentos, proporcionando maiores quantidades de pessoas financiadas <a href='http://www.comunidademultinivel.com.br/adm_clientes/trafficmonsoon.php' title='Estando logado na Comunidade, Voc&ecirc; poder&aacute; participar do f&oacute;rum'> Clique nesse LINK para entender maiores detalhes (para acessar esse link, esteja logado na Comunidade) </a></b> <br>
			 
			<br><br>
			<table style='width:40%;'>
				<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
			</table>
			<br><br>
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

$mail->Subject = "Sua Solicitacao de ativacao do registro na TrafficMonsoon esta sendo analisada pela Comunidade MultiNivel";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute; $nomecliente.
			
			Mantenha sua Participa&ccedil;&atilde;o diariamente, para que voc&ecirc; tenha maiores possibilidades de ser financiado com o pacote da empresa Talk Fusion, no valor de U$ 324,00 d&oacute;lares, e tamb&eacute;m para nos ajudar a obter maiores rendimentos, proporcionando maiores quantidades de pessoas financiadas.
			 
			A sua participa&ccedil;&atilde;o &eacute; nossa maior for&ccedil;a, precisamos da responsabilidade e do empenho de seu trabalho conosco. 
			
			Veja aqui, como voc&ecirc; e todos seus indicados diretos e indiretos podem alavancar suas chances de garantir seus pacotes nas premia&ccedil;&otilde;es. 
			Clique nesse LINK para entender maiores detalhes '#### coloca o link aq ####'
			 
			http://www.comunidademultinivel.com.br/forum
			https://www.facebook.com/ComunidadeMultiNivel
			http://goo.gl/4zDgYr
			http://www.comunidademultinivel.com.br/
			
			N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel.		
			
			Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.
			www.comunidademultinivel.com.br
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o. 
";
 

$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente' AND MODERADORES <> 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
 
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_cliente = $ln2->ID;
	$name_cliente = $ln2->NOME;  
	$email_cliente = $ln2->EMAIL;
	
	$mail->addAddress($email_cliente, $name_cliente);
    
 
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
        break; //Abandon sending
    } else {
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
  
	} else if($status_trafficmonsoon == "ATIVO") {
		echo("<script type='text/javascript'> alert('Voc\u00ea j\u00e1 esta cadastrado e ativado em nossa equipe na TrafficMonsoon, Mantenha sua participa\u00e7\u00e3o diariamente.'); location.href='trafficmonsoon.php';</script>");
		exit;
	} else if ($status_trafficmonsoon == "PENDENTE") {
		echo("<script type='text/javascript'> alert('Estamos aguardando voc\u00ea efetuar seu cadastro na TrafficMonsoon CORRETAMENTE. Ap\u00f3s efetuar seu cadastro corretamente, aguarde os administradores da Comunidade MultiN\u00edvel aprova-lo(a), Mantenha sua participa\u00e7\u00e3o diariamente. Caso voc\u00ea ainda n\u00e3o tenha se cadastrado, Cadastre-se agora mesmo!');</script>");
		 
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
                        <li class="active">Cadastre-se na TrafficMonsoon <a target="_blank" href="https://trafficmonsoon.com/?ref=ComunidadeMN" title="LINK de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel">trafficmonsoon.com/?ref=ComunidadeMN</a></li>
                    </ol>
                </section>
 	
                <!-- Main content -->
                <section class="content">
<div class="box-header">
		<h3 class="box-title">Cadastre-se na TrafficMonsoon atrav&eacute;s desse LINK de Indica&ccedil;&atilde;o: <a target="_blank" href="https://trafficmonsoon.com/?ref=ComunidadeMN" title="LINK de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel">trafficmonsoon.com/?ref=ComunidadeMN</a></h3>
    </div><!-- /.box-header -->
				
				<BR>
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
  <style type="text/css">
    iframe {display:block; width:100%;  border:none;overflow:auto;}
   
</style>
<!-- centro -->	
<BR> 
<div class="box box-primary">

<div class="callout callout-warning"> 
		<h3 STYLE="color:RED;">&Eacute; IMPORTANTE QUE VOC&Ecirc; PRESTE BASTANTE ATEN&Ccedil;&Atilde;O NA HORA DO SEU CADASTRO</h3>
		<h3>Veja o Video abaixo os procedimentos de cadastro na TrafficMonsoon</h3>
		<div style="text-align:center;">
			<iframe width="640" height="480" src="https://www.youtube.com/embed/rps5MrYrLGA?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
	 <br> 
	 <i style="color:red;">DICAS E AVISOS NA HORA DO SEU CADASTRO</i> <br>
	 <b>- Ao se cadastrar na TrafficMonsoon, voc&ecirc; ter&aacute; que usar um email do GMAIL ou Yahoo, o sistema da TrafficMonsoon s&oacute; ir&aacute; funcionar corretamente com e-mails do GMAIL ou Yahoo, portanto se voc&ecirc; n&atilde;o possuir uma conta em uns desses dois servidores de e-mails, cadastre-se agora mesmo &eacute; bem f&aacute;cil e r&aacute;pido.  </b><br><br>
	 
	 <b>- Certifique-se de que voc&ecirc; realmente esteja sendo cadastrado pelo LINK de indica&ccedil;&atilde;o da Comunidade MultiN&iacute;vel, na p&aacute;gina de cadastro veja se realmente est&aacute; aparecendo a mensagem com o nome do mentor do site da Comunidade MultiN&iacute;vel <I  style="color:blue;">"Your enroller's name is Wlader Murilo Alexandro"</I>. SOMENTE CADASTRADOS NA INDICA&Ccedil;&Atilde;O DIRETA DA COMUNIDADE MULTIN&Iacute;VEL SER&Atilde;O ACEITOS E VALIDADOS.  </b><br><br>
	 
	 <b>- Nunca tente criar mais de uma conta por IP ou por resid&ecirc;ncia, cada resid&ecirc;ncia deve possuir apenas 1 conta na TrafficMonsoon. O sistema da TrafficMonsoon &eacute; totalmente  rigoroso, caso contr&aacute;rio voc&ecirc; correr&aacute; grandes risco de perde suas contas.  </b><br><br>
	 
	 <b style="color:red;">- Caso voc&ecirc; tenha dificuldades de efetuar seu cadastro na empresa de publicidade TrafficMonsoon,</B> <a STYLE="font-size:30px;" target="_blank" href="http://www.comunidademultinivel.com.br/forum/topico/16-Como-Cadastrar-na-empresa-de-publicidade-TrafficMonsoon-CORRETAMENTE" title="CADASTRE-SE CORRETAMENTE"> CLIQUE AQUI </a> <B style="color:red;">e siga o passo a passo do artigo explicativo de como se cadastrar CORRETAMENTE. </B><br><br>
	 
	</div> 

<BR><BR>
<iframe width='100%' height='100%' frameborder='0'  src='https://trafficmonsoon.com/?ref=ComunidadeMN'></iframe>  
  


	 
	
	
	
		 
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
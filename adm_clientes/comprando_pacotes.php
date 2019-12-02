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

 
$dia = date('Y-m-d');
$vencimento = date('Y-m-d', strtotime("+5 days"));
$id_posicao = $_POST["id_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];
$status = "PENDENTE";
 
 
$sql2 = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = $id_posicao");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$status_verifica = $ln2->STATUS; 
	
}

 if ($status_verifica != "DESATIVADO") {
	echo("<script type='text/javascript'> alert('Essa posi\u00e7\u00e3o j\u00e1 foi comprada, Por Favor escolha outra posi\u00e7\u00e3o !!!'); location.href='rede_talk.php';</script>");
	exit;
 } else {
	// alterar dados da posicao na rede da talk
	$altera = "UPDATE $tabela7 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO=?, DATA_VENCIMENTO=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($id_do_cliente,$status,$dia,$vencimento,$id_posicao));
}

  

// enviando email para os moderadores ------------------------------- 

// busca dados do cliente
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_do_cliente");
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
			<i style='color:red;'>Um Afiliado(a), Solicitou a COMPRA de uma posi&ccedil;&atilde;o($id_posicao) na REDE PRINCIPAL da TALK FUSION.</i>
			<br>
			Entre em contato com o Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, sua participa&ccedil;&atilde;o ser&aacute; importante. <br>
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
			<b style='color:red;'>Dados da Posi&ccedil;&atilde;o Solicitada</b> <br>
			<b>Posi&ccedil;&atilde;o de N&uacute;mero:</b> $id_posicao<br> 
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

$mail->Subject = "Um Afiliado Solicitou a compra da Posicao $id_posicao";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel.
			 
			 Um Afiliado(a), Solicitou a COMPRA de uma posi&ccedil;&atilde;o($id_posicao) na REDE PRINCIPAL da TALK FUSION. 
			 
			Entre em contato com o Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, sua participa&ccedil;&atilde;o ser&aacute; importante. 
			 
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
			 
			 Dados da Posi&ccedil;&atilde;o Solicitada
			 Posi&ccedil;&atilde;o de N&uacute;mero:  $id_posicao 
			 
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




// enviando email para o patrocinador do cliente
$body = "
			Ol&aacute; <b>$name_patrocinador</b>.
			<br><br> 
			<i style='color:red;'>Um Afiliado(a) seu da ComunidadeMultiN&iacute;vel, Solicitou a COMPRA de uma posi&ccedil;&atilde;o($id_posicao) na REDE PRINCIPAL da TALK FUSION.</i>
			<br>
			Entre em contato com seu Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, sua participa&ccedil;&atilde;o ser&aacute; importante. <br>
			Os moderadores da ComunidadeMultiN&iacute;vel tamb&eacute;m v&atilde;o lhe ajudar e colocar seu afiliado na posi&ccedil;&atilde;o vaga mais pr&oacute;xima abaixo de voc&ecirc;<br>
			Caso, voc&ecirc; ainda n&atilde;o esteja em nossa REDE PRINCIPAL, seu afiliado entrar&aacute; na rede abaixo de uns de seus UP-LINES (N&atilde;o Perca mais tempo e dinheiro, entre voc&ecirc; tamb&eacute;m para nossa REDE PRINCIPAL e iremos aconselhar todos seus afiliados da ComunidadeMultiN&iacute;vel entrar abaixo de voc&ecirc;).
			<br><br>
			<b style='color:red;'>Dados do seu Afiliado</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_do_cliente' title='Estando logado na Comunidade, acesse o perfil desse afiliado'> $id_do_cliente </a><br>
			<b>NOME :</b> $nomecliente<br>
			<b>Telefone :</b> $telcliente<br>
			<b>Celular :</b> $celcliente<br>
			<b>Facebook :</b> $facecliente<br>
			<b>Skype :</b> $skypecliente<br>
			<b>E-Mail :</b> $emailcliente<br>
			<br>  
			<b style='color:red;'>Dados da Posi&ccedil;&atilde;o Solicitada</b> <br>
			<b>Posi&ccedil;&atilde;o de N&uacute;mero:</b> $id_posicao<br> 
			<br><br>
			<table style='width:40%;'>
				<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logo-icone-comunidade-multinivel.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
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

$mail->Subject = "Seu Afiliado Solicitou a compra da Posicao $id_posicao";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute; $name_patrocinador.
			 
			 Um Afiliado(a) seu da ComunidadeMultiN&iacute;vel, Solicitou a COMPRA de uma posi&ccedil;&atilde;o($id_posicao) na REDE PRINCIPAL da TALK FUSION.
			 
			Entre em contato com seu Afiliado, para auxili&aacute;-lo com os procedimentos corretamente, sua participa&ccedil;&atilde;o ser&aacute; importante.  
			Os moderadores da ComunidadeMultiN&iacute;vel tamb&eacute;m v&atilde;o lhe ajudar e colocar seu afiliado na posi&ccedil;&atilde;o vaga mais pr&oacute;xima abaixo de voc&ecirc; 
			Caso, voc&ecirc; ainda n&atilde;o esteja em nossa REDE PRINCIPAL, seu afiliado entrar&aacute; na rede abaixo de uns de seus UP-LINES (N&atilde;o Perca mais tempo e dinheiro, entre voc&ecirc; tamb&eacute;m para nossa REDE PRINCIPAL e iremos aconselhar todos seus afiliados da ComunidadeMultiN&iacute;vel entrar abaixo de voc&ecirc;).
			 
			Dados do seu Afiliado
			ID :$id_do_cliente  
			 NOME : $nomecliente 
			 Telefone : $telcliente 
			 Celular : $celcliente 
			 Facebook :  $facecliente 
			 Skype :  $skypecliente 
			 E-Mail :  $emailcliente 
			 
			 Dados da Posi&ccedil;&atilde;o Solicitada 
			 Posi&ccedil;&atilde;o de N&uacute;mero:  $id_posicao
			 
			 http://www.comunidademultinivel.com.br/forum
			https://www.facebook.com/ComunidadeMultiNivel
			http://goo.gl/4zDgYr
			http://www.comunidademultinivel.com.br/
			 
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 		
			 
			 Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 

$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador' AND MODERADORES <> 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
 
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_patrocinador = $ln2->ID;
	$name_patrocinador = $ln2->NOME;  
	$email_patrocinador = $ln2->EMAIL;
	
	$mail->addAddress($email_patrocinador, $name_patrocinador);
    
 
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
		echo("<script type='text/javascript'> alert('COMPRA REGISTRADA no SISTEMA, continue seguindo os pr\u00f3ximos procedimentos para COMPLETAR SUA COMPRA !!! OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS, log: $erro'); location.href='posicao.php?info=$id_posicao';</script>");
		
        break; //Abandon sending 
		exit;
    } else {
		echo("<script type='text/javascript'> alert('COMPRA REGISTRADA no SISTEMA, continue seguindo os pr\u00f3ximos procedimentos para COMPLETAR SUA COMPRA !!!'); location.href='posicao.php?info=$id_posicao';</script>");	
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
 
  echo("<script type='text/javascript'> alert('COMPRA REGISTRADA no SISTEMA, continue seguindo os pr\u00f3ximos procedimentos para COMPLETAR SUA COMPRA !!!'); location.href='posicao.php?info=$id_posicao';</script>");	
  exit;
?>

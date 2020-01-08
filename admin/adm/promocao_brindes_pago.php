<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_adm = $_SESSION['ID'];

if ($id_adm == "" || $id_adm == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}

$id_promocao = $_POST["id_promocao"];
$id_do_cliente = $_POST["id_do_cliente"];
$qts_adpacks_comprados = $_POST["qts_adpacks_comprados"]; 
$qts_adpacks_brindes = $_POST["qts_adpacks_brindes"]; 
$status = "PAGO";

// busca dados da troca
$sql2 = $con->prepare("SELECT * FROM $tabela25 WHERE ID = '$id_promocao'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$troca_status = $ln2->STATUS;
	$troca_data = $ln2->DATA;  
	$troca_data = implode("/",array_reverse(explode("-",$troca_data)));
}
 
  
 // altera para PAGO
	$altera = "UPDATE $tabela25 SET STATUS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($status,$id_promocao));
 

  // enviando email para o cliente    
 
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
	$moderadorcliente = $ln2->MODERADORES;
}

 
// busca email do server
$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
}  
date_default_timezone_set('Etc/UTC'); 
require '../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
  
$body = "
			Ol&aacute; <b>$nomecliente</b>.
			<br><br> 
			<i style='color:red;'>Os Moderadores da ComunidadeMultiN&iacute;vel conclu&iacute;ram o FINANCIAMENTO de <b style='color:red;'> $qts_adpacks_brindes </b> ADPack(s) com posicionamento(s) de lucro da empresa TrafficMonsoon.</i>
			<br><br> 
			Parab&eacute;ns!<br>
			- Continue participando das promo&ccedil;&otilde;es da ComunidadeMultiN&iacute;vel e consequentemente aumentando seus rendimentos financeiros.
			<br> <br> 
			Agradecemos sua participa&ccedil;&atilde;o.
			<br>
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
			<b style='color:red;'>Atenciosamente, ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. <br> 
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

$mail->Subject = "Voce foi FINANCIADO com $qts_adpacks_brindes ADPacks na empresa TrafficMonsoon !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute;  $nomecliente.
			  
			 
			 Os Moderadores da ComunidadeMultiN&iacute;vel conclu&iacute;ram o FINANCIAMENTO de  $qts_adpacks_brindes  ADPack(s) com posicionamento(s) de lucro da empresa TrafficMonsoon. 
			 
			Parab&eacute;ns! 
			- Continue participando das promo&ccedil;&otilde;es da ComunidadeMultiN&iacute;vel e consequentemente aumentando seus rendimentos financeiros.
		 
			Agradecemos sua participa&ccedil;&atilde;o.
			 
			 http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
			 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
			 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
			 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
			 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
			 
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 	
			 
			 Atenciosamente, ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
 
 
	$mail->addAddress($emailcliente, $nomecliente);
    
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
        break; //Abandon sending
		echo "<script type='text/javascript'> alert('BRINDE conclu\u00eddo com sucesso, ERRO ao enviar um email LOG: $erro !!!'); location.href='promocao_premiados_pendentes_brindes.php';</script>";
		exit;
    } else {
		echo "<script type='text/javascript'> alert('BRINDE conclu\u00eddo com sucesso !!!'); location.href='promocao_premiados_pendentes_brindes.php';</script>";
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
 
?>


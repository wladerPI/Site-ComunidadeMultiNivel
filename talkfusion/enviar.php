<?php
 include("../config/config.php");
 
 
$name = $_POST["name"]; // vai ler e pegar o que o internauta digitou no campo NOME
$website = $_POST["website"]; // vai ler e pegar o que o internauta digitou no campo Sobrenome
$email = $_POST["email"]; // vai ler e pegar o que o internauta digitou no campo EMAIL
$message = $_POST["message"]; // vai ler e pegar o que o internauta digitou no campo MENSAGEM 


 // ENVIANDO EMAIL PARA O PATROCINADOR
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
		Nome: $name <br>
		Site: $website <br>
		E-mail: $email <br><br>
		$message
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

$mail->Subject = "CONTATO !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = " 
		Nome: $name  
		Site: $website  
		E-mail: $email  
		$message
";
  
   
	$mail->addAddress($seuemail, $name);
   
    if (!$mail->send()) {
		$erro = $mail->ErrorInfo; 
		echo "<script type='text/javascript'> alert('Falha no envio do E-Mail, contate de outra forma, por favor! log: $erro'); location.href='contato';</script>";	 
        break; //Abandon sending
		exit;
    } else {
		echo "<script type='text/javascript'> alert('Contato Enviado com Sucesso!'); location.href='contato';</script>";  
		exit;
    } 
// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();				
 
 
?>


<?php
	include("../config/config.php"); 
	
	$email = $_POST['solicit_senha']; // vai ler e pegar o que o internauta digitou no campo EMAIL 
	// Agora vamos fazer com que o formulário seja enviado com as informações que o internauta digitou nos campos que verificamos.
	 
	
try {
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE EMAIL = '$email'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$total = count( $res );
	foreach($res as $ln) { 
		$senha = $ln->SENHA; 
		$nome = $ln->NOME; 
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 
 
if ($total <= 0) {
	echo "<script type='text/javascript'> alert('Esse email n\u00e3o est\u00e1 registrado no sistema !!!'); location.href='solicitar_senha';</script>";
	exit;
}
 
 
  
 
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
		ol&aacute; <b>$nome  </b>
		 <br><br>
		<i>Veja Abaixo sua Senha do site Comunidade MultiN&iacute;vel </i>
		  <br><br>
		Sua Senha &eacute;: <b style='color:red;'>$senha</b>  
		<br><br> 
		Para maiores Informa&ccedil;&otilde;es Acesse sua &aacute;rea restrita, que se encontra no topo do site. 
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
		<hr>
		<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>
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

$mail->Subject = "Comunidade MultiNivel: Recuperando Senha !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = " 
		ol&aacute; $nome   
		 
		 Veja Abaixo sua Senha do site Comunidade MultiN&iacute;vel  
		 
		Sua Senha &eacute;: $senha 
		 
		Para maiores Informa&ccedil;&otilde;es Acesse sua &aacute;rea restrita, que se encontra no topo do site. 
		 
			http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum
			 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel
			 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel
			 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel
			 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
		
		
		 Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  
		 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
  
   
	$mail->addAddress($email, $name);
   
    if (!$mail->send()) {
		$erro = $mail->ErrorInfo; 
		echo "<script type='text/javascript'> alert('Falha no envio do E-Mail, contate de outra forma, por favor! log: $erro'); location.href='contato';</script>";	 
        break; //Abandon sending
		exit;
    } else {
		echo "<script type='text/javascript'> alert('Veja sua sehna em seu email!'); location.href='contato';</script>";  
		exit;
    } 
// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();				
  
   
?>

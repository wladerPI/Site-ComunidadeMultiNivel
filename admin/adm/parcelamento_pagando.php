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
 
  $id_parcelamento = $_POST["id_parcelamento"];
  $id_do_cliente = $_POST["id_do_cliente"];
  $status = "ATIVO";
  $descricao = "Parcelamento efetuado com sucesso";
 
$sql2 = $con->prepare("SELECT * FROM $tabela12 WHERE ID = '$id_parcelamento'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$empresa = $ln2->EMPRESA;  
}
 
 
 // ativando parcelamento no BD
	$altera = "UPDATE $tabela12 SET STATUS=?, DESCRICAO=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($status,$descricao,$id_parcelamento));
 
 // envia email para o cliente
 // busca email do server
$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
 
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_do_cliente'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
}
 
	  
date_default_timezone_set('Etc/UTC'); 
require '../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 



 // ENVIANDO EMAIL PARA OS clientes
$body = "
		ol&aacute; <b>$name  </b>, os moderadores da ComunidadeMultiN&iacute;vel, Completaram sua compra e parcelamento do pacote de produtos da empresa $empresa.
		<br> <br> 
		<i>Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil&atilde;o para efetuar o parcelamento para todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe.  </i>
		<br> <br>  	
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como funciona todo nosso projeto.
		<br><br>
		<i>Esse email foi enviado autom&aacute;ticamente, devido a confirma&ccedil&atilde;o do parcelamento de seu pacote de produtos e ades&atilde;o da empresa $empresa. </i>
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

$mail->Subject = "Sua Solicitacao de PARCELAMENTO em ate 12x, para entrar na empresa $empresa foi COMPLETADA";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute;  $name   , os moderadores da ComunidadeMultiN&iacute;vel, Completaram sua compra e parcelamento do pacote de produtos da empresa $empresa.
		  
		 Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil&atilde;o para efetuar o parcelamento para todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe.   
		  	
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como funciona todo nosso projeto.
		 
		 Esse email foi enviado autom&aacute;ticamente, devido a confirma&ccedil&atilde;o do parcelamento de seu pacote de produtos e ades&atilde;o da empresa $empresa.  
		 
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
		echo("<script type='text/javascript'> alert('Confirmado com SUCESSO, OCORREU UM ERRO AO ENVIAR UM E-MAIL !!!'); location.href='parcelamentos.php';</script>");
        break; //Abandon sending
		exit;
    } else {
		echo("<script type='text/javascript'> alert('Confirmado com SUCESSO !!! '); location.href='parcelamentos.php';</script>");
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
?>
 
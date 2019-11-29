<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
 
$id_cliente_respondendo = $_POST["id_cliente_respondendo"];
$id_topico = $_POST["id_topico"];
$id_cliente_criador = $_POST["id_cliente_criador"];
$categoria = $_POST["categoria"]; 
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d');
$url =  $_POST["url"];

if ($editor1 == "") {
	echo("<script type='text/javascript'> alert('O Campo da resposta \u00e9 obrigat\u00f3rio  !!!'); location.href='$url';</script>");
	exit;
}
  
$run = $con->prepare("INSERT INTO $tabela11 (ID_CLIENTE, ID_TOPICO, CATEGORIA, TEXTO_TOPICO, DATA_TOPICO) VALUES (:ID_CLIENTE, :ID_TOPICO, :CATEGORIA, :TEXTO_TOPICO, :DATA_TOPICO)");
$dados = array(':ID_CLIENTE' => $id_cliente_respondendo, ':ID_TOPICO' => $id_topico, ':CATEGORIA' => $categoria, ':TEXTO_TOPICO' => $editor1, ':DATA_TOPICO' => $dia);
$cadastra = $run->execute($dados);
 

 
  $sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 

$sql = $con->prepare("SELECT * FROM $tabela10 WHERE ID = '$id_topico'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$titulo = $ln->TITULO_TOPICO;
	$id_criador_do_topico = $ln->ID_CLIENTE;
} 

 
 $str = $titulo; 
 include_once "../funcao_url.php"; 
 $url = $id_topico."-".RemoveAcentos($str);

	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente_criador'");
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res3 as $ln3) { 
		$name_res = $ln3->NOME;  
		$email_res = $ln3->EMAIL;
	} 

date_default_timezone_set('Etc/UTC'); 
require '../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 


if ($categoria == "BLOG") {
 // envia email para todos moderadores
$body = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel, uma resposta foi enviada no t&oacute;pico: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a> !!!<br><br>
			 
			<i>O Afiliado(a) (<b>$name_res</b>) enviou uma resposta no F&Oacute;RUM/BLOG da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. </i> <br>
			<br>
			Acesse esse link para ver o conte&uacute;do: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a>
			<br>
			<i>Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			<br><br>
			<b>N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel.</b>		
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

$mail->Subject = "FORUM/BLOG: Resposta Enviada: $titulo";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiNivel, uma resposta foi enviada no topico: $titulo  !!! 
			 
			O Afiliado(a) ($name_res) enviou uma resposta no FORUM/BLOG da ComunidadeMultiNi;vel, sua participacao sera importante. 
			<br>
			Acesse esse link para ver o conteudo: $titulo 
			 
			 Caso o LINK esteja inacessivel Copie e cole da barra de endereco: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			 
			Nao responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiNivel. 		
			 
			Atenciosamente a sua ComunidadeMultiNivel. Juntos Somos Mais Fortes.  
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Esta em Nossa Uniao.   
";

 
 // ENVIANDO EMAIL PARA O PATROCINADOR
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
//Limite de e-mails 5 a cada 10 segundos
$limite = 5; 
$i = 1;
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_moderador = $ln2->ID;
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
	
	$mail->addAddress($email, $name);
    
	if($i == $limite) { 
		sleep(10); //Pausando o script por 10 segundos 
		$i = 0; //Setando o $i = 0, para recomeçar.
	}
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	$i++; //Aumentando o $i
} 
 echo ("<script type='text/javascript'> alert('Sua Resposta foi Enviada com sucesso !!!'); location.href='$url';</script>");
 exit;
 


} else {
 // envia email para moderadores e para quem criou o topico
 
$body = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel, uma resposta foi enviada no t&oacute;pico: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a> !!!<br><br>
			 
			<i>O Afiliado(a) (<b>$name_res</b>) enviou uma resposta no F&Oacute;RUM/$categoria da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. </i> <br>
			<br>
			Acesse esse link para ver o conte&uacute;do: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a>
			<br>
			<i>Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			<br><br>
			<b>N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel.</b>		
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

$mail->Subject = "FORUM/$categoria: Resposta Enviada: $titulo";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiNivel, uma resposta foi enviada no topico: $titulo  !!! 
			 
			O Afiliado(a) ($name_res) enviou uma resposta no FORUM/$categoria da ComunidadeMultiNi;vel, sua participacao sera importante. 
			<br>
			Acesse esse link para ver o conteudo: $titulo 
			 
			 Caso o LINK esteja inacessivel Copie e cole da barra de endereco: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			 
			Nao responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiNivel. 		
			 
			Atenciosamente a sua ComunidadeMultiNivel. Juntos Somos Mais Fortes.  
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Esta em Nossa Uniao.   
";

 
 // ENVIANDO EMAIL PARA O moderadores
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
//Limite de e-mails 5 a cada 10 segundos
$limite = 5; 
$i = 1;
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_moderador = $ln2->ID;
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
	
	$mail->addAddress($email, $name);
    
	if($i == $limite) { 
		sleep(10); //Pausando o script por 10 segundos 
		$i = 0; //Setando o $i = 0, para recomeçar.
	}
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	$i++; //Aumentando o $i
} 

// ENVIANDO EMAIL PARA O quem criou o topico

$body = "
			Prezado Afiliado da ComunidadeMultiN&iacute;vel, uma resposta foi enviada no t&oacute;pico que voc&ecirc; criou: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a> !!!<br><br>
			 
			<i>O Afiliado(a) (<b>$name_res</b>) enviou uma resposta no F&Oacute;RUM/$categoria da ComunidadeMultiN&iacute;vel, obrigado por sua participa&ccedil;&atilde;o. </i> <br>
			<br>
			Acesse esse link para ver o conte&uacute;do: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a>
			<br>
			<i>Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			<br><br>
			<b>N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel,</b> caso tenha alguma d&uacute;vida pergunte criando um t&oacute;pico no F&oacute;rum.		
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
			<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. <br> 
			<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>   <br>
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b> <br>
 ";
 $mail->msgHTML($body);
 $mail->AltBody = "
			Prezado Afiliado da ComunidadeMultiNivel, uma resposta foi enviada no topico que voce criou: $titulo !!!
			 
			O Afiliado(a) ($name_res) enviou uma resposta no F&Oacute;RUM/$categoria da ComunidadeMultiNivel, obrigado por sua participacao.  
			
			Acesse esse link para ver o conteudo: $titulo
			
			Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o: http://www.comunidademultinivel.com.br/forum/topico/$url
			
			http://www.comunidademultinivel.com.br/forum
			https://www.facebook.com/ComunidadeMultiNivel
			http://goo.gl/4zDgYr
			http://www.comunidademultinivel.com.br/
			
			
			Nao responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiNivel, caso tenha alguma duvida pergunte criando um topico no Forum.		
			
			Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.
			www.comunidademultinivel.com.br
			O Seu Sucesso Esta em Nossa Uniao. 
";
 
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE MODERADORES = '' AND ID = '$id_criador_do_topico'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);  
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_moderador = $ln2->ID;
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
	
	$mail->addAddress($email, $name);
    
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 

 echo ("<script type='text/javascript'> alert('Sua Resposta foi Enviada com sucesso !!!'); location.href='$url';</script>");
exit;

}
  
  
?>

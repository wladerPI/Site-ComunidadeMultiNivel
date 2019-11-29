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
 
 
$titulo = $_POST["titulo"];
$tags = $_POST["tags"];
$id_cliente_criador = $_POST["id_cliente_criador"];
$categoria = $_POST["categoria"]; 
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d');
$visualizacao =  "0";
$topic_dica =  $_POST["topic_dica"]; 
 
 
  
 if ($titulo == "" || $editor1 == "") {
	echo("<script type='text/javascript'> alert('Os Campos T\u00edtulo e Texto do t\u00f3pico s\u00e3o obrigat\u00f3rios !!!'); location.href='../index.php';</script>");
	exit;
}

$run = $con->prepare("INSERT INTO $tabela10 (ID_CLIENTE, CATEGORIA, DICA, TITULO_TOPICO, TEXTO_TOPICO, TAGS_TOPICO, CONTADOR, DATA_TOPICO) VALUES (:ID_CLIENTE, :CATEGORIA, :DICA, :TITULO_TOPICO, :TEXTO_TOPICO, :TAGS_TOPICO, :CONTADOR, :DATA_TOPICO)");
$dados = array(':ID_CLIENTE' => $id_cliente_criador, ':CATEGORIA' => $categoria, ':DICA' => $topic_dica, ':TITULO_TOPICO' => $titulo, ':TEXTO_TOPICO' => $editor1, ':TAGS_TOPICO' => $tags, ':CONTADOR' => $visualizacao, ':DATA_TOPICO' => $dia);
$cadastra = $run->execute($dados);
 
$id_cad = $con->lastInsertId();
   

$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
 
 $str = $titulo; 
 include_once "funcao_url.php"; 
 $url = $id_cad."-".RemoveAcentos($str);

	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente_criador'");
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res3 as $ln3) { 
		$name_res = $ln3->NOME;  
		$email_res = $ln3->EMAIL;
	} 

date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
$body = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel, um novo t&oacute;pico em nosso F&Oacute;RUM foi postado !!!<br><br>
			 
			<i>O Afiliado(a) (<b>$name_res</b>) Criou um T&Oacute;PICO no F&Oacute;RUM da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. </i> <br>
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

$mail->Subject = "FORUM: TOPICO Criado: $titulo";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel, um novo t&oacute;pico em nosso F&Oacute;RUM foi postado !!! 
			 
			O Afiliado(a) ($name_res) Criou um T&Oacute;PICO no F&Oacute;RUM/BLOG da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. 
			
			Acesse esse link para ver o conte&uacute;do: $titulo 
			
			Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o:  http://www.comunidademultinivel.com.br/forum/topico/$url
			 
			N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel.
			 
			Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
			www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o. 
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
 echo ("<script type='text/javascript'> alert('Seu TOPICO foi criado com sucesso !!!'); location.href='topico/$url';</script>");
 exit;
 
?>
 
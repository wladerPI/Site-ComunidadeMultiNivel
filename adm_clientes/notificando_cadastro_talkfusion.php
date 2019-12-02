<?php
session_start(); 
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
		$id_patrocinador = $ln_verifc->ID_INDICACAO;
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
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

$dia = date('Y-m-d');
$id_upline = $_POST["id_upline"];
$link_upline = $_POST["link_upline"];
$status = "PENDENTE";
$link_principal = "SIM";
 
 // grava solicitação no banco de dados
	$run = $con->prepare("INSERT INTO $tabela26 (ID_CLIENTE, ID_UPLINE, STATUS, LINK_PRINCIPAL, DATA_CADASTRO) VALUES (:ID_CLIENTE, :ID_UPLINE, :STATUS, :LINK_PRINCIPAL, :DATA_CADASTRO)");
	$dados = array(':ID_CLIENTE' => $id_cliente, ':ID_UPLINE' => $id_upline, ':STATUS' => $status, ':LINK_PRINCIPAL' => $link_principal, ':DATA_CADASTRO' => $dia);
	$cadastra = $run->execute($dados);
	
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
  
	// patrocinador do cliente que esta solicitando
	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_upline'");
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res3 as $ln3) { 
		$name_patrocinador = $ln3->NOME;  
		$email_patrocinador = $ln3->EMAIL;
	} 

date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
 
$body = "
			Prezado MODERADOR(a) da ComunidadeMultiN&iacute;vel.
			<br><br> 
			<i style='color:red;'>Um Afiliado(a), Solicitou o cadastro na empresa TALK FUSION.</i>
			<br>
			Entre em contato com esse Afiliado(a), para auxili&aacute;-lo(a) com os procedimentos corretamente. Seu suporte ser&aacute; de grande importancia. <br>
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
			<b style='color:red;'>Dados do UP-LINE que o(a) $nomecliente solicitou o cadastro.</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_upline' title='Estando logado na Comunidade, acesse o perfil desse afiliado(a)'>$id_upline</a><br>
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

$mail->Subject = "Um Afiliado Solicitou o cadastro na TALK FUSION";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR(a) da ComunidadeMultiN&iacute;vel.
			 
			 Um Afiliado(a), Solicitou o cadastro na empresa TALK FUSION. 
			 
			Entre em contato com esse Afiliado(a), para auxili&aacute;-lo(a) com os procedimentos corretamente. Seu suporte ser&aacute; de grande importancia.  
			 
			 Dados do(a) Afiliado(a) 
			 ID :http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_cliente 
			 NOME : $nomecliente 
			 Telefone :  $telcliente 
			 Celular :  $celcliente 
			 Facebook :  $facecliente  
			Skype : $skypecliente  
			 E-Mail :  $emailcliente 
			 
			 Dados do UP-LINE que o(a) $nomecliente solicitou o cadastro. 
			 ID : http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_upline
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
  
				
 // redireciona para o link de indicação
 header("Location: http://$link_upline.talkfusion.com/pt/"); 		
 exit;
?>
  
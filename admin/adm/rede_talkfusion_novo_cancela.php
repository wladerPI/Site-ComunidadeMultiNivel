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
 
  $id_compra = $_POST["id_compra"];
  $id_do_cliente = $_POST["id_do_cliente"];
 
  
 // exclui parcelamento do BD
	$count= $con->prepare("DELETE FROM $tabela26 WHERE ID=:ID");
	$count->bindParam(":ID",$id_compra,PDO::PARAM_INT);
	$count->execute();
 
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
		ol&aacute; <b>$name  </b>, os moderadores da ComunidadeMultiN&iacute;vel Cancelaram sua solicita&ccedil&atilde;o de se tornar um distribuidor da empresa TALK FUSION.
		<br> <br> 
		<i>$name, provavelmente sua compra foi cancelada, porque voc&ecirc; n&atilde;o completou seu cadastro e/ou pagamento na empresa TALK FUSION.</i>
		<br> <br> 
		Para tentar novamente, acesse seu escrit&oacute;rio virtual da Comunidade MultiN&iacute;vel e no menu esquerdo clique em 'TALKFUSION' e depois em 'Seja um(a) distribuidor(a)', siga todos os passos, complete seu cadastro e pagamento do seu pacote de produtos da empresa TALK FUSION.
		<br> <br> 
		<i>N&atilde;o fique de fora do projeto, A ComunidadeMultiN&iacute;vel tem grandes planos para voc&ecirc; e toda sua equipe.</i>
		 <br> <br> 
		<b>N&Atilde;O FIQUE AI ESPERANDO, VENHA TRABALHAR COM NOSSA EQUIPE, SOMOS A &Uacute;NICA EQUIPE DO BRASIL, QUE LHE OFERECE A POSSIBILIDADE DE VOC&Ecirc; E TODOS SEUS INDICADOS DIRETOS E INDIRETOS, SEREM FINANCIADOS PARA ENTRAR EM UMA EMPRESA DE MARKETING MULTIN&Iacute;VEL TOTALMENTE LEGALIZADA !!!</b>
		<br><br>	
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como funciona todo nosso projeto.
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

$mail->Subject = "CANCELADA: sua solicitacao de cadastro na empresa TALK FUSION foi cancelada.";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute;  $name   , os moderadores da ComunidadeMultiN&iacute;vel Cancelaram sua solicita&ccedil&atilde;o de se tornar um distribuidor da empresa TALK FUSION.
		 
		 $name, provavelmente sua compra foi cancelada, porque voc&ecirc; n&atilde;o completou seu cadastro e/ou pagamento na empresa TALK FUSION. 
		 
		Para tentar novamente, acesse seu escrit&oacute;rio virtual da Comunidade MultiN&iacute;vel e no menu esquerdo clique em 'TALKFUSION' e depois em 'Seja um(a) distribuidor(a)', siga todos os passos, complete seu cadastro e pagamento do seu pacote de produtos da empresa TALK FUSION.
		 
		 N&atilde;o fique de fora do projeto, A ComunidadeMultiN&iacute;vel tem grandes planos para voc&ecirc; e toda sua equipe. 
		  
		 N&Atilde;O FIQUE AI ESPERANDO, VENHA TRABALHAR COM NOSSA EQUIPE, SOMOS A &Uacute;NICA EQUIPE DO BRASIL, QUE LHE OFERECE A POSSIBILIDADE DE VOC&Ecirc; E TODOS SEUS INDICADOS DIRETOS E INDIRETOS, SEREM FINANCIADOS PARA ENTRAR EM UMA EMPRESA DE MARKETING MULTIN&Iacute;VEL TOTALMENTE LEGALIZADA !!! 
		 
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como funciona todo nosso projeto.
	   
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
		echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO, OCORREU UM ERRO AO ENVIAR UM E-MAIL !!!'); location.href='rede_talkfusion_novo.php';</script>");
        break; //Abandon sending
		exit;
    } else {
		echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO !!! '); location.href='rede_talkfusion_novo.php';</script>");
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
?>
 
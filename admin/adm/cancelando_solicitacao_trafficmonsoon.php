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

$id_posicao = $_POST["id_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];

 // DELETANDO SOLICITACAO
$count= $con->prepare("DELETE FROM $tabela22 WHERE ID=:ID");
$count->bindParam(":ID",$id_posicao,PDO::PARAM_INT);
$count->execute();


$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_do_cliente");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$id_patrocinador = $ln2->ID_INDICACAO; 
	$name = $ln2->NOME;
	$telcliente = $ln2->TELEFONE;
	$celcliente = $ln2->CELULAR;
	$facecliente = $ln2->FACEBOOK;
	$skypecliente = $ln2->SKYPE;
	$email = $ln2->EMAIL;
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



 // ENVIANDO EMAIL PARA OS clientes
$body = "
			ol&aacute; <b>$name  </b>, os moderadores da ComunidadeMultiN&iacute;vel Cancelaram sua solicita&ccedil&atilde;o de registro na TrafficMonsoon.
		<br> <br> 
		<i>$name, provavelmente seu registro foi cancelado, devido aos seguintes motivos.</i>
		<br> <br> 
		<b>- Voc&ecirc; n&atilde;o completou seu cadastro.</b> (<a href='http://www.comunidademultinivel.com.br/talkfusion' title='acesse seu escrit&acute;rio virtual da ComunidadeMultiN&iacute;vel'>clique aqui</a> e acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel, e clique em 'Dicas Di&aacute;rias' e depois em 'TrafficMonsoon' para entender os procedimentos de registros)
		<br> 
		<b>- Seu Cadastro foi efetuado atrav&eacute;s de outro LINK de indica&ccedil;&atilde;o.</b> (Para que seu cadastro na TrafficMonsoon seja aceito, Voc&ecirc; ter&aacute; que se cadastrar atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, nosso link de indica&ccedil;&atilde;o &eacute; o seguinte: <a href='https://trafficmonsoon.com/?ref=ComunidadeMN' title='todos afil&iacute;ados da ComunidadeMultiN&iacute;vel teram que se cadastrar na TrafficMonsoon atrav&eacute;s desse link'>https://trafficmonsoon.com/?ref=ComunidadeMN</a>)
		<br> <br> 
		<i>$name, n&atilde;o fique de fora de nossos projetos, A ComunidadeMultiN&iacute;vel tem grandes planos para voc&ecirc; e toda sua equipe.</i>
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

$mail->Subject = "Sua Solicitacao de cadastro na TrafficMonsoon foi CANCELADA";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute;  $name, os moderadores da ComunidadeMultiN&iacute;vel Cancelaram sua solicita&ccedil&atilde;o de registro na TrafficMonsoon.
	 
		 $name, provavelmente seu registro foi cancelado, devido aos seguintes motivos. 
		 
		 - Voc&ecirc; n&atilde;o completou seu cadastro. http://www.comunidademultinivel.com.br/talkfusion e acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel, e clique em 'Dicas Di&aacute;rias' e depois em 'TrafficMonsoon' para entender os procedimentos de registros 
		 
		 - Seu Cadastro foi efetuado atrav&eacute;s de outro LINK de indica&ccedil;&atilde;o.  (Para que seu cadastro na TrafficMonsoon seja aceito, Voc&ecirc; ter&aacute; que se cadastrar atrav&eacute;s do link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, nosso link de indica&ccedil;&atilde;o &eacute; o seguinte: <a href='https://trafficmonsoon.com/?ref=ComunidadeMN' title='todos afil&iacute;ados da ComunidadeMultiN&iacute;vel teram que se cadastrar na TrafficMonsoon atrav&eacute;s desse link'>https://trafficmonsoon.com/?ref=ComunidadeMN )
		  
		$name, n&atilde;o fique de fora de nossos projetos, A ComunidadeMultiN&iacute;vel tem grandes planos para voc&ecirc; e toda sua equipe. 
		  
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
		echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO OCORREU UM ERRO AO ENVIAR UM E-MAIL !!!'); location.href='posicoes_trafficmonsoon.php';</script>");
        break; //Abandon sending
		exit;
    } else {
		echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO !!! '); location.href='posicoes_trafficmonsoon.php';</script>");
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
 
		 
?>


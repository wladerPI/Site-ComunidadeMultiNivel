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

// busca dados da troca
$sql2 = $con->prepare("SELECT * FROM $tabela25 WHERE ID = '$id_promocao'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$brindes_status = $ln2->STATUS;
	$brindes_data = $ln2->DATA;  
	$brindes_data = implode("/",array_reverse(explode("-",$brindes_data)));
} 
 
 
 // deleta do BD
	$count= $con->prepare("DELETE FROM $tabela25 WHERE ID=:ID");
	$count->bindParam(":ID",$id_promocao,PDO::PARAM_INT);
	$count->execute();
 


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
			Sua Solicita&ccedil;&atilde;o para ser FINANCIADO com $qts_adpacks_brindes ADPacks de BRINDE(s) da ComunidadeMultiN&iacute;vel foi <b style='color:red;'>CANCELADA</b>. <br>
			<br>
			Provavelmente os moderadores da ComunidadeMultiN&iacute;vel CANCELOU seu BRINDE, devido alguma das viola&ccedil;&otilde;es das regras da promo&ccedil;&atilde;o 'Compre ADPacks e Ganhe + ADPacks de BRINDES' da ComunidadeMultiN&iacute;vel. <br><br>
			Os 2 motivos de CANCELAMENTOS mais comuns s&atilde;o; <br>
			<b>- Para voc&ecirc; ser FINANCIADO com '$qts_adpacks_brindes' ADPack(s) de BRINDE(s) da empresa TrafficMonsoon, voc&ecirc; realmente tem que efetuar a compra dos '$qts_adpacks_comprados' ADPacks, e a compra desses ADPacks tem que ser efetuadas tudo de uma s&oacute; vez. </b> <br>
			<b>- Essa promo&ccedil;&atilde;o &eacute; v&aacute;lida somente para indicados diretos da ComunidadeMultiN&iacute;vel(ComunidadeMN) na empresa TrafficMonsoon. </b> 
			<br>	<br>
			Voc&ecirc; quer saber como funciona os ADPacks com posicionamentos de lucro da empresa TrafficMonsoon ? <br>
			<a href='https://www.youtube.com/watch?v=OBHr-9AXddw' title='Clique aqui para entender como aumentar seus rendimentos'>Clique aqui</a> e entenda como voc&ecirc; pode aumentar seus rendimentos na empresa TrafficMonsoon. <br><br>
			Leia com muita aten&ccedil;&atilde;o, as regras dessa promo&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, estando logado no site da ComunidadeMultiN&iacute;vel, <a href='http://www.comunidademultinivel.com.br/adm_clientes/promocao_brindes_regras.php' title='Clique aqui para ler as regras dessa promo&ccedil;&atilde;o'>clique aqui</a>.
			<br><br>
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

$mail->Subject = "Sua Solicitacao de $qts_adpacks_brindes ADPacks de BRINDES foi CANCELADA !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute;  $nomecliente.
			  
			Sua Solicita&ccedil;&atilde;o para ser FINANCIADO com $qts_adpacks_brindes ADPacks de BRINDE(s) da ComunidadeMultiN&iacute;vel foi CANCELADA.
			 
			Provavelmente os moderadores da ComunidadeMultiN&iacute;vel CANCELOU seu BRINDE, devido alguma das viola&ccedil;&otilde;es das regras da promo&ccedil;&atilde;o 'Compre ADPacks e Ganhe + ADPacks de BRINDES' da ComunidadeMultiN&iacute;vel. 
			Os 2 motivos de CANCELAMENTOS mais comuns s&atilde;o;  
			 - Para voc&ecirc; ser FINANCIADO com '$qts_adpacks_brindes' ADPack(s) de BRINDE(s) da empresa TrafficMonsoon, voc&ecirc; realmente tem que efetuar a compra dos '$qts_adpacks_comprados' ADPacks, e a compra desses ADPacks tem que ser efetuadas tudo de uma s&oacute; vez.
			 - Essa promo&ccedil;&atilde;o &eacute; v&aacute;lida somente para indicados diretos da ComunidadeMultiN&iacute;vel(ComunidadeMN) na empresa TrafficMonsoon. 
			 
			Voc&ecirc; quer saber como funciona os ADPacks com posicionamentos de lucro da empresa TrafficMonsoon ? 
			https://www.youtube.com/watch?v=OBHr-9AXddw Clique aqui e entenda como voc&ecirc; pode aumentar seus rendimentos na empresa TrafficMonsoon.  
			Leia com muita aten&ccedil;&atilde;o, as regras dessa promo&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel, estando logado no site da ComunidadeMultiN&iacute;vel, http://www.comunidademultinivel.com.br/adm_clientes/promocao_brindes_regras.php clique aqui .
		 
			Agradecemos sua participação.
			 
			 http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
			 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
			 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
			 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
			 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
			 
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 	
			 
			<b style='color:red;'>Atenciosamente, ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
 
 
	$mail->addAddress($emailcliente, $nomecliente);
    
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
        break; //Abandon sending
		echo "<script type='text/javascript'> alert('brinde CANCELADO com sucesso, ERRO ao enviar um email LOG: $erro !!!'); location.href='promocao_premiados_pendentes_brindes.php';</script>";
		exit;
    } else {
		echo "<script type='text/javascript'> alert('brinde CANCELADO com sucesso !!!'); location.href='promocao_premiados_pendentes_brindes.php';</script>";
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
 
?>


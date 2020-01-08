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
$qts_adpacks = $_POST["qts_adpacks"]; 
$advertencia = "Advertencia de Troca de Pontos por ADPacks";
$dia = date('Y-m-d');

// busca dados da troca
$sql2 = $con->prepare("SELECT * FROM $tabela23 WHERE ID = '$id_promocao'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$troca_qtapacotes = $ln2->QTS_ADPACKS; 
	$troca_status = $ln2->STATUS;
	$troca_data = $ln2->DATA;  
	$troca_data = implode("/",array_reverse(explode("-",$troca_data)));
} 
 
 
 // deleta do BD, cancela promocao
	$count= $con->prepare("DELETE FROM $tabela23 WHERE ID=:ID");
	$count->bindParam(":ID",$id_promocao,PDO::PARAM_INT);
	$count->execute();
 
	$sql_conta = $con->prepare("SELECT * FROM $tabela23 WHERE ID = '1'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) { 
		$qts_pontos = $ln->PONTOS; 
		  
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
	} 
	
// inserir advertencia
		$run = $con->prepare("INSERT INTO $tabela6 (ID_CLIENTE, DESCRICAO, DATA_ADVERTENCIA) VALUES (:ID_CLIENTE, :DESCRICAO, :DATA_ADVERTENCIA)");
		$dados = array(':ID_CLIENTE' => $id_do_cliente, ':DESCRICAO' => $advertencia, ':DATA_ADVERTENCIA' => $dia);
		$cadastra = $run->execute($dados);

	

  // enviando email para o cliente avisando que a compra ja foi efetuado ou o dinheiro foi tranferido com sucesso  
 
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
			<i style='color:red;'>Os Moderadores da ComunidadeMultiN&iacute;vel registraram uma advert&ecirc;ncia para voc&ecirc;, devido alguma viola&ccedil;&atilde;o das regras da promo&ccedil;&atilde;o  'Troque seus Pontos por ADPacks da empresa TrafficMonsoon'.</i>
			<br><br>  
			<a href='http://www.comunidademultinivel/adm_clientes/promocao_trocapontos_regras.php' title='Para ler as Regras Voc&ecirc; precisa estar LOGADO no escrit&oacute;rio da ComunidadeMultiN&iacute;vel'>Clique aqui</a> e leia as Regras (LINK): http://www.comunidademultinivel/adm_clientes/promocao_trocapontos_regras.php
			<br> <br> 
			Est&aacute; com alguma d&uacute;vida ? acesse o for&uacute;m da ComunidadeMultiN&iacute;vel e crie um t&oacute;pico com sua pergunta, que os moderadores da ComunidadeMultiN&iacute;vel ir&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel. <br>
			<br>	
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

$mail->Subject = "Foi registrado uma advertencia para voce no sistema da ComunidadeMultiNivel !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute;  $nomecliente.
			 
			< Os Moderadores da ComunidadeMultiN&iacute;vel registraram uma advert&ecirc;ncia para voc&ecirc;, devido alguma viola&ccedil;&atilde;o das regras da promo&ccedil;&atilde;o  'Troque seus Pontos por ADPacks da empresa TrafficMonsoon'. 
		 
			 http://www.comunidademultinivel/adm_clientes/promocao_trocapontos_regras.php Para ler as Regras Voc&ecirc; precisa estar LOGADO no escrit&oacute;rio da ComunidadeMultiN&iacute;vel   
			 
			Est&aacute; com alguma d&uacute;vida ? acesse o for&uacute;m da ComunidadeMultiN&iacute;vel e crie um t&oacute;pico com sua pergunta, que os moderadores da ComunidadeMultiN&iacute;vel v&atilde;o lhe ajudar o mais r&aacute;pido poss&iacute;vel. 
			 	
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
		echo "<script type='text/javascript'> alert('Advert\u00eancia registrada com sucesso, ERRO ao enviar um email LOG: $erro !!!'); location.href='promocao_premiados_pendentes.php';</script>";
		exit;
    } else {
		echo "<script type='text/javascript'> alert('Advert\u00eancia registrada com sucesso !!!'); location.href='promocao_premiados_pendentes.php';</script>";
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
 
?>


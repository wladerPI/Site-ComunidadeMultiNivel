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
$status = "PAGO";

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
 $creditos_anuncios = $troca_qtapacotes*1000;
 $clicks_banners = $troca_qtapacotes*20;
 
 
 // altera para PAGO
	$altera = "UPDATE $tabela23 SET STATUS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($status,$id_promocao));


 

	$sql_conta = $con->prepare("SELECT * FROM $tabela23 WHERE ID = '1'");
	$sql_conta->execute();
	$sql_conta = $sql_conta->fetchAll(PDO::FETCH_OBJ);
	
	foreach($sql_conta as $ln) { 
		$qts_pontos = $ln->PONTOS; 
		  
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
	} 

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
			<i style='color:red;'>Os Moderadores da ComunidadeMultiN&iacute;vel conclu&iacute;ram a troca de seus pontos por <b style='color:red;'> $troca_qtapacotes </b> ADPack(s) com posicionamento(s) da empresa TrafficMonsoon.</i>
			<br><br> 
			<b>Quantidade de ADPack(s) FINANCIADOS: </b> <b style='color:red;'> $troca_qtapacotes </b><br> 
			<b>Voc&ecirc; ganhou <b style='color:red;'> $creditos_anuncios cr&eacute;ditos de an&uacute;cios </b>.  </b></br>
			<b style='color:red;'>$clicks_banners cliques em seu banner.  </b></br>
			<b>E o(s) posicionamento(s) de lucro, ir&aacute; lhe render</b> <b style='color:red;'> +$troca_qtapacotes d&oacute;lares por dia.  </b></br><br>
			Voc&ecirc; quer saber mais, sobre o ADPacks com posicionamento de lucro da empresa TrafficMonsoon ? <br>
			Veja esse video explicativo: <a href='https://www.youtube.com/watch?v=OBHr-9AXddw' title='Clique aqui para ver o video explicativo'> https://www.youtube.com/watch?v=OBHr-9AXddw </a>
			<br><br>
			Parab&eacute;ns!
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

$mail->Subject = "Sua Solicitacao da troca de seus pontos por $troca_qtapacotes ADPacks foi concluida !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute;  $nomecliente.
			  
			 Os Moderadores da ComunidadeMultiN&iacute;vel conclu&iacute;ram com sucesso a troca de seus pontos por ADPacks com posicionamento da empresa TrafficMonsoon.</i>
			 
			 Quantidade de ADPack(s) FINANCIADOS: $troca_qtapacotes  
			 Voc&ecirc; ganhou $creditos_anuncios cr&eacute;ditos de an&uacute;cios.   
			 $clicks_banners cliques em seu banner. 
			 E o(s) posicionamento(s) de lucro, ir&aacute; lhe render +$troca_qtapacotes d&oacute;lares por dia.  
			Voc&ecirc; quer saber mais, sobre o ADPacks com posicionamento de lucro da empresa TrafficMonsoon ?  
			Veja esse video explicativo:   https://www.youtube.com/watch?v=OBHr-9AXddw  
			 
			Parab&eacute;ns!
			 
			Agradecemos sua participação.
			 
			 http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
			 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
			 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
			 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
			 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
			 
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 	
			 
			Atenciosamente, ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
			 www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
 
 
	$mail->addAddress($emailcliente, $nomecliente);
    
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
        break; //Abandon sending
		echo "<script type='text/javascript'> alert('Troca conclu\u00edda com sucesso, ERRO ao enviar um email LOG: $erro !!!'); location.href='promocao_premiados_pendentes.php';</script>";
		exit;
    } else {
		echo "<script type='text/javascript'> alert('Troca conclu\u00edda com sucesso !!!'); location.href='promocao_premiados_pendentes.php';</script>";
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
 
?>


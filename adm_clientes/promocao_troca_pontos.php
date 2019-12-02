<?php
session_start(); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
  $qts_adpacks_troca = $_POST["qts_adpacks_troca"];
  $status = "PENDENTE";
  $dia = date('Y-m-d');
  
  // adm config da promocao 
	$sql_config = $con->prepare("SELECT * FROM $tabela24 WHERE ID = '1'"); 
	$sql_config->execute();
	$res_config = $sql_config->fetchAll(PDO::FETCH_OBJ);
	foreach($res_config as $ln) {  
		$qts_pontos = $ln->PONTOS;  
		  
		$qts_adpacks_comprar1 = $ln->BONUS_COMPRA_ADPACKS1;
		$qts_adpacks_comprar2 = $ln->BONUS_COMPRA_ADPACKS2;
		$qts_adpacks_comprar3 = $ln->BONUS_COMPRA_ADPACKS3;
		$qts_adpacks_comprar4 = $ln->BONUS_COMPRA_ADPACKS4;
		$qts_adpacks_comprar5 = $ln->BONUS_COMPRA_ADPACKS5;
		$qts_adpacks_comprar6 = $ln->BONUS_COMPRA_ADPACKS6;
		$qts_adpacks_comprar7 = $ln->BONUS_COMPRA_ADPACKS7;
		$qts_adpacks_comprar8 = $ln->BONUS_COMPRA_ADPACKS8;
		$qts_adpacks_comprar9 = $ln->BONUS_COMPRA_ADPACKS9;
		$qts_adpacks_comprar10 = $ln->BONUS_COMPRA_ADPACKS10;
		
		$qts_adpacks_brinde1 = $ln->BONUS_BRINDE_ADPACKS1; 
		$qts_adpacks_brinde2 = $ln->BONUS_BRINDE_ADPACKS2;
		$qts_adpacks_brinde3 = $ln->BONUS_BRINDE_ADPACKS3;
		$qts_adpacks_brinde4 = $ln->BONUS_BRINDE_ADPACKS4;
		$qts_adpacks_brinde5 = $ln->BONUS_BRINDE_ADPACKS5;
		$qts_adpacks_brinde6 = $ln->BONUS_BRINDE_ADPACKS6;
		$qts_adpacks_brinde7 = $ln->BONUS_BRINDE_ADPACKS7;
		$qts_adpacks_brinde8 = $ln->BONUS_BRINDE_ADPACKS8;
		$qts_adpacks_brinde9 = $ln->BONUS_BRINDE_ADPACKS9;
		$qts_adpacks_brinde10 = $ln->BONUS_BRINDE_ADPACKS10;
		
		 
		$liberado_pontos = $ln->LIBERADO_PONTOS;
		$liberado_brindes = $ln->LIBERADO_BRINDES;
		
	}
	 
	
	// busca quantos pontos vc tem
	$sql_b = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_cliente'");
	$sql_b->execute();
	$res_b = $sql_b->fetchAll(PDO::FETCH_OBJ);
	foreach($res_b as $ln_b) {  
		$pontos_ganhos = $ln_b->PONTOS; 
		$data_dica = $ln_b->DATA;
		$data_dica = implode("/",array_reverse(explode("-",$data_dica)));
	}  
  
 // verifica se tem um numero no formulario 
 if ($qts_adpacks_troca == "" || $qts_adpacks_troca <= 0){
	echo "<script type='text/javascript'> alert('Digite uma quantidade de ADPack que deseja efetuar a troca de seus pontos'); location.href='promocao_mes.php';</script>";	 
	exit;
 }
 
 // verifica se tem pontos suficientes
 $soma_pontos = $qts_adpacks_troca*$qts_pontos;
  if ( $pontos_ganhos < $soma_pontos){
	echo "<script type='text/javascript'> alert('Voc\u00ea n\u00e3o possui pontos suficientes para aderir ".$qts_adpacks_troca." ADPack(s). Cada ADPack custa ".$qts_pontos." Pontos. (".$qts_adpacks_troca."x".$qts_pontos." = ".$soma_pontos.")'); location.href='promocao_mes.php';</script>";	 
	exit;
 }
 
 // grava no BD a solicitação 
	$run = $con->prepare("INSERT INTO $tabela23 (ID_CLIENTE, QTS_ADPACKS, STATUS, DATA) VALUES (:ID_CLIENTE, :QTS_ADPACKS, :STATUS, :DATA)");
	$dados = array(':ID_CLIENTE' => $id_cliente, ':QTS_ADPACKS' => $qts_adpacks_troca, ':STATUS' => $status, ':DATA' => $dia);
	$cadastra = $run->execute($dados);
	 
	$id_da_troca = $con->lastInsertId();
 
 // retirar pontos do cliente
	// subtrair pontos
	$subtrair_pontos = $pontos_ganhos-$soma_pontos;
 
	$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($subtrair_pontos,$id_cliente));
  
  
  
  
  
 // ENVIANDO EMAIL PARA OS MODERADORES------------------------------- 

// busca dados do cliente
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
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

// busca dados da troca
$sql2 = $con->prepare("SELECT * FROM $tabela23 WHERE ID = '$id_da_troca'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$troca_qtapacotes = $ln2->QTS_ADPACKS; 
	$troca_status = $ln2->STATUS;
	$troca_data = $ln2->DATA;  
	$troca_data = implode("/",array_reverse(explode("-",$troca_data)));
}

// busca email do server
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
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel.
			<br><br> 
			<i style='color:red;'>Um Afiliado(a), Solicitou a troca de pontos por ($troca_qtapacotes) ADPack(s) na empresa de publicidade TrafficMonsoon.</i>
			<br>
			Entre em contato com o Afiliado, para auxili&aacute;-lo e dar in&iacute;cio aos procedimentos corretamente, seu suporte ser&aacute; importante. <br>
			<br><br>
			<b style='color:red;'>Dados do Afiliado</b> <br>
			<b>ID :</b> <a href='http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_cliente' title='Estando logado na Comunidade, acesse o perfil desse afiliado'> $id_cliente </a><br>
			<b>NOME :</b> $nomecliente<br>
			<b>Telefone :</b> $telcliente<br>
			<b>Celular :</b> $celcliente<br>
			<b>Facebook :</b> $facecliente<br>
			<b>Skype :</b> $skypecliente<br>
			<b>E-Mail :</b> $emailcliente<br>
			<br>
			<b style='color:red;'>Dados da troca</b> <br>
			<b>Quantidade de Pontos :</b> $soma_pontos Pontos.<br>
			<b>Quantidade de ADPack(s):</b> $troca_qtapacotes <br>
			<b>Status da Troca:</b> $troca_status <br>
			<b>Data de Registro:</b> $troca_data <br>
			 <br>  
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

$mail->Subject = "Troca de Pontos por ADPack da empresa TrafficMonsoon";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado MODERADOR da ComunidadeMultiN&iacute;vel.
		 
			 Um Afiliado(a), Solicitou a troca de pontos por ($troca_qtapacotes) ADPack(s) na empresa de publicidade TrafficMonsoon. 
		 
			Entre em contato com o Afiliado, para auxili&aacute;-lo e dar in&iacute;cio aos procedimentos corretamente, seu suporte ser&aacute; importante.  
		 
			 Dados do Afiliado 
			 ID : http://www.comunidademultinivel.com.br/adm_clientes/completo.php?perfil=$id_cliente Estando logado na Comunidade, acesse o perfil desse afiliado 
			 NOME :  $nomecliente 
			 Telefone : $telcliente 
			 Celular : $celcliente 
			 Facebook : $facecliente 
			 Skype : $skypecliente  
			 E-Mail : $emailcliente 
			 
			 Dados da troca 
			 Quantidade de Pontos :  $soma_pontos Pontos. 
			 Quantidade de ADPack(s):  $troca_qtapacotes  
			 Status da Troca:  $troca_status  
			 Data de Registro:  $troca_data  
			  
			 N&atilde;o responda esse e-mail, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel. 		
			 
			 
			 Atenciosamente, ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
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
	if ($moderadorcliente == "SIM"){
			echo "<script type='text/javascript'> alert('Solicita\u00e7\u00e3o foi enviada, aguarde os moderadores da Comunidade MultiN\u00edvel entrarem em contato com voc\u00ea, para efetuarem os procedimentos da compra de seu ADPack !!!'); location.href='promocao_mes.php';</script>";
			exit;
	} 

 
 
 // ENVIANDO EMAIL PARA O CLIENTE------------------------------- 
$body = "
			Ol&aacute; <b>$nomecliente</b>.
			<br><br> 
			<i style='color:red;'>Sua Solicita&ccedil;&atilde;o de troca de seus pontos, por ADPack(s) da empresa TrafficMonsoon, est&aacute; sendo analisada. Aguarde os Moderadores do site da ComunidadeMultiN&iacute;vel entrar em contato com voc&ecirc; para iniciar os procedimentos da compra do seu ADPack com posicionamento de lucro da empresa de publicidade TrafficMonsoon.</i>
			<br><br>
			Voc&ecirc; j&aacute; sabe o que voc&ecirc; vai ganhar aderindo esse ADPack da empresa TrafficMonsoon ?
			<br>
			<b style='color:red;'>Com esse pacote de an&uacute;ncio voc&ecirc; ir&aacute; ganhar os seguintes servi&ccedil;os;</b> <br><br>	
			<b>1000 Cr&eacute;ditos de An&uacute;ncios: </b> Voc&ecirc; poder&aacute; usar para divulgar o seu link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel para at&eacute; 1000 pessoas. <br>
			<b>20 Cliques em seu banner: </b> Voc&ecirc; poder&aacute; usar os banners dispon&iacute;veis no escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel para at&eacute; 20 pessoas clicarem e poss&iacute;velmente se cadastrarem atrav&eacute;s do seu link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel. <br>
			<b>1 Compartilhamento de Lucro da empresa: </b> O mais incr&iacute;vel, voc&ecirc; ir&aacute; ganhar +1 d&oacute;lar por dia, durante 55 dias, totalizando 55 d&oacute;lares de lucro, a cada ADPack conquistado, <a href='https://www.youtube.com/watch?v=OBHr-9AXddw' title='Clique aqui para ver e entender como funciona'>veja esse video explicativo</a> para entender com maiores detalhes sobre o funcionamneto dos ganhos do ADPack da empresa TrafficMonsoon. <br>
			LINK do Video: https://www.youtube.com/watch?v=OBHr-9AXddw <br>
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

$mail->Subject = "Sua Solicitacao foi enviada, troca de pontos por Adpacks da empresa TrafficMonsoon";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Ol&aacute; $nomecliente.
			 
			 Sua Solicita&ccedil;&atilde;o de troca de seus pontos, por ADPack(s) da empresa TrafficMonsoon, est&aacute; sendo analisada. Aguarde os Moderadores do site da ComunidadeMultiN&iacute;vel entrar em contato com voc&ecirc; para iniciar os procedimentos da compra do seu ADPack com posicionamento de lucro da empresa de publicidade TrafficMonsoon.  
			 
			Voc&ecirc; j&aacute; sabe o que voc&ecirc; vai ganhar aderindo esse ADPack da empresa TrafficMonsoon ?
			 
			 Com esse pacote de an&uacute;ncio voc&ecirc; ir&aacute; ganhar os seguintes servi&ccedil;os; 
			 1000 Cr&eacute;ditos de An&uacute;ncios:   Voc&ecirc; poder&aacute; usar para divulgar o seu link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel para at&eacute; 1000 pessoas.  
			 20 Cliques em seu banner:   Voc&ecirc; poder&aacute; usar os banners dispon&iacute;veis no escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel para at&eacute; 20 pessoas clicarem e poss&iacute;velmente se cadastrarem atrav&eacute;s do seu link de indica&ccedil;&atilde;o da ComunidadeMultiN&iacute;vel.  
			 1 Compartilhamento de Lucro da empresa:  O mais incr&iacute;vel, voc&ecirc; ir&aacute; ganhar +1 d&oacute;lar por dia, durante 55 dias, totalizando 55 d&oacute;lares de lucro, a cada ADPack conquistado, veja esse video explicativo para entender com maiores detalhes sobre o funcionamneto dos ganhos do ADPack da empresa TrafficMonsoon.  
			LINK do Video: https://www.youtube.com/watch?v=OBHr-9AXddw  
			 
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
 


 
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente' AND MODERADORES <> 'SIM'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
 
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_cliente = $ln2->ID;
	$name_cliente = $ln2->NOME;  
	$email_cliente = $ln2->EMAIL;
	
	$mail->addAddress($email_cliente, $name_cliente);
    
 
	
    if (!$mail->send()) {
        $erro = $mail->ErrorInfo;
        break; //Abandon sending
		echo "<script type='text/javascript'> alert('Solicita\u00e7\u00e3o foi enviada, aguarde os moderadores da Comunidade MultiN\u00edvel entrarem em contato com voc\u00ea, para efetuarem os procedimentos da compra do seu ADPack, ERRO ao enviar um email LOG: $erro !!!'); location.href='promocao_mes.php';</script>";
		exit;
		
    } else {
		echo "<script type='text/javascript'> alert('Solicita\u00e7\u00e3o foi enviada, aguarde os moderadores da Comunidade MultiN\u00edvel entrarem em contato com voc\u00ea, para efetuarem os procedimentos da compra do seu ADPack !!!'); location.href='promocao_mes.php';</script>";
		exit;
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
   
 
?>

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

$talk_simulador = "SIM";
$dia = date('Y-m-d');
$id_indicacao = $_POST["id_indicado"];
$status = "ATIVO";
 
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$pontos_atual = $ln2->PONTOS;
	$ver_sejata = $ln2->TALK_SIMULADOR;
	$nomecliente = $ln2->NOME;
	$emailcliente = $ln2->EMAIL;
	
}


if ($ver_sejata == "SIM") {
	header("Location: ../index.php");
	exit;
}

 

// mudar talk simulador = sim
$altera = "UPDATE $tabela3 SET TALK_SIMULADOR=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($talk_simulador,$id_cliente));


$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'DESATIVADO' ORDER BY ID_POSICAO ASC LIMIT 7");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
$i=1;
foreach($res2 as $ln2) { 
	if ($i == 1) {$posicao1 = $ln2->ID_POSICAO;}
	if ($i == 2) {$posicao2 = $ln2->ID_POSICAO;}
	if ($i == 3) {$posicao3 = $ln2->ID_POSICAO;}
	if ($i == 4) {$posicao4 = $ln2->ID_POSICAO;}
	if ($i == 5) {$posicao5 = $ln2->ID_POSICAO;}
	if ($i == 6) {$posicao6 = $ln2->ID_POSICAO;}
	if ($i == 7) {$posicao7 = $ln2->ID_POSICAO;}
	$i++;
}

 
	if ($_POST["pacotes"] >= 1) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao1));
	}
	if ($_POST["pacotes"] >= 2) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao2));
	}
	if ($_POST["pacotes"] >= 3) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao3));
	}
	if ($_POST["pacotes"] >= 4) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao4));
	}
	if ($_POST["pacotes"] >= 5) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao5));
	}
	if ($_POST["pacotes"] >= 6) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao6));
	}
	if ($_POST["pacotes"] >= 7) {
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($id_cliente,$status,$dia,$posicao7));
	}
	 
 
 
// SOMAR PONTUACAO
	// SOMANDO NIVEL 1
	try {
		$sql_verifc = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
		$sql_verifc->execute();
		$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc as $ln_verifc) {
			$pontos_nivel_1 = $ln_verifc->PONTOS_NIVEL_1; 
			$pontos_nivel_2 = $ln_verifc->PONTOS_NIVEL_2;
			$pontos_nivel_3 = $ln_verifc->PONTOS_NIVEL_3;
			$pontos_nivel_4 = $ln_verifc->PONTOS_NIVEL_4;
			$pontos_nivel_5 = $ln_verifc->PONTOS_NIVEL_5;
		} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
	} 
	
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_indicacao'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc2 as $ln_verifc2) { 
			$id_indicacao_nivel_2 = $ln_verifc2->ID_INDICACAO;
			$soma_pontos = $pontos_nivel_1+$ln_verifc2->PONTOS;
			$patrocinador = $ln_verifc2->NOME;
		} 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($soma_pontos,$id_indicacao));
	
	
	// SOMANDO NIVEL 2
	if ($id_indicacao_nivel_2 > 0) {
		try {
			$sql_verifc3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_indicacao_nivel_2");
			$sql_verifc3->execute();
			$res_verifc3 = $sql_verifc3->fetchAll(PDO::FETCH_OBJ);
			foreach($res_verifc3 as $ln_verifc3) {
				$id_indicacao_nivel_3 = $ln_verifc3->ID_INDICACAO;
				$soma_pontos2 = $pontos_nivel_2+$ln_verifc3->PONTOS;
			} 
		} catch(PODException $e_verifc3) {
			echo "Erro:/n".$e_verifc3->getMessage();
		}
		$altera2 = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
		$alt_q2 = $con->prepare($altera2);
		$alt_q2->execute(array($soma_pontos2,$id_indicacao_nivel_2));
	}
	
	// SOMANDO NIVEL 3
	
	if ($id_indicacao_nivel_3 > 0) {
		try {
			$sql_verifc4 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_indicacao_nivel_3");
			$sql_verifc4->execute();
			$res_verifc4 = $sql_verifc4->fetchAll(PDO::FETCH_OBJ);
			foreach($res_verifc4 as $ln_verifc4) {
				$id_indicacao_nivel_4 = $ln_verifc4->ID_INDICACAO;
				$soma_pontos3 = $pontos_nivel_3+$ln_verifc4->PONTOS;
			} 
		} catch(PODException $e_verifc4) {
			echo "Erro:/n".$e_verifc4->getMessage();
		}
		$altera3 = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
		$alt_q3 = $con->prepare($altera3);
		$alt_q3->execute(array($soma_pontos3,$id_indicacao_nivel_3));
	}
	
	// SOMANDO NIVEL 4
	
	if ($id_indicacao_nivel_4 > 0) {
		try {
			$sql_verifc5 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_indicacao_nivel_4");
			$sql_verifc5->execute();
			$res_verifc5 = $sql_verifc5->fetchAll(PDO::FETCH_OBJ);
			foreach($res_verifc5 as $ln_verifc5) {
				$id_indicacao_nivel_5 = $ln_verifc5->ID_INDICACAO;
				$soma_pontos4 = $pontos_nivel_4+$ln_verifc5->PONTOS;
			} 
		} catch(PODException $e_verifc5) {
			echo "Erro:/n".$e_verifc5->getMessage();
		}
		$altera4 = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
		$alt_q4 = $con->prepare($altera4);
		$alt_q4->execute(array($soma_pontos4,$id_indicacao_nivel_4));
	}
	
	// SOMANDO NIVEL 5
	
	if ($id_indicacao_nivel_5 > 0) {
		try {
			$sql_verifc6 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_indicacao_nivel_5");
			$sql_verifc6->execute();
			$res_verifc6 = $sql_verifc6->fetchAll(PDO::FETCH_OBJ);
			foreach($res_verifc6 as $ln_verifc6) {
				$soma_pontos5 = $pontos_nivel_5+$ln_verifc6->PONTOS;
			} 
		} catch(PODException $e_verifc6) {
			echo "Erro:/n".$e_verifc6->getMessage();
		}
		$altera5 = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
		$alt_q5 = $con->prepare($altera5);
		$alt_q5->execute(array($soma_pontos5,$id_indicacao_nivel_5));
	} 
 

 
  
 // ENVIANDO EMAIL PARA O PATROCINADOR
 $sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_indicacao'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
}
 
date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
$body = "
		ol&aacute; <b>$name  </b> <br>
		 <br><br>
		<i>Seu Cliente, $nomecliente, acabou de entrar na REDE do SIMULADOR da ComunidadeMultiN&iacute;vel. </i><br>
		 <br><br>
		Parab&eacute;ns Voc&ecirc; ganhou <b style='color:red;'>$pontos_nivel_1</b> pontos, voc&ecirc; poder&aacute; utilizar esses pontos a qualquer momento para subir no topo da rede do simulador.
		<br><br>
		<table style='width:40%;'>
			<tr>
				<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logo-icone-comunidade-multinivel.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
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

$mail->Subject = "ComunidadeMutinivel - Voce ganhou 10 pontos para seu Saldo Geral !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = " 
		ol&aacute; $name  
		
		Seu Cliente, $nomecliente, acabou de entrar na REDE do SIMULADOR da ComunidadeMultiN&iacute;vel.  
		  
		Parab&eacute;ns Voc&ecirc; ganhou $pontos_nivel_1 pontos, voc&ecirc; poder&aacute; utilizar esses pontos a qualquer momento para subir no topo da rede do simulador.
		
		http://www.comunidademultinivel.com.br/forum
		https://www.facebook.com/ComunidadeMultiNivel
		http://goo.gl/4zDgYr
		http://www.comunidademultinivel.com.br/
		
		Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  
		www.comunidademultinivel.com.br
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.
";
  
   
	$mail->addAddress($email, $name);
   
    if (!$mail->send()) {
		$erro = $mail->ErrorInfo;
         
		echo "<script type='text/javascript'> alert('REGISTRADO NO SIMULADOR DA TALKFUSION COM SUCESSO !!! OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS, log: $erro'); location.href='rank_talk_simulador.php';</script>";	 
        break; //Abandon sending
		exit;
    } else {
 		echo "<script type='text/javascript'> alert('REGISTRADO NO SIMULADOR DA TALKFUSION COM SUCESSO !!!'); location.href='rank_talk_simulador.php';</script>"; 
		exit;
    }
// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();				
 
  
?>

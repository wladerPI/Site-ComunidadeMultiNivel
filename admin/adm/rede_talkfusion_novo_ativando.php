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
  $link_indicacao = $_POST["link_indicacao"];
  $status = "ATIVO";
  $link_principal = "SIM";
  $link_outros = "NAO";
  
if ($link_indicacao == "" || $link_indicacao == 0 ) {
	echo("<script type='text/javascript'> alert(' O ID de indica\u00e7\u00e3o \xE9 obrigat\xF3rio !!!'); location.href='rede_talkfusion_novo.php';</script>");
	exit;
}
  
 // alterar  todos os links principais de indicados desse clientes como "NAO"
	$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_do_cliente' && LINK_PRINCIPAL = '$link_principal'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$id_alterado = $ln->ID;
		$altera = "UPDATE $tabela26 SET LINK_PRINCIPAL=? WHERE ID=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($link_outros,$id_alterado)); 
		
	} 
/*
	// ao ativar um deleta todos os outros PENDENTES
	$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_do_cliente' && STATUS = 'PENDENTE' && ID <> '$id_compra'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$id_alterado = $ln->ID;
		$count= $con->prepare("DELETE FROM $tabela26 WHERE ID=:ID");
		$count->bindParam(":ID",$id_alterado,PDO::PARAM_INT);
		$count->execute(); 
		
	} 
*/	
	
	
 // ativando conta no BD e gravar o LINK principal como "SIM"
	$altera = "UPDATE $tabela26 SET STATUS=?, LINK_INDICACAO=?, LINK_PRINCIPAL=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($status,$link_indicacao,$link_principal,$id_compra));
 
 // no banco em 'clientes' ativa TALK FUSION = "SIM"
	$talkfusion_clientes = "SIM";
	$altera = "UPDATE $tabela3 SET TALK_FUSION=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($talkfusion_clientes,$id_do_cliente));
 
 
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
$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');


 // ENVIANDO EMAIL PARA O CLIENTE
$body = "
		ol&aacute; <b>$name  </b>, os moderadores da ComunidadeMultiN&iacute;vel, Completaram sua compra e ativaram seu Link de indica&ccedil;&atilde;o da empresa TALK FUSION no sistema da ComunidadeMultiN&iacute;vel, Agora, todos seus indicados diretos e indiretos da ComunidadeMultiN&iacute;vel, poder&atilde;o fazer parte de sua equipe na empresa TALK FUSION, fazendo com que voc&ecirc; ganhe suas devidas comiss&otilde;es da empresa.
		<br> <br> 
		<i>Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil;&atilde;o para ajudar voc&ecirc; e todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe.  </i>
		<br> <br>  	
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como voc&ecirc; poder&aacute; alavancar seus rendimentos estrat&eacute;gicamente.
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
 

$mail->Subject = "Seu LINK de indicacao da TALK FUSION foi aprovado.";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute; $name, os moderadores da ComunidadeMultiN&iacute;vel, Completaram sua compra e ativaram seu Link de indica&ccedil;&atilde;o da empresa TALK FUSION no sistema da ComunidadeMultiN&iacute;vel, Agora, todos seus indicados diretos e indiretos da ComunidadeMultiN&iacute;vel, poder&atilde;o fazer parte de sua equipe na empresa TALK FUSION, fazendo com que voc&ecirc; ganhe suas devidas comiss&otilde;es da empresa.
		 
		Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil;&atilde;o para ajudar voc&ecirc; e todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe.   
		 
		Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel e veja os videos e artigos explicativos para entender como voc&ecirc; poder&aacute; alavancar seus rendimentos estrat&eacute;gicamente.
		  
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
	$mail->send();
 // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  // ENVIANDO EMAIL PARA O UP-LINE DA TALKFUSION
	$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID = '$id_compra' ");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$id_upline_talk =   $ln->ID_UPLINE;
	} 

//verifica se ID desse cliente é = a ID do upline
if ($id_upline_talk != $id_do_cliente) {	
	$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_upline_talk'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$name_upline_talk = $ln2->NOME;  
		$email_upline_talk = $ln2->EMAIL;
	}
 
 $body = "
		ol&aacute; <b>$name_upline_talk</b>, Parab&eacute;ns, uns dos seus indicados diretos ou indiretos da ComunidadeMultiN&iacute;vel, acabou de se ativar em sua rede abaixo na empresa TALK FUSION, acesse seu escrit&oacute;rio virtual da empresa TALK FUSION para ver suas merecidas comiss&otilde;es em d&oacute;lares da empresa.
		<br> <br> 
		<i>Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil&atilde;o para ajudar voc&ecirc; e todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe e seus rendimentos financeiros.  </i>
		<br> <br>  	
		Lembrando que: Se voc&ecirc; n&atilde;o manter sua mensalidade em dia do seu pacote de produto da TALK FUSION e uns de seus indicados diretos ou indiretos da ComunidadeMultiN&iacute;vel se ativar em sua rede abaixo na empresa TALK FUSION, voc&ecirc; perder&aacute; as devidas comiss&otilde;es da empresa, PORTANTO SEMPRE MANTEHA SUAS MENSALIDADES EM DIA, EFETUANDO O PAGAMENTO TODOS OS MESES.
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
 

$mail->Subject = "Parabens: sua rede esta crescendo na empresa TALK FUSION";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute; $name_upline_talk>, Parab&eacute;ns, uns dos seus indicados diretos ou indiretos da ComunidadeMultiN&iacute;vel, acabou de se ativar em sua rede abaixo na empresa TALK FUSION, acesse seu escrit&oacute;rio virtual da empresa TALK FUSION para ver suas merecidas comiss&otilde;es.
		  
		 Parab&eacute;ns e obrigado por confiar em nossa equipe, estaremos a disposi&ccedil&atilde;o para ajudar voc&ecirc; e todos seus indicados diretos e indiretos, facilitando ao m&aacute;ximo o crescimento de sua equipe.   
		 
		Lembrando que: se voc&ecirc; n&atilde;o manter sua mensalidade em dia do seu pacote de produto da TALK FUSION e uns de seus indicados diretos ou indiretos da ComunidadeMultiN&iacute;vel se ativar em sua rede abaixo na empresa TALK FUSION, voc&ecirc; perder&aacute; as devidas comiss&otilde;es da empresa, PORTANTO SEMPRE MANTEHA SUAS MENSALIDADES EM DIA, EFETUANDO O PAGAMENTO TODOS OS MESES.
		 
		 http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
		 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
		 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
		 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
		 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
		 
		 Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
		 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
  
   
	$mail->addAddress($email_upline_talk, $name_upline_talk);
	$mail->send();
 // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	
	
	
}
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
  
 
 // VERIFICA SE OS UPLINE SÃO OS MSM, SE NÃO FOR, ENVIA O EMAIL ABAIXO
	$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_do_cliente'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$id_patrocinador_do_cliente = $ln2->ID_INDICACAO;   
	}
if ($id_upline_talk != $id_patrocinador_do_cliente && $id_upline_talk != $id_do_cliente) {	
   // ENVIANDO EMAIL PARA O UP-LINE DA COMUNIDADE MultiNivel
	$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_patrocinador_do_cliente'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$nome_patrocinador_do_cliente = $ln2->NOME;
		$email_patrocinador_do_cliente = $ln2->EMAIL;		
	}
$body = "
		ol&aacute; <b>$nome_patrocinador_do_cliente</b>, Estamos enviando esse email, para comunic&aacute;-lo(a) que voc&ecirc; est&aacute; perdendo comiss&otilde;es da empresa TALK FUSION que poderiam ser suas.
		<br> <br> 
		<i>Um indicado direto ou indireto seu, da ComunidadeMultiN&iacute;vel, acabou de se cadastrar na empresa TALK FUSION aderindo um pacote de produtos da empresa. E como voc&ecirc; ainda n&atilde;o est&aacute; cadastrado na empresa TALK FUSION, o sistema da ComunidadeMultiN&iacute;vel, disponibilizou o LINK de INDICA&Ccedil;&Atilde;O de um de seus UP-LINEs da ComunidadeMultiN&iacute;vel, que j&aacute; est&aacute; cadastrado na empresa, PORTANTO ESSE SEU UP-LINE ACABOU DE GANHAR COMISS&Otilde;es QUE PODERIAM TER SIDO SUAS.</i>
		<br> <br>  
		<b>N&atilde;o Perca mais dinheiro, cadastre-se agora mesmo na empresa TALK FUSION, e sempre quando um indicado direto ou indireto seu da ComunidadeMultiN&iacute;vel for se cadastrar na empresa TALK FUSION, o sistema da ComunidadeMultiN&iacute;vel ir&aacute; disponibilizar o seu LINK de Indica&ccedil;&atilde;o, fazendo com que voc&ecirc; ganhe suas devidas comiss&otilde;es da empresa TALK FUSION</b>
		<br> <br> 
		Para se cadastrar &eacute; muito f&aacute;cil, acesse seu escrit&oacute;rio virtual da Comunidade MultiN&iacute;vel e no menu esquerdo clique em <b>'TALKFUSION'</b> e depois em <b>'Seja um(a) distribuidor(a)'</b>, siga todos os passos, complete seu cadastro e pagamento do seu pacote de produtos da empresa TALK FUSION.
		<br><br>  
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
 

$mail->Subject = "Atencao: Voce acabou de perder dinheiro na empresa TALK FUSION.";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute; $nome_patrocinador_do_cliente, Estamos enviando esse email, para comunic&aacute;-lo(a) que voc&ecirc; est&aacute; perdendo comiss&otilde;es da empresa TALK FUSION que poderiam ser suas.
		 
		 Um indicado direto ou indireto seu da ComunidadeMultiN&iacute;vel, acabou de se cadastrar na empresa TALK FUSION aderindo um pacote de produtos da empresa. E como voc&ecirc; ainda n&atilde;o est&aacute; cadastrado na empresa TALK FUSION, o sistema da ComunidadeMultiN&iacute;vel, disponibilizou o LINK de INDICA&Ccedil;Atilde;O de uns de seus UP-LINE da ComunidadeMultiN&iacute;vel que j&aacute; est&aacute; cadastrado na empresa, PORTANTO ESSE SEU UP-LINE ACABOU DE GANHAR COMISS&Otilde:ES QUE PODERIAM TER SIDO SUAS. 
		 
		 N&atilde;o Perca mais dinheiro, cadastre-se agora mesmo na empresa TALK FUSION, e sempre quando um indicado direto ou indireto seu da ComunidadeMultiN&iacute;vel for se cadastrar na empresa TALK FUSION, o sistema da ComunidadeMultiN&iacute;vel ir&aacute; disponibilizar o seu LINK de Indica&ccedil;&atilde;o, fazendo com que voc&ecirc; ganhe suas devidas comiss&otilde;es da empresa TALK FUSION 
		 
		Para se cadastrar &eacute; muito f&aacute;cil, acesse seu escrit&oacute;rio virtual da Comunidade MultiN&iacute;vel e no menu esquerdo clique em 'TALKFUSION' e depois em 'Seja um(a) distribuidor(a)', siga todos os passos, complete seu cadastro e pagamento do seu pacote de produtos da empresa TALK FUSION.
		  
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
  
   
	$mail->addAddress($email_patrocinador_do_cliente, $nome_patrocinador_do_cliente);
	$mail->send();
 // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	
	
	
}
 
 
 
		echo("<script type='text/javascript'> alert('ATIVADO com SUCESSO !!! '); location.href='rede_talkfusion_novo.php';</script>");
		exit;
 
     
?>
 
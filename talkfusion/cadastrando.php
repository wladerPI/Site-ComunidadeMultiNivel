<?php
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php"); 
	$dia = date('Y-m-d');
	$id_indicacao = $_POST["id_indicado"];
	$pontos = "0"; 
	$ip = $_SERVER['REMOTE_ADDR'];
	$dia_ontem = date("j")-1;
	$mes = date("n"); 
	$ano = date("Y"); 
	$ontem = "$ano-$mes-$dia_ontem"; 
	$advertencia = "Advertencia de Cadastros";
	$name = $_POST["nome"];
	$email = $_POST["email"];
	$senha = $_POST["senha"];
	$termos = $_POST['termos'] = ( isset($_POST['termos']) ) ? true : null;
	
	// verificarrrr tudoooooooooo denovo.. porq o javascrito é uma bosta
	
	if ($name == "") {
		echo "<script type='text/javascript'> alert('O Nome \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	if ($_POST["pais"] == "") {
		echo "<script type='text/javascript'> alert('O campo Pa\u00eds \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	if ($_POST["estado"] == "") {
		echo "<script type='text/javascript'> alert('O campo Estado \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	if ($_POST["cidade"] == "") {
		echo "<script type='text/javascript'> alert('O campo Cidade \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	if ($_POST["tel"] == "" && $_POST["cel"] == "" && $_POST["skype"] == "" && $_POST["facebook"] == "") {
		echo "<script type='text/javascript'> alert('Pelo menos um dos camos (Telefone, Celular, Skype ou Facebook) \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	
	if ($_POST["email"] == "") {
		echo "<script type='text/javascript'> alert('O Email \xE9 obrigat\xF3rio!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	
	if ($_POST["senha"] == "" || $_POST["senha_r"] == "") {
		echo "<script type='text/javascript'> alert('Os campos de Senhas s\u00e3o obrigat\xF3rioo!!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	
	if ($_POST["senha"] != $_POST["senha_r"]) {
		echo "<script type='text/javascript'> alert('Os Formul\xE1rios: Senha e Repita a senha est\xE3o diferentes !!!'); location.href='$id_indicacao';</script>";
		exit;
	}
	if ($termos == null) {
		echo "<script type='text/javascript'> alert('\xE9 obrigat\xF3rio acertar os Termos de Uso do SISTEMA !!!'); location.href='$id_indicacao';</script>";
		exit;
	} 
	
	// verifica se email existe
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE EMAIL = '$email'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	 $total_1 = count( $res_verifc );
	
	if ($total_1 >= 1 ) {
		echo "<script type='text/javascript'> alert('Esse email ja esta cadastrado no sistema!!!'); location.href='home';</script>";
		exit;
	}
	
	
	$run = $con->prepare("INSERT INTO $tabela3 (ID_INDICACAO, NOME, PAIS, ESTADO, CIDADE, TELEFONE, CELULAR, SKYPE, FACEBOOK, EMAIL, SENHA, PONTOS, DATA_CADASTRO, IP_CADASTRADO) VALUES (:ID_INDICACAO, :NOME, :PAIS, :ESTADO, :CIDADE, :TELEFONE, :CELULAR, :SKYPE, :FACEBOOK, :EMAIL, :SENHA, :PONTOS, :DATA_CADASTRO, :IP_CADASTRADO)");
	$dados = array(':ID_INDICACAO' => $id_indicacao, ':NOME' => $_POST["nome"], ':PAIS' => $_POST["pais"], ':ESTADO' => $_POST["estado"], ':CIDADE' => $_POST["cidade"], ':TELEFONE' => $_POST["tel"], ':CELULAR' => $_POST["cel"], ':SKYPE' => $_POST["skype"], ':FACEBOOK' => $_POST["facebook"], ':EMAIL' => $_POST["email"], ':SENHA' => $_POST["senha"], ':PONTOS' => $pontos, ':DATA_CADASTRO' => $dia, ':IP_CADASTRADO' => $ip);
	$cadastra = $run->execute($dados);
	
 // enviar email para o cadastrado
 
  
  $sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_indicacao'");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$nome_patrocinador = $ln->NOME; 
}  
  
  
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
		ol&aacute; <b>$name  </b>
		<br><br>
		<i>Seu Cadastro na Comunidade MultiN&iacute;vel foi Efetuado com sucesso. </i>
		<br><br>
		Seu Email de Acesso: <b>$email</b>  <br>
		Sua Senha de Acesso: <b>$senha</b>  
		<br><br>
		Voc&ecirc; foi cadastrado(a), Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel para ver os videos e artigos explicativos de como funciona todo o projeto:  <a href='http://www.comunidademultinivel.com.br/talkfusion/home'>http://www.comunidademultinivel.com.br/talkfusion/home</a> 
		<br><br>
		A ComunidadeMultiN&iacute;vel trabalha com estrat&eacute;gias que facilitam o seu crescimento dentro de uma empresa de Marketing MultiN&iacute;vel totalmente legalizada.
		<br><br>
		<b>Uma dessas estrat&eacute;gias de trabalho &eacute; a ferramenta de trabalho 'Dicas Di&aacute;rias' que est&aacute; sendo um sucesso, essa ferramenta de trabalho, possibilita para voc&ecirc; e todos seus indicados diretos e indiretos serem FINANCIADOS para entrarem em uma empresa de Marketing MultiN&iacute;vel totalmente legalizada.</B> <I STYLE='color:red;'>Voc&ecirc; j&aacute; imaginou como seria f&aacute;cil criar uma rede de afil&iacute;ados em uma empresa de MMN, sendo que todos seus indicados diretos e indiretos sejam FINANCIADOS ?<i/>
		<br><br>
		Voc&ecirc; foi Indicado Diretamente por: <b>$nome_patrocinador</b>, contate e converse com essa pessoa, para que ela possa lhe explicar a grandiosidade de todo nosso projeto.
		<br><br>   
		Para maiores Informa&ccedil;&otilde;es Acesse, Agora mesmo nosso site: <a href='http://www.comunidademultinivel.com.br/talkfusion/'>http://www.comunidademultinivel.com.br/talkfusion/</a>. 
		Acesse tamb&eacute;m seu escrit&oacute;rio virtual, que se encontra no topo do site. 
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

$mail->Subject = "Seja Bem-Vindo(a) a Comunidade Multinivel - Cadastro Efetuado Com Sucesso !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = " 
		ol&aacute; $name 
		 
		Seu Cadastro na Comunidade MultiN&iacute;vel foi Efetuado com sucesso.
		 
		Seu Email de Acesso: $email
		Sua Senha de Acesso: $senha  
		 
		Voc&ecirc; foi cadastrado(a), Acesse seu escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel para ver os videos e artigos explicativos de como funciona todo o projeto:  <a href='http://www.comunidademultinivel.com.br/talkfusion/home'>http://www.comunidademultinivel.com.br/talkfusion/home</a> 
		 
		A ComunidadeMultiN&iacute;vel trabalha com estrat&eacute;gias que facilitam o seu crescimento dentro de uma empresa de Marketing MultiN&iacute;vel totalmente legalizada.
		 
		 Uma dessas estrat&eacute;gias de trabalho &eacute; a ferramenta de trabalho 'Dicas Di&aacute;rias' que est&aacute; sendo um sucesso, essa ferramenta de trabalho, possibilita para voc&ecirc; e todos seus indicados diretos e indiretos serem FINANCIADOS para entrarem em uma empresa de Marketing MultiN&iacute;vel totalmente legalizada.</B> <I STYLE='color:red;'>Voc&ecirc; j&aacute; imaginou como seria f&aacute;cil criar uma rede de afil&iacute;ados em uma empresa de MMN, sendo que todos seus indicados diretos e indiretos sejam FINANCIADOS ?<i/>
	 
		Voc&ecirc; foi Indicado Diretamente por: <b>$nome_patrocinador</b>, contate e converse com essa pessoa, para que ela possa lhe explicar a grandiosidade de todo nosso projeto.
	  
		Para maiores Informa&ccedil;&otilde;es Acesse, Agora mesmo nosso site:  http://www.comunidademultinivel.com.br/talkfusion/   
		Acesse tamb&eacute;m seu escrit&oacute;rio virtual, que se encontra no topo do site. 
		 
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
   
    $sql = $con->prepare("SELECT * FROM $tabela3 WHERE DATA_CADASTRO = '$dia' AND IP_CADASTRADO = '$ip' || DATA_CADASTRO = '$ontem' AND IP_CADASTRADO = '$ip'");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$qts_ip = count( $res );
			
    if (!$mail->send()) {
		$erro = $mail->ErrorInfo;
        if ($qts_ip >= 3) {  
				// grava no BD advertencia do cliente
				$run = $con->prepare("INSERT INTO $tabela6 (ID_CLIENTE, DESCRICAO, DATA_ADVERTENCIA) VALUES (:ID_CLIENTE, :DESCRICAO, :DATA_ADVERTENCIA)");
				$dados = array(':ID_CLIENTE' => $id_indicacao, ':DESCRICAO' => $advertencia, ':DATA_ADVERTENCIA' => $dia);
				$cadastra = $run->execute($dados);
				 
			  // mensagem de advertencia
				echo "<script type='text/javascript'> alert('Cadastrado com Sucesso, OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS, ATEN\u00c7AO: UMA ADVERT\u00caNCIA FOI REGISTRADA PARA SEU PATROCINADOR, \u00c9 CONTRA OS TERMOS DE USO DA COMUNIDADEMULTIN\u00cdVEL EFETUAR V\u00c1RIOS CADASTROS ATRAV\u00c9S DA MESMA M\u00c1QUINA DE ACESSO(PC, NOTBOOK, IP..etc), CASO VOC\u00ca OU SEU PATROCINADOR TENHA MOTIVOS PARA PROVAR QUE ESSA ADVERT\u00caNCIA FOI DESNECESS\u00c1RIA, CONTATE-NOS, LOG: $erro !!!'); location.href='home';</script>";
				exit;
			} else {
				//  mensagem com sucesso 
				echo "<script type='text/javascript'> alert('Cadastrado com Sucesso, OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS, LOG: $erro !!!'); location.href='home';</script>";
				exit;
			} 
        break; //Abandon sending
    } else {
 		if ($qts_ip >= 3) {  
				// grava no BD advertencia do cliente
				$run = $con->prepare("INSERT INTO $tabela6 (ID_CLIENTE, DESCRICAO, DATA_ADVERTENCIA) VALUES (:ID_CLIENTE, :DESCRICAO, :DATA_ADVERTENCIA)");
				$dados = array(':ID_CLIENTE' => $id_indicacao, ':DESCRICAO' => $advertencia, ':DATA_ADVERTENCIA' => $dia);
				$cadastra = $run->execute($dados); 
			  // mensagem de advertencia
				echo "<script type='text/javascript'> alert('Cadastrado com Sucesso, Veja no seu E-mail ou acesso seu escrit\u00f3rio virtual agora mesmo, ATEN\u00c7AO: UMA ADVERT\u00caNCIA FOI REGISTRADA PARA SEU PATROCINADOR, \u00c9 CONTRA OS TERMOS DE USO DA COMUNIDADEMULTIN\u00cdVEL EFETUAR V\u00c1RIOS CADASTROS ATRAV\u00c9S DA MESMA M\u00c1QUINA DE ACESSO, CASO VOC\u00ca OU SEU PATROCINADOR TENHA MOTIVOS PARA PROVAR QUE ESSA ADVERT\u00caNCIA FOI DESNECESS\u00c1RIA, CONTATE-NOS !!!'); location.href='home';</script>";
				exit;
			} else {
				//  mensagem com sucesso 
				echo "<script type='text/javascript'> alert('Cadastrado com Sucesso, Veja no seu E-mail ou acesso seu escrit\u00f3rio virtual agora mesmo !!!'); location.href='home';</script>";
				exit;
			} 
    }
				// Clear all addresses and attachments for next loop
				$mail->clearAddresses();
				$mail->clearAttachments();	
?> 
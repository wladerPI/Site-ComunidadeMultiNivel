<?php 		  
	include("config/config.php");
	$dia = date('Y-m-d');
	error_reporting(E_ALL & ~ E_NOTICE);
	
	if (isset($_POST['email'])){ 
		$email = $_POST['email']; 
	}else{ 
		return;
	}
	
	$name = $_POST['name'];
 
 
	$sql_verifc = $con->prepare("SELECT * FROM $tabela1 WHERE EMAIL = '$email'");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	$total_emal = count( $res_verifc );
  
	if ($total_emal > 0) { 
		echo("<script type='text/javascript'> alert('Registrado com sucesso !!!'); location.href='talkfusion/home';</script>");
		exit;
	} else {
		$run = $con->prepare("INSERT INTO $tabela1 (NOME, EMAIL, DATA) VALUES (:NOME, :EMAIL, :DATA)");
		$dados = array(':NOME' => $name, ':EMAIL' => $email, ':DATA' => $dia);
		$cadastra = $run->execute($dados);
		




$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
 
date_default_timezone_set('Etc/UTC'); 
require 'phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
$body = "
			ol&aacute; <b>$name  </b>
		<br><br> 
		<i>Seja Bem-Vindo a ComunidadeMultiN&iacute;vel, elaboramos um projeto SENSACIONAL para voc&ecirc;. </i>
		 <br><br>
		Desenvolvemos um sistema inteligente e estrat&eacute;gicamente elaborado para aumentar o seu crescimento e rendimento dentro de nossa equipe.
		<br><br>
		Atualmente a grande maioria das pessoas que iniciam um neg&oacute;cio de marketing Multi N&iacute;vel fracassam por n&atilde;o terem o conhecimento ou a informa&ccedil;&atilde;o necess&aacute;ria.
		Para obter &ecirc;xito no Marketing Multi N&iacute;vel, s&atilde;o necess&aacute;rios v&aacute;rios fatores, e n&oacute;s da ComunidadeMultiN&iacute;vel queremos e podemos lhe ajudar $name.
		<br><br>
		Preparamos um v&iacute;deo explicativo ensiando o segredo do sucesso das maiores lideran&ccedil;as do mercado do MultiN&iacute;vel, as melhores estrat&eacute;gias e t&eacute;cnica que proporciona aos grandes l&iacute;deres alcan&ccedil;arem resultados inacreditaveis.
		<br><br>
		E queremos ensinar e ajudar voc&ecirc; $name, h&aacute; tamb&eacute;m desenvolver essas t&eacute;cnicas e estrat&eacute;gias incr&iacute;veis, para que juntos, possamos tamb&eacute;m conquistarmos grandes resultados.
		<br><br>
		O v&iacute;deo se encontra na p&aacute;gina inicial do escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel(TREINAMENTO DE LIDERAN&Ccedil;A), <b>entre em contato agora mesmo com a pessoa que lhe apresentou a ComunidadeMultiN&iacute;vel, e cadastre-se gratuitamente atrav&eacute;s do LINK de Indica&ccedil;&atilde;o dela</b>.
		<br><br>
		Caso voc&ecirc; tenha perdido o contato da pessoa, responda esse email, solicitando o seu cadastro na ComunidadeMultiN&iacute;vel.
		<br><br>
		Caso voc&ecirc; j&aacute; esteja cadastrado na ComunidadeMultiN&iacute;vel e ainda tem alguma d&uacute;vida, acesse nosso F&oacute;rum e fa&ccedil;a sua pergunta, que nossos moderadores iram lhe ajudar.
		<a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'>http://www.comunidademultinivel.com.br/forum</a>
		<br><br>
		<table style='width:40%;'>
			<tr>
				<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='https://www.youtube.com/user/ComunidadeMutinivel' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
				<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logo-icone-comunidade-multinivel.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
			</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. <br> 
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

$mail->Subject = "Seja Bem-Vindo(a) a sua Comunidade do Mutinivel - temos um segredo para lhe contar !!!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		ol&aacute; $name
		
		Seja Bem-Vindo a ComunidadeMultiN&iacute;vel, elaboramos um projeto SENSACIONAL para voc&ecirc;.

		Desenvolvemos um sistema inteligente e estrat&eacute;gicamente elaborado para aumentar o seu crescimento e rendimento dentro de nossa equipe.
		
		Atualmente a grande maioria das pessoas que iniciam um neg&oacute;cio de marketing Multi N&iacute;vel fracassam por n&atilde;o terem o conhecimento ou a informa&ccedil;&atilde;o necess&aacute;ria.
		Para obter &ecirc;xito no Marketing Multi N&iacute;vel, s&atilde;o necess&aacute;rios v&aacute;rios fatores, e n&oacute;s da ComunidadeMultiN&iacute;vel queremos e podemos lhe ajudar $name.
	
		Preparamos um v&iacute;deo explicativo ensiando o segredo do sucesso das maiores lideran&ccedil;as do mercado do MultiN&iacute;vel, as melhores estrat&eacute;gias e t&eacute;cnica que proporciona aos grandes l&iacute;deres alcan&ccedil;arem resultados inacreditaveis.
		
		E queremos ensinar e ajudar voc&ecirc; $name, h&aacute; tamb&eacute;m desenvolver essas t&eacute;cnicas e estrat&eacute;gias incr&iacute;veis, para que juntos, possamos tamb&eacute;m conquistarmos grandes resultados.
		
		O v&iacute;deo se encontra na p&aacute;gina inicial do escrit&oacute;rio virtual da ComunidadeMultiN&iacute;vel(TREINAMENTO DE LIDERAN&Ccedil;A), entre em contato agora mesmo com a pessoa que lhe apresentou a ComunidadeMultiN&iacute;vel, e cadastre-se gratuitamente  atrav&eacute;s do LINK de Indica&ccedil;&atilde;o dela.
		
		Caso voc&ecirc; tenha perdido o contato da pessoa, responda esse email, solicitando o seu cadastro na ComunidadeMultiN&iacute;vel.
		
		Caso voc&ecirc; j&aacute; esteja cadastrado na ComunidadeMultiN&iacute;vel; e ainda tem alguma d&uacute;vida, acesse nosso F&oacute;rum e fa&ccedil;a sua pergunta, que nossos moderadores iram lhe ajudar.
		http://www.comunidademultinivel.com.br/forum
		
		http://www.comunidademultinivel.com.br/forum
		https://www.facebook.com/ComunidadeMultiNivel
		https://www.youtube.com/user/ComunidadeMutinivel
		http://www.comunidademultinivel.com.br/
			 
		Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  
		www.comunidademultinivel.com.br
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o. 
";
  
   
	$mail->addAddress($email, $name);
   
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
 echo ("<script type='text/javascript'> alert('Registrado com sucesso, Iremos contar um segredo em seu e-mail !!!'); location.href='talkfusion/home';</script>");
 
 
	
?>
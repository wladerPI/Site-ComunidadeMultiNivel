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
 
try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID;
		$email = $ln_verifc->EMAIL; 		
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
		$talk_simulador = $ln_verifc->TALK_SIMULADOR; 
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL;
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
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

	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
	} 
	
	$dia = date('Y-m-d');
	$status = "PENDENTE";
	
	$run = $con->prepare("INSERT INTO $tabela12 (ID_CLIENTE, STATUS, DATA_CADASTRO) VALUES (:ID_CLIENTE, :STATUS, :DATA_CADASTRO)");
	$dados = array(':ID_CLIENTE' => $id_cliente, ':STATUS' => $status, ':DATA_CADASTRO' => $dia);
	$cadastra = $run->execute($dados);
	
	// seu patrocinador
	$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$ln_verifc->ID_INDICACAO'");
	$sql_verifc2->execute();
	$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc2 as $ln_verifc2) {
		$patrocinador_nome = $ln_verifc2->NOME;
		 
	}	 
	
	 
	
	//Variaveis de POST, Alterar somente se necessário 
         
		
		$message_adm = "
		O cliente <b>$nome</b>
		<b> email: $email </b>
		<b>ID: $id_cliente </b>
		
		Efetuou a compra e parcelamento de um pacote da TALK FUSION via PAYPAL.
		
		<hr>
		<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  </b>
		<a href='http://www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  
		Empresa 100%Legalizada: <a href='http://www.comunidademultinivel.com.br/talkfusion/dsa'>www.comunidademultinivel.com.br/talkfusion/dsa</a>  
		Est&aacute; na hora de fazermos nossa hist&oacute;ria: <a href=' http://www.comunidademultinivel.com.br/talkfusion/sucesso-talkfusion'> www.comunidademultinivel.com.br/talkfusion/sucesso-talkfusion</a>
		<b style='color:red;'>O Seu Sucesso Est&acute; em Nossa Uni&atilde;o </b>
		
		 
		";  
        //====================================================
 

 
try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$seuemail = $ln->EMAIL_ADM; 
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 
        //REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
        //====================================================
        $email_remetente = $seuemail; // deve ser um email do dominio
        //====================================================
 
 
        //Configurações do email, ajustar conforme necessidade
        //==================================================== 
		$email_destinatario_adm = $seuemail; // qualquer email pode receber os dados 
		$email_reply_adm = "$seuemail"; 
		$email_assunto_adm = "Comunidade do Mutinivel - $nome, Efetuou a compra e parcelamento de um pacote da TALK FUSION via PAYPAL !!!";
        //====================================================
 
 
        //Monta o Corpo da Mensagem
        //====================================================  
		$email_conteudo_adm .=  "$message_adm \n";
        //====================================================
 
 
        //Seta os Headers (Alerar somente caso necessario)
        //==================================================== 
		$email_headers_adm = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply_adm", "Subject: $email_assunto_adm","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
        //====================================================
		

		//Enviando o email para o adm
        //====================================================
         
		mail ($email_destinatario_adm, $email_assunto_adm, nl2br($email_conteudo_adm), $email_headers_adm);
              
	    
        //Enviando o email para o cliente
		
		//==================================================== 
		$message = "
		ol&aacute; <b>$nome  </b>
		 
		<i>Sua compra e parcelamento do seu pacote foi efetuado com sucesso. </i>
		 
		Agora, voc&ecirc; j&aacute; pode solicitar uma posi&ccedil;&atilde;o em nossa REDE PRINCIPAL, para j&aacute; garantir uma posi&ccedil;&atilde;o mais acima poss&iacute;vel em nossa rede.
		Lembrando que &eacute; totalmente aconselhado voc&ecirc; solicitar uma posi&ccedil;&atilde;o que esteja abaixo do seu patrocinador da ComunidadeMultiN&iacute;vel.($patrocinador_nome)
		
		Caso seu Patrocinador ainda n&atilde;o esteja na REDE PRINCIPAL ou caso você tenha alguma duvida, responda esse e-mail que nossos administradores iram lhe ajudar da melhor maneira poss&iacute;vel.
		
		<hr>
		<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  </b>
		<a href='http://www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  
		Empresa 100%Legalizada: <a href='http://www.comunidademultinivel.com.br/talkfusion/dsa'>www.comunidademultinivel.com.br/talkfusion/dsa</a>  
		Est&aacute; na hora de fazermos nossa hist&oacute;ria: <a href=' http://www.comunidademultinivel.com.br/talkfusion/sucesso-talkfusion'> www.comunidademultinivel.com.br/talkfusion/sucesso-talkfusion</a>
		<b style='color:red;'>O Seu Sucesso Est&acute; em Nossa Uni&atilde;o </b>
		
		 
		"; 
		
 
        //REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
        //====================================================
        $email_remetente = $seuemail; // deve ser um email do dominio
        //====================================================
 
 
        //Configurações do email, ajustar conforme necessidade
        //====================================================
        $email_destinatario = $email; // qualquer email pode receber os dados 
        $email_reply = "$email"; 
        $email_assunto = "Comunidade do Mutinivel - Sua Compra e Parcelamento foi Efetuada com Sucesso !!!"; 
        //====================================================
 
 
        //Monta o Corpo da Mensagem
        //==================================================== 
        $email_conteudo .=  "$message \n"; 
        //====================================================
 
 
        //Seta os Headers (Alerar somente caso necessario)
        //====================================================
        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) ); 
        //====================================================
		
        //====================================================
         
		if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
             
				//  mensagem com sucesso 
				echo "<script type='text/javascript'> alert('Sua compra foi efetuada com sucesso !!!'); location.href='parcela_concluida.php';</script>"; 
				exit;
			
		} else { 
			 
				//  mensagem erro ao enviar email
				echo "<script type='text/javascript'> alert('Sua compra foi efetuada com sucesso, OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS !!!'); location.href='parcela_concluida.php';</script>";
				exit;
       }  
        //====================================================	
	 
	
	
?>
  
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
 
 
$id_da_posicao = $_POST["id_da_posicao"];
$status_da_posicao = $_POST["status_da_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];
$link_de_indicacao_da_posicao = $_POST["link_de_indicacao_da_posicao"];
$dia = date('Y-m-d');
$data_vencimento = date('Y-m-d', strtotime("+1 month", strtotime($data_vencimento)));
 
if ($status_da_posicao == "ATIVO") {
	
	// verifica se id do cliente comprador existe
	$sql_altera = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_do_cliente'");
	$sql_altera->execute();
	$res_altera = $sql_altera->fetchAll(PDO::FETCH_OBJ);
	$cliente_existe = count( $res_altera );  
	if ($cliente_existe <= 0) {
		echo("<script type='text/javascript'> alert('Esse Cliente n\u00e3o existe !!!'); location.href='completo_posicao.php?posicao=$id_da_posicao';</script>");
		exit;
	}
	//verifica link esta preenchido
	if ($link_de_indicacao_da_posicao == "") {
		echo("<script type='text/javascript'> alert('O LINK de Indica\u00e7\u00e3o \xE9 obrigat\xF3rio !!!'); location.href='completo_posicao.php?posicao=$id_da_posicao';</script>");
		exit;
	}
	 
	$sql_altera = $con->prepare("SELECT * FROM $tabela7 WHERE ID_POSICAO = '$id_da_posicao'");
	$sql_altera->execute();
	$res_altera = $sql_altera->fetchAll(PDO::FETCH_OBJ); 
	foreach($res_altera as $ln2) { 
		$statu_atual = $ln2->STATUS; 
	} 
	if ($statu_atual == $status_da_posicao) {
		$naopontuar = "nao";
	} 
	  
 
	// altera dados... ativa posicao
	$altera = "UPDATE $tabela7 SET ID_CLIENTE=?, STATUS=?, LINK_INDICACAO=?, DATA_CADASTRO=?, DATA_VENCIMENTO=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($id_do_cliente,$status_da_posicao,$link_de_indicacao_da_posicao,$dia,$data_vencimento,$id_da_posicao));
 
	
	// somando e subtraindo pontos
	$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_do_cliente");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual = $ln2->PONTOS;
		$ver_sejata = $ln2->TALK_FUSION;
		$nomecliente = $ln2->NOME;
		$emailcliente = $ln2->EMAIL;
		$id_indicacao = $ln2->ID_INDICACAO;
		
	}
	
	// SOMAR PONTUACAO
	try {
		$sql_verifc = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
		$sql_verifc->execute();
		$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc as $ln_verifc) {
			$pontos_nivel_1 = $ln_verifc->TALK_NIVEL_1; 
			$pontos_nivel_2 = $ln_verifc->TALK_NIVEL_2;
			$pontos_nivel_3 = $ln_verifc->TALK_NIVEL_3;
			$pontos_nivel_4 = $ln_verifc->TALK_NIVEL_4;
			$pontos_nivel_5 = $ln_verifc->TALK_NIVEL_5;
		} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
	} 
	
if ($naopontuar == "") {	
 	
	// virifica se cliente ja esta no projeto talk e se nao add ele SIM
	if ($ver_sejata == "") {
		$ver_sejata = "SIM";
		$altera = "UPDATE $tabela3 SET TALK_FUSION=? WHERE ID=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($ver_sejata,$id_do_cliente)); 		 
	}
 
	// gera a pontuacao para os 5 niveis 
	// SOMANDO NIVEL 1
	
	
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
} 	
	 // ENVIANDO EMAIL PARA O PATROCINADOR
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID_CLIENTES = $id_indicacao");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
}
  
   //Variaveis de POST, Alterar somente se necessário 
        //==================================================== 
		$message = "
		ol&aacute; <b>$name  </b>
		 
		<i>Seu Cliente, $nomecliente, acabou de entrar na rede Principal do Projeto TALK FUSION na ComunidadeMultiN&iacute;vel. </i>
		 
		Parab&eacute;ns Voc&ecirc; ganhou $pontos_nivel_1 pontos
		  
		<hr>
		<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b>
		"; // vai ler e pegar o que o internauta digitou no campo MENSAGEM
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
        $email_destinatario = $email; // qualquer email pode receber os dados
        $email_reply = "$email";
        $email_assunto = "Foi Efetuado Mais $pontos_nivel_1 pontos para seu Saldo Geral !!!";
        //====================================================
 
 
        //Monta o Corpo da Mensagem
        //==================================================== 
        $email_conteudo .=  "$message \n";
        //====================================================
 
 
        //Seta os Headers (Alerar somente caso necessario)
        //====================================================
        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
        //====================================================
 

        //Enviando o email
        //====================================================
 
		if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
             echo("<script type='text/javascript'> alert('Posi\u00e7\u00e3o ATIVA COM SUCESSO !!! O'); location.href='completo_posicao.php?posicao=$id_da_posicao';</script>");
			 exit;
			
		} else {  
				//  mensagem com sucesso  
				echo("<script type='text/javascript'> alert('Posi\u00e7\u00e3o ATIVA COM SUCESSO !!! OCORREU UM ERRO AO ENVIAR UM E-MAIL, CONTATE-NOS'); location.href='completo_posicao.php?posicao=$id_da_posicao';</script>");
				exit;
       }  
            
        //====================================================	
  
	 
} else if ($status_da_posicao == "PENDENTE") {



} else if ($status_da_posicao == "DESATIVADO") {



}
 
?>

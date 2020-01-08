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

$id_posicao = $_POST["id_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];

$dia = "0000-00-00";
$vencimento = "0000-00-00"; 
$status = "DESATIVADO";
$cancela_cliente = "0";
$link = "";
 
  
	// alterar dados da posicao na rede da talk
	$altera = "UPDATE $tabela7 SET ID_CLIENTE=?, STATUS=?, LINK_INDICACAO=?, DATA_CADASTRO=?, DATA_VENCIMENTO=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($cancela_cliente,$status,$link,$dia,$vencimento,$id_posicao));
 





$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_do_cliente");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$id_patrocinador = $ln2->ID_INDICACAO; 
	$name = $ln2->NOME;
	$telcliente = $ln2->TELEFONE;
	$celcliente = $ln2->CELULAR;
	$facecliente = $ln2->FACEBOOK;
	$skypecliente = $ln2->SKYPE;
	$email = $ln2->EMAIL;
}

  
   //Variaveis de POST, Alterar somente se necessário 
        //==================================================== 
		$message = "
		ol&aacute; <b>$name  </b>, O cancelamento de sua Compra do posicionamento de n&uacute;mero $id_posicao, de nossa rede do PROJETO TALK FUSION foi CANCELADO pelo administrador da ComunidadeMultiN&iacute;l.
		 
		<i>$name, provavelmente seu registro foi cancelado, defido a sua demora para ativa&ccedil;&atilde;o de sua posi&ccedil;&atilde;o na empresa TALK FUSION.</i>
		<i>Caso voc&ecirc; deseje reativar sua posi&ccedil;&atilde;o e garanti-la para voc&ecirc; dentro de nossa equipe, antes de registra-la no sistema, certifique-se que ja esteja pronto para agilizar todo o procedimento, como por exemplo, tenha o dinheiro pronto para uso no cart&atilde;o internacional, ap&oacute;s o pagamento, seu pacote ser&aacute; ativo de imediato.</i>
		
		<i>$name, n&aatilde;o fique de fora de nossos projetos, A ComunidadeMultiN&iacute;vel tem grandes planos para voc&ecirc; e toda sua equipe.</i>
		 
		Conhe&ccedil;a tamb&eacute;m o PROJETO SIMULADOR da TALK FUSION, &eacute; uma forma de voc&ecirc; se posicionar em uma grande rede gratuitamente.
		E voc&ecirc; s&oacute; ir&aacute; entrar na empresa TALK FUSION, se realmente gostar dos resultados que o SIMULDOR lhe mostrar
		quando chegar o momento da migra&ccedil;&atilde;o de toda nossa rede do SIMULADOR para a empresa.
		
		<b>N&Atilde;O FIQUE AI ESPERANDO, VENHA TRABALHAR COM NOSSA EQUIPE, O SEU SUCESSO &Eacute; A NOSSA UNI&Atilde;O !!!</b>
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
        $email_assunto = "O ADMINISTRADOR CANCELOU SEU POSICIONAMENTO NO PROJETO TALK FUSION !!!";
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
             echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO !!!'); location.href='posicoes_rede_talk.php';</script>");
			EXIT;
		} else {  
				//  mensagem com sucesso  
				echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO !!! OCORREU UM ERRO AO ENVIAR UM E-MAIL '); location.href='posicoes_rede_talk.php';</script>");
				exit;
       }  
            
        //====================================================	

 
 
  
?>


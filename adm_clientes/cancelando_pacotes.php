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

 
$dia = "0000-00-00";
$vencimento = "0000-00-00";
$id_posicao = $_POST["id_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];
$status = "DESATIVADO";
$cancela_cliente = "0";
$link = "";

if ($id_cliente != $id_do_cliente) {
	echo("<script type='text/javascript'> alert('Voc\u00e7 n\u00e3o tem permiss\u00e3o para cancelar essa posi\u00e7\u00e3o'); location.href='rede_talk.php';</script>");
	exit;
} 
  
	// alterar dados da posicao na rede da talk
	$altera = "UPDATE $tabela7 SET ID_CLIENTE=?, STATUS=?, LINK_INDICACAO=?, DATA_CADASTRO=?, DATA_VENCIMENTO=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($cancela_cliente,$status,$link,$dia,$vencimento,$id_posicao));
 



 echo("<script type='text/javascript'> alert('CANCELAMENTO EFETUADO COM SUCESSO !!!'); location.href='rede_talk.php';</script>");
	 exit;
?>

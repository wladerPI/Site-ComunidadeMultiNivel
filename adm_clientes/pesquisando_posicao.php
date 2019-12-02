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
 
 
$pesquisa = $_POST["pesquisa"];
header("Location: rede_talk.php?posicao=$pesquisa"); 
exit;
?>

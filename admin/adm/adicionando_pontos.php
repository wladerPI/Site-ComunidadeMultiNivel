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
 
$id_do_clientes = $_POST["id_do_clientes3"];

// busca quantidades de pontos que ele tem
 
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_do_clientes");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln_total) {
		$pontos_atual = $ln_total->PONTOS;							 
	} 
	 
// soma pontos
	$total_pontos = $pontos_atual+$_POST["add_pontos"];
 
 
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_pontos,$id_do_clientes));
	 
	echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='completo.php?id_clients=$id_do_clientes';</script>");
   exit;
?>

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
 
$id_do_clientes = $_POST["id_do_clientes2"];

// busca quantidades de pacotes da TALK
try {
	$sql = $con->prepare("SELECT * FROM $tabela4 WHERE ID_CLIENTES = $id_do_clientes");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	$quant_pacotes = count( $res );
	 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 


if ($_POST["pacotes_simulador_talk"] == $quant_pacotes) {
// nada acontece
	echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='completo.php?id_clients=$id_do_clientes';</script>");
	exit;
	
} else if ($_POST["pacotes_simulador_talk"] < $quant_pacotes) {
// exclui a quantidade
	//Deletamos a mensagem
	$stDelete = $con->prepare("DELETE FROM $tabela4 WHERE ID_CLIENTES = :ID_CLIENTES;");
	$stDelete->bindValue(":ID_CLIENTES", $id_do_clientes, PDO::PARAM_INT);
	$stDelete->execute();
	$affectedRows = $stDelete->rowCount(); 
	
	   
// inseri a quantidade
	for( $i=1; $i <= $_POST["pacotes_simulador_talk"]; $i++) {
		$run = $con->prepare("INSERT INTO $tabela4 (ID_CLIENTES) VALUES (:ID_CLIENTES)");
		$dados = array(':ID_CLIENTES' => $id_do_clientes);
		$cadastra = $run->execute($dados);
	}
	echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='completo.php?id_clients=$id_do_clientes';</script>");
	exit;
} else if ($_POST["pacotes_simulador_talk"] > $quant_pacotes) {
// inseri a quantidade
	$quant_pacotes = $_POST["pacotes_simulador_talk"]-$quant_pacotes; 
	 
	for( $i=1; $i <= $quant_pacotes; $i++) {
		$run = $con->prepare("INSERT INTO $tabela4 (ID_CLIENTES) VALUES (:ID_CLIENTES)");
		$dados = array(':ID_CLIENTES' => $id_do_clientes);
		$cadastra = $run->execute($dados);
	}
	 
	echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='completo.php?id_clients=$id_do_clientes';</script>");
}
  
?>

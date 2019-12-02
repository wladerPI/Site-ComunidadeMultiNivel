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

$addpontos1 = $_POST["add_pontos1"];
$addpontos2 = $_POST["add_pontos2"];
$addpontos3 = $_POST["add_pontos3"];
$addpontos4 = $_POST["add_pontos4"];
$addpontos5 = $_POST["add_pontos5"];
$addpontos6 = $_POST["add_pontos6"];
$addpontos7 = $_POST["add_pontos7"];
$idposicao = $_POST["id_posicao"];

$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) { 
	$pontos_atual = $ln2->PONTOS;
}

if ($addpontos1 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos1;
	$total_subtraido = $pontos_atual-$addpontos1;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
	
} else
if ($addpontos2 >= 1) {
	
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos2;
	$total_subtraido = $pontos_atual-$addpontos2;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
	
} else
if ($addpontos3 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos3;
	$total_subtraido = $pontos_atual-$addpontos3;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
	
} else
if ($addpontos4 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos4;
	$total_subtraido = $pontos_atual-$addpontos4;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
} else
if ($addpontos5 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos5;
	$total_subtraido = $pontos_atual-$addpontos5;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
} else
if ($addpontos6 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos6;
	$total_subtraido = $pontos_atual-$addpontos6;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
} else
if ($addpontos7 >= 1) {
	$sql2 = $con->prepare("SELECT * FROM $tabela9 WHERE ID_POSICAO = '$idposicao'");
	$sql2->execute();
	$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res2 as $ln2) { 
		$pontos_atual_talk_simulador = $ln2->PONTOS_SIMULADOR;
	} 

	$total_somado = $pontos_atual_talk_simulador+$addpontos7;
	$total_subtraido = $pontos_atual-$addpontos7;
	
	$altera = "UPDATE $tabela3 SET PONTOS=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_subtraido,$id_cliente));

	$altera = "UPDATE $tabela9 SET PONTOS_SIMULADOR=? WHERE ID_POSICAO=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($total_somado,$idposicao));
}

  

echo("<script type='text/javascript'> alert('Pontua\u00e7\u00e3o transferida com Sucesso !!!'); location.href='rank_talk_simulador.php';</script>");
 exit;
?>

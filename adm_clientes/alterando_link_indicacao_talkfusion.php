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
		$id_patrocinador = $ln_verifc->ID_INDICACAO;
		$nome = $ln_verifc->NOME;
		$pontos = $ln_verifc->PONTOS;
		$talk = $ln_verifc->TALK_FUSION;
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


$link_principal_table = $_POST["link_principal_table"];
$link_nao = "NAO";
$link_sim = "SIM";


// altera todos os LINKS PRINCIPAIS para NÂO 
		$sql = $con->prepare("SELECT * FROM $tabela26 WHERE ID_CLIENTE = '$id_cliente' && STATUS = 'ATIVO' && LINK_PRINCIPAL = 'SIM'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ); 
		foreach($res as $ln_verifc) {
			$id = $ln_verifc->ID; 
		
			$altera = "UPDATE $tabela26 SET LINK_PRINCIPAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($link_nao,$id));
			  
		}   
 
// altera o NOVO LINK principal para SIM

			$altera = "UPDATE $tabela26 SET LINK_PRINCIPAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($link_sim,$link_principal_table));
			 
 
	echo "<script type='text/javascript'> alert('Seu Link de indica\u00e7\u00e3o da TALK FUSION foi atualizado com sucesso !!!'); location.href='cadastrar_talkfusion.php';</script>";	 
	 exit;
		
?> 
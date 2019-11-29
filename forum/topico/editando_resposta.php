<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
$url_edit = $_POST["url_edit"];  
$id_cliente_criador = $_POST["id_cliente_edit"]; 
$id_resposta_edit = $_POST["id_resposta_edit"]; 
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d'); 
 
 if ($editor1 == "") {
	echo("<script type='text/javascript'> alert('O Campo da resposta \u00e9 obrigat\u00f3rio !!!'); location.href='$url_edit';</script>");
	exit;
}

$altera = "UPDATE $tabela11 SET TEXTO_TOPICO=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($editor1,$id_resposta_edit));
 
  
$run = $con->prepare("INSERT INTO $tabela14 (ID_RESPOSTA, ID_CLIENTE, DATA_EDITADO) VALUES (:ID_RESPOSTA, :ID_CLIENTE, :DATA_EDITADO)");
$dados = array(':ID_RESPOSTA' => $id_resposta_edit, ':ID_CLIENTE' => $id_cliente_criador, ':DATA_EDITADO' => $dia);
$cadastra = $run->execute($dados);
  
  
  echo("<script type='text/javascript'> alert('Sua reposta foi Editada com sucesso !!!'); location.href='$url_edit';</script>");
		exit;	
		 
            
        //====================================================	
  
  
?>

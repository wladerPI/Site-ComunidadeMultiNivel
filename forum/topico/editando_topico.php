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
$titulo = $_POST["titulo"];
$tags = $_POST["tags"];
$id_cliente_criador = $_POST["id_cliente_edit"]; 
$id_topico_edit = $_POST["id_topico_edit"]; 
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d'); 
$url = $_POST["url_edit"];
$topic_dica = $_POST["topic_dica"];

if ($titulo == "" || $editor1 == "") {
	echo("<script type='text/javascript'> alert('Os Campos T\u00edtulo e Texto s\u00e3o obrigat\u00f3rios !!!'); location.href='$url';</script>");
	exit;
}
 
$altera = "UPDATE $tabela10 SET TITULO_TOPICO=?,TAGS_TOPICO=?,DICA=?,TEXTO_TOPICO=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($titulo,$tags,$topic_dica,$editor1,$id_topico_edit));
 
  
$run = $con->prepare("INSERT INTO $tabela13 (ID_TOPICO, ID_CLIENTE, DATA_EDITADO) VALUES (:ID_TOPICO, :ID_CLIENTE, :DATA_EDITADO)");
$dados = array(':ID_TOPICO' => $id_topico_edit, ':ID_CLIENTE' => $id_cliente_criador, ':DATA_EDITADO' => $dia);
$cadastra = $run->execute($dados);
  
  
  echo("<script type='text/javascript'> alert('Seu TOPICO foi Editado com sucesso !!!'); location.href='$url';</script>");
		exit;	
		 
            
        //====================================================	
  
  
?>

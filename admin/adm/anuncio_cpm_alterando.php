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
 
$id_anuncio = $_POST["id_anuncio"];
$banner_titulo = $_POST["banner_titulo"]; 
$codigo_banner = filter_var($_POST["codigo_banner"], FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
 
 
 
  
	// altera dados... ativa posicao
	$altera = "UPDATE $tabela17 SET TITULO=?, SCRIPT=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($banner_titulo,$codigo_banner,$id_anuncio));
 
	 
echo("<script type='text/javascript'> alert('Banner CPM, Alterado com sucesso'); location.href='anuncio_cpm.php?anuncio=$id_anuncio';</script>");
	 
 
?>

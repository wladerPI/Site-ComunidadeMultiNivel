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
  
 
 
 
$titulo = $_POST["titulo"];
$dia = $_POST["dia"]; 
  
$editor1 = filter_var($_POST["editor1"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$data = date('Y-m-d'); 
  
$run = $con->prepare("INSERT INTO $tabela16 (DIA, ANUNCIO_CPC, ANUNCIO_TITULO, DATA) VALUES (:DIA, :ANUNCIO_CPC, :ANUNCIO_TITULO, :DATA)");
$dados = array(':DIA' => $dia, ':ANUNCIO_CPC' => $editor1, ':ANUNCIO_TITULO' => $titulo, ':DATA' => $data);
$cadastra = $run->execute($dados);
  
 echo ("<script type='text/javascript'> alert('An\u00fancio CPC registrado com sucesso !!!'); location.href='anunciocpc_dia.php?dia=$dia';</script>");
 
?> 

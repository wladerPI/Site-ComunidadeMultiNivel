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
$autor = "0";  
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d');
$visualizacao =  "0";
  
$run = $con->prepare("INSERT INTO $tabela15 (ID_MODERADOR, TITULO, TEXTO, VISUALIZACOES, DATA) VALUES (:ID_MODERADOR, :TITULO, :TEXTO, :VISUALIZACOES, :DATA)");
$dados = array(':ID_MODERADOR' => $autor, ':TITULO' => $titulo, ':TEXTO' => $editor1, ':VISUALIZACOES' => $visualizacao, ':DATA' => $dia);
$cadastra = $run->execute($dados);
  
 echo ("<script type='text/javascript'> alert('Dica criada com sucesso !!!'); location.href='dicas_texto.php';</script>");
 
?>
  
?>

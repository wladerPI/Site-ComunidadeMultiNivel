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
 
		$id_dica = $_POST["id_dica"];
		$titulo = $_POST["titulo"]; 	
		$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
		$moderador = $_POST["autor"]; 
		 
 
 
 
$altera = "UPDATE $tabela15 SET ID_MODERADOR=?,TITULO=?,TEXTO=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($moderador,$titulo,$editor1,$id_dica));
  
  
  echo("<script type='text/javascript'> alert('Dica Editada com sucesso !!!'); location.href='dicas_texto.php';</script>");
			
		 
            
        //====================================================	
  
  
?>

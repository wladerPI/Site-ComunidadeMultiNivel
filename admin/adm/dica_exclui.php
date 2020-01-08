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
 
$id_dica = $_GET['id_dica'];
if ($id_dica == "" || $id_dica == 0 ) {
	echo("<script type='text/javascript'> alert('Essa Dica n\u00e3o existe !!!'); location.href='dicas_texto.php';</script>"); 
	exit;
} 	 
 
$count= $con->prepare("DELETE FROM $tabela15 WHERE ID=:ID");
$count->bindParam(":ID",$id_dica,PDO::PARAM_INT);
$count->execute();
 

  echo("<script type='text/javascript'> alert('Dica Excluida com sucesso !!!'); location.href='dicas_texto.php';</script>");
			
		 
            
        //====================================================	
  
  
?>

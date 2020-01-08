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
 
$dia = $_GET['dia'];
$id_anunciocpc = $_GET['id_anunciocpc'];


if ($dia == "" || $dia == 0 || $dia > 30) {
	echo("<script type='text/javascript'> alert('Esse Dia n\u00e3o existe !!!'); location.href='anuncio_cpc.php';</script>"); 
	exit;
}  
if ($id_anunciocpc == "" || $id_anunciocpc == 0 ) {
	echo("<script type='text/javascript'> alert('Esse Anuncio n\u00e3o existe !!!'); location.href='anunciocpc_dia.php?dia=$dia';</script>"); 
	exit;
}  
 
$count= $con->prepare("DELETE FROM $tabela16 WHERE ID=:ID");
$count->bindParam(":ID",$id_anunciocpc,PDO::PARAM_INT);
$count->execute();
 

  echo("<script type='text/javascript'> alert('Anuncio Excluido com sucesso !!!'); location.href='anunciocpc_dia.php?dia=$dia';</script>");
			
		 
            
        //====================================================	
  
  
?>

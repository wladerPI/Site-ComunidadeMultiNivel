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
 
		$id_anunciocpc = $_POST["id_anunciocpc"];
		$titulo = $_POST["titulo"]; 	 
		$editor1 = filter_var($_POST["editor1"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$dia_do_anuncio = $_POST["dia_do_anuncio"]; 
		
if ($id_anunciocpc == "" || $id_anunciocpc == 0 ) {
	 echo("<script type='text/javascript'> alert('Esse Anuncio n\u00e3o existe !!!'); location.href='anuncio_cpc.php';</script>");
	 exit;
}		 
if ($dia_do_anuncio == "" || $dia_do_anuncio == 0 || $dia_do_anuncio > 30) {
	 echo("<script type='text/javascript'> alert('Esse Dia do Anuncio n\u00e3o existe !!!'); location.href='anuncio_cpc.php';</script>");
	 exit;
} 
 
 
$altera = "UPDATE $tabela16 SET DIA=?,ANUNCIO_CPC=?,ANUNCIO_TITULO=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($dia_do_anuncio,$editor1,$titulo,$id_anunciocpc));
  
  
  echo("<script type='text/javascript'> alert('Anuncio Editada com sucesso !!!'); location.href='anunciocpc_dia.php?dia=$dia_do_anuncio';</script>");
			
		 
            
        //====================================================	
  
  
?>

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
 
		$id_anunciocpc_popup = $_POST["id_anunciocpc_popup"];
		$titulo = $_POST["titulo"]; 	 
		$editor1 = filter_var($_POST["editor1"], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$dia_do_anuncio_popup = $_POST["dia_anunciocpc_popup"]; 
		$data = date('Y-m-d');
		
		
if ($id_anunciocpc_popup == "" || $id_anunciocpc_popup == 0 ) {
	 echo("<script type='text/javascript'> alert('Esse Anuncio n\u00e3o existe !!!'); location.href='anuncio_cpc_popup.php';</script>");
	 exit;
}		 
if ($id_anunciocpc_popup == "" || $id_anunciocpc_popup == 0 || $id_anunciocpc_popup > 30) {
	 echo("<script type='text/javascript'> alert('Esse Dia do Anuncio n\u00e3o existe !!!'); location.href='anuncio_cpc_popup.php';</script>");
	 exit;
} 
 
 
$altera = "UPDATE $tabela28 SET ANUNCIO_CPC_POPUP=?,TITULO=?,DATA=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($editor1,$titulo,$data,$id_anunciocpc_popup));
  
  
  echo("<script type='text/javascript'> alert('Anuncio Editado com sucesso !!!'); location.href='anunciocpc_popup_dia.php?dia=$dia_do_anuncio_popup';</script>");
			
		 
            
        //====================================================	
  
  
?>

<?php
session_start(); 
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_adm = $_SESSION['ID'];

if ($id_adm == "" || $id_adm == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}



$altera = "UPDATE $tabela2 SET ICO_FAVICON_LINK=?, EMAIL_ADM=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($_POST["icone_altera"],$_POST["email_altera"],$id_adm));

echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='dadosgerais.php';</script>");
 
?>

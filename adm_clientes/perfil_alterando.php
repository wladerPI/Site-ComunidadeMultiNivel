<?php
session_start(); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
$altera = "UPDATE $tabela3 SET NOME=?, PAIS=?, ESTADO=?, CIDADE=?, TELEFONE=?, CELULAR=?, SKYPE=?, FACEBOOK=?, EMAIL=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($_POST["nome_altera"],$_POST["pais_altera"],$_POST["estado_altera"],$_POST["cidade_altera"],$_POST["tel_altera"],$_POST["cel_altera"],$_POST["skype_altera"],$_POST["facebook_altera"],$_POST["email_altera"],$id_cliente));

echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='perfil.php';</script>");
 exit;
?>

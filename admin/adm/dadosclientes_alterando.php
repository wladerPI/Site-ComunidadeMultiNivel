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
 
 
 
$altera = "UPDATE $tabela3 SET ID_INDICACAO=?, NOME=?, DATA_NASCIMENTO=?, PAIS=?, ESTADO=?, CIDADE=?, TELEFONE=?, CELULAR=?, SKYPE=?, FACEBOOK=?, EMAIL=?, SENHA=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($_POST["patrocinador_clientes"],$_POST["nome_clientes"],$_POST["datanasc_clientes"],$_POST["pais_clientes"],$_POST["estado_clientes"],$_POST["cidade_clientes"],$_POST["tel_clientes"],$_POST["cel_clientes"],$_POST["skype_clientes"],$_POST["face_clientes"],$_POST["email_clientes"],$_POST["senha_clientes"],$_POST["id_do_clientes"]));

$id_do_clientes = $_POST['id_do_clientes'];
echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='completo.php?id_clients=$id_do_clientes';</script>");
 
?>

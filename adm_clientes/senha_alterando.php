<?php
session_start(); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}

$senha = $_POST["senha_altera"];
$re_senha = $_POST["senhar_altera"];

if ($senha == "" || $re_senha == "") {
	echo("<script type='text/javascript'> alert('Os campos s\u00e3o obrigat\xF3rio !!!'); location.href='senha.php';</script>");
	exit
} 
if ($senha != $re_senha) {
	echo("<script type='text/javascript'> alert('Os Formul\xE1rios: Senha e Repita sua senha, est\xE3o diferentes, \xE9 obrigat\xF3rio que fiquem iguais !!!'); location.href='senha.php';</script>");
	exit
} 
  
 
$altera = "UPDATE $tabela3 SET SENHA=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($_POST["senha_altera"],$id_cliente));

	echo("<script type='text/javascript'> alert('Senhas alteradas com Sucesso !!!'); location.href='senha.php';</script>");
	exit;
?>

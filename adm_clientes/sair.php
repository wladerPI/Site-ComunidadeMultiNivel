<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start(); /* inicia a sessão */
include("../config/config.php");	
 
$chave = $_SESSION['ID_CLIENTE'];
$Ultimoacesso = date('Y-m-d H:i:s');

// query
$sql = "UPDATE $tabela3 SET ULTIMOACESSO=? WHERE ID=?";
$q = $con->prepare($sql);
$q->execute(array($Ultimoacesso,$chave));

	
session_unset(); /* elimina todas as variáveis da sessão */
session_destroy(); /* destrói a sessão */
header("Location: ../index.php");
?>
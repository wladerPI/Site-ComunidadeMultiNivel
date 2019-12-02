<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start(); /* inicia a sess�o */
include("../config/config.php");	
 
$chave = $_SESSION['ID_CLIENTE'];
$Ultimoacesso = date('Y-m-d H:i:s');

// query
$sql = "UPDATE $tabela3 SET ULTIMOACESSO=? WHERE ID=?";
$q = $con->prepare($sql);
$q->execute(array($Ultimoacesso,$chave));

	
session_unset(); /* elimina todas as vari�veis da sess�o */
session_destroy(); /* destr�i a sess�o */
header("Location: ../index.php");
?>
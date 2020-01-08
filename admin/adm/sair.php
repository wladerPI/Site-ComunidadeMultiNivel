<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start(); /* inicia a sessão */
include("../../config/config.php");	
 
session_unset(); /* elimina todas as variáveis da sessão */
session_destroy(); /* destrói a sessão */
header("Location: ../index.php");
?>
<?php
header("Content-Type: text/html; charset=ISO-8859-1",true);
session_start(); /* inicia a sess�o */
include("../../config/config.php");	
 
session_unset(); /* elimina todas as vari�veis da sess�o */
session_destroy(); /* destr�i a sess�o */
header("Location: ../index.php");
?>
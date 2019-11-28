<?php 
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php"); 
	header("Content-Type: text/html; charset=ISO-8859-1",true);
 
	 
 $url  = isset($_GET['url']) ? $_GET['url'] : 'home';
	
	$separar  = explode('/', $url);
    $pagina   = (isset($separar[0])) ? $separar[0] : 'home';
	$sub_pagina   = (isset($separar[1])) ? $separar[1] : 'home';
	$sub2_pagina   = (isset($separar[2])) ? $separar[2] : '0';
	$sub3_pagina   = (isset($separar[3])) ? $separar[3] : '0';
     
	try {
		$sql = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$pagina'");
		$sql->execute();
		$res = $sql->fetchAll(PDO::FETCH_OBJ);
		foreach($res as $ln) { 
			$id_clients = $ln->ID;
		} 
	} catch(PODException $e) {
		echo "Erro:/n".$e->getMessage();
	} 	
	
			if ($pagina == $id_clients){
				include("cadastros.php");
			} else if ($pagina == "home"){
				include("home.php");
			}  else if ($pagina == "contato") {
				include("contato.php");
			} else if ($pagina == "empresa") {
				include("empresa.php");
			}  else if ($pagina == "como-funciona") {
				include("como-funciona.php");
			} else if ($pagina == "equipe") {
				include("equipe.php");
			} else if ($pagina == "como-ganhar-mais-dinheiro") {
				include("como-ganhar-mais-dinheiro.php");
			} else if ($pagina == "produtos") {
				include("produtos.php");
			} else if ($pagina == "contato") {
				include("contato.php");
			} else if ($pagina == "solicitar_senha") {
				include("solicitar_senha.php");
			} else if ($pagina == "sustentabilidade") {
				include("sustentabilidade.php");
			} else if ($pagina == "cadastrando") {
				include("cadastrando.php");
			}  else if ($pagina == "solicitando_senha") {
				include("solicitando_senha.php");
			}    else 	{
				include("erro.php");
			}

?> 
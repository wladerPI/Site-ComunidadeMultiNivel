<?php

ob_start();
// Tabelas
$tabela1 = "captura_email"; 
$tabela2 = "adm_site";
$tabela3 = "clientes"; 
//$tabela4 = "pacotes_clientes"; 
$tabela5 = "adm_projeto"; 
$tabela6 = "clientes_advertencias"; 
$tabela7 = "rede_talk";
//$tabela8 = "clientes_pontos_projet";
$tabela9 = "rede_talk_simulador";
$tabela10 = "forum_topicos";
$tabela11 = "forum_respostas";
$tabela12 = "parcelamento";
$tabela13 = "forum_topicos_edit";
$tabela14 = "forum_respostas_edit"; 
$tabela15 = "dicas";
$tabela16 = "dicas_anuncio_cpc";
$tabela17 = "dicas_anuncio_cpm";
$tabela18 = "dicas_anuncio_pago";
$tabela19 = "dicas_confg";
$tabela20 = "dicas_pontos";
$tabela21 = "dicas_pontos_historico"; 
$tabela22 = "dicas_trafficmonsoon_clientes";
$tabela23 = "dicas_adm_promocao_troca";   
$tabela24 = "dicas_confg_promocao";  
$tabela25 = "dicas_adm_promocao_brindes";
$tabela26 = "rede_talk_novo";
$tabela27 = "dicas_popup_historioco";
$tabela28 = "dicas_anuncio_cpc_popup";
$tabela29 = "enquete_trafficmonsoon_produtos";


// config OFFILINE

//Banco de Dados

$bd = "comunidademult"; 
$user = "root"; 
$pass = ""; 
$host = "localhost"; 

	
	try {
	  $con = new PDO('mysql:host=localhost;dbname=comunidademult', $user, $pass);
	  
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

/*		


// config ONLINE
$bd = "comunidademult"; 
$user = "comunidademult"; 
$pass = "senhaqui"; 
$host = "mysql.comunidademultinivel.com.br"; 

	
	try {
	  $con = new PDO('mysql:host=mysql.comunidademultinivel.com.br;dbname=comunidademult', $user, $pass);
	  
	} catch(PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
*/
?>	
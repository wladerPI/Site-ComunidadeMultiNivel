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
 
		$id = "1"; 
		$qts_pontos = $_POST["qts_pontos"]; 
		 
		
		$qts_adpacks_comprar1 = $_POST["qts_adpacks_comprar1"];
		$qts_adpacks_comprar2 = $_POST["qts_adpacks_comprar2"];
		$qts_adpacks_comprar3 = $_POST["qts_adpacks_comprar3"];
		$qts_adpacks_comprar4 = $_POST["qts_adpacks_comprar4"];
		$qts_adpacks_comprar5 = $_POST["qts_adpacks_comprar5"];
		$qts_adpacks_comprar6 = $_POST["qts_adpacks_comprar6"];
		$qts_adpacks_comprar7 = $_POST["qts_adpacks_comprar7"];
		$qts_adpacks_comprar8 = $_POST["qts_adpacks_comprar8"];
		$qts_adpacks_comprar9 = $_POST["qts_adpacks_comprar9"];
		$qts_adpacks_comprar10 = $_POST["qts_adpacks_comprar10"];
		 
		$qts_adpacks_brinde1 = $_POST["qts_adpacks_brinde1"]; 
		$qts_adpacks_brinde2 = $_POST["qts_adpacks_brinde2"];
		$qts_adpacks_brinde3 = $_POST["qts_adpacks_brinde3"];
		$qts_adpacks_brinde4 = $_POST["qts_adpacks_brinde4"];
		$qts_adpacks_brinde5 = $_POST["qts_adpacks_brinde5"];
		$qts_adpacks_brinde6 = $_POST["qts_adpacks_brinde6"];
		$qts_adpacks_brinde7 = $_POST["qts_adpacks_brinde7"];
		$qts_adpacks_brinde8 = $_POST["qts_adpacks_brinde8"];
		$qts_adpacks_brinde9 = $_POST["qts_adpacks_brinde9"];
		$qts_adpacks_brinde10 = $_POST["qts_adpacks_brinde10"];
		
		 
		$liberado_pontos = $_POST["liberado_pontos"];
		$liberado_brindes = $_POST["liberado_brindes"];  
     
	  
	  
	  
	$sql = "UPDATE $tabela24 SET PONTOS = :PONTOS,  
												BONUS_COMPRA_ADPACKS1 = :BONUS_COMPRA_ADPACKS1,
												BONUS_COMPRA_ADPACKS2 = :BONUS_COMPRA_ADPACKS2,
												BONUS_COMPRA_ADPACKS3 = :BONUS_COMPRA_ADPACKS3,
												BONUS_COMPRA_ADPACKS4 = :BONUS_COMPRA_ADPACKS4,
												BONUS_COMPRA_ADPACKS5 = :BONUS_COMPRA_ADPACKS5,
												BONUS_COMPRA_ADPACKS6 = :BONUS_COMPRA_ADPACKS6,
												BONUS_COMPRA_ADPACKS7 = :BONUS_COMPRA_ADPACKS7,
												BONUS_COMPRA_ADPACKS8 = :BONUS_COMPRA_ADPACKS8,
												BONUS_COMPRA_ADPACKS9 = :BONUS_COMPRA_ADPACKS9,
												BONUS_COMPRA_ADPACKS10 = :BONUS_COMPRA_ADPACKS10,
												BONUS_BRINDE_ADPACKS1 = :BONUS_BRINDE_ADPACKS1,
												BONUS_BRINDE_ADPACKS2 = :BONUS_BRINDE_ADPACKS2,
												BONUS_BRINDE_ADPACKS3 = :BONUS_BRINDE_ADPACKS3,
												BONUS_BRINDE_ADPACKS4 = :BONUS_BRINDE_ADPACKS4,
												BONUS_BRINDE_ADPACKS5 = :BONUS_BRINDE_ADPACKS5,
												BONUS_BRINDE_ADPACKS6 = :BONUS_BRINDE_ADPACKS6,
												BONUS_BRINDE_ADPACKS7 = :BONUS_BRINDE_ADPACKS7,
												BONUS_BRINDE_ADPACKS8 = :BONUS_BRINDE_ADPACKS8,
												BONUS_BRINDE_ADPACKS9 = :BONUS_BRINDE_ADPACKS9,
												BONUS_BRINDE_ADPACKS10 = :BONUS_BRINDE_ADPACKS10,
												LIBERADO_PONTOS = :LIBERADO_PONTOS,
												LIBERADO_BRINDES = :LIBERADO_BRINDES
												WHERE ID = :ID"; 
												
 
	$stmt = $con->prepare($sql);   
	
	 
	$stmt->bindParam(':PONTOS', $qts_pontos);  
	
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS1', $qts_adpacks_comprar1);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS2', $qts_adpacks_comprar2);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS3', $qts_adpacks_comprar3);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS4', $qts_adpacks_comprar4);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS5', $qts_adpacks_comprar5);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS6', $qts_adpacks_comprar6);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS7', $qts_adpacks_comprar7);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS8', $qts_adpacks_comprar8);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS9', $qts_adpacks_comprar9);
	$stmt->bindParam(':BONUS_COMPRA_ADPACKS10', $qts_adpacks_comprar10);

	$stmt->bindParam(':BONUS_BRINDE_ADPACKS1', $qts_adpacks_brinde1);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS2', $qts_adpacks_brinde2);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS3', $qts_adpacks_brinde3);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS4', $qts_adpacks_brinde4);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS5', $qts_adpacks_brinde5);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS6', $qts_adpacks_brinde6);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS7', $qts_adpacks_brinde7);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS8', $qts_adpacks_brinde8);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS9', $qts_adpacks_brinde9);
	$stmt->bindParam(':BONUS_BRINDE_ADPACKS10', $qts_adpacks_brinde10);
	
	$stmt->bindParam(':LIBERADO_PONTOS', $liberado_pontos);
	$stmt->bindParam(':LIBERADO_BRINDES', $liberado_brindes);
	
	$stmt->bindParam(':ID', $id); 
	
	$result = $stmt->execute(); 
	if ( ! $result )
{
    var_dump( $stmt->errorInfo() );
    exit;
}
   
	   
echo("<script type='text/javascript'> alert('Foi Alterado com sucesso'); location.href='anuncio_config_promocao.php';</script>");
	 exit;
 
?>

<?php
session_start(); 
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_adm = $_SESSION['ID'];

if ($id_adm == "" || $id_adm == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}



$altera = "UPDATE $tabela5 SET PONTOS_NIVEL_1=?, PONTOS_NIVEL_2=?, PONTOS_NIVEL_3=?, PONTOS_NIVEL_4=?, PONTOS_NIVEL_5=?, TALK_SIMULADOR=?, DOLARHOJE=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($_POST["indc_nivel1"],$_POST["indc_nivel2"],$_POST["indc_nivel3"],$_POST["indc_nivel4"],$_POST["indc_nivel5"],$_POST["status_talk_simulador"],$_POST["dolar_hj"],$id_adm));


if ($_POST["reniciar_talk_simulador"] == "SIM") {
	
	$reset_status = "DESATIVADO";
	$reset_data = "0000-00-00";
	$reset_id = "0";
	$reset_pontos = "0";
	
	$sql = $con->prepare("SELECT * FROM $tabela9 WHERE STATUS = 'ATIVO'");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ);

	$cliente_existe = count( $sql_verifc );
		
		
	foreach($sql_verifc as $ln_td) {  
	 
		$id_position = $ln_td->ID_POSICAO; 
		
		$altera = "UPDATE $tabela9 SET ID_CLIENTE=?, STATUS=?, PONTOS_SIMULADOR=?, DATA_CADASTRO_TALK_SIMULADOR=? WHERE ID_POSICAO=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($reset_id,$reset_status,$reset_pontos,$reset_data,$id_position));

	} 
	 
	 
	$simulador_novo = "";
	
	$sql = $con->prepare("SELECT * FROM $tabela3 WHERE TALK_SIMULADOR = 'SIM'");
	$sql->execute();
	$sql_verifc = $sql->fetchAll(PDO::FETCH_OBJ); 
	foreach($sql_verifc as $ln_td) {  
	 
		$altera = "UPDATE $tabela3 SET TALK_SIMULADOR=?";
		$alt_q = $con->prepare($altera);
		$alt_q->execute(array($simulador_novo));
		 
	}

} 
echo("<script type='text/javascript'> alert('Altera\u00e7\u00e3o Efetuada com Sucesso !!!'); location.href='dadosprojeto.php';</script>");
 
?>

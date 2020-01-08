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
$pontos_ganhos = $_POST["pontos_ganhos"];
$tempo_espera = $_POST["tempo_espera"];
$qts_pacotes_premiados = $_POST["qts_pacotes_premiados"]; 
$qts_pontos_gerados = $_POST["qts_pontos_gerados"];

$pontos_ganhos_tms_clientes = $_POST["pontos_ganhos_tms_clientes"];
$pontos_ganhos_tms_nivel1 = $_POST["pontos_ganhos_tms_nivel1"];
$pontos_ganhos_tms_nivel2 = $_POST["pontos_ganhos_tms_nivel2"];
$pontos_ganhos_tms_nivel3 = $_POST["pontos_ganhos_tms_nivel3"];
$pontos_ganhos_tms_nivel4 = $_POST["pontos_ganhos_tms_nivel4"];
$pontos_ganhos_tms_nivel5 = $_POST["pontos_ganhos_tms_nivel5"];

$liberado = $_POST["liberado"];   
  
  
	// altera dados...  
	$altera = "UPDATE $tabela19 SET PONTOS_GANHOS=?, 
									TEMPO_ESPERA=?, 
									QTS_PACOTES_PAGOS=?, 
									QTS_PONTOS_GERADOS=?, 
									TMS_PONTOS_CLIENTE=?,
									TMS_PONTOS_NIVEL1=?,
									TMS_PONTOS_NIVEL2=?,
									TMS_PONTOS_NIVEL3=?,
									TMS_PONTOS_NIVEL4=?,
									TMS_PONTOS_NIVEL5=?,
									LIBERADO=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($pontos_ganhos,
						$tempo_espera,
						$qts_pacotes_premiados,
						$qts_pontos_gerados,
						$pontos_ganhos_tms_clientes,
						$pontos_ganhos_tms_nivel1,
						$pontos_ganhos_tms_nivel2,
						$pontos_ganhos_tms_nivel3,
						$pontos_ganhos_tms_nivel4,
						$pontos_ganhos_tms_nivel5,
						$liberado,$id));
 
	 
echo("<script type='text/javascript'> alert('Foi Alterado com sucesso'); location.href='anuncio_config.php';</script>");
	 
 
?>

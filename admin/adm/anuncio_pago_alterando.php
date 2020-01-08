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
$url_banner = $_POST["url_banner"];
$link_banner = $_POST["link_banner"];
$data_pago = $_POST["data_pago"];
$data_pago = implode("-",array_reverse(explode("/", $data_pago)));
$data_vencimento = $_POST["data_vencimento"]; 
$data_vencimento = implode("-",array_reverse(explode("/", $data_vencimento)));  
  
  
	// altera dados... ativa posicao
	$altera = "UPDATE $tabela18 SET ANUNCIO_URL=?, ANUNCIO_LINK=?, DATA_PAGAMENTO=?, DATA_VENCIMENTO=? WHERE ID=?";
	$alt_q = $con->prepare($altera);
	$alt_q->execute(array($url_banner,$link_banner,$data_pago,$data_vencimento,$id));
 
	 
echo("<script type='text/javascript'> alert('Foi Alterado com sucesso'); location.href='anuncio_pago.php';</script>");
	 
 
?>

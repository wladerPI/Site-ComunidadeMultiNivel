<?php 		
	include("../config/config.php"); 
	
	$email = $_POST['email']; 
	$senha = $_POST['senha'];
	 
	 if ($email == "" || $senha == "") {
		echo("<script type='text/javascript'> alert('Preencha os campos de acesso corretamente !!!'); location.href='$url';</script>");
		exit;
	 }
try {	
	$sql_login = $con->prepare("SELECT * FROM $tabela2 WHERE EMAIL_ADM = '".$email."' && SENHA_ADM = '".$senha."'"); 
	$sql_login->execute();
	$res_login = $sql_login->fetchAll(PDO::FETCH_OBJ); 
	 foreach($res_login as $ln_login) { 
		$id_adm = $ln_login->ID; 
	} 
	$total = count( $res_login );  
	
	if ( $total > 0 ){   
			session_start(); 
			$_SESSION["ID"] = $id_adm;  
			header("Location: adm/index.php");  
	} else {	
		echo("<script type='text/javascript'> alert('Dados Inv\xE1lidos ou inexistentes !!!'); location.href='index.php';</script>");
		exit;
	}  
} catch(PODException $e_login) {
	echo "Erro:/n".$e_login->getMessage();
}  
?>
<?php 		
	include("../config/config.php"); 
	
	$email_login = $_POST['email_login']; 
	$senha_login = $_POST['senha_login'];
	 
	 
try {	
	$sql_login = $con->prepare("SELECT * FROM $tabela3 WHERE EMAIL = '".$email_login."' && SENHA = '".$senha_login."'"); 
	$sql_login->execute();
	$res_login = $sql_login->fetchAll(PDO::FETCH_OBJ); 
	 foreach($res_login as $ln_login) {
		$nome = $ln_login->NOME;
		$id_cliente = $ln_login->ID; 
	} 
	$total = count( $res_login );  
	
	if ( $total > 0 ){   
			session_start();
			$_SESSION["NOME_CLIENTE"] = $nome;
			$_SESSION["ID_CLIENTE"] = $id_cliente;  
			
			$Ultimoacesso = date('Y-m-d H:i:s'); 

			// query
			$sql = "UPDATE $tabela3 SET ULTIMOACESSO=? WHERE ID=?";
			$q = $con->prepare($sql);
			$q->execute(array($Ultimoacesso,$id_cliente)); 
			header("Location: ../adm_clientes/index.php"); 
			
	} else {	
		echo("<script type='text/javascript'> alert('Dados Inv\xE1lidos ou inexistentes !!!'); location.href='home';</script>");
		EXIT;
	}  
} catch(PODException $e_login) {
	echo "Erro:/n".$e_login->getMessage();
}  
?>
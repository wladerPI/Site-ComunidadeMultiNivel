<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);
date_default_timezone_set('America/Sao_Paulo');  

$id_adm = $_SESSION['ID'];

if ($id_adm == "" || $id_adm == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}

$id_posicao = $_POST["id_posicao"];
$id_do_cliente = $_POST["id_do_cliente"];
$status = "ATIVO";
$dia = date('Y-m-d');
$ip = "";
$hora = date('H:i:s');

 // ATIVANDO SOLICITACAO
$altera = "UPDATE $tabela22 SET STATUS=? WHERE ID=?";
$alt_q = $con->prepare($altera);
$alt_q->execute(array($status,$id_posicao));

 

// distribuir pontuacao para todos os 5 niveis 

// SOMAR PONTUACAO
	// busca pontos
	try {
		$sql_verifc = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
		$sql_verifc->execute();
		$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc as $ln_verifc) {
			$pontos_cliente = $ln_verifc->TMS_PONTOS_CLIENTE;
			$pontos_nivel_1 = $ln_verifc->TMS_PONTOS_NIVEL1; 
			$pontos_nivel_2 = $ln_verifc->TMS_PONTOS_NIVEL2;
			$pontos_nivel_3 = $ln_verifc->TMS_PONTOS_NIVEL3;
			$pontos_nivel_4 = $ln_verifc->TMS_PONTOS_NIVEL4;
			$pontos_nivel_5 = $ln_verifc->TMS_PONTOS_NIVEL5;
		} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
	} 
 
	
	
// add pontos para o cliente
	// busca proximo cliente
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_do_cliente'");
		$sql_verifc2->execute();
		$res_alt = $sql_verifc2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_alt as $res_verifc2) {   
				$cliente_do_nivel1 = $res_verifc2->ID_INDICACAO; // busca proximo cliente
		}
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	}  
	// verifica se cliente ja esta pontuado nas DICAS
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_do_cliente'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 );
		 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	 
	
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $id_do_cliente, ':PONTOS' => $pontos_cliente, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$id_do_cliente'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_cliente; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$id_do_cliente));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$id_do_cliente' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_cliente; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $id_do_cliente, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}   
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_cliente;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
			
	
	
// add pontos para o cliente NIVEL 1
	// busca proximo cliente
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$cliente_do_nivel1'");
		$sql_verifc2->execute();
		$res_alt = $sql_verifc2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_alt as $res_verifc2) {   
				$cliente_do_nivel2 = $res_verifc2->ID_INDICACAO; // busca proximo cliente
		}
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente existe
	if ($cliente_do_nivel1 >= 1 && $cliente_do_nivel1 != "") {
		$existe_cliente_nivel1 = "SIM";
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel1'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 ); 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente ja esta pontuado nas DICAS
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $cliente_do_nivel1, ':PONTOS' => $pontos_nivel_1, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel1'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_nivel_1; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$cliente_do_nivel1));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$cliente_do_nivel1' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_nivel_1; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $cliente_do_nivel1, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}  
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_nivel_1;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
		
	} else {
		// esse  cliente nao existe
	}


// add pontos para o cliente NIVEL 2
	// busca proximo cliente
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$cliente_do_nivel2'");
		$sql_verifc2->execute();
		$res_alt = $sql_verifc2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_alt as $res_verifc2) {   
				$cliente_do_nivel3 = $res_verifc2->ID_INDICACAO; // busca proximo cliente
		}
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente existe
	if ($cliente_do_nivel2 >= 1 && $cliente_do_nivel2 != "") { 
		$existe_cliente_nivel2 = "SIM";
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel2'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 ); 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente ja esta pontuado nas DICAS
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $cliente_do_nivel2, ':PONTOS' => $pontos_nivel_2, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel2'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_nivel_2; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$cliente_do_nivel2));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$cliente_do_nivel2' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_nivel_2; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $cliente_do_nivel2, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}  
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_nivel_2;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
		
	} else {
		// esse  cliente nao existe
	}

// add pontos para o cliente NIVEL 3
	// busca proximo cliente
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$cliente_do_nivel3'");
		$sql_verifc2->execute();
		$res_alt = $sql_verifc2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_alt as $res_verifc2) {   
				$cliente_do_nivel4 = $res_verifc2->ID_INDICACAO; // busca proximo cliente
		}
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente existe
	if ($cliente_do_nivel3 >= 1 && $cliente_do_nivel3 != "") {
		$existe_cliente_nivel3 = "SIM";
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel3'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 ); 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente ja esta pontuado nas DICAS
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $cliente_do_nivel3, ':PONTOS' => $pontos_nivel_3, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel3'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_nivel_3; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$cliente_do_nivel3));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$cliente_do_nivel3' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_nivel_3; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $cliente_do_nivel3, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}  
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_nivel_3;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
		
	} else {
		// esse  cliente nao existe
	}

// add pontos para o cliente NIVEL 4
	// busca proximo cliente
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$cliente_do_nivel4'");
		$sql_verifc2->execute();
		$res_alt = $sql_verifc2->fetchAll(PDO::FETCH_OBJ); 
		foreach($res_alt as $res_verifc2) {   
				$cliente_do_nivel5 = $res_verifc2->ID_INDICACAO; // busca proximo cliente
		}
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente existe
	if ($cliente_do_nivel4 >= 1 && $cliente_do_nivel4 != "") {
		$existe_cliente_nivel4 = "SIM";
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel4'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 ); 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente ja esta pontuado nas DICAS
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $cliente_do_nivel4, ':PONTOS' => $pontos_nivel_4, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel4'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_nivel_4; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$cliente_do_nivel4));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$cliente_do_nivel4' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_nivel_4; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $cliente_do_nivel4, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}  
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_nivel_4;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
		
	} else {
		// esse  cliente nao existe
	}

// add pontos para o cliente NIVEL 5
	  
	// verifica se cliente existe
	if ($cliente_do_nivel5 >= 1 && $cliente_do_nivel5 != "") {
		$existe_cliente_nivel5 = "SIM";
	try {
		$sql_verifc2 = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel5'");
		$sql_verifc2->execute();
		$res_verifc2 = $sql_verifc2->fetchAll(PDO::FETCH_OBJ);
		$quantreg_cliente = count( $res_verifc2 ); 
	} catch(PODException $e_verifc2) {
		echo "Erro:/n".$e_verifc2->getMessage();
	} 
	
	// verifica se cliente ja esta pontuado nas DICAS
	if ($quantreg_cliente <= 0) {
		// Inserindo e pontuando novo cliente nas DICAS
			$run = $con->prepare("INSERT INTO $tabela20 (ID_CLIENTE, PONTOS, DATA) VALUES (:ID_CLIENTE, :PONTOS, :DATA)");
			$dados = array(':ID_CLIENTE' => $cliente_do_nivel5, ':PONTOS' => $pontos_nivel_5, ':DATA' => $dia);
			$cadastra = $run->execute($dados);
		
	} else {
		// alterando pontuacao do cliente nas DICAS
			$sql_alt = $con->prepare("SELECT * FROM $tabela20 WHERE ID_CLIENTE = '$cliente_do_nivel5'");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			foreach($res_alt as $ln_alt) {  
				$pontos_atual = $ln_alt->PONTOS+$pontos_nivel_5; 
			}
			$altera = "UPDATE $tabela20 SET PONTOS=? WHERE ID_CLIENTE=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($pontos_atual,$cliente_do_nivel5));
	}
			// registrando pontuacao do cliente no historico
			$sql_alt = $con->prepare("SELECT * FROM $tabela21 WHERE ID_CLIENTE = '$cliente_do_nivel5' order by ID desc LIMIT 1");
			$sql_alt->execute();
			$res_alt = $sql_alt->fetchAll(PDO::FETCH_OBJ);
			$qts_alt = count( $res_alt );
			foreach($res_alt as $ln_alt) {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			if ($qts_alt <= 0) {
				$novo_dia = "1";
			} else {  
				$novo_dia = $ln_alt->DIA_ULTIMO_VISTO; 
			}
			
			// roda o loop gravando cada pontos
			for( $i=1; $i <= $pontos_nivel_5; $i++) { 
				$run = $con->prepare("INSERT INTO $tabela21 (ID_CLIENTE, DIA_ULTIMO_VISTO, DATA, IP, HORAS) VALUES (:ID_CLIENTE, :DIA_ULTIMO_VISTO, :DATA, :IP, :HORAS)");
				$dados = array(':ID_CLIENTE' => $cliente_do_nivel5, ':DIA_ULTIMO_VISTO' => $novo_dia, ':DATA' => $dia, ':IP' => $ip, ':HORAS' => $hora);
				$cadastra = $run->execute($dados);
			}  
			// atualiza pontuacao no adm config  
			$sql_config2 = $con->prepare("SELECT * FROM $tabela19 WHERE ID = '1'");
			$sql_config2->execute();
			$res_config2 = $sql_config2->fetchAll(PDO::FETCH_OBJ);
			foreach($res_config2 as $ln_config2) {  
				$total_pontos_gravados2 = $ln_config2->QTS_PONTOS_GRAVADOS_ATUAL;
				$total_pontos_a_ser_gerados2 = $ln_config2->QTS_PONTOS_GERADOS;
			}
			
			$id_1 = "1";
			$grava_pontos_atual = $total_pontos_gravados2+$pontos_nivel_5;
			$altera = "UPDATE $tabela19 SET QTS_PONTOS_GRAVADOS_ATUAL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($grava_pontos_atual,$id_1));
		
	} else {
		// esse  cliente nao existe
	}
			
	
	 
	
// enviando email para o cliente 	  

// busca dados do cliente
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_do_cliente'");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente = $ln2->NOME; 
	$emailcliente = $ln2->EMAIL;
	
}
echo $emailcliente." e ". $nomecliente;
// busca email do server
$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
   
date_default_timezone_set('Etc/UTC'); 
require '../../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 



 // corpo do EMAIL  
$body = "
		Prezado(a) $nomecliente, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_cliente pontos no RANK de Premia&ccedil;&otilde;es</b> na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram seu registro na TrafficMonsoon. Agora voc&ecirc; faz parte de nossa equipe tamb&eacute;m dentro da TrafficMonsoon. 
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>  
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Parabens !! Seu registro na TrafficMonsoon foi aprovado na ComunidadeMultiNivel";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
		Prezado(a) $nomecliente, Voc&ecirc; acabou de ganhar  $pontos_cliente pontos no RANK de Premia&ccedil;&otilde;es na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram seu registro na TrafficMonsoon. Agora voc&ecirc; faz parte de nossa equipe tamb&eacute;m dentro da TrafficMonsoon. 
 	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
	
	$mail->addAddress($emailcliente, $nomecliente);
    
	  
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();  




if ($existe_cliente_nivel1 == "SIM") {	
// busca dados do cliente do nivel 1
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $cliente_do_nivel1");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente_nivel1 = $ln2->NOME; 
	$emailcliente_nivel1 = $ln2->EMAIL;
}
// enviando email para  cliente do nivel 1
$body = "
		Prezado $nomecliente_nivel1, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_nivel_1 pontos no RANK de Premia&ccedil;&otilde;es</b>, na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro do seu afil&iacute;ado ($nomecliente) na TrafficMonsoon. Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>  
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Voce ganhou $pontos_nivel_1 pontos no RANK de Premiacoes!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado $nomecliente_nivel1, Voc&ecirc; acabou de ganhar $pontos_nivel_1 pontos no RANK de Premia&ccedil;&otilde;es, na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro do seu afil&iacute;ado ($nomecliente) na TrafficMonsoon. Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		  
			Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
  
	$mail->addAddress($emailcliente_nivel1, $nomecliente_nivel1);
     
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente_nivel1) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
 
if ($existe_cliente_nivel2 == "SIM") {
 // busca dados do cliente do nivel 2
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $cliente_do_nivel2");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente_nivel2 = $ln2->NOME; 
	$emailcliente_nivel2 = $ln2->EMAIL;
}
// enviando email para  cliente do nivel 2
$body = "
		Prezado $nomecliente_nivel2, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_nivel_2 pontos no RANK de Premia&ccedil;&otilde;es</b>, na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>  
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Voce ganhou $pontos_nivel_2 pontos no RANK de Premiacoes!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado $nomecliente_nivel2, Voc&ecirc; acabou de ganhar $pontos_nivel_2 pontos no RANK de Premia&ccedil;&otilde;es, na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		  
			Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  
";
 
  
	$mail->addAddress($emailcliente_nivel2, $nomecliente_nivel2);
     
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente_nivel2) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
}
 
 
if ($existe_cliente_nivel3 == "SIM") { 
 // busca dados do cliente do nivel 3
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $cliente_do_nivel3");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente_nivel3 = $ln2->NOME; 
	$emailcliente_nivel3 = $ln2->EMAIL;
}
// enviando email para  cliente do nivel 3
$body = "
		Prezado $nomecliente_nivel3, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_nivel_3 pontos no RANK de Premia&ccedil;&otilde;es</b>, na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>   
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Voce ganhou $pontos_nivel_3 pontos no RANK de Premiacoes!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado $nomecliente_nivel3, Voc&ecirc; acabou de ganhar $pontos_nivel_3 pontos no RANK de Premia&ccedil;&otilde;es, na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		  
			Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o. 
";
 
  
	$mail->addAddress($emailcliente_nivel3, $nomecliente_nivel3);
     
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente_nivel3) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
}
 
 
 
if ($existe_cliente_nivel4 == "SIM") { 
  // busca dados do cliente do nivel 4
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $cliente_do_nivel4");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente_nivel4 = $ln2->NOME; 
	$emailcliente_nivel4 = $ln2->EMAIL;
}
// enviando email para  cliente do nivel 4
$body = "
		Prezado $nomecliente_nivel4, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_nivel_4 pontos no RANK de Premia&ccedil;&otilde;es</b>, na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>  
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Voce ganhou $pontos_nivel_4 pontos no RANK de Premiacoes!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado $nomecliente_nivel4, Voc&ecirc; acabou de ganhar $pontos_nivel_4 pontos no RANK de Premia&ccedil;&otilde;es, na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		  
			Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.   
";
 
  
	$mail->addAddress($emailcliente_nivel4, $nomecliente_nivel4);
     
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente_nivel4) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
}
 
if ($existe_cliente_nivel5 == "SIM") {
  // busca dados do cliente do nivel 5
$sql2 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $cliente_do_nivel5");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ);
	 
foreach($res2 as $ln2) {  
	$nomecliente_nivel5 = $ln2->NOME; 
	$emailcliente_nivel5 = $ln2->EMAIL;
}
// enviando email para  cliente do nivel 5
$body = "
		Prezado $nomecliente_nivel5, Voc&ecirc; acabou de ganhar <b style='color:red;'>$pontos_nivel_5 pontos no RANK de Premia&ccedil;&otilde;es</b>, na ferramenta de trabalho (Dicas Di&aacute;rias).
		<br><br>
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		<br><br>	 
		Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
		<br><br>  
		<b>Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es</b>
		<br>
		<table style='width:35%;background:#e5e7e7;text-align:center;'>
			<tr>
				<td style='border:2px solid #000;'>N&Iacute;VEIS</td>
				<td style='border:2px solid #000;'>QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 1</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_1 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 2</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_2 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 3</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_3 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 4</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_4 PONTOS</td> 
			</tr>
			<tr> 
				<td style='border:2px solid #000;'>N&iacute;vel 5</td>
				<td style='border:2px solid #000;'>+$pontos_nivel_5 PONTOS</td> 
			</tr>
		</table>
		<br><br>  
		<i style='color:red;'>Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente.</i>
		<br><br> 
		<table style='width:40%;'>
			<tr>
					<td><a href='http://www.comunidademultinivel.com.br/forum' title='Clique aqui para ir at&eacute; o F&oacute;rum'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/logo_forum_comunidademultinivel.png' width='40' height='40' alt='For&uacute;m da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/ComunidadeMultiNivel' title='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/pagina-facebook-comunidade-multinivel.png' width='40' height='40' alt='P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://goo.gl/4zDgYr' title='Canal no YouTube da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/canal-yotube-comunidade-multinivel.png' width='40' height='40' alt='Canal no YouTube da ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='http://www.comunidademultinivel.com.br/' title='Site ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/img/logotipo.gif' width='40' height='40' alt='Site ComunidadeMultiN&iacute;vel'  /></a></td>
					<td><a href='https://www.facebook.com/groups/simuladortalkfusion/' title='GRUPO no Facebook da ComunidadeMultiN&iacute;vel'><img  src='http://www.comunidademultinivel.com.br/adm_clientes/img/grupo-facebook-comunidade-multinivel.jpg' width='250' height='100' alt='GRUPO de suporte no Facebook da ComunidadeMultiN&iacute;vel'  /></a></td>
				</tr>
		</table>
		<br><br>
		<hr>
		<b style='color:red;'>Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.  <br>
		<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>  <br>
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b><br>    
 ";

$mail->isSMTP();
$mail->Host = 'smtp.comunidademultinivel.com.br';
$mail->SMTPAuth = true;
$mail->SMTPKeepAlive = true; // SMTP connection will not close after each email sent, reduces SMTP overhead
$mail->Port = 587;
$mail->Username = $seuemail;
$mail->Password = "cm393pi";
$mail->setFrom("$seuemail", 'Comunidade MultiNivel');
$mail->addReplyTo("$seuemail", 'Comunidade MultiNivel');

$mail->Subject = "Voce ganhou $pontos_nivel_5 pontos no RANK de Premiacoes!";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado $nomecliente_nivel5, Voc&ecirc; acabou de ganhar $pontos_nivel_5 pontos no RANK de Premia&ccedil;&otilde;es, na ferramenta de trabalho (Dicas Di&aacute;rias).
		 
		Os moderadores da ComunidadeMultiN&iacute;vel confirmaram o registro na TrafficMonsoon, de um afil&iacute;ado de sua rede($nomecliente). Parab&eacute;ns, trabalhando juntos, conquistaremos nossas metas e nossos objetivos ser&atilde;o alcan&ccedil;ados.
		  
			Precisamos de seu comprometimento e participa&ccedil;&atilde;o diariamente para dividirmos maiores rendimentos, sendo que o lucro de comiss&otilde;es gerado para ComunidadeMultiN&iacute;vel, ser&atilde;o totalmente remunerados para financiarmos os premiados do (RANK de Premia&ccedil;&otilde;es) da ferramenta de trabalho 'Dicas di&aacute;rias'.
	 
		 Quanto mais pontos voc&ecirc; somar no RANK de PREMIA&Ccedil;&Atilde;O, maiores as probabilidades de voc&ecirc aumentar seus rendimentos financeiros. Veja na Tabela abaixo. Sempre quando um indicado seu, direto ou indireto tamb&eacute;m se cadastrar na empresa de publicidade TrafficMonsoon CORRETAMENTE, voc&ecirc; ganhar&aacute; pontos em at&eacute; 5 n&iacute;veis de indica&ccedil;&otilde;es 
 
	 N&Iacute;VEIS 
	 QUANTIDADE DE PONTOS QUE VOC&Ecirc; GANHA 
	 N&iacute;vel 1 +$pontos_nivel_1 PONTOS 
	 N&iacute;vel 2 +$pontos_nivel_2 PONTOS 
	 N&iacute;vel 3 +$pontos_nivel_3 PONTOS 
	 N&iacute;vel 4 +$pontos_nivel_4 PONTOS 
	 N&iacute;vel 5 +$pontos_nivel_5 PONTOS 
	
	Auxilie seus indicados diretos e indiretos a tamb&eacute;m indicar seus amigos gratuitamente, sendo assim voc&ecirc; conquistar&aacute; uma grande quantidade de pontos diariamente. 
	
	http://www.comunidademultinivel.com.br/forum Clique aqui para ir at&eacute; o F&oacute;rum 
	 https://www.facebook.com/ComunidadeMultiNivel P&aacute;gina do Facebook da ComunidadeMultiN&iacute;vel 
	 http://goo.gl/4zDgYr Canal no YouTube da ComunidadeMultiN&iacute;vel 
	 http://www.comunidademultinivel.com.br/ Site ComunidadeMultiN&iacute;vel 
	 https://www.facebook.com/groups/simuladortalkfusion/ GRUPO no Facebook da ComunidadeMultiN&iacute;vel 
	 
	Atenciosamente ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes.   
	 www.comunidademultinivel.com.br 
		O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.   
";
 
  
	$mail->addAddress($emailcliente_nivel5, $nomecliente_nivel5);
     
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $emailcliente_nivel5) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
 		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments(); 
} 
 
  
  echo("<script type='text/javascript'> alert('Registro ATIVADO com sucesso !!!'); location.href='posicoes_trafficmonsoon.php';</script>");	
 
 
 
  
?>


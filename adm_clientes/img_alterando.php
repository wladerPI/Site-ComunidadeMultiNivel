<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE);
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

$img_altera = $_FILES["img_altera"];
$img = $_FILES["img"];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
if ($img != "" || $img != 0) {
	// AQ INSERE IMAGEM

	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'img_perfil/';

	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');

	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['img']['error'] != 0) {
		die("<script type='text/javascript'> alert('N\u00e3o foi poss\u00edvel fazer o upload, erro:" . $_UP['erros'][$_FILES['img']['error']]." !!!'); location.href='imagem_perfil.php';</script>");
		exit; // Para a execução do script
	}

	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

	// Faz a verificação da extensão do arquivo
	
	$arr = explode( '.', $_FILES['img']['name']) ;
	$extensao = end( $arr );  
	if (array_search($extensao, $_UP['extensoes']) === false) {
		echo("<script type='text/javascript'> alert('Por favor, envie uma foto com as seguintes extens\u00f5es: jpg, png ou gif !!!'); location.href='imagem_perfil.php';</script>"); 
		exit;
	}

	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['img']['size']) {
		echo("<script type='text/javascript'> alert('A foto enviada \u00e9 muito grande, envie uma foto de at\u00e9 2Mb !!!'); location.href='imagem_perfil.php';</script>"); 
		exit;
	}

	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) {
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg 
			$nome_final = $id_cliente.'.jpg';
		} else {
			// Mantém o nome original do arquivo
			$nome_final = $id_cliente.'.jpg';
		}

		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['img']['tmp_name'], $_UP['pasta'] . $nome_final)) {
			// Upload efetuado com sucesso, exibe uma mensagem de sucesso 
			$altera = "UPDATE $tabela3 SET FOTO_PERFIL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($nome_final,$id_cliente));
			
			echo("<script type='text/javascript'> alert('A Foto do seu Perfil foi enviada com sucesso!!!'); location.href='imagem_perfil.php';</script>");
			exit;
		} else {
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
			echo("<script type='text/javascript'> alert('N \u00e3o foi poss\u00edvel enviar a foto, tente novamente!!!'); location.href='imagem_perfil.php';</script>"); 
			exit;
		}
	}	
} else if ($img_altera != "" || $img_altera != 0) {
	 // AQ ALTERA IMAGEM
 
	// Pasta onde o arquivo vai ser salvo
	$_UP['pasta'] = 'img_perfil/';

	// Tamanho máximo do arquivo (em Bytes)
	$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb

	// Array com as extensões permitidas
	$_UP['extensoes'] = array('jpg', 'png', 'gif');

	// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
	$_UP['renomeia'] = false;

	// Array com os tipos de erros de upload do PHP
	$_UP['erros'][0] = 'Não houve erro';
	$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
	$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
	$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
	$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

	// Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
	if ($_FILES['img_altera']['error'] != 0) {
		die("<script type='text/javascript'> alert('N\u00e3o foi poss\u00edvel fazer o upload, erro:" . $_UP['erros'][$_FILES['img_altera']['error']]." !!!'); location.href='imagem_perfil.php';</script>");
		exit; // Para a execução do script
	}

	// Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar

	// Faz a verificação da extensão do arquivo
	$arr = explode( '.', $_FILES['img_altera']['name']) ;
	$extensao = end( $arr );  
	if (array_search($extensao, $_UP['extensoes']) === false) {
		echo("<script type='text/javascript'> alert('Por favor, envie uma foto com as seguintes extens\u00f5es: jpg, png ou gif !!!'); location.href='imagem_perfil.php';</script>"); 
		exit;
	}

	// Faz a verificação do tamanho do arquivo
	else if ($_UP['tamanho'] < $_FILES['img_altera']['size']) {
		echo("<script type='text/javascript'> alert('A foto enviada \u00e9 muito grande, envie uma foto de at\u00e9 2Mb !!!'); location.href='imagem_perfil.php';</script>"); 
		exit;
	}

	// O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
	else {
		// Primeiro verifica se deve trocar o nome do arquivo
		if ($_UP['renomeia'] == true) {
			// Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
			$nome_final = $id_cliente.'.jpg';
		} else {
			// Mantém o nome original do arquivo
			$nome_final = $id_cliente.'.jpg';
		} 
		try {
				$sql_exclui = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
				$sql_exclui->execute();
				$res_exclui = $sql_exclui->fetchAll(PDO::FETCH_OBJ);
				foreach($res_exclui as $ln_exclui) { 
					$foto_exclui = $ln_exclui->FOTO_PERFIL;
				}	 
			} catch(PODException $e_verifc) {
				echo "Erro:/n".$e_verifc->getMessage();
			} 
			
			unlink($_UP['pasta'].'/'.$foto_exclui);
			
		// Depois verifica se é possível mover o arquivo para a pasta escolhida
		if (move_uploaded_file($_FILES['img_altera']['tmp_name'], $_UP['pasta'] . $nome_final)) {
			 
			// Upload efetuado com sucesso, exibe uma mensagem de sucesso 
			$altera = "UPDATE $tabela3 SET FOTO_PERFIL=? WHERE ID=?";
			$alt_q = $con->prepare($altera);
			$alt_q->execute(array($nome_final,$id_cliente));
			
			echo("<script type='text/javascript'> alert('A Foto do seu Perfil foi alterado com sucesso!!!'); location.href='imagem_perfil.php';</script>");
			exit;
		} else {
			// Não foi possível fazer o upload, provavelmente a pasta está incorreta
			echo("<script type='text/javascript'> alert('N \u00e3o foi poss\u00edvel enviar a foto, tente novamente!!!'); location.href='imagem_perfil.php';</script>"); 
			exit;
		}
	}
} else {
	echo("<script type='text/javascript'> alert('Ocorreu um ERRO inesperado, contate o administrador do site !!!'); location.href='imagem_perfil.php';</script>");
	exit;
}
 
?>

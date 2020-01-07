<?PHP
include("../config/config.php"); 
header("Content-Type: text/html; charset=ISO-8859-1",true);
try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) {
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title> .: Comunidade MultiN&iacute;vel :. </title>
	<link rel="icon" href="<?php echo $ln->ICO_FAVICON_LINK; ?>" type="image/x-icon" />
	
<?php
	} 
	
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
}
?>
	<link rel='stylesheet' type='text/css' href='../css/css.css'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script>
function verifica() {
	if (form.email.value == "") { 
		alert("O E-mail \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.forms[0].email");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    }
	if (form.senha.value == "") { 
		alert("O campo Senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
}
</script>
 
</head>

<body>

<div id="fundo-externo">
	<div id="fundo">
		<img src="../img/bg.jpg" alt="Sistema controlador do MMN" />
	</div>
</div>
<div id="site"> 
	<h1 style="text-align:center;">&Aacute;rea Restrita para os Administradores</h1> <br />
	<form name="form" id="form" method="post" action="logando_adm.php"> 
        <b>E-mail:* </b><input type="text" name="email" value="" class="form_email_admin" onFocus="this.className='form_email_admin_foco'" onBlur="this.className='form_email_admin'"/><br>
		<b>Senha:* </b><input type="password" name="senha" value="" class="form_senha_admin" onFocus="this.className='form_senha_admin_foco'" onBlur="this.className='form_senha_admin'"/><br>
        <input type="submit"  value="ACESSAR" class="form_bot_adm" Onclick="return verifica()" />
		
    </form><br><br><br>
	<i>Aten&ccedil;&atilde;o Esse painel &eacute restrito apenas para administradores.</i><br>
</div>
</div>
</body>
</html>
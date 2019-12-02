<?php
session_start(); 
include("../config/config.php"); 
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}



try {
	$sql_verifc = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_verifc->execute();
	$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
	foreach($res_verifc as $ln_verifc) {
		$id = $ln_verifc->ID; 
		$nome = $ln_verifc->NOME;
		$pais = $ln_verifc->PAIS;
		$estado = $ln_verifc->ESTADO;
		$cidade = $ln_verifc->CIDADE;
		$tel = $ln_verifc->TELEFONE;
		$cel = $ln_verifc->CELULAR;
		$skype = $ln_verifc->SKYPE;
		$facebook = $ln_verifc->FACEBOOK;
		$email = $ln_verifc->EMAIL;
		$pontos = $ln_verifc->PONTOS; 		
		$data = $ln_verifc->DATA_CADASTRO;
		$data = implode("/",array_reverse(explode("-",$data)));
		$foto_perfil = $ln_verifc->FOTO_PERFIL;
	}	 
} catch(PODException $e_verifc) {
	echo "Erro:/n".$e_verifc->getMessage();
} 

try {
	$sql = $con->prepare("SELECT * FROM $tabela2");
	$sql->execute();
	$res = $sql->fetchAll(PDO::FETCH_OBJ);
	foreach($res as $ln) { 
		$icon = $ln->ICO_FAVICON_LINK;  
	} 
} catch(PODException $e) {
	echo "Erro:/n".$e->getMessage();
} 




?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | &Aacute;rea Administrativa do Cliente</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
        <!-- bootstrap 3.0.2 -->
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->
        <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]--> 
    </head> 
    <body class="skin-blue">
        <?php  include("topo.php"); ?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <!-- Left side column. contains the logo and sidebar -->
            <?php  include("menue.php"); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Painel de Controle</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-dashboard"></i> Painel</a></li>
                        <li class="active">Perfil</li>
                    </ol>
                </section>
 
                <!-- Main content -->
                <section class="content">
 
 
  <div style="text-align:center;width:100%;">				
						<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
</div> 	


<!-- centro -->					
<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Dados Pessoais do seu Perfil</h3>
    </div><!-- /.box-header -->
    <!-- form start -->
	
<Script type = "text/javascript">

function verifica() { 
	if (form.nome_altera.value == "") { 
		alert("O Nome \xE9 obrigat\xF3rio"); 
		return false;   
    }  
	if (form.pais_altera.value == "") { 
		alert("O campo Pais \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.estado_altera.value == "") { 
		alert("O campo Estado \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.cidade_altera.value == "") { 
		alert("O campo Cidade \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.tel_altera.value == "" && form.cel_altera.value == "" && form.skype_altera.value == "" && form.facebook_altera.value == "") { 
		alert("Pelo menos um dos camos (Telefone, Celular, Skype ou Facebook) \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email_altera.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.form.email_altera");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    } 
	
<?php
try {
		$sql_altera = $con->prepare("SELECT * FROM $tabela3");
		$sql_altera->execute();
		$res_altera = $sql_altera->fetchAll(PDO::FETCH_OBJ);
		foreach($res_altera as $ln_altera) {
?>
	
	if (form.email_altera.value != "<?php echo $email; ?>" && form.email_altera.value == "<?php echo $ln_altera->EMAIL; ?>") { 
		alert("Esse E-mail ja esta cadastrado no sistema."); 
		return false;   
    } 

<?php  
} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
} 
?>		  
}
</script>
    <form id="form" name="form" method="post" action="perfil_alterando.php">
		<div class="box-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nome Completo*:</label> <i class="fa fa-user"></i> <input type="text" name="nome_altera" value="<?php echo $nome; ?>" class="form-control"  id="exampleInputEmail1" placeholder="Digite seu Nome" />
				<label for="exampleInputEmail1">Pa&iacute;s*:</label> <input type="text" name="pais_altera" value="<?php echo $pais; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Pa&iacute;s" />
				<label for="exampleInputEmail1">Estado*:</label> <input type="text" name="estado_altera" value="<?php echo $estado; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Estado" />
				<label for="exampleInputEmail1">Cidade*:</label> <input type="text" name="cidade_altera" value="<?php echo $cidade; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite sua Cidade" />
				<hr>
				<div class="alert alert-danger alert-dismissable">
					<i class="fa fa-ban"></i> 
					<b>* Pelo menos 1 dos 4 formul&aacute;rios de contatos abaixo ser&aacute; obrigat&oacute;rio.</i>
				</div>  
				<label for="exampleInputEmail1">DDD + Telefone (FIXO):</label> <i class="fa fa-phone"></i> <input type="text" name="tel_altera" value="<?php echo $tel; ?>" class="form-control" id="exampleInputEmail1" placeholder="(DDD) 00000000" />
				<label for="exampleInputEmail1">DDD + Celular:</label> <i class="fa fa-phone"></i> <input type="text" name="cel_altera" value="<?php echo $cel; ?>" class="form-control" id="exampleInputEmail1" placeholder="(DDD) 00000000" />
				<label for="exampleInputEmail1">Skyke:</label> <i class="fa fa-skype"></i> <input type="text" name="skype_altera" value="<?php echo $skype; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite seu skype" />
				<label for="exampleInputEmail1">Facebook: (URL)</label> <i class="fa fa-facebook-square"></i>  <input type="text" name="facebook_altera" value="<?php echo $facebook; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite seu Facebook: https://www.facebook.com/ComunidadeMultiNivel" />
				<hr>
				<label for="exampleInputEmail1">E-mail*:</label> <i class="fa fa-envelope"></i> <input type="text" name="email_altera" value="<?php echo $email; ?>" class="form-control" id="exampleInputEmail1" placeholder="Digite seu E-mail" /> 
				
            </div>
        </div><!-- /.box-body -->
		<div class="box-footer">
			<input type="submit" class="btn btn-primary" Onclick="return verifica()"  value="ALTERAR DADOS" /> 
        </div>
    </form>
</div><!-- /.box -->	
					
<!-- FIM centro -->						
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

        <!-- add new calendar event modal --> 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <!-- Morris.js charts -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
        <!-- Sparkline -->
        <script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
        <!-- jvectormap -->
        <script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
        <script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
        <!-- jQuery Knob Chart -->
        <script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
        <!-- daterangepicker -->
        <script src="js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- datepicker -->
        <script src="js/plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        <!-- iCheck -->
        <script src="js/plugins/iCheck/icheck.min.js" type="text/javascript"></script>

        <!-- AdminLTE App -->
        <script src="js/AdminLTE/app.js" type="text/javascript"></script>

        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="js/AdminLTE/dashboard.js" type="text/javascript"></script>

        <!-- AdminLTE for demo purposes -->
        <script src="js/AdminLTE/demo.js" type="text/javascript"></script>

    </body>
</html>
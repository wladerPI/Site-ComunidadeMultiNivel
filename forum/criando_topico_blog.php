<?php
session_start(); 
error_reporting(E_ALL & ~ E_NOTICE); 
include("../config/config.php");
header("Content-Type: text/html; charset=ISO-8859-1",true);

$id_cliente = $_SESSION['ID_CLIENTE'];

if ($id_cliente == "" || $id_cliente == 0 ) {
	echo("<script type='text/javascript'> alert('Para ter acesso a essa p\u00e1gina, voc\u00ea precisa estar LOGADO com seus dados de acesso !!!'); location.href='../index.php';</script>");
	exit;
}
 
 
$titulo = $_POST["titulo"];
$tags = $_POST["tags"];
$id_cliente_criador = $_POST["id_cliente_criador"];
$categoria = $_POST["categoria"]; 
$editor1 =  htmlentities((string)$_POST["editor1"], ENT_QUOTES, 'utf-8');
$dia = date('Y-m-d');
$visualizacao =  "0";

if ($titulo == "" || $editor1 == "") {
	echo("<script type='text/javascript'> alert('Os Campos T\u00edtulo e Texto do t\u00f3pico s\u00e3o obrigat\u00f3rios !!!'); location.href='../index.php';</script>");
	exit;
}
  
$run = $con->prepare("INSERT INTO $tabela10 (ID_CLIENTE, CATEGORIA, TITULO_TOPICO, TEXTO_TOPICO, TAGS_TOPICO, CONTADOR, DATA_TOPICO) VALUES (:ID_CLIENTE, :CATEGORIA, :TITULO_TOPICO, :TEXTO_TOPICO, :TAGS_TOPICO, :CONTADOR, :DATA_TOPICO)");
$dados = array(':ID_CLIENTE' => $id_cliente_criador, ':CATEGORIA' => $categoria, ':TITULO_TOPICO' => $titulo, ':TEXTO_TOPICO' => $editor1, ':TAGS_TOPICO' => $tags, ':CONTADOR' => $visualizacao, ':DATA_TOPICO' => $dia);
$cadastra = $run->execute($dados);
 
$id_cad = $con->lastInsertId();
   

$sql = $con->prepare("SELECT * FROM $tabela2");
$sql->execute();
$res = $sql->fetchAll(PDO::FETCH_OBJ);
foreach($res as $ln) { 
	$seuemail = $ln->EMAIL_ADM; 
} 
 
 $str = $titulo; 
 include_once "funcao_url.php"; 
 $url = $id_cad."-".RemoveAcentos($str);

	$sql3 = $con->prepare("SELECT * FROM $tabela3 WHERE ID = '$id_cliente_criador'");
	$sql3->execute();
	$res3 = $sql3->fetchAll(PDO::FETCH_OBJ);
		 
	foreach($res3 as $ln3) { 
		$name_res = $ln3->NOME;  
		$email_res = $ln3->EMAIL;
	} 

date_default_timezone_set('Etc/UTC'); 
require '../phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer; 
$body = "
			Prezado af&iacute;liado da ComunidadeMultiN&iacute;vel, um novo t&oacute;pico em nosso BLOG foi atualizado !!!<br><br>
			 
			<i>O moderador (<b>$name_res</b>) Criou um T&Oacute;PICO no F&Oacute;RUM/BLOG da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. </i> <br>
			<br>
			Acesse esse link para ver o conte&uacute;do: <a href='http://www.comunidademultinivel.com.br/forum/topico/$url' title='Clique aqui para ir at&eacute; ao t&oacute;pico'>$titulo</a>
			<br>
			<i>Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o: </i> http://www.comunidademultinivel.com.br/forum/topico/$url
			<br><br>
			<b>N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel, Caso tenha alguma duvida, referente ao POST, responda o t&oacute;pico no for&uacute;m.</b>		
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
			<b style='color:red;'>Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. <br> 
			<a href='www.comunidademultinivel.com.br'>www.comunidademultinivel.com.br</a>   <br>
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o.  </b> <br>
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

$mail->Subject = "BLOG da ComunidadeMultiNivel: $titulo";

//Same body for all messages, so set this before the sending loop
//If you generate a different body for each recipient (e.g. you're using a templating system),
//set it inside the loop
$mail->msgHTML($body);
//msgHTML also sets AltBody, but if you want a custom one, set it afterwards
$mail->AltBody = "
			Prezado af&iacute;liado da ComunidadeMultiN&iacute;vel, um novo t&oacute;pico em nosso BLOG foi atualizado !!! 
			 
			O moderador ($name_res) Criou um T&Oacute;PICO no F&Oacute;RUM/BLOG da ComunidadeMultiN&iacute;vel, sua participa&ccedil;&atilde;o ser&aacute; importante. 
			
			Acesse esse link para ver o conte&uacute;do: $titulo 
			
			Caso o LINK esteja inacess&iacute;vel Copie e cole da barra de endere&ccedil;o:  http://www.comunidademultinivel.com.br/forum/topico/$url
			 
			N&atilde;o responda esse email, Esse email foi enviado automaticamente pelo sistema da ComunidadeMultiN&iacute;vel, Caso tenha alguma duvida, referente ao POST, responda o t&oacute;pico no for&uacute;m. 
			 
			Atenciosamente a sua ComunidadeMultiN&iacute;vel. Juntos Somos Mais Fortes. 
			www.comunidademultinivel.com.br 
			O Seu Sucesso Est&aacute; em Nossa Uni&atilde;o. 
";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comunidade MutiN&iacute;vel | Pojeto TALK FUSION | F&OacuteRUM D&uacute;vidas, Tutoriais e Conte&uacute;do t&eacute;cnico para nossos afiliados</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
		<meta name="keywords" content="talkfusion, tutoriais, como funciona, ganhar dinheiro na internet, MMN"/>
		<meta name="robots" content="all">
		<Meta Name="Description" Content="ComunidadeMultiN&iacute;vel, a melhores estrat&eacute;gias de trabalho inteligentemente elaboradas para o alavancamento e crescimento do rendimento de toda nossa equipe. SEU SUCESSO EST&Aacute: EM NOSSA UNI&Atilde;O !!!">
		<meta property='og:image' content='http://www.comunidademultinivel.com.br/adm_clientes/img/talkfusion-indenesia-3.jpg'/>
		<link rel="icon" href="<?php echo $icon; ?>" type="image/x-icon" />
		<!-- meu css -->
        <link href="../adm_clientes/css/estilo.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap 3.0.2 -->
        <link href="../adm_clientes/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="../adm_clientes/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="../adm_clientes/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Morris chart -->	
        <link href="../adm_clientes/css/morris/morris.css" rel="stylesheet" type="text/css" />
        <!-- jvectormap -->
        <link href="../adm_clientes/css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
        <!-- Date Picker -->
        <link href="../adm_clientes/css/datepicker/datepicker3.css" rel="stylesheet" type="text/css" />
        <!-- Daterange picker -->
        <link href="../adm_clientes/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- bootstrap wysihtml5 - text editor -->
        <link href="../adm_clientes/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="../adm_clientes/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">
        <?php  
		if ($id_cliente != "" || $id_cliente != 0) {
			include("topo_logado.php");
		} else {
			include("topo_normal.php");
		}
		  
		?>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side strech">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1> 
                        <small>Criar um T&oacute;pico no BLOG da ComunidadeMultiN&iacute;vel</small>
                    </h1>
                    <ol class="breadcrumb">  
						<li><i class="fa fa-question"></i> <a href="index.php" title="Retornar aos F&Oacute;RUNS">FORUM </a> </li>
                        <li class="active"> Criando T&oacute;pico no BLOG da ComunidadeMultiN&iacute;vel </li>
                    </ol>
                </section>
 
            </aside><!-- /.right-side -->
<div class="col-md-16">

	<div class="input-group input-group-sm" style="width:100%;">
			<form name="frmBusca" method="post" action="pesquisa.php" style="width:100%;">
			<ul style="width:100%;">
				<li style="display:inline;width:60%;"><input type="text" class="form-control" style="width:80%;" name="palavra" placeholder="O que voc&ecirc; est&aacute; procurando ? pesquise aqui" /> </li>
				<li style="display:inline;width:40%;"><input class="btn btn-info btn-flat" style="font-size:14px;" type="submit" value="Pesquisar Agora" />  </li>
			</ul>
			</form>
		</div><!-- /input-group -->
		<br>
		
	<div class="box box-solid bg-light-white">
		<div class="box-header">
			<i style="color:#000;font:10px;">Publicidade</i><br> 
        </div>
		<div class="box-body" style="text-align:center;">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
		</div><!-- /.box-body -->
	</div><!-- /.box -->
</div><!-- /.col -->	  	
<br style="clear:both;"> <br>
<div class='box box-info' style="width:80%;margin:0% 0% 0% 5%;">
		<div class="box-header">
			<i style="color:#000;font:10px;">T&oacute;pico Criado com Sucesso</i><br> 
        </div>
		<b>Acesse seu T&oacute;pico aqui: <a href='http://www.comunidademultinivel.com.br/forum/topico/<?php echo $url; ?>' title='Clique aqui para ir at&eacute; ao t&oacute;pico'><?php echo $titulo; ?></a></b>
		<br>
		<b style="color:red;">Afiliados Notificados;</b> 
		<br>
<?php
 // ENVIANDO EMAIL PARA O PATROCINADOR
$sql2 = $con->prepare("SELECT * FROM $tabela3");
$sql2->execute();
$res2 = $sql2->fetchAll(PDO::FETCH_OBJ); 
//Limite de e-mails 5 a cada 10 segundos
$limite = 5; 
$i = 1;
foreach($res2 as $ln2) { //This iterator syntax only works in PHP 5.4+
    $id_moderador = $ln2->ID;
	$name = $ln2->NOME;  
	$email = $ln2->EMAIL;
	
	$mail->addAddress($email, $name);
    
	if($i == $limite) { 
		sleep(10); //Pausando o script por 10 segundos 
		$i = 0; //Setando o $i = 0, para recomeçar.
	}
	
    if (!$mail->send()) {
        echo "<i style='color:red;'>ERRO (" . str_replace("@", "&#64;", $email) . ') ' . $mail->ErrorInfo . ', </b>'; 
        break; //Abandon sending
    } else {
?>	
	
        <?php echo $name . ' (' . str_replace("@", "&#64;", $email) . '), '; ?> 
		
		
		
<?php		
    }
    // Clear all addresses and attachments for next loop
    $mail->clearAddresses();
    $mail->clearAttachments();
	$i++; //Aumentando o $i
} 
 
   
/*

	  pi so colocar para enviar para todos clientes e alterar o texto do email
 
	
*/
	 
	//echo ("<script type='text/javascript'> alert('Seu TOPICO foi criado com sucesso !!!'); location.href='topico/$url';</script>");
 
?>
<br style="clear:both;"> <br>
</div>
		<div class="col-md-16">
			<div class="box box-solid bg-light-white">
				<div class="box-header">
					<i style="color:#000;font:10px;">Publicidade</i><br> 
                </div>
                <div class="box-body" style="text-align:center;">
					<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
						<!-- KeyWord - 728x90 -->
						<ins class="adsbygoogle"
							 style="display:inline-block;width:728px;height:90px"
							 data-ad-client="ca-pub-2025377467503276"
							 data-ad-slot="9371452443"></ins>
						<script>
						(adsbygoogle = window.adsbygoogle || []).push({});
						</script>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->	 			
		


		
</div><!-- ./wrapper -->
 
 
 

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="../adm_clientes/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="../adm_clientes/js/AdminLTE/app.js" type="text/javascript"></script>      
        <!-- CK Editor -->
        <script src="../adm_clientes/js/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="../adm_clientes/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
        

    </body>
</html>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56061636-1', 'auto');
  ga('send', 'pageview');

</script>
 
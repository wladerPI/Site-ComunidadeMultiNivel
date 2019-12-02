<?php
	error_reporting(E_ALL & ~ E_NOTICE);
	include("../config/config.php");
	header("Content-Type: text/html; charset=ISO-8859-1",true);
?>
<script>
function verifica() {
	if (form.nome.value == "") { 
		alert("O Nome \xE9 obrigat\xF3rio"); 
		return false;   
    }  
	if (form.pais.value == "") { 
		alert("O campo Pa\u00eds \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.estado.value == "") { 
		alert("O campo Estado \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.cidade.value == "") { 
		alert("O campo Cidade \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.tel.value == "" && form.cel.value == "" && form.skype.value == "" && form.facebook.value == "") { 
		alert("Pelo menos um dos camos (Telefone, Celular, Skype ou Facebook) \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.form.email");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
		return false;
    } 
	
<?php
try {
		$sql_verifc = $con->prepare("SELECT * FROM $tabela3");
		$sql_verifc->execute();
		$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
		foreach($res_verifc as $ln_verifc) {
?>
	if (form.email.value == "<?php echo $ln_verifc->EMAIL; ?>") { 
		alert("Esse E-mail ja esta cadastrado no sistema."); 
		return false;   
    } 

<?php  
} 
	} catch(PODException $e_verifc) {
		echo "Erro:/n".$e_verifc->getMessage();
} 
?>		 
	if (form.senha.value == "") { 
		alert("O campo Senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.senha_r.value == "") { 
		alert("O campo Confirmação da Senha \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.senha.value != form.senha_r.value){
		alert("Os Formul\xE1rios: Senha e Repita a senha est\xE3o diferentes, \xE9 obrigat\xF3rio."); 
		return false;   
	} 
	if(document.getElementById("termos").checked == false){
		alert("Acertar os Termos de Uso do SISTEMA \xE9 obrigat\xF3rio.");
		return false; 
	}
} 
</script>

<div class="main">
<div id="structure"> 
  <div class="header">
    <div class="header_resize">
      <div class="searchform">
		
        <form id="formlogin" name="formsearclogin" method="post" action="logando.php">
          <b>Email:* </b><input type="text" name="email_login" class="email_login" id="email_login" onfocus="this.className='email_login_foco'" onBlur="this.className='email_login'"  /> <br>
		  <b>Senha:* </b><input type="password" name="senha_login" class="senha_login" onfocus="this.className='senha_login_foco'" onBlur="this.className='senha_login'" />
          <input type="submit" value="Entrar" name="but_login" class="but_login" onfocus="this.className='but_login_foco'" onBlur="this.className='but_login'" />
		  <a href="solicitar_senha" title="esqueceu sua senha"> Esqueceu sua Senha ? </a>
        </form>
      </div>
      <div class="logo">
        <h1><a href="home">Comunidade Multinivel <small>PROJETO SIMULADOR na Empresa TALK FUSION</small></a></h1>
      </div>
      <div class="clr"></div>
      <div class="slider">
        <div id="coin-slider"> 
			<a href="#"><img src="images/slide1.jpg" width="960" height="360" alt="" /><span></span></a> 
			<a href="#"><img src="images/slide2.jpg" width="960" height="360" alt="" /><span></span></a> 
			<a href="#"><img src="images/slide3.jpg" width="960" height="360" alt="" /><span></span></a> 	
		</div>
        <div class="clr"></div>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li class="active"><a href="home" title="Entenda o PROJETO SIMULADOR na empresa TALK FUSION"><span>Projeto</span></a></li>
          <li><a href="faq" title="Duvidas freq&uuml;entes"><span>FAQ</span></a></li>
          <li><a href="empresa"><span>A Empresa</span></a></li>
          <li><a href="contato"><span>Contato</span></a></li>
          <li><a href="../index.php"><span>P&aacute;gina Inicial</span></a></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
    <div class="content_resize">
		<iframe width="950" height="480" src="//www.youtube.com/embed/e7YgHOSYK4A?rel=0&amp;controls=0&amp;showinfo=0;&autoplay=1" frameborder="1" allowfullscreen></iframe>
      <div class="mainbar">
	  
	  
	  	  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- talkfusion-top -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="1381250047"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>



		<div id="rede_sociais">
				<table>
					<tr>	
						<td>
							<iframe src="//www.facebook.com/plugins/like.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width=100&amp;layout=box_count&amp;action=like&amp;show_faces=true&amp;share=true&amp;height=65" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:100px; height:65px;" allowTransparency="true"></iframe>
						</td>
						<td>
							<script src="https://apis.google.com/js/platform.js"></script> 
							<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>
						</td>
					</tr>
				</table>
			  </div>
        <div class="article">
          <h2>Seja bem-vindo a fazer parte da maior e melhor equipe do MutiN&iacute;vel.</h2>
          <p class="infopost">Voc&ecirc; est&aacute; sendo indicado por: <b><?php echo $ln->NOME." (#  ".$ln->ID.")"; ?></b></p>
          <div class="clr"></div>
          <div class="img"><img src="images/parceria_de_sucesso.jpg" width="620" height="154" alt="" class="fl" /></div>
          <div class="post_content">
          <b class="gratuito">Inscreva-se agora para Comunidade MultiN&iacute;vel ! </b>
		  <br><br>
		  <b>Antes de Fazer parte do projeto TALK FUSION, voc&ecirc; ter&aacute; que se registrar no sistema ! </b>
		  <br><br>
		  <i>* Indica um campo obrigat&oacute;rio</i>
		  <br><br>
		  <form action="cadastrando" method="post" id="form" name="form">
			<input TYPE="HIDDEN" id="id_indicado" name="id_indicado" class="text" value="<?php echo $ln->ID; ?>" /> 
              <label class="nome">Nome*:  <input id="nome" name="nome" class="text" /> </label><br>
			  <label class="pais">Pa&iacute;s*  <input id="pais" name="pais" class="text" /></label> <br>
			  <label class="estado">Estado*:  <input id="estado" name="estado" class="text" /> </label><br>
			  <label class="cidade">Cidade*:  <input id="cidade" name="cidade" class="text" /></label> <br>
			  
			  <hr>
				<i>* Pelo menos 1 dos 4 formul&aacute;rios de contatos abaixo ser&aacute; obrigat&oacute;rio.<i><BR>
				  <label class="tel">DDD + Telefone (FIXO):  <input id="tel" name="tel" class="text" /><i>(xx) xxxxxxxx </i></label><br>
				  <label class="cel">DDD + Celular:  <input id="cel" name="cel" class="text" /><i>(xx) xxxxxxxx </i></label><br>
				  <label class="skype">Skyke:  <input id="skype" name="skype" class="text" /></label><br>
				  <label class="facebook">Facebook: (URL)  <input id="facebook" name="facebook" class="text" /> <i>Coloque aqui a URL do seu perfil do Facebook</i></label><br>
				  <div class="img"><img src="images/urlfacebook.jpg" width="620" height="50" alt="" class="fl" /></div>
			  <hr>
			  <label class="email">Email*:  <input id="email" name="email" class="text" /> <i class="red">*Por Favor Registre-se com um E-mail do GMAIL ou HOTMAIL</i></label><br>
              <label class="senha">Senha*: <input  type="password" name="senha" /> </label><br>
			  <label class="senha_r">Confirma&ccedil;&atilde;o da Senha*:  <input  type="password" name="senha_r" /></label><br>
			  <hr> 
			  <label class="termos">Aceite os <a href="termos_de_uso" title="Leia os termos de uso do sistema" target = "_blank">termos de uso</a>*:  <INPUT TYPE="checkbox" NAME="termos" ID="termos"></label><br>
			  <br>
              <input type="image" name="imageField" class="botcadastro" value="Registrar no Sistema" />
                <div class="clr"></div> 
          </form>
		  
		  
          </div> 
        </div>
    	  	  <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- talkfusion-top -->
<ins class="adsbygoogle"
     style="display:inline-block;width:320px;height:100px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="1381250047"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>

   
      </div>
      <div class="sidebar">
	  <br>
	    <meta name="google-translate-customization" content="bb6eef345d4a1412-7bf4933a356464be-g83958713ee9fe3a8-1f"></meta> 

		<div id="google_translate_element" ></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-56061636-1'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
		<br>
	
        <div class="gadget">
			<?php if ($ln->FOTO_PERFIL == "") { ?>
			<div class="img"><img src="../adm_clientes/img_perfil/sem_foto.png" width="230" height="230" alt="" class="fl" /></div>
			<?php } else { ?>
		  <div class="img"><img src="../adm_clientes/img_perfil/<?php echo $ln->FOTO_PERFIL;?>" width="230" height="230" alt="" class="fl" /></div>
			<?php }  ?>
          <h2 class="star">Voc&ecirc; est&aacute; sendo INDICADO POR: <span><i><?php echo $ln->NOME;?></i></span></h2>
		  <p> E-mail para contato: <b><?php echo $ln->EMAIL;?></> </p>
          <div class="clr"></div>
        </div>
		<div class="gadget">
          <h2 class="star"><span>Ultimos Cadastrados no PROJETO</span></h2>
          <div class="clr"></div>
          <ul class="ex_menu">
			<?php 
				include("../config/config.php");
				try {
					$sql_verifc = $con->prepare("SELECT * FROM $tabela3 ORDER BY ID DESC LIMIT 5");
					$sql_verifc->execute();
					$res_verifc = $sql_verifc->fetchAll(PDO::FETCH_OBJ);
					foreach($res_verifc as $ln_verifc) {
						$nome = $ln_verifc->NOME; 
						$data = $ln_verifc->DATA_CADASTRO;
						$data = implode("/",array_reverse(explode("-",$data)));
 
			?>
            <li>Nome: <b class="red"><?php echo $ln_verifc->NOME; ?></b> mora em <b><?php echo $ln_verifc->CIDADE; ?></b>, <b><?php echo $ln_verifc->PAIS; ?></b>. <i class="red">(<?php echo $data; ?>)</i> </li> <hr>
			<?php 
					} 
				} catch(PODException $e_verifc) {
					echo "Erro:/n".$e_verifc->getMessage();
				} 
			?>
          </ul>
        </div>
		
		<div class="gadget"> 
          <h2 class="star"><span>Publicidades</span></h2>
          <div class="clr"></div>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Comudade -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:250px"
     data-ad-client="ca-pub-2025377467503276"
     data-ad-slot="1441103642"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
        </div>
		
		
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
	  <div id="fb-root"></div>
		<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FComunidadeMultiNivel&amp;width&amp;height=290&amp;colorscheme=dark&amp;show_faces=true&amp;header=true&amp;stream=false&amp;show_border=true" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:290px;" allowTransparency="true"></iframe>
      </div>
      <div class="col c2"> 
		<h2>Canal do YOUTUBE</h2>
		<script src="https://apis.google.com/js/platform.js"></script> 
		<div class="g-ytsubscribe" data-channel="ComunidadeMutinivel" data-layout="full" data-count="default"></div>


      </div>
      <div class="col c3">
        <h2><span>Contato</span> com Controlador</h2>
		  <p>Estarei disposto para ajudar sempre que poss&iacute;vel e tirar todas suas duvidas referente a todos nossos projetos, contate-me e junte-se a rede mais unida do MultiN&iacute;vel.</p> 
          
          <span>Skype: </span> wlader.pi<br />
          <span>Facebook: </span> <a href="https://www.facebook.com/ganhe.dinheiro1" title="Controlador do Projeto" target="_blank">Wlader Murilo Alexandro </a><br />
          <span>E-mail: </span> contato@comunidademultinivel.com.br  
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf">&copy; Todos Direitos Reservados <a href="../index.php" title="P&aacute;gina Inicial">COMUNIDADE MULTIN&Iacute;NIVEL</a>.</p>
      <p class="rf"> Um Por Todos E Todos Por Uma Causa !!!</p>
      <div style="clear:both;"></div>
    </div>
  </div>
</div></div>
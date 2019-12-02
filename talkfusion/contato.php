<script>
function verifica() {
	if (form.name.value == "") { 
		alert("O Nome \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.email.value == "") { 
		alert("O Email \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	if (form.message.value == "") { 
		alert("A Mensagem \xE9 obrigat\xF3rio"); 
		return false;   
    } 
	//Validacao de Emails	
	var obj = eval("document.form.email");
	var txt = obj.value;
	if ((txt.length != 0) && ((txt.indexOf("@") < 1) )) {
		alert('Digite seu E-mail Verdadeiro !');
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


        <div class="article">
          <h2>Contate-nos</h2>
          <p class="infopost">Envei um e-email, responderemos assim que poss&iacute;vel.</p>
          <div class="clr"></div>
          <div class="img"><img src="images/contato.jpg" width="620" height="154" alt="" class="fl" /></div>
          <div class="post_content">
			<p>Duvidas ? Sugest&otilde;es ? Propostas ? Elogios ?</p>
             <form action="enviar.php" method="post" id="form" name="form">
            <ol>
              <li>
                <label for="name">Nome*</label>
                <input id="name" name="name" class="text" />
              </li>
              <li>
                <label for="email">Email*</label>
                <input id="email" name="email" class="text" />
              </li>
              <li>
                <label for="website">Website </label>
                <input id="website" name="website" class="text" />
              </li>
              <li>
                <label for="message">Digite sua Mensagem*</label>
                <textarea id="message" name="message" rows="8" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" name="imageField" id="imageField" src="images/submit.gif" class="send" value="Enviar" Onclick="return verifica()"  />
                <div class="clr"></div>
              </li>
            </ol>
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
      <?php  include("menue.php"); ?>
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
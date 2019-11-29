  <meta name="google-translate-customization" content="bb6eef345d4a1412-7bf4933a356464be-g83958713ee9fe3a8-1f"></meta> 
<!-- header logo: style can be found in header.less -->
        <header class="header">
            <a href="../index.php" class="logo">
                <!-- Add the class icon to your logo image or logo icon to add the margining -->
                FORUM da Comunidade
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top" role="navigation">
                <a class="login_talk" href="../../talkfusion" title="Saiba Mais Sobre a TALK FUSION" target="_blank"> 
					<img  src="../../adm_clientes/img/icon_talkfusion.png" width="40" height="40" alt="LOGO TALK FUSION"  /> 
				</a>   
				<a class="login_talk" href="../trafficmonsoon" title="Saiba Mais Sobre a TrafficMonsoon" target="_blank"> 
					<img  src="../../adm_clientes/img/logo-surf.png" width="80" height="40" alt="LOGO TrafficMonsoon"  /> 
				</a> 
				<a class="login_talk" href="https://www.facebook.com/ComunidadeMultiNivel" title="P&aacute;gina oficial no Facebook da ComunidadeMultiN&iacute;vel" target="_blank"> 
					<img  src="../../adm_clientes/img/pagina-facebook-comunidade-multinivel.png" width="40" height="40" alt="P&aacute;gina oficial no Facebook da ComunidadeMultiN&iacute;vel"  /> 
				</a> 
				<a class="login_talk" href="http://goo.gl/4zDgYr" title="Canal no YOUTUBE da ComunidadeMultiN&iacute;vel" target="_blank"> 
					<img  src="../../adm_clientes/img/canal-yotube-comunidade-multinivel.png" width="40" height="40" alt="Canal no YOUTUBE da ComunidadeMultiN&iacute;vel"  /> 
				</a>  
				 
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
					
					<li style="margin:7px 12px 0px 0px;font-size:20px;color:#FFF;"> <b>Tradutor </b></li>
					<li style="margin:10px 0px 0px 0px;">
						
						
				 <div id="google_translate_element" ></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-56061636-1'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        
						
						</li>
						
						
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="glyphicon glyphicon-user"></i>
                                <span><?php echo $_SESSION['NOME_CLIENTE']; ?> <i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header bg-light-blue">
									<?php if ($foto_perfil == "") { ?>
									<img src="../../adm_clientes/img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" />
									<?php } else { ?>
									<img src="../../adm_clientes/img_perfil/<?php echo $foto_perfil; ?>"  class="img-circle" alt="Sua Imagem" />
									<?php } ?>
                                    <p>
                                        <?php echo $_SESSION['NOME_CLIENTE']; ?>
                                        <small>Membro desde <?php echo $data; ?></small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="../../adm_clientes/perfil.php" class="btn btn-default btn-flat">Perfil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="../../adm_clientes/sair.php" class="btn btn-default btn-flat">Sair</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
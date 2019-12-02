<div class="sidebar">
 
        <div class="gadget">
		
		  <meta name="google-translate-customization" content="bb6eef345d4a1412-7bf4933a356464be-g83958713ee9fe3a8-1f"></meta> 

		<div id="google_translate_element" ></div><script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'pt', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, gaTrack: true, gaId: 'UA-56061636-1'}, 'google_translate_element');
}
</script><script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>


          <h2 class="star"><span>Menu do PROJETO</span></h2>
          <div class="clr"></div>
          <ul class="sb_menu"> 
			<li><a href="dsa" title="Empresa Totalmente SEGURA e aprovada pela DSA"><img src="images/DSA.gif" class="borda_img" width="240" height="130" alt="Empresa Totalmente SEGURA e aprovada pela DSA"   /></a></li>
            <li><a href="mercedes" title="Nunca Ficou T&atilde;o F&aacute;cil ganhar sua Mercedes"><img src="images/Mercedes-car-Programm.jpg" class="borda_img" width="240" height="130" alt="Mercedes Madness (3 Estrelas)"   /></a></li>
            <li><a href="viagemhawaii" title="A estadia no lindo Grand Wailea Resort em Maui, 5 dias, 4 noites, duas vezes por ano"><img class="borda_img" src="images/Viagem_para_o_havawii-talkfusion.jpg" width="240" height="130" alt="Dream Getaway (Viagens para o Hawaii)"   /></a></li>
            <li><a href="pagamento" title="O primeiro plano de remunera&ccedil;&atilde;o do mundo com pagamento instant&acirc;neo"><img class="borda_img" src="images/Pagamento-Imediato-Talk-Fusion.jpg" width="240" height="130" alt="PAGAMENTO INST&Acirc;NTANEO"   /></a></li>
            <li><a href="plano_marketing" title="Entenda Como Funciona as Formas de Ganhos da TALK FUSION"><img class="borda_img" src="images/talk-fusion-brasil-1-638.jpg" width="240" height="130" alt="Plano de Compensa&ccedil;&atilde;o"   /></a></li> 
			<li><a href="sucesso-talkfusion" title="Hist&oacute;ria de Sucesso"><img class="borda_img" src="images/equipe-de-sucesso-talk-fusion.jpg" width="240" height="130" alt="Hist&oacute;ria de Sucesso"   /></a></li> 
          </ul>
		  <hr>
		  <ul style="list-style:none;">  
			<li><a href="produtos_talkfusion" title="Veja os produtos de comunica&ccedil;&atilde;o dessa magnifica empresa"><img class="borda_img" src="images/comunicacao-via-videos-talkfusion.jpg" width="240" height="130" alt="Plano de Compensa&ccedil;&atilde;o"   /></a></li> 
			<li><a href="connect-talkfusion" title="CONNECT - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">CONNECT</a></li> 
			<li><a href="videos-email-talkfusion" title="VIDEOS EMAILs - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">VIDEOS EMAILs</a></li> 
			<li><a href="videos-newsletters-talkfusion" title="VIDEOS NEWSLETTERS - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">VIDEOS NEWSLETTERS</a></li> 
			<li><a href="assinatura-eletronica-talkfusion" title="E-SUBSCRIPTION FORMS - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">Formul&aacute;rio de Assinatura Eletr&ocirc;nica</a></li> 
			<li><a href="video-auto-resposta-talkfusion" title="VIDEO EMAILS AUTO RESPONDERS - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">VIDEO EMAILS AUTO RESPONDERS</a></li> 
			<li><a href="fusion-on-the-go-talkfusion" title="FUSION ON THE GO - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">FUSION ON THE GO</a></li> 
			<li><a href="video-share-talkfusion" title="VIDEO-SHARE - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">VIDEO-SHARE</a></li> 
			<li><a href="video-blog-talkfusion" title="VIDEO-BLOG - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">VIDEO-BLOG</a></li> 
			<li><a href="fusion-wall-talkfusion" title="FUSION WALL - SAIBA DETALHADAMENTO COMO FUNCIONA ESSE PRODUTO DA TALKFUSION">FUSION WALL</a></li>
          </ul>
		  <hr>
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
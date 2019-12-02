<?php
try {
	$sql_menu = $con->prepare("SELECT * FROM $tabela3 WHERE ID = $id_cliente");
	$sql_menu->execute();
	$res_menu = $sql_menu->fetchAll(PDO::FETCH_OBJ);
	foreach($res_menu as $ln_menu) {
		$talk = $ln_menu->TALK_FUSION; 
		$talk_simulador = $ln_menu->TALK_SIMULADOR; 
	}	 
} catch(PODException $e_menu) {
	echo "Erro:/n".$e_menu->getMessage();
} 

	$sql_adm = $con->prepare("SELECT * FROM $tabela5 WHERE ID = '1'");
	$sql_adm->execute();
	$res_adm = $sql_adm->fetchAll(PDO::FETCH_OBJ);
	 
	foreach($res_adm as $ln_adm) { 
			$talk_simulador_status = $ln_adm->TALK_SIMULADOR; 
	} 
?>

<!-- Left side column. contains the logo and sidebar -->
            <aside class="left-side sidebar-offcanvas">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
							<?php if ($foto_perfil == "") { ?>
                            <img src="../../img_perfil/sem_foto.png"  class="img-circle" alt="Sua Imagem" />
							<?php } else { ?>
							<img src="../../img_perfil/<?php echo $foto_perfil; ?>"  class="img-circle" alt="Sua Imagem" />
							<?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Ol&aacute;, <?php echo $nome; ?></p>

                            <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="../../index.php">
                                <i class="fa fa-dashboard"></i> <span>Painel</span>
                            </a>
                        </li> 
                        <li class="treeview">
                            <a href="#">
                                <i class="glyphicon glyphicon-user"></i>
                                <span>Dados Pessoais</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li><a href="../../perfil.php"><i class="fa fa-angle-double-right"></i> Dados do Perfil</a></li>
                                <li><a href="../../senha.php"><i class="fa fa-angle-double-right"></i> Alterar Senha</a></li>
                                <li><a href="../../imagem_perfil.php"><i class="fa fa-angle-double-right"></i> Foto de Perfil</a></li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="#">
                                <i class="fa  fa-sitemap"></i>
                                <span>Sua Rede no Sistema</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="../../patrocinador.php"><i class="fa fa-angle-double-right"></i> Seu Patrocinador(a)</a></li>
                                <li><a href="../../indicados_diretos.php"><i class="fa fa-angle-double-right"></i> Suas Indica&ccedil;&otilde;es Diretas</a></li>
                                <li><a href="../../rank_afiliados.php"><i class="fa fa-angle-double-right"></i> Seus N&iacute;veis de Indica&ccedil;&atilde;o</a></li> 
								<li><a href="../../ultimos_acessos.php"><i class="fa fa-angle-double-right"></i> &Uacute;ltimos Acesso de Seus Indicados</a></li> 
								<li><a href="../../link_indicacao.php"><i class="fa fa-angle-double-right"></i> Seus LINKS de indica&ccedil;&otilde;es</a></li>
                            </ul>
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa  fa-question"></i>
                                <span>F&Oacute;RUM</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="../../topicos_criados.php"><i class="fa fa-angle-double-right"></i> T&oacute;picos Criados</a></li>
                                <li><a href="../../resposta_enviadas.php"><i class="fa fa-angle-double-right"></i> Respostas Enviadas </a></li> 
                            </ul>
                        </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-table"></i> <span>RANK de Pontua&ccedil;&atilde;o</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">  
                                <li><a href="../../rank_geral.php"><i class="fa fa-angle-double-right"></i> RANK GERAL</a></li>
                            </ul>
                        </li>
						
						 				
						<li class="treeview">
                            <a href="#">
                                <img src="../../img/icon_talkfusion.png" width="20" height="20" alt=""   /> <span>TALK FUSION</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                             <ul class="treeview-menu"> 
<?php if ($talk == "" && $talk_simulador == "") { ?>							
								<li><a href="../../../talkfusion/home" target="_blank"><img src="../../img/icon_talkfusion.png" width="20" height="20" alt=""   /> TALK FUSION (Saiba Mais)</a></li>
<?php } ?>
								<li><a href="../../resumo_talkfusion.php"><i class="fa fa-dedent"></i> Resumo</a></li>
<?php if ($talk == "SIM") { ?> 
<?php } if ($talk_simulador == "SIM") { ?>
                                <li><a href="../../rank_talk_simulador.php"><i class="fa fa-table"></i> RANK SIMULADOR</a></li> 
<?php }  ?>
								<li><a href="../../entrar_talk.php"><i class="fa fa-mail-forward"></i> Seja um(a) Distribuidor(a)</a></li>
								
<?php if ($talk_simulador == "" && $talk_simulador_status == "SIM") { ?>
								<li><a href="../../entrar_talk_simulador.php"><i class="fa fa-mail-forward"></i> Entrar no SIMULADOR</a></li>
<?php } ?>
								<!--<li><a href="../../rank_lideres.php"><i class="fa  fa-trophy	"></i> Melhores L&iacute;deres (RANK)</a></li> -->
								<li><a href="../../capas_facebook.php"><i class="fa fa-camera	"></i> Capas para seu Facebook</a></li> 
                                <li><a href="../../projesao_de_ganhos.php"><i class="fa fa-angle-double-up"></i> Proje&ccedil;&otilde;es de Ganhos</a></li>  
                            </ul>
                        </li>

						<li style="color:red;"> <i class="fa  fa-wrench"> </i> <b>Ferramentas de Trabalho</b> <i class="fa  fa-arrow-down"></i> </li>
						<li class="treeview">
                            <a href="#">
                                <i class="fa   fa-star"></i>
                                <span>Dicas Di&aacute;rias <i style="color:red;">(Novo)</i></span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="../../resumo_dicas.php"><i class="fa fa-angle-double-right"></i> Resumo</a></li>
                                <li><a href="../../iniciar_dicas.php"><i class="fa fa-angle-double-right"></i> Iniciar </a></li>
								<li><a href="../../trafficmonsoon.php"><i class="fa fa-angle-double-right"></i> TrafficMonsoon </a></li>
								
								
								<li><a href="../../rank_dicas.php"><i class="fa fa-angle-double-right"></i> RANK de Premia&ccedil&atilde;o </a></li>	
								<li><a href="../../promocao_mes.php"><i class="fa fa-angle-double-right"></i> Promo&ccedil;&atilde;o do M&ecirc;s </a></li>
								<li><a href="../../como_funciona_dicas.php"><i class="fa fa-angle-double-right"></i> Como Funciona </a></li>								
                            </ul>
                        </li>
						 
						<hr>					
						<li class="treeview">
                            <a href="#">
                                <i class="fa fa-comment"></i> <span>Contatos</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<li><a href="../../comentarios_facebook.php"><i class="fa fa-angle-double-right"></i> Coment&aacute;rio no Facebook</a></li>
								<li><a href="../../pag_facebook.php"><i class="fa fa-angle-double-right"></i> P&aacute;gina do Facebook</a></li>
                                <li><a href="../../contato.php"><i class="fa fa-angle-double-right"></i> Contate Comunidade MutiN&iacute;vel</a></li> 
                            </ul>
                        </li> 
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
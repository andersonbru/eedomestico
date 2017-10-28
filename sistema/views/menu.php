<div class="sidebar sidebar-main">
	<div class="sidebar-content">

		<!-- User menu -->
		<div class="sidebar-user">
			<div class="category-content">
				<div class="media">
					<a href="#" class="media-left">
					<?php
					//$arquivo = new Arquivos();
					//$logo = $arquivo->selectBlob($_SESSION['usuario']['id'], 'LOGO-ADMIN');
					if (isset($logo) && $logo['size']>0) {
						echo '<img src="/arquivo/'.$_SESSION['usuario']['id'].'/LOGO-ADMIN" class="img-circle img-sm">';
					} else {
						echo '<img src="'.site_url().'/layout/assets/images/placeholder.jpg" class="img-circle img-sm" alt="">';
					}
					?>
					</a>
					<div class="media-body">
						<span class="media-heading text-semibold"><?=$_SESSION['usuario']['nome']?></span>
						
						<div class="text-size-mini text-muted">
							<i class="icon-envelope text-size-small"></i> &nbsp;<?=$_SESSION['usuario']['email']?>
						</div>
						
					</div>
					
					<!--
					<div class="media-right media-middle">
						<ul class="icons-list">
							<li>
								<a href="#"><i class="icon-cog3"></i></a>
							</li>
						</ul>
					</div>
					-->
				</div>
			</div>
		</div>
		<!-- /user menu -->


		<!-- Main navigation -->
		<div class="sidebar-category sidebar-category-visible">
			<div class="category-content no-padding">
				<ul class="navigation navigation-main navigation-accordion">

					<!-- Main -->
					<li class="navigation-header"><span>Main</span> <i class="icon-menu" title="Main pages"></i></li>
					<li class=""><a href="principal"><i class="icon-home4"></i> <span>Principal</span></a></li>
					
					<?php
					if ($_SESSION['usuario']['perfil']=='A') {
						
						echo '<li class=""><a href="clientes"><i class="icon-user"></i> <span>Controle de Clientes</span></a></li>';
						
						echo '<li>';
							echo '<a href="#"><i class="icon-files-empty"></i> <span>Controle de Arquivos</span></a>';
							echo '<ul>';
								echo '<li><a href="#"><i class="icon-file-upload2"></i> <span>Enviados</span></a></li>';
								echo '<li><a href="#"><i class="icon-file-download2"></i> <span>Recebidos</span></a></li>';
							echo '</ul>';
						echo '</li>';
						
						echo '<li>';
							echo '<a href="#"><i class="icon-cogs"></i> <span>Configurações</span></a>';
							echo '<ul>';
								echo '<li><a href="#"><i class="icon-wrench3"></i> <span>Categorias de arquivos</span></a></li>';
								echo '<li><a href="#"><i class="icon-home"></i> <span>Empresa</span></a></li>';
							echo '</ul>';
						echo '</li>';
						
					}else{
						
					}
					
					/*
					$menu = new Menu();
					$listaMenu = $menu->gerarMenu($_SESSION['usuario']['id'], $_SESSION['usuario']['perfil']);
					if ($listaMenu) {
						foreach ($listaMenu as $key => $value) {
							echo '<li>';
								echo '<a href="'.$value['link'].'"><i class="'.trim($value['icone']).'"></i> <span>'.$value['descricao'].'</span></a>';
								if ($value['tipo']=='P') {
									echo '<ul>';
									if($value['menu_filho']){
										foreach ($value['menu_filho'] as $k => $v) {
											echo '<li><a href="'.$v['link'].'"><i class="'.trim($v['icone']).'"></i> <span>'.$v['descricao'].'</span></a></li>';
										}
									}
									echo '</ul>';
								}
							echo '</li>';
						}
					}
					*/	
					?>
					
				</ul>
			</div>
		</div>
		<!-- /main navigation -->

	</div>
</div>
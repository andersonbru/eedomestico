<div class="navbar navbar-inverse">
	<div class="navbar-header">
		<?php
		//$arquivo = new Arquivos();
		//$logo = $arquivo->selectBlob($_SESSION['usuario']['id'], 'LOGO-ADMIN');
		if (isset($logo) && $logo['size']>0 && 1==2) {
			$img = '<img src="/arquivo/'.$_SESSION['usuario']['id'].'/LOGO-ADMIN" style="width: 70px; height: 30px;">';
		} else {
			$img = '<img src="'.site_url().'/layout/assets/images/logo_light.png" alt="">';
		}
		?>
		<a class="navbar-brand" href="principal"><?=$img?></a>

		<ul class="nav navbar-nav visible-xs-block">
			<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
			<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
		</ul>
	</div>

	<div class="navbar-collapse collapse" id="navbar-mobile">
		
		<!--
		<ul class="nav navbar-nav">
			<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>

			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<i class="icon-git-compare"></i>
					<span class="visible-xs-inline-block position-right">Git updates</span>
					<span class="badge bg-warning-400">9</span>
				</a>
				
				<div class="dropdown-menu dropdown-content">
					<div class="dropdown-content-heading">
						Git updates
						<ul class="icons-list">
							<li><a href="#"><i class="icon-sync"></i></a></li>
						</ul>
					</div>

					<ul class="media-list dropdown-content-body width-350">
						<li class="media">
							<div class="media-left">
								<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
							</div>

							<div class="media-body">
								Drop the IE <a href="#">specific hacks</a> for temporal inputs
								<div class="media-annotation">4 minutes ago</div>
							</div>
						</li>

						<li class="media">
							<div class="media-left">
								<a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-commit"></i></a>
							</div>
							
							<div class="media-body">
								Add full font overrides for popovers and tooltips
								<div class="media-annotation">36 minutes ago</div>
							</div>
						</li>

						<li class="media">
							<div class="media-left">
								<a href="#" class="btn border-info text-info btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-branch"></i></a>
							</div>
							
							<div class="media-body">
								<a href="#">Chris Arney</a> created a new <span class="text-semibold">Design</span> branch
								<div class="media-annotation">2 hours ago</div>
							</div>
						</li>

						<li class="media">
							<div class="media-left">
								<a href="#" class="btn border-success text-success btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-merge"></i></a>
							</div>
							
							<div class="media-body">
								<a href="#">Eugene Kopyov</a> merged <span class="text-semibold">Master</span> and <span class="text-semibold">Dev</span> branches
								<div class="media-annotation">Dec 18, 18:36</div>
							</div>
						</li>

						<li class="media">
							<div class="media-left">
								<a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-git-pull-request"></i></a>
							</div>
							
							<div class="media-body">
								Have Carousel ignore keyboard events
								<div class="media-annotation">Dec 12, 05:46</div>
							</div>
						</li>
					</ul>

					<div class="dropdown-content-footer">
						<a href="#" data-popup="tooltip" title="All activity"><i class="icon-menu display-block"></i></a>
					</div>
				</div>
			</li>
		</ul>
		
		-->
		
		<ul class="nav navbar-nav navbar-right">
			
			<!--
			<li class="dropdown language-switch">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<img src="assets/images/flags/gb.png" class="position-left" alt="">
					English
					<span class="caret"></span>
				</a>

				<ul class="dropdown-menu">
					<li><a class="deutsch"><img src="assets/images/flags/de.png" alt=""> Deutsch</a></li>
					<li><a class="ukrainian"><img src="assets/images/flags/ua.png" alt=""> Українська</a></li>
					<li><a class="english"><img src="assets/images/flags/gb.png" alt=""> English</a></li>
					<li><a class="espana"><img src="assets/images/flags/es.png" alt=""> España</a></li>
					<li><a class="russian"><img src="assets/images/flags/ru.png" alt=""> Русский</a></li>
				</ul>
			</li>
			-->
			
			<li class="dropdown">
				
				
				
					
			</li>
			
			
			<li class="dropdown dropdown-user">
				<a class="dropdown-toggle" data-toggle="dropdown">
					<?php
					if (isset($logo) && $logo['size']>0) {
						echo '<img src="/arquivo/'.$_SESSION['usuario']['id'].'/LOGO-ADMIN"">';
					} else {
						echo '<img src="'.site_url().'/layout/assets/images/placeholder.jpg" alt="">';
					}
					?>
					<span><?=$_SESSION['usuario']['nome']?></span>
					<i class="caret"></i>
				</a>

				<ul class="dropdown-menu dropdown-menu-right">
					<?php
					if ($_SESSION['usuario']['perfil']=='A') {
						$meus_dados = '/admin-config';
					} else {
						$meus_dados = '';
					}
					
					?>
					<li><a href="<?=$meus_dados?>"><i class="icon-user-plus"></i> Meus dados</a></li>
					
					<!--
					<li><a href="#"><i class="icon-coins"></i> My balance</a></li>
					<li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
					<li class="divider"></li>
					<li><a href="#"><i class="icon-cog5"></i> Account settings</a></li>
					-->
					<li><a href="<?=site_url()?>/logout"><i class="icon-switch2"></i> Sair</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>
<?php
require_once("topo.php");
?>
<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content">
				<!-- Simple login form -->
				<form action="login" method="post">
					<div class="panel panel-body login-form">
						<?php
						if(isset($retorno)){
							echo '<p class="alert alert-'.$retorno['tipo'].' text-center">'.$retorno['msg'].'</p>';
						}
						?>
						<div class="text-center">
							<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
							<h5 class="content-group">Acesso ao sistema <small class="display-block">Entre com seu usuário e senha</small></h5>
						</div>
				
						<div class="form-group has-feedback has-feedback-left">
							<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuário">
							<div class="form-control-feedback">
								<i class="icon-user text-muted"></i>
							</div>
						</div>
				
						<div class="form-group has-feedback has-feedback-left">
							<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
							<div class="form-control-feedback">
								<i class="icon-lock2 text-muted"></i>
							</div>
						</div>
				
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">Acessar <i class="icon-circle-right2 position-right"></i></button>
						</div>
						<!--
						<div class="text-center">
							<a href="login_password_recover.html">Forgot password?</a>
						</div>
						-->
					</div>
				</form>
				<!-- /simple login form -->

				</div>
			<!-- /content area -->

		</div>
		<!-- /main content -->

	</div>
	<!-- /page content -->

</div>
<!-- /page container -->
<?php
require_once("rodape.php");
?>
<?php
require_once("topo.php");
require_once("cabecalho.php");
$template = new Template();
?>

<!-- Page container -->
<div class="page-container">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<?php
		require_once("menu.php");
		?>	
		<!-- /main sidebar -->


		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Page header -->
			<div class="page-header page-header-default">
				<div class="page-header-content">
					<div class="page-title">
						<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Principal</h4>
					</div>
					
					<!--
					<div class="heading-elements">
						<div class="heading-btn-group">
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
							<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
						</div>
					</div>
					-->
					
				</div>

				<div class="breadcrumb-line">
					<ul class="breadcrumb">
						<li><a href="index.html"><i class="icon-home2 position-left"></i> Home</a></li>
						<li class="active">Principal</li>
					</ul>
					
					<!--
					<ul class="breadcrumb-elements">
						<li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="icon-gear position-left"></i>
								Settings
								<span class="caret"></span>
							</a>

							<ul class="dropdown-menu dropdown-menu-right">
								<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
								<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
								<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
								<li class="divider"></li>
								<li><a href="#"><i class="icon-gear"></i> All settings</a></li>
							</ul>
						</li>
					</ul>
					-->
					
				</div>
			</div>
			<!-- /page header -->


			<!-- Content area -->
			<div class="content">

				<!-- Dashboard content -->
				<div class="row">
					<div class="col-lg-12">

						<!-- principal -->
						<div class="panel panel-flat">
							<div class="panel-heading">
								<h6 class="panel-title">titulo</h6>
								<div class="heading-elements">
									<!-- <span class="label bg-success heading-text">28 active</span> -->
									<!--
									<ul class="icons-list">
				                		<li class="dropdown">
				                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-menu7"></i> <span class="caret"></span></a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
												<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
												<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
												<li class="divider"></li>
												<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
											</ul>
				                		</li>
				                	</ul>
				                	-->
			                	</div>
							</div>

							
							
						</div>
						<!-- /principal -->
						

					</div>

					
				</div>
				<!-- /dashboard content -->				

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
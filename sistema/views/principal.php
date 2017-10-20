<?php
require_once("topo.php");
require_once("cabecalho.php");
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
						<?php
						verMatriz($_SESSION);
						?>
						<div class="row">
							<div class="col-lg-3">

								<!-- Members online -->
								<div class="panel bg-teal-400">
									<div class="panel-body">
										<div class="heading-elements">
											<span class="heading-text badge bg-teal-800">+53,6%</span>
										</div>

										<h3 class="no-margin">3,450</h3>
										Members online
										<div class="text-muted text-size-small">489 avg</div>
									</div>

								</div>
								<!-- /members online -->

							</div>

							<div class="col-lg-3">

								<!-- Current server load -->
								<div class="panel bg-pink-400">
									<div class="panel-body">
										<div class="heading-elements">
											<!--
											<ul class="icons-list">
						                		<li class="dropdown">
						                			<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog3"></i> <span class="caret"></span></a>
													<ul class="dropdown-menu dropdown-menu-right">
														<li><a href="#"><i class="icon-sync"></i> Update data</a></li>
														<li><a href="#"><i class="icon-list-unordered"></i> Detailed log</a></li>
														<li><a href="#"><i class="icon-pie5"></i> Statistics</a></li>
														<li><a href="#"><i class="icon-cross3"></i> Clear list</a></li>
													</ul>
						                		</li>
						                	</ul>
						                	-->
										</div>

										<h3 class="no-margin">49.4%</h3>
										Current server load
										<div class="text-muted text-size-small">34.6% avg</div>
									</div>

									
								</div>
								<!-- /current server load -->

							</div>

							<div class="col-lg-3">

								<!-- Today's revenue -->
								<div class="panel bg-blue-400">
									<div class="panel-body">
										<div class="heading-elements">
											<!--
											<ul class="icons-list">
						                		<li><a data-action="reload"></a></li>
						                	</ul>
						                	-->
					                	</div>

										<h3 class="no-margin">$18,390</h3>
										Today's revenue
										<div class="text-muted text-size-small">$37,578 avg</div>
									</div>

									<div id="today-revenue"></div>
								</div>
								<!-- /today's revenue -->

							</div>
							
							<div class="col-lg-3">

								<!-- Today's revenue -->
								<div class="panel bg-blue-400">
									<div class="panel-body">
										<div class="heading-elements">
											<!--
											<ul class="icons-list">
						                		<li><a data-action="reload"></a></li>
						                	</ul>
						                	-->
					                	</div>

										<h3 class="no-margin">$18,390</h3>
										Today's revenue
										<div class="text-muted text-size-small">$37,578 avg</div>
									</div>

									<div id="today-revenue"></div>
								</div>
								<!-- /today's revenue -->

							</div>
							
						</div>
						
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
//require_once("rodape.php");
?>
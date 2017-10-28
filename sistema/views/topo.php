<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<?php
	
	$emp = new Empresa();
	if(isset($_SESSION['usuario']['id'])){
		$fg_empresa = $emp->loadId($_SESSION['usuario']['id']);
		if (!empty($fg_empresa['nome'])) {
			$empresa = $fg_empresa;
		} else {
			$empresa =  $emp->carregaEmpresa();
		}
	}else{
		$empresa =  $emp->carregaEmpresa();
	}		
	/*
	if(isset($_SESSION['usuario']['id'])){
		$arquivo = new Arquivos();
		$favicon = $arquivo->selectBlob($_SESSION['usuario']['id'], 'FAVICON-ADMIN');
		if (isset($favicon) && $favicon['size']>0) {
			$ico = '/arquivo/'.$_SESSION['usuario']['id'].'/FAVICON-ADMIN';
		} else {
			$ico = '';
		}
	}else{
		$ico = '';
	}
	*/	
	?>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?=$empresa['titulo']?></title>
	
	<!-- FAVICON -->
	<link rel="shortcut icon" href="<?=$ico?>" />
	
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="<?=site_url()?>/layout/assets/css/style.css" rel="stylesheet" type="text/css">
	
	<!-- Core JS files -->
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/visualization/d3/d3.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/visualization/d3/d3_tooltip.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/selects/bootstrap_multiselect.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/ui/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/datatables_basic.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jquery_ui/widgets.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jquery_ui/effects.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/inputs/duallistbox.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/mask/jquery.maskedinput.min.js"></script>
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/styling/switchery.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/styling/switch.min.js"></script>
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/wizards/steps.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/extensions/cookie.js"></script>
	
	<!-- EDITOR -->
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/editors/wysihtml5/wysihtml5.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/editors/wysihtml5/toolbar.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/editors/wysihtml5/parsers.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/editors/wysihtml5/locales/bootstrap-wysihtml5.ua-UA.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/notifications/jgrowl.min.js"></script>
	<!-- EDITOR -->
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/jquery.form.js"></script>
	
	<!-- <script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jasny_bootstrap.min.js"></script> -->
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/ui/fullcalendar/fullcalendar.min.js"></script>
	<!-- <script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/visualization/echarts/echarts.js"></script> -->
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/jquery.maskMoney.js"></script>		

	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/app.js"></script>
	<!-- <script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/dashboard.js"></script> -->
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/form_bootstrap_select.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/jqueryui_components.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/form_multiselect.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/form_dual_listboxes.js"></script>
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/wizard_steps.js"></script>
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/editor_wysihtml5.js"></script>
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/daterangepicker.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/anytime.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/pickadate/picker.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/pickadate/picker.date.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/pickadate/picker.time.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/pickers/pickadate/legacy.js"></script>
	
	<!-- <script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/form_checkboxes_radios.js"></script> -->	
	<!-- <script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/user_profile_tabbed.js"></script> -->
	
	<!--
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/selects/selectboxit.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/inputs/touchspin.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/uploaders/fileinput/plugins/purify.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/uploaders/fileinput/plugins/sortable.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/uploaders/fileinput/fileinput.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/forms/editable/editable.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/extensions/contextmenu.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/plugins/visualization/sparkline.min.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/pages/table_elements.js"></script>
	-->
	
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/script.js"></script>
	<script type="text/javascript" src="<?=site_url()?>/layout/assets/js/validar-form.js"></script>
	
	<!-- /theme JS files -->

</head>
<?php
$PAGINA = $_SERVER ['REQUEST_URI'];

if($PAGINA=='/sistema/' || $PAGINA=='/sistema/login'){
	$body_class = 'login-container';
}else if(strripos($PAGINA,'cliente-add') || strripos($PAGINA,'cliente-edit')){
	$body_class = 'has-detached-left pace-done';
}else{
	$body_class = '';
}
?>
<body class="<?=$body_class?>">
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>
	<head>
		<title> <?= APP_NAME ?> | <?= ucwords($title) ?></title>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6ab845">
		<meta content="width=device-width, initial-scale=1" name="viewport" />
		<?= link_tag('assets/images/favicon.png', 'png', 'image/x-icon') ?>
		<?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
		<!--Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<!-- Font awsome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/index.css?v=1.3') ?>">
	</head>
	<body>
		<!-- contents -->
		<?= $contents ?>
		<!-- contents end -->
		<?php if ($this->session->error): ?>
			<input type="hidden" id="toastr" value="<?= $this->session->error ?>" />
		<?php endif ?>
		<?php if ($this->session->success): ?>
			<input type="hidden" id="toastr" value="<?= $this->session->success ?>" />
		<?php endif ?>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script>
		    document.addEventListener('contextmenu', e => e.preventDefault());
			toastr.options = {
			  "closeButton": true,
			  "newestOnTop": false,
			  "progressBar": true,
			  "positionClass": "toast-bottom-center",
			  "preventDuplicates": false,
			  "onclick": null,
			  "showDuration": "300",
			  "hideDuration": "1000",
			  "timeOut": "5000",
			  "extendedTimeOut": "1000",
			  "showEasing": "swing",
			  "hideEasing": "linear",
			  "showMethod": "fadeIn",
			  "hideMethod": "fadeOut"
			}

			$(document).ready(function() {
				if ($("#toastr").val()) 
			    	toastr.info($("#toastr").val());
			});
		</script>
	</body>
</html>
<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="theme-color" content="#6ab845">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title> <?= APP_NAME ?> | <?= ucwords($title) ?></title>
		<!--Favicon-->
		<?= link_tag('assets/images/favicon.png', 'png', 'image/x-icon') ?>
		<?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
		<!-- Owl carousel -->
		<link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
		<link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css') ?>">
		
		<!--Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
		<!-- Font awsome -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
		<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/index.css?v=1.13') ?>">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
	</head>
	<body>
		<?php if (!in_array($name, ['add_point', 'upcoming', 'car_wash', 'thankyou', 'continue_form', 'continue_success', 'profile', 'payment_form', 'rate_list'])): ?>
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
			<a class="navbar-brand" href="<?= base_url() ?>"><img src="<?= base_url('assets/images/logo-tm.png') ?>" alt="Kappali"></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item"><a class="nav-link <?= ($name == 'home') ? 'active' : '' ?>" href="<?= base_url() ?>"><i class="fas fa-home"></i>Home</a></li>
					<li class="nav-item"><a class="nav-link <?= ($name == 'about') ? 'active' : '' ?>" href="<?= base_url('about') ?>"><i class="fas fa-info-circle"></i>About us</a></li>
					<li class="nav-item"><a class="nav-link <?= ($name == 'how-it-works') ? 'active' : '' ?>" href="<?= base_url('how-it-works') ?>"><i class="far fa-question-circle"></i></i>How it works?</a></li>
					<li class="nav-item"><a class="nav-link <?= ($name == 'profile') ? 'active' : '' ?>" href="<?= base_url('profile') ?>"><i class="far fa-user"></i></i>Profile</a></li>
					<li class="nav-item"><a class="nav-link <?= ($name == 'ratelist') ? 'active' : '' ?>" href="<?= base_url('ratelist') ?>"><i class="fas fa-rupee-sign"></i></i>Rate list</a></li>
					<li class="nav-item"><a class="nav-link <?= ($name == 'upcoming') ? 'active' : '' ?>" href="<?= base_url('upcoming') ?>"><i class="fab fa-pagelines"></i></i>Upcoming</a></li>
					<li class="nav-item app"><a class="nav-link" href="https://play.google.com/store/apps/details?id=com.kappali.kappali" target="_blank"><i class="fas fa-mobile-alt"></i>Open in App</a></li>
				</ul>
			</div>
		</nav><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br"><br class="point-br">
		<?php endif ?>
		<?= $contents ?>
		<div class="mob-footer">
			<footer>
				<div id="mySidepanel" class="sidepanel text-center">
					<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
					<a href="<?= base_url() ?>">Home</a><hr class="mob-hr text-center">
					<a href="<?= base_url('about') ?>">About us</a><hr class="mob-hr text-center">
					<a href="<?= base_url('how-it-works') ?>">How it works?</a><hr class="mob-hr text-center">
					<a href="<?= base_url('profile') ?>">Profile</a><hr class="mob-hr text-center">
					<a href="javascript:void(0)" onclick="shareApp()">Share app</a><hr class="mob-hr text-center">
					<div class="contact">
						<p>Contact Us</p>
						<div class="cont">
							<p>kappali.info@gmail.com</p>
							<p>+91 88666 79667</p>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6 col-6" style="background-color: #6ab845 ;">
						<div class="menu text-center">
							<button class="openbtn" onclick="openNav()"><h6><b>&#9776;&nbsp;&nbsp;Kappali</b></h6></button>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-6" style="background-color: #6ab845;">
						<div class="menu text-center">
							<button class="ratebtn"><a href="<?= base_url('ratelist') ?>"><h6><b>&#8377;&nbsp;&nbsp;Rate List</b></h6></a></button>
						</div>
					</div>
				</div>
			</footer>
		</div>
		<script>
			function openNav() {
				document.getElementById("mySidepanel").style.width = "100%";
			}
			function closeNav() {
				document.getElementById("mySidepanel").style.width = "0";
			}
		</script>
		<?php if ($this->session->error): ?>
			<input type="hidden" id="toastr" value="<?= $this->session->error ?>" />
		<?php endif ?>
		<?php if ($this->session->success): ?>
			<input type="hidden" id="toastr" value="<?= $this->session->success ?>" />
		<?php endif ?>
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
		<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
		<input type="hidden" id="base_url" value="<?= base_url() ?>" />
		<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

		<!-- <script src="https://checkout.paykun.com/checkout/plugin/crypt/crypto-js.min.js"></script>
		<script src="https://checkout.paykun.com/checkout/js/paykun.js"></script> -->
		<script src="<?= base_url('assets/js/script.js?v=1.0.2') ?>"></script>
		<!-- <script>initPayment('150')</script> -->
		<script>
			$(function () {
				$('#rate_id').select2({
					placeholder: "Select car type",
					allowClear: Boolean($(this).data('allow-clear')),
					closeOnSelect: !$(this).attr('multiple'),
				});
			});
		</script>
	</body>
</html>
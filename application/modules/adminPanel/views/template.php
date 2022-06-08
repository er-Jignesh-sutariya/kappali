<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<?= link_tag('assets/images/favicon.png', 'png', 'image/x-icon') ?>
		<?= link_tag('assets/images/favicon.png', 'icon', 'image/x-icon') ?>
		<title> <?= APP_NAME . ' | ' . ucfirst($title) ?> </title>
		<!-- Google font-->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
		<!-- Required Fremwork -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('bootstrap/dist/css/bootstrap.min.css') ?>">
		<!-- themify-icons line icon -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('icon/themify-icons/themify-icons.css') ?>">
		<!-- Font Awesome -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('icon/font-awesome/css/font-awesome.min.css') ?>">
		<!-- ico font -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('icon/icofont/css/icofont.css') ?>">
		<!-- feather Awesome -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('icon/feather/css/feather.css') ?>">
		<!-- <link rel="stylesheet" type="text/css" href="<?= b_asset('css/component.css') ?>"> -->
		<?php if (isset($dataTable)) : ?>
		<!-- Data Table Css -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('datatables.net-bs4/css/dataTables.bootstrap4.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= b_asset('pages/data-table/css/buttons.dataTables.min.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= b_asset('datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') ?>">
		<?php endif ?>
		<!-- Notification.css -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('pages/notification/notification.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= b_asset('select2/dist/css/select2.min.css') ?>">
		<!-- Animate.css -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('animate.css/animate.css') ?>">
		<!-- sweet alert framework -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('css/sweetalert.css') ?>">
		<!-- Switch component css -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('switchery/dist/switchery.min.css') ?>">
		<!-- Style.css -->
		<link rel="stylesheet" type="text/css" href="<?= b_asset('css/style.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= b_asset('css/jquery.mCustomScrollbar.css') ?>">
		<link rel="stylesheet" type="text/css" href="<?= b_asset('datedropper/datedropper.min.css') ?>" />
	</head>
	<body>
		<!-- Pre-loader start -->
		<div class="theme-loader">
			<div class="ball-scale">
				<div class='contain'>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
					<div class="ring">
						<div class="frame"></div>
					</div>
				</div>
			</div>
		</div>
		<!-- Pre-loader end -->
		<div id="pcoded" class="pcoded">
			<div class="pcoded-overlay-box"></div>
			<div class="pcoded-container navbar-wrapper">
				<nav class="navbar header-navbar pcoded-header">
					<div class="navbar-wrapper">
						<div class="navbar-logo">
							<a class="mobile-menu" id="mobile-collapse" href="javascript:void(0);">
								<i class="feather icon-menu"></i>
							</a>
							<a class="mobile-options">
								<i class="feather icon-more-horizontal"></i>
							</a>
						</div>
						<div class="navbar-container">
							<ul class="nav-left">
								<li>
									<a href="javascript:void(0);" onclick="javascript:toggleFullScreen()">
										<i class="feather icon-maximize full-screen"></i>
									</a>
								</li>
							</ul>
							<ul class="nav-right">
								<li class="user-profile header-notification">
									<div class="dropdown-primary dropdown">
										<div class="dropdown-toggle" data-toggle="dropdown">
											<span><?= APP_NAME ?></span>
											<i class="feather icon-chevron-down"></i>
										</div>
										<ul class="show-notification profile-notification dropdown-menu" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
											<li>
												<?= anchor(admin('profile'), '<i class="feather icon-user"></i> Profile') ?>
											</li>
											<li>
												<?= anchor(admin('logout'), '<i class="feather icon-log-out"></i> Logout', 'onclick="script.logout(); return false;" id="logout"') ?>
											</li>
										</ul>
									</div>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<!-- Sidebar inner chat end-->
				<div class="pcoded-main-container">
					<div class="pcoded-wrapper">
						<nav class="pcoded-navbar">
							<div class="pcoded-inner-navbar main-menu">
								<div class="pcoded-navigatio-lavel">Navigation</div>
								<ul class="pcoded-item pcoded-left-item">
									<?php if ($this->role === 'Super admin'): ?>
									<li class="<?= (in_array($name, ['dashboard'])) ? 'active' : '' ?>">
										<?= anchor(admin(), '<span class="pcoded-micon"><i class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span>') ?>
									</li>
									<li class="<?= ($name == 'users') ? 'active' : '' ?>">
										<?= anchor(admin('users'), '<span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Users</span>') ?>
									</li>
									<li class="<?= ($name == 'sellings') ? 'active' : '' ?>">
										<?= anchor(admin('sellings'), '<span class="pcoded-micon"><i class="fa fa-rupee"></i></span><span class="pcoded-mtext">Orders</span>') ?>
									</li>
									<li class="<?= ($name == 'car_wash') ? 'active' : '' ?>">
										<?= anchor(admin('car_wash'), '<span class="pcoded-micon"><i class="fa fa-car"></i></span><span class="pcoded-mtext">Car Wash</span>') ?>
									</li>
									<li class="<?= ($name == 'redeems') ? 'active' : '' ?>">
										<?= anchor(admin('redeems'), '<span class="pcoded-micon"><i class="fa fa-rupee"></i></span><span class="pcoded-mtext">Redeems</span>') ?>
									</li>
									<li class="<?= ($name == 'collector_form') ? 'active' : '' ?>">
										<?= anchor(admin('collector_form'), '<span class="pcoded-micon"><i class="fa fa-users"></i></span><span class="pcoded-mtext">Employees register</span>') ?>
									</li>
									<li class="<?= ($name == 'admins') ? 'active' : '' ?>">
										<?= anchor(admin('admins'), '<span class="pcoded-micon"><i class="feather icon-users"></i></span><span class="pcoded-mtext">Admins</span>') ?>
									</li>
									<li class="<?= ($name == 'article') ? 'active' : '' ?>">
										<?= anchor(admin('article'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Articles</span>') ?>
									</li>
									<li class="<?= ($name == 'coupon') ? 'active' : '' ?>">
										<?= anchor(admin('coupon'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Coupon Code</span>') ?>
									</li>
									<li class="<?= ($name == 'note') ? 'active' : '' ?>">
										<?= anchor(admin('notes'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Car Notes</span>') ?>
									</li>
									<li class="<?= ($name == 'questions') ? 'active' : '' ?>">
										<?= anchor(admin('questions'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Question Answers</span>') ?>
									</li>
									<li class="<?= ($name == 'customer') ? 'active' : '' ?>">
										<?= anchor(admin('customer'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Customers</span>') ?>
									</li>
									<li class="pcoded-hasmenu <?= (in_array($name, ['category', 'ratelist'])) ? 'pcoded-trigger' : '' ?>">
										<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span>
											<span class="pcoded-mtext">Rate List (Scrap)</span>
										</a>
										<ul class="pcoded-submenu">
											<li class="<?= ($name == 'category') ? 'active' : '' ?>">
												<?= anchor(admin('category'), '<span class="pcoded-mtext">Category</span>') ?>
											</li>
											<li class="<?= ($name == 'ratelist') ? 'active' : '' ?>">
												<?= anchor(admin('ratelist'), '<span class="pcoded-mtext">Rate List</span>') ?>
											</li>
										</ul>
									</li>
									<li class="pcoded-hasmenu <?= (in_array($name, ['car_ratelist'])) ? 'pcoded-trigger' : '' ?>">
										<a href="javascript:void(0)">
											<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span>
											<span class="pcoded-mtext">Rate List (Car wash)</span>
										</a>
										<ul class="pcoded-submenu">
											<li class="<?= ($name == 'car_ratelist') ? 'active' : '' ?>">
												<?= anchor(admin('car_ratelist'), '<span class="pcoded-mtext">Rate List</span>') ?>
											</li>
										</ul>
									</li>
									
									<!-- <li class="<?= ($name == 'area') ? 'active' : '' ?>">
										<?= anchor(admin('area'), '<span class="pcoded-micon"><i class="feather icon-file-minus"></i></span><span class="pcoded-mtext">Areas</span>') ?>
									</li> -->
									
									<?php endif ?>
									<?php if ($this->role === 'Admin'): ?>
									<?php endif ?>
									<?php if ($this->role === 'Delivery boy'): ?>
									<li class="<?= ($name == 'sellings') ? 'active' : '' ?>">
										<?= anchor(admin('sellings'), '<span class="pcoded-micon"><i class="fa fa-rupee"></i></span><span class="pcoded-mtext">Sellings</span>') ?>
									</li>
									<?php endif ?>
								</ul>
							</div>
						</nav>
						<div class="pcoded-content">
							<div class="pcoded-inner-content">
								<!-- Main-body start -->
								<div class="main-body">
									<div class="page-wrapper">
										<!-- Page-header start -->
										<div class="page-body">
											<?php if ($this->session->error): ?>
											<div class="alert alert-danger background-danger">
												<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<i class="icofont icofont-close-line-circled text-white"></i>
												</button>
												<strong>Error !</strong>
												<?= $this->session->error ?>
											</div>
											<?php endif ?>
											<div class="row">
												<?= $contents ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<input type="hidden" id="base_url" value="<?= base_url(admin()) ?>" />
		<script src="<?= b_asset('jquery/dist/jquery.min.js') ?>"></script>
		<script src="<?= b_asset('jquery-ui/jquery-ui.min.js') ?>"></script>
		<script src="<?= b_asset('popper.js/dist/umd/popper.min.js') ?>"></script>
		<script src="<?= b_asset('bootstrap/dist/js/bootstrap.min.js') ?>"></script>
		<!-- jquery slimscroll js -->
		<script src="<?= b_asset('jquery-slimscroll/jquery.slimscroll.js') ?>"></script>
		<!-- modernizr js -->
		<script src="<?= b_asset('modernizr/modernizr.js') ?>"></script>
		<script src="<?= b_asset('modernizr/feature-detects/css-scrollbars.js') ?>"></script>
		<?php if (isset($dataTable)) : ?>
		<input type="hidden" id="dataTableUrl" value="<?= base_url($url) ?>" />
		<!-- data-table js -->
		<script src="<?= b_asset('datatables.net/js/jquery.dataTables.min.js') ?>"></script>
		<script src="<?= b_asset('datatables.net-buttons/js/dataTables.buttons.min.js') ?>"></script>
		<script src="<?= b_asset('pages/data-table/js/jszip.min.js') ?>"></script>
		<script src="<?= b_asset('pages/data-table/js/pdfmake.min.js') ?>"></script>
		<script src="<?= b_asset('pages/data-table/js/vfs_fonts.js') ?>"></script>
		<script src="<?= b_asset('datatables.net-buttons/js/buttons.print.min.js') ?>"></script>
		<script src="<?= b_asset('datatables.net-buttons/js/buttons.html5.min.js') ?>"></script>
		<script src="<?= b_asset('pages/data-table/js/dataTables.bootstrap4.min.js') ?>"></script>
		<script src="<?= b_asset('datatables.net-responsive/js/dataTables.responsive.min.js') ?>"></script>
		<script src="<?= b_asset('datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js') ?>"></script>
		<script src="<?= b_asset('js/datatable-custom.js?v=1.0.1') ?>"></script>
		<?php endif ?>
		<script src="<?= b_asset('js/bootstrap-growl.min.js') ?>"></script>
		<script src="<?= b_asset('pages/notification/notification.js') ?>"></script>
		<?php if ($this->session->message) : ?>
		<script>
		notify("<?= $this->session->title ?>", "<?= $this->session->message ?>", 'top', 'center', 'fa fa-check', "<?= $this->session->notify ?>", 'animated flipInY', 'animated flipOutY');
		</script>
		<?php endif ?>
		<!-- sweet alert js -->
		<script src="<?= b_asset('js/sweetalert.js') ?>"></script>
		<!-- Switch component js -->
		<script src="<?= b_asset('switchery/dist/switchery.min.js') ?>"></script>
		<script src="<?= b_asset('datedropper/datedropper.min.js') ?>"></script>
		<script src="<?= b_asset('pages/ckeditor/ckeditor.js') ?>"></script>
		<script src="<?= b_asset('select2/dist/js/select2.full.min.js') ?>"></script>
		<script src="<?= b_asset('bootstrap-multiselect/dist/js/bootstrap-multiselect.js') ?>"></script>
		<script src="<?= b_asset('multiselect/js/jquery.multi-select.js') ?>"></script>
		<script src="<?= b_asset('pages/advance-elements/select2-custom.js') ?>"></script>
		<!-- Custom js -->
		<script src="<?= b_asset('js/pcoded.min.js') ?>"></script>
		<script src="<?= b_asset('js/vartical-layout.min.js') ?>"></script>
		<script src="<?= b_asset('js/jquery.mCustomScrollbar.concat.min.js') ?>"></script>
		<script src="<?= b_asset('js/script.js') ?>"></script>
	</body>
</html>
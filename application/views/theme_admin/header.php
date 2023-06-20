<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?= $title ?></title>
	<link rel="stylesheet" href="<?php echo base_url('vendors/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/mdi/css/materialdesignicons.min.css') ?>">
	<link rel="stylesheet" href=" <?php echo base_url('vendors/adminassets/assets/vendors/css/vendor.bundle.base.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/style2.css') ?>">
	<link rel="stylesheet" href="<?php echo base_url('vendors/table/datatables/dataTables.bootstrap4.min.css') ?>">
	<link href="<?php echo base_url('vendors/swal/dist/sweetalert2.min.css') ?>" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
	<link rel="stylesheet" href="<?php echo base_url('vendors/adminassets/assets/css/customstyle.css') ?>">

	<style>
		.sidebar .nav .nav-item:hover {
			background: #202124 !important;

		}

		.sidebar .nav .nav-item.active {
			background: #0277fa !important;
		}

		.sidebar .nav.sub-menu .nav-item .nav-link:before {
			content: "\F054";
			font-family: "Material Design Icons";
			display: block;
			position: absolute;
			left: 0px;
			top: 50%;
			-webkit-transform: translateY(-50%);
			transform: translateY(-50%);
			color: #fff;
			font-size: .75rem;
		}

		.icon-navigasi {
			float: right !important;
			margin-right: auto !important;
		}
	</style>
</head>

<body>
	<!--navbar-->
	<div class="container-scroller">
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background: #2c2d30;">
			<div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center" style="background: #2c2d30;">
				<a class="navbar-brand brand-logo d-block ml-4" href=""><img src="<?php echo base_url() ?>/assets/uploads/logo_only.svg ?>" alt="logo" style="width:20px; height:20px; margin-right:200px; " /></a>
			</div>
			<div class="navbar-menu-wrapper d-flex align-items-stretch">
				<button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
					<span class="mdi mdi-menu" style="color:#a9a9a9;"></span>
				</button>
				<div class="navbar-nav ml-auto mr-5">
					<a class="" href="<?= base_url('user/logout'); ?>" style="text-decoration:none;">
						<i class="mdi mdi-logout mr-2 text-primary"></i> Logout
					</a>
					<form id="logout-form" action="" method="POST" style="display: none;">
					</form>
				</div>

				<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
					<span class="mdi mdi-menu"></span>
				</button>
			</div>
		</nav>
		<!-- partial -->
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_sidebar.html -->
			<nav class="sidebar sidebar-offcanvas" id="sidebar" style="background: #2c2d30;">
				<ul class="nav">

					<?php
					$a      = 'active';
					$d      = $this->uri->segment(2) == 'dashboard';
					$pp     = $this->uri->segment(2) == 'Feedback';
					$pd     = $this->uri->segment(2) == 'karyawan';
					$tr     = $this->uri->segment(2) == 'Pembayaran';
					$fb     = $this->uri->segment(2) == 'catatan';
					$rp     = $this->uri->segment(2) == 'Riwayat';
					$pr     = $this->uri->segment(2) == 'project';
					?>
					<li class="nav-item nav-profile">
						<a href="<?php echo base_url('admin/dashboard') ?>" class="nav-link">
							<div class="nav-profile-text d-flex flex-column">
								<span class="font-weight-bold mb-2" style="color:#a9a9a9; font-size: 16px;">Selamat Datang <?= $user->nama ?></span>
							</div>
						</a>
					</li>

					<li class="nav-item <?php if ($d) {
											echo $a;
										} ?>">
						<a class="nav-link" href="<?php echo base_url('admin/dashboard') ?>">
							<span class="float-none float-left d-block d-sm-inline-block">
								<i class="mdi mdi-home menu-icon" style="color:#a9a9a9;"></i>
							</span>
							<div class="container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Dashboard</span>
							</div>
						</a>
					</li>

					<li class="nav-item <?php if ($pd) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
							<span class="float-none float-left d-block d-sm-inline-block">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/user.svg ?>" style="color:#a9a9a9;"></img>
							</span>
							<div class=" container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Data Karyawan</span>
							</div>
							<i class="menu-arrow text-white"></i>
						</a>
						<div class="collapse" id="ui-basic1">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/karyawan/tambah') ?>">Tambah karyawan</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/karyawan/index') ?>">Daftar karyawan</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item <?php if ($pr) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic2">
							<span class="float-none float-left d-block d-sm-inline-block">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/data_project.svg ?>" style="color:#a9a9a9;"></img>
							</span>
							<div class=" container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Data Project</span>
							</div>
							<i class="menu-arrow text-white"></i>
						</a>
						<div class="collapse" id="ui-basic2">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/project/tambah') ?>">Tambah project</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/project/index') ?>">Daftar project</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/project/projectSelesai') ?>">Daftar project Selesai</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item <?php if ($rp) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
							<span class="float-none float-left d-block d-sm-inline-block ">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/progress_pekerjaan.svg ?>"></img>
							</span>
							<div class="container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Progress Pekerjaan</span>
							</div>
							<i class="menu-arrow" style="color:#a9a9a9;"></i>
						</a>
						<div class="collapse" id="ui-basic6">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?php echo base_url('admin/Riwayat/index') ?>">Daftar progress</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/Riwayat/grafik') ?>">Grafik progress</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item <?php if ($tr) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic6">
							<span class="float-none float-left d-block d-sm-inline-block">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/pembayaran.svg ?>"></img>
							</span>
							<div class="container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Hasil Pembayaran</span>
							</div>
							<i class="menu-arrow" style="color:#a9a9a9;"></i>
						</a>
						<div class="collapse" id="ui-basic6">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/Pembayaran/index') ?>">Daftar Penggajian</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/Pembayaran/tambah') ?>">Tambah Data</a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item <?php if ($pp) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic4">
							<span class="float-none float-left d-block d-sm-inline-block">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/feedback.svg ?>"></img>
							</span>
							<div class="container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Feedback</span>
							</div>
							<i class="menu-arrow" style="color:#a9a9a9; "></i>
						</a>
						<div class="collapse" id="ui-basic4">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/Feedback/tambah') ?>">Tambah Feedback</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/Feedback/index') ?>">Daftar Feedback</a></li>
							</ul>
						</div>
					</li>

					<li class="nav-item <?php if ($fb) {
											echo $a;
										} ?>">
						<a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic5">
							<span class="float-none float-left d-block d-sm-inline-block">
								<img src="<?php echo base_url() ?>/assets/icon_navigasi/catatan_tambahan.svg ?>"></img>
							</span>
							<div class="container">
								<span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Catatan Tambahan</span>
							</div>
							<i class="menu-arrow text-white"></i>
						</a>
						<div class="collapse" id="ui-basic5">
							<ul class="nav flex-column sub-menu">
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/catatan/tambah') ?>">Tambah Catatan</a></li>
								<li class="nav-item"> <a class="nav-link text-white ml-3" style="color:#a9a9a9;" href="<?= base_url('admin/catatan/index') ?>">Daftar Catatan</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</nav>
			<!-- partial -->
			<div class="main-panel">
				<!--content-->
				<div class="content-wrapper" style="background: #202124;">
					<div class="page-header">
						<h3 class="page-title" style="color: #A9A9A9;">
							<span class="page-title-icon bg-gradient-primary mr-2" style="background:#007bff; color: #A9A9A9;">
								<?php if ($d) {
									echo '<i class="mdi mdi-home" ></i>';
								} ?>
								<?php if ($rp) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/progress_pekerjaan.svg ")  . '"></img>';
								} ?>
								<?php if ($pp) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/feedback.svg ")  . '"></img>';
								} ?>
								<?php if ($tr) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/pembayaran.svg ")  . '"></img>';
								} ?>
								<?php if ($fb) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/catatan_tambahan.svg ")  . '"></img>';
								} ?>
								<?php if ($pd) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/user.svg ")  . '"></img>';
								} ?>
								<?php if ($pr) {
									echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/data_project.svg ")  . '"></img>';
								} ?>



							</span> <?= $title ?>
						</h3>

						<nav aria-label="breadcrumb">
							<ul class="breadcrumb mr-3">
								<li class="breadcrumb-item active" aria-current="page" style="color:#a9a9a9;">
									<span class="ml-2"></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
								</li>
							</ul>
						</nav>
					</div>
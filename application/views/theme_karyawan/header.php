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
                    $pd     = $this->uri->segment(2) == 'progress';
                    $fb     = $this->uri->segment(2) == 'feedback';
                    $hl     = $this->uri->segment(2) == 'pembayaran';
                    $pg     = $this->uri->segment(2) == 'catatan';
                    $pr     = $this->uri->segment(2) == 'ProjectKaryawan';
                    ?>
                    <li class="nav-item nav-profile">
                        <a href="<?php echo base_url('karyawan/dashboard') ?>" class="nav-link">
                            <div class="nav-profile-text d-flex flex-column">
                                <span class="font-weight-bold mb-2" style="color:#a9a9a9; font-size: 16px;"> <?= $user->nama ?></span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item <?php if ($d) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" href="<?php echo base_url('karyawan/dashboard') ?>">
                            <span class="float-none float-left d-block d-sm-inline-block">
                                <i class="mdi mdi-home menu-icon" style="color:#a9a9a9;"></i>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Dashboard</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($pr) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" href="<?php echo base_url('karyawan/ProjectKaryawan'); ?>">
                            <span class="float-none float-left d-block d-sm-inline-block">
                                <img src="<?php echo base_url() ?>/assets/icon_navigasi/data_project.svg ?>"></img>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Project</span>
                            </div>
                        </a>
                    </li>

                    <li class="nav-item <?php if ($pd) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic1">
                            <span class="float-none float-left d-block d-sm-inline-block ">
                                <img src="<?php echo base_url() ?>/assets/icon_navigasi/progress_pekerjaan.svg ?>"></img>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Progress Pekerjaan</span>
                            </div>
                            <i class="menu-arrow" style="color:#a9a9a9;"></i>

                        </a>
                        <div class="collapse" id="ui-basic1">
                            <ul class="nav flex-column sub-menu">
                                <li class="nav-item"> <a class="nav-link" style="color:#a9a9a9;" href="<?= base_url('karyawan/progress/tambah') ?>">Tambah Progress</a></li>
                                <li class="nav-item"> <a class="nav-link" style="color:#a9a9a9;" href="<?= base_url('karyawan/progress/index') ?>">Daftar Progress</a></li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item <?php if ($hl) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" href="<?php echo base_url('karyawan/pembayaran'); ?>">
                            <span class="float-none float-left d-block d-sm-inline-block">
                                <img src="<?php echo base_url() ?>/assets/icon_navigasi/pembayaran.svg ?>"></img>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Hasil Pembayaran</span>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item <?php if ($fb) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" href="<?php echo base_url('karyawan/feedback') ?>">
                            <span class="float-none float-left d-block d-sm-inline-block">
                                <img src="<?php echo base_url() ?>/assets/icon_navigasi/feedback.svg ?>"></img>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Feedback</span>
                            </div>
                        </a>
                    </li>
                    </li>
                    <li class="nav-item <?php if ($pg) {
                                            echo $a;
                                        } ?>">
                        <a class="nav-link" href="<?php echo base_url('karyawan/catatan') ?>">
                            <span class="float-none float-left d-block d-sm-inline-block">
                                <img src="<?php echo base_url() ?>/assets/icon_navigasi/catatan_tambahan.svg ?>"></img>
                            </span>
                            <div class="container">
                                <span class="menu-title" style="color:#a9a9a9; font-size: 16px;">Catatan Tambahan</span>
                            </div>
                        </a>
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
                                <?php if ($pd) {
                                    echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/progress_pekerjaan.svg ")  . '"></img>';
                                } ?>
                                <?php if ($fb) {
                                    echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/feedback.svg ")  . '"></img>';
                                } ?>
                                <?php if ($hl) {
                                    echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/pembayaran.svg ")  . '"></img>';
                                } ?>
                                <?php if ($pg) {
                                    echo '<img class="mt-2"src="' . base_url("/assets/icon_navigasi/catatan_tambahan.svg ")  . '"></img>';
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
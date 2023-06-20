<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sistem Management Karyawan</title>
    
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">


    
</head>

<body class=""style="background: #202124;">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row" style="background: #2c2d30;">
                    <div class="col-lg-5 d-none d-lg-block text-center mt-5"><img src="<?php echo base_url() ?>/assets/uploads/logo_only.svg ?>" alt="logo"  class="rounded mx-auto d-block mt-5" style="width:200px; height:200px; " /></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h3 text-white-900 mb-4"><strong>Sistem Management Karyawan</strong></h1>
                            </div>
                            <br>
            
                        <form class="user" action="<?= base_url('user/forgotPassword'); ?>" method="POST" enctype="multipart/form-data">
                            <!-- <div class="form-group">
                                <input type="hidden" class="form-control" name="admin_id" value="">
                            </div> -->

                            <div class="form-group">
                                    <label for="exampleInputUsername1">Masukan Email</label>
                                    <input type="email" class="form-control form-control-user" placeholder="Masukan Alamat Email" name="email" required>
                                </div>
                                <!-- <div class="col-sm-6 mb-3 mb-sm-0">
                                    <label for="exampleInputUsername1">Konfirmasi Password</label>
                                    <input type="text" class="form-control form-control-user" placeholder="***" name="password2" required>
                                </div> -->
                            <hr>
                            <button type="submit" class="btn btn-success btn-block">Reset Password</button>
                        </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
    <script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('js/sb-admin-2.min.js') ?>"></script>

</body>

</html>




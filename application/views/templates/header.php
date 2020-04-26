<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap/bootstrap.min.css">

    <!-- MY CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font/fontawesome/css/all.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/font/fontawesome/css/all.min.css">

    <title>JUDUL HOME</title>
</head>

<body>
    <!-- Body content -->
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg navbar-light index" id="top">
        <div class="container <?php echo $this->session->userdata('oauth_provider'); ?>">
            <a class="navbar-brand" href="<?= base_url(); ?>">Cari GS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ml-auto">
                    <!-- <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a> -->
                    <!-- <a class="nav-item nav-link" href="#">Pricing</a>
                    <a class="nav-item nav-link" href="#">Features</a>
                    <a class="nav-item nav-link" href="#">About</a> -->
                    <a class="nav-item btn btn-primary email" href="<?= base_url('auth/logoutuser'); ?>">Keluar</a>
                    <a class="nav-item btn btn-primary facebook" href="<?php echo $logoutURL; ?>">Keluar</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Akhir Navbar -->
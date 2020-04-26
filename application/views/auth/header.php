<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/bootstrap/bootstrap.min.css">

  <!-- MY CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/Auth.css">

  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/font/fontawesome/css/all.css">
  <link rel="stylesheet" href="<?= base_url(); ?>assets/font/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/v4-shims.css">

  <!-- Wizard -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/js/SmartWizard/dist/css/smart_wizard.min.css">
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/js/SmartWizard/dist/css/smart_wizard.css">


  <title><?= $title; ?></title>
</head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-dark">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="">Navbar</a>

    <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
      <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      </ul>
      <form class="form-inline my-2 my-lg-0">
        <a href="<?= base_url(); ?>Auth/<?= $redir; ?>" class="btn btn-outline-success my-2 my-sm-0">Login As <?= $titlebtn; ?></a>
      </form>
    </div>
  </div>
</nav>
<!-- akhir navbar -->
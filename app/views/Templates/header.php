<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= DESKRIPSI; ?>">
    <meta name="keywords" content="<?= KEYWORD; ?>">
    <meta name="author" content="hdev.web.id">
    <link rel="icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png" />
    <link rel="shortcut icon" href="<?= BASEURL; ?>assets/img/icon/icon32x32.png" type="image/png"/>
    <link rel="manifest" href="<?= BASEURL."web.manifest"; ?>">
    <title><?= TITLE; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <!-- Bootstrap ICON -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
    <!-- Sweet Alert CSS -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.min.css" rel="stylesheet">
    <!-- datatables CSS -->
    <link href="https://cdn.datatables.net/2.1.0/css/dataTables.bootstrap5.css" rel="stylesheet">
    <!-- alpine js -->
    <!-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> -->
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.12.3/dist/sweetalert2.all.min.js"></script>
    <!-- JQuery JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap");
      * {
        font-family: "Poppins", sans-serif;
      }
      .navbar {
        padding-top: 0.5rem;
        padding-bottom: 0.5rem;
      }
      .background-section {
        background-image: url("<?=BASEURL;?>assets/img/bg.png");
        background-size: cover;
        background-position: center;
        min-height: 100vh;
      }
      .info-box {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
        border-radius: .25rem;
        background: #fff;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 1rem;
        min-height: 80px;
        padding: .5rem;
        position: relative;
        width: 100%;
      }

      .info-box .info-box-icon {
          border-radius: .25rem;
          -ms-flex-align: center;
          align-items: center;
          display: -ms-flexbox;
          display: flex;
          font-size: 1.875rem;
          -ms-flex-pack: center;
          justify-content: center;
          text-align: center;
          width: 70px;
      }
      .info-box .info-box-content {
          display: -ms-flexbox;
          display: flex;
          -ms-flex-direction: column;
          flex-direction: column;
          -ms-flex-pack: center;
          justify-content: center;
          line-height: 120%;
          -ms-flex: 1;
          flex: 1;
          padding: 0 10px;
      }

    </style>
    
  </head>
  <body style="background-color: #e3e5d8; padding-bottom: 80px" class="background-section">
    <?php
      $geturl = explode("=",$_SERVER['QUERY_STRING']);
      $lastvalue = array_pop($geturl);
    ?>
    <div class="sticky-top" style="background-color: #2d3748; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
      <div class="container-fluid">
        <img src="<?=BASEURL;?>assets/img/logo.png" alt="Logo" class="img-fluid" style="max-height: 60px"/>
        <span class="text-white ms-2 fw-semibold">Disapu</span>
      </div>
    </div>
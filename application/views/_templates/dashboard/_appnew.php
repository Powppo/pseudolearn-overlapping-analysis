<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title><?= $judul ?></title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="<?= base_url() ?>assets/backend/html/dist/assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/backend/html/dist/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/backend/html/dist/assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="<?= base_url() ?>assets/backend/html/dist/assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="<?= base_url() ?>assets/backend/html/dist/assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">

        <?php require_once("_headers.php"); ?>

        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            
        <?php require_once("_sidebars.php"); ?>

        </nav>
        <!-- END SIDEBAR-->
<?php 
  session_start(); 

  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: stockin.php");
  }
?>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Seed Inventory Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/logo.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.1/css/dataTables.dataTables.min.css" />
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
    <!-- Chartjs -->    
    <script src="../assets/js/Chart.min.js"></script>

    <style>
        table {
            table-layout: fixed ;
            width: 100% ;
        }

        select.form-control:not([size]):not([multiple]) {
            height: auto;
        }

        .table thead th {
            vertical-align: middle;
        }
        .text-green {
            color: greenyellow;
        }
        .text-orange {
            color: rgb(255, 165, 0);
        }
        .dataTables_filter, .paging_simple_numbers {
            text-align: right;
        }
        .dataTables_info {
            padding: 20px 0;
        }
        .paging_simple_numbers .pagination {
            justify-content: flex-end;
        }
        .dataTables_length label, 
        .dataTables_filter label {
            display: flex;
            align-items: center;
        }
        .dataTables_filter label {
            justify-content: flex-end;
        }
        .dataTables_filter input {
            margin: 0 10px;
            width: 50%;
        }
    </style>       


</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <!-- page container area start -->
    <div class="page-container">
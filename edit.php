<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="Inventmng/srtdash/assets/bootstrap.min.css">
</head>
<body>

<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

    <!-- logged in user information -->
   
</div>
<script>src="srtdash/assets/js/vendor/jquery-2.2.4.min.js" </script>
<script>src="srtdash/assets/js/vendor/modernizr-2.8.3.min.js" </script>
</body>
</html>



<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
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


        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.php"><img src="da-logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <nav>


                        <ul class="metismenu" id="menu">
                            <li>
                            <a href="index.php" aria-expanded="true"><i class="ti-dashboard"></i><span>Dashboard</span></a>  
                            </li>
                            
                        

                            </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->



        <!-- main content area start -->
                            <div class="main-content">
                            <?php
                            include('config.php');
                            if (isset($_POST['submit']))
                            {
                            $id=$_POST['id'];
                            $date_received=mysqli_real_escape_string($db, $_POST['date_received']);
                            $category=mysqli_real_escape_string($db, $_POST['category']);
                            $commodity=mysqli_real_escape_string($db, $_POST['commodity']);                                                      
                            $variety=mysqli_real_escape_string($db, $_POST['variety']);
                            $year=mysqli_real_escape_string($db, $_POST['year']);
                            $batch=mysqli_real_escape_string($db, $_POST['batch']);
                            $lot=mysqli_real_escape_string($db, $_POST['lot']);                                                        
                            $bags=mysqli_real_escape_string($db, $_POST['bags']);                          
                            $remarks=mysqli_real_escape_string($db, $_POST['remarks']);



                            mysqli_query($db,"UPDATE product SET date_received='$date_received', category='$category', commodity='$commodity' ,variety='$variety' ,year='$year' ,batch='$batch' ,lot='$lot' ,bags='$bags' ,remarks='$remarks' WHERE product_id='$id'");
                            header("Location:stockin.php");
                            }
                            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                            {
                            $id = $_GET['id'];
                            $result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);
                            $row = mysqli_fetch_array($result);
                            if($row)
                            {
                            $product_id             = $row['product_id'];
                            $date_received          = $row['date_received'];
                            $category               = $row['category'];
                            $commodity              = $row['commodity'];                           
                            $variety                = $row['variety'];
                            $year                   = $row['year']; 
                            $batch                  = $row['batch']; 
                            $lot                    = $row['lot'];                           
                            $bags                   = $row['bags'];                           
                            $remarks                = $row['remarks'];
                            }
                            else
                            {
                            echo "No results!";
                            }
                            }
                            ?>


                            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                            <html>
                            <head>
                                <style>
                                    table {
                                      font-family: arial, sans-serif;
                                      border-collapse: collapse;
                                      width: 100%;
                                    }

                                    input[type=text] {
                                      width: 200%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid red;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }

                                    input[type=date] {
                                      width: 135%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid red;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }

                                    input[type=submit] {
                                      width: 100%;
                                      padding: 10px 20px;
                                      margin: 8px 0;
                                      border: 2px solid green;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }


                                    td, th {
                                      border: 1px solid #dddddd;
                                      text-align: left;
                                      padding: 8px;
                                    }

                                    tr:nth-child(even) {
                                      background-color: #dddddd;
                                    }
                                    </style>
                            <title>Edit Item</title>
                            </head>
                            <body>

                            <form action="" method="post" action="edit.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <table border="2">
                            <tr><td colspan="2"><b><font color='Green'><h1>Edit Records</h1></font></b></td></tr>
                            
                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Date Delivered<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="date" name="date_received" value="<?php echo $date_received;?>" placeholder="MM-DD-YYYY" />
                                </label>
                                </td>
                            </tr>

                            <tr><td width="250"><b><font color='#663300'><h4>Category<em>*</em></h4></font></b></td>
                                <td width="250"><label>
                                <input type="text" name="category" value="<?php echo $category; ?>" />
                                </label>
                                </td>
                            </tr>
                            
                            <tr><td width="250"><b><font color='#663300'><h4>Commodity<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="commodity" value="<?php echo $commodity ?>" />
                                </label>
                                </td>
                            </tr>

                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Variety<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="variety" value="<?php echo $variety ?>" />
                                </label>
                                </td>
                            </tr>

                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Procurement Year<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="year" value="<?php echo $year;?>" />
                                </label>
                                </td>
                            </tr>

                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Delivery Batch<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="batch" value="<?php echo $batch;?>" />
                                </label>
                                </td>
                            </tr>

                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Lot Number<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="lot" value="<?php echo $lot;?>" />
                                </label>
                                </td>
                            </tr>

                            <tr>
                            <td width="250"><b><font color='#663300'><h4>Number of Bags Delivered<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="bags" value="<?php echo $bags;?>" />
                                </label>
                                </td>
                            </tr>

                            <td width="250"><b><font color='#663300'><h4>Remarks<em>*</em></h4></font></b></td>
                                <td><label>
                                <input type="text" name="remarks" value="<?php echo $remarks;?>" />
                                </label>
                                </td>
                            </tr>
                            <tr align="Right">
                            <td colspan="2"><label>
                            <input type="submit" name="submit" value="Save">
                            </label></td>
                            </tr>
                            </table>
                            </table>
                            </form>
                            </body>
                            </html>
                            </div>

































        




        
        <!-- main content area end -->
        <!-- footer area start-->
                          <br><br><br>
                          <footer id="footer">
                              <div class="copyright">
                                &copy; Copyright <strong><span>PMED7-ICT</span></strong>
                              </div>
                              <div class="credits">
                                Developer: <a href="https://www.facebook.com/feromel.magalso">Feromel Q. Magalso</a>
                              </div>
                          </footer><!-- End  Footer --> <br><br>
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    <div class="offset-area">
        <div class="offset-close"><i class="ti-close"></i></div>
        <ul class="nav offset-menu-tab">
            <li><a class="active" data-toggle="tab" href="#activity">Activity</a></li>
            <li><a data-toggle="tab" href="#settings">Settings</a></li>
        </ul>
        
           
    <!-- offset area end -->
    <!-- jquery latest version -->
    <script src="assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/metisMenu.min.js"></script>
    <script src="assets/js/jquery.slimscroll.min.js"></script>
    <script src="assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
    zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
    ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>
    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>



</html>

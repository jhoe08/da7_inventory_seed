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
                            
                           
                            
                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-table"></i>
                                    <span>Item Records</span></a>                           
                            </li>

                            <li>
                                <a href="stockin.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock In</a>
                            </li>
                            
                            <li>
                                <a href="stockout.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Stock Out</a>
                            </li>  

                            <li>
                                <a href="germination.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Germination Date</a>
                            </li>

                            <li>
                                <a href="beneficiary.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View all Beneficiaries</a>
                            </li>

                            <li>
                                <a href="#" aria-expanded="true"><i class="fa fa-edit"></i><span>Reports</span></a>
                            </li>

                            <li>
                                <a href="report_commodity.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;By commodities</a>
                            </li>
                            
                            <li>
                                <a href="report_stock.php" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No. of Remaining Bags</a>
                            </li>                          

                            <li>
                                <a href="report_print.php" target="_blank" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print Stock Reports</a>
                            </li> 

                            <li>
                                <a href="report_print_beneficiary.php" target="_blank" aria-expanded="true">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Print Beneficiary</a>
                            </li> 

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->


 



                            <!---------------------------------------------- START 1 ------------------------------------------------------>
                            
                            <?php
                            include('config.php');
                            if (isset($_POST['submit1'])){
                            $id=$_POST['id'];         
                            $bags=mysqli_real_escape_string($db, $_POST['bags']);                                                   // no of bags delivered
                            $bags_distributed1=mysqli_real_escape_string($db, $_POST['bags_distributed1']);                         // first distribution
                            $date_distributed1=mysqli_real_escape_string($db, $_POST['date_distributed1']);                         // date of first distribution 
                            $province1=mysqli_real_escape_string($db, $_POST['province1']);                                         // province of first distribution            
                            $lgu1=mysqli_real_escape_string($db, $_POST['lgu1']);                                                   // lgu of first distribution  
                            $assoc1=mysqli_real_escape_string($db, $_POST['assoc1']);                                               // assoc of first distribution 
                            $remarks_out1=mysqli_real_escape_string($db, $_POST['remarks_out1']);                                   //remarks for first beneficiary

                            mysqli_query($db,"UPDATE product SET grandtotal_remaining_bags='$bags' - '$bags_distributed1' ,remaining_bags1='$bags' - '$bags_distributed1' ,grandtotal_bags_distributed='$bags_distributed1' ,bags_distributed1='$bags_distributed1' ,date_distributed1='$date_distributed1' ,province1='$province1' ,lgu1='$lgu1', assoc1='$assoc1', remarks_out1='$remarks_out1'    WHERE product_id='$id'");
                            }
                            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                            {
                            $id = $_GET['id'];
                            $result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);
                            $row = mysqli_fetch_array($result);
                            if($row)
                            {
                            $id                          = $row['product_id'];                                                    
                            $bags                        = $row['bags'];                                         // no of bags delivered 
                            $bags_distributed1           = $row['bags_distributed1'];                            // first distribution
                            $date_distributed1           = $row['date_distributed1'];                            // date of first distribution
                            $remaining_bags1             = $row['remaining_bags1'];                              // remaining bag from the first distribution
                            $grandtotal_remaining_bags   = $row['grandtotal_remaining_bags'];                            
                            $province1                   = $row['province1'];                                    // province of first distribution 
                            $lgu1                        = $row['lgu1'];                                         // lgu of first distribution 
                            $assoc1                      = $row['assoc1'];                                       // assoc of first distribution
                            $remarks_out1                = $row['remarks_out1'];                                 //remarks for first beneficiary
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
                                      width: 45%;
                                    }
                                    input[type=text] {
                                      width: 150%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid lightgray;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }
                                    input[type=textbox] {
                                      width: 30%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid lightgray;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }
                                    input[type=fero] {
                                      width: 100%;
                                      text-align: right;
                                      padding: 12px 20px;
                                      margin: 6px 0;
                                      border: 6px solid green;
                                      border-radius: 10px;
                                      box-sizing: border-box;
                                    }
                                    input[type=texting] {
                                      width: 200%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid blue;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }
                                    input[type=number] {
                                      width: 28.7%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid blue;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                    }
                                    input[type=date] {
                                      width: 265%;
                                      padding: 12px 20px;
                                      margin: 8px 0;
                                      border: 2px solid blue;
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
                            </head>
                            <body>
                            <form action="" method="post" action="">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <table border="2">
                            <tr><td colspan="2"><b><font color='Green'><h2>First Beneficiary</h2></font></b></td></tr>

                            <tr>
                            <td width="250"><b><font color='blue'><h5>Date Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="date" name="date_distributed1" value="<?php echo $date_distributed1;?>" placeholder="MM-DD-YYYY"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Number of Bags Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="textbox" name="bags" value="<?php echo $bags;?>" readonly="readonly"/> &nbsp;&nbsp; minus bags for out &nbsp;&nbsp;
                                <input type="number" name="bags_distributed1" value="<?php echo $bags_distributed1;?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Province)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="province1" value="<?php echo $province1;?>" placeholder="Enter Province"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (LGU)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="lgu1" value="<?php echo $lgu1;?>" placeholder="Enter LGU"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Farmers Association)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="assoc1" value="<?php echo $assoc1;?>" placeholder="Enter Farmers Association" />
                                </label>
                                </td>
                            </tr> 

                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Remarks*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="remarks_out1" value="<?php echo $remarks_out1;?>" placeholder="Remarks..." />
                                </label>
                                </td>
                            </tr>


                            <tr align="Right">
                            <td colspan="2"><label>
                            <input type="submit" name="submit1" value="Add 1st">
                            </label></td>
                            </tr>
                            </table>
                            </form>
                            <br><br>
                             <!---------------------------------------------------- END 1 ----------------------------------------------------------->



                            <!---------------------------------------------------- START 2 ---------------------------------------------------------->
                        
                            <?php
                            include('config.php');
                            if (isset($_POST['submit2']))
                            {
                            $id=$_POST['id'];  
                            $date_distributed2=mysqli_real_escape_string($db, $_POST['date_distributed2']);             // date of second distribution                                   
                            $bags_distributed2=mysqli_real_escape_string($db, $_POST['bags_distributed2']);             // second distribution                           
                            $remaining_bags1=mysqli_real_escape_string($db, $_POST['remaining_bags1']);                 // remaining from the first distribution  
                            $province2=mysqli_real_escape_string($db, $_POST['province2']);                             // province of second distribution
                            $lgu2=mysqli_real_escape_string($db, $_POST['lgu2']);                                       // lgu of second distribution
                            $assoc2=mysqli_real_escape_string($db, $_POST['assoc2']);                                   // assoc of second distribution
                            $remarks_out2=mysqli_real_escape_string($db, $_POST['remarks_out2']);                       //remarks for second beneficiary

                            mysqli_query($db,"UPDATE product SET grandtotal_remaining_bags='$remaining_bags1' - '$bags_distributed2' ,remaining_bags2='$remaining_bags1' - '$bags_distributed2' ,grandtotal_bags_distributed='$bags_distributed1' + '$bags_distributed2' ,date_distributed2='$date_distributed2' ,bags_distributed2='$bags_distributed2' ,province2='$province2' ,lgu2='$lgu2', assoc2='$assoc2' , remarks_out2='$remarks_out2'  WHERE product_id='$id'");
                            }
                            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                            {
                            $id = $_GET['id'];
                            $result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);
                            $row = mysqli_fetch_array($result);
                            if($row)
                            {
                            $id                             = $row['product_id'];                         
                            $bags_distributed2              = $row['bags_distributed2'];
                            $total_bags_distributed         = $row['total_bags_distributed'];
                            $remaining_bags2                = $row['remaining_bags2'];
                            $grandtotal_remaining_bags      = $row['grandtotal_remaining_bags'];
                            $date_distributed2              = $row['date_distributed2'];                            
                            $province2                      = $row['province2'];    
                            $lgu2                           = $row['lgu2'];
                            $assoc2                         = $row['assoc2'];
                            $remarks_out2                   = $row['remarks_out2'];
                            }
                            else
                            {
                            echo "No results!";
                            }
                            }
                            ?>
                            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                            <html>
                            <form action="" method="post" action="edit.php" onsubmit="return submitForm();">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <table border="2">
                            <tr><td colspan="2"><b><font color='Green'><h2>Second Beneficiary (if applicable)</h2></font></b></td></tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Date Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="date" name="date_distributed2" value="<?php echo $date_distributed2;?>" placeholder="MM-DD-YYYY"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Number of Bags Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="textbox" name="remaining_bags1" value="<?php echo $remaining_bags1;?>" readonly="readonly"/> &nbsp;&nbsp; minus bags for out &nbsp;&nbsp;
                                <input type="number" name="bags_distributed2" value="<?php echo $bags_distributed2;?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Province)<em>*</em></h5></font></b></td>
                                <td>
                                    <label>
                                <input type="texting" name="province2" value="<?php echo $province2;?>" placeholder="Enter Province"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (LGU)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="lgu2" value="<?php echo $lgu2;?>" placeholder="Enter LGU"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Farmers Association)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="assoc2" value="<?php echo $assoc2;?>" placeholder="Enter Farmers Association" />
                                </label>
                                </td>
                            </tr> 

                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Remarks*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="remarks_out2" value="<?php echo $remarks_out2;?>" placeholder="Remarks..." />
                                </label>
                                </td>
                            </tr>


                            <tr align="Right">
                            <td colspan="2"><label>
                            <input type="submit" name="submit2" value="Add 2nd">
                            </label></td>
                            </tr>
                            </table>
                            </form>
                            <br><br>
                          <!-------------------------------------------------- END 2  ---------------------------------------------------------->


                            <!---------------------------------------------------- START 3 ---------------------------------------------------------->
                        
                            <?php
                            include('config.php');
                            if (isset($_POST['submit3']))
                            {
                            $id=$_POST['id'];  
                            $date_distributed3=mysqli_real_escape_string($db, $_POST['date_distributed3']);                                      
                            $bags_distributed3=mysqli_real_escape_string($db, $_POST['bags_distributed3']);                                                          
                            $province3=mysqli_real_escape_string($db, $_POST['province3']);               
                            $lgu3=mysqli_real_escape_string($db, $_POST['lgu3']);                         
                            $assoc3=mysqli_real_escape_string($db, $_POST['assoc3']);                                  
                            $remarks_out3=mysqli_real_escape_string($db, $_POST['remarks_out3']);                       

                            mysqli_query($db,"UPDATE product SET grandtotal_remaining_bags='$remaining_bags2' - '$bags_distributed3' ,grandtotal_bags_distributed='$bags_distributed1' + '$bags_distributed2' + '$bags_distributed3' ,date_distributed3='$date_distributed3' ,bags_distributed3='$bags_distributed3' ,province3='$province3' ,lgu3='$lgu3', assoc3='$assoc3' , remarks_out3='$remarks_out3'  WHERE product_id='$id'");
                            }
                            if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
                            {
                            $id = $_GET['id'];
                            $result = mysqli_query($db,"SELECT * FROM product WHERE product_id=".$_GET['id']);
                            $row = mysqli_fetch_array($result);
                            if($row)
                            {
                            $id                             = $row['product_id'];                         
                            $bags_distributed3              = $row['bags_distributed3'];
                            $total_bags_distributed         = $row['total_bags_distributed'];
                            $total_remaining_bags           = $row['total_remaining_bags'];
                            $grandtotal_remaining_bags      = $row['grandtotal_remaining_bags'];                            
                            $date_distributed3              = $row['date_distributed3'];                            
                            $province3                      = $row['province3'];    
                            $lgu3                           = $row['lgu3'];
                            $assoc3                         = $row['assoc3'];
                            $remarks_out3                   = $row['remarks_out3'];
                            }
                            else
                            {
                            echo "No results!";
                            }
                            }
                            ?>
                            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                            <html>
                            <form action="" method="post" action="edit.php" onsubmit="return submitForm();">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <table border="2">
                            <tr><td colspan="2"><b><font color='Green'><h2>Third Beneficiary (if applicable)</h2></font></b></td></tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Date Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="date" name="date_distributed3" value="<?php echo $date_distributed3;?>" placeholder="MM-DD-YYYY"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Number of Bags Distributed<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="textbox" name="remaining_bags2" value="<?php echo $remaining_bags2;?>" readonly="readonly"/> &nbsp;&nbsp; minus bags for out &nbsp;&nbsp;
                                <input type="number" name="bags_distributed3" value="<?php echo $bags_distributed3;?>"/> &nbsp;&nbsp;&nbsp;&nbsp;
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Province)<em>*</em></h5></font></b></td>
                                <td>
                                    <label>
                                <input type="texting" name="province3" value="<?php echo $province3;?>" placeholder="Enter Province"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (LGU)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="lgu3" value="<?php echo $lgu3;?>" placeholder="Enter LGU"/>
                                </label>
                                </td>
                            </tr>
                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Beneficiaries (Farmers Association)<em>*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="assoc3" value="<?php echo $assoc3;?>" placeholder="Enter Farmers Association" />
                                </label>
                                </td>
                            </tr> 

                            <tr>
                            <td width="250"><b><font color='#663300'><h5>Remarks*</em></h5></font></b></td>
                                <td><label>
                                <input type="texting" name="remarks_out3" value="<?php echo $remarks_out3;?>" placeholder="Remarks..." />
                                </label>
                                </td>
                            </tr>


                            <tr align="Right">
                            <td colspan="2"><label>
                            <input type="submit" name="submit3" value="Add 3rd">
                            </label></td>
                            </tr>
                            </table>
                            </form>
                            <br><br>
                          <!-------------------------------------------------- END 3  ---------------------------------------------------------->







                          <!------------------------------------ TOTAL NO. OF BAGS DISTRIBUTED --------------------------------->

                            <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
                            <html>
                            <form action="" method="post" action="edit.php">
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <table border="2">
                            <tr><td colspan="2"><b><font color='Green'><h2>TOTAL NUMBER OF BAGS</h2></font></b></td></tr>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Total Number of Bags<em>*</em></h5></font></b>
                            </td>
                            <td><label>
                            <input type="texting" name="bags" value="<?php echo $bags;?>" readonly="readonly"/>
                            </label>
                            </td>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Total Number of Bags Distributed<em>*</em></h5></font></b>
                            </td>
                            <td><label>
                            <input type="number" name="bags_distributed1" value="<?php echo $bags_distributed1;?>" readonly="readonly" /> +
                            <input type="number" name="bags_distributed2" value="<?php echo $bags_distributed2;?>" readonly="readonly" /> +
                            <input type="number" name="bags_distributed3" value="<?php echo $bags_distributed3;?>" readonly="readonly" />
                            </label>
                            </td>
                            <tr>
                            <td width="250"><b><font color='blue'><h5>Remaining Number of Bags<em>*</em></h5></font></b>
                            </td>
                            <td><label>
                            <input type="texting" name="grandtotal_remaining_bags" value="<?php echo $grandtotal_remaining_bags;?>" readonly="readonly" />
                            </label>
                            </td>
                            </tr>
                            <tr align="Right">
                            </tr>
                            </table>
                            </form>
                            <br><br>
                        <!----------------------------------- TOTAL NO. OF BAGS DISTRIBUTED END ---------------------------------------->

                            </body>
                            </html>
                            
        
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

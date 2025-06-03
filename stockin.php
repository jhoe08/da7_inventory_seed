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


        <style>
        table {
        table-layout: fixed ;
        width: 100% ;
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


        
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="search-box pull-left">
                            <form action="#">
                                <input type="text" name="search" placeholder="Search..." required>
                                <i class="ti-search"></i>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Dashboard</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="index.php">Home</a></li>
                                <li><a href="#">Item Records</a></li>
                                <li><a href="#">Reports</a></li>                                
                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="siete.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> <i class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">  
                               <a class="dropdown-item" href="index.php?logout='1'">Log Out</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- page title area end -->
            <div>

<body>
<div class="col-md-12 clearfix">          
<h1 style="text-align:left">Stock In Items</h1> 

<form method="POST" class="form-inline" action="additem.php">


                                            <div class="form-group">
                                            <label for="name">Date Delivered</label>&nbsp;&nbsp;&nbsp;
                                            <input type="date" placeholder="MM-DD-YYYY" class="form-control" name="date_received"  style="width: 150px; height: 35px;" required>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            
                                            <div class="form-group">
                                            <label for="name">Category</label> &nbsp;&nbsp;&nbsp;
                                            <select id="category" name="category" style="width: 150px; height: 35px;" required>
                                                <option value="">Choose one</option>
                                                <option value="Rice_Prog_PSS">Rice_Prog_PSS</option>
                                                <option value="Rice_Prog_CHRF">Rice_Prog_CHRF</option>
                                                <option value="Rice_Prog_Seed_Reserved">Rice_Prog_Seed_Reserved</option>
                                                <option value="Private_Renting">Private_Renting</option>
                                                <option value="USF-Seeds">USF-Seeds</option>
                                                <option value="SWRCD-Seeds">SWRCD-Seeds</option>                                                 
                                            </select></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="form-group">
                                            <label for="name">Commodity</label> &nbsp;&nbsp;&nbsp;
                                            <select id="commodity" name="commodity" style="width: 150px; height: 35px;" required>
                                                <option value="">Choose one</option>Z`
                                                <option value="Rice">Rice</option>
                                                <option value="Corn">Corn</option>
                                                <option value="Sorghum">Sorghum</option>
                                            </select></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="form-group">
                                            <label for="name">Variety</label> &nbsp;&nbsp;&nbsp;
                                            <select id="variety" name="variety" style="width: 150px; height: 35px;" required>
                                                <option value="">Choose one</option>
                                                <option value="NSIC Rc 486H (LP534)">NSIC Rc 486H (LP534)</option>
                                                <option value="NSIC Rc 410H (Habilis Plus)">NSIC Rc 410H (Habilis Plus)</option>
                                                <option value="NSIC Rc 132H (SL8H)">NSIC Rc 132H (SL8H)</option>
                                                <option value="NSIC Rc 490H (Hatao Dinorado)">NSIC Rc 490H (Hatao Dinorado)</option>
                                                <option value="NSIC Rc 666H (Jackpot 102)">NSIC Rc 666H (Jackpot 102)</option>
                                                <option value="NSIC Rc 236H (US88)">NSIC Rc 236H (US88)</option>
                                                <option value="NSIC Rc 322H (PHB79)">NSIC Rc 322H (PHB79)</option>
                                                <option value="NSIC Rc 204H (M20/Public Hybrid)">NSIC Rc 204H (M20/Public Hybrid)</option>
                                                <option value="NSIC Rc 222 (inbred)">NSIC Rc 222 (inbred)</option>
                                                <option value="PSB Rc 18 (inbred)">PSB Rc 18 (inbred)</option>
                                                <option value="NSIC Rc 504H (Hatao-Liksi)">NSIC Rc 504H (Hatao-Liksi)</option>  
                                                <option value="SL20H">SL20H</option>                        
                                            </select></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="form-group"><br><br>
                                            <label for="name">Proc. Year</label> &nbsp;&nbsp;&nbsp;
                                            <select id="year" name="year" style="width: 150px; height: 35px;" required>
                                                <option value="">Choose one</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                                <option value="2025">2025</option>
                                                <option value="2026">2026</option>  
                                                <option value="2027">2027</option> 
                                                <option value="2028">2028</option>                                                                              
                                            </select></div>&nbsp;&nbsp;&nbsp;

                                            <div class="form-group">
                                            <label for="name">Delivery Batch</label> &nbsp;&nbsp;&nbsp;
                                            <select id="batch" name="batch" style="width: 150px; height: 35px;" required>
                                                <option value="">Choose one</option>
                                                <option value="First">First</option>
                                                <option value="Second">Second</option>
                                                <option value="Third">Third</option>
                                            </select></div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <div class="form-group">
                                            <label for="name">Lot No.</label>&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="lot" style="width: 150px; height: 35px;" required>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;                                        

                                            <div class="form-group">
                                            <label for="name">No. of Bags</label>&nbsp;&nbsp;&nbsp;
                                            <input type="text" class="form-control" name="bags" style="width: 150px; height: 35px;" required>
                                            </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                            <br><br><br><br><br><br>
                                             <div class="form-group">
                                                <label for="name">Remarks</label>&nbsp;&nbsp;&nbsp;
                                                <textarea class="form-control" id="remarks" name="remarks" rows="4" cols="50" style="width: 200px; height: 75px;" required></textarea>
                                             </div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                             <div class="form-group">
                                                <label for="germination_test_date">Germination Test Date</label>
                                                <input id="germination_test_date" name="germination_test_date" type="date">
                                             </div>   
                                            
                                              <button type="submit" class="btn btn-primary" name="add">Add item</button>
                                              </form>
                                            </div>


</body>




                   <!-- Search and Filter Area -->
                    <div class="col-lg-12 mt-5">

                        <div class="card">
                            <div class="card-body">
                                <br>
                                <h2 class="header-title">Search Your Entry</h2>
                                <div class="col-md-8">
                                    <form action="" method="GET">
                                        <div class="input-group mb-3">
                                            <input type="text" class="" value="<?php if(isset($_GET['search'])) {echo $_GET['search'];} ?>" name="search" placeholder="Search here ......" style="width: 300px; height: 35px;"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <button type="submit" class="btn btn-warning">Filter</button>
                                        </div>  
                                    </form>
                                </div>

                                
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                                <tr class="table-active">
                                                <th scope="col">Date Delivered</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Commodity</th> 
                                                <th scope="col">Variety</th>
                                                <th scope="col">Procurement Year</th>
                                                <th scope="col">Delivery Batch</th>
                                                <th scope="col">Lot Number</th> 
                                                <th scope="col">No. of Bags Delivered</th>
                                                <th scope="col">Total No. of Bags Distributed</th>
                                                <th scope="col">Remaining No. of Bags</th>    
                                                <th scope="col">Germination Test Date</th>       
                                                <th scope="col">Remarks</th> 
                                                <th scope="col">Actions</th>
                                                </tr> 
                                            </thead>
                                            <tbody>
<?php
                    if(isset($_GET['search']))
                    {
                        $connection = mysqli_connect("localhost", "root", "", "seed_inventory");
                        $filtervalue = $_GET['search'];
                        $filterdata = "SELECT * FROM product WHERE CONCAT(date_received,category,commodity,variety,year,batch,lot,bags,grandtotal_bags_distributed,grandtotal_remaining_bags,germination_test_date,remarks) LIKE '%$filtervalue%'";
                        $filterdata_run = mysqli_query($connection, $filterdata);

                        if(mysqli_num_rows($filterdata_run) > 0)
                        {
                            foreach($filterdata_run as $row)
                            {
                                ?>
                                    <tr>
                                          <th><?php echo $row["date_received"] ?></th>
                                          <th><?php echo $row["category"]  ?></th>
                                          <th><?php echo $row["commodity"]  ?></th>  
                                          <th><?php echo $row["variety"] ?></th>
                                          <th><?php echo $row["year"] ?></th>
                                          <th><?php echo $row["batch"] ?></th>  
                                          <th><?php echo $row["lot"]  ?></th>         
                                          <th><?php echo $row["bags"]  ?></th>
                                          <th><?php echo $row["grandtotal_bags_distributed"]  ?></th>          
                                          <th><?php echo $row["grandtotal_remaining_bags"]  ?></th>
                                          <th><?php echo $row["germination_test_date"]  ?></th>
                                          <th><?php echo $row["remarks"]  ?></th>
                                          <th> 
                                               <a style="color:green;" href="edit.php?id=<?php echo $row["product_id"] ?>">Edit</a> 
                                          </th>

                                    </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="4">No Record Found</td>
                                </tr>
                            <?php 
                        }
                    }
                ?>  


                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                            
                    <!-- Search and Filter Area End-->




<br><br><br><br><br>







        </div>
            <div class="main-content-inner">
                <div class="row">
                   
                    <!-- Contextual Classes start -->
                    <div class="col-lg-15 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">DA-RFO7 Seed Inventory System</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                    <thead class="text-uppercase">
                                        <tr class="table-active">
                                        <th scope="col">Date Delivered</th>
                                        <th scope="col">Category</th>
                                        <th scope="col">Commodity</th> 
                                        <th scope="col">Variety</th>
										<th scope="col">Procurement Year</th>
                                        <th scope="col">Delivery Batch</th>
                                        <th scope="col">Lot Number</th> 
                                        <th scope="col">No. of Bags Delivered</th>
                                        <th scope="col">Total No. of Bags Distributed</th>
                                        <th scope="col">Remaining No. of Bags</th>    
                                        <th scope="col">Germination Test Date</th>       
                                        <th scope="col">Remarks</th> 
                                        <th scope="col">Actions</th>
                                                                                                                       
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php 
                    $conn = new mysqli("localhost","root","","seed_inventory");
                    $sql = "SELECT * FROM product";
                    $result = $conn->query($sql);
                            $count=0;                          //id sequence numbering, will start at 1
                    if ($result -> num_rows >  0) {
                        
                        while ($row = $result->fetch_assoc()) 
                        {
                            $count=$count+1;
                        ?>
                        
                        
                        <tr>
                            <th><?php echo $row["date_received"] ?></th>
                            <th><?php echo $row["category"]  ?></th>
                            <th><?php echo $row["commodity"]  ?></th>  
                            <th><?php echo $row["variety"] ?></th>
                            <th><?php echo $row["year"] ?></th>
                            <th><?php echo $row["batch"] ?></th>  
                            <th><?php echo $row["lot"]  ?></th>         
                            <th><?php echo $row["bags"]  ?></th>
                            <th><?php echo $row["grandtotal_bags_distributed"]  ?></th>          
                            <th><?php echo $row["grandtotal_remaining_bags"]  ?></th>
                            <th><?php echo $row["germination_test_date"]  ?></th>
                            <th><?php echo $row["remarks"]  ?></th>
                            <th> 
                                <a style="color:green;" href="edit.php?id=<?php echo $row["product_id"] ?>">Edit</a> 
                                |
                                <a style="color:red;" href="delete.php?id=<?php echo $row["product_id"] ?>">Delete</a>                             
                            </th>
                                



                            </tr>
                    <?php
                        
                        }
                    }

                    ?>

                                            </tbody>
                                        </table>
           
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>


</div>   
                    </div>
                    <!-- Contextual Classes end -->
                   
        <!-- main content area end -->
      
<html>
<head>
	<title>Add Item</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
</head>

</html>
    






    </div>

    <!-- page container area end -->
    <!-- offset area start -->
   
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

    <!-- others plugins -->
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/scripts.js"></script>
</body>

</html>

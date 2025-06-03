<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
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
        <style>
            p {
            font-size: 20px;
            font-family: georgia;
            }
            h4 {
            font-size: 25px;
            font-family: times new roman;
            }
            .table {
            width: 100%;
            margin-bottom: 20px;
        }   
        
        .table-striped tbody > tr:nth-child(odd) > td,
        .table-striped tbody > tr:nth-child(odd) > th {
            background-color: #f9f9f9;
        }
        
        @media print{
            #print {
                display:none;
            }
        }
        @media print {
            #PrintButton {
                display: none;
            }
        }
        
        @page {
            size: auto;   /* auto is the initial value */
            margin: 10;  /* this affects the margin in the printer settings */
            position: center;
        }

        </style>
        <body>

        <img src="da-logo.png" align="left" width="100" height="100">
        &nbsp; &nbsp; &nbsp; Republic of the Philippines <br>
        &nbsp; &nbsp; &nbsp; <b>DEPARTMENT OF AGRICULTURE</b> <br>
        &nbsp; &nbsp; &nbsp; Regional Field Office No. VII <br>
        &nbsp; &nbsp; &nbsp; Maguikay, Mandaue City, Cebu <br>
        &nbsp; &nbsp; &nbsp; Tel. No. (032) 268-5187 Fax No. 268-3063  
        <br>
<center>_____________________________________________________________________________________________________________________________________________________________________________________________________________________________
    <br>
<!-- Contextual Classes start -->
                    <div class="col-lg-15 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="header-title">List of Beneficiaries</h4>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                    <thead class="text-uppercase">
                                        <tr class="table-active">
                                        <th scope="col">No. of Bags</th>
                                        <th scope="col">Commodity</th>
                                        <th scope="col">Category</th> 
                                        <th scope="col">Variety</th>
                                        <th scope="col">Date Distributed</th>
                                        <th scope="col">Number of Bags Distributed</th>
                                        <th scope="col">Province</th> 
                                        <th scope="col">Local Government Unit</th>
                                        <th scope="col">Name of Association</th>     
                                        <th scope="col">Remarks</th> 
                                                                                                                   
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
                <th><?php echo $row["bags"]?></th>    
                <th><?php echo $row["commodity"]?></th>
                <th><?php echo $row["category"]?></th>
                <th><?php echo $row["variety"]?></th>
                <th><?php echo $row["date_distributed1"]?><br><br><?php echo $row["date_distributed2"]?><br><br><?php echo $row["date_distributed3"]?></th>
                <th><?php echo $row["bags_distributed1"]?><br><br><?php echo $row["bags_distributed2"]?><br><br><?php echo $row["bags_distributed3"]?></th>
                <th><?php echo $row["province1"]?><br><br><?php echo $row["province2"]?><br><br><?php echo $row["province3"]?></th>
                <th><?php echo $row["lgu1"]?><br><br><?php echo $row["lgu2"]?><br><br><?php echo $row["lgu3"]?></th>
                <th><?php echo $row["assoc1"]?><br><br><?php echo $row["assoc2"]?><br><br><?php echo $row["assoc3"]?></th>
                <th><?php echo $row["remarks_out1"]?><br><br><?php echo $row["remarks_out2"]?><br><br><?php echo $row["remarks_out3"]?></th>         
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

<br><br>
    
        <footer>
            <p align="right">
            <i> ™ Copyright: Department of Agriculture RFO7 - ICT</a></i>
            </p>
        </footer>
    
</form>
</body>
</html>

<!-- <p align="center"><button onclick="window.print()" class ="btn btn-primary">Print</button></p>
-->

    <center><button id="PrintButton" onclick="PrintPage()">Print</button></center>

        <script type="text/javascript">
            function PrintPage() {
                window.print();
            }
            document.loaded = function(){
                
            }
            window.addEventListener('DOMContentLoaded', (event) => {
                PrintPage()
                setTimeout(function(){ window.close() },750)
            });
        </script>

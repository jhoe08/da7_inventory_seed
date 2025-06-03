<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>

<div class="main-content-inner">
    <?php 
    $title_text = 'Item Records';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  
    <div class="row">
        
        <!-- Contextual Classes start -->
        <div class="col-lg-15 mt-5">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">DA-RFO7 Seed Inventory System</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table id="seeds-records" class="table text-dark text-center ">
                                <thead class="text-uppercase">
                                    <tr class="table-active">
                                        <th>Category</th>
                                        <th>Commodity</th>
                                        <th>Variety</th>
                                        <th>Year</th>
                                        <th>Batch</th>
                                        <th>Lot</th>
                                        <th>Date Received</th>
                                        <th>Bags Received</th>
                                        <th>Germination Test Date</th>
                                        <th>Days <br>(Age in Stock)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    include(dirname(__FILE__) .'/../functions/_database.php'); 
                                    
                                    $sql = "SELECT 
                                                p.*,                                                 
                                                COALESCE(SUM(d.bags_distributed), 0) AS total_distributed,
                                                (p.bags_received - COALESCE(SUM(d.bags_distributed), 0)) AS remaining_bags
                                            FROM da7_product p
                                            LEFT JOIN da7_distribution d ON p.product_id = d.product_id
                                            GROUP BY p.product_id, p.commodity, p.variety, p.bags_received"; // Correct concatenation
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $date_received = new DateTime($row["date_received"]);
                                            $today = new DateTime(); // Gets the current date
                                            $interval = $date_received->diff($today); // Calculates the difference

                                            echo "<tr>
                                                    <td>" . htmlspecialchars($row["category"]) . "</td>
                                                    <td>" . htmlspecialchars($row["commodity"]) . "</td>
                                                    <td>" . htmlspecialchars($row["variety"]) . "</td>
                                                    <td>" . htmlspecialchars($row["year"]) . "</td>
                                                    <td>" . htmlspecialchars($row["batch"]) . "</td>
                                                    <td>" . htmlspecialchars($row["lot"]) . "</td>
                                                    <td>" . htmlspecialchars($row["date_received"]) . "</td>
                                                    <td>" . htmlspecialchars($row["bags_received"]) . 
                                                        " <span class=''><i class='ti-angle-double-down text-green'></i><span> ". htmlspecialchars($row["remaining_bags"]) ."</span></span>" . "</td>
                                                    <td>" . htmlspecialchars($row["germination_test_date"]) . "</td>
                                                    <td>" . htmlspecialchars($interval->days) . " days old</td>
                                                </tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>No records found</td></tr>";
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
<?php include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
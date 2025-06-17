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
                            <table id="seeds-records" class="basicDataTable">
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
                                                (p.bags_received - COALESCE(SUM(d.bags_distributed), 0)) AS remaining_bags,
                                                gt.date_started,
                                                gt.percentage,
                                                gt.results
                                            FROM da7_product p
                                            LEFT JOIN da7_distribution d ON p.product_id = d.product_id
                                            LEFT JOIN da7_germination_tests gt ON p.product_id = gt.product_id
                                            GROUP BY p.product_id, p.commodity, p.variety, p.bags_received, 
                                                    gt.date_started, gt.percentage, gt.results;"; // Correct concatenation
                                    $result = mysqli_query($conn, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            $date_received = new DateTime($row["date_received"]);
                                            $today = new DateTime(); // Gets the current date
                                            $interval = $date_received->diff($today); // Calculates the difference
                                            $age = $interval->days;
                                            
                                            if ($age <= 30) {
                                                $class =  'green';
                                            } elseif ($age <= 45) {
                                                $class =  'orange';
                                            } elseif ($age <= 60) {
                                                $class = 'red';
                                            } else {
                                                $class = 'black'; // Default color
                                            }

                                            $bags_received = $row["bags_received"];
                                            $remaining_bags = $row["remaining_bags"];
                                            $germination_date = $row["germination_test_date"];

                                            $color_class = '';
                                            $icon = 'ti-angle-double-down';

                                            // if ($bags_received >= $remaining_bags) {
                                            //     $icon = 'ti-angle-double-down';
                                            // }
                                                                                        
                                            if ($remaining_bags >= 30) {
                                                $icon = 'ti-stats-up';
                                                $color_class = 'text-green';
                                            } elseif ($remaining_bags >= 20 && $remaining_bags <= 30) {
                                                $icon = 'ti-stats-up';
                                                $color_class = 'text-orange';
                                            } elseif ($remaining_bags >= 1 && $remaining_bags < 20) {
                                                $icon = 'ti-stats-down';
                                                $color_class = 'text-red';
                                            }

                                            $classes = $icon ." ". $color_class;

                                            $setDateHTML = "<i class='ti-calendar'></i>";
                                            $btnClass = "btn-info";
                                            
                                            $setResults = "";

                                            if ($germination_date) {
                                                $setDateHTML = "<i class='ti-alarm-clock'></i>";
                                                $setResults = '<button type="button" class="btn" data-toggle="modal" data-target="#germinationAddModal" title="Add Results" data-product-id="'.$row["product_id"].'" data-date-started="'.$germination_date.'">
                                                        <i class="ti-pencil-alt"></i></button>';
                                                $btnClass = "btn-warning";
                                            }
                                            
                                            echo "<tr data-product-id=".$row["product_id"].">
                                                    <td>" . htmlspecialchars($row["category"]) . "</td>
                                                    <td>" . htmlspecialchars($row["commodity"]) . "</td>
                                                    <td>" . htmlspecialchars($row["variety"]) . "</td>
                                                    <td>" . htmlspecialchars($row["year"]) . "</td>
                                                    <td>" . htmlspecialchars($row["batch"]) . "</td>
                                                    <td>" . htmlspecialchars($row["lot"]) . "</td>
                                                    <td>" . htmlspecialchars($row["date_received"]) . "</td>
                                                    <td>" . 
                                                        "<span class='inventory'><span>" . htmlspecialchars($row["bags_received"]) ."</span>".
                                                            "<i class='$classes'></i>" .
                                                            "<span class=".$color_class."> ". htmlspecialchars($row["remaining_bags"]) ."</span>" . 
                                                        "</span>" . "</td>
                                                    <td><button type='button' class='btn ".$btnClass."' data-toggle='modal' data-target='#".($germination_date ? 'germinationWaitingModal' : 'germinationModal')."' title='".($germination_date ? 'Germinating...' : 'Add Germination Date')."' data-product-id=".$row["product_id"]." data-date-started=".htmlspecialchars($germination_date).">
                                                        ".$setDateHTML."</button>".$setResults."</td>
                                                    <td class='text-${class}'>" . htmlspecialchars($age) . " days old</td>
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

</div>
</div>
<?php 
include_once(dirname(__FILE__) . "/../modals/displayProductGermination.php");
include_once(dirname(__FILE__) . "/../modals/updateProductGermination.php");
include_once(dirname(__FILE__) . "/../modals/addProductGermination.php");

mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
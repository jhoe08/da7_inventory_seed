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
                                            $today = new DateTime();
                                            $age = $date_received->diff($today)->days;

                                            // Determine age-based class
                                            $class = match (true) {
                                                $age <= 30 => 'green',
                                                $age <= 45 => 'orange',
                                                $age <= 60 => 'red',
                                                default => 'black',
                                            };

                                            $bags_received = $row["bags_received"];
                                            $remaining_bags = $row["remaining_bags"];
                                            $germination_date = $row["germination_test_date"];
                                            $percentage = $row["percentage"];

                                            // Determine inventory status
                                            [$icon, $color_class] = match (true) {
                                                $remaining_bags >= 30 => ['ti-stats-up', 'text-green'],
                                                $remaining_bags >= 20 => ['ti-stats-up', 'text-orange'],
                                                $remaining_bags >= 1 => ['ti-stats-down', 'text-red'],
                                                default => ['ti-angle-double-down', ''],
                                            };

                                            $classes = "$icon $color_class";
                                            $setDateHTML = "<i class='ti-calendar'></i>";
                                            $btnClass = "btn-warning";
                                            $testResults = htmlspecialchars($row["results"] ?? "");


                                            // Update button properties if germination date exists
                                            if ($germination_date) {
                                                $setDateHTML = "<i class='ti-alarm-clock'></i>";
                                                $iconClass = !empty($row["percentage"]) ? "ti-eye" : "ti-pencil-alt";

                                                $percent = !empty($row["percentage"]) ? htmlspecialchars($row["percentage"]) : 0;

                                                [$btnView, $label] = match (true) {
                                                    $percent >= 75 => ['btn-success', 'View Results'],
                                                    $percent >= 1 => ['btn-danger', 'Failed Results'],
                                                    default => ['', 'Add Results'],
                                                };

                                                $setResults = "<button type='button' class='btn $btnView' data-toggle='modal' data-target='#germinationAddModal' title='$label' 
                                                                data-product-id='" . htmlspecialchars($row["product_id"]) . "' 
                                                                data-date-started='" . htmlspecialchars($germination_date) . "' 
                                                                data-percentage='" . $percent . "' 
                                                                data-results='$testResults'>
                                                                <i class='$iconClass'></i>
                                                            </button>";

                                                $btnClass = "btn-info";
                                            } else {
                                                $setResults = "";
                                            }

                                            $viewResults = "";
                                            if(!$percentage) {
                                                $viewResults = "<button type='button' class='btn $btnClass' data-toggle='modal' data-target='#" . ($germination_date ? 'germinationWaitingModal' : 'germinationModal') . "' 
                                                            title='" . ($germination_date ? 'Germinating...' : 'Add Germination Date') . "' 
                                                            data-product-id='" . htmlspecialchars($row["product_id"]) . "' 
                                                            data-date-started='" . htmlspecialchars($germination_date) . "'>
                                                            $setDateHTML
                                                        </button>";
                                            }

                                            echo "<tr data-product-id='" . htmlspecialchars($row["product_id"]) . "'>
                                                    <td>" . htmlspecialchars($row["category"]) . "</td>
                                                    <td>" . htmlspecialchars($row["commodity"]) . "</td>
                                                    <td>" . htmlspecialchars($row["variety"]) . "</td>
                                                    <td>" . htmlspecialchars($row["year"]) . "</td>
                                                    <td>" . htmlspecialchars($row["batch"]) . "</td>
                                                    <td>" . htmlspecialchars($row["lot"]) . "</td>
                                                    <td>" . htmlspecialchars($row["date_received"]) . "</td>
                                                    <td>
                                                        <span class='inventory'>
                                                            <span>" . htmlspecialchars($bags_received) . "</span>
                                                            <i class='$classes'></i>
                                                            <span class='$color_class'>" . htmlspecialchars($remaining_bags) . "</span>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        $viewResults
                                                        $setResults
                                                    </td>
                                                    <td class='text-$class'>" . htmlspecialchars($age) . " days old</td>
                                                </tr>";
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

</div>
</div>
<?php 
include_once(dirname(__FILE__) . "/../modals/displayProductGermination.php");
include_once(dirname(__FILE__) . "/../modals/updateProductGermination.php");
include_once(dirname(__FILE__) . "/../modals/addProductGermination.php");

mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
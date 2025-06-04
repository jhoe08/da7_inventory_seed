<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>

<div class="main-content-inner">
    <?php 
    $title_text = 'Dashboard';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  
    <div class="row">
        <div class="col-md-6">
            <h4>Rice</h4>
            <canvas id="totalInventoryChart"></canvas>
        </div>
        <div class="col-md-6"></div>
        

        <?php
            include '../functions/_database.php'; // Include database connection

            $sql = "SELECT
                        d.date_distributed, 
                        d.bags_distributed, 
                        d.remaining_bags, 
                        p.commodity, 
                        p.variety, 
                        p.bags_received
                    FROM da7_distribution d
                    JOIN da7_product p ON d.product_id = p.product_id;";

            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }

            $labels = [];
            $bags_distributed = [];
            $remaining_bags = [];
            $total_bags_distributed = 0;
            $lastRow = null;

            while ($row = mysqli_fetch_assoc($result)) {
                $labels[] = $row['variety'];
                $bags_distributed[] = $row['bags_distributed'];
                $remaining_bags[] = $row['remaining_bags'];

                // Sum up distributed bags
                $total_bags_distributed += $row['bags_distributed'];

                // Store last row
                $lastRow = $row;
            }

            // Ensure the last row exists before accessing its values
            if ($lastRow) {
                $last_remaining_bags = $lastRow['remaining_bags'];
                $bags_received = $lastRow['bags_received']; // Match this with received bags
            }

        ?>
   

         <script>
        // PHP Data Injection
        const totalBagsDistributed = <?php echo json_encode($total_bags_distributed); ?>;
        const totalRemainingBags = <?php echo json_encode(array_pop($remaining_bags)); ?>;

        // Chart Configuration
        const ctx = document.getElementById('totalInventoryChart').getContext('2d');
        const totalInventoryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Bags'],
                datasets: [
                    {
                        label: 'Distributed Bags',
                        data: [totalBagsDistributed],
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderWidth: 1
                    },
                    {
                        label: 'Remaining Bags',
                        data: [totalRemainingBags],
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    x: { stacked: true, min: 0 },
                    y: { stacked: true, min: 0 }
                }
            }
        });
    </script>



    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
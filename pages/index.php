<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>

<div class="main-content-inner">
<?php 
    $title_text = 'Dashboard';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); 
    
    include '../functions/_database.php'; // Include database connection
?>  
    <h3 class="mb-5">Commodities Aged Over 30 to 45 Days</h3>
    <div class="row mb-5">
    <?php 
        $sql = "SELECT * FROM da7_product
                WHERE DATEDIFF(CURDATE(), date_received) BETWEEN 30 AND 45;";
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-3 card border-dark mb-3" style="max-width: 18rem;">
            <div class="card-header">Lot <?php echo $row['lot']; ?> Batch <?php echo $row['batch']; ?></div>
            <div class="card-body">
                <h5 class="card-title">#<?php echo $row['product_id']; ?> Variety <?php echo $row['variety']; ?></h5>
                <p class="card-text">Category: <?php echo $row['category']; ?></p>
            </div>
        </div>   
    <?php } ?>
    </div>

    <h3>Distribution Breakdown by Variety</h3>
    <div id="inventoryGraph"></div>
    
    <?php
        $graphPie30to45Data = [];
        $sql = "SELECT c.commodity, COALESCE(p.total_count, 0) AS total_count
        FROM (
            SELECT DISTINCT commodity FROM da7_product
        ) c
        LEFT JOIN (
            SELECT commodity, COUNT(*) AS total_count
            FROM da7_product
            WHERE DATEDIFF(CURDATE(), date_received) BETWEEN 30 AND 45
            GROUP BY commodity
        ) p ON c.commodity = p.commodity;";


            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            while ($row = mysqli_fetch_assoc($result)) {
                $graphPie30to45Data[] = [
                    "commodity" => $row['commodity'],
                    "total_count" => intval($row['total_count'])
                ];
            }
    ?>
    <?php
        // First Gen
        $sql = "SELECT
                    d.product_id,
                    d.date_distributed, 
                    d.bags_distributed, 
                    d.remaining_bags, 
                    p.commodity, 
                    p.variety, 
                    p.bags_received
                FROM da7_distribution d
                JOIN da7_product p ON d.product_id = p.product_id;";
        // Second Gen - after no result since no distribution of first gen
        $sql = "SELECT 
                    p.product_id,
                    COALESCE(d.date_distributed, NULL) AS date_distributed,
                    COALESCE(d.bags_distributed, 0) AS bags_distributed,
                    COALESCE(d.remaining_bags, 0) AS remaining_bags,
                    p.commodity,
                    p.variety,
                    p.bags_received
                FROM da7_product p
                LEFT JOIN da7_distribution d ON p.product_id = d.product_id;";
        $sql = "SELECT 
                    p.commodity, 
                    p.variety, 
                    p.category,
                    SUM(p.bags_received) AS total_bags_received,
                    SUM(COALESCE(d.bags_distributed, 0)) AS total_bags_distributed
                FROM da7_product p
                LEFT JOIN da7_distribution d ON p.product_id = d.product_id
                GROUP BY p.commodity, p.variety, p.category;";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        $graphsData = [];
        $lastRow = null;

        while ($row = mysqli_fetch_assoc($result)) {
            // $productId = $row['product_id'];
            $productId = $row['variety'];

            if (!isset($graphsData[$productId])) {
                $graphsData[$productId] = [
                    // "total_bags_received" => $row['bags_received'],
                    "total_bags_received" => $row['total_bags_received'],
                    "commodity" => $row['commodity'],
                    "variety" => $row['variety'],
                    "total_bags_distributed" => 0, // Initialize count
                    "total_bags_remaining" => 0,
                ];
            }

            // Accumulate distributed and remaining bags per product
            // $graphsData[$productId]["total_bags_distributed"] += $row['bags_distributed'];
            $graphsData[$productId]["total_bags_distributed"] += $row['total_bags_distributed'];
            $graphsData[$productId]["total_bags_remaining"] = intval($graphsData[$productId]["total_bags_received"] - $graphsData[$productId]["total_bags_distributed"]);
        }


        // Ensure the last row exists before accessing its values
        if ($lastRow) {
            $last_remaining_bags = $lastRow['remaining_bags'];
            $bags_received = $lastRow['bags_received']; // Match this with received bags
        }

        // echo '<pre>';
        // var_dump($graphsData);
        // echo '</pre>';

    ?>
   

    <script>
        // PHP Data Injection
        // Bar 
        const barData = <?php echo json_encode($graphsData); ?>;
        
        const container = document.createElement("div");
        container.className = "row"; // Bootstrap row
        document.getElementById('inventoryGraph').appendChild(container);

        Object.keys(barData).forEach(productId => {
            let colDiv = document.createElement("div");
            colDiv.className = "col-md-4"; // Wrap canvas in col-md-4
            container.appendChild(colDiv);

            let canvas = document.createElement("canvas");
            canvas.id = `chart-${productId}`;
            colDiv.appendChild(canvas);

            const ctx = canvas.getContext('2d');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["Total Bags Received", "Distributed Bags", "Remaining Bags"],
                    datasets: [{
                        label: `Commodity: ${barData[productId].commodity} - Variety: ${barData[productId].variety}`,
                        data: [
                            barData[productId].total_bags_received,
                            barData[productId].total_bags_distributed,
                            barData[productId].total_bags_remaining
                        ],
                        backgroundColor: ['rgba(75, 192, 192, 0.7)', 'rgba(255, 99, 132, 0.7)', 'rgba(54, 162, 235, 0.7)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    },
                    plugins: {
                        tooltip: {
                            enabled: true,
                            callbacks: {
                                // label: function(tooltipItem) {
                                //     return `<b>${tooltipItem.label}</b>: ${tooltipItem.raw}`;
                                // }
                            }

                        }
                    }
                }
            });
        });

        // Pie
        const pieData = <?php echo json_encode($graphPie30to45Data); ?>;
        const labels = pieData.map(row => row.commodity);
        const totalCounts = pieData.map(row => row.total_count);

        console.log(labels)

        new Chart(document.getElementById("commodity30to45PieChart"), {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: "Total Commodities",
                    data: totalCounts,
                    backgroundColor: ['#ff6384', '#36a2eb', '#ffce56', '#4bc0c0', '#9966ff', '#ff9f40'],
                    borderWidth: 0
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: "Commodity Age Distribution",
                        font: {
                            size: 18,
                            weight: "bold"
                        },
                        padding: {
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            }
        });



    </script>

</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
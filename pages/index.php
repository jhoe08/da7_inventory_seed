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
    <div class="row">
        <div class="col-md-8">
            <h3>Distribution Breakdown by Variety</h3>
            <div id="inventoryGraph"></div>
        </div>
        <div class="col-md-4">
            <h3>Breakdown by Category</h3>
            <canvas id="commodity30to45PieChart"></canvas>
        </div>
    </div>
    
    
    <?php
        $graphPie30to45Data = [];
        $sql = "SELECT category, commodity, variety, COUNT(*) AS total_count FROM da7_product GROUP BY category, commodity, variety";

        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $graphPie30to45Data[] = [
                "category" => $row['category'],
                "variety" => $row['variety'],
                "commodity" => $row['commodity'],
                "total_count" => intval($row['total_count'])
            ];
        }
    ?>
    <?php
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
            colDiv.className = "col-md-6"; // Wrap canvas in col-md-4
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
        const labels = pieData.map(row => `${row.category} - ${row.commodity} - ${row.variety}`);
        const totalCounts = pieData.map(row => row.total_count);

        console.log({pieData, labels, totalCounts})
        perCatandVar = document.getElementById("commodity30to45PieChart").getContext('2d')
        new Chart(perCatandVar, {
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
        // const labels = data.map(item => `${item.category} - ${item.commodity} - ${item.variety}`);
        // const values = data.map(item => item.total_count);

        const ctx = document.getElementById('commodity30to45PieChart').getContext('2d');
        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Commodity Distribution',
                    data: totalCounts,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50', '#FF9800'],
                    hoverOffset: 4
                }]
            }
        });

    </script>

</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
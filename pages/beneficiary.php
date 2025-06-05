<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>

<div class="main-content-inner">
<?php 
    $title_text = 'List of Beneficiaries';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); 

    include '../functions/_database.php';
?>  



    <div>
        <table class="basicDataTable">
            <thead>
                <tr>
                    <th>Association Name</th>
                    <th>LGU</th>
                    <th>Province</th>
                    <th>Product ID</th>
                    <th>Commodity</th>
                    <th>Variety</th>
                    <th>Bags Distributed</th>
                    <th>Date Distributed</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT 
                            a.assoc_id, 
                                a.assoc_name, 
                                a.lgu_id, 
                                a.province_id, 
                                d.product_id, 
                                SUM(d.bags_distributed) AS total_bags_distributed, 
                                d.date_distributed,
                                p.commodity, 
                                p.variety 
                            FROM da7_association a 
                            JOIN da7_distribution d 
                                ON a.assoc_id = d.assoc_id 
                            JOIN da7_product p 
                                ON d.product_id = p.product_id 
                            GROUP BY 
                                a.assoc_id, 
                                a.assoc_name, 
                                a.lgu_id, 
                                a.province_id, 
                                d.product_id, 
                                p.commodity, 
                                p.variety;";
                        $result = mysqli_query($conn, $sql);
                        if (!$result) {
                            echo "<tr><td colspan='8'>Query Failed: " . mysqli_error($conn) . "</td></tr>";
                        } else {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";                                
                                echo "<td data-assocId=".$row["assoc_id"].">" . $row['assoc_name'] . "</td>";
                                echo "<td>" . getLGUName($getLGUs, $row['lgu_id']) . "</td>";
                                echo "<td>" . getProvinceName($getProvinces, $row['province_id']) . "</td>";
                                echo "<td>" . $row['product_id'] . "</td>";
                                echo "<td>" . $row['commodity'] . "</td>";
                                echo "<td>" . $row['variety'] . "</td>";
                                echo "<td>" . $row['total_bags_distributed'] . "</td>";
                                echo "<td>" . $row['date_distributed'] . "</td>";
                                echo "</tr>";
                            }
                        }

                ?>
            </tbody>
        </table>
    </div>


<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
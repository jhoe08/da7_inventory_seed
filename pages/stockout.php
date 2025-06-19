<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Stock Out';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  
    <div class="row">
        <div class="container mt-5">
            
            <?php 
                include '../functions/_database.php';  
            ?>

            <h2 class="text-center">Enter Beneficiary Details</h2>
            <form method="POST" action="../functions/updateProductStocks.php">
                <div class="form-group">
                    <label for="product_id" class="form-label">Product:</label>
                    <select class="form-control form-select" name="product_id" required>
                        <option value="">Select Product</option>
                        <?php
                        $sql = "SELECT 
                                    p.product_id, 
                                    p.commodity, 
                                    p.variety, 
                                    p.bags_received, 
                                    COALESCE(SUM(d.bags_distributed), 0) AS total_distributed,
                                    (p.bags_received - COALESCE(SUM(d.bags_distributed), 0)) AS remaining_bags
                                FROM da7_product p
                                LEFT JOIN da7_distribution d ON p.product_id = d.product_id
                                GROUP BY p.product_id, p.commodity, p.variety, p.bags_received;";
                        $result = mysqli_query($conn, $sql);
                        $max_bags = 0;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option data-maxBags=". $row['remaining_bags'] ." value='" . $row['product_id'] . "'>" . htmlspecialchars($row['commodity'] . " - " . $row['variety'] . " - (x".$row['remaining_bags'].")") . "</option>";
                            $max_bags = $row['bags_received'];
                        }
                        ?>
                    </select>

                </div>
                <div class="form-group">
                    <label for="date_distributed">Date Distributed *</label>
                    <input type="date" class="form-control" name="date_distributed" required>
                </div>
                <div class="form-group">
                    <label for="bags_distributed">Number of Bags Distributed *</label>
                    <input type="number" class="form-control" id="bags_distributed" name="bags_distributed" max="<?php echo $max_bags ?>" required>
                    <input type="hidden" id="remaining_bags" name="remaining_bags" required>
                </div>
                
                 <div class="form-group">
                    <label for="association">Beneficiaries (Farmers Association) </label>
                    <select class="form-control form-select" name="assoc_id">
                        <option value="">Select Association</option>
                        <?php
                        $sql = "SELECT assoc_id, assoc_name, province_id, lgu_id FROM da7_association";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['assoc_id'] . "' data-province='".$row['province_id']."' data-lgu='".$row['lgu_id']."'>" . htmlspecialchars($row['assoc_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="lgu">Beneficiaries (LGU) *</label>
                    <select class="form-control form-select" name="lgu_id" required>
                        <option value="">Select LGU</option>
                        <?php
                        $sql = "SELECT lgu_id, lgu_name FROM da7_lgu";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['lgu_id'] . "'>" . htmlspecialchars($row['lgu_name']) . "</option>";
                        }
                        
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="province">Beneficiaries (Province) *</label>
                    <select class="form-control form-select" name="province_id" required>
                        <option value="">Select Province</option>
                        <?php
                        $sql = "SELECT province_id, province_name FROM da7_province";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['province_id'] . "'>" . htmlspecialchars($row['province_name']) . "</option>";
                        }
                        
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="purpose">Purpose *</label>
                    <select class="form-control form-select" name="purpose" required>
                        <option value="">Select Purpose</option>
                        <?php 
                            foreach (DISTRIBUTIONPURPOSES as $purpose) {
                                echo "<option value='" . htmlspecialchars($purpose) . "'>" . htmlspecialchars($purpose) . "</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="remarks">Remarks *</label>
                    <textarea class="form-control" name="remarks" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="save_beneficiary" name="save_beneficiary">Save Beneficiary</button>
            </form>
        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Associations';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  

<?php 
    include '../functions/_database.php';  
    // Fetch existing categories for parent selection
    
    ?>    
    
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="basicDataTable">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Association Name</td>
                        <td>LGU</td>
                        <td>Province</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT assoc_id, assoc_name, lgu_id, province_id FROM da7_association";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                                echo "<td>" . $row['assoc_id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['assoc_name']) . "</td>";
                                echo "<td>" . getLGUName($getLGUs, $row['lgu_id']) . "</td>";
                                echo "<td>" . getProvinceName($getProvinces, $row['province_id']) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>            
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Add Farmers Association</h2>
            <form action="../functions/addAssociation.php" method="POST">
                
                <div class="mb-3">
                    <label for="assoc_name" class="form-label">Association Name:</label>
                    <input type="text" class="form-control" name="assoc_name" required>
                </div>

                <div class="mb-3">
                    <label for="province_id" class="form-label">Province:</label>
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

                <div class="mb-3">
                    <label for="lgu_id" class="form-label">LGU:</label>
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

                <button type="submit" class="btn btn-primary">Add Association</button>
            </form>

        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
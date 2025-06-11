<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Province';
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
                        <td>Province</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT province_id, province_name FROM da7_province";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                                echo "<td>" . $row['province_id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['province_name']) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Add Province</h2>
            <form action="../functions/addProvince.php" method="POST">
                <div class="mb-3">
                    <label for="province_name" class="form-label">Province Name:</label>
                    <input type="text" class="form-control" name="province_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Province</button>
            </form>
        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
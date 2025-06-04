<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Settings';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); 

    include '../functions/_database.php'; // Include database connection
    ?>  
    <div class="row">
        <div class="col-md-4">
            <ul class="list-group">
            <?php

                $sql = "SELECT province_id, province_name FROM da7_province";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li class='list-group-item' value='" . $row['province_id'] . "'>" . htmlspecialchars($row['province_name']) . "</li>";
                }
            ?>
            </ul>
        </div>
        <div class="col-md-8">
            <h2 class="text-center">Add Province</h2>
            <form action="../functions/addProvince.php" method="POST">
                <div class="mb-3">
                    <label for="province_name" class="form-label">Province Name:</label>
                    <input type="text" class="form-control" name="province_name" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Province</button>
            </form>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
            <?php

                $sql = "SELECT l.lgu_id, l.lgu_name, p.province_name 
                        FROM da7_lgu l 
                        INNER JOIN da7_province p ON l.province_id = p.province_id";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li class='list-group-item' value='" . $row['lgu_id'] . "'>";
                    echo htmlspecialchars($row['lgu_name']) . " - " . htmlspecialchars($row['province_name']); // Shows LGU & Province
                    echo "</li>";
                }

            ?>
            </ul>
        </div>
        <div class="col-md-8">
            <h2 class="text-center">Add New LGU</h2>
            <form action="../functions/addLGU.php" method="POST">
                <div class="mb-3">
                    <label for="lgu_name" class="form-label">LGU Name:</label>
                    <input type="text" class="form-control" name="lgu_name" required>
                </div>

                <div class="mb-3">
                    <label for="province_id" class="form-label">Province:</label>
                    <select class="form-control form-select" name="province_id" required>
                        <option value="">Select Province</option>
                        <!-- PHP code to fetch and list provinces dynamically -->
                        <?php
                        
                        $sql = "SELECT province_id, province_name FROM da7_province";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['province_id'] . "'>" . htmlspecialchars($row['province_name']) . "</option>";
                        }
                        ?>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Add LGU</button>
            </form>
        </div>
        <div class="col-md-4">
            <ul class="list-group">
            <?php

               $sql = "SELECT 
                            a.assoc_id, 
                            a.assoc_name, 
                            l.lgu_name, 
                            p.province_name 
                        FROM da7_association a
                        INNER JOIN da7_lgu l ON a.lgu_id = l.lgu_id
                        INNER JOIN da7_province p ON l.province_id = p.province_id";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li class='list-group-item' value='" . $row['assoc_id'] . "'>";
                    echo htmlspecialchars($row['assoc_name']) . " - " . htmlspecialchars($row['lgu_name']) . " (" . htmlspecialchars($row['province_name']) . ")";
                    echo "</li>";
                }
            ?>
            </ul>
        </div>
        <div class="col-md-8">
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
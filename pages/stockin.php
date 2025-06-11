<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Stock In';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); 
    
    include '../functions/_database.php';  
    
    // Fetch categories with parent names
    $categories = [];
    $result = $conn->query("SELECT category_id, category_name FROM da7_categories");
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    
    $varieties = [];
    $result = $conn->query("SELECT variety_id, variety_name FROM da7_varieties");
    while ($row = $result->fetch_assoc()) {
        $varieties[] = $row;
    }

    $commodities = [];
    $result = $conn->query("SELECT commodity_id, commodity_name FROM da7_commodities");
    while ($row = $result->fetch_assoc()) {
        $commodities[] = $row;
    }

    ?>  
    <div class="row">
        <div class="container mt-5">
            <h2 class="text-center">Enter Product Details</h2>
            
            <form method="POST" action="../functions/addProduct.php">
                <div class="form-group">
                    <label for="date_received">Date Delivered</label>
                    <input type="date" class="form-control" name="date_received" required>
                </div>

                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control form-select" name="category" required>
                        <option value="">Choose one</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['category_name']; ?>"><?= $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="commodity">Commodity</label>
                    <select class="form-control form-select" name="commodity" required>
                        <option value="">Choose one</option>
                        <?php foreach ($commodities as $commodity): ?>
                            <option value="<?= $commodity['commodity_name']; ?>"><?= $commodity['commodity_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="variety">Variety</label>
                    <select class="form-control form-select" name="variety" required>
                        <option value="">Choose one</option>
                        <?php foreach ($varieties as $variety): ?>
                            <option value="<?= $variety['variety_name']; ?>"><?= $variety['variety_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php
                    $current_year = date("Y"); // Get the current year dynamically

                    // Generate an array of years from 2022 to 2026 if the current year is 2025
                    $year_list = range($current_year - 3, $current_year + 1);
                ?>

                <div class="form-group">
                    <label for="year">Proc. Year</label>
                    <select class="form-control form-select" name="year" required>
                        <?php
                        foreach ($year_list as $year) {
                            echo "<option value='$year'>$year</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="batch">Delivery Batch</label>
                    <select class="form-control form-select" name="batch" required>
                        <option value="">Choose one</option>
                        <option value="First">First</option>
                        <option value="Second">Second</option>
                        <option value="Third">Third</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="lot">Lot No.</label>
                    <input type="text" class="form-control" name="lot" required>
                </div>

                <div class="form-group">
                    <label for="bags">No. of Bags</label>
                    <input type="number" class="form-control" name="bags" required>
                </div>

                <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <textarea class="form-control" name="remarks" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="germination_test_date">Germination Test Date</label>
                    <input type="date" class="form-control" name="germination_test_date">
                </div>

                <button type="submit" class="btn btn-primary w-100" id="add" name="add">Add Item</button>
            </form>
        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
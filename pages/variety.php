<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Variety';
    $isBreadcrumbsOn = false;
    include_once(dirname(__FILE__) . "/../partials/search.php"); ?>  

<?php 
    include '../functions/_database.php';  
    // Fetch existing categories for parent selection
    $categories = [];
    $result = $conn->query("SELECT category_id, category_name FROM da7_categories");
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }

    ?>    
    
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="basicDataTable">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Variety Name</td>
                        <td>Category</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT variety_id, variety_name, category_id FROM da7_varieties";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                                echo "<td>" . $row['variety_id'] . "</td>";
                                echo "<td>" . htmlspecialchars($row['variety_name']) . "</td>";
                                echo "<td>" . getCategoryName($getCategories, $row['category_id']) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Add New Variety</h2>
            <form method="POST" action="../functions/addVariety.php">
                <div class="form-group">
                    <label for="variety_name">Variety Name:</label>
                    <input type="text" name="variety_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="category_id">Category:</label>
                    <select name="category_id" class="form-control" required>
                        <option value="">Select a Category</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['category_id']; ?>"><?= $category['category_name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="save_beneficiary" name="save_beneficiary">Save new variety</button>
            </form>
        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
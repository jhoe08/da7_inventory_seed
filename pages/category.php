<?php
include_once(dirname(__FILE__) . "/../partials/header.php");
include_once(dirname(__FILE__) . "/../partials/sidebar.php");
?>
<div class="main-content-inner">
    <?php 
    $title_text = 'Category';
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

    // Fetch categories with parent names
    $hierarchical = [];
    $sql = "SELECT category_id, category_name, parent_id, description, created_at FROM da7_categories ORDER BY parent_id ";
    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        $hierarchical[$row['parent_id']][] = $row;
    }

    function displayCategoryOptions($parent_id, $level, $hierarchical) {
        if (!isset($hierarchical[$parent_id])) return ""; // No subcategories

        $options = "";
        foreach ($hierarchical[$parent_id] as $row) {
            $indent = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . "➤ "; // Indentation for hierarchy
            $options .= "<option value='{$row['category_id']}'>{$indent}{$row['category_name']}</option>";
            $options .= displayCategoryOptions($row['category_id'], $level + 1, $hierarchical); // Recursive call
        }
        return $options;
    }

    // Function to display categories hierarchically
    function displayCategories($parent_id, $level, $hierarchical) {
        if (!isset($hierarchical[$parent_id])) return ""; // No subcategories

        $data = "";
        foreach ($hierarchical[$parent_id] as $row) {
            $indent = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;", $level) . "➤ ";
            $data .= "<tr>
                        <td>{$row['category_id']}</td>
                        <td>{$indent}{$row['category_name']}</td>
                        <td>{$row['description']}</td>
                      </tr>";
            $data .= displayCategories($row['category_id'], $level + 1, $hierarchical); // Recursive call
        }
        return $data;
    }

    ?>    
    
    <div class="row mt-5">
        <div class="col-md-6">
            <table class="basicDataTable" data-nosort="true">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Category Name</td>
                        <td>Description</td>
                    </tr>
                </thead>
                <tbody>
                    <?php echo displayCategories(NULL, 0, $hierarchical); ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h2 class="text-center">Add New Category</h2>
            <form method="POST" action="../functions/addCategory.php">
                <div class="form-group">
                    <label for="category_name">Category Name *</label>
                    <input type="text" class="form-control" id="category_name" name="category_name" required>
                </div>
                <div class="form-group">
                    <label for="parent_id">Parent Category:</label>
                    <select name="parent_id" class="form-control form-select">
                        <option value="">None (Root Category)</option>
                        <?php echo displayCategoryOptions(NULL, 0, $hierarchical); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" class="form-control" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-primary w-100" id="save_beneficiary" name="save_beneficiary">Save new category</button>
            </form>
        </div>
    </div>
</div>
<?php 
mysqli_close($conn);
include_once(dirname(__FILE__) . "/../partials/footer.php"); ?>
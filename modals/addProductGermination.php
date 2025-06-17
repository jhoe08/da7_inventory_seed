<!-- Bootstrap Modal -->
<div class="modal fade" id="germinationAddModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Germination Test Result</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <form action="../functions/updateProductGerminationResults.php" method="POST">
            <div class="mb-3">
                <label for="product_id" class="form-label">Product ID</label>
                <input type="number" class="form-control" name="product_id" required>
            </div>

            <div class="mb-3">
                <label for="test_date" class="form-label">Germination Test Date</label>
                <input type="date" class="form-control" name="test_date" required>
            </div>

            <div class="mb-3">
                <label for="percentage" class="form-label">Germination Percentage (%)</label>
                <input type="number" class="form-control" name="percentage" step="0.01" min="0" max="100" required>
            </div>

            <div class="mb-3">
                <label for="test_results" class="form-label">Test Results</label>
                <textarea class="form-control" name="test_results" rows="3" placeholder="Enter test results here..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit Results</button>
        </form>
      </div>
    </div>
  </div>
</div>

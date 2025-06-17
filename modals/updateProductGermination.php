<!-- Bootstrap Modal -->
<div class="modal fade" id="germinationModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add Germination Test Date</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="germinationForm" action="../functions/updateProductGermination.php" method="post">
          <input type="hidden" name="product_id">
          <div class="mb-3">
            <label for="test_date" class="form-label">Germination Test Date</label>
            <input type="date" class="form-control" name="test_date" required>
          </div>
          <button type="submit" class="btn btn-primary">Save</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="form_medicines" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add new products</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="medicines_form" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>Expiry Date</label>
              <input type="date" class="form-control" name="added_expiry_date" id="added_expiry_date" placeholder="Enter Expiry Date" required>
            </div>
            <div class="form-group col-md-6">
              <label>Medicine Name</label>
              <input type="text" class="form-control" name="medicines_name" id="medicines_name" placeholder="Enter Medicine Name" required>
            </div>
          </div>
          <div class="form-group">
            <label>Price</label>
            <input type="text" class="form-control" id="medicines_price" name="medicines_price" placeholder="Enter Price of Medicine" required/>
          </div>
          <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" id="medicines_qty" name="medicines_qty" placeholder="Enter Quantity" required/>
          </div>
          <button type="submit" class="btn btn-success">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
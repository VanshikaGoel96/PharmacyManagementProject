<!-- Modal -->
<div class="modal fade" id="form_doctors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Doctor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="doctors_form" onsubmit="return false">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="doctors_name" id="doctors_name" aria-describedby="NameHelp" placeholder="Enter Doctor Name">
            <small id="doc_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="doctors_address" id="doctors_address" aria-describedby="AddressHelp" placeholder="Enter Doctor Address">
            <small id="doc_add_error" class="form-text text-muted"></small>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="form_doctors" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_doctors_form" onsubmit="return false">
          <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="cid" id="cid" value=""/>
            <input type="text" class="form-control" name="update_doctors_name" id="update_doctors_name" aria-describedby="NameHelp" placeholder="Enter Doctor Name">
            <small id="doctors_name_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="update_doctors_address" id="update_doctors_address" aria-describedby="AddressHelp" placeholder="Enter Doctor Address">
            <small id="doctors_add_error" class="form-text text-muted"></small>
          </div>
          <button type="submit" class="btn btn-primary">Update Doctors</button>
      </form>
      </div>
    </div>
  </div>
</div>
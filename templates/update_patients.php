<!-- Modal -->
<div class="modal fade" id="form_patients" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Patients Entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="update_patients_form" onsubmit="return false">
          <div class="form-group">
            <label>Name</label>
            <input type="hidden" name="bid" id="bid" value=""/>
            <input type="text" class="form-control" name="update_patients" id="update_patients" aria-describedby="NameHelp" placeholder="Enter Patient Name">
            <small id="patients_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Number</label>
            <input type="hidden" name="bid" id="bid" value=""/>
            <input type="text" class="form-control" name="update_patients" id="update_patients" aria-describedby="NumberHelp" placeholder="Enter Patient Contact Number">
            <small id="patients_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
          <label for="patientsGender">Gender</label>
            <select class="form-control" id="update_patients" name="update_patients" >
            <option value="" disabled selected class="dropdown-placeholder">Select Gender</option>
            <option value="male">Male</option>   
            <option value="female">Female</option>
            <option value="others">Other</option>  
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Update Patients</button>
      </form>
      </div>
    </div>
  </div>
</div>
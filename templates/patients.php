<!-- Modal -->
<div class="modal fade" id="form_patients" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add  New Patient</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="patients_form" onsubmit="return false">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="patients_name" id="patients_name" placeholder="Enter Patient Name" >
            <small id="patients_name_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
            <label>Number</label>
            <input type="text" class="form-control" name="patients_contact_number" id="patients_contact_number" placeholder="Enter Patient Contact Number">
            <small id="patients_contact_error" class="form-text text-muted"></small>
          </div>
          <div class="form-group">
          <label for="patientsGender">Gender</label>
            <select class="form-control" id="patients_gender" name="patients_gender" >
            <option value="#" disabled selected hidden class="dropdown-placeholder">Select Gender</option>
            <option value="male">Male</option>   
            <option value="female">Female</option>
            <option value="others">Other</option>  
            </select>
          </div>
          <div class="form-group">
            <label>Problem</label>
            <input type="text" class="form-control" name="patients_problem" id="patients_problem" placeholder="Enter Patient Problem">
            <small id="patients_problem_error" class="form-text text-muted"></small>
          </div>
          <label for="patientsDoctor">Doctor</label>
            <select class="form-control" id="parent_doc" name="parent_doc" >
            </select>
          </div>
          <button type="submit" class="btn btn-primary">Add</button>
        </form>
      </div>
    </div>
  </div>
</div>
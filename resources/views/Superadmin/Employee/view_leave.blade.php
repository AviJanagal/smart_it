<div class="modal" id="employee_leave" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Employee Leave Status</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            <p> Start Date: <p class="leave_startdate"></p> </p>
            <p> End Date:<p class="leave_enddate"></p></p>
            <p> Description:<p class="leave_desc"></p></p>

            <!-- <p>Status</p> -->


            


<input type="hidden" value="" id="employe_id">

            <p>Update Status</p>

            <select id="leave_status">
              <option name="status" id="0" value="0"  disabled  >Pending</option>
              <option name="status" id="1" value="1">Confirmed</option>
              <option name="status" id="2" value="2">Declined</option>
            </select>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
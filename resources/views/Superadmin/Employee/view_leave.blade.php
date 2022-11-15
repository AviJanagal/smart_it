<div class="modal" id="employee_leave" tabindex="-1" role="dialog">
    <div class="modal-dialog moddialogue" role="document">
        <div class="modal-content">
            <div class="modal-header  modheader text-center">
                <h5 class="modal-title w-100  modtitle">Employee Leave Status</h5>
                <button type="button" class="close modalclosecss" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="modalclosespan">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modbody">
                    <p class="empmodbody"> Start Date:
                    <p class="leave_startdate"></p>
                    </p>
                </div>
                <div class="modbody">
                    <p class="empmodbody"> End Date:
                    <p class="leave_enddate"></p>
                    </p>
                </div>
                <div class="modbody">
                    <p class="empmodbody"> Description:
                    <p class="leave_desc"></p>
                    </p>
                </div>
                <div class="modbody">
                    <input type="hidden" value="" id="employe_id">
                    <p class="empmodbody">Update Status:</p>
                    <select id="leave_status" class="leave_status">
                        <option name="status" id="0" value="0" disabled>Pending</option>
                        <option name="status" id="1" value="1">Confirmed</option>
                        <option name="status" id="2" value="2">Declined</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
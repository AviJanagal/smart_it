<div class="modal" id="delete_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="close modalclosecss" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="modalclosespan">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do yo really want to delete these records?This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>

                <a id="delete_user" href=""  class="btn btn-danger customdeletecss">Delete</a> 
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"  ></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://kit.fontawesome.com/9681e38096.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>


<script>


$('#nav-tab a:first').tab('show');
//for bootstrap 3 use 'shown.bs.tab' instead of 'shown' in the next line
$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
//save the latest tab; use cookies if you like 'em better:
localStorage.setItem('selectedTab', $(e.target).attr('id'));
});
//go to the latest tab, if it exists:
var selectedTab = localStorage.getItem('selectedTab');
if (selectedTab) {
  $('#'+selectedTab).tab('show');
}



$("#graph_time").change(function(){
    // this.value;
    var graph = $(this).val();
    $('#emp_graph').submit();
    // $.ajax({
    //     type: "POST",
    //     url: "{{ url('admin/employee_graph') }}",
    //     data: graph,
    //     success: function(data) {

    //         $('#emp_graph').submit();


    //        }
    //    });

    //   $.ajax({
    //   type: "POST",
    //   url: "{{ url('admin/employee_graph') }}",
    //   data: $("#emp_graph").serialize(),
    //   success: function(data) {
    //     $(graph).html(data)
    //   }
    // });
 });



$("#select_employee").select2({
    placeholder: "Select Developer",
    allowClear: true
});



$( document ).ready(function() {
    $('#user_data_table').DataTable({order:[[0,"desc"]]});
});

 

// $( document ).ready(function() {
//     $('#user_data_table_1').DataTable({order:[[1,"desc"]]});
// });



function deletedata(url){
    $('#delete_modal').modal('show');
    $("#delete_user").attr('href', url);
}



function emp_leave_modal(){
    $('#employee_leave').modal('show');
}



jQuery(function ($)
{
    $(".sidebar-dropdown > a").click(function()
    {
        $(".sidebar-submenu").slideUp(200);
        if($(this).parent().hasClass("active"))
        {
            $(".sidebar-dropdown").removeClass("active");
            $(this).parent().removeClass("active");
        }
        else
        {
            $(".sidebar-dropdown").removeClass("active");
            $(this).next(".sidebar-submenu").slideDown(200);
            $(this).parent().addClass("active");
        }
    });
});



$('#percent').on('change', function() {
    var val = parseInt($(this).val());
    var $circle = $('#svg #bar');
    if(isNaN(val)) {
        val = 100;
    } else {
        var r = $circle.attr('r');
        var c = Math.PI * (r * 2);
        if(val < 0) {
            val = 0;
        }
        if(val > 100) {
            val = 100;
        }
        var pct = ((100 - val) / 100) * c;
        $circle.css({
            strokeDashoffset: pct
        });
        $('#cont').attr('data-pct', val);
    }
});



let toggle = document.querySelector('.toggle');
let sidemenubar = document.querySelector('.sidemenubar');
let maintop = document.querySelector('.maintop');
let headertop = document.querySelector('.headertop');
toggle.onclick = function(){
    sidemenubar.classList.toggle('active');
    maintop.classList.toggle('active');
    headertop.classList.toggle('active');
}



$(window).scroll(function () {
    if ($(window).scrollTop() >= 300) {
    $('nav').addClass('fixed-header');
    $('nav div').addClass('visible-title');
    }
    else {
    $('nav').removeClass('fixed-header');
    $('nav div').removeClass('visible-title');
    }
});



$(document).ready(function(){
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});



$("#clientform").validate({
    submitHandler: function(form) {  
        form.submit(); 
        },
    rules: {
        name: 'required',
            email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
            },

    }  
});
    
</script>


<script>

$(document).ready(function($) {
    $('.btn-edit-plan').on('click', function() {
        $.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var id = $(this).attr('data-id');
    // ajax
        $.ajax({
            type: "GET",
            url: "{{ url('admin/view_emp_leave') }}",
            data: { id: id },
            dataType: 'json',
            success: function(data) {

                $('#employee_leave').modal('show');

                var status = data.status;
                
                $('#'+status).attr('selected','selected');

                $('.leave_startdate').html(data.start_date);
                $('#employe_id').val(data.employee_id);
                $('.leave_enddate').html(data.end_date);
                $('.leave_desc').html(data.discription);
            }
        });
    });
})



$(function(){
    $('#leave_status').change(function(){
        var staus_id = $(this).val();
        var employee_id = $("#employe_id").val();

        if(staus_id == 1){
            var status = "Leave is Confirmed"
        }else if(staus_id == 2)
        {
            var status = "Leave is Declined"
        }

        $.ajax({
            url: "{{ url('admin/leave_approvel') }}",
            data: { id: staus_id , employee_id: employee_id},
            dataType:"json",
            type: "post",
            success: function(data){
                swal({
                        title:status,
                        //text: "Leave Status Updated Successfully!",
                        icon: "success",
                        button: "ok!",
                });
            }
        });
    });
});

</script>
<script>

  $(document).ready(function () {
    $("#monthPicker").datepicker({
        format: "MM",
        viewMode: "months",
        minViewMode: "months",
        autoclose: true,
    });
    $("#yearPicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true,
    });
    $("#datePicker").datepicker({
        autoclose: true,
    });

  });


</script>

</body>
</html>


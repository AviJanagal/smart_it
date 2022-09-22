<div class="modal" id="delete_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Do yo really want to delete these records?This process cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                <a id="delete_user" href=""  class="btn btn-danger">Delete</a> 
            </div>
        </div>
    </div>
</div>



<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/9681e38096.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/circle-progress.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>







   
<script>


$("#select_employee").select2({
    placeholder: "Select Developer",
    allowClear: true
});


   
    $("#select_customers").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })

    $("#select_parents").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })
    $("#select_vendors").select2({
        tags: true,
        tokenSeparators: [',', ' ']
    })


    $( document ).ready(function() {
        $("#select_driver_form").hide();
        $("#select_parent_form").hide();
        $("#select_vendor_form").hide();
        $("#notification_check_boxes").hide();
    });


    $('#customCheck2').change(function() {
        if ($(this).is(":checked")) {
            $("#select_driver_form").show();
        }else if(!$(this).is(":checked"))
        {
            $("#select_driver_form").hide();
        }
    });

    $('#customCheck1').change(function() {
        if ($(this).is(":checked")) {
            $("#select_parent_form").show();
            $("#select_vendor_form").show();

        }
        else if(!$(this).is(":checked"))
        {
            $("#select_parent_form").hide();
            $("#select_vendor_form").hide();

        }
       
    });

    $('#select_user_type').change(function(){

        if($(this).val() == '2'){
             
            $("#notification_check_boxes").show();

        }else if($(this).val() == '1'){

            $("#notification_check_boxes").hide();
            $("#select_driver_form").hide();
            $("#select_parent_form").hide();
            $("#select_vendor_form").hide();
        }
    });


    $( document ).ready(function() {
        $('#user_data_table').DataTable({order:[[0,"desc"]]});
    });

    $( document ).ready(function() {
        $('#user_data_table_1').DataTable({order:[[1,"desc"]]});
    });

</script>

<script>
    
    function deletedata(url){
    $('#delete_modal').modal('show');
    $("#delete_user").attr('href', url);
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
</script>



<!-- <script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script> -->





<!-- new script -->

<script>
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
</script>
<script>
    let toggle = document.querySelector('.toggle');
    let sidemenubar = document.querySelector('.sidemenubar');
    let maintop = document.querySelector('.maintop');
    let headertop = document.querySelector('.headertop');

    toggle.onclick = function(){
        sidemenubar.classList.toggle('active');
        maintop.classList.toggle('active');
        headertop.classList.toggle('active');
    }
</script>



<script>
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
</script>

<script>
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
</script>



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
</script>



<script src="https://code.jquery.com/jquery-3.4.1.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
        <script src="{{ asset('js/custom.js') }}"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $.validator.addMethod('datee', function (value, element, param) {
                    return (value != 0) && (value <= 31) && (value == parseInt(value, 10));
                }, 'Please enter a valid date!');
                $.validator.addMethod('month', function (value, element, param) {
                    return (value != 0) && (value <= 12) && (value == parseInt(value, 10));
                }, 'Please enter a valid month!');
                $.validator.addMethod('year', function (value, element, param) {
                    return (value != 0) && (value >= 1900) && (value == parseInt(value, 10));
                }, 'Please enter a valid year not less than 1900!');
                $.validator.addMethod('username', function (value, element, param) {
                    var nameRegex = /^[a-zA-Z0-9]+$/;
                    return value.match(nameRegex);
                }, 'Only a-z, A-Z, 0-9 characters are allowed');

                var val = {
                    // Specify validation rules
                    rules: {
                        first_name: "required",
                        last_name: "required",
                        password: "required",
                        employee_id: "required",
                        department: "required",
                        designation: "required",
                        job_title: "required",
                        employee_type: "required",
                        ctc: "required",
                        bank_name: "required",
                        city: "required",
                        branch_name: "required",
                        ifsc_code: "required",
                        account_number: "required",
                        email: {
                            required: true,
                            email: true
                        },
                        phone_number: {
                            required: true,
                            minlength: 10,
                            maxlength: 10,
                            digits: true
                        },
                        
                    },
                    // Specify validation error messages
                    messages: {
                        first_name: "First name is required",

                        email: {
                            required: "Email is required",
                            email: "Please enter a valid e-mail",
                        },
                        phone_number: {
                            required: "Phone number is requied",
                            minlength: "Please enter 10 digit mobile number",
                            maxlength: "Please enter 10 digit mobile number",
                            digits: "Only numbers are allowed in this field"
                        },
                        password: {
                            required: "Password is required",
                            minlength: "Password should be minimum 8 characters",
                            maxlength: "Password should be maximum 16 characters",
                        }
                    }
                }
                $("#myForm").multiStepForm(
                        {
                            // defaultStep:0,
                            beforeSubmit: function (form, submit) {
                                console.log("called before submiting the form");
                                console.log(form);
                                console.log(submit);
                            },
                            validations: val,
                        }
                ).navigateTo(0);
            });
        </script>



<script>
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



</body>
</html>


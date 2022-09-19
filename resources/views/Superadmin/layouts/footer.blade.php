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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/9681e38096.js" crossorigin="anonymous"></script>
<script src="{{ asset('js/circle-progress.min.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script> -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script> -->

   
<script>


$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
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



<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>





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

<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->
<script>
    //Get the button
    var mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function () { scrollFunction() };

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        mybutton.style.display = "block";
        } else {
        mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
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


<script>

var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "save";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}

</script>






<script>
   $("#regForm").validate({

    rules: {
         first_name: 'required',
         last_name: 'required',
          email: {
            required: true,
            email: true,//add an email rule that will ensure the value entered is valid email id.
            maxlength: 255,
         },
         phone_number: {
            required: true,
            number: true,
            minlength: 10,
            maxlength: 10,

         },
      }

      
    });
</script>









  




















</body>
</html>


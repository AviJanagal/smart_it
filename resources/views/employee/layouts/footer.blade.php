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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
 <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
	function logInTime()
	{
		// alert(id);
		$.ajax
        ({
            url:"{{ route('employee.log_in_time') }}",
            type: "POST",
            data: 
            {
                _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result)
            {
				$(".total_hours").attr("data-pct","Pending");
				$("#cont").attr("data-pct"," ");
				$("#cont").attr("data-pct",result.message);
				$(".content").attr("data-pct"," ");
				$(".content").attr("data-pct","00:00");
				$('#checkIn').off('click');
                Swal.fire('Success!','Check-in !','success')
				$("#nav-tabContent").load(location.href + " #nav-tabContent");
            }
        }); 
	}

	function logOutTime()
	{
		// alert(id);
		$.ajax
        ({
            url:"{{ route('employee.log_out_time') }}",
            type: "POST",
            data: 
            {
                _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result)
            {
				// alert(result.total);
				$(".content").attr("data-pct"," ");
				$(".content").attr("data-pct",result.message);
				$(".total_hours").attr("data-pct",result.total);
				// $('#checkIn').off('click');
                Swal.fire('Success!','Check-out!','success');
				$("#nav-tabContent").load(location.href + " #nav-tabContent");
				
            }
        }); 
	}
</script>

<script>
    $( document ).ready(function() {
		$.ajax
        ({
            url:"{{ route('employee.default_log_in_time') }}",
            type: "GET",
            data: 
            {
                _token: '{{csrf_token()}}' 
            },
            dataType : 'json',
            success: function(result)
            {
				$(".total_hours").attr("data-pct",result.total);
				if(result.logIn !== null){
					$("#cont").attr("data-pct"," ");
					$("#cont").attr("data-pct",result.logIn);
				}
				else{
					
					$("#cont").attr("data-pct","00:00");
				}
				if(result.logOut !== null){
					$(".content").attr("data-pct"," ");
					$(".content").attr("data-pct",result.logOut);
				}
				else{
				
					$(".content").attr("data-pct","00:00");
				}
            }
        }); 
	});
</script>

        
        <script>
            
            $( "#myform" ).validate({
                rules: {
                    first_name: {
                    required: true,
                    },
                    last_name: {
                    required: true,
                    },
                    address: {
                    required: true,
                    },
                    state: {
                    required: true,
                    },
                    district: {
                    required: true,
                    },
                    block: {
                    required: true,
                    },
                    village: {
                    required: true,
                    },
                    person_type: {
                    required: true,
                    },
                    department_type: {
                    required: true,
                    },
                    institute_name: {
                    required: true,
                    },
                    department_name: {
                    required: true,
                    },
                    person_type_selected: {
                    required: true,
                    },
                    person_type_typed: {
                    required: true,
                    },
                    zip_code: {
                    required: true,
                    maxlength: 6,
                    minlength : 6
                    },
                    password : {
                        required: true,
                        minlength : 8
                    },
                    password_confirmation : {
                        required: true,
                        minlength : 8,
                        equalTo : "#password"
                    },
                    email : {
                        email: true,
                        required: true,
                        minlength : 8
                    },
                    email_confirmation : {
                        required: true,
                        minlength : 8,
                        equalTo : "#email"
                    },
                    phone_number: {
                        required: true,
                        number: true,
                        minlength: 10,
                        maxlength: 10
                    }
                }
                });
 </script>
	
	 <!-- Delete modal jQuery-->

        <script>
            function deleteData(url) {
                $("#deleteForm").attr("action", url);
                $("#myModal").modal('show');
            }
        </script>

        <!-- Delete modal jQuery end -->

		<!-- dataTables -->
		
		<script>
			$(document).ready( function () {
				$('#myTable').DataTable();
			} );
		</script>

		<!-- end dataTables -->

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

		 
		  <!-- html Delete modal -->
    <div id="myModal" class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="" id="deleteForm">
                    @csrf {{ method_field('DELETE') }}
                    <div class="modal-body">
                        <p>Are you sure you want to delete ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger" id="del">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End html Delete modal -->
	
</body>

</html>
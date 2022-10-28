(function($) {

    var form = $("#signup-form");
    form.validate({
        errorPlacement: function errorPlacement(error, element) {
            element.before(error);
        },
        rules: {
            first_name: "required",
            last_name: "required",
            password: "required",
            employee_id: "required",
            department: "required",
            designation: "required",
            // image: "required",
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
            last_name: "Last name is required",
            dob: "DOB is required",
            employee_id: "Employee Id is required",
            department: "Department is required",
            designation: "Designation is required",
            // image: "Image is required",
            employee_type: "Employee Type is required",
            date_of_joining: "Date Of Joining is required",
            ctc: "CTC is required",
            bank_name: "Bank name is required",
            city: "City is required",
            branch_name: "Branch name is required",
            ifsc_code: "IFSC Code is required",
            account_number: "Account number is required",

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
            },
            account_number: {
                required: "Account number is requied",
                digits: "Only numbers are allowed in this field"
            },

        },
        onfocusout: function(element) {
            $(element).valid();
        },
    });

    form.steps({
        headerTag: "h3",
        bodyTag: "fieldset",
        transitionEffect: "slideLeft",
        labels: {
            previous: 'Previous',
            next: 'Next',
            finish: 'Submit',
            current: ''
        },
        titleTemplate: '<div class="title"><span class="number">#index#</span>#title#</div>',
        onStepChanging: function(event, currentIndex, newIndex) {
            form.validate().settings.ignore = ":disabled,:hidden";
            console.log("1");            
            return form.valid();
        },
        onFinishing: function(event, currentIndex) {
            form.validate().settings.ignore = ":disabled";
            console.log("2");
            return form.valid();
        },
        onFinished: function(event, currentIndex) {
            console.log("3");
            document.getElementById('signup-form').submit();
        },
        // onInit : function (event, currentIndex) {
        //     event.append('demo');
        // }
    });

    jQuery.extend(jQuery.validator.messages, {
        required: "",
        remote: "",
        url: "",
        date: "",
        dateISO: "",
        number: "",
        digits: "",
        creditcard: "",
        equalTo: ""
    });


    

    // $('#password').pwstrength();

    $('#button').click(function () {
        $("input[type='file']").trigger('click');
    })

 
    
    
    $("input[type='file']").change(function () {
        $('#val').text(this.value.replace(/C:\\fakepath\\/i, ''))
    })


})(jQuery);
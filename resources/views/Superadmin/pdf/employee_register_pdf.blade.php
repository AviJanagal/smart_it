<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bridge Certificate </title>


    <style type="text/css">
		body {
			Margin: 0;
			padding: 0;
			
		}
		table {
			border-spacing: 0;
		}
		td {
			padding: 0;
		}
		img {
			border: 0;
		}
		.wrapper{
			width: 100%;
			table-layout: fixed;
			
			padding-bottom: 40px;
		}
		.webkit{
			max-width: 718px;
			background-color: #ffffff;
		}
		.outer {
    Margin: 0 auto;
    width: 100%;
    max-width: 720px;
    border-spacing: 0;
    font-family: sans-serif;
    color: #4a4a4a;
  }
        .three-columns{
			text-align: center;
			font-size: 0;
			line-height: 0;
			padding-top: 40px;
			padding-bottom: 30px;
		}   
		.three-columns .column{
       width: 100%;
       max-width: 200px;
       display: inline-block;
        vertical-align: top;
		}   
		.padding{
			padding: 15px;
           }
		.three-columns .content{
			font-size: 15px;
			line-height: 20px;
		}

a{
	text-decoration: none;
	color: #388cda;
	font-size: 16px;
}



		@media screen and (max-width: 600px) { 
			.img.third-img-last{
				width: 200px;
				max-width: 200px;
			}
			.padding{
			padding-right: 0;
			padding-left: 0;
           }
		}
		@media screen and (max-width: 400px) { 
			.img.third-img{
				width: 200px;
				max-width: 200px;
			}
		}
	</style>



  </head>
  <body>
    <center class="wrapper">
      <div class="webkit">
        <table class="outer" style="background:url('img/bgimage.jpg')  repeat;background-size: 100%; background-repeat: no-repeat; width: 400px; ">
          <tr>
            <td>
              <table width="100%" style="border-spacing:0;">
                <tr>
                  <td style="text-align: center;padding-top: 18px;">
                    <!-- <img src= "/public/images/smartitlogo.png" style="width: 232px; "> -->
                  </td>
                </tr>
              </table>
              <table width="100%" style="border-spacing:0;">
                <tr>
                  <td style="    text-align: center; padding-top: 23px;">
                    <!-- <img src="img/team2.jpeg" style="width: 164px; border-radius: 50%;  "> -->
                  </td>
                </tr>
              </table>
              <table width="100%" style="border-spacing:0;">
                <tr>
                  <td style="text-align: center;">
                    <h1 style="text-align: center; color: black; font-size: 36px; margin-bottom: 0px!important;margin-top: 6px;">Employee Details</h1>
                    <h2 style="text-align: center; color: black; font-size: 29px;font-weight: 100; margin-top: 4px;"></h2>
                  </td>
                </tr>
              </table>
              <table width="100%" style="border-spacing:0; padding-top: 12px;">
                <tr>
                  <td style="">
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Employee Name</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Email</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Phone Number</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">DOB</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Gender</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Employee ID</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Department</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Designation</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Employee Type</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">Date Of Joining</h4>
                    


                  </td>
                  <td style="text-align: center;">
                  @if(!is_null($profile))
                    <h4 style="text-align: center; color: black; margin-top: 2px;">: {{ucfirst($profile->first_name)}} &nbsp;{{ucfirst($profile->last_name)}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->email}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->phone_number}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->dob}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->gender}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->employee_id}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->department}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->designation}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->employee_type}}</h4>
                    <h4 style="text-align: center; color: black;margin-top: 2px;">: {{$profile->emp_info->date_of_joining}}</h4>
                    @endif
                    <!-- <h4 style="text-align: center; color: black;margin-top: 2px;">
                      <span style="font-size: 19px;">:o</span>+ve
                    </h4> -->
                    <!-- <h4 style="text-align: center; color: black;margin-top: 2px;">:8284904441</h4> -->
                  </td>
                </tr>
              </table>
              <table width="100%" style="border-spacing:0;">
                <tr>
                  <td style="text-align: center;">
                    <p style="text-align: center; color: black;margin-top: 4px; font-size: 13px; margin-bottom: 0px;">www.smartitventures.com</p>
                    <p style="text-align: center; color: black;margin-top: 4px; font-size: 11px;">C-205, Industrial Area, Sector 74, Sahibzada Ajit Singh Nagar, <br> Punjab 140308 </p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </table>
      </div>
    </center>
  </body>
</html>
@include('employee.layouts.header')
@include('employee.layouts.sidebar')

<main class="maintop">
  <div class="mainsectionbox">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
          @if (Session::get('alert'))
          <div class="alert alert-{{ Session::get('alert') }} alert-dismissible" role="alert">
            <p>{{ Session::get('message') }} </p>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          @endif
        </div>
        <div class="col-md-12">
          <div class="tattotsylehed">
            <h4>Select Project</h4>
          </div>
        </div>
        <div class="container-fluid ">
          @if($type == 1)
            <form data-toggle="validator" action="" method="post" enctype="multipart/form-data">
          @else
            <form data-toggle="validator" action="" method="post" enctype="multipart/form-data">
          @endif
          @csrf
          @if($type == 2)
            {{ method_field('PUT') }}
          @endif
            <select class="form-select col-md-4" aria-label="Default select example">
                <option selected>Open this select menu</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>

              <div class="col-md-4">
                @if($type == 1)
                <button type="submit" class="btn btn-danger custom-innerbutton btn-stylessav">Submit</button>
                @else
                <button type="submit" class="btn btn-danger custom-innerbutton btn-stylessav">Update</button>
                @endif
              </div>
            </div>
            </form>
        </div>
      </div>
      <div class="table-title-add">
        <div class="row">
          <div class="col-sm-12">
            <h2 style="text-align:center;">Today's Activity List </h2>
          </div>
        </div>
      </div>
      <div class="customtableinnerbox">

      <div class="main-container-inner">
       
        <div class="table-wrapper p-0">
          <table class=" datatable table table-bordered table-striped table-hover " id="user_data_table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Tattoo Style</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             
              <tr>
                <td>if</td>
                <td>name</td>
              </tr>
            
            </tbody>
          </table>
        </div>
      
        <h1 class="nodatafoundheading" >No data found</h1>
     
      </div>
      </div>
    </div>
</main>






@include('employee.layouts.footer')
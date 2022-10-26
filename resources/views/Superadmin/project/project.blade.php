@include('Superadmin.layouts.header')
@include('Superadmin.layouts.sidebar')
<main class="maintop">
  <div class="mainsectionbox">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-xl-12 col-md-12">
          @if (Session::get('alert'))
          <div class="alert alert-{{ Session::get('alert') }} alert-dismissible" role="alert">
            <p>{{ Session::get('message') }} </p>
            <button type="button" class="close alertclosecss" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          @endif
        </div>
        <div class="col-md-12">
          <div class="tattotsylehed">
            <h4>Enter Project Details</h4>
          </div>
        </div>
        <div class="container-fluid">
          @if($type == 1)
            <form data-toggle="validator" action="{{route('admin.project.store')}}" method="post" enctype="multipart/form-data">
          @else
            <form data-toggle="validator" action="{{route('admin.project.update',$project->id)}}" method="post" enctype="multipart/form-data">
          @endif
          @csrf
          @if($type == 2)
            {{ method_field('PUT') }}
          @endif
            <div class="row">
              <div class="col-md-7">
                <div class="form-group custom-from">
                  <label for="Name" class="inputlabel">Project Name</label>
                  <input class="form-control custom-control @error('name') is-invalid @enderror" value="<?php echo $type == 2 ? $project->project_name : ''; ?>" type="text" id="project_name" name="project_name" placeholder=" Name" required />
                  @error('project_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-md-7">
                <div class="form-group custom-from">
                    <label for="category" class="form-label">Clients</label>
                    <select id="select_client" class="select2 form-select" name="client">
                    <option value="" disabled selected hidden>Select Clients</option>
                        @if($type == 1)
                        @foreach($get_clients as $list)
                        <option value="{{$list->id}}">{{$list->name}}</option>
                        @endforeach
                        @else
                            @foreach($get_clients as $list)
                                @if($list->id == $project->client)
                                <option value="{{$list->id}}" selected>{{$list->name}}</option>
                                @else
                                <option value="{{$list->id}}">{{$list->name}}</option>
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
              </div>
              <div class="col-md-5">
                @if($type == 1)
                <button type="submit" class="btn btn-danger custom-innerbutton projectbtnsetting">Save</button>
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
            <h2 style="text-align:center;">project  List </h2>
          </div>
        </div>
      </div>
      <div class="customtableinnerbox">
      <div class="main-container-inner">
      @if(count($projects) > 0)
        <div class="table-wrapper p-0">
          <table class=" datatable table table-bordered table-striped table-hover " id="user_data_table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Project Name</th>
                <th>Client</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($projects as $item)
              <tr>
                <td>{{$item->id}}</td>
                <td>{{ $item->project_name }}</td>
                <td>{{ $item->client }}</td>
                <td class="btn-td">
                  <a href="{{route('admin.project.edit',$item->id)}}" class="edit"><i class="fa fa-pencil"></i></a>
                  <a class="delete" onclick="deletedata('{{route('admin.project.show',$item->id)}}');"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        @else
        <h1 class="nodatafoundheading" >No data found</h1>
        @endif
      </div>
      </div>
    </div>
</main>
@include('Superadmin.layouts.footer')
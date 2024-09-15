@extends('layouts.adminLayouts.adminLayout')  
  @section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Update Admin Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- /.card-header -->
              @if (Session::has('error_message'))
              <div style="margin-top: 10px" class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('error_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                </div>
              @endif
              @if (Session::has('success_message'))
              <div style="margin-top: 10px" class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ Session::get('success_message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                      </button>
                </div>
              @endif
                @if ($errors->any())
                <div class="alert alert-danger" style="margin-top: 10px">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                </div>
            @endif
              <!-- form start -->
              <form role="form" method="post" action="{{url('admin/update-admin-details')}}" name="updateAdminDetails" id="updateAdminDetails" enctype="multipart/form-data"> @csrf
                <div class="card-body">
                  {{-- <div class="form-group">
                    <label for="exampleInputEmail1">Admin Name</label>
                    <input class="form-control" type="text" id="admin_name" name="admin_name" placeholder="Enter Admin/Sub Admin Name" value="{{ $adminDetails->name}}">
                  </div> --}}
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Email</label>
                    <input class="form-control" readonly="" value="{{Auth::guard('admin')->user()->email}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Admin Type</label> 
                    <input class="form-control" readonly="" value="{{Auth::guard('admin')->user()->type}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Admin Name</label>
                    <input type="text" class="form-control" required id="admin_name" name="admin_name" value="{{Auth::guard('admin')->user()->name}}" placeholder="Enter Admin Name">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Mobile</label>
                    <input type="text" class="form-control" id="admin_mobile" required name="admin_mobile" placeholder="Enter Admin Mobile" value="{{Auth::guard('admin')->user()->mobile}}">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Admin Image</label>
                    <input type="file" class="form-control" id="admin_image" name="admin_image" accept="image/*" >
                    @if (!empty(Auth::guard('admin')->user()->image))
                        <a target="_blank" href="{{url('admin/images/admin_photos/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                        <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                    @endif
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
  
  </div>
  <!-- /.content-wrapper -->
  @endsection
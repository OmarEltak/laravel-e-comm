@extends('layouts.adminLayouts.adminLayout')  
@section('content')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Catalogues</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Sections</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row">
              <div class="col-12">
                <!-- /.card -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Sections</h3>
                    {{-- section added successfully message --}}
                      @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                      @endif
                    <a href="{{url('admin/add-edit-section')}}" class="btn btn-block btn-success" style="max-width: 150px; float:right; display:inline-block;">Add Section</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="sections" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th style="width: 5%;">ID</th>
                        <th style="width: 20%;">Section Name</th>
                        <th style="width: 30%;">Section Image</th>
                        <th style="width: 15%;">Status</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($sections as $section )   
                         <tr>
                            <td>{{ $section->id }}</td>
                            <td>{{ $section->section_name }}</td>
                            <td>
                              @if ($section->section_image)
                                  <img src="{{ asset('admin/images/section_image/' . $section->section_image) }}" alt="{{ $section->section_name }}" style="width: 100px; height: 100px;">
                              @else
                                  No Image
                              @endif
                            </td>
                            <td>
                              @if ($section->status==1)
                                  <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)">Active</a>
                              @else
                              <a class="updateSectionStatus" id="section-{{ $section->id }}" section_id="{{ $section->id }}" href="javascript:void(0)">Inactive</a>
                              @endif
                           </td>
                         </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->

@endsection
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
            <li class="breadcrumb-item active">Categories</li>
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
              <h3 class="card-title">Categories</h3>
              {{-- Category added successfully --}}
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <a href="{{url('admin/add-edit-category')}}" class="btn btn-block btn-success" style="max-width: 150px; float:right; display:inline-block;">Add Category</a>
            </div>                  <!-- /.card-header -->
            <div class="card-body">
              <table id="Categories" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%;">ID</th>
                  <th style="width: 15%;">Category</th>
                  <th style="width: 10%;">Parent Category</th>
                  <th style="width: 10%;">Section</th>
                  <th style="width: 20%;">Image</th>
                  <th style="width: 15%;">URL</th>
                  <th style="width: 10%;">Status</th>
                  <th style="width: 15%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  @if (!isset($category->parentcategory->category_name))
                    <?php $parent_category = "Root"; ?>
                  @else
                    <?php $parent_category = $category->parentcategory->category_name; ?>
                  @endif
                   <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->category_name }}</td>
                      <td>{{ $parent_category }}</td>
                      <td>{{ $category->section->section_name }}</td>
                      <td>
                        @if (!empty($category->category_image) && $category->category_image !== 'default.jpg')
                         <img src="{{ asset('admin/images/category_image/' . $category->category_image) }}" alt="{{ $category->category_name }}" style="width: 100px; height: 100px;">
                        @else
                          <p>No Image</p>
                        @endif
                      </td>
                      <td>{{ $category->url }}</td>
                      <td>
                          @if ($category->status == 1)
                             <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">Active</a>
                          @else
                          <a class="updateCategoryStatus" id="category-{{ $category->id }}" category_id="{{ $category->id }}" href="javascript:void(0)">Inactive</a>
                          @endif
                      </td>
                      <td>
                        <a href="{{ url('admin/add-edit-category/'.$category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ url('admin/delete-category/'.$category->id) }}" method="POST" style="display:inline-block; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                        </form>
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

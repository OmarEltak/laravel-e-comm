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
            <li class="breadcrumb-item active">Products</li>
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
              <h3 class="card-title">Products</h3>
              {{-- product added successfully --}}
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
              <a href="{{url('admin/add-edit-product')}}" class="btn btn-block btn-success" style="max-width: 150px; float:right; display:inline-block;">Add Product</a>
            </div>                  <!-- /.card-header -->
            <div class="card-body">
              <table id="Products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%;">ID</th>
                  <th style="width: 15%;">Product Name</th>
                  <th style="width: 10%;">Product Code</th>
                  <th style="width: 10%;">Product Color</th>
                  <th style="width: 10%;">Category</th>
                  <th style="width: 10%;">Section</th>
                  <th style="width: 20%;">Image</th>
                  <th style="width: 10%;">Status</th>
                  <th style="width: 15%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                   <tr>
                      <td>{{ $product->id }}</td>
                      <td>{{ $product->product_name }}</td>
                      <td>{{ $product->product_code }}</td>
                      <td>{{ $product->product_color }}</td>
                      <td>{{ $product->category->category_name }}</td>
                      <td>{{ $product->section->section_name }}</td>
                      {{-- not working --}}
                      <td>
                        @if (!empty($product->product_image) && $product->product_image !== 'default.jpg')
                          <img src="{{ asset('admin/images/product_image/' . $product->product_image) }}" alt="{{ $product->product_name }}" style="width: 100px; height: 100px;">
                        @else
                          <p>No Image</p>
                        @endif
                      </td>
                      <td>
                          @if ($product->status == 1)
                             <a class="updateProductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">Active</a>
                          @else
                          <a class="updateproductStatus" id="product-{{ $product->id }}" product_id="{{ $product->id }}" href="javascript:void(0)">Inactive</a>
                          @endif
                      </td>
                      <td>
                        <a title="Add/Edit Attributes " href="{{ url('admin/add-attributes/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>

                        <a title="Add Images" href="{{ url('admin/add-images/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle"></i></a>
                        <a title="Edit Product" href="{{ url('admin/add-edit-product/'.$product->id) }}" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                        <form action="{{ url('admin/delete-product/'.$product->id) }}" method="POST" style="display:inline-block; margin-left: 10px;">
                            @csrf
                            @method('DELETE')
                            <button title="Delete Product" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this product?')"><i class="fas fa-trash"></i></button>
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

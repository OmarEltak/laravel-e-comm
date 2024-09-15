@extends('layouts.adminLayouts.adminLayout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ $title }}</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        
 
    <!-- Form for Adding/Editing images -->
    <form method="POST" action="{{ url('admin/add-images/'.$productdata['id'])}}" method="post" id="imageForm" name="imageForm" enctype="multipart/form-data">
        @csrf
        {{-- <input type="hidden" name="product_id" value="{{ $productdata['id']}}"> --}}

        <div class="row">
            <!-- Left Column: Product Details -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_name">Product Name:  </label> &nbsp;{{ old('product_name', $productdata->product_name) }}
                </div>
                <div class="form-group">
                    <label for="product_code">Product Code: </label> &nbsp;{{ old('product_code', $productdata->product_code) }}
                </div>
                <div class="form-group">
                    <label for="product_color">Product Color: </label> &nbsp;{{ old('product_color', $productdata->product_color) }}
                </div>
            </div>

            <!-- Right Column: Product Image -->
            <div class="col-md-6">
                <div class="form-group">
                    @if ($productdata->main_image)
                        <div class="mt-2 text-right">
                            {{-- <label for="main_image">Product Main Image</label> --}}
                            <!-- Add text-right class here -->
                            <img src="{{ asset('images/admin_images/product_images/small/' . $productdata->main_image) }}" alt="Current Product Image" style="width: 120px;">
                        </div>
                    @endif
                    @error('main_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <div class="field_wrapper">
                        <div>
                            <input id="images" multiple="" style="" required type="file" name="images[]" value="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>

              <div class="card">
            <div class="card-header">
              <h3 class="card-title">Added Product Images</h3>
              {{-- product added successfully --}}
              @if (session('success'))
                  <div class="alert alert-success">
                      {{ session('success') }}
                  </div>
              @endif
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="Products" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%;">ID</th>
                  <th style="width: 15%;">Image</th>
                  <th style="width: 15%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($productdata->images as $image)
                     <tr>
                        <td>{{ $image->id }}</td>
                        <td>
                            <img src="{{ asset('images/admin_images/product_images/small/' .$image['image']) }}" style="width: 120px;">
                        </td>
                        <td>
                            <!-- Add actions for each image, like delete, update status, etc. -->
                            <a href="{{ url('admin/delete-image/'.$image->id) }}" class="btn btn-danger btn-sm">Delete</a>
                        </td>
                     </tr>
                    @endforeach
                 </tbody>
                 
              </table>
            </div>
            <!-- /.card-body -->
          </div>
</div>
@endsection

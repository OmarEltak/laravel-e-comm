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

        
 
    <!-- Form for Adding/Editing attributes -->
    <form method="POST" action="{{ url('admin/add-attributes/'.$productdata['id'])}}" method="post" id="attributeForm" name="attributeForm">
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
                            <input id="size" style="width:120px" required type="text" name="size[]" value="" placeholder="Size"/>
                            <input id="sku" style="width:120px" required type="text" name="sku[]" value="" placeholder="SKU"/>
                            <input id="price" style="width:120px" required type="number" name="price[]" value="" placeholder="Price"/>
                            <input id="stock" style="width:120px" required type="number" name="stock[]" value="" placeholder="Stock"/>
                            <a href="javascript:void(0);" class="add_button" title="Add field">Add</a>
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
              <h3 class="card-title">Added Product Attributes</h3>
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
                  <th style="width: 15%;">Size</th>
                  <th style="width: 10%;">SKU</th>
                  <th style="width: 10%;">Price</th>
                  <th style="width: 10%;">Stock</th>
                  <th style="width: 15%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($productdata['attributes'] as $attribute)
                   <tr>
                      <td>{{ $attribute['id'] }}</td>
                      <td>{{ $attribute['size'] }}</td>
                      <td>{{ $attribute['sku'] }}</td>
                      <td>{{ $attribute['price'] }}</td>
                      <td>{{ $attribute['stock'] }}</td>
                      <td></td>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
</div>
@endsection

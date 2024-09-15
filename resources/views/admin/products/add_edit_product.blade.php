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

    <!-- Form for Adding/Editing Product -->
    <form action="{{ $product->id ? route('admin.addEditProduct', $product->id) : route('admin.addEditProduct') }}" method="POST" enctype="multipart/form-data" id="productForm">
        @csrf
        @if($product->id)
            @method('POST')
        @endif

        <div class="row">
            <!-- Category and Product Name -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="category_id">Category <span class="text-danger">*</span></label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">Select</option>
                        @foreach ($categories as $section)
                            <optgroup label="{{$section['section_name']}}">
                            @foreach ($section['categories'] as $category)
                                <option value="{{$category['id']}}" 
                                    @if (old('category_id', $product->category_id) == $category['id']) selected @endif>
                                    &nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['category_name']}}
                                </option>
                                @foreach ($category['subcategories'] as $subcategory)
                                    <option value="{{$subcategory['id']}}" 
                                        @if (old('category_id', $product->category_id) == $subcategory['id']) selected @endif>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;&nbsp;{{$subcategory['category_name']}}
                                    </option>
                                @endforeach
                            @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_name">Product Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" value="{{ old('product_name', $product->product_name) }}">
                    @error('product_name')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Product Code and Product Color -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_code">Product Code <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter product code" value="{{ old('product_code', $product->product_code) }}">
                    @error('product_code')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_color">Product Color <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="product_color" name="product_color" placeholder="Enter product color" value="{{ old('product_color', $product->product_color) }}">
                    @error('product_color')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Product Price and Discount -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_price">Product Price <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="product_price" name="product_price" placeholder="Enter product price" value="{{ old('product_price', $product->product_price) }}">
                    @error('product_price')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="product_discount">Product Discount (%)</label>
                    <input type="text" class="form-control" id="product_discount" name="product_discount" placeholder="Enter product discount" value="{{ old('product_discount', $product->product_discount) }}">
                    @error('product_discount')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Product Weight and Main Image -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="product_weight">Product Weight</label>
                    <input type="text" class="form-control" id="product_weight" name="product_weight" placeholder="Enter product weight" value="{{ old('product_weight', $product->product_weight) }}">
                    @error('product_weight')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="main_image">Product Main Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="main_image" name="main_image">
                            <label class="custom-file-label" for="main_image">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @if ($product->main_image)
                        <div class="mt-2">
                            <img src="{{ asset('images/admin_images/product_images/small/' . $product->main_image) }}" alt="Current Product Image" style="width: 100px;">
                            <a href="{{ route('admin.deleteProductImage', $product->id) }}">Delete Image</a>
                        </div>
                    @endif
                    @error('main_image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Wash Care and Fabric -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="wash_care">Wash Care</label>
                    <input type="text" class="form-control" id="wash_care" name="wash_care" placeholder="Enter wash care instructions" value="{{ old('wash_care', $product->wash_care) }}">
                    @error('wash_care')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="fabric">Fabric</label>
                    <input type="text" class="form-control" id="fabric" name="fabric" placeholder="Enter fabric" value="{{ old('fabric', $product->fabric) }}">
                    @error('fabric')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Pattern and Sleeve -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="pattern">Pattern</label>
                    <input type="text" class="form-control" id="pattern" name="pattern" placeholder="Enter pattern" value="{{ old('pattern', $product->pattern) }}">
                    @error('pattern')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="sleeve">Sleeve</label>
                    <input type="text" class="form-control" id="sleeve" name="sleeve" placeholder="Enter sleeve type" value="{{ old('sleeve', $product->sleeve) }}">
                    @error('sleeve')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Fit and Occasion -->
            <div class="col-md-6">
                <div class="form-group">
                    <label for="fit">Fit</label>
                    <input type="text" class="form-control" id="fit" name="fit" placeholder="Enter fit" value="{{ old('fit', $product->fit) }}">
                    @error('fit')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="occasion">Occasion</label>
                    <input type="text" class="form-control" id="occasion" name="occasion" placeholder="Enter occasion" value="{{ old('occasion', $product->occasion) }}">
                    @error('occasion')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

                       <!-- Featured Checkbox and Status -->
                       <div class="col-md-6">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" value="1" {{ old('is_featured', $product->is_featured) == 'Yes' ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Featured</label>
                            @error('is_featured')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <!-- URL and Meta Title -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="url">URL <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL" value="{{ old('url', $product->url) }}">
                            @error('url')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title" value="{{ old('meta_title', $product->meta_title) }}">
                            @error('meta_title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
        
                    <!-- Meta Description -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="4" placeholder="Enter meta description">{{ old('meta_description', $product->meta_description) }}</textarea>
                            @error('meta_description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <!-- Meta Keywords and Product Video -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}">
                            @error('meta_keywords')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="product_video">Product Video</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="product_video" name="product_video">
                                    <label class="custom-file-label" for="product_video">Choose file</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Upload</span>
                                </div>
                            </div>
                            @if ($product->product_video)
                                <div class="mt-2">
                                    <a href="{{ asset('videos/product_videos/' . $product->product_video) }}" target="_blank">View Current Video</a>
                                </div>
                            @endif
                            @error('product_video')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <div class="row">
                    <!-- Product Description -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">Product Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
        
                <!-- Submit Button -->
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        @endsection        
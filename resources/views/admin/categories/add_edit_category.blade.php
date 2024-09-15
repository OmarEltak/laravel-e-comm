@extends('layouts.adminLayouts.adminLayout')
 
@section('content')
<div class="container mt-4">
    <h1>{{ $title }}</h1>

    <!-- Display success message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form for Adding/Editing Category -->
    <form action="{{ $category->id ? route('admin.addEditCategory', $category->id) : route('admin.addEditCategory') }}" method="POST" enctype="multipart/form-data" id="categoryForm">
        @csrf
        @if($category->id)
        @method('PUT') <!-- Use PUT for updating -->
    @endif
    

        <div class="row">
            <!-- Category Name -->
            <div class="form-group col-md-6">
                <label for="category_name">Category Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="category_name" name="category_name" placeholder="Enter category name" value="{{ old('category_name', $category->category_name ?? '') }}" required>
                @error('category_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Section -->
            <div class="form-group col-md-6">
                <label for="section_id">Section <span class="text-danger">*</span></label>
                <select class="form-control" id="section_id" name="section_id" required>
                    <option value="">Select Section</option>
                    @foreach($getSections as $section)
                        <option value="{{ $section->id }}" {{ old('section_id', $category->section_id) == $section->id ? 'selected' : '' }}>
                            {{ $section->section_name  }}
                        </option>
                    @endforeach
                </select>
                @error('section_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div id="appendCategoriesLevel"class="form-group col-md-6">
                 @include('admin.categories.append_categories_level')
            </div>
            <!-- Category Discount -->
            <div class="form-group col-md-6">
                <label for="category_discount">Category Discount</label>
                <input type="number" class="form-control" id="category_discount" name="category_discount" placeholder="Enter discount percentage" value="{{ old('category_discount', $category->category_discount ?? '') }}">
                @error('category_discount')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Description -->
            <div class="form-group col-md-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter category description">{{ old('description', $category->description ?? '') }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- URL -->
            <div class="form-group col-md-6">
                <label for="url">URL <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="url" name="url" placeholder="Enter URL" value="{{ old('url', $category->url ?? '') }}" required>
                @error('url')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Meta Title -->
            <div class="form-group col-md-6">
                <label for="meta_title">Meta Title</label>
                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Enter meta title" value="{{ old('meta_title', $category->meta_title ?? '') }}">
                @error('meta_title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Meta Description -->
            <div class="form-group col-md-12">
                <label for="meta_description">Meta Description</label>
                <textarea class="form-control" id="meta_description" name="meta_description" rows="4" placeholder="Enter meta description">{{ old('meta_description', $category->meta_description ?? '') }}</textarea>
                @error('meta_description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Meta Keywords -->
            <div class="form-group col-md-6">
                <label for="meta_keywords">Meta Keywords</label>
                <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" placeholder="Enter meta keywords" value="{{ old('meta_keywords', $category->meta_keywords ?? '') }}">
                @error('meta_keywords')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Status -->
            <div class="form-group col-md-6">
                <label for="status">Status <span class="text-danger">*</span></label>
                <select class="form-control" id="status" name="status" required>
                    <option value="1" {{ old('status', $category->status) == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ old('status', $category->status) == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
           <!-- Category Image -->
<div class="form-group col-md-12">
    <label for="category_image">Category Image</label>
    <input type="file" class="form-control" id="category_image" name="category_image">
    
    @if($category->category_image)
        <div class="mt-2">
            <img src="{{ asset('admin/images/category_image/' . $category->category_image) }}" alt="Category Image" width="100">
            <form action="{{ route('admin.deleteCategoryImage', $category->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
            </form>
            
        </div>
    @endif
    
    @error('category_image')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>

        </div>
        <td>
             
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">{{ $title }}</button>
    </form>
</div>

<!-- Optional: Add JavaScript to improve UX -->
@section('scripts')
<script>
    document.getElementById('categoryForm').addEventListener('submit', function() {
        // Show a loading spinner or disable the submit button to prevent multiple submissions
        document.querySelector('button[type="submit"]').innerHTML = 'Submitting... <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>';
        document.querySelector('button[type="submit"]').disabled = true;
    });
</script>
@endsection
@endsection

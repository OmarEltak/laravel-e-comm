@extends('layouts.adminLayouts.adminLayout')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                 </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Section</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form name="sectionForm" id="SectionForm" action="{{ url('admin/add-edit-section') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card card-default">
                    <div class="card-header">
                        <h3 class="card-title">{{ $title }}</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="section_name">Section Name</label>
                                    <input type="text" class="form-control @error('section_name') is-invalid @enderror" name="section_name" id="section_name" placeholder="Enter Section Name" value="{{ old('section_name', $section->section_name) }}">
                                    @error('section_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                              
                            </div>
                            <div class="col-md-6">
                                    {{-- @error('section_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror --}}
                                 <div class="form-group">
                                     <label for="status">Status</label>
                                     <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="1" {{ (old('status', $section->status) == 1) ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ (old('status', $section->status) == 0) ? 'selected' : '' }}>Inactive</option>
                                     </select>
                                       @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                       @enderror
                                 </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Section Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" id="section_image" name="section_image" class="custom-file-input @error('section_image') is-invalid @enderror">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('section_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection

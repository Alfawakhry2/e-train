@extends('admin.layout')


@section('content')
    <div class="container py-4 fs-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Add New Course</h2>
            </div>

            <div class="card-body">
                <form action="{{ route('StoreCourse') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Course Title -->
                    <div class="mb-4">
                        <label for="title" class="form-label">Course Title</label>
                        <input name="title" type="text" class="form-control fs-3" id="title"
                            placeholder="Enter course title" value="{{ old('title') }}" required>
                    </div>
                    @error('title')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Course Code -->
                    <div class="mb-4">
                        <label for="code" class="form-label">Course Code</label>
                        <input name="code" type="text" class="form-control fs-3" id="code"
                            placeholder="e.g. WEB-101" value="{{ old('code') }}">
                    </div>
                    @error('code')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Category Selection -->
                    <div class="mb-4">
                        <label for="category" class="form-label">Category</label>
                        <select class="form-select fs-3" id="category" name="category_id" required>
                            <option value="" selected disabled>Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('category_id')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Trainer Selection -->
                    <div class="mb-4">
                        <label for="trainer" class="form-label">Trainer</label>
                        <select name="trainer_id" class="form-select fs-3" id="trainer" required>
                            <option value="" selected disabled>Select a trainer</option>
                            @foreach ($trainers as $trainer)
                                <option value="{{ $trainer->id }}">{{ $trainer->user->name }} => {{ $trainer->spec }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    @error('trainer_id')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="form-label">Price ($)</label>
                        <input name="price" type="number" class="form-control fs-3" id="price" placeholder="0.00"
                            step="0.01" value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Duration -->
                    <div class="mb-4">
                        <label for="duration" class="form-label">Duration (days)</label>
                        <input name="duration" type="number" class="form-control fs-3" id="duration" placeholder="30"
                            value="{{ old('duration') }}">
                    </div>
                    @error('duration')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Dates -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input name="start_date" type="date" class="form-control fs-3" id="start_date"
                                value="{{ old('start_date') }}">
                        </div>
                        {{-- <div class="col-md-6">
              <label for="end_date" class="form-label">End Date</label>
              <input name="end_date" type="date" class="form-control fs-3" id="end_date">
            </div> --}}
                    </div>
                    @error('start_date')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Descriptions -->
                    <div class="mb-4">
                        <label for="short_desc" class="form-label">Short Description</label>
                        <textarea name="small_desc" class="form-control fs-3" id="short_desc" rows="2" placeholder="Brief description">{{ old('small_desc') }}</textarea>
                    </div>
                    @error('small_desc')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <div class="mb-4">
                        <label for="full_desc" class="form-label">Full Description</label>
                        <textarea name="desc" class="form-control fs-3" id="full_desc" rows="4" placeholder="Detailed description">{{ old('desc') }}</textarea>
                    </div>
                    @error('desc')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Image Upload -->
                    <div class="mb-4">
                        <label for="image" class="form-label">Course Image</label>
                        <input name="image" class="form-control fs-3" type="file" id="image" accept="image/*">
                        <div class="form-text">Recommended Types: png , jpg and jpeg</div>
                    </div>
                    @error('image')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Submit Button -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fs-3">
                            <i class="bi bi-save me-2"></i> Save Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Optional Custom CSS -->
    <style>
        .card {
            border-radius: 0.5rem;
        }

        .form-control,
        .form-select {
            padding: 0.5rem 1rem;
        }

        textarea {
            resize: vertical;
        }
    </style>
@endsection

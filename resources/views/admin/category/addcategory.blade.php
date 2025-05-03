@extends('admin.layout')


@section('content')


<div class="container py-5 fs-3">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @include('success')
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0"><i class="bi bi-bookmark-plus me-2"></i>Add New Course Category</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('StoreCategory') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Title Field -->
                        <div class="mb-3">
                            <label for="title" class="form-label">Category Title</label>
                            <input type="text" class="form-control form-control-lg  fs-3" id="title" name="title" required>
                        </div>
                        @error('title')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                        <!-- Small Description -->
                        <div class="mb-3">
                            <label for="small_desc" class="form-label">Short Description</label>
                            <textarea class="form-control  fs-3" id="small_desc" name="small_desc" rows="2" maxlength="160" required></textarea>
                        </div>
                        @error('small_desc')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                        <!-- Full Description -->
                        <div class="mb-3">
                            <label for="desc" class="form-label">Full Description</label>
                            <textarea class="form-control  fs-3" id="desc" name="desc" rows="5"></textarea>
                        </div>
                        @error('desc')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label">Category Image</label>
                            <input class="form-control fs-3" type="file" id="image" name="image" accept="image/*">
                        </div>
                        @error('image')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end fs-3">
                            <button type="reset" class="btn btn-outline-secondary me-md-2 fs-3">
                                <i class="bi bi-x-circle me-1 fs-3"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary fs-3">
                                <i class="bi bi-save me-1 fs-3"></i> Save Category
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

@extends('front.layout')


@section('content')
<div class="mt-5"></div>
<div class="container fs-3 mt-5">
    <div class="card  rounded-4 overflow-hidden">

        <!-- Card Header with Title and Actions -->
        <div class="card-title text-white">
            <div class="d-flex justify-content-center align-items-center m-5  p-0">
                <h2 class="mb-0 fw-bold text-light text-dark">
                    <i class="bi bi-tag-fill me-3 text-dark"></i>{{ $category->title }}
                </h2>

            </div>
        </div>

        <!-- Card Body with Details -->
        <div class="card-body p-5">
            @include('success')
            <!-- Image Section -->
            <div class="text-center mb-5">
                @if($category->image)
                <img src="{{ asset('storage/'.$category->image) }}"
                     class="img-fluid rounded-3 border shadow"
                     style="max-height: 300px; width: auto;"
                     alt="{{ $category->title }}">
                @else
                <div class="py-5 bg-light rounded-3 text-muted d-flex align-items-center justify-content-center">
                    <i class="bi bi-image me-3 fs-1"></i>
                    <span class="fs-3">No image available</span>
                </div>
                @endif
            </div>

            <!-- Basic Information Section -->
            <div class="mb-5">
                <h3 class="text-uppercase text-muted mb-4 fw-bold fs-4">Basic Information</h3>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label fw-bold d-block mb-3">Category Name</label>
                        <div class="p-3 bg-light rounded-3 border-bottom border-3 border-primary">
                            {{ $category->title }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Descriptions Section -->
            <div class="row mb-5">
                <div class="col-md-6 mb-4">
                    <h3 class="text-uppercase text-muted mb-4 fw-bold fs-4">Short Description</h3>
                    <div class="p-4 bg-light rounded-3 border-start border-3 border-primary">
                        {{ $category->small_desc ?? 'No short description provided' }}
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <h3 class="text-uppercase text-muted mb-4 fw-bold fs-4">Full Description</h3>
                    <div class="p-4 bg-light rounded-3 border-start border-3 border-primary">
                        {{ $category->desc ?? 'No detailed description available' }}
                    </div>
                </div>
            </div>

            <!-- Related Courses Section -->
            <div class="mb-4">
                <h3 class="text-uppercase text-muted mb-4 fw-bold fs-4">Related Courses</h3>
                @if($category->course->count() > 0)
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="bg-primary text-white">
                            <tr>
                             <th class="py-3 fs-4"><i class="bi bi-book me-2"></i>Course Title</th>
                                <th class="py-3 fs-4"><i class="bi bi-person me-2"></i>Trainer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category->course as $course)
                            <tr class="border-bottom border-light">
                                <td class="py-3">
                                    <a href="{{ url("front/show/course/$course->id") }}"><h5 class="mb-0 fw-bold">{{ $course->title }}</h5></a>
                                </td>
                                <td class="py-3">
                                    <div class="d-flex align-items-center">
                                        @if($course->trainer->user->image)
                                        {{-- <img src="{{ asset('storage/'.$course->trainer->image) }}"
                                             class="rounded-circle me-3"
                                             width="50"
                                             height="50"
                                             alt="{{ $course->trainer->user->name }}"> --}}
                                        @endif
                                        <div>
                                            <h6 class="mb-0">{{ $course->trainer->user->name }}</h6>
                                            <small class="text-muted">{{ $course->trainer->spec ?? 'No specialization' }}</small>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="alert alert-info p-4 fs-4">
                    <i class="bi bi-info-circle-fill me-3"></i> No courses found in this category
                </div>
                @endif
            </div>
        </div>

        <!-- Card Footer with Delete Action -->
        <div class="card-footer bg-light py-4">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted fs-4">
                    <i class="bi bi-clock-history me-2"></i>
                    Last updated: {{ $category->updated_at->format('M d, Y H:i') }}
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

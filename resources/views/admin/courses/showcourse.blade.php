@extends('admin.layout')



@section('content')
    <div class="container py-5 fs-3">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0 shadow-lg">
                    <div class="row g-0">

                        <!-- Course Image -->
                        <div class="col-md-5">
                            <div class="h-100 d-flex align-items-center justify-content-center bg-light">
                                <img src="{{ asset("Storage/$course->image") }}" class="img-fluid rounded-start"
                                    alt="Course Image" style="object-fit:cover;">
                            </div>
                        </div>

                        <!-- Course Details -->
                        <div class="col-md-7">
                            <a href="{{ url("admin/allcourses") }}" class="btn btn-outline-primary m-2"><- Back</a>
                            <div class="card-body p-4 p-lg-5">
                                @include('success')
                                <!-- Course Title -->
                                <h3 class="card-title fw-bold mb-4 text-center bg-secondary text-white">{{ $course->title }}</h3>
                                <!-- Trainer -->
                                <div class="d-flex align-items-center mb-4">
                                    <div class="me-3">
                                        <img src="{{ asset('front/img/author/author_1.png') }}" class="rounded-circle"
                                            width="50" height="50" alt="Trainer">
                                    </div>
                                    <div>
                                        <h3 class="fs-5 text-muted mb-0">Taught by</h3>
                                        <h2 class="fs-4 mb-0">{{ $course->trainer->user->name }}</h2>
                                    </div>
                                </div>

                                <!-- Price -->
                                <div class="mb-4">
                                    <span class="badge bg-success fs-4 px-3 py-2">
                                        Course Price : $ {{ $course->price }}
                                    </span>
                                </div>

                                <h5 class="badge bg-secondary fs-4 px-3 py-2">
                                    Course Code : {{ $course->code }}
                                </h5>

                                <!-- Small Description -->
                                <div class="mb-4">
                                    <h3 class="fs-5 text-muted">Duration ({{ $course->duration }}) Day</h3>
                                    <p class="lead">{{ $course->start_date }}</p>
                                    <p class="lead">{{ $course->end_date }}</p>
                                </div>

                                <!-- Small Description -->
                                <div class="mb-4">
                                    <h3 class="fs-5 text-muted">Short Description</h3>
                                    <p class="lead">{{ $course->small_desc }}</p>
                                </div>

                                <!-- Full Description -->
                                <div class="mb-4">
                                    <h3 class="fs-5 text-muted">Course Details</h3>
                                    <p>{{ $course->desc }}</p>
                                </div>

                                <!-- Action Buttons -->
                                <div class="d-flex gap-3 mt-5">
                                    <a href="{{ url("admin/edit/course/$course->id") }}"
                                        class="btn btn-outline-secondary btn-lg px-4 py-2">
                                        Edit
                                    </a>
                                    <form action="{{ route('DeleteCourse' , $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this Course ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-lg px-4 py-2">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Optional Custom CSS -->
    <style>
        .card {
            border-radius: 1rem;
            overflow: hidden;
        }

        .btn-lg {
            font-size: 1.1rem;
        }
    </style>
@endsection

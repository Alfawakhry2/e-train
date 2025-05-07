@extends('front.layout')


@section('content')
<br><br><br>

<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-5">
        <div class="col-md-8">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-book-open me-2"></i>My Enrolled Courses
            </h1>
            <p class="text-muted">View and manage all your current courses</p>
        </div>
        {{-- <div class="col-md-4 text-md-end">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search courses...">
                <button class="btn btn-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div> --}}
    </div>

    <!-- Courses Grid -->
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <!-- Course 1 -->
        @foreach ($courses as $course )
        <div class="col-4">
            <div class="card course-card h-100">
                <div class="position-relative">
                    <img src="{{ asset("storage/$course->image") }}" class="card-img-top course-img" alt="Course Image" style="height: 220px; object-fit:content;">
                    <span class="badge bg-success status-badge">{{ $course->pivot->course_status }}</span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <span class="badge bg-primary">{{ $course->code }}</span>
                        <small class="text-muted">Started: {{ $course->start_date}}</small>
                    </div>
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text text-muted">{{ $course->small_desc }}</p>

                    <div class="mb-3">
                        <small class="d-block text-muted mb-1">Completion</small>
                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                        <small class="text-muted">65% complete</small>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-chalkboard-teacher text-primary me-1"></i>
                            <small>{{ $course->trainer->user->name}}</small>
                        </div>
                        <a href="#" class="btn btn-sm btn-outline-primary">Continue</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    <!-- Empty State (uncomment if needed) -->
    <!--
    <div class="text-center py-5 my-5" id="empty-state" style="display: none;">
        <i class="fas fa-book-open fa-3x text-muted mb-3"></i>
        <h4>No Enrolled Courses</h4>
        <p class="text-muted">You haven't enrolled in any courses yet</p>
        <a href="#" class="btn btn-primary">Browse Courses</a>
    </div>
    -->
</div>
@endsection

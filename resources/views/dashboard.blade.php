@extends('front.layout')

@section('content')

    <div class="container py-5 mt-5">
        <!-- Profile Header -->
        <div class="profile-header p-4 mb-4 text-center">
            <div class="d-flex flex-column align-items-center">
                @empty(!$user->image)
                    <img src="{{ asset('storage/public/Students/' . $user->image) }}" alt="Profile"
                        style="height: 100% ; width:200px" class="profile-img rounded-circle mb-3">
                @endempty
                <h2 class="mb-1">{{ $user->name }}</h2>
                <p class="mb-2"><i class="fas fa-graduation-cap me-2"></i>{{ ucfirst($user->role) }}</p>
                <p class="mb-3"><i class="fas fa-university me-2"></i><b>{{ $user->student->status ?? 'N/A' }}<b></p>
                @if(empty($user->student))
                <div class="d-grid mt-4">
                    <button class="btn btn-outline-primary btn-sm rounded-pill py-2">
                        <i class="fas fa-book-open me-2"></i> Continue Your 
                    </button>
                </div>
                @endif
                <div class="d-flex justify-content-center">
                    <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-github"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-4">
                <!-- About Card -->
                <div class="card stats-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user me-2"></i>About</h5>
                        <p class="card-text">Passionate computer science student with focus on web development and machine
                            learning. Currently in my final year with a 3.8 GPA.</p>
                        <hr>
                        <div class="mb-3">
                            <h6><i class="fas fa-map-marker-alt me-2"></i>Location</h6>
                            <p class="text-muted">{{ $user->address }}</p>
                        </div>
                        <div class="mb-3">
                            <h6><i class="fas fa-calendar-alt me-2"></i>Joined</h6>
                            <p class="text-muted">{{ $user->created_at->format('Y m d') }}</p>
                        </div>
                        <div class="mb-3">
                            <h6><i class="fas fa-id-card me-2"></i>Student ID</h6>
                            <p class="text-muted">{{ $user->student->id ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Skills Card -->
                <div class="card stats-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-code me-2"></i>Technical Skills</h5>
                        <div class="mb-3">
                            <h6>HTML/CSS</h6>
                            <div class="progress">
                                <div class="progress-bar bg-success" style="width: 90%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>JavaScript</h6>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: 85%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>Python</h6>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 80%"></div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h6>PHP/Laravel</h6>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 75%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                {{--
                <!-- Achievements -->
                <div class="card stats-card mb-4">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-trophy me-2"></i>Achievements</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-award text-warning me-3"></i>
                                Dean's List 2022-2023
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-medal text-secondary me-3"></i>
                                Hackathon Winner 2023
                            </li>
                            <li class="list-group-item d-flex align-items-center">
                                <i class="fas fa-certificate text-primary me-3"></i>
                                Google Developer Certification
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>

            <!-- Right Column -->
            <div class="col-lg-8">
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-6 mb-3">
                        <div class="card stats-card h-100">
                            <div class="card-body text-center">
                                <h5><i class="fas fa-book me-2"></i>Courses Taken</h5>
                                @if (empty($user->student))
                                    <h3 class="text-dark">No Courses Joined</h3>
                                @else
                                    <h2 class="display-4 text-primary">{{ count($user->student->course) }}</h2>
                                @endif

                                {{-- <p class="text-muted">Current GPA: 3.8/4.0</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card stats-card h-100">
                            <div class="card-body text-center">
                                <h5><i class="fas fa-project-diagram me-2"></i>Projects</h5>
                                <h2 class="display-4 text-success">-</h2>
                                {{-- <p class="text-muted">-</p> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Courses -->
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="card-title mb-0"><i class="fas fa-graduation-cap me-2"></i>Current Courses</h5>
                            {{-- <a href="#" class="btn btn-sm btn-outline-primary">View All</a> --}}
                        </div>
                        @if ($user->student)
                            <div class="row">
                                <!-- Course 1 -->
                                @foreach ($user->student->course as $course)
                                    <div class="col-md-6 mb-4">
                                        <div class="card course-card h-100 border-0 shadow-sm">
                                            <div class="card-body p-4">
                                                <!-- Course Title -->
                                                <h5 class="card-title fw-bold mb-3 text-dark">{{ $course->title }}</h5>

                                                <!-- Course Code Badge -->
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <span class="badge bg-primary text-white rounded-pill px-3 py-2">
                                                        <i class="fas fa-code me-2"></i> {{ $course->code }}
                                                    </span>
                                                    <span class="badge bg-light text-dark border rounded-pill px-3 py-2">
                                                        <i class="fas fa-clock me-2"></i> {{ $course->duration }} Days
                                                    </span>
                                                </div>

                                                <!-- Course Description -->
                                                <p class="card-text text-muted mb-4">
                                                    <i class="fas fa-align-left me-2 text-primary"></i>
                                                    {{ $course->small_desc }}
                                                </p>

                                                <!-- Course Meta Info -->
                                                <div class="course-meta mb-3">
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-calendar-check me-3 text-secondary"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Status</small>
                                                            <span
                                                                class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-1">
                                                                In Progress
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="fas fa-map-marker-alt me-3 text-secondary"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Location</small>
                                                            <span
                                                                class="text-dark fw-medium">{{ $course->pivot->course_location }}</span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex align-items-center">
                                                        <i class="fas fa-calendar-day me-3 text-secondary"></i>
                                                        <div>
                                                            <small class="text-muted d-block">Enrolled On</small>
                                                            <span
                                                                class="text-dark fw-medium">{{ $course->pivot->created_at->format('Y-m-d ,D') }}</span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Progress Bar -->
                                                <div class="progress-container mt-4">
                                                    <div class="d-flex justify-content-between mb-2">
                                                        <small class="text-muted">Completion</small>
                                                        <small
                                                            class="text-primary fw-bold">{{ $course->pivot->course_status }}</small>
                                                    </div>
                                                    @if ($course->pivot->course_status == 'completed')
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 100%" aria-valuenow="100" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    @elseif($course->pivot->course_status == 'in_progress')
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    @else
                                                        <div class="progress" style="height: 8px;">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 0%" aria-valuenow="0" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    @endif
                                                </div>

                                                <!-- Action Button -->
                                                <div class="d-grid mt-4">
                                                    <button class="btn btn-outline-primary btn-sm rounded-pill py-2">
                                                        <i class="fas fa-book-open me-2"></i> Continue Course
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <h5 class="card-title fw-bold mb-3 text-dark">No Courses Joined</h5>
                        @endif
                    </div>
                </div>

                <!-- Recent Activity -->
                {{-- <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-history me-2"></i>Recent Activity</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex">
                                <div class="me-3 text-primary">
                                    <i class="fas fa-check-circle fa-2x"></i>
                                </div>
                                <div>
                                    <h6>Completed assignment</h6>
                                    <p class="mb-0 text-muted">Web Development Project - Laravel E-commerce</p>
                                    <small class="text-muted">2 hours ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex">
                                <div class="me-3 text-success">
                                    <i class="fas fa-book fa-2x"></i>
                                </div>
                                <div>
                                    <h6>Enrolled in new course</h6>
                                    <p class="mb-0 text-muted">Advanced Database Systems</p>
                                    <small class="text-muted">1 day ago</small>
                                </div>
                            </li>
                            <li class="list-group-item d-flex">
                                <div class="me-3 text-info">
                                    <i class="fas fa-comment fa-2x"></i>
                                </div>
                                <div>
                                    <h6>New comment on project</h6>
                                    <p class="mb-0 text-muted">"Great work on the UI improvements!" - Prof. Smith</p>
                                    <small class="text-muted">3 days ago</small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


@endsection







{{-- <x-app-layout :title="'Profile'"> --}}
{{-- <x-slot name="header"> --}}
{{-- <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> --}}
{{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ route('Dashboard') }}
        </h2>
    </x-slot> --}}

{{-- <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
{{-- <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg"> --}}
{{-- <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg"> --}}
{{-- <div class="p-6 text-gray-900 dark:text-gray-100"> --}}
{{--
            </div>
        </div>
    </div>
</x-app-layout> --}}

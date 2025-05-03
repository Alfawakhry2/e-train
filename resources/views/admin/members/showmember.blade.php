@extends('admin.layout')

@section('content')
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body p-5">
                    @if ($user->role === 'student' && $user->student)
                    <!-- عرض بيانات الطالب -->
                    <div class="row g-5">
                        <div class="col-md-4 text-center">
                            @if ($user->student->image == null)
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=200"
                                     class="img-thumbnail rounded-circle shadow"
                                     style="width: 220px; height: 220px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/'.$user->image) }}"
                                     class="img-thumbnail rounded-circle shadow"
                                     style="width: 220px; height: 220px; object-fit: cover;" alt="UserImage">
                            @endif
                            <h4 class="mt-4 text-secondary text-capitalize fs-3">{{ $user->role }}</h4>
                        </div>

                        <div class="col-md-8">
                            @include('success')
                            <h2 class="mb-4 text-primary fw-bold text-center">Student Full Details</h2>
                            <div class="row fs-3 gy-4">
                                <div class="col-md-6"><strong>Name:</strong> {{ $user->name }}</div>
                                <div class="col-md-6"><strong>Email:</strong> {{ $user->email }}</div>
                                <div class="col-md-6"><strong>Phone:</strong> {{ $user->phone }}</div>
                                <div class="col-md-6"><strong>Address:</strong> {{ $user->address }}</div>
                                <div class="col-md-6"><strong>Status:</strong>
                                    <span class="badge bg-{{ $user->student->status == 'active' ? 'success' : 'warning' }}">
                                        {{ $user->student->status }}
                                    </span>
                                </div>
                                <div class="col-md-6"><strong>Role:</strong> {{ ucfirst($user->role) }}</div>

                                <div class="col-12"><hr></div>

                                <div class="col-12">
                                    <strong>Courses Joined:</strong>
                                    <div class="mt-3">
                                        @forelse ($user->student->course as $course)
                                        <div class="card mb-3">
                                            <div class="card-body">
                                                <h5 class="card-title fs-3">{{ $course->title }}</h5>
                                                <div class="d-flex flex-wrap gap-2 mt-2">
                                                    <span class="badge bg-danger rounded-pill fs-4">
                                                        Status: {{ Str::title($course->pivot->course_status) }}
                                                    </span>
                                                    <span class="badge bg-success rounded-pill fs-4">
                                                        Location: {{ Str::title($course->pivot->course_location) }}
                                                    </span>
                                                    <span class="badge bg-primary rounded-pill fs-4">
                                                        Enrolled: {{ $course->pivot->created_at->format('Y-m-d') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        @empty
                                        <div class="alert alert-info fs-3">
                                            Not Joined In Any Course
                                        </div>
                                        @endforelse
                                    </div>
                                </div>

                                <div class="col-12"><hr></div>

                                <div class="col-md-6">
                                    <strong>Payment Status:</strong>
                                    <span class="badge bg-{{ $user->student->payment_status == 'paid' ? 'success' : 'danger' }} fs-4">
                                        {{ Str::title($user->student->payment_status ?? 'unpaid') }}
                                    </span>
                                </div>
                                <div class="col-md-6"><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</div>

                                <div class="col-12"><hr></div>

                                <div class="col-md-6"><strong>User ID:</strong> {{ $user->student->user_id }}</div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ url('admin/allmembers') }}" class="btn btn-outline-secondary fs-3 me-3 px-4">Back</a>
                                <a href="{{ url("admin/edit/member/$user->id") }}" class="btn btn-primary fs-3 px-4">Edit</a>
                            </div>
                        </div>
                    </div>

                    @elseif ($user->role === 'trainer' && $user->trainer)
                    <!-- عرض بيانات المدرب -->
                    <div class="row g-5">
                        <div class="col-md-4 text-center">
                            @if ($user->trainer->image == null)
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=200"
                                     class="img-thumbnail rounded-circle shadow"
                                     style="width: 220px; height: 220px; object-fit: cover;">
                            @else
                                <img src="{{ asset('storage/'.$user->trainer->image) }}"
                                     class="img-thumbnail rounded-circle shadow"
                                     style="width: 220px; height: 220px; object-fit: cover;" alt="UserImage">
                            @endif
                            <h4 class="mt-4 bg-primary text-white text-capitalize fs-3 p-2 rounded">{{ $user->role }}</h4>
                        </div>

                        <div class="col-md-8">
                            @include('success')
                            <h2 class="mb-4 text-primary fw-bold text-center">Trainer Full Details</h2>
                            <div class="row fs-3 gy-4 mt-3">
                                <div class="col-md-6"><strong>Name:</strong> {{ $user->name }}</div>
                                <div class="col-md-6"><strong>Email:</strong> {{ $user->email }}</div>
                                <div class="col-md-6"><strong>Phone:</strong> {{ $user->phone }}</div>
                                <div class="col-md-6"><strong>Address:</strong> {{ $user->address }}</div>
                                <div class="col-md-6"><strong>Status:</strong>
                                    <span class="badge bg-{{ $user->trainer->status == 'active' ? 'success' : 'warning' }}">
                                        {{ ucfirst($user->trainer->status) }}
                                    </span>
                                </div>
                                <div class="col-md-6"><strong>Role:</strong> {{ ucfirst($user->role) }}</div>

                                <div class="col-12"><hr></div>

                                <div class="col-md-12"><strong>Description:</strong> {{ $user->trainer->desc }}</div>
                                <div class="col-md-6"><strong>Specialization:</strong> {{ $user->trainer->spec }}</div>
                                <div class="col-md-6 text-success">
                                    <strong>Salary:</strong> ${{ number_format($user->trainer->salary, 2) }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Experience:</strong> {{ $user->trainer->experience }} years
                                </div>
                                <div class="col-12"><hr></div>

                                <div class="col-md-6"><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</div>

                                <div class="col-12">
                                    <strong>Courses Teaching:</strong>
                                    <ul class="list-group mt-3">
                                        @forelse ($user->trainer->course as $course)
                                        <li class="list-group-item fs-3 d-flex justify-content-between align-items-center">
                                            {{ $course->title }}
                                            <span class="badge bg-info rounded-pill">
                                                {{ $course->students_count }} Students
                                            </span>
                                        </li>
                                        @empty
                                        <li class="list-group-item fs-3">No Courses Assigned</li>
                                        @endforelse
                                    </ul>
                                </div>

                                <div class="col-12"><hr></div>

                                <div class="col-md-6"><strong>User ID:</strong> {{ $user->trainer->user_id }}</div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ url('admin/allmembers') }}" class="btn btn-outline-secondary fs-3 me-3 px-4">Back</a>
                                <a href="{{ url("admin/edit/member/$user->id") }}" class="btn btn-primary fs-3 px-4">Edit</a>
                            </div>
                        </div>
                    </div>

                    @else
                    <!-- عرض بيانات المستخدم العادي -->
                    <div class="row g-5">
                        <div class="col-md-4 text-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random&size=200"
                                 class="img-thumbnail rounded-circle shadow"
                                 style="width: 220px; height: 220px; object-fit: cover;">
                            <h4 class="mt-4 text-secondary text-capitalize fs-3">{{ $user->role }}</h4>
                        </div>

                        <div class="col-md-8">
                            @include('success')
                            <h2 class="mb-4 fw-bold text-center">User Full Details</h2>
                            <div class="row fs-3 gy-4">
                                <div class="col-md-6"><strong>Name:</strong> {{ $user->name }}</div>
                                <div class="col-md-6"><strong>Email:</strong> {{ $user->email }}</div>
                                <div class="col-md-6"><strong>Phone:</strong> {{ $user->phone }}</div>
                                <div class="col-md-6"><strong>Address:</strong> {{ $user->address }}</div>
                                <div class="col-md-6"><strong>Role:</strong> {{ ucfirst($user->role) }}</div>
                                <div class="col-md-6"><strong>Joined:</strong> {{ $user->created_at->format('Y-m-d') }}</div>

                                <div class="col-12"><hr></div>

                                <div class="col-md-6"><strong>User ID:</strong> {{ $user->id }}</div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="{{ url('admin/allmembers') }}" class="btn btn-outline-secondary fs-3 me-3 px-4">Back</a>
                                <a href="{{ url("admin/edit/member/$user->id") }}" class="btn btn-primary fs-3 px-4">Edit</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

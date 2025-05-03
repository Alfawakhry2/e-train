@extends('admin.layout')


@section('content')
<a href="{{ url('admin/allcategories') }}" class="btn btn-outline-primary"><-Back</a>

    <div class="container py-5">
        <h2 class="mb-4 text-primary"><i class="bi bi-book me-2"></i>All Courses</h2>
        @if ($courses->count() < 1)
        <h4 class="mb-4 text-danger text-center"><i class="bi bi-book me-2"></i>No Courses For This Category</h4>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                @foreach ($courses as $course)
                    <div class="col">
                        <div class="card h-100 shadow-sm border-0">
                            {{-- <img src="{{ asset("storage/$course->image") }}" class="card-img-top" alt="Course Image"> --}}
                            <img src="{{ asset("storage/$course->image") }}" class="card-img-top" alt="Course Image" style="height: 220px; object-fit:content;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-success fs-5">Active</span>

                                </div>
                                <h5 class="card-title">{{ $course->title }}</h5> <strong class="fs-3 text-success">$
                                    {{ $course->price }}</strong>
                                <p class="card-text text-muted">{{ $course->small_desc }}</p>
                            </div>
                            <div class="card-footer bg-white border-top-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-people-fill text-primary me-1"></i>
                                        <span class="fs-3">Start Date : {{ $course->start_date }}</span>

                                    </div>
                                    <a href="{{ url("admin/show/course/$course->id") }}"
                                        class="btn btn-sm btn-outline-primary fs-3">View Course</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
        <div>
            <!-- Pagination -->
            <nav class="mt-5">
                <div class="pagination justify-content-center">
                    {{-- {{ $courses->links() }} --}}
                </div>
            </nav>
        </div>
    @endsection

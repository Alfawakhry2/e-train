@extends('admin.layout')


@section('content')
<div class="container mt-5">
    <div class="row">
        @foreach ($categories as $category)
        <div class="col-md-4 mb-4">
            <div class="card bg-light text-dark h-100 shadow-sm border-0">
                @if ($category->image !== null)
                    <img src="{{asset("Storage/$category->image") }}" class="card-img-top img-fluid" alt="{{ $category->name }}"
                         style="height: 180px; object-fit: cover;">
                @else
                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light border-bottom"
                         style="height: 200px;">
                         <img src="https://ui-avatars.com/api/?name={{ urlencode($category->title) }}&background=random&size=200"
                         class="img-thumbnail  shadow"
                         style="width: 220px; height: 220px; object-fit: cover;">
                    </div>
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fs-3 fw-bold text-primary">{{ $category->title }}</h5>
                    <p class="card-text text-secondary fs-4 mb-1"><strong>Short:</strong> {{ $category->small_desc }}</p>
                    <p class="card-text text-secondary fs-4 flex-grow-1"><strong>Desc:</strong> {{ Str::limit($category->desc , 50 ) }}</p>

                    <div class="mt-4 d-flex flex-column gap-2">
                        <a href="{{ url("admin/show/category/$category->id") }}" class="btn btn-outline-dark fs-4">View Details</a>
                        <a href="{{ url("admin/show/category/courses/$category->id") }}" class="btn btn-outline-primary fs-4">Show Courses</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $categories->links() }}
    </div>
</div>


@endsection

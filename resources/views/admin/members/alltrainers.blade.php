@extends('admin.layout')


@section('content')

<div class="table-responsive mt-4">
    <table class="table table-striped table-bordered table-hover align-middle text-center" style="table-layout: fixed;">
        <thead class="table-dark fs-5">
            <tr>
                <th class="py-3 px-4" style="width: 5%;">#</th>
                <th class="py-3 px-4" style="width: 20%;">Name</th>
                <th class="py-3 px-4" style="width: 25%;">Email</th>
                <th class="py-3 px-4" style="width: 15%;">Role</th>
                <th class="py-3 px-4" style="width: 20%;">Created At</th>
                <th class="py-3 px-4" style="width: 15%;">Action</th>
            </tr>
        </thead>
        <tbody class="fs-5">
            @foreach ($trainers as $trainer)
            <tr>
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">{{ $trainer->name }}</td>
                <td class="py-3 px-4 text-break">{{ $trainer->email }}</td>
                <td class="py-3 px-4">
                    <span class="badge bg-secondary">{{ ucfirst($trainer->role) }}</span>
                </td>
                <td class="py-3 px-4">{{ $trainer->created_at->format('Y-m-d') }}</td>
                <td class="py-3 px-4">
                    <div class="d-flex flex-column">
                        <!-- Show button (bigger) -->
                        <div class="mb-2">
                            <a href="{{ url("admin/show/member/$trainer->id") }}" class="btn btn-dark btn-sm w-100 fs-3">Show</a>
                        </div>

                        <!-- Edit and Delete buttons (beside each other) -->
                        <div class="d-flex justify-content-between">
                        {{-- i get user with role trainer as $trainer ... and the trainer has all user attr --}}
                            <a href="{{ url("admin/edit/member/$trainer->id") }}" class="btn btn-outline-primary btn-sm w-45 fs-3">Edit</a>
                            <a href="#" class="btn btn-outline-danger btn-sm w-45 fs-3">Delete</a>
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<div class="mb-2 text-dark">
    <div class="w-50 fs-3">{{ $trainers->links() }}</div>
</div>

@endsection

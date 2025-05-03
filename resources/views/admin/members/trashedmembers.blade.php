@extends('admin.layout')


@section('content')
<div class="table-responsive mt-4">
    @include('success')
    <h3 class="text-center text-danger">Trashed Members</h3>
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
            @foreach ($users as $user)
            <tr>
                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                <td class="py-3 px-4">{{ $user->name }}</td>
                <td class="py-3 px-4 text-break">{{ $user->email }}</td>
                <td class="py-3 px-4">
                    <span class="badge bg-secondary">{{ ucfirst($user->role) }}</span>
                </td>
                <td class="py-3 px-4">{{ $user->created_at->format('Y-m-d') }}</td>
                <td class="py-3 px-4">
                    <div class="d-flex flex-column">
                        <!-- Show button (bigger) -->
                        <div class="mb-2">
                            <a href="{{ route('RestoreMember' , $user->id) }}" class="btn btn-outline-success btn-sm w-100 fs-3">Restore Member</a>
                        </div>

                        <!-- Edit and Delete buttons (beside each other) -->
                        <div class="d-flex justify-content-between">
                            {{-- <a href="{{ url("admin/edit/member/$user->id") }}" class="btn btn-outline-primary btn-sm w-45 fs-3">Edit</a>
                            Delete Form --}}
                            <form action="{{route("PDeleteMember" , $user->id )}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user For Ever !?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm fs-3">Delete Permentent</button>
                            </form>
                            {{-- <a href="#" class="btn btn-outline-danger btn-sm w-45 fs-3">Delete</a> --}}
                        </div>
                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>

<div class="mb-2 text-dark">
    <div class="w-50 fs-3">{{ $users->links() }}</div>
</div>

@endsection

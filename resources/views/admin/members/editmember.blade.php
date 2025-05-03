@extends('admin.layout')

@section('content')
    <div class="container mt-5 bg-white">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="flex justify-center mb-5">
                    <a class="navbar-brand" href="{{ url('') }}">
                        <img src="{{ asset('front/img/logo.png') }}" alt="logo">
                    </a>
                </div>

                <h3 class="my-4 text-center text-secondary">Edit Member</h3>

                @include('success')
                @if ($user->role == 'trainer')
                    @include('admin.members.trainer-form')
                @elseif($user->role == 'student' && $user->student != null)
                    @include('admin.members.student-from')
                @elseif($user->role == 'admin' || $user->student == null || $user->trainner == null)
                @include('admin.members.admin-form')
                @endif

            </div>
        </div>
    </div>
@endsection

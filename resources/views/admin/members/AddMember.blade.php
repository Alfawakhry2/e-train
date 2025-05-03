@extends('admin.layout')
@section('title' , 'Admin Add Member')
@section('content')
    <div class="container mt-5 bg-white">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="flex justify-center mb-6 mt-5">
                    <a class="navbar-brand" href="{{ url('') }}">
                        <img src="{{ asset('front/img/logo.png') }}" alt="logo">
                    </a>
                </div>
                <h3 class="my-4 text-center text-secondary">Add New Member</h3>
                @include('success')
                <form action="{{ route('store') }}" method="POST">
                    @csrf
                    <!-- Name -->
                    <div class="my-3">
                        <label for="name" class="form-label fs-3">Name</label>
                        <input type="text" class="form-control border-1 border-dark rounded-3" id="name"
                            name="name">
                    </div>
                    @error('name')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Email -->
                    <div class="my-3">
                        <label for="email" class="form-label fs-3">Email</label>
                        <input type="email" class="form-control border-1 border-dark rounded-3" id="email"
                            name="email" required>
                    </div>
                    @error('email')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Role -->
                    <div class="my-5 col-3">
                        <label for="role" class="form-label fs-3">Role</label>
                        <select class="form-select fs-3 border-1 border-dark rounded-3" id="role" name="role"
                            required>
                            <option value="trainer">Trainer</option>
                            <option value="student">Student</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    @error('role')
                        <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Phone -->
                    <div class="my-3">
                        <label for="phone" class="form-label fs-3">Phone</label>
                        <input type="tel" class="form-control border-1 border-dark rounded-3" id="phone"
                            name="phone" required>
                    </div>
                    @error('phone')
                    <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Address -->
                    <div class="my-3">
                        <label for="address" class="form-label fs-3">Address</label>
                        <input type="text" class="form-control border-1 border-dark rounded-3" id="address"
                            name="address" rows="1" required></input>
                    </div>
                    @error('address')
                    <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Password -->
                    <div class="my-3">
                        <label for="password" class="form-label fs-3">Password</label>
                        <input type="password" class="form-control border-1 border-dark rounded-3" id="password"
                            name="password" required>
                    </div>

                    <!-- Confirm Password -->
                    <div class="my-3">
                        <label for="password_confirmation" class="form-label fs-3">Confirm Password</label>
                        <input type="password" class="form-control border-1 border-dark rounded-3"
                            id="password_confirmation" name="password_confirmation" required>
                    </div>
                    @error('password')
                    <p class="my-1 text-start text-danger">*{{ $message }}</p>
                    @enderror
                    <!-- Submit Button -->
                    <div class="d-grid gap-2 justify-content-center align-items-center">
                        <button type="submit" class="btn rounded btn-secondary fs-2 my-5">Add Member</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

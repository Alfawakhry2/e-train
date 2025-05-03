<form action="{{ route('UpdateMember', $user->id) }}" method="POST" class="fs-3">
    @csrf
    @method('PUT')
    <input type="hidden" name="hidden_role" value="{{ $user->role }}">

    <!-- Basic Information Section -->
    <div class="card mb-4 border-dark">
        <div class="card-header bg-light">
            <h4 class="mb-0">Basic Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Name -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control border-dark rounded-3"
                           name="name" value="{{ old('name', $user->name) }}">
                    @error('name')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control border-dark rounded-3"
                           name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <!-- Phone -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control border-dark rounded-3"
                           name="phone" value="{{ old('phone', $user->phone) }}" required>
                    @error('phone')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <!-- Address -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control border-dark rounded-3"
                           name="address" value="{{ old('address', $user->address) }}" required>
                    @error('address')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>

    <!-- Account Settings Section -->
    <div class="card mb-4 border-dark">
        <div class="card-header bg-light">
            <h4 class="mb-0">Account Settings</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Role -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Role</label>
                    <select class="form-select border-dark rounded-3" name="role" required>
                        <option value="{{ $user->role }}" selected>{{ ucfirst($user->role) }}</option>
                        @foreach(['admin', 'trainer', 'student'] as $role)
                            @if($role != $user->role)
                                <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                            @endif
                        @endforeach
                    </select>
                    @error('role')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <!-- Joined Date -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Joined Date</label>
                    <input type="text" class="form-control border-dark rounded-3 bg-light"
                           value="{{ $user->created_at->format('Y-m-d (l)') }}" readonly>
                </div>
            </div>

            <div class="row">
                <!-- Password -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control border-dark rounded-3" name="password">
                    @error('password')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">Confirm Password</label>
                    <input type="password" class="form-control border-dark rounded-3" name="password_confirmation">
                </div>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
        <button type="submit" class="btn btn-secondary py-3">Confirm Update</button>
    </div>
</form>

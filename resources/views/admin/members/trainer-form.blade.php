<form action="{{ route('UpdateMember', $user->id) }}" method="POST" class="fs-3">
    @csrf
    @method('PUT')
    <input type="hidden" name="hidden_role" value="{{ $user->role }}">
<!-- Personal Information Section -->
<div class="card mb-4 border-dark">
    <div class="card-header bg-light">
        <h4 class="mb-0 fs-3">Personal Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <!-- Name Field -->
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label fs-3">Name</label>
                <input type="text" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="name" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>

            <!-- Email Field -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label fs-3">Email</label>
                <input type="email" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="row">
            <!-- Phone Field -->
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label fs-3">Phone</label>
                <input type="tel" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>

            <!-- Address Field -->
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label fs-3">Address</label>
                <input type="text" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="address" name="address" value="{{ old('address', $user->address) }}" required>
                @error('address')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
</div>
    <!-- Trainer Professional Details -->
    <div class="card mb-4 border-dark">
        <div class="card-header bg-light">
            <h4 class="mb-0">Professional Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Specialization</label>
                    <input type="text" class="form-control border-dark rounded-3 fs-3"
                           name="spec" value="{{ old('spec', $user->trainer->spec) }}">
                    @error('spec')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Experience (Years)</label>
                    <input type="number" class="form-control border-dark rounded-3 fs-3"
                           name="exp" value="{{ old('exp', $user->trainer->experience) }}">
                    @error('exp')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Salary</label>
                    <input type="text" class="form-control border-dark rounded-3 fs-3"
                           name="salary" value="{{ old('salary', $user->trainer->salary) }}">
                    @error('salary')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-select border-dark rounded-3 fs-3" name="status" required>
                        @foreach(['active', 'inactive', 'pending'] as $status)
                            <option value="{{ $status }}"
                                {{ $user->trainer->status == $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control border-dark rounded-3 fs-3"
                          name="desc" rows="3">{{ old('desc', $user->trainer->desc) }}</textarea>
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
                <div class="col-md-6 mb-3">
                    <label class="form-label fs-3">Role</label>
                    <select class="form-select border-dark rounded-3 fs-3" name="role" required>
                        <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                        <option value="trainer" {{ $user->role == 'trainer' ? 'selected' : '' }}>Trainer</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('role')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Joined Date</label>
                    <input type="text" class="form-control border-dark rounded-3 bg-light"
                           value="{{ $user->trainer->created_at->format('Y-m-d') }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control border-dark rounded-3" name="password">
                    @error('password')
                        <div class="text-danger mt-1">*{{ $message }}</div>
                    @enderror
                </div>

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

<form action="{{ route('UpdateMember', $user->id) }}" method="POST" class="fs-3">
    @csrf
    @method('PUT')
    <input type="hidden" name="hidden_role" value="{{ $user->role }}">

<!-- Basic Information Section -->
<div class="card mb-4 border-dark">
    <div class="card-header bg-light">
        <h4 class="mb-0 fs-3">Basic Information</h4>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label fs-3">Name</label>
                <input type="text" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="name" name="name" value="{{ old('name', $user->name) }}">
                @error('name')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>

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
            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label fs-3">Phone</label>
                <input type="tel" class="form-control border-1 border-dark rounded-3 fs-3"
                       id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                    <p class="text-danger mt-1 fs-3">*{{ $message }}</p>
                @enderror
            </div>

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

    <!-- Courses Section -->
    <div class="card mb-4 border-dark">
        <div class="card-header bg-light">
            <h4 class="mb-0">Courses Joined</h4>
        </div>
        <div class="card-body">
            @forelse ($user->student->course as $course)
                <div class="course-item mb-4 p-3 border rounded-3">
                    <h5 class="text-primary fw-bold mb-3">{{ $course->title }}</h5>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Location</label>
                            <select class="form-select border-dark rounded-3 fs-3"
                                    name="course_location[{{ $course->id }}]">
                                <option value="online" {{ $course->pivot->course_location == 'online' ? 'selected' : '' }}>Online</option>
                                <option value="offline" {{ $course->pivot->course_location == 'offline' ? 'selected' : '' }}>Offline</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Course Status</label>
                            <select class="form-select border-dark rounded-3 fs-3"
                                    name="course_status[{{ $course->id }}]">
                                <option value="not_started" {{ $course->pivot->course_status == 'not_started' ? 'selected' : '' }}>Not Started</option>
                                <option value="in_progress" {{ $course->pivot->course_status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ $course->pivot->course_status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                        </div>
                    </div>

                    <div class="text-muted">
                        Joined: {{ $course->pivot->created_at->format('Y-m-d (l)') }}
                    </div>
                </div>
            @empty
                <div class="alert alert-info">
                    Not enrolled in any courses
                </div>
            @endforelse
        </div>
    </div>

    <!-- Status and Role Section -->
    <div class="row mb-4">
        <div class="col-md-6 mb-3">
            <label class="form-label">Student Status</label>
            <select class="form-select border-dark rounded-3 fs-3" name="status" required>
                <option value="active" {{ $user->student->status == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ $user->student->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label">Role</label>
            <select class="form-select border-dark rounded-3 fs-3" name="role" required>
                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>Student</option>
                <option value="trainer" {{ $user->role == 'trainer' ? 'selected' : '' }}>Trainer</option>
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
    </div>

    <!-- Account Section -->
    <div class="card mb-4 border-dark">
        <div class="card-header bg-light">
            <h4 class="mb-0">Account Settings</h4>
        </div>
        <div class="card-body">
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

            <div class="mb-3">
                <label class="form-label">Joined Date</label>
                <input type="text" class="form-control border-dark rounded-3 bg-light"
                       value="{{ $user->created_at->format('Y-m-d (l)') }}" readonly>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="d-grid">
        <button type="submit" class="btn btn-secondary py-3">Confirm Update</button>
    </div>
</form>

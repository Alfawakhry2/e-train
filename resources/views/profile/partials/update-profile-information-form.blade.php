<section>
    <header>
        {{-- <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100"> --}}
        <h2 class="text-lg font-medium text-gray-900 ">
            {{ __('Profile Information') }}
        </h2>

        {{-- <p class="mt-1 text-sm text-gray-600 dark:text-gray-400"> --}}
        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    {{-- <p class="text-sm mt-2 text-gray-800 dark:text-gray-200"> --}}
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        {{-- <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"> --}}
                        <button form="send-verification" class="underline text-sm text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        {{-- <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400"> --}}
                        <p class="mt-2 font-medium text-sm text-green-600 ">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="space-y-4">
            <!-- Image Preview Section -->
            <div class="flex flex-col items-center">
              <!-- Current Image Display -->
              @if(isset($course->image))
                <div class="mb-4 text-center">
                  <p class="text-sm text-gray-500 mb-2">Current Image</p>
                  <div class="relative">
                    <img src="{{ asset('storage/'.$user->image) }}"
                         alt="Current Course Image"
                         class="h-48 w-full max-w-xs rounded-lg object-cover border-2 border-gray-200 shadow-sm">
                    <div class="absolute inset-0 bg-black bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity rounded-lg">
                      <span class="text-white text-sm bg-black bg-opacity-50 px-2 py-1 rounded">Current Image</span>
                    </div>
                  </div>
                </div>
              @endif

              <!-- New Image Preview -->
              <div id="imagePreviewContainer" class="hidden mb-4 text-center">
                <p class="text-sm text-gray-500 mb-2">New Image Preview</p>
                <div class="relative">
                  <img id="imagePreview"
                       src="#"
                       alt="New Image Preview"
                       class="h-48 w-full max-w-xs rounded-lg object-cover border-2 border-blue-300 shadow-sm">
                  <div class="absolute inset-0 bg-blue-500 bg-opacity-20 flex items-center justify-center opacity-0 hover:opacity-100 transition-opacity rounded-lg">
                    <span class="text-white text-sm bg-blue-600 px-2 py-1 rounded">Preview</span>
                  </div>
                </div>
              </div>
            </div>

            <!-- File Input Section -->
            <div>
              <label for="image" class="block text-sm font-medium text-gray-700 mb-1">User Image</label>
              <div class="mt-1 flex items-center">
                <label for="image" class="cursor-pointer">
                  <span class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="-ml-1 mr-2 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" />
                    </svg>
                    Choose file
                  </span>
                  <input id="image"
                         name="image"
                         type="file"
                         class="sr-only"
                         accept="image/*"
                         onchange="previewImage(this)">
                </label>
                <span id="fileName" class="ml-2 text-sm text-gray-500">No file selected</span>
              </div>
              <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
              @error('image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <script>
            function previewImage(input) {
              const previewContainer = document.getElementById('imagePreviewContainer');
              const preview = document.getElementById('imagePreview');
              const fileNameDisplay = document.getElementById('fileName');

              if (input.files && input.files[0]) {
                // Show filename
                fileNameDisplay.textContent = input.files[0].name;

                // Validate file size
                if (input.files[0].size > 2 * 1024 * 1024) {
                  alert('File size exceeds 2MB limit');
                  input.value = '';
                  return;
                }

                // Preview image
                const reader = new FileReader();
                reader.onload = function(e) {
                  preview.src = e.target.result;
                  previewContainer.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
              } else {
                fileNameDisplay.textContent = 'No file selected';
                previewContainer.classList.add('hidden');
              }
            }
          </script>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    {{-- class="text-sm text-gray-600 dark:text-gray-400" --}}
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Edit Profile</h6>
                                    <p class="text-sm">Update your profile information</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('profil.index') }}" class="btn btn-sm btn-white me-2">
                                        <i class="fa fa-arrow-left me-2"></i>Back
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <form action="{{ route('profil.update', $user->id_user) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="border-bottom py-4 px-4">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <div class="avatar avatar-xxl position-relative">
                                                <img
                                                    src="{{ asset('storage/' . Auth::user()->profile_picture) }}"
                                                    alt="Profile picture" class="w-100 border-radius-lg shadow-sm"
                                                    id="preview">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <h5 class="mb-1">{{ $user->username }}</h5>
                                            <p class="text-sm text-secondary mb-0">{{ $user->email }}</p>
                                            <input type="file" name="profile_picture" id="profile_picture"
                                                class="d-none" accept="image/*">
                                        </div>
                                    </div>
                                </div>

                                <div class="py-4 px-4">
                                    @if (session('error'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        {{ session('error') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif
                                    @if (session('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{ session('success') }}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" name="username" id="username"
                                                value="{{ old('username', $user->username) }}"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Enter your username">
                                            @error('username')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="email" class="form-label">Email Address</label>
                                            <input type="email" name="email" id="email"
                                                value="{{ old('email', $user->email) }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Enter your email address">
                                            @error('email')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 mb-3">
                                            <label for="profile_picture_input" class="form-label">Profile
                                                Picture</label>
                                            <input type="file" name="profile_picture" id="profile_picture_input"
                                                class="form-control @error('profile_picture') is-invalid @enderror"
                                                accept="image/*">
                                            <small class="text-muted">Max file size: 2MB. Supported formats: JPG, PNG,
                                                JPEG, GIF</small>
                                            @error('profile_picture')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="border-top pt-4 mt-4">
                                        <h6 class="text-sm font-weight-semibold mb-3">Change Password</h6>
                                        <p class="text-sm text-secondary mb-4">Leave password fields empty if you don't
                                            want to change your password.</p>

                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="password" class="form-label">New Password</label>
                                                <input type="password" name="password" id="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Enter new password">
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="password_confirmation" class="form-label">Confirm New
                                                    Password</label>
                                                <input type="password" name="password_confirmation"
                                                    id="password_confirmation" class="form-control"
                                                    placeholder="Confirm new password">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-top py-3 px-4 d-flex justify-content-between">
                                    <a href="{{ route('profil.index') }}" class="btn btn-white">
                                        <i class="fa fa-times me-2"></i>Cancel
                                    </a>
                                    <button type="submit" class="btn btn-dark">
                                        <i class="fa fa-save me-2"></i>Save Changes
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>
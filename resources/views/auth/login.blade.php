<x-guest-layout>
    <div class="container position-sticky z-index-sticky top-0">
        <div class="row">
            <div class="col-12"></div>
        </div>
    </div>
    <main class="main-content mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    <div class="row">
                        <!-- Login Card -->
                        <div class="col-xl-4 col-md-6 d-flex flex-column mx-auto">
                            <div class="card card-plain mt-8">
                                <div class="card-header pb-0 bg-transparent text-center">
                                    <h3 class="font-weight-black text-dark display-6">Selamat Datang</h3>
                                    <p class="mb-0">Selamat datang kembali di Ab.sen!</p>
                                </div>

                                <div class="text-center">
                                    @if (session('error'))
                                    <div class="mb-4 font-medium text-sm text-white bg-danger p-2 rounded">
                                        {{ session('error') }}
                                    </div>
                                    @endif
                                    @error('message')
                                    <div class="alert alert-danger text-sm" role="alert">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <div class="card-body">
                                    <form role="form" class="text-start" method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <label>Email Address</label>
                                        <div class="mb-3">
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Masukkan alamat email anda" value="{{ old('email') }}"
                                                aria-label="Email" required>
                                        </div>

                                        <label>Password</label>
                                        <div class="mb-3">
                                            <input type="password" id="password" name="password"
                                                value="{{ old('password') }}" class="form-control"
                                                placeholder="********************" aria-label="Password" required>
                                        </div>

                                        <!-- Custom Checkbox Show Password -->
                                        <div class="d-flex align-items-center mb-3">
                                            <label class="custom-checkbox-container">
                                                Show Password
                                                <input type="checkbox" id="showPasswordCheckbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>

                                        <!-- Login Button -->
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-dark w-100 mt-4 mb-3">
                                                Login
                                            </button>
                                        </div>
                                    </form>
                                </div>

                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-xs mx-auto">
                                        Belum memiliki akun?
                                        <a href="{{ route('register.form') }}"
                                            class="text-dark font-weight-bold">Register</a>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Image Section -->
                        <div class="col-md-6">
                            <div class="position-absolute w-40 top-0 end-0 h-100 d-md-block d-none">
                                <div class="oblique-image position-absolute fixed-top ms-auto h-100 z-index-0 bg-cover ms-n8"
                                    style="background-image:url('../assets/img/image-sign-in.jpg')">
                                    <div
                                        class="blur mt-12 p-4 text-center border border-white border-radius-md position-absolute fixed-bottom m-4">
                                        <h2 class="mt-3 text-dark font-weight-bold">
                                            Presensi kapan saja, di mana saja, dengan verifikasi wajah dan video untuk
                                            kehadiran yang lebih autentik.
                                        </h2>
                                        <h6 class="text-dark text-sm mt-5">© 2025 Ab.sen. All rights reserved.</h6>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Custom CSS Checkbox -->
    <style>
    /* Container label */
    .custom-checkbox-container {
        display: block;
        position: relative;
        padding-left: 30px;
        cursor: pointer;
        font-size: 14px;
        user-select: none;
    }

    /* Hide default checkbox */
    .custom-checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create custom checkmark */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 18px;
        width: 18px;
        background-color: #000;
        border: 2px solid #fff;
        border-radius: 4px;
    }

    /* When checked, show tick */
    .custom-checkbox-container input:checked~.checkmark::after {
        content: "";
        position: absolute;
        left: 4px;
        top: 0px;
        width: 5px;
        height: 10px;
        border: solid #fff;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    </style>

    <!-- Toggle Password JS -->
    <script>
    const checkbox = document.getElementById('showPasswordCheckbox');
    const passwordInput = document.getElementById('password');

    checkbox.addEventListener('change', function() {
        passwordInput.type = this.checked ? 'text' : 'password';
        passwordInput.placeholder = this.checked ? 'Masukkan password anda' : '********************';
    });
    </script>
</x-guest-layout>
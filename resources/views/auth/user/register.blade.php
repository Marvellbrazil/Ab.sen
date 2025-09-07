<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Register - Ab.sen | Website Presensi Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="@yield('favicon', 'assets/favicon.png')" type="image/x-icon">
    <style>
    :root {
        --primary-color: #FF2800;
        --secondary-color: #E84E31;
        --background-gradient: linear-gradient(136deg, #f7e3c4 0%, #fff 34%, #E9DBDB 80%, #D4B6B6 100%);
        --card-bg: rgba(255, 255, 255, 0.25);
        --card-border: rgba(255, 255, 255, 0.4);
    }

    * {
        box-sizing: border-box;
    }

    body {
        min-height: 100vh;
        background: var(--background-gradient);
        font-family: 'Montserrat Alternates', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
        margin: 0;
    }

    .main-wrapper {
        display: flex;
        max-width: 1000px;
        width: 100%;
        align-items: stretch;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        min-height: 550px;
    }

    .register-card {
        backdrop-filter: blur(25px) saturate(150%);
        -webkit-backdrop-filter: blur(25px) saturate(150%);
        background: var(--card-bg);
        border: 1px solid var(--card-border);
        padding: 2rem;
        width: 500px;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .image-panel {
        flex: 1;
        filter: brightness(0.9);
        min-height: 300px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .image-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .logo-glow {
        filter: drop-shadow(0 0 15px rgba(255, 75, 25, 0.785));
        max-width: 120px;
        height: auto;
    }

    .form-group {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .form-control {
        font-family: Montserrat;
        font-weight: 500;
        font-size: 16px;
        border-radius: 12px;
        padding: 14px 20px;
        background: rgba(255, 255, 255, 0.35);
        border: 1px solid rgba(0, 0, 0, 0.2);
        color: #000;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-control:focus {
        border-color: var(--primary-color) !important;
        background: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 0 0.2rem rgba(255, 40, 0, 0.25);
        transform: scale(1.03);
    }

    .toggle-password {
        position: absolute;
        top: 50%;
        right: 15px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #777;
        background: transparent;
        border: none;
        padding: 0;
        width: 22px;
        height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .toggle-password:hover {
        color: var(--primary-color);
    }

    .form-label {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 6px;
        color: #777171;
        font-size: 16px;
        font-weight: 400;
        pointer-events: none;
        transition: 0.25s ease;
    }

    .form-control:focus+.form-label,
    .form-control:not(:placeholder-shown)+.form-label {
        top: -12px;
        left: 15px;
        transform: none;
        font-size: 14px;
        background: #fff;
        color: #000;
    }

    .register-btn {
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        padding: 12px;
        background: #fff;
        color: #000;
        border: 1px solid rgba(0, 0, 0, 0.1);
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
        width: 100%;
    }

    .register-btn:hover {
        background: var(--primary-color);
        color: #fff;
        box-shadow: 0px 4px 14px rgba(255, 40, 0, 0.4);
    }

    .extra-links a {
        color: var(--secondary-color);
        text-decoration: none;
        font-size: 14px;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }

    /* Popup Notification */
    .popup-notification {
        position: fixed;
        top: 20px;
        left: 50%;
        min-width: 250px;
        max-width: 90%;
        padding: 16px 24px;
        background: #fff;
        color: var(--primary-color);
        font-weight: 500;
        font-family: 'Montserrat Alternates', sans-serif;
        font-size: 16px;
        text-align: center;
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.2);
        box-shadow: 0 4px 25px rgba(200, 12, 12, 0.25);
        backdrop-filter: blur(10px) saturate(120%);
        -webkit-backdrop-filter: blur(10px) saturate(120%);
        opacity: 0;
        transform: translate(-50%, -80px);
        pointer-events: none;
        transition: opacity 0.4s ease, transform 0.4s ease;
        z-index: 9999;
    }

    .popup-notification.show {
        opacity: 1;
        transform: translate(-50%, 10px);
        pointer-events: auto;
    }

    .progress-bar {
        position: relative;
        width: calc(100% + 38px);
        height: 3px;
        background: rgba(0, 0, 0, 0.09);
        border-radius: 2px;
        margin: 12px -19px -16px;
        overflow: hidden;
    }

    .progress-bar span {
        display: block;
        height: 100%;
        width: 100%;
        background: rgba(255, 0, 0, 0.85);
        border-radius: 2px;
        transition: width 3s linear;
    }

    @media (max-width: 992px) {
        .main-wrapper {
            max-width: 700px;
            flex-direction: column;
        }

        .register-card {
            width: 100%;
            border-radius: 0 0 20px 20px;
        }

        .image-panel {
            order: -1;
            min-height: 250px;
        }

        .image-panel img {
            border-radius: 20px 20px 0 0;
        }
    }

    @media (max-width: 768px) {
        .main-wrapper {
            max-width: 500px;
        }
    }

    @media (max-width: 576px) {
        .image-panel {
            display: none;
        }

        .register-card {
            border-radius: 20px;
            padding: 1.5rem;
        }

        .main-wrapper {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
    }

    @media (max-width: 480px) {
        body {
            padding: 0.5rem;
        }

        .register-card {
            padding: 1.25rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-control {
            padding: 12px 16px;
            font-size: 15px;
        }

        .form-label {
            font-size: 15px;
        }

        .logo-glow {
            max-width: 100px;
        }

        .popup-notification {
            font-size: 15px;
            padding: 14px 20px;
        }
    }
    </style>
</head>

<body>
    <div class="main-wrapper">
        <div id="popup" class="popup-notification"></div>
        <div class="image-panel">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Team Registration">
        </div>

        <div class="register-card">
            <div class="text-center mb-4">
                <img src="assets/ab.sen_g_trans.png" class="logo-glow mb-3" alt="logo">
                <h2 class="fw-semibold">Register for Users</h2>
                <hr>
            </div>

            <form method="POST" action="{{ route('user.register.post') }}">
                @csrf
                <div class="form-group">
                    <input type="text" id="name" name="name" class="form-control shadow-sm" placeholder=" " required autocomplete="off" value="{{ old('name') }}">
                    <label for="name" class="form-label">Name</label>
                    @error('name')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control shadow-sm" placeholder=" " required autocomplete="off" value="{{ old('username') }}">
                    <label for="username" class="form-label">Username</label>
                    @error('username')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control shadow-sm" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">
                        <svg id="eyeOpen-password" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5z" />
                        </svg>
                        <svg id="eyeSlash-password" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="currentColor" style="display:none;">
                            <path
                                d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                            <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button>
                    @error('password')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <input type="password" id="confirmPassword" name="password_confirmation" class="form-control shadow-sm" placeholder=" " required>
                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                    <!-- <button type="button" class="toggle-password" onclick="togglePassword('confirmPassword')">
                        <svg id="eyeOpen-confirmPassword" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5z" />
                        </svg>
                        <svg id="eyeSlash-confirmPassword" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="currentColor" style="display:none;">
                            <path
                                d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                            <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </button> -->
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn register-btn">Register</button>
                </div>
                <div class="text-center mt-3 extra-links">
                    <a href="{{ route('user.login') }}"><span>Already have an account? Login</span></a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const eyeOpen = document.getElementById(`eyeOpen-${fieldId}`);
        const eyeSlash = document.getElementById(`eyeSlash-${fieldId}`);

        if (input.type === "password") {
            input.type = "text";
            eyeOpen.style.display = "none";
            eyeSlash.style.display = "inline";
        } else {
            input.type = "password";
            eyeOpen.style.display = "inline";
            eyeSlash.style.display = "none";
        }
    }

    function showPopup(message, type = 'success') {
        if (!message) return;
        const popup = document.getElementById("popup");

        // Set color based on type
        const color = type === 'success' ? 'var(--primary-color)' : '#dc3545';
        const iconUrl = type === 'success' ? 'assets/check.png' : 'assets/cross.png';

        // isi popup: icon + text
        popup.innerHTML = `
            <div style="display:flex; align-items:center; justify-content:center; gap:12px;">
                <img src="${iconUrl}" alt="icon" style="width:30px; height:30px;">
                <span>${message}</span>
            </div>
            <div class="progress-bar">
                <span style="background: ${color};"></span>
            </div>
        `;

        // reset dulu biar transisi smooth setiap kali
        popup.classList.remove("show");
        void popup.offsetWidth; // 🔑 paksa reflow

        // tampilkan popup
        popup.classList.add("show");

        const bar = popup.querySelector('.progress-bar span');
        bar.style.width = "0%";

        // otomatis hilang setelah 3 detik
        setTimeout(() => {
            popup.classList.remove("show");
        }, 3000);

        // Animate progress bar
        setTimeout(() => {
            if (bar) bar.style.width = "0%";
        }, 10);
    }

    // Form validation
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");

        form.addEventListener("submit", function(e) {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                e.preventDefault();
                showPopup("Passwords do not match!", "error");
            }
        });

        // Show success/error messages from server
        @if(session('success'))
            showPopup("{{ session('success') }}", "success");
        @endif

        @if(session('error'))
            showPopup("{{ session('error') }}", "error");
        @endif

        // Show validation errors
        @if($errors->any())
            @foreach($errors->all() as $error)
                showPopup("{{ $error }}", "error");
                @break
            @endforeach
        @endif
    });
    </script>
</body>

</html>

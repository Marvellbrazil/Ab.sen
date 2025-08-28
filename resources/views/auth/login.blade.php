<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ab.sen | Website Presensi Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/ab.sen_g_bordrad.png" type="image/x-icon">
    <style>
    body {
        min-height: 100vh;
        background: linear-gradient(136deg, #f7e3c4 0%, #fff 34%, #E9DBDB 80%, #D4B6B6 100%);
        font-family: 'Montserrat Alternates', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .main-wrapper {
        display: flex;
        max-width: 900px;
        width: 100%;
        align-items: stretch;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .login-card {
        backdrop-filter: blur(25px) saturate(150%);
        -webkit-backdrop-filter: blur(25px) saturate(150%);
        background: rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.4);
        padding: 3rem;
        width: 420px;
        flex-shrink: 0;
    }

    .image-panel {
        flex: 1;
        filter: brightness(0.9);
    }

    .image-panel img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .logo-glow {
        filter: drop-shadow(0 0 15px rgba(255, 75, 25, 0.785))
    }

    .form-group {
        position: relative;
        margin-bottom: 2rem;
    }

    .form-control {
        font-family: Montserrat;
        font-weight: 500;
        font-size: large;
        border-radius: 12px;
        padding: 12px 24px;
        background: rgba(255, 255, 255, 0.35);
        border: 1px solid rgba(0, 0, 0, 0.2);
        color: #000;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #FF2800 !important;
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
    }

    .toggle-password:hover {
        color: #FF2800;
    }

    .form-label {
        position: absolute;
        left: 16px;
        top: 50%;
        transform: translateY(-50%);
        background: #fff;
        padding: 0 6px;
        color: #777171;
        font-size: 17px;
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

    .login-btn {
        border-radius: 10px;
        font-size: 16px;
        font-weight: 500;
        padding: 0.55rem 1.2rem;
        background: #fff;
        color: #000;
        box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.25);
        transition: all 0.3s ease;
    }

    .login-btn:hover {
        background: #FF2800;
        color: #fff;
        box-shadow: 0px 4px 14px rgba(255, 40, 0, 0.4);
    }

    .extra-links a {
        color: #E84E31;
        text-decoration: none;
        font-size: 14px;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }

    @media (max-width: 1024px) {
        body {
            padding: 1rem;
        }
    }

    @media (max-width: 1024px) and (min-width: 768px) {
        .main-wrapper {
            flex-direction: column;
            max-width: 600px;
        }

        .image-panel {
            order: -1;
        }

        .login-card {
            width: 100%;
            border-radius: 0 0 20px 20px;
        }

        .image-panel img {
            border-radius: 20px 20px 0 0;
            height: 250px;
        }
    }

    @media (max-width: 767px) {
        .main-wrapper {
            flex-direction: column;
            max-width: 420px;
        }

        .image-panel {
            display: none;
        }

        .login-card {
            width: 100%;
            border-radius: 20px;
        }
    }
    </style>
    <script>
    function togglePassword() {
        const input = document.getElementById("password");
        const eyeOpen = document.getElementById("eyeOpen");
        const eyeSlash = document.getElementById("eyeSlash");

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
    </script>
</head>

<body>
    @if (session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
    @endif

    <div class="main-wrapper">
        <div class="login-card">
            <div class="text-center mb-4">
                <img src="assets/ab.sen_g_trans.png" class="logo-glow mb-3" alt="logo">
                <h2 class="fw-semibold login-title">Login</h2>
                <hr>
            </div>
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="form-group">
                    <input type="text" id="username" name="username" class="form-control shadow-sm" placeholder=" " required
                        autocomplete="off">
                    <label for="username" class="form-label">Username</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password" name="password" class="form-control shadow-sm" placeholder=" " required>
                    <label for="password" class="form-label">Password</label>
                    <span class="toggle-password" onclick="togglePassword()">
                        <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                            viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 5.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5z" />
                        </svg>
                        <svg id="eyeSlash" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24"
                            fill="currentColor" style="display:none;">
                            <path
                                d="M12 5c-7 0-11 7-11 7s4 7 11 7 11-7 11-7-4-7-11-7zm0 11a4 4 0 1 1 0-8 4 4 0 0 1 0 8z" />
                            <line x1="3" y1="3" x2="21" y2="21" stroke="currentColor" stroke-width="2" />
                        </svg>
                    </span>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn login-btn">Login</button>
                </div>
                <div class="text-center mt-3 extra-links">
                    <a href="#" class="me-2">Register</a> |
                    <a href="#" class="ms-2">Forgot Password?</a>
                </div>
            </form>
        </div>

        <div class="image-panel">
            <img src="https://media.istockphoto.com/id/1197547546/photo/smiling-young-man-using-laptop-studying-working-online-at-home.jpg?s=612x612&w=0&k=20&c=-TQO9RAhTmfSH8_H9qbDNhDmDbrkxtFhUjj09TAuWZ8="
                alt="Decoration">
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

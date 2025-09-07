<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ab.sen | Website Presensi Online')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="@yield('favicon', 'assets/ab.sen_g_bordrad.png')" type="image/x-icon">
    <style>
    body {
        min-height: 100vh;
        background: linear-gradient(135deg, #f7e3c4 0%, #fff 40%, #f6ebeb 100%);
        font-family: 'Montserrat Alternates', sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin: 0;
        padding: 2rem;
    }

    .top-buttons {
        position: absolute;
        top: 20px;
        right: 30px;
        display: flex;
        gap: 10px;
    }

    .btn {
        background: #fff;
        color: #000;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 500;
        border: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        transition: 0.3s ease;
    }

    .btn:hover {
        background: #e02600;
        color: #fff;
        border-radius: 10px;
        padding: 8px 20px;
        font-weight: 500;
        border: none;
        box-shadow: 0 2px 6px rgba(255, 40, 0, 0.4);
        transition: 0.3s ease;
    }

    .logo {
        max-width: 100px;
        margin-bottom: 10px;
    }

    .brand-name {
        font-size: 1.5rem;
        font-weight: 500;
        color: #FF4B19;
        margin-bottom: 2rem;
    }

    h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        color: #000;
    }

    h2 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #000;
        margin-bottom: 1.5rem;
    }

    p {
        font-size: 1rem;
        max-width: 650px;
        margin: 0 auto;
        line-height: 1.6;
        color: #656;
    }
    </style>
</head>

<body>
    <!-- top right buttons -->
    <div class="top-buttons">
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="registerDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                Register
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="registerDropdown">
                <li><a class="btn dropdown-item" href="{{ route('user.register') }}?role=user">Users</a></li>
                <li><hr></li>
                <li><a class="btn dropdown-item" href="{{ route('admin.register') }}?role=admin">Admin</a></li>
            </ul>
        </div>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" id="registerDropdown" data-bs-toggle="dropdown"
                aria-expanded="false">
                Login
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="registerDropdown">
                <li><a class="btn dropdown-item" href="{{ route('user.login') }}?role=user">Users</a></li>
                <li><hr></li>
                <li><a class="btn dropdown-item" href="{{ route('admin.login') }}?role=admin">Admin</a></li>
            </ul>
        </div>
    </div>


    <!-- center content -->
    <div class="text-center">
        <img src="{{ asset('assets/ab.sen_g_trans.png') }}" alt="Absen Logo" class="logo">
        <div class="brand-name">Ab.sen</div>

        <h1>Ab.sen, Website Presensi Online.</h1>
        <h2>Absensi dengan Mudah. Dimanapun. Kapanpun.</h2>

        <p>
            Ab.sen adalah website presensi online yang dirancang untuk memudahkan pencatatan kehadiran secara cepat,
            akurat, dan fleksibel. Dengan sistem berbasis web, pengguna dapat melakukan absensi dari mana saja tanpa
            perlu aplikasi tambahan.
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

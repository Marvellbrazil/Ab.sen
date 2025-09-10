<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ab.sen | Website Presensi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="assets/favicon.png" type="image/x-icon">
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
        position: relative;
    }

    .top-buttons {
        position: absolute;
        top: 20px;
        right: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: flex-end;
        gap: 10px;
        z-index: 1000;
        max-width: 100%;
    }

    .btn {
        background: #fff;
        color: #000;
        border-radius: 10px;
        padding: 10px 24px;
        font-weight: 500;
        border: none;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.20);
        transition: 0.3s ease;
        font-size: 0.9rem;
        white-space: nowrap;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn:hover {
        background: #e02600;
        color: #fff;
        box-shadow: 0 4px 18px rgba(255, 30, 0, 0.5);
    }

    /* Custom dropdown arrow styling */
    .dropdown-toggle {
        position: relative;
        padding-right: 30px !important;
    }

    .dropdown-toggle::after {
        display: inline-block;
        margin-left: 8px;
        vertical-align: middle;
        content: "";
        border-top: 0.35em solid;
        border-right: 0.35em solid transparent;
        border-bottom: 0;
        border-left: 0.35em solid transparent;
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        transition: transform 0.3s ease;
    }

    .dropdown-toggle.show::after {
        transform: translateY(-50%) rotate(-180deg);
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
        color: #454;
        letter-spacing: 0.08rem;
    }

    /* Mobile responsiveness */
    @media (max-width: 768px) {
        body {
            padding: 5rem 1.5rem 2rem;
        }

        .top-buttons {
            top: 10px;
            right: 10px;
            left: 10px;
            justify-content: center;
        }

        .btn {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        h1 {
            font-size: 1.5rem;
        }

        h2 {
            font-size: 1rem;
        }

        p {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .top-buttons {
            flex-direction: column;
            align-items: center;
            gap: 8px;
        }

        .dropdown {
            width: 100%;
            max-width: 200px;
        }

        .dropdown-toggle {
            width: 100%;
        }

        .dropdown-menu {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <!-- top right buttons -->
    <div class="top-buttons">
        <a class="btn btn-primary" href="/register">Register</a>
        <a class="btn btn-primary" href="/login">Login</a>
    </div>
    </div>

    <!-- center content -->
    <div class="center-content text-center">
        <img src="assets/ab.sen_g_trans.png" alt="Absen Logo" class="logo">
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

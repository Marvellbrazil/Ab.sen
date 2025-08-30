<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda - Ab.sen')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @if (session('success'))
    <script>
    alert("{{ session('success') }}");
    </script>
    @endif
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh;">
        <h1 class="p-3 bg-light rounded">Selamat Datang di Ab.sen</h1>
    </div>
    <div class="d-flex justify-content-center align-items-center" style="height: 100vh">
        <a href="{{ url('/login') }}" class="btn btn-primary">Login</a>
        <a href="{{ url('/register') }}" class="btn btn-primary">Register</a>
        <a href="{{ url('/contact') }}" class="btn btn-primary">Contact</a>
        <a href="{{ url('/about') }}" class="btn btn-primary">About</a>
        <a href="{{ url('/contact') }}" class="btn btn-primary">Contact</a>
        <a href="{{ url('/logout') }}" class="btn btn-primary">Logout</a>
        <a href="{{ url('/admin') }}" class="btn btn-primary">Admin</a>
        <a href="{{ url('/admin/contact') }}" class="btn btn-primary">Admin Contact</a>
        <a href="{{ url('/admin/about') }}" class="btn btn-primary">Admin About</a>
        <a href="{{ url('/admin/login') }}" class="btn btn-primary">Admin Login</a>
        <a href="{{ url('/admin/register') }}" class="btn btn-primary">Admin Register</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

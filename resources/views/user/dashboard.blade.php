<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda - Ab.sen')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="@yield('favicon', 'assets/favicon.png')" type="image/x-icon">
    <style>

    </style>
</head>

<body>
    @if (session('success'))
    <script>
    window.onload = function() {
        alert("{{ session('success') }}");
    };
    </script>
    @endif
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

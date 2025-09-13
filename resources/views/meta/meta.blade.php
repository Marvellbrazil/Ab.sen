@php
$author = "Marvello Faisal";
$title = "Ab.sen | Website Presensi Online";
$desc = "Manajemen presensi online berbasis website secara mudah dan praktis.";
$image = asset('assets/ab.sen_g-t.png');
@endphp

<meta name="description" content="{{ $desc }}">
<meta name="author" content="{{ $author }}">
<meta name="keywords" content="">
<meta name="robots" content="index, follow">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- <meta name="theme-color" content=""> -->

<!-- <meta http-equiv="refresh" content="5; url=https://example.com"> -->

<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $desc }}">
<meta property="og:image" content="{{ $image }}">
<!-- <meta property="og:url" content="https://example.com"> -->

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $desc }}">
<meta name="twitter:image" content="{{ $image }}">

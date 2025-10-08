<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>@yield('title','Lab 01')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
      table { border-collapse: collapse; width: 100%; }
      th, td { border: 1px solid #ddd; padding: 8px; }
      th { background: #f3f4f6; text-align: left; }
      .adult { font-weight: 600; }
      nav a { margin-right: 8px; }
      .flash { padding:8px; background:#DCFCE7; border-radius:6px; margin-bottom:12px; }
    </style>
</head>
<body>
<header>
    @include('partials.header')
    <hr>
</header>

<main>
    @if(session('success'))
        <div class="flash">{{ session('success') }}</div>
    @endif
    @yield('content')
</main>

<footer>
    <hr>
    <small>&copy; HUIT - Khoa CNTT</small>
</footer>
</body>
</html>

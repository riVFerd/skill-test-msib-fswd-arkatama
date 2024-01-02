<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @yield('styles')
</head>
<body class="container flex flex-col justify-center items-center min-h-screen bg-pink-500">
@yield('content')
@yield('scripts')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SaverApp | Masuk</title>
    <link rel="shortcut icon" href="{{ asset('resources/image/logosaver.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
    </style>
</head>
<body class="font-jakarta">
    @include('sweetalert::alert')
    <div class="">
        @yield('form')
    </div>

</body>
</html>
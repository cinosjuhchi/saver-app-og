<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SaverApp | {{ $title }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{ asset('resources/image/logosaver.png') }}" type="image/x-icon">
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');


        /* Menyembunyikan scrollbar */
        ::-webkit-scrollbar {
            width: 0;  /* Width of the entire scrollbar */
            height: 0; /* Height of the entire scrollbar */
        }
        /* Optional: menambahkan style lain pada track scrollbar */
        ::-webkit-scrollbar-track {
            background: transparent; /* Make the scrollbar transparent */
        }
        
    </style>
</head>
<body class="bg-putihneut2 font-jakarta">
    @include('sweetalert::alert')
    <div class="mx-10 my-6">
        <div class="card border border-dark block rounded-md p-4">
            <h3 class="font-extrabold truncate bg-clip-text text-transparent bg-gradient-to-r from-birumuda to-birutua text-2xl text-center lg:text-left">Saver App | {{ $folder->title }}</h3>
        </div>
        @yield('content')
    </div>
</body>
</html>

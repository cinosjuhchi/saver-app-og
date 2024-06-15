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

    @if($title != 'Archive' && $title != 'Favorite')
    @include('component/modal/upload-mobile')
    @endif

    <div class="flex">
        <div class="lg:fixed lg:top-0 lg:h-screen lg:w-auto absolute bg-putihneut2 w-full lg:overflow-y-auto">
             @include('component.sidebar.sidebar')
        </div>
        <div class="flex-1 mx-6 mb-6 main-content mt-[96px] lg:mt-0 lg:ml-[364px]">
            <nav class="nav sticky top-0 z-40 bg-putihneut2 pt-6 pb-4 hidden lg:block">
                @include('component.navbar.navbar-home')
            </nav>
            @yield('content')
        </div>
    </div>

    

</body>
</html>

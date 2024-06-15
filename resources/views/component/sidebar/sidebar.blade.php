<style>
    /* Tambahkan animasi untuk slide in dari kiri */
    @keyframes slideInLeft {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(0);
        }
    }

    /* Tambahkan animasi untuk slide out ke kanan */
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
        }
        to {
            transform: translateX(-100%);
        }
    }

    /* Tambahkan transisi */
    .sidebar {
        transition: transform 0.3s ease-in-out;
    }

    /* Tambahkan kelas untuk animasi slide in */
    .sidebar.slideInLeft {
        animation: slideInLeft 0.3s forwards;
    }

    /* Tambahkan kelas untuk animasi slide out */
    .sidebar.slideOutRight {
        animation: slideOutRight 0.3s forwards;
    }

    /* Tambahkan class untuk mengatur tampilan sidebar di layar besar */
    @media screen and (min-width: 1024px) {
        .sidebar {
          visibility: visible;
        }
    }
</style>

<!-- component -->

<div class="nav-mobile px-6 w-full py-6 lg:hidden sticky top-0 z-40 bg-putihneut2">
    <div class="nav flex gap-3 items-center justify-center">
        <span class="text-white text-4xl cursor-pointer open-sidebar">
            <i class="bi bi-filter-left px-2 bg-birumuda rounded-md"></i>
        </span>

        <div class="flex items-center rounded-md px-4 duration-300 cursor-pointer bg-slate-200 text-gray search w-full h-100 py-3 m-0">
            @if($title == 'Beranda' || $title == 'Photo' || $title == 'Folder' || $title == 'Archive' || $title == 'Favorite')
        <form id="searchForm" action="{{ route('search-files') }}" method="GET">
        @else
        <form id="searchForm" action="{{ route('folder.search-files') }}" method="GET">
        @endif
        <input type="hidden" name="title_search" value="{{ $title }}">
        <input type="hidden" name="parent" value="{{ $folder->id }}">
        <input class="outline-none w-full bg-slate-100 rounded-md bg-transparent group/search " type="text" name="search_title" placeholder="Cari di SaverApp" id="search_title">
        </form>
        </div>
    </div>
</div>

<div class="sidebar hidden fixed h-screen top-0 bottom-0 lg:left-0 py-4 px-5 md:w-1/3 sm:w-1/2 lg:w-[340px] overflow-y-visible text-center bg-neutral-50 ease-in-out z-50">
    <div class="mt-1 flex items-center justify-between mb-3">
        <h1 class="font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-birumuda to-birutua text-2xl">SaverApp</h1>
        <i class="bi bi-x-circle cursor-pointer text-black lg:hidden close-sidebar"></i>
    </div>
    <div class="my-2 bg-gray-600 h-[1px]"></div>

    <div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-slate-100 text-gray search my-4">
        @if($title == 'Beranda' || $title == 'Photo' || $title == 'Folder' || $title == 'Archive' || $title == 'Favorite')
        <form id="searchForm" action="{{ route('search-files') }}" method="GET">
        @else
        <form id="searchForm" action="{{ route('folder.search-files') }}" method="GET">
        @endif
        <input type="hidden" name="title_search" value="{{ $title }}">
        <input type="hidden" name="parent" value="{{ $folder->id }}">
        <input class="outline-none w-full bg-slate-100 rounded-md bg-transparent group/search " type="text" name="search_title" placeholder="Cari di SaverApp" id="search_title">
        </form>
    </div>

    <a href="/">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gradient-to-l from-birumuda to-birutua hover:text-neutral-100 {{ $title === "Beranda" ? "bg-gradient-to-l from-birumuda to-birutua text-neutral-100" : "" }}">
            <i class="bi bi-house-door"></i>
            <span class="ml-4 text-dark-200 font-bold">Beranda</span>
        </div>
    </a>

    <a href="{{ route('all-photo') }}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gradient-to-l from-birumuda to-birutua hover:text-neutral-100 {{ $title === "Photo" ? "bg-gradient-to-l from-birumuda to-birutua text-neutral-100" : "" }}">
            <i class="bi bi-images font-bold"></i>
            <span class="ml-4 text-dark-200 font-bold">Foto</span>
        </div>
    </a>

    <a href="{{ route('all-folder') }}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gradient-to-l from-birumuda to-birutua hover:text-neutral-100 {{ $title === "Folder" || $identity === "show" ? "bg-gradient-to-l from-birumuda to-birutua text-neutral-100" : "" }}">
            <i class="bi bi-folder font-bold"></i>
            <span class="ml-4 text-dark-200 font-bold">Folder</span>
        </div>
    </a>

    <a href="{{ route('all-archive') }}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gradient-to-l from-birumuda to-birutua hover:text-neutral-100 {{ $title === "Archive" ? "bg-gradient-to-l from-birumuda to-birutua text-neutral-100" : "" }}">
            <i class="bi bi-archive font-bold"></i>
            <span class="ml-4 text-dark-200 font-bold">Arsip</span>
        </div>
    </a>

    <a href="{{ route('all-favorite') }}">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gradient-to-l from-birumuda to-birutua hover:text-neutral-100 {{ $title === "Favorite" ? "bg-gradient-to-l from-birumuda to-birutua text-neutral-100" : "" }}">
            <i class="bi bi-star font-bold"></i>
            <span class="ml-4 text-dark-200 font-bold">Favorit</span>
        </div>
    </a>

    <a href="/logout">
        <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-red-500 group">
            <i class="bi bi-box-arrow-in-right text-red-500 group-hover:text-neutral-100"></i>
            <span class="ml-4 text-red-500 font-bold group-hover:text-neutral-100">Logout</span>
        </div>
    </a>
</div>

<script>
    const openSidebarButton = document.querySelector('.open-sidebar');
    const closeSidebarButton = document.querySelector('.close-sidebar');
    const sidebar = document.querySelector('.sidebar');

    openSidebarButton.addEventListener('click', function() {
        sidebar.classList.remove('hidden');
        sidebar.classList.remove('slideOutRight');
        sidebar.classList.add('slideInLeft');
    });

    closeSidebarButton.addEventListener('click', function() {
        sidebar.classList.remove('slideInLeft');
        sidebar.classList.add('slideOutRight');

        setTimeout(function() {
            sidebar.classList.add('hidden');
        }, 300);
    });

    // Check screen size and show/hide sidebar accordingly
    function toggleSidebarVisibility() {
        const lgScreenWidth = 1024;
        const screenWidth = window.innerWidth;

        if (screenWidth >= lgScreenWidth) {
            sidebar.classList.remove('hidden');
        } else {
            sidebar.classList.add('hidden');
        }
    }

    // Initial check on page load
    toggleSidebarVisibility();

    // Listen for window resize events
    window.addEventListener('resize', toggleSidebarVisibility);
</script>

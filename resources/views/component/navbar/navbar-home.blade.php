<div class="hidden lg:block">
<div class="search bg-white rounded-md outline-none py-4 shadow-sm flex justify-between items-center px-9">
    <h3 class="font-extrabold truncate max-w-[20rem] bg-clip-text text-transparent bg-gradient-to-r from-birumuda to-birutua text-2xl">{{ $title }}</h3>
    @if($title != 'Ganti Penyimpanan')
    <div class="p-2 flex items-center justify-content-between rounded-md px-4 duration-300 cursor-pointer bg-slate-100 w-1/2 text-gray gap-2 group/search">
        <i
        class="bi bi-search cursor-pointer text-indigo-95 group-focus-within/search:text-blue-700"
      ></i>
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
    @endif
    <div class="w-auto">
        @if($title != 'Ganti Penyimpanan')
        @include('component.button-dropdown.button')
        @else
        <div class="relative z-10" id="dropdownButton1">
            <form action="{{ route('update-directory') }}" method="post">
            @csrf
                <input type="hidden" name="id_parent" value="{{ $parent->id }}">
                <input type="hidden" name="content" value="{{ $content }}">
                <input type="hidden" name="type" value="{{ $type }}">
                <button type="submit" class="text-white px-2 py-2 ms-2 font-bold text-center rounded-md bg-birumuda" onclick="toggleDropdown('dropdown1')">
                    <i class="bi bi-folder-symlink-fill text-white"></i>
                    Pindahkan disini
                </button>
            </form>
        </div>
        @endif
    </div>
</div>
</div>
<script>
    document.getElementById('search_title').addEventListener('submit', function() {
        document.getElementById('searchForm').submit();
    });
</script>


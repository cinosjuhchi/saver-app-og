<div class="filter lg:mt-2">
    <h1 class="font-bold">Filter</h1>

    <div class="flex gap-2 flex-nowrap">
        @if($title !== "Photo" && $title !== "Folder")
        <div class="flex gap-2 mt-1 flex-nowrap">
            @if($title == 'Beranda')
            <form action="{{ route('dashboard.filter') }}" method="GET">
            @elseif($title == 'Archive')
            <form action="{{ route('archive.filter') }}" method="GET">
            @elseif($title == 'Favorite')
            <form action="{{ route('favorite.filter') }}" method="GET">
            @elseif($identity == 'show')
            <form action="{{ route('folder.filter', ['slug' => $folder->slug]) }}" method="GET">
            @endif
                @csrf
                <input type="hidden" name="filter" value="{{ $filterActive == 'photo' ? null : 'photo' }}">
                <input type="hidden" name="loc" value="{{ $title === 'Beranda' ? 1 : $folder->id}}">
                <input type="hidden" name="parent_folder_id" value="{{ $title == 'Beranda' ? 1 : $folder->id }}">
                <button class="px-4 py-1 rounded-md font-bold {{ $filterActive == 'photo' ? 'bg-birumuda hover:bg-white hover:text-birumuda text-white' :  'bg-white hover:bg-birumuda hover:text-white'}}  transition text-sm lg:px-8" type="submit">
                    Foto
                </button>
            </form>
            @if($title == 'Beranda')
            <form action="{{ route('dashboard.filter') }}" method="GET">
            @elseif($title == 'Archive')
            <form action="{{ route('archive.filter') }}" method="GET">
            @elseif($title == 'Favorite')
            <form action="{{ route('favorite.filter') }}" method="GET">
            @elseif($identity == 'show')
            <form action="{{ route('folder.filter', ['slug' => $folder->slug]) }}" method="GET">
            @endif
                @csrf
                <input type="hidden" name="filter" value="{{ $filterActive == 'folder' ? null : 'folder' }}">
                <input type="hidden" name="loc" value="{{ $title === 'Beranda' ? 1 : $folder->id}}">
                <input type="hidden" name="parent_folder_id" value="{{ $title == 'Beranda' ? 1 : $folder->id }}">
                <button class="px-4 py-1 rounded-md font-bold {{ $filterActive == 'folder' ? 'bg-birumuda hover:bg-white hover:text-birumuda text-white' :  'bg-white hover:bg-birumuda hover:text-white'}} transition text-sm lg:px-8">
                    Folder
                </button>
            </form>
        </div>
        @endif
        <div class="flex gap-2 mt-1 flex-nowrap">
            @include('component.button-dropdown.button-filter')
        </div>
    </div>
</div>

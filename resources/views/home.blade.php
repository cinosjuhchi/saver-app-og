@extends('layouts.home')
@section('content')
    @include('component.filter.filter-file-folder')

    @if($photos->isEmpty() && $folders->isEmpty())
        <div class="flex justify-center mt-12">
            @include('component.blank.nothing')
        </div>
    @else    
<div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-y-5 gap-x-4 mt-6">
    @if($title == 'Beranda' || $title == 'Photo' || $title == 'Archive' || $title == 'Favorite' )
    @foreach ($photos as $photo)
        
        <div class="group">
            <div class="relative">
                <div class="card-file bg-white rounded-md p-3 group-hover:bg-gray-200 transition-all flex flex-col">
                    <a href="{{ route('preview', ['slug' => $photo->slug]) }}" class="cursor-pointer flex flex-col flex-grow">
                        <img src="{{ asset('storage/' . $photo->image_location) }}" alt="" class="rounded-md h-60 object-cover w-full">
                        <div class="headline flex items-center justify-between mt-3">
                            <div class="title truncate overflow-hidden flex-grow max-w-[15rem]">
                                <h1 class="font-bold text-sm">{{ $photo->title }}</h1>
                                <p class="text-xs text-gray-400">{{ $photo->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="dropdown-container hidden absolute z-10 top-72 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-md">
                                <!-- Dropdown content here -->
                                <!-- Example dropdown content: -->
                                <div class="rounded border-gray-300 bg-white shadow-md p-2 text-sm transition-all">
                                    <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openRename" onclick="openRename(event)" data-id="{{ $photo->id }}" data-type="photo" data-title="{{ $photo->title }}"><i class="bi bi-pencil-square"></i>Ganti nama</a>                                
                                    <a href="{{ $photo->status == 'favorite' ? route('unstatus-photo', ['id' => $photo->id]) : route('favorite-photo', ['id' => $photo->id]) }}" class="hover:bg-slate-200 px-3 py-2 {{ $photo->status == 'favorite' ? 'text-yellow-500 font-bold' : '' }} rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-star{{ $photo->status == 'favorite' ? '-fill' : '' }}"></i>{{ $photo->status == 'favorite' ? 'Hapus dari Favorit' : 'Tambahkan ke Favorit' }}</a>                                                                                      
                                    <a href="{{ $photo->status == 'archive' ? route('unstatus-photo', ['id' => $photo->id]) : route('archive-photo', ['id' => $photo->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-archive"></i>{{ $photo->status == 'archive' ? 'Hapus dari Arsip' : 'Tambahkan ke Arsip' }}</a>  
                                    <a href="{{ route('download-image', ['slug' => $photo->slug]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-download"></i>Download</a>                                
                                    <a href="{{ route('change-directory', ['id_parent' => 1, 'type' => 'photo', 'content' => $photo->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openFolder"><i class="bi bi-folder-symlink"></i>Pindahkan</a>                                        
                                    <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" onclick="copyShare(event)" data-type="photo" data-link="{{ $photo->shares->link }}"><i class="bi bi-link-45deg"></i>Bagikan Link</a>                                        
                                    <a href="{{ route('delete-photo', ['id' => $photo->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer text-red-500" id=""><i class="bi bi-trash"></i>Hapus</a>                                
                                </div>
                            </div>
                            <button class="toggle-dropdown bg-white p-1 rounded-full hover:bg-gray-100 transition flex items-center justify-center">
                                <i class="bi bi-three-dots-vertical text-gray-700 group-hover:text-gray-900"></i>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    @endforeach
    @endif


    @if($title == 'Beranda' || $title == 'Folder' || $title == 'Archive' || $title == 'Favorite' )
    @foreach ($folders as $folder)
        
        <div class="group">
            <div class="relative">
                <div class="card-folder bg-white rounded-md p-3 group-hover:bg-neutral-200 transition-all flex flex-col">
                    <a href="{{ route('folder-show', ['slug' => $folder->slug]) }}" class="cursor-pointer flex flex-col flex-grow">
                        <img src="{{ asset('resources/image/folder_img.png') }}" alt="" class="rounded-sm h-60 object-contain scale-75 w-full">
                        <div class="headline flex items-center justify-between mt-3">
                            <div class="title truncate text-overflow-ellipsis overflow-hidden flex-grow max-w-[10rem]">
                                <h1 class="font-bold text-sm">{{ $folder->title }}</h1>
                                <p class="text-xs text-neutral-400">{{ $folder->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="dropdown-container hidden absolute z-10 top-72 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-md">
                                <!-- Dropdown content here -->
                                <!-- Example dropdown content: -->
                                <div class="rounded border-gray-300 bg-white shadow-md p-2 text-sm transition-all">
                                    <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openRename" onclick="openRename(event)" data-id="{{ $folder->id }}" data-type="folder" data-title="{{ $folder->title }}"><i class="bi bi-pencil-square" data-title="{{ $folder->title }}"></i>Ganti nama</a>
                                    <a href="{{ $folder->status == 'favorite' ? route('unstatus-folder', ['id' => $folder->id]) : route('favorite-folder', ['id' => $folder->id]) }}" class="hover:bg-slate-200 px-3 py-2 {{ $folder->status == 'favorite' ? 'text-yellow-500 font-bold' : '' }} rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-star{{ $folder->status == 'favorite' ? '-fill' : '' }}"></i>{{ $folder->status == 'favorite' ? 'Hapus dari Favorit' : 'Tambahkan ke Favorit' }}</a>                                                   
                                    <a href="{{ $folder->status == 'archive' ? route('unstatus-folder', ['id' => $folder->id]) : route('archive-folder', ['id' => $folder->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-archive"></i>{{ $folder->status == 'archive' ? 'Hapus dari Arsip' : 'Tambahkan ke Arsip' }}</a>                                
                                    <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" href="{{ route('download-zip', ['id' => $folder->id]) }}" id=""><i class="bi bi-download"></i>Download</a>                                
                                    <a href="{{ route('change-directory', ['id_parent' => 1, 'type' => 'folder', 'content' => $folder->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openFolder"><i class="bi bi-folder-symlink"></i>Pindahkan</a>                                        
                                    <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" onclick="copyShare(event)" data-type="folder" data-link="{{ $folder->shares->link }}"><i class="bi bi-link-45deg"></i>Bagikan Link</a>                                        
                                    <a href="{{ route('delete-folder', ['id' => $folder->id]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer text-red-500" id=""><i class="bi bi-trash"></i>Hapus</a>                             
                                </div>
                            </div>
                            <button class="toggle-dropdown bg-white p-1 rounded-full hover:bg-gray-100 transition flex items-center justify-center">
                                <i class="bi bi-three-dots-vertical text-gray-700 group-hover:text-gray-900"></i>
                            </button>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    @endforeach
    @endif
@endif
        
</div>
<!-- JS Dropdown -->
@include('js.copyText')
@include('component.button-dropdown.js-dots')
@include('component.modal.rename')
@endsection

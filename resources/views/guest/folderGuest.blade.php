@extends('layouts.guest')
@section('content')
    @if ($subFolders->isEmpty() && $photos->isEmpty())
        <div class="flex justify-center mt-12">
            @include('component.blank.nothing')
        </div>
    @else

<div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-y-5 gap-x-4 mt-6">
    @foreach ($subFolders as $subFolder)
    <div class="group">
        <div class="relative">
            <div class="card-folder bg-white rounded-md p-3 group-hover:bg-neutral-200 transition-all flex flex-col">
                <a href="{{ route('subFolder.guest', ['parent' => $origin, 'link' => $subFolder->shares->link]) }}" class="cursor-pointer flex flex-col flex-grow">
                    <img src="{{ asset('resources/image/folder_img.png') }}" alt="" class="rounded-sm h-60 object-contain scale-75 w-full">
                    <div class="headline flex items-center justify-between mt-3">
                        <div class="title truncate text-overflow-ellipsis overflow-hidden flex-grow max-w-[10rem]">
                            <h1 class="font-bold text-sm">{{ $subFolder->title }}</h1>
                            <p class="text-xs text-neutral-400">{{ $subFolder->created_at }}</p>
                        </div>
                        <div class="dropdown-container hidden absolute z-10 top-72 right-0 mt-1 bg-white border border-gray-200 rounded-md shadow-md">
                            <!-- Dropdown content here -->
                            <!-- Example dropdown content: -->
                            <div class="rounded border-gray-300 bg-white shadow-md p-2 text-sm transition-all">                                                            
                                <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" href="{{ route('download-zip', ['id' => $subFolder->id]) }}" id=""><i class="bi bi-download"></i>Download</a>                                                    
                                <a class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openFolder"><i class="bi bi-link-45deg"></i>Bagikan link</a>                                                                        
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


    @foreach ($photos as $photo)
    <div class="group">
        <div class="relative">
            <div class="card-file bg-white rounded-md p-3 group-hover:bg-gray-200 transition-all flex flex-col">
                <a href="{{ route('preview.guest', ['link' => $photo->shares->link]) }}" class="cursor-pointer flex flex-col flex-grow">
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
                                <a href="{{ route('download-image', ['slug' => $photo->slug]) }}" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id=""><i class="bi bi-download"></i>Download</a>                                                            
                                <a href="" class="hover:bg-slate-200 px-3 py-2 rounded-sm flex justify-start items-center gap-2 w-full cursor-pointer" id="openFolder"><i class="bi bi-link-45deg"></i>Bagikan link</a>                                        
                                
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
    @endif()

    
</div>
@include('component.button-dropdown.js-dots')

@endsection
@extends('layouts.home')
@section('content')
@if($parent->id != 1)
@include('component.breadcrumb.bread')
@endif
<div class="grid lg:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-y-5 gap-x-4 mt-6">
    @foreach ($subFolders as $subFolder)
    <div class="group">
        <div class="relative">
            <div class="card-folder bg-white rounded-md p-3 group-hover:bg-neutral-200 transition-all flex flex-col">
                <a href="{{ route('change-directory', ['id_parent' => $subFolder->id, 'type' => $type, 'content' => $content]) }}" class="cursor-pointer flex flex-col flex-grow">
                    <img src="{{ asset('resources/image/folder_img.png') }}" alt="" class="rounded-sm h-60 object-contain scale-75 w-full">
                    <div class="headline flex items-center justify-between mt-3">
                        <div class="title truncate text-overflow-ellipsis overflow-hidden flex-grow max-w-[10rem]">
                            <h1 class="font-bold text-sm">{{ $subFolder->title }}</h1>
                            <p class="text-xs text-neutral-400">{{ $subFolder->created_at }}</p>
                        </div>                    
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
                <a href="" class="cursor-pointer flex flex-col flex-grow">
                    <img src="{{ asset('storage/' . $photo->image_location) }}" alt="" class="rounded-md h-60 object-cover w-full">
                    <div class="headline flex items-center justify-between mt-3">
                        <div class="title truncate overflow-hidden flex-grow max-w-[15rem]">
                            <h1 class="font-bold text-sm">{{ $photo->title }}</h1>
                            <p class="text-xs text-gray-400">{{ $photo->created_at->diffForHumans() }}</p>
                        </div>                        
                    </div>
                </a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
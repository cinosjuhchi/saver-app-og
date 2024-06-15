<div class="relative z-10" id="dropdownButton1">
    <button class="text-white px-6 py-2 font-bold text-center rounded-md bg-birumuda" onclick="toggleDropdown('dropdown1')">
        <i class="bi bi-plus-lg text-base text-white"></i>
        Baru
    </button>

    <div class="rounded border-gray-300 bg-white shadow-md mt-1 p-2 absolute text-sm font-semibold hidden transition-all" id="dropdown1">
        <button class="hover:bg-slate-200 px-3 py-2 rounded-sm flex gap-2 w-full cursor-pointer" id="openFolder"><i class="bi bi-folder"></i>Tambahkan Folder</button>
        <button class="hover:bg-slate-200 px-3 py-2 rounded-sm flex gap-2 w-full cursor-pointer" id="openModal"><i class="bi bi-image"></i>Upload Foto</button>
    </div>
</div>

<!-- Modal Upload -->

@include("component.modal.image-form-modal")
@include("component.modal.folder-form-modal")
{{-- @include("component.modal.changeFolder-form") --}}

<!-- Js -->
@include("component.button-dropdown.js-upload")



<div class="fixed bottom-6 right-6 z-50 lg:hidden block ">
    @if($title != 'Ganti Penyimpanan')
    <button class="text-white font-bold text-center rounded-md bg-birumuda" id="openMobileUp" onclick="openMobileUp()">
        <i class="bi bi-plus px-2 bg-birumuda rounded-md text-4xl"></i>
    </button>
    @else
    <form action="{{ route('update-directory') }}" method="post">
        @csrf
            <input type="hidden" name="id_parent" value="{{ $parent->id }}">
            <input type="hidden" name="content" value="{{ $content }}">
            <input type="hidden" name="type" value="{{ $type }}">
            <button type="submit" class="text-white px-4 py-2 ms-2 font-bold text-center rounded-md bg-birumuda"            onclick="toggleDropdown('dropdown1')">
                <i class="bi bi-folder-symlink-fill text-white"></i>                    
            </button>
        </form>
    @endif
</div>

<div id="mobileUp" class="modal hidden fixed bg-slate-600 bg-opacity-50 h-screen inset-0 z-50 w-full">
    <div class="h-screen flex flex-1 justify-center items-center rounded-md text-center">
        <div class="modal-content bg-white py-6 px-6 w-10/12 sm:w-1/2 rounded-md items-center relative">
            <!-- Modal Header -->
            <div class="modal-header mb-5">
                <h1 class="text-lg font-bold">Buat Folder baru atau<br>Upload Foto baru</h3>
                <button id="closeMobileUp" onclick="closeMobileUp()" class="modal-close absolute -top-3 -right-3">
                    <i class="bi bi-x-lg bg-black text-white px-1 text-2xl rounded-full"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <button class="border border-black transition-all mb-2 px-4 py-2 rounded-md flex gap-2 w-full cursor-pointer font-medium" id="openFolderDup"><i class="bi bi-folder"></i>Tambahkan Folder</button>

                <button class="border border-black transition-all px-4 py-2 rounded-md flex gap-2 w-full cursor-pointer font-medium" id="openModalDup"><i class="bi bi-image"></i>Upload Foto</button>
            </div>
        </div>
    </div>
    
    <!-- Modal Upload -->
    @include("component.modal.image-form-mobile")
    @include("component.modal.folder-form-mobile")
</div>

<script>
    const mobileUp = document.getElementById('mobileUp');
    const openMobileUpButton = document.getElementById('openMobileUp');
    const closeMobileUpButton = document.getElementById('closeMobileUp');

    function openMobileUp() {
        mobileUp.classList.remove('hidden');
    }

    function closeMobileUp() {
        mobileUp.classList.add('hidden');
    }
</script>

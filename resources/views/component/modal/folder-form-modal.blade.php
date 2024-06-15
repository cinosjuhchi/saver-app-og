<div id="folderModal" class="modal hidden fixed bg-slate-600 bg-opacity-50 h-screen inset-0 z-50 w-full">
    <div class="h-screen flex flex-1 justify-center items-center text-center rounded-md">
        <div class="modal-content bg-white py-4 px-6 w-1/3 items-center rounded-md relative">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-lg font-semibold mb-4">Buat folder baru</h3>
                <button id="closeFolder" class="modal-close absolute -top-3 -right-3">
                    <i class="bi bi-x-lg bg-black text-white px-1 text-2xl rounded-full"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadForm" name="title" action="{{ route('add-folder') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="parent_folder_id" value="{{ $title == 'Beranda' || $title == 'Photo' || $title == 'Folder' || $title == 'Archive' ? 1 : $folder->id }}">
                    <input type="text" id="textFolder" name="title" class="border border-gray-300 p-2 mb-4 rounded-md placeholder:text-sm w-full" placeholder="Masukkan nama folder" required>
                    <button type="submit" class="bg-birumuda hover:bg-birutua transition-all text-white font-bold py-2 px-4 rounded">Tambahkan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const folder = document.getElementById('folderModal');
    // Get open modal button
    const openFolderBtn = document.getElementById('openFolder');
    // Get close modal button

    const closeFolderBtn = document.getElementById('closeFolder');

    function openFolder() {
        folder.classList.remove('hidden');
    }

    // Function to close folder
    function closeFolder() {
        folder.classList.add('hidden');
    }

    openFolderBtn.addEventListener('click', openFolder);
    // Event listener for close modal button
    closeFolderBtn.addEventListener('click', closeFolder);

    // Close modal when clicking outside of it
    window.addEventListener('click', (e) => {
        if (e.target === folder) {
            closeFolder();
        }
    });

    // Prevent modal from closing when clicking inside it
    folder.addEventListener('click', (e) => {
        e.stopPropagation();
    });
</script>



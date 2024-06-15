<!-- Mobile -->
<div id="imageModalDup" class="modal hidden fixed bg-slate-600 bg-opacity-50 h-screen inset-0 z-50 ">
    <div class="h-screen flex flex-1 justify-center items-center text-center rounded-md">
        <div class="modal-content bg-white py-4 px-6 w-10/12 md:w-1/2 items-center rounded-md relative">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-lg font-semibold mb-2">Upload Foto</h3>
                <button id="closeModalDup" class="modal-close absolute -top-3 -right-3">
                    <i class="bi bi-x-lg bg-black text-white px-1 text-2xl rounded-full"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadForm" action="{{ route('upload-photo') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="parent_folder_id" value="{{ $title == 'Beranda' || $title == 'Photo' || $title == 'Folder' || $title == 'Archive' ? 1 : $folder->id }}">
                    <input type="file" id="imageUploadDup" name="image_location[]" class="border p-1 border-gray-300 mb-4 rounded-md w-full placeholder:text-sm" multiple required>
                    <button type="submit" class="bg-birumuda hover:bg-birutua transition-all text-white font-bold py-2 px-4 rounded">Upload</button>
                </form>
            </div>
            </div>
    </div>
</div>

<!-- Javascript -->
<script>
    // Get modal element
    const modalDup = document.getElementById('imageModalDup');
    // Get open modal button
    const openModalBtnDup = document.getElementById('openModalDup');
    const closeModalBtnDup = document.getElementById('closeModalDup');

    // Function to open modal
    function openModalDup() {
        modalDup.classList.remove('hidden');
    }

    // Function to close modal
    function closeModalDup() {
        modalDup.classList.add('hidden');
    }

    // Event listener for open modal button
    openModalBtnDup.addEventListener('click', openModalDup);
    // Event listener for close modal button
    closeModalBtnDup.addEventListener('click', closeModalDup);

    // Close modal when clicking outside of it
    window.addEventListener('click', (e) => {
        if (e.target === modalDup) {
            closeModalDup();
        }
    });

    // Prevent modal from closing when clicking inside it
    modalDup.addEventListener('click', (e) => {
        e.stopPropagation();
    });
</script>

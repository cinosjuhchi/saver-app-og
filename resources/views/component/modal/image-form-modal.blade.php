<div id="imageModal" class="modal hidden fixed bg-slate-600 bg-opacity-50 h-screen inset-0 z-50">
    <div class="h-screen flex flex-1 justify-center items-center text-center rounded-lg">
        <div class="modal-content bg-white py-4 px-6 w-1/3 items-center rounded-lg relative">
            <!-- Modal Header -->
            <div class="modal-header mb-4">
                <h3 class="font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-birumuda to-birutua text-2xl">Upload Foto</h3>
                <button id="closeModal" class="modal-close absolute -top-3 -right-3">
                    <i class="bi bi-x-lg bg-black text-white px-1 text-2xl rounded-full"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadForm" action="{{ route('upload-photo') }}" method="POST" enctype="multipart/form-data" class="rounded-md">
                    @csrf
                    <input type="hidden" name="parent_folder_id" value="{{ $title == 'Beranda' || $title == 'Photo' || $title == 'Folder' || $title == 'Archive' ? 1 : $folder->id }}">
                    <label for="input-file" id="drop-area" class="w-full h-80">
                        <input type="file" required id="input-file" name="image_location[]" class="border p-1 border-gray-300 mb-4 rounded-md w-full placeholder:text-sm hidden" multiple>
                        
                        <div id="img-view" class="flex justify-center items-center flex-col my-2 w-full h-full bg-birumuda bg-opacity-10 py-3 border-dashed border-2 border-slate-400 rounded-md bg-cover bg-center bg-no-repeat">
                            <img src="{{ asset('resources/image/icondownload.png') }}" alt="" class="w-1/2 my-2">
                            <p>Seret dan taruh atau <span class="font-bold">klik disini</span><br>untuk Upload Foto</p>
                        </div>
                        <p id="jumlah_file" class="mb-2 text-left text-slate-800 text-sm font-bold"></p>
                    </label>
                    
                    <button type="submit" class="bg-birumuda hover:bg-birutua transition-all text-white font-bold py-2 px-4 rounded">Upload</button>
                </form>
            </div>
            </div>
    </div>
</div>

<script>
    // Get modal element
    const modal = document.getElementById('imageModal');
    // Get open modal button
    const openModalBtn = document.getElementById('openModal');
    const closeModalBtn = document.getElementById('closeModal');
    const dropArea = document.getElementById("drop-area");
    const inputFile = document.getElementById("input-file");
    const originalContent = document.getElementById("img-view").innerHTML;
    const imageView = document.getElementById("img-view");
    const jumlah = document.getElementById("jumlah_file");

    

 // Function to open modal
    function openModal() {
        modal.classList.remove('hidden');
    }

    // Function to close modal
    function closeModal() {
        modal.classList.add('hidden');
        inputFile.value = null;
        jumlah.textContent = '';
        imageView.innerHTML = originalContent;
        imageView.style.backgroundImage = "";
        imageView.style.border = "2px dashed #ccc";
    }

    // Event listener for open modal button
    openModalBtn.addEventListener('click', openModal);
    // Event listener for close modal button
    closeModalBtn.addEventListener('click', closeModal);

    // Close modal when clicking outside of it
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Prevent modal from closing when clicking inside it
    modal.addEventListener('click', (e) => {
        e.stopPropagation();
    });


    inputFile.addEventListener("change", uploadImage);

    function uploadImage(){
        let imgLink = URL.createObjectURL(inputFile.files[0]);
        jumlah.textContent = this.files.length + ' Foto Terpilih';
        imageView.style.backgroundImage = `url(${imgLink})`;
        imageView.style.height = '300px'
        imageView.textContent = "";
        imageView.style.border = "0"
    }

    dropArea.addEventListener("dragover", function(e){
        e.preventDefault();
    });

    dropArea.addEventListener("drop", function(e){
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImage();
    });
</script>


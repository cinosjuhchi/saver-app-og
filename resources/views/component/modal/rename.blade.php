<div id="renameModal" class="modal hidden fixed bg-slate-600 bg-opacity-50 h-screen inset-0 z-50 w-full">
    <div class="h-screen flex flex-1 justify-center items-center text-center rounded-md">
        <div class="modal-content bg-white py-4 px-6 w-10/12 md:w-1/2 lg:w-1/3 items-center rounded-md relative">
            <!-- Modal Header -->
            <div class="modal-header">
                <h3 class="text-lg font-semibold mb-4">Ganti nama</h3>
                <button onclick="closeRename()" class="modal-close absolute -top-3 -right-3">
                    <i class="bi bi-x-lg bg-black text-white px-1 text-2xl rounded-full"></i>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadForm" name="title" action="{{ route('change-name') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_content" id="idContent">
                    <input type="hidden" name="type" id="typeContent">
                    <input type="text" id="inputTitle" name="title" class="border border-gray-300 p-2 mb-4 rounded-md placeholder:text-sm w-full" required>
                    <div class="gap-2 flex justify-center">
                    <button type="reset" class="bg-red-500 hover:bg-red-600 transition-all text-white font-bold py-2 px-4 rounded" onclick="closeRename()">Batal</button>
                    <button type="submit" class="bg-birumuda hover:bg-birutua transition-all text-white font-bold py-2 px-4 rounded">Ganti</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const rename = document.getElementById('renameModal');
    const openRenameBtn = document.getElementById('openRename');
    const closeRenameBtn = document.getElementById('closeRename');
    const idContent = document.getElementById('idContent');
    const typeContent = document.getElementById('typeContent');
    const inputTitle = document.getElementById('inputTitle');

    function openRename(event) {
        let target = event.currentTarget;
        let tipe = target.getAttribute("data-type");
        let id = target.getAttribute("data-id");
        let content = target.getAttribute('data-title')
        idContent.value = id;
        typeContent.value = tipe;
        inputTitle.value = content;
        rename.classList.remove('hidden');
    }

    function closeRename() {
        rename.classList.add('hidden');
        idContent.value = null;
        typeContent.value = null;
    }

    openRenameBtn.addEventListener('click', openRename);
    closeRenameBtn.addEventListener('click', closeRename);

    window.addEventListener('click', (e) => {
        if (e.target === rename) {
            closeRename();
        }
    });

    rename.addEventListener('click', (e) => {
        e.stopPropagation();
    });
</script>

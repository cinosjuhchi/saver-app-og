<div class="flex items-center justify-center">
    <div class="content text-center" id="drop-area">
        <img src="{{ asset('resources/image/nothing_here.png') }}" alt="Placeholder" class="w-[300px]">
        <div class="title text-neutral-400">
            <h1 class="text-2xl mt-4">Tidak ada apa-apa disini</h1>
        </div
    </div>
</div>



<script>// Drag and drop functionality
const dropArea = document.getElementById('drop-area');
const uploadForm = document.getElementById('uploadForm');
const imageUpload = document.getElementById('imageUpload');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, preventDefaults, false)
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
});

['dragleave', 'drop'].forEach(eventName => {
    dropArea.addEventListener(eventName, unhighlight, false)
});

function highlight(e) {
    dropArea.classList.add('border-blue-500');
}

function unhighlight(e) {
    dropArea.classList.remove('border-blue-500');
}

dropArea.addEventListener('drop', handleDrop, false);

function handleDrop(e) {
    let dt = e.dataTransfer;
    let files = dt.files;

    handleFiles(files);
}

function handleFiles(files) {
    files = [...files];
    files.forEach(uploadFile);
}

function uploadFile(file) {
    // Display the file
    const reader = new FileReader();

    reader.onload = function () {
        const img = document.createElement('img');
        img.src = reader.result;
        dropArea.innerHTML = '';
        dropArea.appendChild(img);
    };

    reader.readAsDataURL(file);

    // Set the file to the file input
    const formData = new FormData();
    formData.append('image_location[]', file);

    // Submit the form automatically
    fetch(uploadForm.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-Token': uploadForm.querySelector('input[name="_token"]').value
        }
    })
    .then(response => {
        // Handle the response as needed
        console.log('File uploaded successfully');
    })
    .catch(error => {
        console.error('Error uploading file:', error);
    });
}
</script>
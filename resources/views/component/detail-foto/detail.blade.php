<style>
        .zoomable-image {
            cursor: zoom-in;
            transition: transform 0.2s;
        }

        .zoomable-image.zoomed {
            cursor: zoom-out;
            transform: scale(1.5);
        }

        /* Tambahkan animasi untuk slide in dari kanan */
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
            }
            to {
                transform: translateX(0);
            }
        }

        /* Tambahkan animasi untuk slide out ke kiri */
        @keyframes slideOutLeft {
            from {
                transform: translateX(0);
            }
            to {
                transform: translateX(100%);
            }
        }

        /* Tambahkan transisi */
        .info-detail {
            transition: transform 0.3s ease-in-out;
        }

        /* Tambahkan kelas untuk animasi slide in */
        .info-detail.slide-in-right {
            animation: slideInRight 0.3s forwards;
        }

        /* Tambahkan kelas untuk animasi slide out */
        .info-detail.slide-out-left {
            animation: slideOutLeft 0.3s forwards;
        }
</style>

    <!-- Navbar -->
    <div class="relative lg:text-2xl">
        <nav class="nav-modal w-full flex justify-between items-center sm:px-2 lg:px-6 py-4 bg-opacity-80 bg-blend-overlay absolute z-10">
            <div class="kanan flex items-center text-black lg:gap-2 sm:gap-1 font-bold truncate">
                <button id="tutup" onclick="goBack()" class="cursor-pointer hover:bg-black hover:text-white rounded-full px-3 py-2">
                    <i class="bi bi-arrow-left text-2xl"></i>
                </button>
                <h1 class="">{{ $photo->title }}</h1>
            </div>
            <div class="kiri flex lg:gap-4 sm:gap-3 text-black">
                <a class="hover:bg-black hover:text-white transition-all rounded-full px-3 py-2 text-2xl">
                    <i class="bi bi-printer"></i>
                </a>

                <a class="hover:bg-black hover:text-white transition-all rounded-full px-3 py-2 text-2xl">
                    <i class="bi bi-star"></i>
                </a>

                <a class="hover:bg-black hover:text-white transition-all rounded-full px-3 py-2 text-2xl" href="{{ route('download-image', ['slug' => $photo->slug]) }}">
                    <i class="bi bi-download"></i>
                </a>

                <a class="hover:bg-black hover:text-white transition-all rounded-full px-3 py-2 text-2xl cursor-pointer btn-info">
                    <i class="bi bi-info-lg"></i>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="bg-neutral-50 lg:text-2xl h-screen flex flex-col">
        <div class="flex-1 flex items-center justify-center overflow w-full relative ">
            <div class="max-w-lg mx-auto absolute z-50">
                <img id="modal-image" src="{{ asset('storage/' . $photo->image_location) }}" alt="Gambar" class="zoomable-image h-max w-max scale-75 lg:scale-100 object-cover">
            </div>



            <!-- Info Detail -->
            <div class="info-detail bg-opacity-95 bg-black w-10/12 md:w-1/2 lg:w-1/3 px-6 py-4 text-white absolute h-screen z-50 right-0 hidden overflow-hidden ">
            <div class="head flex justify-between items-center">
            <h1 class="font-bold">Detail Foto</h1>
            <button class="closeDetail">
                <i class="bi bi-x-lg"></i>
            </button>
            </div>
            <div class="content text-sm w-full mt-6">
                <table class="table-fixed w-full">
                    <tr class="align-text-top mb-3">
                        <td class="pb-4">Nama</td>
                        <td class="pb-4">{{ $photo->title }}</td>
                    </tr>
                    <tr class="align-text-top mb-3">
                        <td class="pb-4">Ukuran</td>
                        <td class="pb-4">{{ $ukuran }}</td>
                    </tr>
                    <tr class="align-text-top mb-3">
                        <td class="pb-4">Dibuat</td>
                        <td class="pb-4">26 - 02 - 2024 19:39</td>
                    </tr>
                    
                </table>
            </div>
        </div>
        </div>

        
    </div>

    

  <script>
    const modalImage = document.getElementById('modal-image');
    let isZoomed = false;
    let initialScaleApplied = false;

    // Toggle zoom in/out dan ubah kursor
    modalImage.addEventListener('click', function () {
        if (!isZoomed) {
            modalImage.style.transform = 'scale(1.5)'; // Atur transformasi untuk zoom in
            modalImage.classList.add('zoomed');
            modalImage.style.cursor = 'zoom-out'; // Mengubah kursor saat zoom in
            isZoomed = true;
        } else {
            modalImage.style.transform = initialScaleApplied ? 'scale(0.5)' : ''; // Tetapkan skala 50% jika skala awal sudah diaplikasikan, jika tidak, reset skala
            modalImage.classList.remove('zoomed');
            modalImage.style.cursor = 'zoom-in'; // Mengubah kursor saat zoom out
            isZoomed = false;
        }
    });

    // Cek apakah gambar melebihi tinggi layar saat keadaan normal
    window.onload = function () {
        const screenHeight = window.innerHeight;
        const imageHeight = modalImage.offsetHeight;
        if (imageHeight > screenHeight) {
            modalImage.style.transform = 'scale(0.5)';
            initialScaleApplied = true;
        }
    };

    function goBack() {
        window.history.back();
    }
</script>



<!-- JS Detail -->
<script>
    const infoDetail = document.querySelector('.info-detail');
    const biInfoButton = document.querySelector('.btn-info');
    const closeDetailButton = document.querySelector('.closeDetail');
    let isInfoDetailVisible = false;

    // Tampilkan atau sembunyikan info detail saat tombol bi info diklik
    biInfoButton.addEventListener('click', function () {
        if (!isInfoDetailVisible) {
            infoDetail.classList.remove('hidden'); // Hapus class hidden
            infoDetail.classList.remove('slide-out-left'); // Hapus class slide-out-left jika ada
            infoDetail.classList.add('slide-in-right');
            isInfoDetailVisible = true;
        }
    });

    // Sembunyikan info detail saat tombol close detail diklik
    closeDetailButton.addEventListener('click', function () {
        infoDetail.classList.remove('slide-in-right');
        infoDetail.classList.add('slide-out-left');
        isInfoDetailVisible = false;

        // Hapus class slide-out-left setelah animasi selesai
        setTimeout(function () {
            infoDetail.classList.add('hidden');
        }, 300); // Waktu animasi adalah 0.3s atau 300ms
    });
</script>












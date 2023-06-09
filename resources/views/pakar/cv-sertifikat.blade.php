<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise - Login Main</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/cv-portofolio.css') }}" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <style>
        .has-mask {
            position: absolute;
            clip: rect(10px, 150px, 130px, 10px);
        }
    </style>
</head>

<body>

    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="index.html">
                    <i class="navbar-brand-icon bi-book me-2"></i>
                    <span>AgroRise</span>
                </a>

                <div class="d-lg-none ms-auto me-3">
                    <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                        <i class="btn-icon bi-cloud-download"></i>
                        <span>Masuk</span><!-- duplicated another one below for mobile -->
                    </a>
                </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-lg-auto me-lg-4">
                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('index') }}">Beranda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{ route('course') }}">Kursus</a>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarLightDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Perhitungan</a>

                            <ul class="dropdown-menu dropdown-menu-light" aria-labelledby="navbarLightDropdownMenuLink">
                                <li><a class="dropdown-item" href="/pupuk-urea">Pupuk</a></li>
                                <li><a class="dropdown-item" href="/pestisida">Pestisida</a></li>
                                <li><a class="dropdown-item" href="/keuntungan">Keuntungan</a></li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="/#tentang_kami">Tentang Kami</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-transparent dropdown-toggle text" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hallo, {{ Auth::guard('pakar')->user()->username }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('profilepakar') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengajuan-index') }}">Kursus Saya</a></li>
                            <li><a class="dropdown-item" href="{{ route('invoice-course') }}">Pembelian</a></li>
                            <li><a class="dropdown-item" href="{{ route('edit-password-pakar') }}">Ubah Password</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i>
                                        Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="min-h-screen flex justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gray-500 bg-no-repeat bg-cover relative items-center mt-5"
            style="background-image: url(../images/bg1.jpg);">
            <div class="absolute bg-black opacity-60 inset-0 z-0"></div>
            <div class="sm:max-w-lg w-full p-10 bg-white rounded-xl z-10">
                <div class="text-center">
                    <h2 class="mt-5 text-3xl font-bold text-gray-900">
                        Pengajuan Pakar
                    </h2>
                    <p class="mt-2 text-sm text-gray-400">Unggah CV Dan Sertifikaat</p>
                </div>
                <form class="mt-8 space-y-3" action="cv-sertifikat" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="grid grid-cols-1 space-y-2">
                        <label class="text-sm font-bold text-gray-500 tracking-wide">
                            CV
                            <div id="selected-files" class="text-xs text-gray-400 mt-1"></div>
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col rounded-lg border-4 border-dashed w-full h-10 p-10 group text-center">
                                <div class="h-full w-full text-center flex flex-col justify-center items-center  ">
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                    </div>
                                    <p class="pointer-none text-gray-500 "><span class="text-sm">Seret Dan
                                            Lepas</span>
                                        file disini <br /> atau <a href="" id=""
                                            class="text-blue-600 hover:underline">Pilih File</a> dari komputer kamu
                                    </p>
                                    <input type="file" class="hidden" name="cv" id="file-input"
                                        accept=".pdf" multiple>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 space-y-2">
                        <label class="text-sm font-bold text-gray-500 tracking-wide">
                            Sertifikat
                            <div id="selected-files-2" class="text-xs text-gray-400 mt-1"></div>
                        </label>
                        <div class="flex items-center justify-center w-full">
                            <label
                                class="flex flex-col rounded-lg border-4 border-dashed w-full h-10 p-10 group text-center">
                                <div class="h-full w-full text-center flex flex-col justify-center items-center  ">
                                    <div class="flex flex-auto max-h-48 w-2/5 mx-auto -mt-10">
                                    </div>
                                    <p class="pointer-none text-gray-500 "><span class="text-sm">Seret Dan
                                            Lepas</span>
                                        file disini <br /> atau <a href="" id=""
                                            class="text-blue-600 hover:underline">Pilih File</a> dari komputer kamu
                                    </p>
                                    <input type="file" class="hidden" name="sertifikat" id="file-input-2"
                                        accept=".pdf" multiple>
                                </div>
                            </label>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300">
                        <span>Tipe File: pdf</span>
                    </p>
                    <input type="hidden" name="status" value="Terbaru">
                    <div>
                        <button type="submit"
                            class="my-5 w-full flex justify-center bg-blue-500 text-gray-100 p-4  rounded-full tracking-wide
                                font-semibold  focus:outline-none focus:shadow-outline hover:bg-blue-600 shadow-lg cursor-pointer transition ease-in duration-300">
                            Unggah
                        </button>
                    </div>
                </form>
            </div>
        </div>





    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>

    <script>
        const fileInput = document.getElementById('file-input');
        const fileInput2 = document.getElementById('file-input-2');
        const selectedFilesContainer = document.getElementById('selected-files');
        const selectedFilesContainer2 = document.getElementById('selected-files-2');

        fileInput.addEventListener('change', (event) => {
            selectedFilesContainer.innerHTML = '';

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileName = file.name;
                const fileItem = document.createElement('div');
                fileItem.textContent = fileName;
                selectedFilesContainer.appendChild(fileItem);
            }
        });

        fileInput2.addEventListener('change', (event) => {
            selectedFilesContainer2.innerHTML = '';

            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const fileName = file.name;
                const fileItem = document.createElement('div');
                fileItem.textContent = fileName;
                selectedFilesContainer2.appendChild(fileItem);
            }
        });
    </script>

</body>

</html>

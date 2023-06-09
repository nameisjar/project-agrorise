<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>

    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/pengajuan.css') }}" rel="stylesheet">

</head>

<body className='snippet-body'>
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/smart_wizard_theme_arrows.min.css"
        rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js">
    </script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js">
    </script>


    <main>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="/">
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
                            <a class="nav-link text click-scroll" href="{{ route('course') }}">Kursus</a>
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
                            <a class="nav-link click-scroll" href="#tentang_kami">Tentang Kami</a>
                        </li>
                    </ul>
                    <div class="dropdown">
                        <button class="btn btn-transparent dropdown-toggle text-light" type="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Hallo, {{ Auth::guard('pakar')->user()->username }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="{{ route('profilepakar') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengajuan-index') }}">Kursus Anda</a></li>
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
        <form class="snippet-body" action="{{ route('pengajuan-post') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="text-center">
                    <h1>Pengajuan Kursus</h1>
                </div>
                <div class="row">
                    <div class="col-lg-7 mx-auto">
                        <div class="card mt-2 mx-auto p-4 bg-light">
                            <div class="card-body bg-light">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="judul">Judul (maks 40 huruf) *</label>
                                                <input id="judul" type="text" name="judul"
                                                    class="form-control @error('judul') is-invalid @enderror"
                                                    placeholder="Masukkan Judul Kursus" required>
                                                @error('judul')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="jmlh_peserta">Jumlah Kuota *</label>
                                                <input id="jmlh_peserta" type="number" name="jmlh_peserta"
                                                    class="form-control @error('jmlh_peserta') is-invalid @enderror"
                                                    placeholder="Jumlah Peserta Yang Mengikuti" required>
                                                @error('jmlh_peserta')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="hargaInput">Harga Kursus *</label>
                                                <input id="hargaInput" type="text" name="harga"
                                                    class="form-control @error('harga') is-invalid @enderror"
                                                    placeholder="Masukkan Harga Kursus Anda " required>
                                                @error('harga')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="thumbnail">Thumbnail Kursus *</label>
                                                <input id="thumbnail" type="file" name="thumbnail"
                                                    class="form-control @error('thumbnail') is-invalid @enderror"
                                                    required accept=".jpg, .png, .jpeg">
                                                @error('thumbnail')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="no_rekening">No Rekening BRI *</label>
                                                <input id="no_rekening" name="no_rekening" type="number"
                                                    class="form-control @error('no_rekening') is-invalid @enderror"
                                                    placeholder="Masukkan Nomor Rekening" required>
                                                @error('no_rekening')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="pertemuan">Jumlah Pertemuan *</label>
                                                <input id="pertemuan" name="pertemuan" type="number"
                                                    class="form-control @error('pertemuan') is-invalid @enderror"
                                                    placeholder="Masukkan Jumlah pertemuan cth: 2 " required>
                                                @error('pertemuan')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Deskripsi (maks 500 huruf) *</label>
                                                <textarea id="deskripsi" name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                                    placeholder="Deskripsikan Kursus Anda" rows="4" required></textarea>
                                                @error('deskripsi')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="deskripsi">Lihat tata cara unggah ketentuan video </label>
                                                <button class="text-primary"
                                                    onclick="openInstructionsWindow()">Disini</button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mx-auto mb-3">
                                            <input type="button" class="btn btn-primary btn-send pt-2 btn-block"
                                                value="Tambah Video" onclick="addInputField()">
                                        </div>
                                    </div>
                                    <div id="video-container">
                                        <!-- Container for dynamically added video fields -->
                                    </div>
                                    <div class="text-center mt-3">
                                        <input type="submit" class="btn btn-success btn-send pt-2 btn-block"
                                            value="Kirim">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <footer class="contact-section section-padding mt-3" id="section_5">
            <div class="container">
                <div class="row">
                    <div class="text-center align-items-center">
                        <h6 class="mt-3">Hello and talk to us</h6>
                        <h2 class="mb-2">Kontak</h2>
                        <p>
                            <a href="mailto:agrorise2023@gmail.com" class="contact-link">
                                agrorise2023@gmail.com
                            </a>
                        </p>
                        <p class="mb-1">
                            <i class="bi-geo-alt me-2"></i>
                            Jember, Jawa Timur
                        </p>
                    </div>
                </div>
            </div>
        </footer>
    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
    </script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js'>
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'arrows',
                autoAdjustHeight: true,
                transitionEffect: 'fade',
                showStepURLhash: false,

            });

        });
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'>
    </script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript' src='#'></script>
    <script type='text/javascript'>
        #
    </script>
    <script type='text/javascript'>
        var myLink = document.querySelector('a[href="#"]');
        myLink.addEventListener('click', function(e) {
            e.preventDefault();
        });
    </script>


    {{-- menggabungkan 2 form pengajuan dan video --}}
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            // Tambahkan event listener ketika halaman dimuat
            addInputField();
        });

        function addInputField() {
            var container = document.getElementById("video-container");

            var div = document.createElement("div");
            div.className = "row";

            var col1 = document.createElement("div");
            col1.className = "col-md-6";
            var col2 = document.createElement("div");
            col2.className = "col-md-6";

            var titleLabel = document.createElement("label");
            titleLabel.setAttribute("for", "title");
            titleLabel.textContent = "Judul Video *";
            var titleInput = document.createElement("input");
            titleInput.setAttribute("type", "text");
            titleInput.setAttribute("name", "title[]");
            titleInput.className = "form-control";
            titleInput.setAttribute("placeholder", "Masukkan Judul Video");
            titleInput.required = true;

            var linkLabel = document.createElement("label");
            linkLabel.setAttribute("for", "link");
            linkLabel.textContent = "Link Video *";
            var linkInput = document.createElement("input");
            linkInput.setAttribute("type", "text");
            linkInput.setAttribute("name", "link[]");
            linkInput.className = "form-control";
            linkInput.setAttribute("placeholder", "Masukkan link Cloudinary");
            linkInput.required = true;

            var deleteButton = document.createElement("button");
            deleteButton.type = "button";
            deleteButton.className = "btn btn-danger col-2 mt-3 ml-3";
            deleteButton.innerHTML = "Hapus";
            deleteButton.onclick = function() {
                removeInputField(div);
            };

            col1.appendChild(titleLabel);
            col1.appendChild(titleInput);
            col2.appendChild(linkLabel);
            col2.appendChild(linkInput);

            div.appendChild(col1);
            div.appendChild(col2);
            div.appendChild(deleteButton);

            container.appendChild(div);
        }

        function removeInputField(div) {
            var container = document.getElementById("video-container");
            container.removeChild(div);
        }
    </script>



    {{-- format harga rupiah --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        $(document).ready(function() {
            $('#hargaInput').on('input', function() {
                // Menghilangkan karakter selain angka
                var harga = $(this).val().replace(/[^0-9]/g, '');

                // Menambahkan titik sebagai pemisah ribuan
                harga = harga.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

                // Menambahkan simbol mata uang
                harga = 'Rp. ' + harga;

                $(this).val(harga);
            });
        });
    </script>

    <script>
        function openInstructionsWindow() {
            var instructions =
                `1. Daftar atau masuk ke akun Cloudinary: Buka situs web resmi Cloudinary (cloudinary.com) dan daftar untuk membuat akun baru atau masuk menggunakan akun yang sudah ada.
  2. Navigasi ke Media Library: Setelah masuk ke akun Anda, navigasikan ke Media Library. Anda akan melihat tampilan galeri yang menampilkan file media yang sudah diunggah sebelumnya.
  3. Pilih tombol "Upload" atau "Upload assets": Di Media Library, Anda akan menemukan tombol "Upload" atau "Upload assets" yang biasanya berada di sudut kanan atas halaman. 
  Klik tombol tersebut untuk memulai proses upload.
  4. Pilih video yang ingin diunggah: Pilih video dari perangkat Anda dengan menelusuri direktori file atau seret dan lepaskan file video ke area upload.
  5. Tunggu hingga proses upload selesai: Setelah memilih video, Cloudinary akan mulai mengunggah file. Proses ini akan memakan waktu tergantung pada ukuran file dan kecepatan internet Anda.
  6. Konfigurasi opsi pengunggahan (opsional): Setelah video diunggah, Anda dapat mengkonfigurasi opsi pengunggahan seperti mengatur folder tujuan, 
  memberikan tag atau metadata, memilih format file output, dan menentukan pengaturan lainnya yang sesuai dengan kebutuhan Anda. Anda dapat menyesuaikan pengaturan ini melalui antarmuka Cloudinary.
  7. Selesai: Setelah video diunggah dan pengaturan yang diperlukan dikonfigurasi, Cloudinary akan mengelola dan menyimpan video tersebut. Anda dapat mengakses dan menggunakan video 
  tersebut dengan menggunakan URL yang disediakan oleh Cloudinary.`;

            var instructionsWindow = window.open("", "_blank", "width=1920,height=1080");
            instructionsWindow.document.write(
                `<html><head><title>Langkah-langkah Unggah Video di Cloudinary</title></head><body><pre>${instructions}</pre></body></html>`
            );
        }
    </script>


</body>

</html>

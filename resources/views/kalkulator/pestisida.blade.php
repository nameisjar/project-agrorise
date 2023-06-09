<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise - Kalkulator Pestisida</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/kalkulator.css') }}" rel="stylesheet">


    <style>
        .output-field {
            background-color: #f0f0f0;
            border: 1px solid #ccc;
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
                            <a class="nav-link text dropdown-toggle" href="#" id="navbarLightDropdownMenuLink"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Pestisida</a>

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
                    @if (Str::length(Auth::guard('pakar')->user()) > 0)
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text-light" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hallo, {{ Auth::guard('pakar')->user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ route('profilepakar') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('pengajuan-index') }}">Kursus Saya</a></li>
                                <li><a class="dropdown-item" href="{{ route('invoice-course') }}">Pembelian</a></li>
                                <li><a class="dropdown-item" href="{{ route('edit-password-pakar') }}">Ubah Password</a>
                                </li>>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="bi bi-box-arrow-right"></i>
                                            Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @elseif(Str::length(Auth::guard('user')->user()) > 0)
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text-light" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hallo, {{ Auth::guard('user')->user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/profile">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('kursus-saya') }}">Kursus Saya</a></li>
                                <li><a class="dropdown-item" href="/edit-password-user">Ubah Password</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @elseif(Str::length(Auth::guard('admin')->user()) > 0)
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text-light" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hallo, {{ Auth::guard('admin')->user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="/profileadmin">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('database-pakar') }}">Database</a></li>
                                <li><a class="dropdown-item" href="/edit-password-admin">Ubah Password</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i
                                                class="bi bi-box-arrow-right"></i> Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-none d-lg-block">
                            <a href="/login" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                                <i class="btn-icon bi-cloud-download"></i>
                                <span href="...\PPLARGO\login.php">Masuk</span><!-- duplicated above one for mobile -->
                            </a>
                        </div>
                    @endif
                    {{-- <div class="d-none d-lg-block">
                            <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                                <i class="btn-icon bi-cloud-download"></i>
                                <span>Masuk</span><!-- duplicated above one for mobile -->
                            </a>
                        </div> --}}
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container">
                <div class="row align-items-stretch justify-content-center no-gutters">
                    <div class="col-md-7">
                        <div class="form h-100 contact-wrap p-5">
                            <h3 class="text-center mb-5">Kalkulator Pestisida</h3>
                            <form class="mb-5" method="post" id="contactForm" name="contactForm">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Konsentrasi Aplikasi
                                            (ml/L)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="consent" required
                                                style="padding-right: 20px; padding-left: 20px;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ml/L</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Luas Lahan (m)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="luas" required
                                                style="padding-right: 20px; padding-left: 20px;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Kapasitas Tangki (L)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="vtangki" required
                                                style="padding-right: 20px; padding-left: 20px;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">L</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="budget" class="col-form-label">Volume Aplikasi/Semprot
                                            (L/Ha)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="vsemprot" required
                                                style="padding-right: 20px; padding-left: 20px;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">L/Ha</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="budget" class="col-form-label">Dosis Pestisida (L/Ha)</label>
                                        <output class="form-control output-field" id="dosis"></output
                                            style="padding-right: 10px; padding-left: 10px;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="budget" class="col-form-label">Volume Pestisida (mL)</label>
                                        <output class="form-control output-field" id="vpestisida"
                                            style="padding-right: 10px; padding-left: 10px;"></output>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="budget" class="col-form-label">Volume Larutan air (L)</label>
                                        <output class="form-control output-field" id="vair"
                                            style="padding-right: 10px; padding-left: 10px;"></output>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="budget" class="col-form-label">Banyak tangki yang
                                            diperlukan</label>
                                        <output class="form-control output-field" id="btangki"
                                            style="padding-right: 10px; padding-left: 10px;"></output>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="budget" class="col-form-label">Volume Insektisida (ml)</label>
                                        <output class="form-control output-field" id="vinsektisida"
                                            style="padding-right: 10px; padding-left: 10px;"></output>
                                    </div>
                                </div>
                                <div class="row justify-content-center mt-3 ">
                                    <p id="notes" style="display: none">Cara tepat agar penyemprotan pestisida
                                        berhasil lihat Pustaka : <br>
                                        1. Ukuran butiran semprot yang ideal adalah 150 mikron. Butiran yang terlalu
                                        kecil akan mudah terbawa
                                        angin. <br>
                                        2. Lakukan kalibrasi untuk menentukan volume semprot yang akan diberikan. <br>
                                        3. Berjalanlah dengan kecepatan berjalan yang ideal, yakni 6 km/jam. <br>
                                        4. Pastikan arah sudut sprayer idealnya adalah 45 ͦ. <br>
                                        5. Pastikan suhu udara satu atau dua jam setelah penyemprotan harus konstan atau
                                        turun. Karena jika terlalu panas, maka pestisida akan menguap. <br>
                                        6. Update dan cek kelembaban udara yang idealnya saat pagi hari. Idealnya
                                        kelembaban lebih dari 80 %. <br>
                                        7. Pastikan kecepatan angin ideal adalah 4-6km/jam. Lebih dari itu, pestisida
                                        akan hilang terbawa angin. <br><br>
                                        Peralatan yang digunakan dalam pengaplikasian pestisida: <br>
                                        1. Sesuai dengan alat yang digunakan. Beberapa peralatan aplikasi pestisida
                                        diantaranya : knapsack sprayer,
                                        fooging, blower spray, dan fumigasi. <br>
                                        2. Menggunakan safety treatment (boot sepatu kedap dimana butir-butir semprot
                                        tidak terkenda kulit kaki,
                                        baju lengan panjang, dan juga masker), penggunaan kacamata dan juga sarung
                                        tangan</p>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-md-5 mt-5 form-group justify-content-center text-center">
                                        <input type="button" value="Hitung" onclick="hpest()"
                                            class="btn btn-block btn-primary rounded-0 py-2 px-4">
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <script>
        // Konsentrasi Aplikasi (ml/L)
        var consent = document.getElementById("consent");
        // Luas Lahan (m)
        var luas = document.getElementById("luas");
        // Kapasitas Tangki (L)
        var vtangki = document.getElementById("vtangki");
        // Volume Aplikasi/Semprot (L/Ha)
        var vsemprot = document.getElementById("vsemprot");
        // Dosis Pestisida (L/Ha)
        var dosis = document.getElementById("dosis");
        // Volume Pestisida (mL)
        var vpestisida = document.getElementById("vpestisida");
        // Volume Larutan air (L)
        var vair = document.getElementById("vair");
        // Banyak tangki yang diperlukan
        var btangki = document.getElementById("btangki");

        var note = document.getElementById("notes")

        function hpest() {
            dosis.value = Number(consent.value) * Number(vsemprot.value) / 1000;
            vpestisida.value = Number(consent.value) * Number(vtangki.value);
            vair.value = Number(vsemprot.value) * Number(luas.value) / 10000;
            btangki.value = Math.round(Number(vair.value) / Number(vtangki.value)) + " Tangki";
            vinsektisida.value = Number(dosis.value) * Number(luas.value) / 10000 * 1000;
            note.style.display = "block";
        }
    </script>


    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>

</body>

</html>

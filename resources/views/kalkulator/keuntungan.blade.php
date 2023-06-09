<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise - Kalkulator Keuntungan</title>

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
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Keuntungan</a>
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
                                </li>
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
                </div>
            </div>
        </nav>
        <div class="content">
            <div class="container">
                <div class="row align-items-stretch justify-content-center no-gutters">
                    <div class="col-md-7">
                        <div class="form h-100 contact-wrap p-5">
                            <h3 class="text-center">Kalkulator Keuntungan</h3>
                            <form class="mb-5" method="post" id="contactForm" name="contactForm">
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="modal" class="col-form-label">Modal (Rupiah)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="modal" min="0"
                                                placeholder="Masukkan jumlah modal" autofocus
                                                style="padding-right: 10px; padding-left: 10px;">
                                        </div>
                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="panen" class="col-form-label">Jumlah Hasil Panen (Kg)</label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="panen" min="0"
                                                placeholder="Masukkan jumlah hasil panen"
                                                style="padding-right: 20px; padding-left: 20px;">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 form-group mb-3">
                                        <label for="harga" class="col-form-label">Harga Pasar (Rupiah)/Kg</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="number" class="form-control" id="harga" min="0"
                                                placeholder="Masukkan harga pasar"
                                                style="padding-right: 10px; padding-left: 10px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 form-group mb-3">
                                    <label for="hasil" class="col-form-label">Hasil Keuntungan (Rupiah)</label>
                                    <output class="form-control output-field" id="hasil"
                                        style="padding-right: 10px; padding-left: 10px;"></output>
                                </div>
                                <div class="row justify-content-center">
                                    <p id="notes" style="display: none"></p>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-md-5 mt-5 form-group justify-content-center text-center">
                                        <input type="button" value="Hitung" onclick="hkeuntungan()"
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
        var modal = document.getElementById("modal");
        var panen = document.getElementById("panen");
        var harga = document.getElementById("harga");
        var hasil = document.getElementById("hasil");
        var note = document.getElementById("notes");

        function formatRupiah(number) {
            var formattedNumber = new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
            return formattedNumber;
        }

        function hkeuntungan() {
            var modalValue = parseFloat(modal.value);
            var hargaValue = parseFloat(harga.value);
            var keuntungan = (panen.value * hargaValue) - modalValue;

            hasil.value = formatRupiah(keuntungan);

            if (keuntungan >= 0) {
                note.innerHTML = "Anda mendapatkan keuntungan sebesar " + formatRupiah(keuntungan);
            } else {
                note.innerHTML = "Anda mengalami kerugian sebesar " + formatRupiah(Math.abs(keuntungan));
            }

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

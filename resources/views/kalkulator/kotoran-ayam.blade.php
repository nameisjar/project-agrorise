<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise - Kalkulator</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/kalkulator.css') }}" rel="stylesheet">
    <!--



-->
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
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">Kotoran Ayam</a>
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
                            <h3 class="text-center">Kalkulator Pupuk</h3>
                            <nav class="nav2 mt-3">
                                <form class="container-fluid justify-content-center">
                                    <a href="/pupuk-urea"><button class="btn btn-outline-success me-2 "
                                            type="button">Urea</button></a>
                                    <a href="/pupuk-kotoran-ayam"><button
                                            class="btn btn-outline-success me-2 :hover active" type="button">Kotoran
                                            Ayam</button></a>
                                    <a href="/pupuk-SP-36"><button class="btn btn-outline-success me-2 "
                                            type="button">SP-36</button></a>
                                </form>
                            </nav>
                            <form class="mb-5 mt-4" method="post" id="contactForm" name="contactForm">
                                <div class="row">

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="" class="col-form-label">Luas Lahan</label>
                                        <input type="number" class="form-control" id="luas"><br>
                                        <select id="selector" onchange="getselect()">
                                            <option value="hektar">Hektar</option>
                                            <option value="meter">m*2</option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="budget" class="col-form-label">Dosis per hektar
                                                (Kg/Ha)</label>
                                            <output class="form-control" id="dosis1"></output>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 form-group mb-3">
                                            <label for="budget" class="col-form-label">Dosis per meter
                                                (g/m*2)</label>
                                            <output class="form-control" id="dosis2"></output>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="row justify-content-center mt-3 ">
                                            <p id="notes" style="display: none">Pupuk kotoran ayam memiliki
                                                kandungan hara yang cukup tinggi yakni 2,6% (N),
                                                2,9% (P), dan 3,4% (K) dengan perbandingan C/N ratio 8,3. Pupuk kandang
                                                ayam mengandung unsur hara tiga kali lebih
                                                besar dari pada pupuk kandang lainnya. Lebih lanjut dikemukakan
                                                kandungan unsur hara dari pupuk kandang ayam lebih
                                                tinggi karena bagian cair (urine) bercampur dengan bagian padat.
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-md-5 mt-5 form-group text-center">
                                            <input type="button" value="Hitung" onclick="hpupuk()"
                                                class="btn btn-block btn-primary rounded-0 py-2 px-4">
                                        </div>
                                        <div class="col-md-5 mt-5 form-group text-center">
                                            <input type="button" value="Reset" onclick="reset()"
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
        // Luas Lahan (m)
        var luas = document.getElementById("luas");
        // Dosis Pestisida (L/Ha)
        var dosis1 = document.getElementById("dosis1");
        // Dosis Pestisida (L/Ha)
        var dosis2 = document.getElementById("dosis2");

        var note = document.getElementById("notes")

        function getselect() {
            var selector = document.getElementById("selector").value;
            console.log(selector);
        }

        function hpupuk() {
            if (selector.value == "meter") {
                dosis2.value = Number(luas.value) * 500;
            }
            if (selector.value == "hektar") {
                dosis1.value = Number(luas.value) * 5000;
            }
            note.style.display = "block";
        }

        function reset() {
            var dosis1 = document.getElementById("dosis1").value = "";
            var dosis2 = document.getElementById("dosis2").value = "";
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

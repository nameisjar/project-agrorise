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

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/landing.css') }}" rel="stylesheet">

    <style>
        .tentang {
            font-size: 16px;
            /* Sesuaikan ukuran teks yang diinginkan */
            color: grey;
            line-height: 1.5;
            /* Sesuaikan jarak antarbaris yang diinginkan */
            text-align: center;
        }
    </style>

</head>

<body>

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
                            <a class="nav-link click-scroll" href="#tentang_kami">Tentang Kami</a>
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
                                <span href="{{ route('login') }}">Masuk</span><!-- duplicated above one for mobile -->
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>

        @if (Str::length(Auth::guard('pakar')->user()) > 0)
            <section class="hero-section d-flex flex-warp justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="land justify-content-center align-items-center col-12 text-center ">

                            <h6>Selamat Datang di Website</h6>

                            <h1 class="text-white mt-3 mb-4">AgroRise</h1>
                            <p class="text-white">Sistem Perhitungan Dan Edukasi Petani
                                Dalam Memajukan Agroindustri</p>
                        </div>
                    </div>
                </div>
            </section>
        @elseif(Str::length(Auth::guard('user')->user()) > 0)
            <section class="hero-section d-flex flex-warp justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="land justify-content-center align-items-center col-12 text-center ">

                            <h6>Selamat Datang di Website</h6>

                            <h1 class="text-white mt-3 mb-4">AgroRise</h1>
                            <p class="text-white">Sistem Perhitungan Dan Edukasi Petani
                                Dalam Memajukan Agroindustri</p>
                        </div>
                    </div>
                </div>
            </section>
        @elseif(Str::length(Auth::guard('admin')->user()) > 0)
            <section class="hero-section d-flex flex-warp justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="land justify-content-center align-items-center col-12 text-center ">

                            <h6>Selamat Datang di Website</h6>

                            <h1 class="text-white mt-3 mb-4">AgroRise</h1>
                            <p class="text-white">Sistem Perhitungan Dan Edukasi Petani
                                Dalam Memajukan Agroindustri</p>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <section class="hero-section d-flex flex-warp justify-content-center align-items-center" id="section_1">
                <div class="container">
                    <div class="row">

                        <div class="land justify-content-center align-items-center col-12 text-center ">

                            <h6>Selamat Datang di Website</h6>

                            <h1 class="text-white mt-3 mb-4">AgroRise</h1>
                            <p class="text-white">Sistem Perhitungan Dan Edukasi Petani
                                Dalam Memajukan Agroindustri</p>
                            <a href="{{ route('mulai') }}" class="btn custom-btn smoothscroll me-3 mt-3">Mulai</a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <section class="py-lg-5"></section>
        <section>
            <div class="container">
                <div class="row">
                    <div class="text-center align-items-center">
                        <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true"
                            class="scrollspy-example-2" tabindex="0">
                            <div class="scrollspy-example-item" id="item-1">
                                <h3>AgroRise</h3>
                                <br>
                                <p>Merupakan sebuah website Penyedia Layanan Kalkulasi atau Perhitungan dan Pelatihan
                                    secara mandiri menggunakan media online yang nantinya berguna untuk menambah
                                    pengetahuan dan informasi dibidang AgroIndustri</p>

                                <p><strong>Mengapa harus dibidang AgroIndustri?</strong> Agro industri sangat penting di
                                    era ini karena berperan dalam memenuhi kebutuhan pangan dan menghasilkan
                                    produk-produk pertanian yang lebih bernilai tambah. Agro industri menggabungkan
                                    teknologi dan keahlian dalam pengolahan bahan baku pertanian sehingga dapat
                                    menghasilkan produk-produk yang lebih berkualitas dan memiliki nilai tambah yang
                                    lebih tinggi.</p>

                                <p>Selain itu, Agro Industri juga dapat membantu meningkatkan kesejahteraan petani dan
                                    masyarakat di sekitar karena dapat menciptakan lapangan kerja dan meningkatkan
                                    pendapatan petani, sehingga membantu meningkatkan pertumbuhan ekonomi di
                                    wilayah-wilayah pedesaan..</p>
                            </div>

                            <div class="scrollspy-example-item" id="item-2">
                                <h5>Apa saja yang terdapat di dalam AgroRise?</h5>

                                <p>Pada Website AgroRise ini terdapat 2 fitur utama yang sangat membantu bagi para
                                    pengguna khususnya yang berkaitan dengan bidang AgroIndustri. Fitur tersebut terdiri
                                    dari <strong>Fitur Perhitungan</strong> dan <strong>Fitur Pelatihan atau
                                        Kursus</strong></p>

                                <p><strong>Fitur Perhitungan</strong> adalah Fitur yang dibuat untuk membantu para
                                    pengguna dalam menentukan takaran atau hasil dari suatu perhitungan yang dipilih
                                    nantinya. Dalam Fitur Perhitungan sendiri terdapat 3 Jenis Perhitungan yang terdiri
                                    dari Perhitungan Keuntungan, Perhitungan Pupuk, Perhitungan Pestisida</p>

                                <p><strong>Fitur Pelatihan atau Kursus</strong> adalah Pelatihan atau Kursus adalah
                                    suatu bentuk pembelajaran atau pengajaran yang terstruktur untuk memberikan
                                    pengetahuan, keterampilan, atau keahlian tertentu. Pelatihan atau Kursus biasanya
                                    diarahkan untuk meningkatkan kompetensi atau keterampilan seseorang dalam bidang
                                    tertentu. Pada Pelatihan ini menggunakan media secara online, sehingga memudahkan
                                    pengguna dalam mengakses kursus dengan praktis.</p> <br>

                                <div class="row">
                                    <div class="col-lg-6 col-12 mb-3">
                                        <img src="images/portrait-mature-smiling-authoress-sitting-desk.jpg"
                                            class="scrollspy-example-item-image img-fluid" alt="">
                                    </div>

                                    <div class="col-lg-6 col-12 mb-3">
                                        <img src="images/businessman-sitting-by-table-cafe.jpg"
                                            class="scrollspy-example-item-image img-fluid" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <section class="author-section section-padding" id="tentang_kami">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 my-auto">
                        <img src="images/fotokami.jpg" class="author-image img-fluid" alt="">
                    </div>
                    <div class="col-lg-6 col-12 mb-5 ">
                        <h2 class="mb-4 text-center">Tentang Kami</h2>
                        <h5 class="tentang">Website AGRORISE merupakan sebuah platform yang dikembangkan oleh Tim
                            Pengembangan Perangkat
                            Lunak untuk AgroIndustri Modern. Tujuan utama dari website ini adalah memberikan bantuan
                            kepada petani dalam mendapatkan informasi tentang perkiraan perhitungan pupuk dan pestisida,
                            serta potensi keuntungan yang dapat diperoleh. Selain itu, sistem ini juga menyediakan
                            kursus-kursus yang diajarkan oleh pakar-pakar di bidang agroindustri, sehingga petani dapat
                            memperluas pengetahuan dan pemahaman mereka tentang agroindustri.

                            Dengan adanya AGRORISE, petani dapat memanfaatkan platform ini sebagai wadah untuk belajar
                            dan memperoleh informasi terkait agroindustri. Mereka dapat mengikuti kursus yang
                            diselenggarakan oleh para pakar untuk meningkatkan pengetahuan dan wawasan mereka tentang
                            berbagai aspek agroindustri. Selain itu, petani juga dapat menemukan solusi atas
                            permasalahan yang mereka alami dalam kegiatan pertanian melalui platform ini.

                            Website AGRORISE bertujuan untuk memberikan bantuan yang komprehensif kepada petani, mulai
                            dari informasi perkiraan pupuk dan pestisida, hingga kursus-kursus untuk pengembangan
                            pengetahuan. Dengan demikian, diharapkan petani dapat meningkatkan produktivitas dan
                            keuntungan mereka dalam agroindustri, serta menghadapi tantangan yang dihadapi dengan lebih
                            efektif.
                        </h5>
                    </div>
                </div>
            </div>
        </section>
        <footer class="contact-section section-padding" id="section_5">
            <div class="container">
                <div class="row">
                    <div class="text-center align-items-center">
                        <h6 class="mt-5">Say hi and talk to us</h6>
                        <h2 class="mb-4">Contact</h2>
                        <p>
                            <a href="mailto:agrorise2023@gmail.com" class="contact-link">
                                agrorise2023@gmail.com
                            </a>
                        </p>
                        <p class="mb-3">
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

</body>

</html>

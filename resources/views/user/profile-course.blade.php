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

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/course.css') }}" rel="stylesheet">

    <style>
        .page-header {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(../images/bg1.jpg), no-repeat center center;
            background-size: cover;
            background-position: center;
        }
    </style>

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
                    @if (Str::length(Auth::guard('pakar')->user()) > 0)
                        <div class="dropdown">
                            <button class="btn btn-transparent dropdown-toggle text" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Hallo, {{ Auth::guard('pakar')->user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-dark">
                                <li><a class="dropdown-item" href="{{ route('profilepakar') }}">Profil</a></li>
                                <li><a class="dropdown-item" href="{{ route('pengajuan-index') }}">Kursus Anda</a></li>
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
                            <button class="btn btn-transparent dropdown-toggle text" type="button"
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
                            <button class="btn btn-transparent dropdown-toggle text" type="button"
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
        <div class="container-fluid page-header" style="margin-bottom: -50px;">
            <div class="container">
                <div class="d-flex flex-column justify-content-center" style="min-height: 300px">
                    <h3 class="display-4 text-white">Kursus</h3>
                    <div class="d-inline-flex text-white">
                        <p class="m-0 text-white">Jadilah bagian dari Agroindustri</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid py-5">
            <div class="container py-5">
                <div class="text-center mb-5">
                    <h1>Agroindustri</h1>
                </div>
                <div class="row">
                    @forelse($courses as $course)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="rounded overflow-hidden mb-2">
                                <div class="profile-img">
                                    <img src="{{ asset('storage/' . old('images', $course->pakar->foto)) }}"
                                        alt="Profile Photo">
                                </div>
                                <img class="rounded" width="450px" height="300px" style="object-fit: cover;"
                                    src="{{ asset('storage/' . old('thumbnail', $course->thumbnail)) }}"
                                    alt="">
                                <div class="bg-secondary p-4">
                                    <p class="profile-name">{{ $course->pakar->nama }}</p>
                                    <p class="profile-work">{{ $course->pakar->pekerjaan }}</p>
                                    <div class="d-flex justify-content-between mb-3">
                                        <small class="m-0"><i
                                                class="fa fa-users text-primary mr-2"></i>{{ $course->jmlh_peserta }}
                                            Kuota</small>
                                        <small class="m-0"><i
                                                class="far fa-clock text-primary mr-2"></i>{{ $course->pertemuan }}
                                            Pertemuan</small>
                                    </div>
                                    <h5>{{ $course->judul }}</h5>
                                    <small class="m-0">Online</small>
                                    <div class="border-top mt-4 pt-4">
                                        <div class="d-flex justify-content-between">
                                            @if (Str::length(Auth::guard('user')->user()) > 0)
                                                <button type="button" class="btn btn-primary mb-2"
                                                    onclick="kirimData({{ $course->id }})">Lihat Video</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="alert alert-danger" role="alert">
                            Belum ada Kursus
                        </div>
                    @endforelse

                </div>
            </div>
        </div>

        <footer class="contact-section section-padding" id="section_5">
            <div class="container">
                <div class="row">
                    <div class="text-center align-items-center">
                        <h6 class="mt-5">Hello and talk to us</h6>
                        <h2 class="mb-4">Kontak</h2>
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
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'>
    </script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/jquery.smartWizard.min.js'>
    </script>
    <script type='text/javascript'>
        $(document).ready(function() {
            @foreach ($courses as $course)
                $('#smartwizard{{ $course->id }}').smartWizard({
                    selected: 0,
                    theme: 'arrows',
                    autoAdjustHeight: true,
                    transitionEffect: 'fade',
                    showStepURLhash: false,
                });
            @endforeach
        });

        function setCourseId(courseId) {
            selectedCourseId = courseId;
        }

        function kirimData(courseId) {
            const url = "{{ route('konten-kursus', ':id') }}".replace(':id', courseId);
            window.location.href = url;
        }
    </script>

</body>



</html>

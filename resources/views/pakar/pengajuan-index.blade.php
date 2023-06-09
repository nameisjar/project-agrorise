<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>AgroRise - Kusrsus Anda</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/pengajuan-index.css') }}" rel="stylesheet">
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
            </div><i></i>
        </nav>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title mx-auto">Kursus Anda</h4>
                @if (Auth::guard('pakar')->user()->status === 'Disetujui')
                    <a href="{{ route('pengajuan') }}" class="btn btn-primary mb-3">Buat Kursus Baru</a>
                @else
                    <a href="" onclick="return confirm('Anda belum bisa membuat pengajuan kursus !')"
                        class="btn btn-primary mb-3">Buat Kursus Baru</a>
                @endif
            </div>
            <div class="row">
                @forelse ($courses as $course)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . old('thumbnail', $course->thumbnail)) }}" alt="thumbnail"
                                class="card-img-top" style="object-fit: cover; height: 200px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->judul }}</h5>
                                <p class="text-muted mb-2">{{ $course->created_at->format('Y-m-d') }} &middot;
                                    {{ $course->created_at->diffForHumans() }}</p>
                                <p class="card-text">Harga {{ $course->harga }}</p>
                                <button type="button" class="btn btn-sm btn-info mb-2"
                                    onclick="kirimData({{ $course->id }})">Lihat Video</button>
                            </div>
                            @unless ($course->status === 'Disetujui')
                                <div class="card-footer">
                                    <form action="{{ route('pengajuan-destroy', $course->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-block"
                                            onclick="return confirm('Apakah anda yakin untuk menghapus kursus ? ')">
                                            Hapus Kursus
                                        </button>
                                    </form>
                                </div>
                            @else
                                <div class="card-footer text-success">Kursus telah disetujui.</div>
                            @endunless
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <div class="alert alert-danger" role="alert">
                            Kamu belum Memiliki Kursus
                        </div>
                    </div>
                @endforelse
            </div>
        </div>





    </main>

    <!-- JAVASCRIPT FILES -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>

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

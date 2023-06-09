<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AgroRise - Login Main</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">

    <script>
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#provincy').on('change', function() {
                let id_provinces = $('#provincy').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('getregency') }}",
                    data: {
                        id_provinces: id_provinces
                    },
                    cache: false,

                    success: function(msg) {
                        $('#regency').html(msg);
                    },

                    error: function(data) {
                        console.log('error:', data);
                    },
                })
            })

        });
    </script>
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
                            <a class="nav-link click-scroll" href="{{route('index')}}">Beranda</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link click-scroll" href="{{route('course')}}">Kursus</a>
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
                    {{-- <div class="d-none d-lg-block">
                            <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                                <i class="btn-icon bi-cloud-download"></i>
                                <span>Masuk</span><!-- duplicated above one for mobile -->
                            </a>
                        </div> --}}
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="main-body">
                <form action="/update-pakar" method="post" enctype="multipart/form-data">
                    @method('PATCH')
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column align-items-center text-center">
                                        @if (Auth::guard('pakar')->user()->foto)
                                            <img src="{{ asset('storage/' . old('foto', Auth::guard('pakar')->user()->foto)) }}"
                                                alt="Admin" class="rounded-circle p-1 border border-warning"
                                                id="image-preview" width="180" height="180">
                                        @else
                                            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8ODg0ODQ8NDQ0NDQ0NDg0NDQ8NDQ0NFREWFhURFRUYHSggGBolGxUVITEhJTUrLi4uFx8zODMsNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALQAtAMBIgACEQEDEQH/xAAaAAEAAwEBAQAAAAAAAAAAAAAAAQMEBQIH/8QALRAAAgEDAwMEAgICAwEAAAAAAAECAwQRITFREkFhcYGRobHRIlIy8ULB8BT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A+4gACCSAAJIZmrXSWkdXz2A0yaW7x6med3FbZf0jHOblq3k8gaJXcnthFTqye8n8ngAS2CAB6Umtm17nuNxNd8+upUANcLz+y+DRTrRls9eHozmADrg59K5lHfVedzZSqqW3x3AsBAAkgAASQSBABIEETmorL0QnNRWX2OdWquTy9uy4A9V67l4XH7KQAAAAAAAAAAAAAAATFtarRkADdb3HVpLR/TNByTba3Gf4y37PkDSAABIAEDJJlvKuF0rd7+gFFxW6n4W37KQAAAAAHqnByaS7gKcHJ4SNlO0S/wAtX9F1KmorC/2ewPMYJbJL0RJJAFc6EX291oZa1s46rVfaN5AHJBru6GP5L3X/AGZAAAAEpkADo21bqWu63/ZacylPpaa/8jpxllJruBIAAiTwm321OXOXU233Nl7PEccv6MIAAAAAAN1lTwuru/wYTq01iKXCQHoAACCSAJAIANZOZVh0ya4f0dQw3y/knygMwAAAAAbLKpvHjVehjPdGfTJPz9AdQAAYLyWZY4RQeqzzKT8s8AAAAAAA60dl6HJOlbSzBeNALSAAJIAAkgACTHf7x9GbDnXcsyfjQCkAAAAAAAHToSzGL8EFVpPEcPlkAZGQSQAAAAAAC+1q9Lw9n9MoAHWBjt7nGktuz4NiedtQAJIAAkqrV1Hy+AFer0ry9jnM9VKjk8v/AEeAAAAAAAAAPcZ4IIAEzWG1w2eS25jicvOpUAAAAAAD1GLeiWWWUKDlrsuTdCCisJYAyK0lyl4PDU6fK/DOgAMUbyXdJ/RLvH/VfJolbwfZe2h5VrDj7YGaVxOWm3hEwtZPV6eu5thBLZJEgc6pbyj2yuUVHXM9e2T1jo/pgYAS1jR7kAAAAAAF9CnlZ8kmi0jiC85ZIFN9HZ+xkOnXh1Ra77r1OYAAAAut6XU/C3/RUdKjT6YpfPqB7SxotiSCQAIAEgEASAQBIAAouaPUsr/JfZzzrmC8p4eVs/yBnAAAlLOnJBos4ZlntHX3A2xjhJcLAPQAgwXVPplns9fc3nitT6k18eoHMBMlh4e6IAvtIZmvGp0Dn21VReuz78G/IAkAAQSABBIAAAAAABVcwzF+NS0puKyiuW9kBzgAAOlb0+mK5erM1pSy+p7LbyzcAAAEAADPdUOrVbr7RhOsZrm3zrHfuuQMRdQruOm8eOCpkAdSE1JZTyezlRk08ptGqnef2XugNQPMKkZbNP8AJ6AAkgCQCGwJBRUuYry/Blq3EpeFwgNNe5S0jq/pGGTbeXqyAALaFJyfjuxRouT8d2dCnBRWEBMYpLC2RIAAAAQSQABJBIFNe3UtdnyYalNx3X6OoRKKej1QHJBsqWn9Xjw9jNOlKO69+wHg9xrSW0meABerqfK+EP8A65+PgoAFruJv/l8JIrlJvdt+pAAAlLO2pfTtZPf+K87gZzTRtW9ZaLjuzTSoRjtq+WWgRGKSwtESAAAAAAAAABBIAAAAAABXKjF7pfgpqWsVtn5AAyzjg8gAXUqKe+TTG1gu2fVkgCyMUtkl6HoACASAIBIAAAAAAP/Z"
                                                alt="Admin" class="rounded-circle p-1 border border-warning"
                                                id="image-preview" width="180" height="180">
                                        @endif
                                        <div class="mt-3">
                                            <label for="foto" class="upload-image"><input id="foto"
                                                    name="foto" type="file" class="file"
                                                    onchange="previewImage()">

                                                Upload Image
                                                @error('foto')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </label>
                                        </div>
                                        <div class="mt-3">
                                            @error('foto')
                                                File foto hanya boleh berekstensi JPEG, JPG, PNG, dan GIF
                                            @enderror
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Email</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="email" readonly name="email" class="form-control"
                                                value="{{ old('email', Auth::guard('pakar')->user()->email) }}">
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Username</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="username" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                value="{{ old('username', Auth::guard('pakar')->user()->username) }}"
                                                autofocus>
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Nama Lengkap</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="nama"
                                                class="form-control @error('nama') is-invalid @enderror"
                                                value="{{ old('nama', Auth::guard('pakar')->user()->nama) }}">
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">No. Telepon</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="no_telepon"
                                                class="form-control @error('no_telepon') is-invalid @enderror"
                                                value="{{ old('no_telepon', Auth::guard('pakar')->user()->no_telepon) }}">
                                            @error('no_telepon')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Pendidikan Terakhir</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="pendidikan_terakhir"
                                                class="form-control @error('pendidikan_terakhir') is-invalid @enderror"
                                                value="{{ old('pendidikan_terakhir', Auth::guard('pakar')->user()->pendidikan_terakhir) }}">
                                            @error('pendidikan_terakhir')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Pekerjaan</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="pekerjaan"
                                                class="form-control @error('pekerjaan') is-invalid @enderror"
                                                value="{{ old('pekerjaan', Auth::guard('pakar')->user()->pekerjaan) }}">
                                            @error('pekerjaan')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Instansi</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="instansi"
                                                class="form-control @error('instansi') is-invalid @enderror"
                                                value="{{ old('instansi', Auth::guard('pakar')->user()->instansi) }}">
                                            @error('instansi')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Provinsi</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="dropdown-alamat">
                                                <div class="select @error('Provincy') is-invalid @enderror">
                                                    <span>Pilih Provinsi</span>
                                                    <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <input type="hidden" id="Provincy" name="Provincy">
                                                <ul class="dropdown-alamat-menu">
                                                    @foreach ($provincies as $provincy)
                                                        <li data-value="{{ $provincy->id }}">{{ $provincy->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @error('Provincy')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Kabupaten</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <div class="dropdown-alamat">
                                                <div class="select @error('regency') is-invalid @enderror">
                                                    <span>Pilih Kabupaten</span>
                                                    <i class="fa fa-chevron-left"></i>
                                                </div>
                                                <input type="hidden" id="regency" name="regencies_id">
                                                <ul class="dropdown-alamat-menu">
                                                    @foreach ($regencies as $regency)
                                                        <li data-value="{{ $regency->id }}">{{ $regency->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            @error('regency')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-sm-3">
                                            <h6 class="mb-0">Alamat</h6>
                                        </div>
                                        <div class="col-sm-9 text-secondary">
                                            <input type="text" name="alamat"
                                                class="form-control @error('alamat') is-invalid @enderror"
                                                value="{{ old('alamat', Auth::guard('pakar')->user()->alamat) }}">
                                            @error('alamat')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row justify-content-between">
                                        <div class="col-4 text-secondary">
                                            <a href="/profilepakar"><input type="button"
                                                    class="btn btn-primary px-4" value="Kembali"></a>
                                        </div>
                                        <button class="col-4 text-secondary">
                                            <input type="button" class="btn btn-primary px-4" value="Save">
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        function previewImage() {
            const foto = document.querySelector('#foto');
            const imgPreview = document.querySelector('#image-preview');
            imgPreview.style.display = 'block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(foto.files[0]);
            oFReader.onload = function(oFREvent) {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            /* Dropdown Menu */
            $('.dropdown-alamat').click(function() {
                $(this).attr('tabindex', 1).focus();
                $(this).toggleClass('active');
                $(this).find('.dropdown-alamat-menu').slideToggle(300);
            });

            $('.dropdown-alamat').focusout(function() {
                $(this).removeClass('active');
                $(this).find('.dropdown-alamat-menu').slideUp(300);
            });

            $('.dropdown-alamat .dropdown-alamat-menu li').click(function() {
                var value = $(this).data('value');
                var text = $(this).text();

                $(this).parents('.dropdown-alamat').find('span').text(text);
                $(this).parents('.dropdown-alamat').find('input').val(value);
            });
            /* End Dropdown-alamat Menu */

            $('.dropdown-alamat-menu li').click(function() {
                var input = '<strong>' + $(this).parents('.dropdown-alamat').find('input').val() +
                    '</strong>';
                var msg = '<span class="msg">Hidden input value: ';
                $('.msg').html(msg + input + '</span>');
            });
        });
    </script>

</body>

</html>

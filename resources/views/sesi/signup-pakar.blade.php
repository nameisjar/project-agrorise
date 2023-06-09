<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>AgroRise - Daftar</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Unbounded:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/bootstrap-icons.css') }}" rel="stylesheet">

    <link href="{{ asset('css/logmain.css') }}" rel="stylesheet">

    <link href="{{ asset('css/signupPakar.css') }}" rel="stylesheet">




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

                    <div class="d-none d-lg-block">
                        <a href="#" class="btn custom-btn custom-border-btn btn-naira btn-inverted">
                            <i class="btn-icon bi-cloud-download"></i>
                            <span>Masuk</span><!-- duplicated above one for mobile -->
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="bgimg">
            <div class="wrapper fadeInDown">
                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('loginError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div id="formContent">
                    <!-- Tabs Titles -->
                    <h2 class="active"> Mendaftar Pakar</h2>
                    <!-- Login Form -->
                    <form action="{{ route('pakar.signup.post') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="email" id="email" class="fadeIn second @error('email') is-invalid @enderror"
                            name="email" placeholder="Email" required autofocus value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" id="nama" class="fadeIn second @error('nama') is-invalid @enderror"
                            name="nama" placeholder="Nama Lengkap" required value="{{ old('nama') }}">
                        @error('nama')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="username" id="username"
                            class="fadeIn second  @error('username') is-invalid @enderror" name="username"
                            placeholder="Username" required value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="password" id="password"
                            class="fadeIn third pass_show @error('password') is-invalid @enderror" name="password"
                            placeholder="Password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="password" id="password_confirmation" class="fadeIn third pass_show"
                            name="password_confirmation" placeholder="Konfirmasi Password" required>
                        {{-- @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror --}}
                        <input type="text" id="no_telepon"
                            class="fadeIn second @error('no_telepon') is-invalid @enderror" name="no_telepon"
                            placeholder="Nomor Telepon" required>
                        @error('no_telepon')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" id="pendidikan_terakhir"
                            class="fadeIn second @error('pendidikan_terakhir') is-invalid @enderror"
                            name="pendidikan_terakhir" placeholder="Pendidikan Terakhir" required>
                        @error('pendidikan_terakhir')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" id="pekerjaan"
                            class="fadeIn third @error('pekerjaan') is-invalid @enderror" name="pekerjaan"
                            placeholder="Pekerjaan" required>
                        @error('pekerjaan')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" id="instansi"
                            class="fadeIn third @error('instansi') is-invalid @enderror" name="instansi"
                            placeholder="Instansi" >
                        @error('instansi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror


                        <div class="dropdown-alamat">
                            <div class="select @error('Provincy') is-invalid @enderror">
                                <span>Pilih Provinsi</span>
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <input type="hidden" id="Provincy" name="Provincy">
                            <ul class="dropdown-alamat-menu">
                                @foreach ($provincies as $provincy)
                                    <li data-value="{{ $provincy->id }}">{{ $provincy->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @error('Provincy')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                        <div class="dropdown-alamat">
                            <div class="select @error('regency') is-invalid @enderror">
                                <span>Pilih Kabupaten</span>
                                <i class="fa fa-chevron-left"></i>
                            </div>
                            <input type="hidden" id="regency" name="regencies_id">
                            <ul class="dropdown-alamat-menu">
                                @foreach ($regencies as $regency)
                                    <li data-value="{{ $regency->id }}">{{ $regency->name }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @error('regency')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <input type="text" id="alamat"
                            class="fadeIn third @error('alamat') is-invalid @enderror" name="alamat"
                            placeholder="Alamat" required>
                        @error('alamat')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <label>CV (format dalam bentuk .pdf)<br><input type="file" id="cv"
                                class="fadeIn third @error('cv') is-invalid @enderror" name="cv"
                                placeholder="CV" accept=".pdf" required>
                            @error('cv')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </label>
                        <label>Portofolio (format dalam bentuk .pdf)<br><input type="file" id="Sertifikat"
                                class="fadeIn third @error('Sertifikat') is-invalid @enderror" name="sertifikat"
                                placeholder="Sertifikat" accept=".pdf" >
                            @error('Sertifikat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </label>

                        <input type="submit" class="fadeIn fourth" value="Daftar">
                    </form>

                    <!-- Remind Passowrd -->
                    <div id="formFooter">
                        <a class="underlineHover" href="{{ route('login') }}">Masuk</a>
                    </div>

                </div>
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
        $(document).ready(function() {
            $('.pass_show').append('<span class="ptxt">Show</span>');
        });


        $(document).on('click', '.pass_show .ptxt', function() {

            $(this).text($(this).text() == "Show" ? "Hide" : "Show");

            $(this).prev().attr('type', function(index, attr) {
                return attr == 'password' ? 'text' : 'password';
            });

        });
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

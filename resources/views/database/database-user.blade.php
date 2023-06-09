<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <title>Database - Pakar</title>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://s3-us-west-2.amazonaws.com/s.cdpn.io/4579/bootstrap-table.css'>
    <link rel="stylesheet" href="{{asset('css/database.css')}}">

</head>

<body>
    <!-- partial:index.partial.html -->

    <body>
        <div id='wrapper'>
            <nav class='navbar navbar-inverse navbar-fixed-top' role='navigation'>
                <div class='navbar-header'>
                    <button type='button' class='navbar-toggle' data-toggle='collapse'
                        data-target='.navbar-hamburger-delicious'>
                        <span class='sr-only'>Toggle navigation</span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                        <span class='icon-bar'></span>
                    </button>
                    <a class='navbar-brand'>Dashboard Admin</a>
                </div>

                <div class='collapse navbar-collapse navbar-hamburger-delicious'>
                    <ul class='nav navbar-nav side-nav fadeInLeft'>
                        <li class='toggle-nav visible-lg visible-md visible-sm'><a href="{{route('index')}}"><i
                                    class='fa fa-lg fa-arrow-left'></i>Beranda</a></li>
                        {{-- <li class='dashboard'><a href='#'><i class='fa fa-lg fa-dashboard'></i>Dash</a></li> --}}
                        <li class='docs'><a href='{{ route('database-pakar') }}'><i
                                    class='fa fa-lg fa-user'></i>Database
                                Pakar</a></li>
                        <li class='active admin'><a href='{{ route('database-user') }}'><i
                                    class='fa fa-lg fa-users'></i>Database User</a></li>
                        <li class='divider'>
                            <hr>
                        </li>
                        <li class='person-lookup'><a href='{{ route('pengajuan-kursus') }}'><i
                                    class='fa fa-lg fa-check-square-o'></i>Pengajuan Kursus</a>
                        </li>
                        {{-- <li class='software-support'><a href='#softwareSupport'><i
                                    class='fa fa-lg fa-question-circle'></i>Support</a></li>
                        <li class='dashboard-updates'><a href='#dashboardUpdates'><i
                                    class='fa fa-lg fa-arrow-up'></i>Updates</a>
                        </li> --}}
                        {{-- <li class='print'><a><i class='fa fa-lg fa-sign-out'></i>Logout</a></li> --}}
                    </ul>
                    <ul class='nav navbar-nav navbar-right navbar-user'>
                        <li class='dropdown user-dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="js-user-name">
                                    @if (Auth::guard('admin')->user()->foto)
                                        <img src="{{ asset('storage/' . old('foto', Auth::guard('admin')->user()->foto)) }}"
                                            alt="Admin" class="rounded-circle p-1 border border-warning"
                                            width="40" height="40">
                                    @else
                                        <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBw8ODg0ODQ8NDQ0NDQ0NDg0NDQ8NDQ0NFREWFhURFRUYHSggGBolGxUVITEhJTUrLi4uFx8zODMsNygtLisBCgoKBQUFDgUFDisZExkrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrKysrK//AABEIALQAtAMBIgACEQEDEQH/xAAaAAEAAwEBAQAAAAAAAAAAAAAAAQMEBQIH/8QALRAAAgEDAwMEAgICAwEAAAAAAAECAwQRITFREkFhcYGRobHRIlIy8ULB8BT/xAAUAQEAAAAAAAAAAAAAAAAAAAAA/8QAFBEBAAAAAAAAAAAAAAAAAAAAAP/aAAwDAQACEQMRAD8A+4gACCSAAJIZmrXSWkdXz2A0yaW7x6med3FbZf0jHOblq3k8gaJXcnthFTqye8n8ngAS2CAB6Umtm17nuNxNd8+upUANcLz+y+DRTrRls9eHozmADrg59K5lHfVedzZSqqW3x3AsBAAkgAASQSBABIEETmorL0QnNRWX2OdWquTy9uy4A9V67l4XH7KQAAAAAAAAAAAAAAATFtarRkADdb3HVpLR/TNByTba3Gf4y37PkDSAABIAEDJJlvKuF0rd7+gFFxW6n4W37KQAAAAAHqnByaS7gKcHJ4SNlO0S/wAtX9F1KmorC/2ewPMYJbJL0RJJAFc6EX291oZa1s46rVfaN5AHJBru6GP5L3X/AGZAAAAEpkADo21bqWu63/ZacylPpaa/8jpxllJruBIAAiTwm321OXOXU233Nl7PEccv6MIAAAAAAN1lTwuru/wYTq01iKXCQHoAACCSAJAIANZOZVh0ya4f0dQw3y/knygMwAAAAAbLKpvHjVehjPdGfTJPz9AdQAAYLyWZY4RQeqzzKT8s8AAAAAAA60dl6HJOlbSzBeNALSAAJIAAkgACTHf7x9GbDnXcsyfjQCkAAAAAAAHToSzGL8EFVpPEcPlkAZGQSQAAAAAAC+1q9Lw9n9MoAHWBjt7nGktuz4NiedtQAJIAAkqrV1Hy+AFer0ry9jnM9VKjk8v/AEeAAAAAAAAAPcZ4IIAEzWG1w2eS25jicvOpUAAAAAAD1GLeiWWWUKDlrsuTdCCisJYAyK0lyl4PDU6fK/DOgAMUbyXdJ/RLvH/VfJolbwfZe2h5VrDj7YGaVxOWm3hEwtZPV6eu5thBLZJEgc6pbyj2yuUVHXM9e2T1jo/pgYAS1jR7kAAAAAAF9CnlZ8kmi0jiC85ZIFN9HZ+xkOnXh1Ra77r1OYAAAAut6XU/C3/RUdKjT6YpfPqB7SxotiSCQAIAEgEASAQBIAAouaPUsr/JfZzzrmC8p4eVs/yBnAAAlLOnJBos4ZlntHX3A2xjhJcLAPQAgwXVPplns9fc3nitT6k18eoHMBMlh4e6IAvtIZmvGp0Dn21VReuz78G/IAkAAQSABBIAAAAAABVcwzF+NS0puKyiuW9kBzgAAOlb0+mK5erM1pSy+p7LbyzcAAAEAADPdUOrVbr7RhOsZrm3zrHfuuQMRdQruOm8eOCpkAdSE1JZTyezlRk08ptGqnef2XugNQPMKkZbNP8AJ6AAkgCQCGwJBRUuYry/Blq3EpeFwgNNe5S0jq/pGGTbeXqyAALaFJyfjuxRouT8d2dCnBRWEBMYpLC2RIAAAAQSQABJBIFNe3UtdnyYalNx3X6OoRKKej1QHJBsqWn9Xjw9jNOlKO69+wHg9xrSW0meABerqfK+EP8A65+PgoAFruJv/l8JIrlJvdt+pAAAlLO2pfTtZPf+K87gZzTRtW9ZaLjuzTSoRjtq+WWgRGKSwtESAAAAAAAAABBIAAAAAABXKjF7pfgpqWsVtn5AAyzjg8gAXUqKe+TTG1gu2fVkgCyMUtkl6HoACASAIBIAAAAAAP/Z"
                                            alt="Admin" class="rounded-circle p-1 border border-warning"
                                            width="40" height="40">
                                    @endif Hallo Admin,
                                    {{ Auth::guard('admin')->user()->username }}
                                </span><b class='caret'></b></a>
                            <ul class='dropdown-menu'>
                                <li class='settings'><a href='/profileadmin'><i class='fa fa-lg fa-user'></i> Profil</a>
                                <li class='settings'><a href='/edit-password-admin'><i class='fa fa-lg fa-key'></i> Ubah
                                        Password</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </nav>

            <div id='page-wrapper'>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h2>Database User</h2>
                            <hr />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xs-12 js-content">
                            <div class="docs-table">
                                <table data-toggle="table" data-show-toggle="true" data-show-columns="true"
                                    data-search="true" data-striped="true">
                                    <thead>
                                        <tr>
                                            <th data-field="No">No</th>
                                            <th>Foto</th>
                                            <th data-field="Email">Email</th>
                                            <th data-field="Username">Username</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><img width="75" height="75"
                                                        src="{{ asset('storage/' . old('foto', $item->foto)) }}"
                                                        alt="Foto"></td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->username }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </body>
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/4579/bootstrap.min.js'></script>
    <script src='https://s3-us-west-2.amazonaws.com/s.cdpn.io/4579/bootstrap-table.js'></script>
    <script src="database.js"></script>

</body>

</html>

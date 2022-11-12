<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="resources/css/app.css">
    @yield('script_css')
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-dark fixed-top justify-content-between"  style="background-color: #006a71;">

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" href="/home"><i class="fas fa-book-open"></i>Lớp học</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('/exercise') }}">Bài tập</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('/quiz') }}">Giải đố</a>
        </li>
    </ul>

    <!-- Dropdown -->
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="navbardrop" data-toggle="dropdown" style="color: #FFFFFF;cursor: pointer;">
            @if (Auth::user())
                {{Auth::user()->name}}
            @else <i class="far fa-user"></i>
            @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{ route('/user') }}">Danh sách lớp học</a>
            <a class="dropdown-item" href="{{ route('/profile') }}">Thông tin cá nhân</a>
            @if (Auth::user())
            <a class="dropdown-item" href="/messages/{{Auth::user()->username}}">Tin nhắn</a>
            @else <a class="dropdown-item" href="/messages">Tin nhắn</a>
            @endif
            <a class="dropdown-item" href="{{ route('/logout') }}">Đăng xuất</a>
        </div>
    </div>

</nav>


<div class="container mt-5 p-lg-3">
    @yield('content')
</div>
<div class="footer-copyright text-center py-3 fixed-bottom">
</div>
</body>
</html>

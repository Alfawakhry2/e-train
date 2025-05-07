<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Etrain</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <link rel="icon" href="{{asset('front/img/favicon.png')}}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/css/bootstrap.min.css')}}">
    <!-- animate CSS -->
    <link rel="stylesheet" href="{{asset('front/css/animate.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('front/css/owl.carousel.min.css')}}">
    <!-- themify CSS -->
    <link rel="stylesheet" href="{{asset('front/css/themify-icons.css')}}">
    <!-- flaticon CSS -->
    <link rel="stylesheet" href="{{asset('front/css/flaticon.css')}}">
    <!-- font awesome CSS -->
    <link rel="stylesheet" href="{{asset('front/css/magnific-popup.css')}}">
    <!-- swiper CSS -->
    <link rel="stylesheet" href="{{asset('front/css/slick.css')}}">
    <!-- style CSS -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">


</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu bg-white">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 ">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="{{ url('') }}"> <img src="{{asset('front/img/logo.png')}}" alt="logo"> </a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item justify-content-end"
                            id="navbarSupportedContent">
                            <ul class="navbar-nav align-items-center">
                                <li class="nav-item active">
                                    <a class="nav-link" href="{{url("")}}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="about.html">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('front/all/courses') }}">Courses</a>
                                </li>
                                @auth
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('front/show/mycourses') }}">My Courses</a>
                                </li>
                                @endauth
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="blog.html" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Pages
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="single-blog.html">Single blog</a>
                                        <a class="dropdown-item" href="elements.html">Elements</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="contact.html">Contact</a>
                                </li>
                                @guest
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="{{ route('login') }}">Login</a>
                                </li>
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="{{ route('register') }}">Register</a>
                                </li>
                                @endguest
                                @auth
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="{{ url('profile')}}">Profile</a>
                                </li>
                                <li class="d-none d-lg-block">
                                    <a class="btn_1" href="{{ url('dashboard')}}">Dashboard</a>
                                </li>

                                {{-- <li class="d-none d-lg-block">
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn_2">Logout</button>
                                    </form>
                                </li> --}}
                                @endauth
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

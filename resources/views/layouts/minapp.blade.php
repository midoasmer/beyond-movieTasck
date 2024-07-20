<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalam&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/Vendors/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/Vendors/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/Vendors/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/Home.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/StyleMai.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/NavBar.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/Footer.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/Card-test.css')}}">
    <link rel="stylesheet" href="{{asset('css/Main/ourcustomer2.css')}}">
    <title>Home Page</title>
</head>

<body>
<!-- Start Nav Bar -->
<div id="to-up"></div>
<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
        <a class="navbar-brand" href="#"> Theatre</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" >Theatre</a>
{{--                    <ul class="dropdown-list">--}}
{{--                        @foreach($categoris as $category)--}}
{{--                            <li class="dropdown-item">--}}
{{--                                <a class="dropdown-link" href="javascript:void(0);" onclick="myFunction({{$category->id}});">{{$category->name}}</a></li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
                </li>
                <li>
                    <form action="" class="navbar-search">
                        <button> <i class="fas fa-search icon"></i></button>
                        <input class="search-input" placeholder="Search">
                    </form>
                </li>
            </ul>
        </div>
        <div class="navbar__nav-btn">
            <ul class="navbar-nav nav-btns m-auto d-none d-lg-block mb-2 mb-lg-0 ">
                @if(Auth::check())
                    <li class=" nav-item ">
                        @if(Auth()->user()->role=='admin')
                            <a href="{{url('admin')}}" class="btn">My Panel</a>
                        @endif
                        <form action="{{url('logout')}}" class="navbar-search" method="post">
                            @csrf
                            <button type="submit" class="btn">Log out</button>
                        </form>
                    </li>
                @else
                    <li class=" nav-item ">
                        <a href="{{url('login')}}" class="btn">Log In</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
<!-- End Nav Bar -->

    @yield('content')

<!-- Start Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="footer__logo col-lg-4 col-md-6 col-12"><a class="h1" href="#">Theatre </a></div>
        </div>
    </div>
</div>
<!-- End Footer -->

<!-- Start To Up Btn -->
<div class="to-up">
    <a href="#to-up"><i class="fas fa-arrow-up icon"></i></a>
</div>
<!-- End To Up Btn -->


<script src="{{asset('js/Vendors/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('js/Vendors/wow.min.js')}}"></script>
<script src="{{asset('js/Vendors/jquery-3.6.0.min.js')}}"></script>
<script>
    new WOW().init();
</script>
<script src="{{asset('js/Vendors/all.min.js')}}"></script>
    @yield('script')
</body>

</html>

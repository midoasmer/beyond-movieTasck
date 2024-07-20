<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Vendors/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Main/NavBar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Main/Mohamed-Marei.css') }}">
    <title>DashBoard</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <div class="sidbar col-3 bg-dark">
            <span class="fs-4 text-white dashboord__heder"><i class="fas fa-tachometer-alt dashboord__icon"></i>DashBoard</span>
            <hr class="text-white">
            <div class="accordion bg-dark" id="accordionExample">
                <div class="accordion-item accordion__color">
                    <div id="collapseFour" class="accordion-collapse collapse show accordion__color" aria-labelledby="headingFour"
                         data-bs-parent="#accordionExample">
                        <div class="accordion-body accordion__content">
                            <div class="collapse show" id="home-collapse">
                                <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                                    <li><i class="fas fa-list-ul icons"></i><a href="{{route('show_times.index')}}" class="link-dark rounded link__color">All Showtime</a></li>
                                    <li><i class="fas fa-list-ul icons"></i><a href="{{route('movies.index')}}" class="link-dark rounded link__color">All Movie</a></li>
                                    <li><i class="fas fa-list-ul icons"></i><a href="{{route('events.index')}}" class="link-dark rounded link__color">All Events</a></li>
                                    <li><i class="fas fa-list-ul icons"></i><a href="{{route('booking.index')}}" class="link-dark rounded link__color">All Booking</a></li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @yield('content')
    </div>
</div>
<script src="{{ asset('js/Vendors/all.min.js') }}"></script>
<script src="{{ asset('js/Vendors/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/Main/Main.js') }}"></script>
    @yield('script')
</body>

</html>



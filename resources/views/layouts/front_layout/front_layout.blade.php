<html lang="zxx"><head>
    <meta charset="UTF-8">
    <meta name="description" content="Male_Fashion Template">
    <meta name="keywords" content="Male_Fashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fashion</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ url('front_css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/magnific-popup.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{ url('front_css/style.css')}}" type="text/css">
</head>

<body>

    @include('layouts.front_layout.front_header')

    @yield('content')




    @include('layouts.front_layout.front_footer')

    <!-- Search Begin -->
    <div class="search-model">
        <div class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch">+</div>
            <form class="search-model-form">
                <input type="text" id="search-input" placeholder="Search here.....">
            </form>
        </div>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <script src="{{ url('front_js/jquery-3.3.1.min.js')}}"></script>
    <script src="{{ url('front_js/bootstrap.min.js')}}"></script>
    <script src="{{ url('front_js/jquery.nice-select.min.js')}}"></script>
    <script src="{{ url('front_js/jquery.nicescroll.min.js')}}"></script>
    <script src="{{ url('front_js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ url('front_js/jquery.countdown.min.js')}}"></script>
    <script src="{{ url('front_js/jquery.slicknav.js')}}"></script>
    <script src="{{ url('front_js/mixitup.min.js')}}"></script>
    <script src="{{ url('front_js/owl.carousel.min.js')}}"></script>
    <script src="{{ url('front_js/main.js')}}"></script>


</body></html>
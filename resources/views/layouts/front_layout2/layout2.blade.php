<head>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="keywords" content="Best Store Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
    Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design">
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
            function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="{{ url('front_css2/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all">
    <link href="{{ url('front_css2/style.css')}}" rel="stylesheet" type="text/css" media="all">
    <!-- js -->
    <script src="{{ url('front_js/jquery.min.js')}}"></script>
    <!-- //js -->
    <!-- cart -->
    <script src="{{ url('front_js/simpleCart.min.js')}}"></script>
    <!-- cart -->
    <!-- for bootstrap working -->
    <script type="text/javascript" src="{{ url('front_js/bootstrap-3.1.1.min.js')}}"></script>
    <!-- //for bootstrap working -->
    <link href="//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
    <link href="//fonts.googleapis.com/css?family=Lato:400,100,100italic,300,300italic,400italic,700,700italic,900,900italic" rel="stylesheet" type="text/css">
    <!-- timer -->
    <link rel="stylesheet" href="{{ url('front_css2/jquery.countdown.css')}}">
    <!-- //timer -->
    <!-- animation-effect -->
    <link href="{{ url('front_css2/animate.min.css')}}" rel="stylesheet"> 
    <script src="{{ url('front_js/wow.min.js')}}"></script>
    <script>
     new WOW().init();
    </script>
    <!-- //animation-effect -->
    <div id="_bsa_srv-CKYI627U_0"></div><div id="_bsa_srv-CKYI653J_1"></div><div id="_bsa_srv-CKYDL2JN_2"></div>
</head>






@include('layouts.front_layout2.header')

@yield('content')




@include('layouts.front_layout2.footer')
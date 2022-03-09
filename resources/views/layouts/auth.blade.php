<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="{{ url('') }}">
        <meta charset="utf-8">
        <meta name="keywords" content="Streamlab - Video Streaming HTML5 Template" />
        <meta name="description" content="Streamlab - Video Streaming HTML5 Template" />
        <meta name="author" content="StreamLab" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $page_title ?? 'Earners View Board' }}</title>
        <!-- Favicon -->
        <link rel="shortcut icon" href="{{ asset('app/images/favicon.ico') }}">
        <!-- CSS bootstrap-->
        <link rel="stylesheet" href="{{ asset('app/css/bootstrap.min.css') }}" />
        <!--  Style -->
        <link rel="stylesheet" href="{{ asset('app/css/style.css') }}" />
        <!--  Responsive -->
        <link rel="stylesheet" href="{{ asset('app/css/responsive.css') }}" />
        
        @stack('styles')
    </head>
    <body>

        <!--=========== Loader =============-->
        <div id="gen-loading">
            <div id="gen-loading-center">
                <img src="{{ asset('images/earners-logo.png') }}" alt="loading">
            </div>
        </div>
        <!--=========== Loader =============-->

        <!--=========== Main Content =============-->
        @yield('content')
        <!--=========== Main Content =============-->

        <!-- Back-to-Top start -->
        <div id="back-to-top">
            <a class="top" id="top" href="#top"> <i class="ion-ios-arrow-up"></i> </a>
        </div>
        <!-- Back-to-Top end -->

        <!-- js-min -->
        <script src="{{ asset('app/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('app/js/asyncloader.min.js') }}"></script>
        <!-- JS bootstrap -->
        <script src="{{ asset('app/js/bootstrap.min.js') }}"></script>
        <!-- owl-carousel -->
        <script src="{{ asset('app/js/owl.carousel.min.js') }}"></script>
        <!-- counter-js -->
        <script src="{{ asset('app/js/jquery.waypoints.min.js') }}"></script>
        <script src="{{ asset('app/js/jquery.counterup.min.js') }}"></script>
        <!-- popper-js -->
        <script src="{{ asset('app/js/popper.min.js') }}"></script>
        <script src="{{ asset('app/js/swiper-bundle.min.js') }}"></script>
        <!-- Iscotop -->
        <script src="{{ asset('app/js/isotope.pkgd.min.js') }}"></script>

        <script src="{{ asset('app/js/jquery.magnific-popup.min.js') }}"></script>

        <script src="{{ asset('app/js/slick.min.js') }}"></script>

        <script src="{{ asset('app/js/streamlab-core.js') }}"></script>

        <script src="{{ asset('app/js/script.js') }}"></script>

        @stack('scripts')
    </body>
</html>
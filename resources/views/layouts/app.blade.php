@php
    use App\Models\Category;

    $categories = Category::all();
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="{{ url('') }}">
        <meta charset="utf-8">
        <meta name="keywords" content="Streamlab - Video Streaming HTML5 Template" />
        <meta name="description" content="Streamlab - Video Streaming HTML5 Template" />
        <meta name="author" content="StreamLab" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>{{ $page_title ?? 'Earner\'s View' }}</title>
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

        <!--========== Header ==============-->
        <header id="gen-header" class="gen-header-style-1 gen-has-sticky">
            <div class="gen-bottom-header">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <nav class="navbar navbar-expand-lg navbar-light">
                                <a class="navbar-brand" href="#">
                                    <img class="img-fluid logo" src="{{ asset('images/earners-logo.png') }}" alt="streamlab-image">
                                </a>
                                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                    <div id="gen-menu-contain" class="gen-menu-contain">
                                        <ul id="gen-main-menu" class="navbar-nav ml-auto">
                                            <li class="menu-item active">
                                                <a href="{{ url('/') }}" aria-current="page">Home</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="#">Categories</a>
                                                <i class="fa fa-chevron-down gen-submenu-icon"></i>
                                                <ul class="sub-menu">
                                                    @foreach($categories as $category)
                                                        <li class="menu-item">
                                                            <a href="{{ $category->slug }}">{{ $category->category }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li class="menu-item">
                                                <a href="{{ url('how-it-works') }}">How it works</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="{{ url('faq') }}">FAQs</a>
                                            </li>
                                            <li class="menu-item">
                                                <a href="{{ url('contact') }}">Contacts</a>
                                            </li>
                                            @guest
                                            <li>
                                                <a href="{{ url('login') }}">Log in</a>
                                            </li>
                                            <li>
                                                <a href="{{ url('register') }}">Sign up</a>
                                            </li>
                                            @endguest

                                            <div class="d-block d-sm-none">
                                                @auth
                                                    <li>
                                                        <a href="{{ route('user.profile') }}">Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('user.report.earnings') }}">Earnings</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('user.report.referrals') }}">Referrals</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('user.report.transactions') }}">Transactions History</a>
                                                    </li>
                                                    <!-- Library Menu -->
                                                    <li>
                                                        <a href="{{ route('user.settings') }}">Settings</a>
                                                    </li>
                                                    <li>
                                                        <a href="{{ route('logout') }}"  onclick="event.preventDefault(); document.getElementById('logout-form').submit();" >
                                                            Log out 
                                                        </a>
                                                    </li>
                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                        @csrf
                                                    </form>
                                                @endauth
                                            </div>

                                        </ul>
                                    </div>
                                </div>
                                <div class="gen-header-info-box">
                                    <div class="gen-menu-search-block">
                                        <a href="javascript:void(0)" id="gen-seacrh-btn"><i class="fa fa-search"></i></a>
                                        <div class="gen-search-form">
                                            <form role="search" method="get" class="search-form" action="#">
                                                <label>
                                                    <span class="screen-reader-text"></span>
                                                    <input type="search" class="search-field" placeholder="Search …" value="" name="s">
                                                </label>
                                                <button type="submit" class="search-submit"><span
                                                    class="screen-reader-text"></span></button>
                                            </form>
                                        </div>
                                    </div>
                                    @auth
                                        <x-nav/>
                                    @endauth

                                    @guest
                                        <ul id="gen-main-menu" class="navbar-nav mr-3">
                                            <li class="menu-item">
                                                <a href="{{ route('login') }}">Log in</a>
                                            </li>
                                        </ul>

                                        <div class="gen-btn-container">
                                            <a href="{{ route('register') }}" class="gen-button">
                                                <div class="gen-button-block">
                                                    <span class="gen-button-line-left"></span>
                                                    <span class="gen-button-text">Register</span>
                                                </div>
                                            </a>
                                        </div>
                                    @endguest
                                </div>
                                <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!--========== Header ==============-->

        
        <!--========== Main Content ==============-->
        @yield('content')
        <!--========== Main Content ==============-->
        
        <!-- notifications alert -->
        @foreach(['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'gray', 'light'] as $alert)
            @if(session()->has($alert))
                <x-alert type="{{ $alert }}" :message="session()->get($alert)"/>
            @endif
        @endforeach
        <!-- notifications alert -->
        
        <!-- footer start -->
        <footer id="gen-footer">
            <div class="gen-footer-style-1">
                <div class="gen-footer-top">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="widget">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="{{ asset('images/earners-logo.png') }}" class="gen-footer-logo" alt="gen-footer-logo">
                                            <p>Watch to Earn.
                                            </p>
                                            <ul class="social-link">
                                                <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                                <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                                <li><a href="#" class="facebook"><i class="fab fa-skype"></i></a></li>
                                                <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="widget">
                                    <h4 class="footer-title">Explore</h4>
                                    <div class="menu-explore-container">
                                        <ul class="menu">
                                            <li class="menu-item">
                                                <a href="index.html" aria-current="page">Home</a>
                                            </li>
                                            <li class="menu-item"><a href="#">How it works</a></li>
                                            <li class="menu-item"><a href="#">Login</a></li>
                                            <li class="menu-item"><a href="#">Sign up</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="widget">
                                    <h4 class="footer-title">Company</h4>
                                    <div class="menu-about-container">
                                        <ul class="menu">
                                            <li class="menu-item"><a href="/faq">Faq</a></li>
                                            <!-- <li class="menu-item"><a href="contact-us.html">Company</a> -->
                                            </li>
                                            <li class="menu-item"><a href="/contact">Contact us</a></li>
                                            <li class="menu-item"><a href="#">Privacy Policy</a></li>
                                            <li class="menu-item"><a href="#">Terms Of Use</a></li>
                                            <li class="menu-item"><a href="#">Help Center</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3  col-md-6">
                                <div class="widget">
                                    <h4 class="footer-title">Get Started</h4>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <p>Watch to Earn.
                                            </p>
                                            <a href="#">
                                                <img src="{{ asset('images/earners-logo.png') }}" class="gen-playstore-logo" alt="playstore">
                                            </a>
                                            <!-- <a href="#">
                                                <img src="{{ asset('app/images/asset-36.png') }}" class="gen-appstore-logo" alt="appstore">
                                            </a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="gen-copyright-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 align-self-center">
                                <span class="gen-copyright">
                                    <a target="_blank" href="#"> Copyright 2021 stremlab All Rights Reserved.</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer End -->

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
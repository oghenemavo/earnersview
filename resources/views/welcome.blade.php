@extends('layouts.app')

@section('content')
    <!-- owl-carousel Banner Start -->
    <section class="pt-0 pb-0">
        <div class="container-fluid px-0">
            <div class="row no-gutters">
                <div class="col-12">
                    <div class="gen-banner-movies">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="1" data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="true" data-loop="true" data-margin="30">
                            @foreach($slider as $video)
                                <div class="item" style="background: url('{{ $video->cover_path }}')">
                                    <div class="gen-movie-contain h-100">
                                        <div class="container h-100">
                                            <div class="row align-items-center h-100">
                                                <div class="col-xl-6">
                                                    <div class="gen-tag-line"><span></span></div>
                                                    <div class="gen-movie-info">
                                                        <h3>{{ $video->title }}</h3>
                                                    </div>
                                                    <div class="gen-movie-meta-holder">
                                                        <ul>
                                                            <li class="gen-sen-rating">
                                                                <span>
                                                                    R </span>
                                                            </li>
                                                            <li>1hr 44 mins</li>
                                                            <li> <img src="{{ $video->cover_path }}" alt="streamlab-image">
                                                                <span>
                                                                    0 </span>
                                                            </li>
                                                            <li>
                                                                2018
                                                            </li>
                                                            <li>
                                                                <a href="action.html"><span>{{ $video->category->category }}</span></a>
                                                            </li>
                                                        </ul>
                                                        <p>{{ strip_tags(htmlspecialchars_decode(Str::limit($video->description, 253))) }}</p>
                                                    </div>
                                                    <div class="gen-movie-action">
                                                        <div class="gen-btn-container button-1">
                                                            <a href="single-movie.html" class="gen-button">
                                                                <span class="text">Play Now</span>
                                                            </a>
                                                        </div>
                                                        <div class="gen-btn-container button-2">
                                                            <a href="{{ $video->url }}"
                                                                class="gen-button popup-youtube popup-vimeo popup-gmaps gen-button-link">
                                                                <i aria-hidden="true" class="ion ion-play"></i> 
                                                                <span class="text">Watch Trailer</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Banner End -->

    <!-- owl-carousel Videos Section-1 Start -->
    <section class="gen-section-padding-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Most Popular</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                    <div class="gen-movie-action">
                        <div class="gen-btn-container text-right">
                            <a href="tv-shows-pagination.html" class="gen-button gen-button-flat">
                                <span class="text">More Videos</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="gen-style-2">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="false" data-loop="false" data-margin="30">

                            @foreach($feed as $video)
                            <div class="item">
                                <div class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="{{ $video->cover_path }}" alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button" class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a> </li>
                                                                <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                                                <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">
                                                                        Sign in to add this movie to a playlist.
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">My Generation</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 24 mins</li>
                                                        <li>
                                                            <a href="action.html"><span>{{ $video->category->category }}</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Videos Section-1 End -->

    <!-- owl-carousel Videos Section-2 Start -->
    <section class="pt-0 gen-section-padding-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Most Viewed</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                    <div class="gen-movie-action">
                        <div class="gen-btn-container text-right">
                            <a href="tv-shows-pagination.html" class="gen-button gen-button-flat">
                                <span class="text">More Videos</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="gen-style-2">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="false" data-loop="false" data-margin="30">
                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-5.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">The
                                                            warrior life</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>2hr 00mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>

                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-6.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">machine
                                                            war</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1h 22mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-7.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">the
                                                            horse lady</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 24 mins</li>
                                                        <li>
                                                            <a href="drama.html"><span>Drama</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-8.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Ship
                                                            of full moon</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 35mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-9.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Rebuneka
                                                            the doll</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 44 mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-4.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">thieve
                                                            the bank</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>30min</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-8.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Ship of full moon</a></h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 35mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-11.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">the
                                                            giant ship</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1h 02 mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-12.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">common
                                                            man’s idea</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 51 mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-13.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">the
                                                            jin’s friend</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 42 mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Videos Section-2 End -->

    <!-- owl-carousel images Start -->
    <section class="pt-0 pb-0 gen-section-padding-2 home-singal-silder">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="gen-banner-movies">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="true" data-nav="false"
                            data-desk_num="1" data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="true" data-loop="true" data-margin="30">
                            @foreach($promotions as $promotion)
                                <div class="item" style="background: url('{{ $promotion->material_path }}')">
                                    <div class="gen-movie-contain h-100">
                                        <div class="container h-100">
                                            <div class="row align-items-center h-100">
                                                <div class="col-xl-6">
                                                    <div class="gen-tag-line"><span>New Realease</span></div>
                                                    <div class="gen-movie-info">
                                                        <h3>{{ $promotion->title }}</h3>
                                                    </div>
                                                    <div class="gen-movie-meta-holder">
                                                        <ul>
                                                            <li class="gen-sen-rating">
                                                                <span>
                                                                    R </span>
                                                            </li>
                                                            <li>2hr 00mins</li>
                                                            <li> <img src="{{ asset('images/asset-2.png') }}" alt="streamlab-image">
                                                                <span>
                                                                    8.5 </span>
                                                            </li>
                                                            <li>
                                                                2020
                                                            </li>
                                                            <li>
                                                                <a href="action.html"><span>Action</span></a>
                                                            </li>
                                                        </ul>
                                                        <p>ssssassd is a long established fact that a reader will be
                                                            distracted by the readable content of a page when Streamlab at
                                                            its layout Streamlab.</p>
                                                    </div>
                                                    <div class="gen-movie-action">
                                                        <div class="gen-btn-container button-1">
                                                            <a href="single-movie.html" class="gen-button">
                                                                <i aria-hidden="true" class="ion ion-play"></i> <span
                                                                    class="text">Play now</span>
                                                            </a>
                                                        </div>
                                                        <div class="gen-btn-container button-2">
                                                            <a href="https://www.youtube.com/watch?v=hG4lT4fxj8M"
                                                                class="gen-button popup-youtube popup-vimeo popup-gmaps gen-button-link">
                                                                <span class="text">Watch Trailer</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel images End -->

    <!-- owl-carousel Videos Section-3 Start -->
    <section class="gen-section-padding-2">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Powerful Crime Thrillers</h4>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 d-none d-md-inline-block">
                    <div class="gen-movie-action">
                        <div class="gen-btn-container text-right">
                            <a href="tv-shows-pagination.html" class="gen-button gen-button-flat">
                                <span class="text">More Videos</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="gen-style-2">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="false" data-nav="true"
                            data-desk_num="4" data-lap_num="3" data-tab_num="2" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="false" data-loop="false" data-margin="30">
                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-10.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">skull of myths</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 24mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>

                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-12.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">common man’s idea</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1h 51mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-29.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">shimu the elephant</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 54mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-30.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">War of Rejonse</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>2hr 20mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-31.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">The Big Sick</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>2hr 00mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-24.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">The Last Witness</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 37mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-32.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Love, Simon</a></h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 50mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-33.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Black Water</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>1hr 44mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>


                            <div class="item">
                                <div
                                    class="movie type-movie status-publish has-post-thumbnail hentry movie_genre-action movie_genre-adventure movie_genre-drama">
                                    <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                        <div class="gen-movie-contain">
                                            <div class="gen-movie-img">
                                                <img src="images/background/asset-34.jpeg"
                                                    alt="owl-carousel-video-image">
                                                <div class="gen-movie-add">
                                                    <div class="wpulike wpulike-heart">
                                                        <div class="wp_ulike_general_class wp_ulike_is_not_liked">
                                                            <button type="button"
                                                                class="wp_ulike_btn wp_ulike_put_image"></button>
                                                        </div>
                                                    </div>
                                                    <ul class="menu bottomRight">
                                                        <li class="share top">
                                                            <i class="fa fa-share-alt"></i>
                                                            <ul class="submenu">
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-facebook-f"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-instagram"></i></a>
                                                                </li>
                                                                <li><a href="#" class="facebook"><i
                                                                            class="fab fa-twitter"></i></a></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                    <div class="movie-actions--link_add-to-playlist dropdown">
                                                        <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                                class="fa fa-plus"></i></a>
                                                        <div class="dropdown-menu mCustomScrollbar">
                                                            <div class="mCustomScrollBox">
                                                                <div class="mCSB_container">
                                                                    <a class="login-link" href="register.html">Sign in
                                                                        to add this
                                                                        movie to a
                                                                        playlist.</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <a href="single-movie.html" class="gen-button">
                                                        <i class="fa fa-play"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="gen-info-contain">
                                                <div class="gen-movie-info">
                                                    <h3><a href="single-movie.html">Bad Genius</a>
                                                    </h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>2hr 10mins</li>
                                                        <li>
                                                            <a href="action.html"><span>Action</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- #post-## -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl-carousel Videos Section-3 End -->
@endsection
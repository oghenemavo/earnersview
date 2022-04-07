@extends('layouts.app')

@section('content')
    <!-- breadcrumb -->
    <div class="gen-breadcrumb" style="background-image: url('images/background/asset-25.jpeg');">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav aria-label="breadcrumb">
                        <div class="gen-breadcrumb-title">
                            <h1>
                                {{ $category->category }}
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i
                                            class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">{{ ucfirst($category->category) }}</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- Action Movies -->
    <section class="gen-section-padding-3">
        <div class="container">

            <!-- notifications alert -->
            @foreach(['primary', 'secondary', 'success', 'info', 'warning', 'danger', 'gray', 'light'] as $alert)
                @if(session()->has($alert))
                    <x-alert type="{{ $alert }}" :message="session()->get($alert)"/>
                @endif
            @endforeach
            <!-- notifications alert -->


            <!-- <div class="item" style="position: relative;">
                                <img src="{{ asset('images/earners-logo.png') }}" style="width:40px; position:absolute; z-index: 999;"> -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">                     
                        @foreach($videos as $video)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                    <div class="gen-movie-contain" style="position: relative;">
                                        <img src="{{ asset('images/earners-logo.png') }}" style="width:40px; position:absolute; z-index: 999;">
                                        <div class="gen-movie-img">
                                            <!-- <img src="{{ asset('app/images/black.jpg') }}"  alt="owl-carousel-video-image"> -->
                                            <img src="{{ $video->cover_path }}" style="width: 312px; height: 207px; object-fit:cover;"  alt="single-video-image">
                                            <div class="gen-movie-add">
                                                <div class="wpulike wpulike-heart">
                                                    <div class="wp_ulike_general_class">
                                                        <a href="#" class="sl-button text-white">
                                                            <i class="far fa-heart"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <ul class="menu bottomRight">
                                                    <li class="share top">
                                                        <i class="fa fa-share-alt"></i>
                                                        <ul class="submenu">
                                                            <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                                                            </li>
                                                                <li><a href="https://www.instagram.com/earnerview_tv/" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                                                <li><a href="https://twitter.com/Earnerviewtv" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <div class="video-actions--link_add-to-playlist dropdown">
                                                    <a class="dropdown-toggle" href="#" data-toggle="dropdown"><i
                                                            class="fa fa-plus"></i></a>
                                                    <div class="dropdown-menu">
                                                        <a class="login-link" href="#">Sign in to add this video to a playlist.</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="gen-movie-action">
                                                <a href="{{ route('video', $video->slug) }}" class="gen-button">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gen-info-contain">
                                            <div class="gen-movie-info">
                                                <h3><a href="{{ route('video', $video->slug) }}">{{ $video->title }}</a></h3>
                                            </div>
                                            <div class="gen-movie-meta-holder">
                                                <ul>
                                                    <li>{{ $video->created_at->diffForHumans() }}</li>
                                                    <li>
                                                        <a href="index.html"><span>{{ $video->category->category }}</span></a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- <div class="row">
                        <div class="col-lg-12">
                            <div class="gen-pagination">
                                <nav aria-label="Page navigation">
                                    <ul class="page-numbers">
                                        <li><span aria-current="page" class="page-numbers current">1</span></li>
                                        <li><a class="page-numbers" href="#">2</a></li>
                                        <li><a class="page-numbers" href="#">3</a></li>
                                        <li><a class="next page-numbers" href="#">Next page</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </div>
    </section>
    <!-- Action Movies -->

    <!-- promotions Start -->
    <section class="pt-0 pb-0 mb-4 gen-section-padding-2 home-singal-silder">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <h4 class="gen-heading-title">Promotions</h4>
                </div>

                <div class="col-12">
                    <div class="gen-banner-movies">
                        <div class="owl-carousel owl-loaded owl-drag" data-dots="true" data-nav="false"
                            data-desk_num="1" data-lap_num="1" data-tab_num="1" data-mob_num="1" data-mob_sm="1"
                            data-autoplay="true" data-loop="true" data-margin="30" data-video="true">

                            @foreach($promotions as $promo)
                                @if ($filetype($promo->material))
                                    <div class="item" style="background: url('{{ $promo->material_path }}')">
                                @else
                                    <div class="item">
                                        <video class="owl-video-frame" controls autoplay>
                                            <source src="{{ $promo->material_path }}" type="video/mp4">
                                        </video>
                                @endif
                                <div class="gen-movie-contain h-100">
                                    <div class="container h-100">
                                        <div class="row align-items-center h-100">
                                            <div class="col-xl-6">
                                                @if ($current_time->diffInHours($promo->created_at) < 120 )
                                                <div class="gen-tag-line">
                                                    <span>New Realease</span>
                                                </div>
                                                @endif
                                                <div class="gen-movie-info">
                                                    <h3>{{ $promo->title }}</h3>
                                                </div>
                                                <div class="gen-movie-meta-holder">
                                                    <ul>
                                                        <li>{{ $promo->created_at->format('M Y') }}</li>
                                                        <li><a href="#"><span>ads</span></a></li>
                                                    </ul>
                                                    <p>
                                                        Earners View ads.
                                                    </p>
                                                </div>
                                                <div class="gen-movie-action">
                                                    <!-- <div class="gen-btn-container button-1">
                                                        <a href="single-movie.html" class="gen-button">
                                                            <i aria-hidden="true" class="ion ion-play"></i> 
                                                            <span class="text">Play now</span>
                                                        </a>
                                                    </div> -->
                                                    <!-- <div class="gen-btn-container button-2">
                                                        <a href="https://www.youtube.com/watch?v=hG4lT4fxj8M"
                                                            class="gen-button popup-youtube popup-vimeo popup-gmaps gen-button-link">
                                                            <span class="text">Watch Trailer</span>
                                                        </a>
                                                    </div> -->
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
    <!-- promotions End -->
@endsection
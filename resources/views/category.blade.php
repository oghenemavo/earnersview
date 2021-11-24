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



            <div class="row">
                <div class="col-lg-12">
                    <div class="row">                     
                        @foreach($videos as $video)
                            <div class="col-xl-3 col-lg-4 col-md-6">
                                <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                    <div class="gen-movie-contain">
                                        <div class="gen-movie-img">
                                            <img src="{{ $video->cover_path }}" alt="single-video-image">
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
                                                            <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a>
                                                            </li>
                                                            <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
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
                                                <a href="index.html" class="gen-button">
                                                    <i class="fa fa-play"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="gen-info-contain">
                                            <div class="gen-movie-info">
                                                <h3><a href="index.html">{{ $video->title }}</a></h3>
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
@endsection
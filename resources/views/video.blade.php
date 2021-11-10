@extends('layouts.app')

@section('content')
<!-- Single Video Start -->
<section class="gen-section-padding-3 gen-single-video">
    <div class="container">
        <div class="row no-gutters">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="gen-video-holder">
                            <iframe width="100%" height="550px" src="https://www.youtube.com/embed/{{ $video->video_id }}"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen></iframe>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="single-video">
                            <div class="gen-single-video-info">
                                <h2 class="gen-title">{{ $video->title }}</h2>
                                <div class="gen-single-meta-holder">
                                    <ul>
                                        <li>2 years</li>
                                        <li>
                                            <a href="#"><span>{{ $video->category->category }}</span></a>
                                        </li>
                                        <li>
                                            <i class="fas fa-eye">
                                            </i>
                                            <span>225 Views</span>
                                        </li>
                                    </ul>
                                </div>
                                {!! htmlspecialchars_decode($video->description) !!}
                                <div class="gen-socail-share mt-0">
                                    <h4 class="align-self-center">Social Share :</h4>
                                    <ul class="social-inner">
                                        <li><a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-instagram"></i></a></li>
                                        <li><a href="#" class="facebook"><i class="fab fa-twitter"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="pm-inner">
                            <div class="gen-more-like">
                                <h5 class="gen-more-title">More Like This</h5>
                                <div class="row post-loadmore-wrapper">
                                    @foreach($latest_videos as $video)
                                    <div class="col-xl-3 col-lg-4 col-md-6">
                                        <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                            <div class="gen-movie-contain">
                                                <div class="gen-movie-img">
                                                    <img src="{{ $video->cover_path }}"
                                                        alt="single-video-image">
                                                    <div class="gen-movie-add">
                                                        <div class="wpulike wpulike-heart">
                                                            <div class="wp_ulike_general_class">
                                                                <a href="#" class="sl-button text-white"><i class="far fa-heart"></i></a>
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
                                                            <a class="dropdown-toggle" href="#"
                                                                data-toggle="dropdown"><i
                                                                    class="fa fa-plus"></i></a>
                                                            <div class="dropdown-menu">
                                                                <a class="login-link" href="#">Sign in to add this video to a playlist.</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="gen-movie-action">
                                                        <a href="video-home.html" class="gen-button">
                                                            <i class="fa fa-play"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="gen-info-contain">
                                                    <div class="gen-movie-info">
                                                        <h3><a href="video-home.html">{{ $video->title }}</a></h3>
                                                    </div>
                                                    <div class="gen-movie-meta-holder">
                                                        <ul>
                                                            <li>2 weeks</li>
                                                            <li>
                                                                <a href="adventure.html"><span>{{ $video->category->category }}</span></a>
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
                                        <div class="gen-load-more-button">
                                            <div class="gen-btn-container">
                                                <a class="gen-button gen-button-loadmore" href="#">
                                                    <span class="button-text">Load More</span>
                                                    <span class="loadmore-icon" style="display: none;"><i
                                                            class="fa fa-spinner fa-spin"></i></span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Single Video End -->
@endsection
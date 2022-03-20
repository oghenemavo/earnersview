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
                            <iframe id="existing-iframe-example"
                            width="100%" height="550px" src="https://www.youtube.com/embed/{{ $video->video_id }}?enablejsapi=1&disablekb=1&modestbranding=1&rel=0&controls=0"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                allowfullscreen>
                            </iframe>
                        </div>
                    </div>
                    
                    <div class="col-lg-12">
                        <div class="single-video">
                            <div class="gen-single-video-info">
                                <h2 class="gen-title">{{ $video->title }}</h2>
                                <div class="gen-single-meta-holder">
                                    <ul>
                                        <li>&#8358;{{ $earning(['earnable' => $video->earnable, 'earnable_ns' => $video->earnable_ns]) }}</li>
                                        <li>{{ $duration($video->length) }} mins</li>
                                        <li>{{ $video->created_at->diffForHumans() }}</li>
                                        <li>
                                            <a href="#"><span>{{ $video->category->category }}</span></a>
                                        </li>
                                        <li>
                                            <i class="fas fa-eye"></i>
                                            <span>{{ $views }} Views</span>
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
                                    @foreach($latest_videos as $media_video)
                                        <div class="col-xl-3 col-lg-4 col-md-6">
                                            <div class="gen-carousel-movies-style-3 movie-grid style-3">
                                                <div class="gen-movie-contain">
                                                    <div class="gen-movie-img">
                                                        <img src="{{ $media_video->cover_path }}"
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
                                                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                                                <i class="fa fa-plus"></i>
                                                            </a>
                                                            <div class="dropdown-menu">
                                                                <a class="login-link" href="#">Sign in to add this video to a playlist.</a>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="gen-movie-action">
                                                            <a href="{{ route('video', $media_video->slug) }}" class="gen-button">
                                                                <i class="fa fa-play"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="gen-info-contain">
                                                        <div class="gen-movie-info">
                                                            <h3><a href="{{ route('video', $media_video->slug) }}">{{ $media_video->title }}</a></h3>
                                                        </div>
                                                        <div class="gen-movie-meta-holder">
                                                            <ul>
                                                                <li>2 weeks</li>
                                                                <li>
                                                                    <a href="{{ route('video', $media_video->slug) }}"><span>{{ $media_video->category->category }}</span></a>
                                                                </li>
                                                            </ul>
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
            </div>
        </div>
    </div>
</section>
<!-- Single Video End -->


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
                                        <video class="owl-video-frame" controls>
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

@if($user)
    @if(
        (!$subscription && ($watched_count < $max_videos) ) || 
        ( $subscription && ($watched_count < $max_videos_ns) )
    )
        @push('scripts')
            <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                var payoutDuration = `{{ $video->earned_after }}`;


                var tag = document.createElement('script');
                tag.id = 'iframe-demo';
                tag.src = 'https://www.youtube.com/iframe_api';
                var firstScriptTag = document.getElementsByTagName('script')[0];
                firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

                var player;
                function onYouTubeIframeAPIReady() {
                    player = new YT.Player('existing-iframe-example', {
                        events: {
                            'onReady': onPlayerReady,
                            'onStateChange': onPlayerStateChange,
                            'onPlaybackRateChange': onPlayerPlaybackRateChange,
                            'onError': onPlayerError
                        }
                    });
                }

                function onPlayerReady(event) { // Player has finised loading and is ready to begin receiving API calls
                }

                var done = false;
                function onPlayerStateChange(event) { // Whenever player state changes
                    // check if video is playing
                    videoPlayer(event);
                }

                function onPlayerPlaybackRateChange(event) {}
                function onPlayerError() {}

                function videoPlayer(event) {
                    // video is still playing
                    if (event.data == YT.PlayerState.PLAYING && !done) {
                        var payoutTimer = setInterval(validForPayout, 1000); // run interval every second
                        function validForPayout() {
                            console.log('Current Play time: ', player.getCurrentTime());
                            console.log('payoutDuration: ', payoutDuration);
                            if (player.getCurrentTime() >= payoutDuration) {
                                clearInterval(payoutTimer);
                                done = true;
                                console.log("payout eligible");

                                $.post("{{ route('user.report.log.video', $video->id) }}",
                                    {
                                        "_token": `{{ csrf_token() }}`,
                                        played: player.getCurrentTime(),
                                    },
                                    function (data, textStatus, jqXHR) {
                                        console.log(data)
                                        if (data.success) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'success',
                                                title: `Your wallet has been credited with &#8358;{{ $earning(['earnable' => $video->earnable, 'earnable_ns' => $video->earnable_ns]) }}`,
                                                showConfirmButton: false,
                                                timer: 3500,
                                            })
                                        }

                                        if (data.error) {
                                            Swal.fire({
                                                position: 'top-end',
                                                icon: 'danger',
                                                title: `Unable to approve video activity`,
                                                showConfirmButton: false,
                                                timer: 3500,
                                            })
                                        }
                                    },
                                    "json"
                                );
                            }
                        }
                    }
                }

                function between(x, min, max) {
                    return x >= min && x <= max;
                }
            </script>

        @endpush
    @endif
@endif
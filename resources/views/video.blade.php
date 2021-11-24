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
                                        title: `Your wallet has been credited with &#8358;{{ $video->earnable }}`,
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
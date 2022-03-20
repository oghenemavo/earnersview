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
                                contact us
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fas fa-home mr-2"></i>Home</a></li>
                                <li class="breadcrumb-item active">contact us</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- Icon-Box Start -->
    <section class="gen-section-padding-3">
        <div class="container container-2">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <div class="gen-icon-box-style-1">
                        <div class="gen-icon-box-icon">
                            <span class="gen-icon-animation">
                                <i class="fas fa-map-marker-alt"></i></span>
                        </div>
                        <div class="gen-icon-box-content">
                            <h3 class="pt-icon-box-title mb-2">
                                <span>Our Location</span>
                            </h3>
                            <p class="gen-icon-box-description">The Queen's Walk, Bishop's, London SE1 7PB, United
                                Kingdom</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mt-4 mt-md-0">
                    <div class="gen-icon-box-style-1">
                        <div class="gen-icon-box-icon">
                            <span class="gen-icon-animation">
                                <i class="fas fa-phone-alt"></i></span>
                        </div>
                        <div class="gen-icon-box-content">
                            <h3 class="pt-icon-box-title mb-2">
                                <span>call us at</span>
                            </h3>
                            <p class="gen-icon-box-description">+ (567) 1234-567-8900<br>+ (567) 1234-567-8901</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-12 mt-4 mt-xl-0">
                    <div class="gen-icon-box-style-1">
                        <div class="gen-icon-box-icon">
                            <span class="gen-icon-animation">
                                <i class="far fa-envelope"></i></span>
                        </div>
                        <div class="gen-icon-box-content">
                            <h3 class="pt-icon-box-title mb-2">
                                <span>Mail us</span>
                            </h3>
                            <p class="gen-icon-box-description">info@gentechtree.com<br>info2@gentechtree.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Icon-Box End -->

    <!-- Map Start -->
    <Section class="gen-section-padding-3 gen-top-border">
        <div class="container container-2">
            <div class="row">
                <div class="col-xl-6">
                    <h2 class="mb-5">get in touch</h2>
                    <form>
                        <div class="row gt-form">
                            <div class="col-md-6 mb-4"><input type="text" name="first_name" placeholder="Your Name">
                            </div>
                            <div class="col-md-6 mb-4"><input type="email" name="your-email" placeholder="Email"></div>
                            <div class="col-md-6 mb-4"><input type="text" name="your-Cell-phone"
                                    placeholder="Cell Phone">
                            </div>
                            <div class="col-md-6 mb-4"><input type="text" name="your-Venue" placeholder="Venue"></div>
                            <div class="col-md-12 mb-4"><textarea name="your-message" rows="6"
                                    placeholder="Your Message"></textarea><br>
                                <input type="submit" value="Send" class="mt-4">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xl-6">
                    <div style="width: 100%"><iframe width="100%" height="550" frameborder="0" scrolling="no"
                            marginheight="0" marginwidth="0"
                            src="https://maps.google.com/maps?width=100%25&amp;height=550&amp;hl=en&amp;q=+(My%20BusiLondon%20Eye,%20London,%20United%20Kingdomness%20Name)&amp;t=&amp;z=9&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </Section>
    <!-- Map End -->

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
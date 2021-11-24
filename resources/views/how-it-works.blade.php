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
                                How it Works
                            </h1>
                        </div>
                        <div class="gen-breadcrumb-container">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fas fa-home mr-2"></i>Home
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">how it works</li>
                            </ol>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->

    <!-- blog single -->
    <section class="gen-section-padding-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12">
                    <div class="gen-blog-post">
                        <div class="gen-post-media">
                            <img src="images/background/asset-19.jpeg" alt="blog-image" loading="lazy">
                        </div>
                        <div class="gen-blog-contain">
                            <div class="gen-post-meta">
                                <ul>
                                    <li class="gen-post-author"><i class="fa fa-user"></i>admin</li>
                                    <li class="gen-post-meta"><a href="#"><i class="fa fa-calendar"></i>January 25,
                                            2021</a>
                                    </li>
                                    <li class="gen-post-tag">
                                        <a href="#"><i class="fa fa-tag"></i>Uncategorized</a>
                                    </li>
                                </ul>
                            </div>
                            <p>Live streaming is a powerful way to connect with your target audience and personalize
                                your message in a way thatu2019s unique compared to other marketing mediums. Itu2019s a
                                simple process to send a live feed over the internet to your audience, but it can have
                                big results. The growth of live streaming has been exponential, with the
                                marketu00a0increasing from $30 billion in 2016 to an expected value of $70 billion in
                                2021u00a0andu00a0$184 billion by 2027. Thatu2019s a huge amount of growth, and itu2019s
                                something thatu2019s forcing marketers to sit up and take notice, withu00a028% starting
                                to invest more in live streaming.</p>
                            <h2>Live streaming is growing fast</h2>
                            <p>One of the main reasons you should care about live stream is simply due to its huge user
                                base and growing popularity.nnThe potential to reach thousands (or more) of new
                                customers with the click of a button is becoming a reality.nWhen tactics like search
                                engine optimization and content marketing are taking up too much time and money, you
                                need a new outlet to drive traffic. Using live-stream platforms is a nearly free way to
                                drive tons of revenue for your business.</p>
                            <div class="row mb-4">
                                <div class="col-xl-6 col-md-6">
                                    <div class="gen-img-main">
                                        <img src="images/background/asset-40.jpg" alt="streamlab-image">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-md-6 mt-4 mt-md-0">
                                    <div class="gen-img-main">
                                        <img src="images/background/asset-67.jpg" alt="streamlab-image">
                                    </div>
                                </div>
                            </div>
                            <h2>Engage your viewers in real time</h2>
                            <p>Beyond these technical aspects, keeping your audience engaged is paramount to a
                                productive live stream. Your audience enjoys your content from behind a screen, but that
                                doesnu2019t mean live streaming has to be a one-way street. Encouraging dialogue with
                                your audience is a must-have for any successful stream.</p>
                            <div class="gen-blog-spot-video mb-4">
                                <iframe src="https://www.youtube.com/embed/XHOmBV4js_E" name="iFrame Name"
                                    scrolling="No" height="500px" width="100%" style="border: none;"></iframe>
                            </div>
                            <h2>Rethink how youu2019ll tackle the next one</h2>
                            <p>No doubt that all of this can feel daunting, so remember to take it bit by bit. Julie
                                Starr, Director of Learning & Development at Convene, advises to not get bogged down
                                with making tons of improvements every time. u201cAt Convene, we like to talk about
                                u201cGetting 1% better every day,u2019u201d she says. u201cItu2019s important to keep
                                the content fresh, and respond to the needs of your participants.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 mt-4 mt-lg-0">
                </div>
            </div>
        </div>
    </section>
    <!-- blog single -->
@endsection
@extends('frontend.layouts.default')

@section('content')
        @if($dbl_last_post_featured_super)
            <section class="destacado">
                @include('frontend.pages.home.featured_super')
            </section>
        @endif
        <section id="banner">
            @include('frontend.pages.home.banner')
        </section>
        <section id="news">
            @include('frontend.pages.home.latest_news')
        </section>
        <section id="big_banner">
            <img src="images/maq/banner.jpg" alt="">
        </section>
        <section id="videos">
                <div class="left_video">
                    <div class="video_title">
                        Videos
                    </div>
                    <div class="video_animation"><img src="images/maq/video.png"></div>
                    <div class="video_paginate"><img src="images/maq/paginate.jpg" alt=""></div>
                </div>
                <div class="right_video">
                    <div class="video_title">
                        Cartelera
                    </div>
                    <div class="playing">
                        <img src="images/maq/cartelera.jpg" width="100%" height="90%" />
                        <div class="release_date">
                            Estreno: 9 de Enero <a href="#" class="custom_color_bg">Ver trailer</a>
                        </div>
                    </div>

                </div>

        </section>

        <section id="ads">
            @include('frontend.pages.home.other_sections')
        </section>
@stop

@section('js')
@stop
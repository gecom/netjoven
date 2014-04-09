@extends('frontend.layouts.default')

@section('content')

<section id="banner">
    <div class="left_banner">
        @include('frontend.pages.home.banner')
    </div><div class="right_banner">
        @include('frontend.pages.home.featured_principal')
    </div>
</section>
<section id="news">
    <div class="title_news">Últimas noticias</div>
    @include('frontend.pages.home.topics_day')
    <section>
        @include('frontend.pages.home.latest_news')
    </section>
    <div class="paginate">
            @include('frontend.pages.paginate')
    </div>
</section>
<section id="big_banner"></section>
<section id="videos">
    <div class="left_video">
        <div class="video_title">
            Videos
        </div>
        <div class="video_animation"><img src="/assets/images/maq/video.png"></div>
        <div class="video_paginate"><img src="/assets/images/maq/paginate.jpg" alt=""></div>
    </div><div class="right_video">
        <div class="video_title">
            Cartelera
        </div>
        <div class="playing">
            <img src="/assets/images/maq/cartelera.png">
        </div>
        <div class="release_date">
            Estreno: 9 de Enero <a href="#">Ver trailer</a>
        </div>
    </div>

</section>
<section id="ads">
    @include('frontend.pages.home.other_sections')
</section>
@stop

@section('js')
@stop
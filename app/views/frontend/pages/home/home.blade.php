@extends('frontend.layouts.default')

@section('css')
    {{ HTML::style('assets/css/bxslider/jquery.bxslider.css')}}
@stop

@section('content')
        @if($dbl_last_post_featured_super)
            <section class="destacado">
                @include('frontend.pages.home.featured_super')
            </section>
        @endif
        <section id="banner">
            @include('frontend.pages.home.banner')
        </section>
        <section id="news" class="v_news">
            @include('frontend.pages.home.latest_news')
        </section>
        <section id="big_banner">
            <img src="images/maq/banner.jpg" alt="">
        </section>
        <section id="videos">
                <div class="left_video">                    
                    @include('frontend.pages.home.featured_video')
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
        <section id="news_two" class="v_news" style="display:block">
            @if ($type_module == Helpers::TYPE_MODULE_LISTADO || $type_module == Helpers::TYPE_MODULE_MODULAR)
                @include('frontend.pages.home.more_news')
            @endif
        </section>
        <section id="ads">
            @include('frontend.pages.home.other_sections')
        </section>
@stop

@section('js')
    {{ HTML::script('assets/js/bxslider/jquery.bxslider.min.js'); }}
    {{ HTML::script('assets/js/fn/home.js'); }}
@stop
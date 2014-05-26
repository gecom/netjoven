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
        @include('frontend.pages.partials.banner_intermedio')
        <section id="videos">
            <div class="left_video">                    
                @include('frontend.pages.home.featured_video')
            </div>
            <div class="right_video">
                @include('frontend.pages.home.post_cartelera')  
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
@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<section id="portada_espectaculos"  class="{{$type_module == Helpers::TYPE_MODULE_LISTADO ? 'view_3': ''}}">
    <div class="title custom_color_text">{{$title_section}}</div>

    @if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
        <div class="left2_column">
            <div class="add">
                <img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
            </div>
            @if ($type_module == Helpers::TYPE_MODULE_MODULAR)
                <div class="plugin_fb">
                    @include('frontend.pages.partials.likebox')
                </div>
            @endif
        </div>
    @endif

    <div class="left_column  {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO  ? 'left3_column': ''}} ">
       @include('frontend.pages.section.featured_section')
    </div>

    @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
        <div class="right_column">
            @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view1, 'is_section_facebook' => false))
        </div>
    @endif

    <div class="more_news">
        @if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
            @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view1, 'is_section_facebook' => false))
        @endif

        @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
            @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view2, 'is_section_facebook' => false))
        @endif
    </div>

    @if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
        <section id="big_banner" class="fullbanner">
            <img src="{{asset('assets/images/maq/banner.jpg')}}" alt="">
        </section>
    @endif

    <div class="features">
        @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
            <div class="add">
                <img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
            </div>
            @include('frontend.pages.section.slider_section')
            <div class="plugin_fb">
                @include('frontend.pages.partials.likebox')
            </div>

        @else
            @include('frontend.pages.section.slider_section')

            @if ($type_module == Helpers::TYPE_MODULE_MODULAR)
                @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view2, 'is_section_facebook' => false))
            @endif
            <div class="add">
                <img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
            </div>
            @if ($type_module == Helpers::TYPE_MODULE_LISTADO)
                @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view3, 'is_section_facebook' => false))
            @endif

        @endif
    </div>
    <div class="more_news_v2">
        @if ($type_module == Helpers::TYPE_MODULE_LISTADO)
            @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view2, 'is_section_facebook' => true))
        @endif

        @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR || $type_module == Helpers::TYPE_MODULE_MODULAR)
            @include('frontend.pages.partials.news_list', array('dbl_post_view'=> $dbl_post_view3, 'is_section_facebook' => false))
        @endif
    </div>
    <div class="paginate">
        {{$dbl_post->links('frontend.pages.partials.paginator')}}
    </div>

</section>
<section id="ads">
    @include('frontend.pages.home.other_sections')
</section>
@stop

@section('js')
@stop
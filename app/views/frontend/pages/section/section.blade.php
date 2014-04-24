@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<section id="portada_espectaculos"  class="{{$type_module == Helpers::TYPE_MODULE_LISTADO ? 'view_3': ''}}">
            <div class="title custom_color_text">Espectáculos</div>

            @if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
                <div class="left2_column">
                    <div class="add">
                    <img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
                    </div>
                    @if ($type_module == Helpers::TYPE_MODULE_MODULAR)
                        <div class="plugin_fb">
                        <img src="{{asset('assets/images/maq/fb_plugin3.png')}}" alt="">
                        </div>
                    @endif
                </div>
            @endif

            <div class="left_column  {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO  ? 'left3_column': ''}} ">
               @include('frontend.pages.section.featured_section')
            </div>

            @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
                <div class="right_column">
                    @foreach ($dbl_post_view1 as $dbr_post_view1)
                        <div class="news">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view1->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view1->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view1->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view1->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            <div class="more_news">
                @if ($type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO)
                    @foreach ($dbl_post_view1 as $dbr_post_view1)
                        <div class="news">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view1->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view1->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view1->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view1->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif


                @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
                    @foreach ($dbl_post_view2 as $dbr_post_view2)
                        <div class="news">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view2->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view2->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view2->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view2->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>


            @if ($type_module == Helpers::TYPE_MODULE_MODULAR)
                <section id="big_banner" class="fullbanner">
                    <img src="{{asset('assets/images/maq/banner.jpg')}}" alt="">
                </section>
            @endif

            <div class="features">
                {{$dbl_post->links('frontend.pages.section.slider_section')}}

                @if ($type_module == Helpers::TYPE_MODULE_MODULAR)
                    @foreach ($dbl_post_view2 as $dbr_post_view2)
                        <div class="news view2">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view2->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view2->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view2->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view2->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif

                <div class="add">
                        <img src="{{asset('assets/images/maq/add_1.png')}}" alt="">
                </div>

                @if ($type_module == Helpers::TYPE_MODULE_LISTADO)
                    @foreach ($dbl_post_view3 as $dbr_post_view3)
                        <div class="news view2">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view3->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view3->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view3->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view3->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="more_news_v2">
                @if ($type_module == Helpers::TYPE_MODULE_LISTADO)
                    @foreach ($dbl_post_view2 as $key => $dbr_post_view2)

                        @if ($key == 4)
                        <div class="plugin_fb">
                            <img alt="" src="{{asset('assets/images/maq/fb_plugin4.png')}}">
                        </div>
                        @endif
                        <div class="news view2">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view2->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view2->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view2->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view2->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                @endif


                @if ($type_module == Helpers::TYPE_MODULE_ESTANDAR || $type_module == Helpers::TYPE_MODULE_MODULAR)

                    @foreach ($dbl_post_view3 as $dbr_post_view3)
                        <div class="news {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO ? 'view2' : ''}}">
                            <figure>
                                <img src="{{Helpers::getImage($dbr_post_view3->image, 'noticias')}}" alt="">
                            </figure>
                            <div class="desc">{{$dbr_post_view3->title}}</div>
                            <div class="opt">
                                <ul>
                                    <li class="e1"><a href="#">+ {{$dbr_post_view3->category_name}}</a></li>
                                    <li class="e2"><a href="#"></a></li>
                                    <li class="e3">{{ Helpers::intervalDate($dbr_post_view3->post_at, date('Y-m-d H:i:s'))}}</li>
                                </ul>
                            </div>
                        </div>
                    @endforeach

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
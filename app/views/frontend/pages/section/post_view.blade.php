@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
        <div id="notes">

            <div class="right_notes">
                <div class="group_title custom_color_text">{{$dbr_post->category_name}}</div>
                <div class="title_nota">{{$dbr_post->title}}</div>
                <div class="image">
                    <div class="opt">
                        <ul>
                            <li class="e1"><a href="{{route('frontend.section.list', array($dbr_post->category_slug))}}">+ {{$dbr_post->category_name}}</a></li>
                            <li class="e2"><a></a></li>
                            <li class="e3">{{ Helpers::intervalDate($dbr_post->post_at, date('Y-m-d H:i:s'))}}</li>
                        </ul>
                    </div>
                </div>
                <div class="text_note">
                    {{$dbr_post->content}}
                </div>
                <div class="author">
                    <span class="custom_color_bg"></span>Samantha Cervantes / NetJoven
                </div>
                <div class="social">
                    <img src="/assets/images/maq/social.jpg" alt="">
                </div>
                <div class="tags">
                    <span class="custom_color_text">Tags:</span> {{$dbr_post->tags}}
                </div>
                <div class="action">
                    <a href="{{$redirect}}" class="btn_volver custom_color_bg">Volver</a>
                </div>
            </div>

            <div class="left_notes">
                <div class="add">
                    <img src="/assets/images/maq/banner1.png" alt="">
                </div>
                @include('frontend.pages.partials.slider_section')
                <div class="plugin_fb">
                    @include('frontend.pages.partials.likebox')
                </div>

                <section id="ads">
                    <article class="item">

                        <div class="add_content">
                            <figure>
                                <img src="/assets/images/maq/add1.jpg" alt="">
                            </figure>
                            <div class="link">
                                <a href="#">ver<span class="custom_color_bg">+</span></a>
                            </div>
                        </div>
                    </article>
                    <article class="item">

                        <div class="add_content">
                            <figure>
                                <img src="/assets/images/maq/add2.jpg" alt="">
                            </figure>
                            <div class="link">
                                <a href="#">ver<span class="custom_color_bg">+</span></a>
                            </div>
                        </div>
                    </article>
                    <article class="item">

                        <div class="add_content">
                            <figure>
                                <img src="/assets/images/maq/add3.jpg" alt="">
                            </figure>
                            <div class="link">
                                <a href="#">ver<span class="custom_color_bg">+</span></a>
                            </div>
                        </div>
                    </article>
                    <article class="item">

                        <div class="add_content">
                            <figure>
                                <img src="/assets/images/maq/add4.jpg" alt="">
                            </figure>
                            <div class="link">
                                <a href="#">ver<span class="custom_color_bg">+</span></a>
                            </div>
                        </div>
                    </article>
                </section>

            </div>

        </div>
@stop

@section('js')
@stop
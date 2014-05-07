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
                        <div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post->category_slug))}}">+ {{$dbr_post->category_name}}</a></div>
                        <div class="{{($dbr_post->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
                        <div class="opt3">{{ Helpers::intervalDate($dbr_post->post_at, date('Y-m-d H:i:s'))}}</div>
                    </div>
                </div>
                <div class="text_note">
                    @if ($dbr_post->id_video)
                        <div  class="video-container">
                            <object width="455" height="344">
                            <param name="wmode" value="transparent"></param>
                            <param name="movie" value="http://www.youtube.com/v/{{$dbr_post->id_video}}&hl=es&fs=1&showinfo=0&rel=0"></param>
                            <param name="allowFullScreen" value="true"></param>
                            <param name="allowscriptaccess" value="always"></param>
                            <embed src="http://www.youtube.com/v/{{$dbr_post->id_video}}&hl=es&fs=1&showinfo=0&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="600" height="350" wmode="transparent"></embed>
                        </object>
                    </div>
                    @else
                        {{$dbr_post->content}}
                    @endif
                </div>
                <div class="author">
                    <span class="custom_color_bg"></span>Samantha Cervantes / NetJoven
                </div>
                <div class="social">
                    @include('frontend.pages.section.post_button_social')
                </div>
                <div class="tags">
                     @if ($dbr_post->tags)
                        <?php
                            $data_tags = explode(',', $dbr_post->tags) ;
                        ?>
                        <span class="custom_color_text">Tags:</span>
                        <ul>
                            @foreach ($data_tags as $tag)
                                <li><a href="{{ route('frontend.post.tags', array(Str::slug($tag))) }}">{{$tag}}</a></li>
                            @endforeach
                        </ul>
                     @endif
                </div>
                <div class="action">
                    <a href="{{$redirect}}" class="btn_volver custom_color_bg">Volver</a>
                </div>
                <div class="comment">
                    @include('frontend.pages.section.post_comment')
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
                    @include('frontend.pages.home.other_sections')
                    <!--<article class="item">
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
                    </article>-->
                </section>

            </div>

        </div>
@stop

@section('js')
@stop
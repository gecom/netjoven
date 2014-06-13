@extends('frontend.layouts.default')

@section('css')
    {{ HTML::style('assets/css/bxslider/jquery.bxslider.css')}}
@stop

@section('content')
        <div id="notes">

            <div class="right_notes">
                <div class="group_title custom_color_text">{{$dbr_post->category_name}}</div>
                <div class="title_nota">{{$dbr_post->title}}</div>
                @include('frontend.pages.partials.banner_half')
                <div class="image">
                    <div class="opt">
                        <div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post->category_slug))}}">+ {{$dbr_post->category_name}}</a></div>
                        <div class="{{($dbr_post->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
                        <div class="opt3">{{ Helpers::intervalDate($dbr_post->post_at, date('Y-m-d H:i:s'))}}</div>
                    </div>
                    @if ($dbr_post->has_gallery)
                        <div class="gallery">
                            <?php $image_featured = Helpers::getImage($dbr_post_gallery->image, 'gallery');?>
                            <figure>
                                <img alt="" src="{{$image_featured}}">
                            </figure>
                            <a id="open_post_gallery" href="{{ route('frontend.post.gallery', array($dbr_post->id)) }}" class="btn btn-default btn-sm custom_color_bg">
                                <span class="glyphicon glyphicon-list-alt"></span> Abrir Galería
                            </a>
                        </div>
                    @endif
                </div>
                <div class="text_note">
                    @if ($dbr_post->id_video)
                        <div  class="video-container">
                            @if ($dbr_post->type_video == Helpers::TYPE_VIDEO_YOUTUBE)
                                <?php $url_video = 'http://www.youtube.com/v/'.$dbr_post->id_video.'&hl=es&fs=1&showinfo=0&rel=0' ?>
                                <object width="455" height="344">
                                    <param name="wmode" value="transparent"></param>
                                    <param name="movie" value="{{$url_video}}"></param>
                                    <param name="allowFullScreen" value="true"></param>
                                    <param name="allowscriptaccess" value="always"></param>
                                    <embed src="{{$url_video}}" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="600" height="350" wmode="transparent"></embed>
                                </object>
                            @endif

                            @if ($dbr_post->type_video == Helpers::TYPE_VIDEO_DAILYMOTION)
                                <iframe frameborder="0" width="480" height="270" src="//www.dailymotion.com/embed/video/{{$dbr_post->id_video}}" allowfullscreen></iframe>
                            @endif
                        </div>
                    @endif
                    {{$dbr_post->content}}
                </div>
                <div class="author">

                    @if (isset($dbr_redactor))
                        <span class="custom_color_bg"></span> {{$dbr_redactor->userProfile-> first_name . ' ' . $dbr_redactor->userProfile->last_name }} / NetJoven
                    @endif
                    
                </div>
                <div class="social">
                    @include('frontend.pages.section.post_button_social')
                </div>
                <div class="tags">
                    @if ($dbr_post->tags_name)
                        <span class="custom_color_text">Tags: </span>{{Helpers::formatTags($dbr_post->tags_name)}}
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
                @include('frontend.pages.partials.banner_cuadrado')
                @include('frontend.pages.partials.slider_section')
                <div class="plugin_fb">
                    @include('frontend.pages.partials.likebox')
                </div>

                <section id="ads">
                    @include('frontend.pages.home.other_sections')
                </section>

            </div>

        </div>
@stop

@section('js')
    {{ HTML::script('assets/js/bxslider/jquery.bxslider.min.js'); }}
    {{ HTML::script('assets/js/fn/post_view.js'); }}
@stop
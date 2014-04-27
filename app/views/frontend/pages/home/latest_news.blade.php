<div class="title_news custom_color_text">Últimas noticias</div>
@if (count($dbl_theme_day))
    <ul class="option_news">
            <li><strong><span class="circle custom_color_bg"></span>Temas del Día</strong></li>
        @foreach ($dbl_theme_day as $dbr_theme_day)
            <li><span class="circle custom_color_bg"></span><a href="#">{{$dbr_theme_day->name}}</a></li>
        @endforeach
    </ul>
@endif

<div class="list_articles {{($type_module == Helpers::TYPE_MODULE_LISTADO ? 'list_mode' : '')}}">
    @foreach ($dbl_last_post as $dbr_last_post)
        <?php  ?>
        <article >
            <div class="media">
                @if($dbr_last_post->type == Helpers::TYPE_POST_VIDEO || !empty($dbr_last_post->id_video) )
                    <a href="#" class="play_video custom_color_bg"></a>
                @endif
                <?php
                    $dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_last_post->id)->first();
                    $image_featured = ($dbr_image_featured ? $dbr_image_featured->image : null);

                    if(!empty($dbr_last_post->id_video)){
                        $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_last_post->id_video);
                    }else{
                        $image_featured = Helpers::getImage($image_featured, 'noticias');
                    }
                ?>
                <img src="{{$image_featured}}" />
            </div>
            <div class="text">{{$dbr_last_post->title}}</div>
            <div class="opt">
                <ul>
                    <li class="e1"><a href="{{route('frontend.section.list', array($dbr_last_post->category_slug))}}">+{{ $dbr_last_post->category_name}}</a></li>
                    <li class="e2"><a href="#"></a></li>
                    <li class="e3">{{ Helpers::intervalDate($dbr_last_post->post_at, date('Y-m-d H:i:s'))}}</li>
                </ul>
            </div>
        </article>
    @endforeach
</div>

@if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
        <div class="paginate">
ver mas
    </div>
@endif



<div class="list_articles {{($type_module == Helpers::TYPE_MODULE_LISTADO ? 'list_mode' : '')}}">
    @foreach ($dbl_more_post as $dbr_more_post)
        <article >
            <div class="media">
                @if($dbr_more_post->type == Helpers::TYPE_POST_VIDEO || !empty($dbr_more_post->id_video) )
                    <a href="#" class="play_video custom_color_bg"></a>
                @endif
                <?php
                    $dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_more_post->id)->first();
                    $image_featured = ($dbr_image_featured ? $dbr_image_featured->image : null);

                    if(!empty($dbr_more_post->id_video)){
                        $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_more_post->id_video);
                    }else{
                        $image_featured = Helpers::getImage($image_featured, 'noticias');
                    }
                ?>
                <img src="{{$image_featured}}" />
            </div>
            <div class="text">{{$dbr_more_post->title}}</div>
            <div class="opt">
                <ul>
                    <li class="e1"><a href="{{route('frontend.section.list', array($dbr_more_post->category_slug))}}">+{{ $dbr_more_post->category_name}}</a></li>
                    <li class="{{($dbr_more_post->type == Helpers::TYPE_POST_GALLERY ? 'e4' : 'e2')}}"><a href="#"></a></li>
                    <li class="e3">{{ Helpers::intervalDate($dbr_more_post->post_at, date('Y-m-d H:i:s'))}}</li>
                </ul>
            </div>
        </article>
    @endforeach
</div>

<div class="paginate">ver mas</div>


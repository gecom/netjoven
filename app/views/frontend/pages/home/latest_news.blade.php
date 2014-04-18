<div class="title_news custom_color_text">Últimas noticias</div>
<ul class="option_news">
    <li><span class="circle custom_color_bg"></span><a href="#" class="active custom_color_text">Ultimas</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">People's Choice Awards</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">MTV EMA 2013</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">Rafael Nadal en Lima</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">Representantes de lo Nuestro</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">Miembros de mesa</a></li>
    <li><span class="circle custom_color_bg"></span><a href="#">Elecciones 2013</a></li>
</ul>
<div class="list_articles">
    @foreach ($dbl_last_post as $dbr_last_post)
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
                    <li class="e1"><a href="#">+{{ Category::getParentCategoryById($dbr_last_post->category_parent_id)->name}}</a></li>
                    <li class="{{($dbr_last_post->type == Helpers::TYPE_POST_GALLERY ? 'e4' : 'e2')}}"><a href="#"></a></li>
                    <li class="e3">{{ Helpers::intervalDate($dbr_last_post->post_at, date('Y-m-d H:i:s'))}}</li>
                </ul>
            </div>
        </article>
    @endforeach
</div>
<div class="paginate">


    {{$dbl_last_post->links('frontend.pages.home.paginator')}}
</div>
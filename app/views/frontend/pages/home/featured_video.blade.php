<div class="video_title">Videos</div>
<div class="right_banner">
    <div class="slider">
        <ul class="bxslider">
            @foreach($dbl_last_post_video_featured as $dbr_last_post_video_featured)
                <li>
                    <figure>
                        <a href=""><img title="{{$dbr_last_post_video_featured->title}}" src="{{ Helpers::getImage($dbr_last_post_video_featured->image, 'featured')}}" width="100%" height="100%"></a>
                    </figure>
                </li>
            @endforeach
        </ul>
    </div>

</div>
<div class="video_title">Videos</div>
<div class="right_banner">
    <div class="slider">
        <ul id="slider_featured_videos" class="bxslider">
            @foreach($dbl_last_post_video_featured as $dbr_last_post_video_featured)
                <?php
                    $dbr_post_first = $dbr_last_post_video_featured->post()->first();
                    $dbr_parent_category = Category::getParentCategoryById($dbr_post_first->category_parent_id)->first();
                    $data_url = array($dbr_parent_category->slug, $dbr_post_first->id, $dbr_post_first->slug);
                ?>
                <li>
                    <figure>
                        <a href="{{ route('frontend.post.view', $data_url) }}"><img title="{{$dbr_last_post_video_featured->title}}" src="{{ Helpers::getImage($dbr_last_post_video_featured->image, 'featured')}}" ></a>
                    </figure>
                </li>
            @endforeach
        </ul>
    </div>

</div>
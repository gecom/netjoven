<div class="left_banner">
    <article class="p1">
        <figure><img src="{{asset('assets/images/maq/banner1.png')}}"></figure>
    </article>
    <article class="p2">
        <figure><img src="{{asset('assets/images/maq/banner2.jpg')}}" width="100%" height="100%"></figure>
    </article>
</div>
<div class="right_banner">
    <div class="slider">
        <ul id="slider_featured" class="bxslider">

            @if (isset($dbl_last_post_featured_slider))
                @foreach($dbl_last_post_featured_slider as $dbr_post_featured_slider)
                    <?php
                        $dbr_post_first = $dbr_post_featured_slider->post()->first();
                        $dbr_parent_category = Category::getParentCategoryById($dbr_post_first->category_parent_id)->first();
                        $data_url = array($dbr_parent_category->slug, $dbr_post_first->id, $dbr_post_first->slug);
                    ?>
                    <li>
                        <figure>
                            <a href="{{ route('frontend.post.view', $data_url) }}"><img title="{{$dbr_post_featured_slider->title}}" src="{{ Helpers::getImage($dbr_post_featured_slider->image, 'featured')}}"></a>
                        </figure>
                    </li>
                @endforeach
            @endif

        </ul>
    </div>
</div>
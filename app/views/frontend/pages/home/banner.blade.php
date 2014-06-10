<div class="left_banner">
    <article class="p1">
        @include('frontend.pages.partials.banner_cuadrado')
    </article>
    @if ($is_monsterbox == false)
        @include('frontend.pages.partials.likebox', array('meter_likebox' => array(300,500)));
    @endif
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
    @if ($is_monsterbox == true)
        <div class="fb">
            @include('frontend.pages.partials.likebox')
        </div>
    @endif
</div>
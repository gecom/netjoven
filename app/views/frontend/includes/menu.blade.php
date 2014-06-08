<?php

$key = 'dbl_categories_home';

if (!Cache::has($key)){
    $dbl_categories_home = Cache::remember($key, 240, function() {
            return Helpers::getCategoriesHome();
    });
}else{
    $dbl_categories_home = Cache::get($key);
}

$current_url = Request::segment(1);

 ?>
<div class="row">
    <ul class="menu menu_desktop">
        <li class="li_menu {{ empty($current_url) ? 'active custom_color_bg' : ''}}"><a href="{{ route('home') }}" >INICIO</a></li>
        @foreach ($dbl_categories_home as $key => $dbr_category_home)
            <li class="li_menu {{ !empty($current_url) && strpos($current_url, $dbr_category_home['slug'])   !== false ? 'active custom_color_bg' : ''}}">
                <a href="{{ route('frontend.section.list', array($dbr_category_home['slug'])) }}" >{{ mb_strtoupper($dbr_category_home['name']) }}</a>
                @if(isset($dbr_category_home['children_category']))
                    <div style="display:none" class="dropdown">
                        <ul>
                            @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                                <li id="{{$children_category['id']}}" ><a href="{{ route('frontend.section.list', array($children_category['slug'])) }}" >{{$children_category['name']}}</a></li>
                            @endforeach
                        </ul>
                        <?php $i = 0; ?>
                        @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                            <div class="videos_drop" id ="children_category_{{$children_category['id']}}" style="display:none">
                                <?php
                                    $key = 'category_post_'.$children_category['id'];

                                    if (!Cache::has($key)) {
                                        $dbl_post_category = Cache::remember($key, 240, function() use ($children_category) {
                                            $params['view_index'] = 1;
                                            $params['category_id'] = $children_category['id'];
                                            $params['show_limit'] = array(4,0);

                                            return Post::getPostNews($params)->get();
                                        });
                                    }else{
                                        $dbl_post_category = Cache::get($key);
                                    }
                                ?>
                                @foreach ($dbl_post_category as $dbr_post_category)
                                    <?php
                                        $data_url = array($dbr_post_category->category_parent_slug, $dbr_post_category->id, $dbr_post_category->slug);

                                        if(!empty($dbr_post_category->id_video)){
                                            $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_post_category->id_video);
                                        }else{
                                            $image_featured = Helpers::getImage($dbr_post_category->image, 'noticias');
                                        }
                                    ?>
                                    <div class="video_item">
                                        <figure>
                                            <a href="{{ route('frontend.post.view', $data_url) }}"><img src="{{$image_featured}}" alt="{{$dbr_post_category->title}}">
                                                @if ($dbr_post_category->type == Helpers::TYPE_POST_VIDEO)
                                                    <div class="play  custom_color_bg"></div>
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="description"><a href="{{ route('frontend.post.view', $data_url) }}">{{ $dbr_post_category->title}}</a></div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>

                @endif
            </li>
        @endforeach
        <li  class="opt_menu conecta_comparte"> Conectate y Comparte
            <a class="tw" href="http://twitter.com/#!/netjoven"></a><a class="fb" href="http://www.facebook.com/netjoven"></a>
        </li>
    </ul>

    <div class="menu_responsive" style="display:none">
        @include('frontend.includes.menu_responsive')
    </div>

    <ul class="options_menu_fixed" style="display:none">
        <li>
            <a href="#" class="search custom_color_bg"></a>
            <div class="search_box custom_color_bg" style="display:none">
                <input type="text" class="input_search" placeholder="Buscar..." />
                <div class="bg_search"></div>
            </div>
        </li>
        <li><a id="options_menu_fixed_tools_color" href="{{ route('frontend.user.tools.changecolor') }}" class="config"></a></li>
    </ul>
</div>
<div class="row user_options">
    @include('frontend.pages.partials.user_options')
</div>

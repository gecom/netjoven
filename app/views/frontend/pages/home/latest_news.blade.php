<div class="title_news custom_color_text">Últimas noticias</div>

<?php

	if (!Cache::has('dbl_theme_day')){
		Cache::forever('dbl_theme_day', ThemeDay::getThemeDay()->get());
	}

	$dbl_theme_day = Cache::get('dbl_theme_day');

 ?>
@if (count($dbl_theme_day))
    <ul class="option_news">
            <li><strong><span class="circle custom_color_bg"></span>Temas del Día</strong></li>
        @foreach ($dbl_theme_day as $dbr_theme_day)
            <li><span class="circle custom_color_bg"></span><a href="#">{{$dbr_theme_day->tag}}</a></li>
        @endforeach
    </ul>
@endif

@include('frontend.pages.partials.news_list_home', array('dbl_post_view'=> $dbl_last_post))

@if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
<div class="paginate"><a href="{{ route('frontend.post.more_news') }}">Ver mas</a></div>
@endif
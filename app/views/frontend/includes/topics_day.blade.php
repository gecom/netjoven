<?php

	if (!Cache::has('dbl_theme_day')){
		Cache::forever('dbl_theme_day', ThemeDay::getThemeDay()->get());
	}

	$dbl_theme_day = Cache::get('dbl_theme_day');

 ?>
@if (count($dbl_theme_day))
    <div class="row">
        <ul class="option_news">
                <li><strong class="custom_color_text"><span class="circle custom_color_bg"></span>Temas</strong></li>
            @foreach ($dbl_theme_day as $dbr_theme_day)
                <li><span class="circle custom_color_bg"></span><a href="{{ route('frontend.post.tags', array($dbr_theme_day->slug)) }}">{{$dbr_theme_day->tag}}</a></li>
            @endforeach
        </ul>
    </div>
@endif
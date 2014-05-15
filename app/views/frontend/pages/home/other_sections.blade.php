<?php

if (!Cache::has('dbl_other_sections')){
    Cache::forever('dbl_other_sections', Category::getCategoriesByids(array(2,30,35,40))->get());
}

$dbl_other_sections = Cache::get('dbl_other_sections');
?>
@foreach ($dbl_other_sections as $dbr_other_section)
    <article class="item">
        <div class="add_title">{{$dbr_other_section->name}}</div>
        <div class="add_content">
            <figure>
                <a href="{{ route('frontend.section.list', array($dbr_other_section->slug)) }}"><img src="{{Helpers::getImage($dbr_other_section->image, 'category')}}" alt="{{$dbr_other_section->name}}" title="{{$dbr_other_section->name}}"></a>
            </figure>
            <div class="link">
                <a href="{{ route('frontend.section.list', array($dbr_other_section->slug)) }}">ver<span class="custom_color_bg">+</span></a>
            </div>
        </div>
    </article>
@endforeach

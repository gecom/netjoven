<?php $dbl_parent_categories_home = Category::getParentCategoriesHome()->get(); ?>
<ul>
	<li><a href="{{route('home')}}"><span class="icon custom_color_bg"></span>INICIO</a></li>
	@foreach ($dbl_parent_categories_home as $dbr_parent_category_home)
		<li><a href="{{route('frontend.section.list', array($dbr_parent_category_home->slug))}}"><span class="icon custom_color_bg"></span>{{mb_strtoupper($dbr_parent_category_home->name)}}</a></li>
	@endforeach
</ul>

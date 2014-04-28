@foreach ($dbl_post_view as $key => $dbr_post_view)
	@if ($key == 4 && $is_section_facebook == true)
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
	@endif
	<?php
		$data_url = array(Category::getParentCategoryById($dbr_post_view->category_parent_id)->slug, $dbr_post_view->id, $dbr_post_view->slug);
	?>
	<div class="news {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO ? 'view2' : ''}}">
	    <figure>
	        <img src="{{Helpers::getImage($dbr_post_view->image, 'noticias')}}" alt="{{$dbr_post_view->title}}">
	    </figure>
	    <div class="desc"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_post_view->title}}</a></div>
	    <div class="opt">
	        <ul>
	            <li class="e1"><a href="{{route('frontend.section.list', array($dbr_post_view->category_slug))}}">+ {{$dbr_post_view->category_name}}</a></li>
	            <li class="e2"><a href="{{ route('frontend.post.view', $data_url) }}"></a></li>
	            <li class="e3">{{ Helpers::intervalDate($dbr_post_view->post_at, date('Y-m-d H:i:s'))}}</li>
	        </ul>
	    </div>
	</div>
@endforeach


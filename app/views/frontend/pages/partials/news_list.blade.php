@foreach ($dbl_post_view as $key => $dbr_post_view)
	@if ($key == 4 && $is_section_facebook == true)
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
	@endif
	<div class="news {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO ? 'view2' : ''}}">
	    <figure>
	        <img src="{{Helpers::getImage($dbr_post_view->image, 'noticias')}}" alt="">
	    </figure>
	    <div class="desc">{{$dbr_post_view->title}}</div>
	    <div class="opt">
	        <ul>
	            <li class="e1"><a href="{{route('frontend.section.list', array($dbr_post_view->category_slug))}}">+ {{$dbr_post_view->category_name}}</a></li>
	            <li class="e2"><a href="#"></a></li>
	            <li class="e3">{{ Helpers::intervalDate($dbr_post_view->post_at, date('Y-m-d H:i:s'))}}</li>
	        </ul>
	    </div>
	</div>
@endforeach
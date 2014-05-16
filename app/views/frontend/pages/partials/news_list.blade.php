@foreach ($dbl_post_view as $key => $dbr_post_view)
	@if ($key == 4 && $is_section_facebook == true)
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
	@endif
	<?php
		$dbr_parent_category = Category::getParentCategoryById($dbr_post_view->category_parent_id)->first();
		$data_url = array($dbr_parent_category->slug, $dbr_post_view->id, $dbr_post_view->slug);
	?>
	<div class="news {{$type_module == Helpers::TYPE_MODULE_MODULAR || $type_module == Helpers::TYPE_MODULE_LISTADO ? 'view2' : ''}}">
	    <figure>
			<?php
				if(!empty($dbr_post_view->id_video)){
					$image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_post_view->id_video);
				}else{
					$dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_post_view->id)->first();
					$image_featured = Helpers::getImage(($dbr_image_featured ? $dbr_image_featured->image : null), 'noticias');
				}
			?>
	        <a href="{{ route('frontend.post.view', $data_url) }}"><img src="{{$image_featured}}" alt="{{$dbr_post_view->title}}" /></a>
	    </figure>
	    <div class="desc"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_post_view->title}}</a></div>
		<div class="opt">
			<div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post_view->category_slug))}}">+ {{$dbr_post_view->category_name}}</a></div>
			<div class="{{($dbr_post_view->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
			<div class="opt3">{{ Helpers::intervalDate($dbr_post_view->post_at, date('Y-m-d H:i:s'))}}</div>
		</div>
	</div>
@endforeach


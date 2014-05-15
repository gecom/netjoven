@if ($dbr_post_cartelera)
	<?php 
		$dbr_parent_category = Category::getParentCategoryById($dbr_post_cartelera->category_parent_id)->first();
		$data_url = array($dbr_parent_category->slug, $dbr_post_cartelera->id, $dbr_post_cartelera->slug);

		$dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_post_cartelera->id)->first();
		$image_featured = Helpers::getImage($dbr_image_featured->image, 'noticias');
	?>
	<div class="video_title">{{Lang::get('messages.frontend.post_title_cartelera')}}</div>
	<div class="playing">
	    <img src="{{$image_featured}}" width="100%" height="90%" />
	    <div class="release_date">
	        {{$dbr_post_cartelera->title}} <a href="{{ route('frontend.post.view', $data_url) }}" class="custom_color_bg">Ver trailer</a>
	    </div>
	</div>
@endif

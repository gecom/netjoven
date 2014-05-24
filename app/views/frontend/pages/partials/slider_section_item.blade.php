@if ($dbr_slider_more && $dbr_slider_more->post_id)
	<?php

	    $dbr_parent_category = Category::getParentCategoryById($dbr_slider_more->category_parent_id)->first();
	    $data_url = array($dbr_parent_category->slug, $dbr_slider_more->post_id, $dbr_slider_more->slug);

	    $dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_slider_more->post_id)->first();
	    $image_featured = Helpers::getImage($dbr_image_featured ? $dbr_image_featured->image : null, 'noticias');
	?>

	<div class="item">
	    <figure><img src="{{$image_featured}}" alt="{{$dbr_slider_more->title}}"></figure>
	    <div class="des"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_slider_more->title}}</a></div>
	</div>
@endif


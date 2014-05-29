@if ($dbr_slider_more && $dbr_slider_more->post_id)
	<?php
	    $data_url = array($dbr_slider_more->category_parent_slug, $dbr_slider_more->post_id, $dbr_slider_more->slug);
	    $image_featured = Helpers::getImage($dbr_slider_more->image,'noticias');
	?>

	<div class="item">
	    <figure><img src="{{$image_featured}}" alt="{{$dbr_slider_more->title}}"></figure>
	    <div class="des"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_slider_more->title}}</a></div>
	</div>
@endif


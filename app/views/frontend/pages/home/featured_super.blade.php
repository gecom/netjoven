<?php 
	$dbr_post_first = $dbl_last_post_featured_super->post()->first();
	$dbr_parent_category = Category::getParentCategoryById($dbr_post_first->category_parent_id)->first();
	$data_url = array($dbr_parent_category->slug, $dbr_post_first->id, $dbr_post_first->slug);
?>

<div class="image_destacado">
	<img alt="{{$dbl_last_post_featured_super->title}}" src="{{ Helpers::getImage($dbl_last_post_featured_super->image, 'featured')}}">
	<div class="txt">
		{{$dbl_last_post_featured_super->title}}
	</div>
	<div class="link">
		<a href="{{ route('frontend.post.view', $data_url) }}">ver<span class="custom_color_bg" >+</span></a>
	</div>
</div>
@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')
<div id="notes" class="facebook_fail">

	<div class="right_notes ">
		<div class="group_title custom_color_text">
			Facebook Fail <a href="#" class="show_form_upload" style="display:none">Sube tu fail</a>
		</div>
		<section class="fails">
			@foreach ($dbl_post_view as $dbr_post_view)
				<article class="fail_item">
					<div class="fail_item_title custom_color_text">{{$dbr_post_view->title}}</div>
					<figure>
						<?php
						$dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_post_view->id)->first();
						$image_featured = Helpers::getImage(($dbr_image_featured ? $dbr_image_featured->image : null), 'noticias');
						?>
						<img src="{{$image_featured}}" alt="{{$dbr_post_view->title}}" />
					</figure>
					<div class="thanks">
						<?php $dbr_user = UserHelper::getUserRedactor($dbr_post_view->user_id); ?>
						Gracias por tu publicación {{$dbr_user->userProfile->first_name . ' ' . $dbr_user->userProfile->last_name}}
					</div>
					<div class="social">
						@include('frontend.pages.section.post_button_social', array('url' => URL::current() .'#'.$dbr_post_view->slug))
					</div>
				</article>
			@endforeach
		</section>
	</div>

	<div class="left_notes">
		@include('frontend.pages.partials.banner_cuadrado')
		@include('frontend.pages.partials.slider_section')
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>

		<section id="ads">
			@include('frontend.pages.home.other_sections')
		</section>
	</div>

	<div class="paginate_fail">
		{{$dbl_post_links}}
	</div>

</div>
@stop

@section('js')
@stop
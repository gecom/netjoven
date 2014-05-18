@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

		<div id="horoscopo_resultados">
			<div class="big_title custom_color_text">
				Horóscopo
			</div>
			<div class="right_horoscopo">
				<div class="list_articles">
					@foreach ($dbl_post_view as $key => $dbr_post_view)
						<?php
							$dbr_parent_category = Category::getParentCategoryById($dbr_post_view->category_parent_id)->first();
							$data_url = array($dbr_parent_category->slug, $dbr_post_view->id, $dbr_post_view->slug);
						?>
						<article>
						    <div class="media">
								<?php
									$dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_post_view->id)->first();
									$image_featured = Helpers::getImage(($dbr_image_featured ? $dbr_image_featured->image : null), 'noticias');
								?>
						    	<a href="{{ route('frontend.post.view', $data_url) }}"><img src="{{$image_featured}}" alt="{{$dbr_post_view->title}}" /></a>
						    </div>
						    <div class="text"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_post_view->title}}</a></div>
							<div class="opt">
								<div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post_view->category_slug))}}">+ {{$dbr_post_view->category_name}}</a></div>
								<div class="{{($dbr_post_view->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
								<div class="opt3">{{ Helpers::intervalDate($dbr_post_view->post_at, date('Y-m-d H:i:s'))}}</div>
							</div>
						</article>
					@endforeach
				</div>
			</div>
			<div class="left_horoscopo">
				<div class="add">
					<img src="{{asset('assets/images/maq/banner1.jpg')}}" alt="">
				</div>
				@include('frontend.pages.partials.slider_section')
				<div class="plugin_fb">
					@include('frontend.pages.partials.likebox')
				</div>
				<section id="ads">
					@include('frontend.pages.home.other_sections')
				</section>
			</div>

			<div class="paginate">
				{{$dbl_post_links}}
			</div>

		</div>
@stop

@section('js')
@stop

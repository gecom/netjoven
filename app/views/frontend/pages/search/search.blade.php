@extends('frontend.layouts.default')

@section('css')
@stop

@section('content')

<div id="horoscopo_resultados">
	<div class="big_title custom_color_text">{{$title_text_search}}</div>
	<div class="right_horoscopo">
		<div class="list_articles">

			@if (!empty($dbl_post_search))
				@foreach ($dbl_post_search as $dbr_post_search)
					<?php
						$data_url = array($dbr_post_search->category_parent_slug, $dbr_post_search->id, $dbr_post_search->slug);
					?>
					<article>
						<div class="media">
				            @if($dbr_post_search->type == Helpers::TYPE_POST_VIDEO || !empty($dbr_post_search->id_video) )
				                <a href="{{route('frontend.post.view', $data_url)}}" class="play_video custom_color_bg"></a>
				            @endif
				            <?php
				                if(!empty($dbr_post_search->id_video)){
				                    $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_post_search->id_video);
				                }else{
				                    $image_featured = Helpers::getImage($dbr_post_search->image_featured, 'noticias');
				                }
				            ?>
				            <a href="{{route('frontend.post.view', $data_url)}}"><img src="{{$image_featured}}" /></a>
				        </div>
				        <div class="text"><a href="{{route('frontend.post.view', $data_url)}}">{{$dbr_post_search->title}}</a></div>
				        <div class="opt">
							<div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post_search->category_slug))}}">+{{ $dbr_post_search->category_name}}</a></div>
							<div class="{{($dbr_post_search->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
							<div class="opt3">{{ Helpers::intervalDate($dbr_post_search->post_at, date('Y-m-d H:i:s'))}}</div>
				        </div>
					</article>
				@endforeach
			@endif

			@if (!empty($message))
				{{$message}}
			@endif

		</div>
	</div>
	<div class="left_horoscopo">
		@include('frontend.pages.partials.banner_cuadrado')
		@include('frontend.pages.partials.slider_section')
		<div class="plugin_fb">
			@include('frontend.pages.partials.likebox')
		</div>
	</div>
	<div class="paginate">
		@if (isset($dbl_post_search) && !empty($dbl_post_search))
			{{$dbl_post_search_links}}
		@endif
	</div>
</div>

@stop

@section('js')
@stop
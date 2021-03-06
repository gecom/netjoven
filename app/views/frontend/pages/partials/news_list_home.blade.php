<div class="list_articles {{($type_module == Helpers::TYPE_MODULE_LISTADO ? 'list_mode' : '')}}">
	@foreach ($dbl_post_view as $dbr_post_view)
		<?php
			$data_url = array($dbr_post_view->category_parent_slug, $dbr_post_view->id, $dbr_post_view->slug);
		?>
	    <article >
	        <div class="media">
	            @if($dbr_post_view->type == Helpers::TYPE_POST_VIDEO || !empty($dbr_post_view->id_video) )
	                <a href="{{route('frontend.post.view', $data_url)}}" class="play_video custom_color_bg"></a>
	            @endif
	            <?php
	                if(!empty($dbr_post_view->id_video)){
	                    $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_post_view->id_video);
	                }else{
	                    $image_featured = Helpers::getImage($dbr_post_view->image_featured, 'noticias');
	                }
	            ?>
	            <a href="{{route('frontend.post.view', $data_url)}}" ><img src="{{$image_featured}}" /></a>
	        </div>
	        <div class="text"><a href="{{route('frontend.post.view', $data_url)}}">{{$dbr_post_view->title}}</a></div>
			<div class="opt">
				<div class="opt1"><a href="{{route('frontend.section.list', array($dbr_post_view->category_slug))}}">+{{ $dbr_post_view->category_name}}</a></div>
				<div class="{{($dbr_post_view->has_gallery == 1 ? 'opt4' : 'opt2')}}"></div>
				<div class="opt3">{{ Helpers::intervalDate($dbr_post_view->post_at, date('Y-m-d H:i:s'))}}</div>
			</div>

	    </article>
	@endforeach
</div>
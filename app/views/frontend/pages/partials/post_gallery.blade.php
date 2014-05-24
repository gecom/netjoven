<div class="wrapper_slider_gallery">
	<div class="close_popup"><a href="#" data-dismiss="modal" class="custom_color_text"><span class="glyphicon glyphicon-remove-circle"></span></a></div>
	<ul id="slider_post_gallery" class="bxslider">
		@foreach($dbl_post_gallery as $dbr_post_gallery)
		<li>
		    <figure>
		    	<img title="{{$dbr_post_gallery->title}}" src="{{ Helpers::getImage($dbr_post_gallery->image, 'gallery')}}" />
		    </figure>
		</li>
		@endforeach
	</ul>
</div>

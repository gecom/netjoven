<?php $url = URL::current(); ?>
<ul>
	<li>
		<div class="fb-like" data-href="{{$url}}" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
	</li>
	<li>
		<a href="https://twitter.com/share" class="twitter-share-button" data-url="{{$url}}" data-lang="en">Tweet</a>
	</li>
	<li>
		<g:plusone size="medium"></g:plusone>
	</li>
</ul>

@section('script')
	!function(d,s,id){
		var js,fjs=d.getElementsByTagName(s)[0];
		if(!d.getElementById(id)){
			js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js,fjs);
		}
	}(document,"script","twitter-wjs");

	(function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	})();
@stop

@section('append_html')
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=1412164285722472";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
@stop
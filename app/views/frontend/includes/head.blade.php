<!-- Basic Page Needs
	================================================== -->
<meta charset="utf-8" />

<title>
	@section('title')
		{{(isset($title_page) ? $title_page : 'Netjoven')}}
	@show
</title>

<!-- CSS
================================================== -->

{{ HTML::style('assets/css/site/bootstrap.min.css')}}
{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,700')}}
{{ HTML::style('assets/css/site/style.css')}}
{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal-bs3patch.css')}}
{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal.css')}}
{{ HTML::style($stylesheet_custom_color, array('id' => 'stylesheet_custom_color'))}}

@section('css')
@show

<meta name="google-site-verification" content="Wd_PpdFPEsJ4Qy20g7Tad1OYhA0ApnlPKUkvlZE2xR4" />
@if (isset( $canonical ))
	<link rel="canonical" href="{{$canonical}}" />	
@endif


<meta property="og:title" content="{{(isset($title_page) ? $title_page : 'Netjoven')}}"/>
@if (isset($description))
	<meta property="og:description" content="{{trim($description)}}"/>
@endif
<meta property="fb:app_id" content="126125754071428"/>
<meta property="og:site_name" content="Netjoven.pe"/>

<meta name="application-name" content="Netjoven.pe" />
<meta name="msapplication-starturl" content="http://www.netjoven.pe/" />
<meta name="msapplication-window" content="width=1024;height=768" />
<meta name="msapplication-navbutton-color" content="#ff0d0f" />
<meta name="msapplication-tooltip" content="Netjoven.pe" />
{{ HTML::script('assets/js/fn/smart_ad_server.js'); }}


<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">

<link href="{{URL::asset('assets/ico/favicon.ico')}}" type="image/x-icon" rel="shortcut icon">

<style>
	@section('styles')
	@show
</style>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
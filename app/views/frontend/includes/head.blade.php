<!-- Basic Page Needs
	================================================== -->
<meta charset="utf-8" />
<title>
	@section('title')
	Laravel 4 Sample Site
	@show
</title>
<meta name="keywords" content="" />
<meta name="author" content="" />
<meta name="description" content="" />

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<!--<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">-->
{{ HTML::style('assets/css/site/bootstrap.min.css')}}
{{ HTML::style('assets/css/site/style.css')}}

<style>
	@section('styles')
	@show
</style>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
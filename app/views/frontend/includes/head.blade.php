<!-- Basic Page Needs
	================================================== -->
<meta charset="utf-8" />
<title>
	@section('title')
		Netjoven
	@show
</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->

{{ HTML::style('assets/css/site/bootstrap.min.css')}}
{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,700')}}
{{ HTML::style('assets/css/site/style.css')}}

<style>
	@section('styles')
	@show
</style>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
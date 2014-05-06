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
<link href="http://netjovenv2.local/favicon.ico" type="image/x-icon" rel="shortcut icon">

<!-- CSS
================================================== -->

{{ HTML::style('assets/css/site/bootstrap.min.css')}}
{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,300,700')}}
{{ HTML::style('assets/css/site/style.css')}}
{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal-bs3patch.css')}}
{{ HTML::style('assets/css/bootstrap_modal/bootstrap-modal.css')}}
{{ HTML::style('assets/css/site/custom/custom_default.css', array('id' => 'stylesheet_custom_color'))}}

@section('css')
@show

<style>
	@section('styles')
	@show
</style>

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
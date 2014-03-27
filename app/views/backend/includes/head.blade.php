<!-- Basic Page Needs
	================================================== -->
<meta charset="utf-8" />
<title>
	@section('title')
	Panel de Administración de Netjoven
	@show
</title>
<meta name="author" content="Jon Doe" />
<meta name="description" content="Panel de Administracion de Netjoven" />

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<!--<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">-->
{{ HTML::style('assets/css/bootstrap.css')}}
{{ HTML::style('assets/font-awesome/css/font-awesome.min.css')}}
{{ HTML::style('assets/css/sb-admin.css')}}
<link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">

<style>
	@section('styles')
	@show
</style>
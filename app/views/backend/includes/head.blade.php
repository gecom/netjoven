<!-- Basic Page Needs
	================================================== -->
<meta charset="utf-8" />
<title>
	@section('title')
		Panel de Administración de Netjoven
	@show
</title>
<meta name="description" content="Panel de Administracion de Netjoven" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- CSS
================================================== -->
<!--<link href="{{{ asset('assets/css/bootstrap.min.css') }}}" rel="stylesheet">-->
	{{ HTML::style('assets/css/bootstrap.min.css')}}
	{{ HTML::style('assets/font-awesome/css/font-awesome.min.css')}}
	{{ HTML::style('assets/css/sb-admin.css')}}
	@section('css')
	@show

<style>
	@section('styles')
	@show
</style>
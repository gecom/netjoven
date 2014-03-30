<!doctype html>
<html lang="es">
<head>
	@include('frontend.includes.head')
</head>
<body>
	<div class="container">

		<header class="row">
			@include('frontend.includes.header')
		</header>

		<div id="main" class="row">
				@yield('content')
		</div>

		<footer class="row">
			@include('frontend.includes.footer')
		</footer>
	</div>
	<!-- Javascripts
		================================================== -->
	<script src="{{{ asset('assets/js/jquery.js') }}}"></script>
	<script src="{{{ asset('assets/js/bootstrap/bootstrap.min.js') }}}"></script>	
</body>
</html>
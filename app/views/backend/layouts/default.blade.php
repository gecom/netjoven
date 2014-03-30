<!DOCTYPE html>
<html>

<head>
	@include('backend.includes.head')
</head>

<body>

    @if(!Auth::check())
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
        </div>
    @else
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                @include('backend.includes.header')
            </nav>
            <nav class="navbar-default navbar-static-side" role="navigation">
                @include('backend.includes.sidebar')
            </nav>
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> 
                            @yield('title_content')                 
                        </h1>
                    </div>
                </div>
                <div class="row">
                    @yield('content')
                </div>
            </div>
        </div>

    @endif

    <!-- Core Scripts - Include with every page -->
    {{ HTML::script('assets/js/jquery-1.10.2.js'); }}
    {{ HTML::script('assets/js/bootstrap.min.js'); }}
    {{ HTML::script('assets/js/plugins/metisMenu/jquery.metisMenu.js'); }}
    @section('js')
    @show
</body>

</html>


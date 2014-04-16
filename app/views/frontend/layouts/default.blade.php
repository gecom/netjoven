<!doctype html>
<html lang="es">
    <head>
        @include('frontend.includes.head')
    </head>
    <body>
        <div id="container" class="container">
            <header class="custom_color_bg">
                @include('frontend.includes.header')
            </header>
            <nav id="main_nav">
                @include('frontend.includes.menu')
            </nav>
            @yield('content')
            <footer>
                @include('frontend.includes.footer')
            </footer>

            <div id="bottom_responsive">
                <div class="paginate">
                    <ul>
                        <li><a href="#" class="custom_color_bg"></a></li>
                        <li><a href="#" class="custom_color_bg"></a></li>
                        <li><a href="#" class="custom_color_bg"></a></li>
                        <li><a href="#" class="custom_color_bg"></a></li>
                        <li><a href="#" class="custom_color_bg"></a></li>
                    </ul>
                </div>
                <div class="go_top">
                    <a href="#"></a>
                </div>
            </div>
        </div>

        {{ HTML::script('assets/js/jquery.js'); }}
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        {{ HTML::script('assets/js/fn/home.js'); }}
        {{ HTML::script('assets/js/bootstrap-hover-dropdown.js'); }}


        @section('js')
        @show
    </body>
</html>
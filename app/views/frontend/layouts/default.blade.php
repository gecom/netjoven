<!DOCTYPE html>
<html>

    <head>
        @include('frontend.includes.head')
    </head>
    <body>
        <div class="container">
            <header>
                @include('frontend.includes.header')
            </header>
            <nav id="main_nav">
                @include('frontend.includes.menu')
            </nav>
                @yield('content')
            <footer>
                @include('frontend.includes.footer')
            </footer>
        </div>

        <!-- Core Scripts - Include with every page -->
        {{ HTML::script('assets/js/jquery-1.10.2.js'); }}
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        @section('js')
        @show
    </body>

</html>


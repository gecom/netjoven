<!doctype html>
<html lang="es">
    <head>
        <?php
            $color = str_replace('#', '', Helpers::getColorCurrent());
            $stylesheet_custom_color = "assets/css/site/custom/custom_color_".$color.".css";
        ?>
        @include('frontend.includes.head')
    </head>
    <body>
        <div class="container">
            <header class="custom_color_bg">
                @include('frontend.includes.header')
            </header>
            <nav id="main_nav">
                @include('frontend.includes.menu')
            </nav>
            <section id="topics_day">
                @include('frontend.includes.topics_day')
            </section>
            @yield('content')
            <footer>
            
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

        <div id="ajax-modal" class="modal fade" tabindex="-1" style="display: none;"></div>

        {{ HTML::script('assets/js/jquery.js'); }}
        {{ HTML::script('assets/js/bootstrap.min.js'); }}
        {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modal.js'); }}
        {{ HTML::script('assets/js/bootstrap_modal/bootstrap-modalmanager.js'); }}
        {{ HTML::script('assets/js/fn/main.js'); }}

        @section('js')
        @show

        <script>
            $(function(){
               $(document).data('color_palette_current','{{$stylesheet_custom_color}}');
            });
            @section('script')
            @show
        </script>
        @section('append_html')
        @show
    </body>
</html>
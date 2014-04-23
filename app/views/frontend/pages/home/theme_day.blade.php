<div class="title_news custom_color_text">Últimas noticias</div>
@if (count($dbl_theme_day))
    <ul class="option_news">
            <li><strong><span class="circle custom_color_bg"></span>Temas del Día</strong></li>
        @foreach ($dbl_theme_day as $dbr_theme_day)
            <li><span class="circle custom_color_bg"></span><a href="#">{{$dbr_theme_day->name}}</a></li>
        @endforeach
    </ul>
@endif
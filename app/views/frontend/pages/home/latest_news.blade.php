<div class="title_news custom_color_text">Últimas noticias</div>
@include('frontend.pages.partials.news_list_home', array('dbl_post_view'=> $dbl_last_post))

@if ($type_module == Helpers::TYPE_MODULE_ESTANDAR)
    <div class="paginate"><a href="{{ route('frontend.post.more_news') }}">Ver mas</a></div>
@endif
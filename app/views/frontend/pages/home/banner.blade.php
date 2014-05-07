<div class="left_banner">
    <article class="p1">
        <figure><img src="{{asset('assets/images/maq/banner1.png')}}"></figure>
    </article>
    <article class="p2">
        <figure><img src="{{asset('assets/images/maq/banner2.jpg')}}" width="100%" height="100%"></figure>
    </article>
</div>
<div class="right_banner">
    <div class="slider">
        <ul class="bxslider">
            @foreach($dbl_last_post_featured_slider as $dbr_post_featured_slider)
                <li>
                    <figure>
                        <a href=""><img title="{{$dbr_post_featured_slider->title}}" src="{{ Helpers::getImage($dbr_post_featured_slider->image, 'featured')}}"></a>
                    </figure>
                </li>
            @endforeach
    </div>
</div>
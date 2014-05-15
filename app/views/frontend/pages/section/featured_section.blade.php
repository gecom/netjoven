@if ($dbr_post_featured_section)

<?php 
    $dbr_post_first = $dbr_post_featured_section->post()->first();
    $dbr_parent_category = Category::getParentCategoryById($dbr_post_first->category_parent_id)->first();
    $data_url = array($dbr_parent_category->slug, $dbr_post_first->id, $dbr_post_first->slug);
?>

    <div class="portada_destacado">
        <figure>
            <a href="{{ route('frontend.post.view', $data_url) }}"><img src="{{ Helpers::getImage($dbr_post_featured_section->image, 'featured')}}" alt="{{$dbr_post_featured_section->title}}"></a>
        </figure>
        <div class="desc"><a href="{{ route('frontend.post.view', $data_url) }}">{{$dbr_post_featured_section->title}}</a></div>
        <div class="opt">
            <div class="opt1"><!--<a href="#">+Destacado</a>--></div>
            <div class="opt2"></div>
            <div class="opt3">{{ Helpers::intervalDate($dbr_post_featured_section->post_at, date('Y-m-d H:i:s'))}}</div>                        
        </div>
    </div>
@endif


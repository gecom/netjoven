<div class="mas_visto bx-wrapper">
    @if (isset($dbl_slider_more) && count($dbl_slider_more))
        <div id="slider_more_tab" class="tab">
            @if (isset($dbl_slider_more['related']))
                {{Lang::get('messages.frontend.slider_more_title_related')}} <span class="t4"></span>
            @else
                {{Lang::get('messages.frontend.slider_more_title_read')}} <span class="t1"></span>
            @endif
        </div>
        <div id="slider_more" class="list">
            @if (isset($dbl_slider_more['related']))
                <div class="slider_item" data-slider="0" data-title="{{Lang::get('messages.frontend.slider_more_title_related')}}" data-class="t4" >
                    @foreach ($dbl_slider_more['related'] as $dbr_more_related)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_related))
                    @endforeach
                </div>
            @endif

            @if (isset($dbl_slider_more['more_read']))
                <div class="slider_item" data-slider="0" data-title="{{Lang::get('messages.frontend.slider_more_title_read')}}" data-class="t1">
                    @foreach ($dbl_slider_more['more_read'] as $dbr_more_read)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_read))
                    @endforeach
                </div>
            @endif

            @if (isset($dbl_slider_more['more_commented']))
                <div class="slider_item" data-slider="1" data-title="{{Lang::get('messages.frontend.slider_more_title_commented')}}" data-class="t2">
                    @foreach ($dbl_slider_more['more_commented'] as $dbr_more_commented)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_commented))
                    @endforeach
                </div>
            @endif

            @if ($dbl_slider_more['more_shared'])
                 <div class="slider_item" data-slider="2" data-title="{{Lang::get('messages.frontend.slider_more_title_shared')}}" data-class="t3">
                    @foreach ($dbl_slider_more['more_shared'] as $dbr_more_shared)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_shared))
                    @endforeach
                 </div>
            @endif

            @if ($dbl_slider_more['has_gallery'])
                 <div class="slider_item" data-slider="3" data-title="{{Lang::get('messages.frontend.slider_more_title_has_gallery')}}" data-class="t3">
                    @foreach ($dbl_slider_more['has_gallery'] as $dbr_more_gallery)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_gallery))
                    @endforeach
                 </div>
            @endif

            @if ($dbl_slider_more['has_video'])
                 <div class="slider_item" data-slider="4" data-title="{{Lang::get('messages.frontend.slider_more_title_has_video')}}" data-class="t3">
                    @foreach ($dbl_slider_more['has_video'] as $dbr_more_video)
                        @include('frontend.pages.partials.slider_section_item', array('dbr_slider_more' => $dbr_more_video))
                    @endforeach
                 </div>
            @endif

        </div>
        <div class="pagine bx-pager bx-default-pager">
            <?php $total_paginate = count($dbl_slider_more) ?>
            @for ($i = 1; $i <= $total_paginate ; $i++)
                <div class="bx-pager-item"><a class="bx-pager-link {{$i == 1 ? 'active' : ''}}" data-slide-index="{{$i - 1}}" href="">{{$i}}</a></div>
            @endfor
        </div>
    @endif
 </div>

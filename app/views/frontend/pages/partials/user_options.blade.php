<?php
    $type_module = Helpers::getTypeModule();
?>

<ul id="view_options" class="view_options">
    <li data-type="{{Helpers::TYPE_MODULE_ESTANDAR}}" class="v1" ><a class="{{$type_module == Helpers::TYPE_MODULE_ESTANDAR ? 'active custom_color_bg' : ''}}" href="#" ></a></li>
    <li data-type="{{Helpers::TYPE_MODULE_MODULAR}}" class="v2"><a class="{{$type_module == Helpers::TYPE_MODULE_MODULAR ? 'active custom_color_bg' : ''}}" href="#"></a></li>
    <li data-type="{{Helpers::TYPE_MODULE_LISTADO}}" class="v3"><a class="{{$type_module == Helpers::TYPE_MODULE_LISTADO ? 'active custom_color_bg' : ''}}" href="#"></a></li>
    <li class="v4">
        @if (Auth::check())
            <?php 
                $dbr_user = Auth::user();
                $dbr_user_profie = $dbr_user->userProfile()->first();
            ?>
            <a>
                <span>{{Lang::get('messages.frontend.welcome_user') . ' ' . $dbr_user_profie->first_name }}</span>
                <figure class="icon_v4 custom_color_bg"><img src="assets/images/maq/user.jpg" alt=""></figure>
            </a>
            <span class="label label-danger glyphicon glyphicon-info-sign">&nbsp;</span>
        @else
            <a id="login" href="{{route('frontend.login')}}">
                <span>Iniciar Sesión</span><div class="icon_v4 custom_color_bg"></div>
            </a>
        @endif
    </li>
    <li class="v5"><a id="user_tools_color" href="{{ route('frontend.user.tools.changecolor') }}" class="active custom_color_bg"></a></li>
</ul>
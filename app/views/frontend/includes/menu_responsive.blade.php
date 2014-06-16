<?php $current_url = Request::segment(1); ?>
<ul class="menu" >
    <li class="li_menu {{!empty($current_url) && $current_url == 'noticias' ? 'active custom_color_bg' : ''}}"><a href="{{ route('frontend.post.more_news') }}" >Ultimas</a></li>
    <li class="li_menu {{!empty($current_url) && $current_url == 'cartelera' ? 'active custom_color_bg' : ''}}"><a href="{{ route('frontend.section.list', array('cartelera')) }}">Cine</a></li>
    <li class="li_menu {{!empty($current_url) && $current_url == 'radio' ? 'active custom_color_bg' : ''}}"><a href="{{ route('frontend.radio') }}">Radio</a></li>
</ul>
<div class="options">
    <a href="#" class="show_menu"></a>
    <div class="search_box">
        <input type="text" class="input-search" name="keyword" placeholder="BUSCAR..."/>
        <input type="button" class="btn-search" value="" />
        <div class="bg_search"></div>
    </div>
    <div class="circles" style="display:none"></div>
    <a href="#" class="search" style="display:none"></a>
    <a href="#" class="config"></a>
    <div class="showing_config" style=" display:none">
        <div class="welcome">
            @if (Auth::check())
                <?php
                    $dbr_user = Auth::user();
                    $dbr_user_profie = $dbr_user->userProfile()->first();
                ?>
                <div class="bien">{{Lang::get('messages.frontend.welcome_user') . ' ' . ($dbr_user_profie ? $dbr_user_profie->first_name) : '' }}</div>
                <figure class="icon_v4"><img alt="" src="assets/images/maq/user.jpg"></figure>
            @else
                <a href="#" class="log_in_mobile"  >Iniciar Sesión</a>
                <span class="user_icon" ></span>
                <div class="iniciar_sesion" style="display:none">
                {{ Form::open(array('route' => 'frontend.login.post', 'role'=>'form', 'id' => 'frm_login', 'autocomplete' => 'off')) }}
                    <div class="form-group">
                        <input type="text" name="email" class="form-control" placeholder="Correo electronico" />
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Contraseña" />
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn_login" value="Entrar" />
                    </div>
                {{ Form::close() }}
                    <a href="#" class="lnk1">Olvidaste tu Contraseña?</a>
                    <div class="registrate">
                        ¿Eres nuevo en Netjoven?<br/>
                        <a href="{{ route('frontend.user.register') }}" class="registrate_btn">Regístrate</a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
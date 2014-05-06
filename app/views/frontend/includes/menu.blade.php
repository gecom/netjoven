<?php

$type_module = Helpers::getTypeModule();

if (!Cache::has('dbl_categories_home')){
    Cache::forever('dbl_categories_home', Helpers::getCategoriesHome());
}

$dbl_categories_home = Cache::get('dbl_categories_home');

 ?>
<div class="row">
    <ul class="menu menu_desktop">
        <li class="li_menu active custom_color_bg"><a href="{{ route('home') }}" >INICIO</a></li>
        @foreach ($dbl_categories_home as $key => $dbr_category_home)
            <li class="li_menu">
                <a href="{{ route('frontend.section.list', array($dbr_category_home['slug'])) }}" role="button" class="dropdown-toggle" data-toggle="dropdown" >{{ mb_strtoupper($dbr_category_home['name']) }}</a>
                @if(isset($dbr_category_home['children_category']))
                    <div style="display:none" class="dropdown">
                        <ul>
                            @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                                <li id="{{$children_category['id']}}" ><a href="{{ route('frontend.section.list', array($children_category['slug'])) }}" >{{$children_category['name']}}</a></li>
                            @endforeach
                        </ul>
                        <?php $i = 0; ?>
                        @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                            <div class="videos_drop" id ="children_category_{{$children_category['id']}}" style="display:none">
                                <?php
                                    $dbl_post_category = Cache::remember('category_post_'.$children_category['id'], 120, function() use ($children_category) {
                                        $params['view_index'] = 1;
                                        $params['category_id'] = $children_category['id'];
                                        $params['show_limit'] = array(4,0);

                                        return Post::getPostNews($params)->get();
                                    });
                                ?>
                                @foreach ($dbl_post_category as $dbr_post_category)
                                    <?php
                                        $dbr_parent_category = Category::getParentCategoryById($dbr_post_category->category_parent_id)->first();
                                        $data_url = array($dbr_parent_category->slug, $dbr_post_category->id, $dbr_post_category->slug);
                                    ?>
                                    <?php
                                        $dbr_image_featured = Gallery::getImageFeaturedByPostId($dbr_post_category->id)->first();
                                        $image_featured = ($dbr_image_featured ? $dbr_image_featured->image : null);

                                        if(!empty($dbr_post_category->id_video)){
                                            $image_featured = Helpers::getThumbnailYoutubeByIdVideo($dbr_post_category->id_video);
                                        }else{
                                            $image_featured = Helpers::getImage($image_featured, 'noticias');
                                        }
                                    ?>
                                    <div class="video_item">
                                        <figure>
                                            <a href="{{ route('frontend.post.view', $data_url) }}"><img src="{{$image_featured}}" alt="{{$dbr_post_category->image}}">
                                                @if ($dbr_post_category->type == Helpers::TYPE_POST_VIDEO)
                                                    <div class="play  custom_color_bg"></div>
                                                @endif
                                            </a>
                                        </figure>
                                        <div class="description">{{ $dbr_post_category->title}}</div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach

                    </div>

                @endif
            </li>
        @endforeach
    </ul>

    <div class="menu_responsive" style="display:none">
        <ul class="menu" >
            <li class="li_menu active custom_color_bg">
                <a href="#" >Ultimas</a>                                
            </li>                           
            <li class="li_menu">
                <a href="#">Cine</a>                                
            </li>
            <li class="li_menu">
                <a href="#">Video</a>                               
            </li>
            <li class="li_menu">
                <a href="#">Radio</a>                               
            </li>        
        </ul>
        <div class="options">
            <a href="#" class="show_menu"></a>
            <ul class="showing_menu" style="display:none">
                    <li class="opt_menu"><a href="#">Inicio</a></li>
                    <li class="opt_menu"><a href="#">Espectáculos</a></li>
                    <li class="opt_menu"><a href="#">Deportes</a></li>
                    <li class="opt_menu"><a href="#">Actualidad</a></li>
                    <li class="opt_menu"><a href="#">Gamers</a></li>
                    <li class="opt_menu"><a href="#">Estilo de vida</a></li>
                    <li class="opt_menu"><a href="#">Netjoven TV</a></li>
                    <li class="opt_menu">   
                        Conectate y Comparte
                        <a href="#" class="gp"></a>
                        <a href="#" class="tw"></a>
                        <a href="#" class="fb"></a>
                        
                    </li>
                    
                </ul>
            <div class="search_box">
                <input type="text" value="Buscar...">
                <input type="button" class="btn_search" value="">
                <div class="bg_search"></div>
            </div>
            <div class="circles" style="display:none"></div>
            <a href="#" class="search" style="display:none"></a>
            <a href="#" class="config"></a>
            <div class="showing_config" style=" display:none">
                <div class="welcome">
                    <div class="bien">Bienvenido Luis Walters</div>
                    <a href="#" class="log_in_mobile"  >Iniciar Sesión</a>
                    <span class="user_icon" ></span>
                    <div class="iniciar_sesion" style="display:none">
                        <input type="text" value="Usuario" class="login_input"><br/>
                        <input type="text" value="Contraseña" class="login_input"><br/>
                        <input type="button" class="btn_login" value="Entrar">
                        <a href="#" class="lnk1">Olvidaste tu Contraseña?</a>
                        <div class="registrate">
                            Eres nuevo en Netjoven?<br/>
                            <a href="#" class="registrate_btn">Regístrate</a>
                        </div>
                    </div>
                    <div class="registro_form" style="display:none">
                        Regístrate con Netjoven<br/>
                        <input type="text" value="Nombre" class="login_input"><br/>
                        <input type="text" value="Apellidos" class="login_input"><br/>
                        <input type="text" value="Correo Electrónico" class="login_input"><br/>
                        <input type="text" value="Contraseña" class="login_input"><br/>
                        <input type="text" value="Repetir Contraseña" class="login_input"><br/>
                        <select class="sel1" name="" id=""><option>Día</option></select>
                        <select  class="sel1"name="" id=""><option>Mes</option></select>
                        <select class="sel1" name="" id=""><option>Año</option></select><br/>
                        <select class="sel2" name="" id=""><option>Sexo</option></select><br/>
                        <a href="#" class="finalizar_btn">Finalizar</a>
                        <div class="redes_sociales">
                            Registro con Redes<br/>
                            <a href="#" class="fb"></a>
                            <a href="#" class="tw"></a>
                            <a href="#" class="gp"></a>
                        </div>
                    </div>
                </div>
                <div class="pick_color">
                    <span class="t1">Diseña tu interfaz</span>
                    <ul>
                        <li><a href="#" style="background-color: #ffb900"></a></li>
                        <li><a href="#" style="background-color: #eb790b"></a></li>
                        <li><a href="#" style="background-color: #ffd240"></a></li>
                        <li><a href="#" style="background-color: #7464c4"></a></li>
                        <li><a href="#" style="background-color: #403a96"></a></li>
                        <li><a href="#" style="background-color: #6536ba"></a></li>
                        <li><a href="#" style="background-color: #ac009e"></a></li>
                        <li><a href="#" style="background-color: #00a9ab"></a></li>
                        <li><a href="#" style="background-color: #0081fb"></a></li>
                        <li><a href="#" style="background-color: #00c5f8"></a></li>
                        <li><a href="#" style="background-color: #ff4a65"></a></li>
                        <li><a href="#" style="background-color: #ef2c35"></a></li>
                        <li><a href="#" style="background-color: #ff5f60"></a></li>
                        <li><a href="#" style="background-color: #00be51"></a></li>
                        <li><a href="#" style="background-color: #009725"></a></li>
                        <li><a href="#" style="background-color: #00a85b"></a></li>
                        <li><a href="#" style="background-color: #1e3c4d"></a></li>
                        <li><a href="#" style="background-color: #00222f"></a></li>
                        <li><a href="#" style="background-color: #424141"></a></li>
                        <li><a href="#" style="background-color: #5d5d5d"></a></li>
                    </ul>
                    <span class="t2">¿Deseas guardar los cambios?</span>
                    <a href="#" class="cancel"></a>
                    <a href="#" class="save"></a>
                    
                </div>
                <div class="share">
                    <span>Conectate y comparte</span>
                    <a href="#" class="gp"><span></span>12200</a>
                    <a href="#" class="tw"><span></span>1200</a>
                    <a href="#" class="fb"><span></span>14000</a>
                </div>
                <div class="change">
                    <span>Cambia la interfaz de netjoven a tu estilo</span>
                    <a href="#" class="v3"></a>
                    <a href="#" class="v2"></a>                    
                </div>
                <div class="cerrar_sesion" style="display:none">
                    <a href="#">Cerrar sesión</a>
                </div>

            </div>
        </div>
    </div>

    <ul class="options_menu_fixed" style="display:none">
        <li><a href="#" class="search custom_color_bg"></a>
            <div class="search_box custom_color_bg" style="display:none">
                <input type="text" placeholder="Buscar..." />
                <div class="bg_search"></div>
            </div>
        </li>
        <li><a href="#" class="config"></a></li>
    </ul>
</div>
<div class="row user_options">
    <ul id="view_options" class="view_options">
        <li data-type="{{Helpers::TYPE_MODULE_ESTANDAR}}" class="v1" ><a class="{{$type_module == Helpers::TYPE_MODULE_ESTANDAR ? 'active custom_color_bg' : ''}}" href="#" ></a></li>
        <li data-type="{{Helpers::TYPE_MODULE_MODULAR}}" class="v2"><a class="{{$type_module == Helpers::TYPE_MODULE_MODULAR ? 'active custom_color_bg' : ''}}" href="#"></a></li>
        <li data-type="{{Helpers::TYPE_MODULE_LISTADO}}" class="v3"><a class="{{$type_module == Helpers::TYPE_MODULE_LISTADO ? 'active custom_color_bg' : ''}}" href="#"></a></li>
        <li class="v4"><a id="login" href="{{route('frontend.login')}}"><span>Iniciar Sesión</span><div class="icon_v4 custom_color_bg"></div></a></li>
        <li class="v5"><a href="#" class="active custom_color_bg"></a></li>
    </ul>
</div>

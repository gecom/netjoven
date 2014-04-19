<div class="row">
        <ul class="menu menu_desktop">
            <li class="li_menu active custom_color_bg"><a href="#" >INICIO</a></li>
            @foreach ($dbl_categories_home as $key => $dbr_category_home)
                <li class="li_menu">
                    <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown" >{{ mb_strtoupper($dbr_category_home['name']) }}</a>
                    @if(isset($dbr_category_home['children_category']))
                        <div style="display:none" class="dropdown">
                            <ul>
                                @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                                    <li id="{{$children_category['id']}}" ><a href="#" >{{$children_category['name']}}</a></li>
                                @endforeach
                            </ul>
                            <?php $i = 0; ?>
                            @foreach ($dbr_category_home['children_category'] as $key_children => $children_category)
                                <div class="videos_drop" id ="children_category_{{$children_category['id']}}" style="display:none">
                                    <?php
                                        $params['view_index'] = 1;
                                        $params['category_id'] = $children_category['id'];
                                        $params['show_limit'] = array(4,0);
                                        $dbl_post_category = Post::getPost($params)->get();
                                    ?>
                                    @foreach ($dbl_post_category as $dbr_post_category)
                                        <div class="video_item">
                                            <figure>
                                                <a href="#"><img src="images/maq/vide_item_1.jpg" alt="">
                                                <div class="play  custom_color_bg"></div></a>
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
                    <div class="bg_search"></div>
                </div>
                <div class="circles" style="display:none"></div>
                <a href="#" class="search" style="display:none"></a>
                <a href="#" class="config"></a>
                <div class="showing_config" style=" display:none">
                    <div class="welcome">
                        Bienvenido Luis Walters
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

    <ul class="view_options">
        <li class="v1" ><a class="active custom_color_bg" href="#" ></a></li>
        <li class="v2"><a href="#"></a></li>
        <li class="v3"><a href="#"></a></li>
        <li class="v4"><a href="#"><span>Iniciar Sesión</span><div class="icon_v4 custom_color_bg"></div></a></li>
        <li class="v5"><a href="#" class="active custom_color_bg"></a></li>
    </ul>

</div>

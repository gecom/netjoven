        <ul class="menu" >
            <li class="li_menu active custom_color_bg"><a href="#" >Ultimas</a></li>                           
            <li class="li_menu"><a href="#">Cine</a></li>
            <li class="li_menu"><a href="#">Video</a></li>
            <li class="li_menu"><a href="#">Radio</a></li>        
        </ul>
        <div class="options">
            <a href="#" class="show_menu"></a>
            <ul class="showing_menu" style="display:none">
                <li class="opt_menu"><a href="{{ route('home') }}">INICIO</a></li>
                @foreach ($dbl_categories_home as $key => $dbr_category_home)
                    <li class="opt_menu"><a href="{{ route('frontend.section.list', array($dbr_category_home['slug'])) }}">{{mb_strtoupper($dbr_category_home['name'])}}</a></li>
                @endforeach
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
                <!--<div class="pick_color">
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
                    
                </div>-->
               <!--  <div class="share">
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
                </div>-->

            </div>
        </div>
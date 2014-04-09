<div class="row">
    <div class="col-md-12 visible-lg visible-md">
        <ul class="menu">
			<li class="active"><a href="#" >INICIO</a></li>
			@foreach ($dbl_categories_home as $key => $dbr_category_home)
				<li><a href="#" >{{ mb_strtoupper($dbr_category_home['name']) }}</a></li>
			@endforeach
        </ul>
    </div>
</div>
<div class="row user_options">
    <ul class="view_options">
        <li class="v1" ><a class="active" href="#" ></a></li><li class="v2"><a href="#"></a></li><li class="v3"><a href="#"></a></li><li class="v4"><a href="#"><span>Iniciar Sesión</span><div class="icon_v4"></div></a></li><li class="v5"><a href="#"></a></li>
    </ul>
</div>
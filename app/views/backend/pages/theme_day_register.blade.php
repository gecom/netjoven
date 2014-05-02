@extends('backend.layouts.default')

@section('css')

@stop

@section('title_content')
	Registrar Tema del Día
@stop

@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Registrar Temas del Día</div>
    <div class="panel-body">
        <div class="row">
             <div class="col-lg-12">
                <form id="frm_theme_day" enctype="multipart/form-data" accept-charset="UTF-8" method="post" action="{{route('backend.theme_day.save_new')}}"  autocomplete="off">
                    {{ Form::hidden('frm_theme_day[is_new]', ($is_new ? 1 : 0) , array('id' => 'frm_theme_day_is_new')) }}
                    <div class="col-lg-7">
                        <div class="form-group">
                            {{ Form::label('frm_theme_day_name', 'Tema') }}
                            {{ Form::text('frm_theme_day[name]', null, array('id' => 'frm_theme_day_name', 'placeholder' => 'Ingrese Tema', 'class' => 'form-control')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('frm_theme_day_params', 'Parametros') }}
                            {{ Form::text('frm_theme_day_params[params]', null, array('id' => 'frm_theme_day_params', 'placeholder' => 'Ingrese Parametros', 'class' => 'form-control')) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label('frm_theme_day_color', 'Color') }}
                            {{ Form::text('frm_theme_day[color]', null, array('id' => 'frm_theme_day_color', 'placeholder' => 'Ingresar color', 'class' => 'form-control')) }}
                        </div>

                        <div class="form-group ">
                            {{ Form::label('frm_theme_day_sections', 'Secciones de la página donde se va a colorear el tema:') }}
                            <select multiple="multiple" size="6" name="frm_theme_day[sections][]" id="frm_theme_day_sections" class="form-control">
                                @foreach($dbl_parent_categories as $parent_category)
                                <?php
                                    if($parent_category->is_menu == 0){
                                        continue;
                                    }
                                ?>
                                <?php //$selected = (!$is_new && ($parent_category->id == $dbr_post_category->parent_id)  ? 'selected="selected"': '' ); ?>

                                <option value="{{$parent_category->id}}">{{$parent_category->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Guardar</button>
                    </div>
                </form>
             </div>
        </div>
    </div>
</div>
@stop

@section('js')
    {{ HTML::script('assets/js/sb-admin.js'); }}
    {{ HTML::script('assets/js/backend/theme_day_register.js'); }}
@stop


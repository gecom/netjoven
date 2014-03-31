@extends('backend.layouts.default')

@section('title')
    Panel de Adnistración de Netjoven - Login
@stop

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-warning">{{ Session::get('message') }}</div>
    @endif
    <div class="col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Por favor Inicie Sesión</h3>
            </div>
            <div class="panel-body">
                {{ Form::open(array('role'=>'form')) }}
                    <fieldset>
                        <div class="form-group">
                            {{ Form::text('email', null, array('class'=>'form-control', 'placeholder'=>'Correo electronico')) }}
                        </div>
                        <div class="form-group">
                            {{ Form::password('password', array('class'=>'form-control', 'placeholder'=>'Password')) }}
                        </div>
                        {{ Form::submit('Login', array('class'=>'btn btn-lg btn-success btn-block'))}}
                    </fieldset>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('js') 
    {{ HTML::script('assets/js/sb-admin.js'); }}
@stop
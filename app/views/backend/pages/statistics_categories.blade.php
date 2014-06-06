@extends('backend.layouts.default')

@section('title_content')
	{{$title}}
@stop

@section('css')
	{{ HTML::style('assets/css/backend/datetimepicker.css')}}
@stop


@section('content')

<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Estadistica de {{$title}}
        </div>
        <div class="panel-body">
            <div class="row">
            	{{ Form::open(array('id' => 'frm_statistics_filter')) }}
	            	<div class="col-md-12">
						<div class="row">
						    <div class="col-lg-4">
						        <div class="form-group ">
						            <label for="frm_statistics_filter_date_start">Desde</label> 
						            <div id="datetimepicker_date_start" class="input-group date"  data-date-format="DD/MM/YYYY">
									{{Form::text('frm_statistics_filter[date_start]', null, array('id' => 'frm_statistics_filter_date_start', 'class' => 'form-control'))}}
									<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
									</div>
						        </div>
						    </div>				
						    <div class="col-lg-4 ">
						        <div class="form-group">
									<label for="frm_statistics_filter_date_end">Hasta</label>  
									<div id="datetimepicker_date_start" class="input-group date"  data-date-format="DD/MM/YYYY">                                             
									{{Form::text('frm_statistics_filter[date_end]', null, array('id' => 'frm_statistics_filter_date_end', 'class' => 'form-control'))}}
									<span class="input-group-addon"><span class="glyphicon-calendar glyphicon"></span></span>
									</div>
						        </div>
						    </div>						
						</div>
						<div class="row ">
							<div class="col-md-12">
								<button type="submit" class="btn btn-primary pull-right">Buscar</button>
							</div>                			
						</div>
	            	</div>
            	{{ Form::close() }} 

                <div class="show-grid col-lg-12">
					<table id="grid_statistics" class="table table-striped table-bordered table-hover dataTable no-footer">
						<thead>
							<tr>
								<th>Categoria</th>
								<th>Redacciones</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($dbl_statistics_post as $dbr_statistics_post)
							<tr>
								<td>{{$dbr_statistics_post->name}}</td>
								<td>{{$dbr_statistics_post->total_post}}</td>
							</tr>
							@endforeach
						</tbody>
					</table>

					{{$dbl_statistics_post->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
	{{ HTML::script('assets/js/sb-admin.js'); }}
	{{ HTML::script('assets/js/datetimepicker/moment.js'); }}
	{{ HTML::script('assets/js/datetimepicker/datetimepicker.es.js'); }}
	{{ HTML::script('assets/js/datetimepicker/datetimepicker.js'); }}
	{{ HTML::script('assets/js/backend/statistics.js'); }}
@stop
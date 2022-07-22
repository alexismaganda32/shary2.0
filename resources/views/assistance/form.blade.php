@extends('layouts.app')

@section('script')
	<script>
		var object = {
			url : '{{ url('assistance') }}',
			action : '{{ $action }}',
		}
		@if (isset( $assistance ))
		    object.data =  @json($assistance);
		@endif
	</script>
	<script src="{{ asset('js/Controllers/AssistanceController.js') }}"></script>
    <script src="{{ asset('plugins/moment/min/moment-with-locales.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function () {
            $('#hour').datetimepicker({
                locale: 'es',
                format: 'HH:mm'
            });
            $('#date').datetimepicker({
                locale: 'es',
                format: 'DD-MM-YYYY'
            });
        });
    </script>
@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css') }}">
@endsection
@section('title', 'ASISTENCIA!')

@section('content')

	@include('shared.loadingView')

	<div class="row view" ng-controller="AssistanceController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong ng-bind="textAction">CREAR</strong> <strong>ASISTENCIA</strong>
					</span>
					<ul class="options pull-right list-inline">
						<li>
							<a href="#" class="opt panel_colapse" data-toggle="tooltip" data-placement="bottom" title="Todos los campos con (*) son requeridos">
								<i class="far fa-question-circle fa-lg"></i>
							</a>
						</li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="form-group">
			                    <label>Nombre del instructor *</label>
								<select class="selectpicker form-control" data-live-search="true" title="Seleccione un instructor" ng-model="data.instructor_id">
									<option data-hidden="true"></option>
					                @foreach($instructores as $instructor)
										<option ng-value="{{ $instructor->id }}">{{ $instructor->name.' '.$instructor->surnameP.' '.$instructor->surnameM}}</option>
					                @endforeach
					            </select>
				            </div>
                            <div class="form-group">
				            	<label>Anfitrion: *</label>
					            <select class="selectpicker form-control" multiple data-live-search="true" title="Seleccione un anfitrion" ng-model="data.hosts">
									<option data-hidden="true"></option>
					                @foreach($hosts as $host)
										<option ng-value="{{ $host->id }}">{{ $host->name}}</option>
					                @endforeach
					            </select>
					        </div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
					        <div class="form-group">
				            	<label>Curso: *</label>
					            <select class="selectpicker  form-control" data-live-search="true" title="Seleccione un curso" ng-model="data.curso_id">
									<option data-hidden="true"></option>
					                @foreach($cursos as $curso)
										<option ng-value="{{ $curso->id }}">{{ $curso->name}}</option>
					                @endforeach
					            </select>
					        </div>
                            <div class="form-group">
				                <label>Fecha:</label>
				                <div class='input-group date'>
                                    <input type='text' class="form-control" id='date' ng-model="data.date"/>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                    </span>
                                 </div>
				            </div>
                            <div class="form-group">
				                <label>Hora:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control" id='hour' ng-model="data.hour"/>
                                    <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-time"></span>
                                    </span>
                                </div>
				            </div>
						</div>
					</div>

					@include('shared.alertMessageError')
				</div>
				<div class="panel-footer">
					<button type="button" class="btn btn-success btn-sm" ng-click="save()" id="save">
						<i class="far fa-check-circle"></i> GUARDAR
					</button>
					<a href="{{ url()->previous() }}">
					  	<button type="button" class="btn btn-warning btn-sm">
					  		<i class="far fa-times-circle"></i> CANCELAR
					  	</button>
					</a>
				</div>
			</div>
		</div>

		@include('shared.modalSuccess')
	</div>
@endsection

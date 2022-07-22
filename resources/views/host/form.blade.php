@extends('layouts.app')

@section('script')
	<script>
		var object = {
			url : '{{ url('host') }}',
			action : '{{ $action }}',
		}
		@if (isset( $host ))
		    object.data =  @json($host);
		@endif
	</script>
	<script src="{{ asset('js/Controllers/FormController.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}"></script>
@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection
@section('title', 'ANFITRIONES!')

@section('content')

	@include('shared.loadingView')

	<div class="row view" ng-controller="FormController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong ng-bind="textAction">CREAR</strong> <strong>ANFITRION</strong>
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
			                    <label>Nombre *</label>
			                    <input type="text" class="form-control" ng-model="data.name">
				            </div>
				            <div class="form-group">
				                <label>Apellido Paterno *</label>
				                <input type="text" class="form-control" ng-model="data.surnameP">
				            </div>
				            <div class="form-group">
				                <label>Apellido Materno</label>
				                <input type="text" class="form-control" ng-model="data.surnameM">
				            </div>
				            <div class="form-group">
				                <label>Numero de colaborador *</label>
				                <input type="number" class="form-control" ng-model="data.NC">
				            </div>
				            <div class="form-group">
				                <label>Numero de casa *</label>
				                <input type="number" class="form-control" ng-model="data.house">
				            </div>
				            <div class="form-group">
				                <label>Numero de telefono *</label>
				                <input type="number" class="form-control" ng-model="data.mobile">
				            </div>
				            <div class="form-group">
				                <label>Contacto de emergencia *</label>
				                <input type="number" class="form-control" ng-model="data.CE">
				            </div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="form-group">
				                <label>NSS *</label>
				                <input type="text" class="form-control" ng-model="data.NSS">
				            </div>
				            <div class="form-group">
			                    <label>Correo electrónico *</label>
			                    <input type="text" class="form-control" ng-model="data.email">
				            </div>
							<div class="form-group">
				            	<label>Razon social: *</label>
					            <select class="selectpicker form-control" data-live-search="true" title="Seleccione una razon social" id="social-id" ng-model="data.reason_social_id">
									<option data-hidden="true"></option>
					                @foreach($reason_socials as $social)
										<option ng-value="{{ $social->id }}">{{ $social->name}}</option>
					                @endforeach
					            </select>
					        </div>
					        <div class="form-group">
				            	<label>Departamento: *</label>
					            <select class="selectpicker form-control" data-live-search="true" title="Seleccione un departamento" id="department-id" ng-model="data.department_id">
									<option data-hidden="true"></option>
					                @foreach($departments as $department)
										<option ng-value="{{ $department->id }}">{{ $department->name}}</option>
					                @endforeach
					            </select>
					        </div>
					        <div class="form-group">
				            	<label>Puesto: *</label>
					            <select class="selectpicker form-control" data-live-search="true" title="Seleccione un puesto" id="puesto-id" ng-model="data.puesto_id">
									<option data-hidden="true"></option>
					                @foreach($puestos as $puesto)
										<option ng-value="{{ $puesto->id }}">{{ $puesto->name}}</option>
					                @endforeach
					            </select>
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

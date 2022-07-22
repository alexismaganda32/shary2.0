@extends('layouts.app')

@section('script')
	<script>
		var object = {
			url : '{{ url('user') }}',
			action : '{{ $action }}',
		}
		@if (isset( $user ))
		    object.data =  @json($user);
		@endif
	</script>
	<script src="{{ asset('js/Controllers/FormController.js') }}"></script>
	<script src="{{ asset('plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap-select/dist/js/i18n/defaults-es_ES.min.js') }}"></script>
@endsection
@section('style')
	<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
@endsection
@section('title', 'USUARIO!')

@section('content')

	@include('shared.loadingView')
	
	<div class="row view" ng-controller="FormController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong ng-bind="textAction">CREAR</strong> <strong>USUARIO</strong>
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
				                <label>Apellido *</label>
				                <input type="text" class="form-control" ng-model="data.surname">
				            </div>
				            <div class="form-group">
			                    <label>Correo electrónico *</label>
			                    <input type="text" class="form-control" ng-model="data.email">
				            </div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="form-group">
				            	<label>Role: *</label>
					            <select class="selectpicker form-control" data-live-search="true" title="Seleccione un role" id="sel_role" ng-model="data.role_id">
									<option data-hidden="true"></option>
					                @foreach($roles as $role)
										<option ng-value="{{ $role->id }}">{{ $role->name}}</option>
					                @endforeach
					            </select>
					        </div>
							<div class="form-group">
			                    <label>Contraseña *</label>
			                    <input type="password" class="form-control" ng-model="data.password">
				            </div>
				            <div class="form-group">
			                    <label>Confirmar Contraseña *</label>
			                    <input type="password" class="form-control" ng-model="data.password_confirmation">
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

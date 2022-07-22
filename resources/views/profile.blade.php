@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : '{{ url('/') }}' };
	</script>
	<script src="{{ asset('js/Controllers/ProfileController.js') }}"></script>
@endsection
@section('title', 'PERFIL!')

@section('content')

	@include('shared.loadingView')
	
	<div class="row view" ng-controller="ProfileController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>ACTUALIZAR INFORMACIÓN</strong>
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
						<div class="col-lg-8 col-sm-12">
							<div class="tabs bg-white nomargin-top">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#personal-information" data-toggle="tab" aria-expanded="true" ng-click="setMessage()"><i class="fas fa-user-cog"></i> Información Personal</a>
									</li>
									<li class="">
										<a href="#change-password" data-toggle="tab" aria-expanded="false" ng-click="setMessage()"><i class="fas fa-user-lock"></i> Cambiar Contraseña</a>
									</li>
								</ul>

								<div class="tab-content">
									<!-- personal-information -->
									<div id="personal-information" class="tab-pane active">
										<form class="form-horizontal">
											<fieldset>
												<div class="form-group">
													<label class="col-md-3 control-label">Role</label>
													<div class="col-md-8">
														<input type="text" class="form-control" readonly value="{{ App\Role::find(Auth::user()->role_id)->name }}">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Correo electrónico</label>
													<div class="col-md-8">
														<input type="text" class="form-control" readonly value="{{ Auth::user()->email }}">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Nombre *</label>
													<div class="col-md-8">
														<input type="text" class="form-control" ng-init="data.name = '{{ Auth::user()->name }}'" ng-model="data.name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Apellido *</label>
													<div class="col-md-8">
														<input type="text" class="form-control" ng-init="data.surname = '{{ Auth::user()->surname }}'" ng-model="data.surname">
													</div>
												</div>
											</fieldset>

											<div class="row">
												<div class="col-md-9 col-md-offset-3">
													<button type="button" class="btn btn-success btn-sm" ng-click="changePersonalInformation()" id="btnChangePersonalInformation">
														<i class="far fa-check-circle"></i> GUARDAR
													</button>
												</div>
											</div>
										</form>
									</div>
									<!-- change-password -->
									<div id="change-password" class="tab-pane">
										<form class="form-horizontal" method="get">
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-md-3 control-label">Contraseña actual*</label>
													<div class="col-md-8">
														<input type="password" class="form-control" ng-model="data.current_password">
														<hr>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Nueva contraseña *</label>
													<div class="col-md-8">
														<input type="password" class="form-control" ng-model="data.new_password">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-3 control-label">Confirmar Nueva Contraseña *</label>
													<div class="col-md-8">
														<input type="password" class="form-control" ng-model="data.new_password_confirmation">
													</div>
												</div>
											</fieldset>

											<div class="row">
												<div class="col-md-9 col-md-offset-3">
													<button type="button" class="btn btn-success btn-sm" ng-click="changePassword()" id="btnChangePassword">
														<i class="far fa-check-circle"></i> GUARDAR
													</button>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					@include('shared.alertMessageError')
				</div>
				<div class="panel-footer"></div>
			</div>
		</div>
		
		@include('shared.modalSuccess')
	</div>
@endsection

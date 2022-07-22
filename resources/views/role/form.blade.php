@extends('layouts.app')

@section('script')
	<script>
		var object = {
			url : '{{ url('role') }}',
			action : '{{ $action }}',
			modules : @json($modules),
		}
		@if (isset( $role ))
		    object.data =  @json($role);
		@endif
	</script>
	<script src="{{ asset('js/Controllers/RoleController.js') }}"></script>
@endsection
@section('title', 'ROLE!')

@section('content')

	@include('shared.loadingView')
	
	<div class="row view" ng-controller="RoleController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong ng-bind="textAction">create</strong> <strong>ROLE</strong>
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
						<div class="col-lg-6 col-md-8 col-sm-10">
							<div class="form-group">
			                    <label>Nombre *</label>
			                    <input type="text" class="form-control" ng-model="data.name">
				            </div>
							<div class="table-responsive">
								<table class="table table-bordered table-hover">
									<caption>Seleccionar permisos *</caption>
									<thead>
										<tr>
											<th>Modulo</th>
											<th style="text-align: center;">
												Leer <br> <br>
												<label class="switch switch-success" for="read">
													<input type="checkbox" id="read" ng-true-value="1" ng-false-value="0" ng-model="read" ng-change="allCol('read', read)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</th>
											<th style="text-align: center;">
												Crear <br> <br>
												<label class="switch switch-success" for="create">
													<input type="checkbox" id="create" ng-true-value="1" ng-false-value="0" ng-model="create" ng-change="allCol('create', create)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</th>
											<th style="text-align: center;">
												Editar <br> <br>
												<label class="switch switch-success" for="edit">
													<input type="checkbox" id="edit" ng-true-value="1" ng-false-value="0" ng-model="edit" ng-change="allCol('edit', edit)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</th>
											<th style="text-align: center;">
												Eliminar <br> <br>
												<label class="switch switch-success" for="destroy">
													<input type="checkbox" id="destroy" ng-true-value="1" ng-false-value="0" ng-model="destroy" ng-change="allCol('destroy', destroy)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</th>
											<th style="text-align: center;">
												Todas <br> <br>
												<label class="switch switch-success" for="all">
													<input type="checkbox" id="all" ng-true-value="1" ng-false-value="0" ng-model="all" ng-change="allPer(all)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</th>
										</tr>
									</thead>
									<tbody>
										<tr ng-repeat="(keyM, module) in data.permissions">
											<td>@{{ module.alias }}</td>
											<td class="actions">
												<label class="switch switch-success" for="permissions[@{{keyM}}].read">
													<input type="checkbox" id="permissions[@{{keyM}}].read" ng-true-value="1" ng-false-value="0" ng-model="data.permissions[keyM].read">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</td>
											<td class="actions">
												<label class="switch switch-success" for="permissions[@{{keyM}}].create">
													<input type="checkbox" id="permissions[@{{keyM}}].create" ng-true-value="1" ng-false-value="0" ng-model="data.permissions[keyM].create">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</td>
											<td class="actions">
												<label class="switch switch-success" for="permissions[@{{keyM}}].edit">
													<input type="checkbox" id="permissions[@{{keyM}}].edit" ng-true-value="1" ng-false-value="0" ng-model="data.permissions[keyM].edit">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</td>
											<td class="actions">
												<label class="switch switch-success" for="permissions[@{{keyM}}].destroy">
													<input type="checkbox" id="permissions[@{{keyM}}].destroy" ng-true-value="1" ng-false-value="0" ng-model="data.permissions[keyM].destroy">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</td>
											<td style="text-align: center;">
												<label class="switch switch-success" for="rowI_@{{keyM}}">
													<input type="checkbox" id="rowI_@{{keyM}}" ng-true-value="1" ng-false-value="0" ng-model="rowI_keyM" ng-change="allRow(keyM, rowI_keyM)">
													<span class="switch-label" data-on="SI" data-off="NO"></span>
												</label>
											</td>
										</tr>
									 </tbody>
								</table>
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

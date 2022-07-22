@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('department') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'DEPARTAMENTOS!')

@section('content')
	@php
	    $count = $departments->firstItem();
	@endphp
	@include('shared.loadingView')

	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Departamentos</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByFull', [
						'create' => route('department.create'),
						'index' => route('department.index'),
						'module' => 'departamento'
					])
					@endcomponent

					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"><i class="fas fa-cogs"></i></th>
									<th>#</th>
									<th>Nombre</th>
									<th>Clave</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($departments as $department)
								<tr>
									<td class="actions text-center">
	                                    @if ($department->id != 0)
										  	<a href="{{ route('department.edit', ['department' => $department->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
										  		<i class="fas fa-edit"></i>
										  	</a>
										  	<a href="#" class="text-danger" ng-click="delete('{{ $department->id }}', '{{ $department->name}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
										  		<i class="fas fa-trash-alt"></i>
										  	</a>
	                                    @else
	                                        <i class="far fa-times-circle"></i>
	                                    @endif
									</td>
									<td> {{ $count++ }} </td>
									<td> {{ $department->name }} </td>
									<td> {{ $department->keycode }} </td>
									<td> {{ date('d-m-Y', strtotime($department->created_at)) }} </td>
								</tr>
								@empty
								<tr>
									<td colspan="4" style="color: red;"> SIN REGISTROS </td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="text-left">
						{{ $departments->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection

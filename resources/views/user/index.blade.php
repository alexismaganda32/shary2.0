@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('user') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'USUARIOS!')

@section('content')
	@php
	    $count = $users->firstItem();
	@endphp
	@include('shared.loadingView')
	
	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Usuarios</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByName', [
						'create' => route('user.create'),
						'index' => route('user.index'),
						'module' => 'usuario'
					])
					@endcomponent
					
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"><i class="fas fa-cogs"></i></th>
									<th>#</th>
									<th>Nombre</th>
									<th>Correo</th>
									<th>Role</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($users as $user)
								<tr>
									<td class="actions text-center">
	                                    @if ($user->id != 1)
										  	<a href="{{ route('user.edit', ['user' => $user->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
										  		<i class="fas fa-edit"></i>
										  	</a>
										  	<a href="#" class="text-danger" ng-click="delete('{{ $user->id }}', '{{ $user->name}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
										  		<i class="fas fa-trash-alt"></i>
										  	</a>
	                                    @else
	                                        <i class="far fa-times-circle"></i>
	                                    @endif
									</td>
									<td> {{ $count++ }} </td>
									<td> {{ $user->name.' '.$user->surname }} </td>
									<td> {{ $user->email }} </td>
									<td> {{ $user->role }} </td>
									<td> {{ date('d-m-Y', strtotime($user->created_at)) }} </td>
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
						{{ $users->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection

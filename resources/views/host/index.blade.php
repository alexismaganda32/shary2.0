@extends('layouts.app')
 
@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('host') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'ANFITRIONES!')

@section('content')
	@php
	    $count = $hosts->firstItem();
	@endphp
	@include('shared.loadingView')
	
	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Anfitriones</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByName', [
						'create' => route('host.create'),
						'index' => route('host.index'),
						'module' => 'anfitrion'
					])
					@endcomponent
					
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"><i class="fas fa-cogs"></i></th>
									<th>#</th>
									<th>Nombre</th>
									<th>Numero de Colaborador</th>
									<th>Contacto de casa</th>
									<th>Numero celular</th>
									<th>Numero de emergencia</th>
									<th>email</th>
									<th>Razon social</th>
									<th>NSS</th>
									<th>Departamento</th>
									<th>Puesto</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($hosts as $host)
								<tr>
									<td class="actions text-center">
	                                    @if ($host->id != 0)
										  	<a href="{{ route('host.edit', ['host' => $host->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
										  		<i class="fas fa-edit"></i>
										  	</a>
										  	<a href="#" class="text-danger" ng-click="delete('{{ $host->id }}', '{{ $host->name}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
										  		<i class="fas fa-trash-alt"></i>
										  	</a>
	                                    @else
	                                        <i class="far fa-times-circle"></i>
	                                    @endif
									</td>
									
									<td> {{ $count++ }} </td>
									<td> {{ $host->name.' '.$host->surnameP.' '.$host->surnameM }} </td>
									<td> {{ $host->NC }} </td>
									<td> {{ $host->house }} </td>
									<td> {{ $host->mobile }} </td>
									<td> {{ $host->CE}} </td>
									<td> {{ $host->email }} </td>
									<td>{{ $host->social}}</td> 
									<td>{{ $host->NSS }}</td>
									<td>{{ $host->department }}</td>
									<td>{{ $host->puesto }}</td>
									<td> {{ date('d-m-Y', strtotime($host->created_at)) }} </td>
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
						{{ $hosts->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection
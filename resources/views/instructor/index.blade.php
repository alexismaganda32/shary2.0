@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('instructor') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'INSTRUCTOR!')

@section('content')
	@php
	    $count = $instructores->firstItem();
	@endphp
	@include('shared.loadingView')

	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Instructores</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByFull', [
						'create' => route('instructor.create'),
						'index' => route('instructor.index'),
						'module' => 'instructor'
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
									<th>Telefono</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($instructores as $instructor)
								<tr>
									<td class="actions text-center">
                                        <a href="{{ route('instructor.edit', ['instructor' => $instructor->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-danger" ng-click="delete('{{ $instructor->id }}', '{{ $instructor->nombre}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
									</td>
									<td> {{ $count++ }} </td>
									<td> {{ $instructor->name.' '.$instructor->surnameP.' '.$instructor->surnameM }} </td>
									<td> {{ $instructor->email }} </td>
									<td> {{ $instructor->telephone }} </td>
									<td> {{ date('d-m-Y', strtotime($instructor->created_at)) }} </td>
								</tr>
								@empty
								<tr>
									<td colspan="4" style="color: blue;"> SIN REGISTROS </td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="text-left">
						{{ $instructores->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection

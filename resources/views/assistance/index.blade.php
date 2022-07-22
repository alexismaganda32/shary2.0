@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('assistance') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'ASISTENCIA!')

@section('content')
	@php
	    $count = $assistances->firstItem();
	@endphp
	@include('shared.loadingView')

	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Asistencias</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByName', [
						'create' => route('assistance.create'),
						'index' => route('assistance.index'),
						'module' => 'asistencia'
					])
					@endcomponent

					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"><i class="fas fa-cogs"></i></th>
									<th>#</th>
									<th>Nombre del instructor</th>
									<th>Curso</th>
									<th>Fechadel curso</th>
									<th>Hora del curso</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($assistances as $assistance)
								<tr>
									<td class="actions text-center">
                                        <a href="{{ route('assistance.edit', ['assistance' => $assistance->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="#" class="text-danger" ng-click="delete('{{ $assistance->id }}', '{{ $assistance->name}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                        <a href="{{ route('assistance.detail', ['assistance_id' => $assistance->id ]) }}" class="text-success" data-toggle="tooltip" data-placement="bottom" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </a>
									</td>
									<td> {{ $count++ }} </td>
									<td> {{ $assistance->instructor}} </td>
									<td> {{ $assistance->curso }} </td>
									<td> {{$assistance->date}}</td>
									<td>{{$assistance->hour}}</td>
									<td>{{ date('d-m-Y', strtotime("now")) }}</td>
								</tr>
								@empty
								<tr>
									<td colspan="6" style="color: red;"> SIN REGISTROS </td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="text-left">
						{{ $assistances->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection

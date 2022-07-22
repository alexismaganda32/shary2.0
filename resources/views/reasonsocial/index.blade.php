@extends('layouts.app')

@section('script')
	<script type="text/javascript">
		var object = { url : "{{ url('social') }}" };
	</script>
	<script src="{{ asset('js/searchByName.js') }}"></script>
	<script src="{{ asset('js/Controllers/DeleteRecordController.js') }}"></script>
@endsection
@section('title', 'RAZON SOCIAL!')

@section('content')
	@php
	    $count = $reason_socials->firstItem();
	@endphp
	@include('shared.loadingView')

	<div class="row view" ng-controller="DeleteRecordController">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Razón Social</strong>
					</span>
				</div>
				<div class="panel-body">
					@component('components.searchByFull', [
						'create' => route('social.create'),
						'index' => route('social.index'),
						'module' => 'razon social'
					])
					@endcomponent

					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center"><i class="fas fa-cogs"></i></th>
									<th>#</th>
									<th>Nombre</th>
									<th>Nota</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($reason_socials as $social)
								<tr>
									<td class="actions text-center">
	                                    @if ($social->id != 0)
										  	<a href="{{ route('social.edit', ['social' => $social->id])}}" class="text-primary margin-right-6" data-toggle="tooltip" data-placement="bottom" title="Editar">
										  		<i class="fas fa-edit"></i>
										  	</a>
										  	<a href="#" class="text-danger" ng-click="delete('{{ $social->id }}', '{{ $social->name}}');" data-toggle="tooltip" data-placement="bottom" title="Eliminar">
										  		<i class="fas fa-trash-alt"></i>
										  	</a>
	                                    @else
	                                        <i class="far fa-times-circle"></i>
	                                    @endif
									</td>
									<td> {{ $count++ }} </td>
									<td> {{ $social->name }} </td>
									<td> {{ $social->note }} </td>
									<td> {{ date('d-m-Y', strtotime($social->created_at)) }} </td>
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
						{{ $reason_socials->appends(['name' => old('name')])->links() }}
					</div>
				</div>
			</div>
		</div>

		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>
@endsection

@extends('layouts.app')

@section('title', 'LOGS!')

@section('content')
	@php
	    $count = $logs->firstItem();
	@endphp
	@include('shared.loadingView')
	
	<div class="row view">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<span class="elipsis">
						<strong>Lista De Logs</strong>
					</span>
				</div>
				<div class="panel-body">					
					<div class="table-responsive">
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Modulo</th>
									<th>Descripción</th>
									<th>Usuario</th>
									<th><i class="far fa-calendar-alt"></i> Registrado</th>
								</tr>
							</thead>
							<tbody>
								@forelse ($logs as $log)
								<tr data-toggle="collapse" data-target="#collapseLog{{ $log->id }}" aria-expanded="false" aria-controls="collapseLog{{ $log->id }}" style="cursor: pointer;">
									<td> {{ $count++ }} </td>
									<td> {{ $log->log_name }} </td>
									<td> {{ $log->description }} </td>
									<td> {{ $log->name }} </td>
									<td> {{ date('d-m-Y H:m:s', strtotime($log->created_at)) }} </td>
								</tr>
								<tr class="collapse" id="collapseLog{{ $log->id }}">
									<td colspan="5">
										<div class="row">
											<div class="col-sm-12 margin-top-6">
												<div class="pricing-table">
													<div class="plan-title">Detalles</div>
												</div>
												<pre>@json(json_decode(trim($log->properties)), JSON_PRETTY_PRINT);</pre>
											</div>
										</div>
									</td>
								</tr>
								@empty
								<tr>
									<td colspan="5" style="color: red;"> SIN REGISTROS </td>
								</tr>
								@endforelse
							</tbody>
						</table>
					</div>
					<div class="text-left">
						{{ $logs->links() }}
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

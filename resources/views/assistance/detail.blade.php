@extends('layouts.app')

@section('title', 'Detalles de curso')

@section('content')
	@include('shared.loadingView')
	
		<div class="row view" ng-controller="DeleteRecordController">
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						<span class="elipsis">
							Detalles de instructor
						</span>
					</div>
					<div class="panel-body">
						<div class="col-lg-6 col-md-4 col-sm-6">
								<div class="form-group">
									<label> <strong>Nombre del Intructor:</strong> </label> <br>
									<td> <strong class="text-dark"> {{$host->ins_name}} {{$host->ins_surnameP}} {{$host->ins_surnameM}} </strong> </td>
								</div>
								<div class="form-group">
									<label><strong>Telefono:</strong></label><br>
									<td> <strong class="text-dark">{{$host->ins_telephone}}</strong> </td>
								</div>
								<div class="form-group">
									<label><strong>Nota:</strong></label>
									<td> <strong class="text-dark">{{$host->note}}</strong> </td>
						</div>
						</div>
						<div class="col-lg-3 col-md-4 col-sm-6">
							<div class="form-group">
								<label><strong>Curso:</strong></label> <br>
								<td> <strong class="text-dark">{{$host->cur_name}}</strong> </td>
							</div>
							<div class="form-group">
								<label><strong>Hora:</strong></label><br>
								<td> <strong class="text-dark">{{$host->hour}}</strong> </td>
							</div>
							<div class="form-group">
								<label><strong>Fecha:</strong></label><br>
								<td> <strong class="text-dark">{{$host->date}}</strong> </td> 
							</div>
						</div>
					</div>
				</div>
				<div>
					<div class="col-md-35">
						<div class="panel panel-default">
							<div class="panel-heading">
								<span class="elipsis">
									Información de los Anfitriones
								</span>
							</div>
							<div class="panel-body">
								<table class="table table-striped table-hover">
									<thead>
										<tr>
											<th>#</th>
											<th>Nombre</th>
											<th>Apellido Paterno</th>
											<th>Apellido Materno</th>
										</tr>
									</thead>
									<tbody>
										@foreach ($asis as $host)
										<tr>
											<td> {{$host->id }} </td>
											<td>{{$host->name}}</td>
											<td>{{$host->surnameP}}</td>
											<td>{{$host->surnameM}}</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
				
				<div class="panel footer">
					<a href="{{ url()->previous() }}">
						<button type="button" class="btn btn-info">
							<i class="fas fa-arrow-left"></i> Atras
						</button>
					</a>
				</div>
			</div>
			
		</div>
	
		@include('shared.modalDelete')
		@include('shared.modalSuccess')
	</div>

@endsection
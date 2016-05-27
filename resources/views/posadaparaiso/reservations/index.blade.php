@extends('layouts.app')
@section('content')


@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif


@section('content')
<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Reservaciones pagadas en linea</h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	  <!-- {!! link_to('admin/menus', 'Menús',array('class'=>'btn btn-info')) !!}-->
	</div>

</div>
<div class="row text-center">
	<!--$languages->render()-->
</div>
	<div class="row">
	    <table class="table table-responsive table-hover"> 
		  <thead class="center-text">
			<th class="ColumColor">ID</th>
			<th class="ColumColor">Nombre</th>	
			<th class="ColumColor">Llegada</th>	
			<th class="ColumColor">Salida</th>
			<th class="ColumColor">Habitaciones</th>
			<th class="ColumColor">Adultos</th>
			<th class="ColumColor">Menores</th>
			<th class="ColumColor">Promociones</th>
			<!--<th class="ColumColor">Status</th>-->
			<th class="ColumColor">Monto</th>
			@can('Reservaciones.Reservacionesverdetalles')
			<th class="ColumColor">Detalles</th>
			@endcan
		  </thead>
          
		  @foreach($reservations as $reservation)
			<tr>
				<td> {{$reservation->id}}</td>
				<td> {{$reservation->name}}</td>
				<td> {{$reservation->arrival}}</td>
				<td> {{$reservation->departure}}</td>
				<td> {{$reservation->room}}</td>											
			    <td> {{$reservation->grownups}}</td>
			    <td> {{$reservation->minors}}</td>
			    <td> {{$reservation->promotions}}</td> 
			    <td> $ {{$reservation->amount}}</td> 
			    @can('Reservaciones.Reservacionesverdetalles')
			    <td>{!! link_to('admin/reservations/'.$reservation->id.'/details', ' ',array('class'=>'img-responsive btn btn-primary glyphicon glyphicon-eye-open')) !!}</td>
			    @endcan
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$reservations->render()}}
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Detalles de la reservacion</h3>
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
			<th class="ColumColor">Tipo de habitación</th>	
			<th class="ColumColor">IVA</th>	
			<th class="ColumColor">Precio</th>
		  </thead>
          
		  @foreach($detailsReservation as $detailsR)
			<tr>
				<td> {{$detailsR->id}}</td>
				<td> {{$detailsR->type_room}}</td>
				<td> {{$detailsR->iva}}</td>
				<td> $ {{$detailsR->price}}</td>
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$detailsReservation->render()}}
	</div>
</div>
@stop
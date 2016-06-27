@extends('layouts.app')

@section('content')
<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Detalles de la reservacion</h3>
	</div> <!--divide la columna en 10 y 2-->

	<div class="col-md-4 text-right ">	
 	   {!! link_to('admin/reservation', 'Reservaciones',array('class'=>'btn btn-info')) !!}
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
			<th class="ColumColor">Subtotal</th>
		  </thead>
          <?php $total=0; ?>
		  @foreach($detailsReservation as $detailsR)
			<tr>
				<td> {{$detailsR->id}}</td>
				<td> {{$detailsR->type_room}}</td>
				<td> {{$detailsR->iva}}</td>
				<td> $ {{$detailsR->price}}</td>
				<td> $ {{$detailsR->price+$detailsR->iva}}</td>
			</tr>
		  <?php $total=$total+$detailsR->price+$detailsR->iva;?>
		  @endforeach

		  <tr>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> </td>
				<td> <b>Total: $ {{$total}} por noche</b></td>
			</tr>

		</table>
		
	</div>
	<div class="row text-center">
		{{$detailsReservation->render()}}
	</div>
</div>
@stop
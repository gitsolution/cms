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
	<h3>Precios para las reservaciones en linea </h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	  <!-- {!! link_to('admin/menus', 'Menús',array('class'=>'btn btn-info')) !!}-->
	</div>
	<div class="col-md-2">
    @can('Reservaciones.PreciosCrear')
 	{!!Form::open()!!}
       {!! link_to('admin/prices/create', 'Registrar precio',array('class'=>'btn btn-success')) !!}
    {!!Form::close()!!}
	@endcan
	</div>
</div>
<div class="row text-center">
	<!--$languages->render()-->
</div>
	<div class="row">
	    <table class="table table-responsive table-hover"> 
		  <thead class="center-text">
			<th class="ColumColor">ID</th>
			<th class="ColumColor">Titulo</th>	
			<th class="ColumColor">Typo</th>	
			<th class="ColumColor">Precio</th>
			<th class="ColumColor">IVA</th>
			<th class="ColumColor">Fecha de inicio</th>
			<th class="ColumColor">Fecha de finalización</th>
			@can('Reservaciones.PreciosActivar')
			  <th class="ColumColor">Activo</th>
			@endcan
			@can('Reservaciones.PreciosEliminar')
			  <th class="ColumColor">Acciones</th>
			@endcan
		  </thead>
		  @if($prices==null)
		      <span style="color:red">No hay precios activos para las reservaciones </span>
		  @endif
		  @foreach($prices as $price)
			<tr>
				<td> {{$price->id}}</td>
				<td> {{$price->title}}</td>
				<td> {{$price->type_room}}</td>
				<td> $ {{$price->price}}</td>
				<td> @if($price->iva != 0)$ {{ $price->iva}} 
					 @else {{'Sin IVA'}} 
					 @endif
				</td>											
			    <td> {{$price->date_start}}</td>
			    <td> {{$price->date_end}}</td>
			    @can('Reservaciones.PreciosActivar')
			    <td>
                    @if($price->active_price==1)
                        @if($price->date_start <= $fechaActaul && $price->date_end >= $fechaActaul)<!--Si cumple con las fechas para que el sistema lo tome en cuenta llegando esas fechas-->
 			                <span class=" glyphicon glyphicon-ok" style="color:blue"></span>
 			            @elseif($price->date_end < $fechaActaul)
 			                <span  class="glyphicon glyphicon-ban-circle" title="Periodo Terminado"></span> 
 			            @else
 			                <span  class="glyphicon glyphicon-ban-circle" style="color:blue" title="Esperando la fecha para Activarse" ></span> 
                        @endif
                    @else<!--Si no esta publicado-->
                        @if($price->date_end >= $fechaActaul)<!--Si la fecha de finalización no ha llegado(Todavia se puede activar)-->
                            {!! link_to('admin/prices/'.$price->id.'/publish', '',array('class'=>'text-danger glyphicon glyphicon-ban-circle')) !!}
                        @else
                            <span  class="glyphicon glyphicon-ban-circle" title="Periodo Terminado"></span> 
                        @endif
                    @endif

 			    </td>
 			    @endcan
			    @can('Reservaciones.PreciosEliminar')
			    <td>
					{!! link_to('admin/prices/'.$price->id.'/destroy', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				</td>
				@endcan 
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$prices->render()}}
		
	</div>
</div>
@stop
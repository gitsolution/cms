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
	<h3>Catálogo de Suscriptores</h3>
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
			<th class="ColumColor">Apellidos</th>
			<th class="ColumColor">Correo</th>
			<th class="ColumColor">Acciones</th>
			
		  </thead>
		  @foreach($suscriptions as $suscription)
			<tr>
				<td> {{$suscription->id}}</td>
				<td> {{$suscription->name}}</td>
				<td> {{$suscription->surnames}}</td>											
			    <td> {{$suscription->email}}</td>
			    
			    <td>
			    @can('Suscripciones.SuscriptoresEditar')
					{!! link_to('admin/suscription/'.$suscription->id.'/edit', ' ',array('class'=>'img-responsive btn btn-primary glyphicon glyphicon-pencil')) !!}
				@endcan
				@can('Suscripciones.SuscriptoresEliminar')
					{!! link_to('admin/suscription/'.$suscription->id.'/destroy', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				</td> 
				@endcan
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$suscriptions->render()}}
		
	</div>
</div>
@stop
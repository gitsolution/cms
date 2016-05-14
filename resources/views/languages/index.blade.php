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
	<h3>Catálogo de Idiomas</h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	  <!-- {!! link_to('admin/menus', 'Menús',array('class'=>'btn btn-info')) !!}-->
	</div>
	@can('Lenguajes.Crearlenguaje')
	<div class="col-md-2">
 	{!!Form::open()!!}
       {!! link_to('admin/languages/create', 'Registrar lenguaje',array('class'=>'btn btn-success')) !!}
    {!!Form::close()!!}
	</div>
	@endcan
</div>
<div class="row text-center">
	<!--$languages->render()-->
</div>
	<div class="row">
	    <table class="table table-responsive table-hover"> 
		  <thead class="center-text">
			<th class="ColumColor">ID</th>	
			<th class="ColumColor">Label</th>
			<th class="ColumColor">Descripción</th>
			<th class="ColumColor">Code</th>
			<th class="ColumColor">Short code</th>
			<!--<th class="ColumColor">Status</th>-->
			<th class="ColumColor">Acciones</th>
		  </thead>
		  @foreach($languages as $language)
			<tr>
				<td> {{$language->id}}</td>
				<td> {{$language->label}}</td>											
			    <td> {{$language->description}}</td>
			    <td> {{$language->code}}</td>
			    <td> {{$language->short_code}}</td>
			    
			    <td>
			    	@can('Lenguajes.Editarlenguaje')
					{!! link_to('admin/languages/'.$language->id.'/edit', ' ',array('class'=>'img-responsive btn btn-primary glyphicon glyphicon-pencil')) !!}
					@endcan
					@can('Lenguajes.Eliminarlenguaje')
					{!! link_to('admin/languages/'.$language->id.'/destroy', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
					@endcan
				</td> 
			</tr>
		  @endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$languages->render()}}
		
	</div>
</div>
@stop
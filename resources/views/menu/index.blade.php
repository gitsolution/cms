@extends('layouts.app')
@section('content')
<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8"><h3>Catálogo de Menús</h3></div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2">
 	 
 	</div>

 	@can('menu.Crear')
	<div class="col-md-2">
 	{!!Form::open()!!}
   
    {!! link_to('admin/menunew', 'Nuevo Menú',array('class'=>'btn btn-success')) !!}
   
    {!!Form::close()!!}
	</div>
	@endcan
</div>
<div class="row text-center">
	{{$menus->render()}}
</div>
	<div class="row">
		<table class="table table-responsive table-hover"> 
		<thead class="center-text">
			<th class="ColumColor">
			ID
			</th >	
			<th class="ColumColor">
		    Menu
			</th>
			@can('menu.elementos')
				<th class="ColumColor">
				Elementos
				</th>			 
			@endcan
			@can('menu.ordenar')
				<th class="center-text ColumColor" colspan="2">
				Ordén
				</th>
			@endcan
			<th class="ColumColor" colspan="2" >
			Acciones
			</th>
		</thead>
		@foreach($menus as $men)
				<?php 
				$down=$men->order_by-1;
				$up=$men->order_by+1;		
				if($down==0) {
					$down=$men->order_by;
				}
				
				?> 
				<tr>
				<td> {{$men->id}}</td>
				<td> {{$men->title}}</td>
			@can('menu.elementos')
				<td>
				{!!link_to('admin/itemmenu/'.$men->id.'/0', '',array('class'=>'glyphicon glyphicon-menu-hamburger')) !!}
				</td> 
			@endcan
			@can('menu.ordenar')
				<td> {!! link_to('admin/menuorder/'.$men->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down')) !!}</td>			
				<td> {!! link_to('admin/menuorder/'.$men->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>
			@endcan
				<td>
				@can('menu.editar')
					{!! link_to('admin/menuedit/'.$men->id, ' ',array('class'=>'img-responsive btn btn-primary glyphicon glyphicon-pencil')) !!}
				@endcan
				@can('menu.eliminar')
					{!! link_to('admin/menudel/'.$men->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				@endcan
				</td> 
			   
		    </td>
			</tr>
		@endforeach

		</table>
	</div>
	<div class="row text-center">
		{{$menus->render()}}
	</div>
</div>
@stop
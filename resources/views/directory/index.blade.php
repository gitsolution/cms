@extends('layouts.app')
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
	<div class="col-md-8"><h3>Catálogo de Galerías</h3></div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2">
 	 
 	</div>
 @can('directorio.Nuevo')
	<div class="col-md-2">
 	{!!Form::open()!!}
   
    {!! link_to('admin/directorynew', 'Nuevo Directorio',array('class'=>'btn btn-success')) !!}
   
    {!!Form::close()!!}
	</div>
@endcan
</div>
<div class="row text-center">
	{{$directories->render()}}
</div>
	<div class="table-responsive">
		<table class="table table-hover"> 
		<thead class="center-text">
			<th class="ColumColor">
			ID
			</th>	
			<th class="ColumColor">
			Directorio
			</th>
			<th class="ColumColor">
			Fecha Publicación
			</th>
			@can('directorio-archivo')
				<th class="ColumColor">
				Archivos
				</th>
			@endcan
			<th class="ColumColor">
			Visualizaciones
			</th>
			@can('directorio-orden')
				<th colspan="2" class="center-text ColumColor">
				Ordén
				</th>	
			@endcan

			@can('directorio-publicado')
				<th class="ColumColor text-center">
				Publicado
				</th>
			@endcan

			@can('directorio-inicio')
				<th class="ColumColor text-center">
				Inicio
				</th>	
			@endcan
			<th colspan="2" class="ColumColor text-center">
			Acciones
			</th>
		</thead>
		@foreach($directories as $dir)
				<?php 
				$publish_date = substr($dir->publish_date,0,10);
				$down=$dir->order_by-1;
				$up=$dir->order_by+1;		
				if($down==0)$down=$dir->order_by;
				?> 
				<tr>
				<td> {{$dir->id}}</td>
				<td> {{$dir->title}}</td>
				<td> {{ $publish_date }}</td>

				@can('directorio-archivo')		
					<td>
					&nbsp;&nbsp;&nbsp;&nbsp;{!!link_to('admin/itemFiles/'.$dir->id, '',array('class'=>'fa fa-upload fa-lg')) !!}
					</td> 
				@endcan        				
				
				<td> {{ $dir->hits }}</td>	

				@can('directorio-orden')
				<td> {!! link_to('admin/directoryorder/'.$dir->id.'/Down/'.$down.'/', '',array('class'=>'glyphicon glyphicon-chevron-down')) !!}</td>

				<td> {!! link_to('admin/directoryorder/'.$dir->id.'/Up/'.$up.'/', '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>
				@endcan

				@can('directorio-publicado')
				<td class="text-center">
				<?php if($dir->publish=='1'){?>
				{!!  link_to('admin/directorypub/'.$dir->id.'/False/', '',array('class'=>'glyphicon glyphicon-ok')) !!}
				<?php } else{ ?>
				{!! link_to('admin/directorypub/'.$dir->id.'/True/', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}

				<?php } ?>
				</td>
				@endcan()

				@can('directorio-inicio')
				<td class="text-center"> 
				<?php if($dir->index_page=='1'){?>
					{!! link_to('admin/directoryind/'.$dir->id.'/False/', '',array('class'=>'fa fa-check-square-o fa-lg')) !!}
				<?php } else{ ?>
					{!! link_to('admin/directoryind/'.$dir->id.'/True/', '',array('class'=>'fa fa-square-o fa-lg')) !!}
				<?php } ?>
				</td>
				@endcan
				<td class="text-center">
				@can('directorio-editar')
					{!! link_to('admin/directoryedit/'.$dir->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
				@endcan

				@can('directorio-eliminar')
					{!! link_to('admin/directorydel/'.$dir->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
				@endcan
				</td>    
		    
			</tr>
		@endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$directories->render()}}
		
	</div>
</div>

@stop
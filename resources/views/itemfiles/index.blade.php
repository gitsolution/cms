@extends('layouts.app')
@section('content')
 <?php $id_directory= $directories->id; ?>
<div class="container-fluid">
<div class="row">
	<br>

	<br>
	<div class="col-md-8">
	<h3>Catálogo de Archivos de {{ $directories->title }}</h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	 {!! link_to('admin/directory', 'Directorios',array('class'=>'btn btn-info')) !!}
	</div>
	<div class="col-md-2">
 	{!!Form::open()!!}
   
    {!! link_to('admin/itemFilesnew/'.$id_directory, 'Subir Archivo',array('class'=>'btn btn-success')) !!}
   
    {!!Form::close()!!}
	</div>
</div>
<div class=" text-center">
	{{$itemFiles->render()}}
</div>

<div class="row">
<div class="table-responsive">
	<table class="table table-hover"> 
		<thead class="center-text">
			<th class="ColumColor">
			ID
			</th>	
			<th class="ColumColor">
			Archivo
			</th>
			<th class="ColumColor">
			Descargas	
			</th>
			<th class="ColumColor">
			Fecha Publicación
			</th>
			<th class="ColumColor">
			Visualizaciones
			</th>
			<th colspan="2" class="ColumColor">
			Ordén
			</th>
			<th class="ColumColor text-center">
			Publicado
			</th>
			<th class="ColumColor">
			Acciones
			</th>
		</thead>
		@foreach($itemFiles as $item)
				<?php 
				$path='../../..'.$item->path;
				$publish_date = substr($item->publish_date,0,10);
				$down=$item->order_by-1;
				$up=$item->order_by+1;		
				if($down==0)$down=$item->order_by;
				?> 
			<tr>
				<td> {{$item->id}}</td>
				<td> {{$item->title}}</td>
				<td>
				
				{!! link_to($path, '', array('class'=>'glyphicon glyphicon-download-alt','target'=>'_blank')) !!}

				</td>		
				<td> {{ $publish_date }}</td>		
				<td> {{ $item->hits }}</td>	
				<td class="text-center"> {!! link_to('admin/itemFilesorder/'.$item->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down')) !!}</td>
				<td> {!! link_to('admin/itemFilesorder/'.$item->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>
				<td class="text-center">
				<?php if($item->publish=='1'){?>
				{!!  link_to('admin/itemFilespub/'.$item->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
				<?php } else{ ?>
				{!! link_to('admin/itemFilespub/'.$item->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
				<?php } ?>
				</td>
				<td>{!! link_to('admin/itemFilesedit/'.$item->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
				{!! link_to('admin/itemFilesdel/'.$item->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}</td>    
		    
			</tr>
		@endforeach
		</table>
</div>	
</div>
	<div class=" text-center">
		{{$itemFiles->render()}}
		
	</div>

</div>
@stop
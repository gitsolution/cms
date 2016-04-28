@extends('layouts.app')
@section('content')
 <?php $id_media= $media->id; ?>
<div class="container-fluid">
<div class="row">
	<br>

	<br>
	<div class="col-md-8">
	<h3>Catálogo de Imágenes de {{ $media->title }}</h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	 {!! link_to('admin/media', 'Albúms',array('class'=>'btn btn-info')) !!}
	</div>
	<div class="col-md-2">
 	{!!Form::open()!!}
   
    {!! link_to('admin/itemnew/'.$id_media, 'Subir Imagen',array('class'=>'btn btn-success')) !!}
   
    {!!Form::close()!!}
	</div>
</div>
<div class=" text-center">
	{{$items->render()}}
</div>

<div class="row">
<div class="table-responsive">
	<table class="table table-hover"> 
		<thead class="center-text">
			<th class="ColumColor">
			ID
			</th>	
			<th class="ColumColor">
			Albúm
			</th>
			<th class="ColumColor">
				Imagen
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
		@foreach($items as $item)
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
				<div style="width:50px;heigth:50px;">				
				<a href="{{ $path }}">	
					<img src='{{ $path }}' class="img-responsive"  />  
				</a>
				</div>
				</td>		
				<td> {{ $publish_date }}</td>		
				<td> {{ $item->hits }}</td>	
				<td class="text-center"> {!! link_to('admin/itemorder/'.$item->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down')) !!}</td>
				<td> {!! link_to('admin/itemorder/'.$item->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>
				<td class="text-center">
				<?php if($item->publish=='1'){?>
				{!!  link_to('admin/itempub/'.$item->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
				<?php } else{ ?>
				{!! link_to('admin/itempub/'.$item->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
				<?php } ?>
				</td>
				<td>{!! link_to('admin/itemedit/'.$item->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
				{!! link_to('admin/itemdel/'.$item->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}</td>    
		    
			</tr>
		@endforeach
		</table>
</div>	
</div>
	<div class=" text-center">
		{{$items->render()}}
		
	</div>

</div>
@stop
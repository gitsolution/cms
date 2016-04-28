@extends('layouts.app')
@section('content')
 <?php $id_menu = $menu->id; 
 


  ?>
 <div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Catálogo de Elementos de {{ $menu->title }}</h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	 {!! link_to('admin/menus', 'Menús',array('class'=>'btn btn-info')) !!}
	</div>
	<div class="col-md-2">
 	{!!Form::open()!!}
   
    {!! link_to('admin/optionmenu/'.$id_menu.'/'.$id_parent, 'Registrar Menú',array('class'=>'btn btn-success')) !!}
   
    {!!Form::close()!!}
	</div>
</div>
<div class="row text-center">
	{{$itemMenus->render()}}
</div>
	<div class="row">
		<table class="table table-responsive table-hover"> 
		<thead class="center-text">
			<th>
			ID
			</th>	
			<th>
			Submenús
			</th>
			<th>
			Elemento
			</th>
			<th>
			Sub Menús
			</th>
			<th colspan="2">
			Orden
			</th>
			<th>
			Publicado
			</th>
			<th>
			Acciones
			</th>
		</thead>
		@foreach($itemMenus as $imenu)
				<?php 
				$down=$imenu->order_by-1;
				$up=$imenu->order_by+1;		
				if($down==0)$down=$imenu->order_by;
				?> 
			<tr>
				<td> {{$imenu->id}}</td>
				<td> {{$imenu->title}}</td>
				<td> 												
				{!! link_to('admin/itemmenu/'.$imenu->id_menu.'/'.$imenu->id, '',array('class'=>'glyphicon glyphicon-menu-hamburger')) !!} 
				</td>
				<td> 												
				{!! link_to('admin/optionmenu/'.$imenu->id_menu.'/'.$imenu->id, '',array('class'=>'glyphicon glyphicon-upload')) !!} 
				</td>
				<td> {!! link_to('admin/itemmenuorder/'.$imenu->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down')) !!}</td>
				<td> {!! link_to('admin/itemmenuorder/'.$imenu->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>
				<td>
				<?php if($imenu->publish=='1'){?>
				{!!  link_to('admin/itemmenupub/'.$imenu->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
				<?php } else{ ?>
				{!! link_to('admin/itemmenupub/'.$imenu->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
				<?php } ?>
				</td>         
				<td>{!! link_to('admin/itemmenudel/'.$imenu->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}</td>    
		    </td>
			</tr>
		@endforeach
		</table>
	</div>
	<div class="row text-center">
		{{$itemMenus->render()}}
		
	</div>
</div>
@stop
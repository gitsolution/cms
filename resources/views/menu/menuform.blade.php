@extends('layouts.app')
@section('content')
 <div class="container-fluid">
<?php  
if(isset($menu)) {
	$message='Edit';
	$title=$menu->title;
	$description=$menu->description;
	if($menu->publish=="0")
	{
		$publish = "";//;		
	}
	else{
		$publish = "checked";//;		
	}	
	$order_by= $menu->order_by;
}else{ $message='New'; 
	$menu=Null;
	$title=$menu;
	$description=$menu;
	$publish = $menu;
	$order_by= $menu;
}
 ?>

@if($message=='Edit')
 {!!Form::model($menu,['route'=>['admin.menus.update',$menu->id],'method'=>'PUT'])!!} 
@else
 {!!Form::open(['route'=>'admin.menus.store','method','POST'])!!} 
@endif
<br>
 <div class="row">
 <div class="form-group" >
 	  {!!Form::label('Posición:')!!}
      {!!Form::select('id_men_type', \App\TypeMenu::lists('title','id'),null,['class'=>'form-control select2'] )!!}
               
 </div>

 <div class="form-group" >

 	  {!!Form::label('Nombre:')!!}
 	  {!!Form::text('title',$title,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Albúm'])!!}
 </div>
 <div class="form-group" >
 	  {!!Form::label('Descripción:')!!}
 	  {!!Form::textarea('description',$description,['class'=>'form-control', 'placeholder'=>'Ingresa la Descripción del Albúm'])!!}
</div>


 <div class="form-group" >
 	  {!!Form::label('Idioma:')!!}
      {!!Form::select('id_language', \App\cms_language::lists('label','id'),null,['class'=>'form-control select2'] )!!}
               
 </div>


<div class="form-group" >	 

	<div class="col-md-3">
				        Publicar:
                        <div class="material-switch pull-right">
                            <input id="someSwitchOption1" name="publish" type="checkbox"  <?php echo $publish ?> />
                            <label for="someSwitchOption1" class="label-primary" ></label>
                        </div>
	</div>                        
 
</div><br><br>
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	 {!! link_to('admin/menus', 'Cancelar',array('class'=>'btn btn-danger')) !!}
{!!Form::close()!!}
</div>

 
 </div>
@stop
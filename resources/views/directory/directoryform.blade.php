@extends('layouts.app')

@section('content')
<?php  
if(isset($directories)) {
	$message='Edit';
	$title=$directories->title;
	$description=$directories->description;
	$publish_date = date_create($directories->publish_date);
	if($directories->publish=="0")
	{
		$publish = "";//;		
	}
	else{
		$publish = "checked";//;		
	}
	if($directories->index_page=="0")
	{
		$index_page = "";//;		
	}
	else{
		$index_page = "checked";//;		
	}

	$order_by= $directories->order_by;




}else{ $message='New'; 
	$directories=Null;
	$title=$directories;
	$description=$directories;
	$publish = $directories;
	$publish_date = date('Y-m-d');
	$order_by= $directories;
	$index_page=$directories;
}
 ?>

@if($message=='Edit')
 {!!Form::model($directories,['route'=>['admin.directory.update',$directories->id],'method'=>'PUT'])!!} 
@else
 {!!Form::open(['route'=>'admin.directory.store','method','POST'])!!} 
@endif
 <div class="container-fluid">
 <br>
 <div class="row">
 <div class="form-group" >

 	  {!!Form::label('Nombre:')!!}
 	  {!!Form::text('title',$title,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Directorio'])!!}
 </div>



        <div class="form-group">
          {!!Form::label('Descripción:')!!}
          {!!Form::textarea('content',$description,['class'=>'form-control'])!!}
          <script  type = "text/javascript" > 
            CKEDITOR . replace (  'content'  ); 
            CKEDITOR . add            
          </script>
      </div>


<div class="form-group" >
<div class="row">
	<div class="col-md-3">
	 	  {!!Form::label('Fecha Publicación:')!!}
	 	  {!!Form::date('publish_date',$publish_date,['class'=>'form-control', 'placeholder'=>'Ingresa la Fecha de Publicación del Albúm'])!!}
	</div>
 <br>
	<div class="col-md-5">
	 <div class="publiChecme">
				        Publicar:
                        <div class="material-switch pull-right">
                            <input id="someSwitchOption1" name="publish" type="checkbox"  <?php echo $publish ?> />
                            <label for="someSwitchOption1" class="label-primary" ></label>
                        </div>
	</div>      </div>
    
    <div class="col-md-4">
    <div class="privaChecme">
                        Página de Inicio:
                        <div class="material-switch pull-right">
                            <input id="someSwitchOption2" name="index_page" type="checkbox" <?php echo $index_page ?>   />
                            <label for="someSwitchOption2" class="label-primary"></label>
                        </div>
	</div>
	</div>
</div>
</div>
<div clas="row">
<div class="form-group" >
	<div class="col-md-1">
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	</div>
	<div class="col-md-3">
	 {!! link_to('admin/directory', 'Cancelar',array('class'=>'btn btn-danger')) !!}
	</div>
</div>
</div>
 {!!Form::close()!!}
 </div>
</div>
@stop
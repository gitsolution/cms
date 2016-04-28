@extends('layouts.app')
@section('content')
 
<?php  

if(isset($item)) {
	$message='Edit';
  $id_media=$item->id;
  
  
	$title=$item->title;
	$description=$item->description;
	$publish_date = date_create($item->publish_date);
	if($item->publish=="0")
	{
		$publish = "";//;		
	}
	else{
		$publish = "checked";//;		
	}	
	$order_by= $item->order_by;
    $path=$item->path;
    $id= $item->id;

}else{ 
	$message='New'; 
	$item=Null;

	$title=$item;
	$description=$item;
	$publish = $item;
	$publish_date= date('Y-m-d');
	$order_by= $item;
	$path=$item;
	$id= $item;

}
 $id_album=$media->id;
 $album=$media->title;
 

 ?>




@if($message=='Edit')
 {!!Form::model($item,['route'=>['admin.item.update',$item->id],'method'=>'PUT','novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.item.store','method','POST','novalidate' => 'novalidate','files' => true])!!} 
@endif
<div class="container-fluid">
 <div class="row">
 <div class="form-group" >
  
 

  
       <div class="row">

       <div class="form-group" > 
        <div class="col-md-8">
    <br>
     {!!Form::label('Album:'.$album)!!} 
    <input type="hidden" name="id_album" value="{{ $id_album }}">
        
                <br>
 </div>
   
        <div class="col-md-12">
               <input type='file' name='file' id="imgLoad"  />
        </div>
      </div>
    </div>
       <div class="row">

       <div class="form-group" >    
        
          <div class="col-md-12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
              <div class="panel panel-primary" style="width:300px;">
                              <div class="panel-heading">                                  
                                  Imagen 
                              </div>
                              <div class="panel-body">
                                  <img id="imgUpTo" src="<?php echo $path ?>" alt="Imagen" class="img-responsive" />
                              </div>
                              <div class="panel-footer text-right">
                                @if($message=='Edit')
                                  {!!link_to('admin/delpic/'.$id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-remove ')) !!}
                                @endif
                              </div>
                      </div>      
            </center>
        </div>                     
      
      </div>
        
      <br>
      </div>

 



 <div class="form-group" >

 	  {!!Form::label('Nombre:')!!}
 	  {!!Form::text('title',$title,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre de la imagen'])!!}
 </div>
 <div class="form-group" >
 	  {!!Form::label('Descripción:')!!}
 	  {!!Form::textarea('description',$description,['class'=>'form-control', 'placeholder'=>'Ingresa la Descripción de la Imagen'])!!}
</div>
	 <div class="form-group">
   <div class="row">
	  <div class="col-md-3">
	 	  {!!Form::label('Fecha Publicación:')!!}
	 	  {!!Form::date('publish_date',$publish_date,['class'=>'form-control', 'placeholder'=>'Ingresa la Fecha de Publicación del Albúm'])!!}
      </div>
        <div class="col-md-5">
        <div class="publiChec">
                Publicar:
                        <div class="material-switch pull-right">
                            <input id="someSwitchOption1" name="publish" type="checkbox"  <?php echo $publish ?> />
                            <label for="someSwitchOption1" class="label-primary" ></label>
                        </div>
  </div> 
  </div>
      </div>
	</div>
          <div class="row">
 <div class="col-md-1">
   {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
  </div>
  <div class="col-md-3">

  {!! link_to('admin/media', 'Cancelar',array('class'=>'btn btn-danger')) !!}
  </div>
</div>        

 {!!Form::close()!!}
 </div>
</div>
@stop

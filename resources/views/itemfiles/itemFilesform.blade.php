@extends('layouts.app')
@section('content')
 
<?php  

if(isset($itemFiles)) {
	$message='Edit';
  $id_directory=$itemFiles->id_directory;
  
  
	$title=$itemFiles->title;
	$description=$itemFiles->description;
	$publish_date = date_create($itemFiles->publish_date);
	if($itemFiles->publish=="0")
	{
		$publish = "";//;		
	}
	else{
		$publish = "checked";//;		
	}	
	$order_by= $itemFiles->order_by;
    $path=$itemFiles->path;
    $id= $itemFiles->id;

}else{ 
	$message='New'; 
	$itemFiles=Null;

	$title=$itemFiles;
	$description=$itemFiles;
	$publish = $itemFiles;
	$publish_date= date('Y-m-d');
	$order_by= $itemFiles;
	$path=$itemFiles;
	$id= $itemFiles;

}
 $id_directory=$directories->id;
 $directories=$directories->title;
 ?>

@if($message=='Edit')
 {!!Form::model($itemFiles,['route'=>['admin.itemFiles.update',$itemFiles->id],'method'=>'PUT','novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.itemFiles.store','method','POST','novalidate' => 'novalidate','files' => true])!!} 
@endif
<div class="container-fluid">
 <div class="row">
 <div class="form-group" >
       <div class="row">
       <div class="form-group" > 
        <div class="col-md-8">
    <br>
     {!!Form::label('Directorio:'.$directories)!!} 
    <input type="hidden" name="id_directory" value="{{ $id_directory }}">
        
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
        </div>                     
      
      
      </div>
       <div class="form-group" >            
        <div class="col-md-12">
        @if($path!=null)
        <h4>Archivo: {{ $title }} &nbsp;&nbsp;&nbsp;&nbsp; {!! link_to($path, '', array('class'=>'glyphicon glyphicon-download-alt','target'=>'_blank')) !!} &nbsp;&nbsp;&nbsp;&nbsp;   
            {!!link_to('admin/delItemFiles/'.$id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-remove ')) !!}
</h4>                                     
        @endif

        </div>                           
      </div>


        
      <br>
      </div>
 <div class="form-group" >

 	  {!!Form::label('Nombre:')!!}
 	  {!!Form::text('title',$title,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del Archivo'])!!}
 </div>
 <div class="form-group" >
 	  {!!Form::label('Descripción:')!!}
 	  {!!Form::textarea('description',$description,['class'=>'form-control', 'placeholder'=>'Ingresa la Descripción del Archivo'])!!}
</div>
	 <div class="form-group">
   <div class="row">
	  <div class="col-md-3">
	 	  {!!Form::label('Fecha Publicación:')!!}
	 	  {!!Form::date('publish_date',$publish_date,['class'=>'form-control', 'placeholder'=>'Ingresa la Fecha de Publicación del Archivo'])!!}
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
   {!! link_to('', 'Cancelar',array('class'=>'btn btn-danger')) !!}
  </div>
</div>        

 {!!Form::close()!!}
 </div>
</div>
@stop

@extends('layouts.app')
@section('content')
 <div class="container-fluid">
<?php  
if(isset($language)) {
	$message='Edit';
	}
else{ $message='New'; 
    }
 ?>

@if($message=='Edit')
 {!!Form::model($language,['route'=>['admin.languages.update',$language->id],'method'=>'PUT'])!!} 
@else
 {!!Form::open(['route'=>'admin.languages.store','method','POST'])!!} 
@endif
<br>
 <div class="row">
 <div class="form-group" >
 	  {!!Form::label('Label:')!!}
	  {!!Form::text('label',NULL,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del lenguaje'])!!}             
 </div>

 <div class="form-group" >
 	  {!!Form::label('Code:')!!}
 	  {!!Form::text('code',NULL,['class'=>'form-control', 'placeholder'=>'Ingresa una contracción para el lenguaje'])!!}
 </div>

 <div class="form-group" >

 	  {!!Form::label('ShortCode:')!!}
 	  {!!Form::text('short_code',NULL,['class'=>'form-control', 'placeholder'=>'Ingresa una contracción corta para el lenguaje'])!!}
 </div>
 <div class="form-group" >
 	  {!!Form::label('Descripción:')!!}
 	  {!!Form::textarea('description',NULL,['class'=>'form-control', 'placeholder'=>'Ingresa la Descripción del lenguaje'])!!}
</div>


<br><br>
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	 {!! link_to('admin/languages', 'Cancelar',array('class'=>'btn btn-danger')) !!}
{!!Form::close()!!}
</div>

 
 </div>
@stop
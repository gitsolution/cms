@extends('layouts.app')
@section('content')
 <div class="container-fluid">
<?php  
if(isset($suscription)) {
	$message='Edit';
	}
else{ $message='New'; 
}
 ?>

@if($message=='Edit')
 {!!Form::model($suscription,['route'=>['admin.suscription.update',$suscription->id],'method'=>'PUT'])!!} 
@else
 {!!Form::open(['route'=>'admin.suscription.store','method','POST'])!!} 
@endif
<br>
 <div class="row">
 <div class="form-group" >
 	 {{Form::label('Nombre')  }}
     {{Form::text('name',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}  
 </div>

 <div class="form-group" >
 	  {{Form::label('Apellidos')  }}
        {{Form::text('surnames',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
 </div>

 <div class="form-group" >

 	  {{Form::label('Email')  }}
      {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
 </div>

<br><br>
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	 {!! link_to('admin/suscription', 'Cancelar',array('class'=>'btn btn-danger')) !!}
{!!Form::close()!!}
</div>

 
 </div>
@stop
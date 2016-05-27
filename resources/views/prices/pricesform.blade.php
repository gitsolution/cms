@extends('layouts.app')
@section('content')
<div class="container-fluid">
<?php  
if(isset($prices)) {
	$message='Edit';
	if($prices->publish=="0")
      {
        $ChekPublicar = "";  
      }
   else{
        $ChekPublicar = "checked"; 
      } 
	}  
else{
    $message='New'; 

    $ChekPublicar = "";  
  
	}    
 ?>

@if($message=='Edit')
 {!!Form::model($price,['route'=>['admin.prices.update',$price->id],'method'=>'PUT'])!!} 
@else
 {!!Form::open(['route'=>'admin.prices.store','method','POST'])!!} 
@endif
<br>

 <div class="row">
 
 <div class="row"> 
 <div class="col-md-12">
 <div class="form-group" >
 	  {!!Form::label('Titulo:')!!}<span style="color:red">*</span>
	  {!!Form::text('title',NULL,['class'=>'form-control', 'placeholder'=>'','step'=>'any','required'])!!}             
 </div>
 </div>
 </div>

 <div class="row"> 
 <div class="col-md-12">
 <div class="form-group" >
    {!!Form::label('Tipo:')!!}<span style="color:red">*</span>
    {!!Form::text('type_room',NULL,['class'=>'form-control', 'placeholder'=>'Ingrese el tipo de habitación','required'])!!}             
 </div>
 </div>
 </div>

 <div class="row"> 
    <div class="col-md-6">
       <div class="form-group" >
 	     {!!Form::label('Precio:')!!}<span style="color:red">*</span>
	     {!!Form::number('price',NULL,['class'=>'form-control', 'placeholder'=>'Ingrese el costo de la reservación','step'=>'any','min'=>'1','required'])!!}             
       </div>
    </div>
    <div class="col-md-6">
       <div class="form-group" >
       {!!Form::label('IVA:')!!}
       {!!Form::number('iva',NULL,['class'=>'form-control', 'placeholder'=>'Ingrese la cantidad en pesos','step'=>'any','min'=>'1'])!!}             
       </div>
    </div>
</div>



 
 <div class= "row"> 
 <div class="col-md-6">
 <div class="form-group" >
 	  {!!Form::label('Fecha de inicio:')!!}<span style="color:red">*</span>
 	  <input name="date_start" class="form-control" type="date" min="{{$fechaActaul}}" required>
 </div>
 </div>
 <div class="col-md-6">
 <div class="form-group" >
 	  {!!Form::label('Fecha de finalización:')!!}<span style="color:red">*</span>
 	  <input name="date_end" class="form-control" type="date" min="{{$fechaActaul}}" required>
 </div>
 </div>
 </div>

 <div class="row">
 <div class="col-md-7">
 <div class="form-group" >
 	   <div class="publiChec">
               {!!Form::label('privado','Publicar')!!}
                <div class="material-switch">
                    <input id="someSwitchOptionInfo" name="ChekPublicar" <?php echo $ChekPublicar ?> type="checkbox"/>
                    <label for="someSwitchOptionInfo" class="label-info"></label>
                </div>     
        </div>
</div>
</div>
</div>
 

<div clas="col-md-12">
<div class="form-group" >
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	 {!! link_to('admin/prices', 'Cancelar',array('class'=>'btn btn-danger')) !!}
</div>
</div>

{!!Form::close()!!}

</div>

 
 </div>
@stop
@extends('layouts.app')
@section('content')
 <div class="container-fluid">
  {!!Form::open(['route'=>'admin.itemmenuadd.store','method','POST'])!!} 
 <div class="row">
 <div class="form-group" >
  <div class="col-md-3">
        	  {!!Form::label('Menú: '.$menu->title)!!}         	 
 </div>
</div>
</div>
<div class="row">
 <div class="form-group" >
 	  {!!Form::label('Nombre del Elemento:')!!}
 	  {!!Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del elemento del Menú'])!!}
 </div>
</div>
<div class="row">
 <div class="form-group" >
   <input type="hidden" name="id_menu" value="{{ $id_menu }}">
   <input type="hidden" name="id_parent" value="{{ $id_parent }}">        
   <input type="hidden" name="level" value="{{ $level }}">      
      <input type="hidden" name="option" value="{{ $option }}">    
  
 {!!Form::text('uri',null,['class'=>'form-control', 'placeholder'=>'Ingresa la URL del elemento del Menú'])!!} 
 </div>
</div>

<div class="row">
  <div class="form-group" >  
    <div class="col-md-2">
    {!!Form::label('Tamaño del Menú:')!!}
      {!!Form::select('size', array('Short' => 'Pequeño', 'Medium' => 'Mediano', 'Long' => 'Largo'), 'Short', ['class'=>'form-control select2'] )!!}        
    </div>                        
    <div class="col-md-2">
    {!!Form::label('Comportamiento:')!!}
      {!!Form::select('target', array('_self' => 'Misma Ventana', '_blank' => 'Nueva Ventana'), '_self', ['class'=>'form-control select2'] )!!}        
    </div>                        
    
    <div class="col-md-2">
          <div class="priChec">

        {!!Form::label('publicar','Publicar')!!}
        <div class="material-switch pull-right">
            <input id="someSwitchOption1" name="publish" type="checkbox" />
            <label for="someSwitchOption1" class="label-primary" ></label>
        </div>
        </div>
    </div>
    <div class="col-md-2">
      <div class="priChec">
        {!!Form::label('privado','Privado')!!}
          <div class="material-switch pull-right">
          <input id="someSwitchOptionSuccess" name="ChekPrivado" type="checkbox"/>
            <label for="someSwitchOptionSuccess" class="label-success"></label>
          </div>           
        </div>
      </div>

  </div>
</div>

</div>
<div clas="row">
<div class="form-group" >
	<div class="col-md-12">
	 {!!Form::submit('Guardar',['class'=>'btn btn-primary'])!!}
	</div>
</div>
</div>
 {!!Form::close()!!}
 </div>
@stop

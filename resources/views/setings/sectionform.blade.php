@extends('layouts.app')
  @section('content')
       <!---contact-->

<?php  
if(isset($Seting)) 
{
    $botonTitulo='Guardar';
    $message='Edit';
    $clave=$Seting->clave;
    $value=$Seting->value;

}

else{ 
    $botonTitulo='Guardar';
    $message='New'; 
    $Seting=Null;
    $clave=$Seting;
    $value=$Seting;
   
  }

 ?>

@if($message=='Edit')
 {!!Form::model($Seting,['route'=>['admin.seting.update',$Seting->id],'method'=>'PUT', 'novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.seting.store','method'=>'POST','novalidate' => 'novalidate','files' => true])!!}
@endif

  <div class="container-fluid">

      <div class="row">
        <div class="row">
            <div class="form-group">
                  <div class="col-md-12"><h3 class="head">Configuracion pagina</h3>
                      <p></p>
                  </div>
            </div>
        </div>



      <div class="form-group">
          {!!Form::label('titulo','Clave:')!!}
          {!!Form::text('clave',$clave,['class'=>'form-control','placeholder'=>''])!!}

 
      </div>

      <div class="form-group">
          {!!Form::label('titulo','Valor:')!!}
          {!!Form::text('value',$value,['class'=>'form-control','placeholder'=>''])!!} 
      </div>
    
          

          {!!Form::submit( $botonTitulo,['class'=>'btn btn-primary'])!!}
           {!! link_to('admin/seting', 'Cancelar',array('class'=>'btn btn-danger')) !!}

        {!!Form::close()!!} 
       
  
      </div>
</div>

  @stop
<!--formulario para editar y nueva seccion-->
@extends('layouts.app')
  @section('content')
    
    <?php  
          if(isset($Types)) 
        {
           $botonTitulo='Guardar'; // para cambiar de nombre al submit si es editar o guardar
           $message='Edit';
           $title=$Types->title;
           $description=$Types->description;
           
        
        }

      else
        { 
           $botonTitulo=' Guardar';
           $message='New'; 
           $Types=Null;
           $title=$Types;
           $description=$Types;
        
         
        }

     ?>

     @if($message=='Edit')
        {!!Form::model($Types,['route'=>['admin.types.update', $Types->id],'method'=>'PUT'])!!} 

     @else
         {!!Form::open(['route'=>'admin.types.store', 'method'=>'POST'])!!}
     @endif


  <div class="container-fluid">
    <h3 class="head">Types</h3>
            <br>

          <div class="form-group">
              

             {!!Form::label('titulo','Titulo:')!!}
              {!!Form::text('title',$title,['class'=>'form-control','placeholder'=>''])!!}
          </div>
          <div class="form-group">
              {!!Form::label('descripcion','Descripción:')!!}
              {!!Form::textarea('description',$description,['class'=>'form-control','placeholder'=>''])!!}
          </div>
              {!!Form::submit($botonTitulo,['class'=>'btn btn-primary'])!!}
               {!! link_to('admin/types', 'Cancelar',array('class'=>'btn btn-danger')) !!}
        {!!Form::close()!!}        
  </div>
  @stop


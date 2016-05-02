@extends('layouts.app')
@section('content')
<?php
$botonTitulo='GUARDAR';
$path="";
 ?>
 {!!Form::open(['route'=>'admin.itemmenuadd.store','method'=>'POST','novalidate' => 'novalidate','files' => true])!!}
 		<div class="row">
            <div class="form-group">
                  <div class="col-md-12"><h3 class="head">GALERIA</h3>
                      <p>REGISTRO DE ELEMENTOS DE MENÚ PARA GALERÍAS</p>
                  </div>
                <div class="col-md-3">
                  {!!Form::label('Galerías','Galerías:')!!}
                  <select name="id_galleries" id="id_galleries"  class="form-control select2">
                  @foreach($Galleries as $gal)
                  <option value="<?php echo $gal->id; ?>"><?php echo $gal->title; ?></option>
                  @endforeach
                </select>                  
                <br>
                </div>
          
              </div>
          </div>


          
       <div class="row">

       <div class="form-group" >    
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
              <div class="panel panel-primary" style="width:100px;">
                              <div class="panel-heading">                                  
                                  Imagen 
                              </div>
                              <div class="panel-body">
                                  <img id="imgUpTo" src="<?php echo $path ?>" alt="Imagen" class="img-responsive" />
                              </div>
                              <div class="panel-footer text-right">
                              </div>
                      </div>      
            </center>
        </div>                     
      
      </div>      
      </div>          
<div class="row">
  <div class="form-group" >
 	  {!!Form::label('Nombre del Elemento:')!!}
 	  {!!Form::text('title',null,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre del elemento del Menú'])!!}
 </div>

 <div class="form-group" >
 <div class="form-group" >
   <input type="hidden" name="id_menu" value="{{ $id_menu }}">
   <input type="hidden" name="id_parent" value="{{ $id_parent }}">        
   <input type="hidden" name="level" value="{{ $level }}">   
   <input type="hidden" name="option" value="{{ $option }}">    
         
 </div>

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
<br>       
<div class="row">
  <div class="form-group" >  
    <div class="col-md-6">
     {!!Form::submit( $botonTitulo,['class'=>'btn btn-danger'])!!}

    </div>                       
  </div>
</div>
          
       
        {!!Form::close()!!} 


@stop
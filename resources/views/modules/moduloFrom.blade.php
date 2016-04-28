@extends('layouts.app')
@section('content')

<?php

$chkActivado="null";

?>

    <div class="col-md-12"><h3 class="head">Modulos</h3>
                      <p>PÁGINA PARA LOS ROLES</p>
                  </div>
                
                <br><br><br>                          
        
                  {!!Form::open(['route'=>'admin.rol.store','method','POST'])!!}                    
               
                    <div class="form-group" id="frmLogin">
                           <div class="col-xs-6">
                          {!!Form::label('titulo','name')!!}
                          {!!Form::text('title','',['class'=>'form-control frmEspacios','placeholder'=>'Nombre'])!!}
                          </div>

                      <div class="col-xs-3">
                      <div class="priChec">
                          {!!Form::label('activado','Activado')!!}
                          <div class="material-switch pull-right">
                              <input id="someSwitchOptionSuccess" name="ChekActivacion" <?php echo $chkActivado ?>  type="checkbox"/>
                              <label for="someSwitchOptionSuccess" class="label-success"></label>
                          </div>           
                      </div>
                    </div>

                    <div class="col-xs-12">
                      {!!Form::label('descripcion','Descripcion')!!}
                      {!!Form::textarea('description','',['class'=>'form-control','placeholder'=>''])!!}
                    </div>       

                    <br>
                    <div class="col-xs-6">
                      <div class="col-xs-2">
                          {!!Form::submit('Registrar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                      </div>
                      </div>    
                    </div>
                  
                {!!Form::close()!!}

@stop
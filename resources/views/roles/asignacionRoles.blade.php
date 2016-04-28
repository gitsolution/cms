@extends('layouts.app')
@section('content')

<?php
    $chkActivado = "checked";
 
    if(isset($user) && isset($idUser)) 
    {

    }

    $nombreModulo="usuarios";
?>

    <div class="col-md-6"><h3 class="head">Asignacion de roles</h3>
    </div>
          <div class="form-group" id="frmLogin">      
                <br><br><br>       
               
                    {!!Form::open(['route'=>'admin.assignment.store','method','POST'])!!}                
                        <div class="col-md-12">
                             {!! Form::hidden('idUsuario', $id) !!}
                            {!! Form::label('id', 'Usuario') !!}
                            {!! Form::select('size', array('nombre' => $nombreCompleto), null,['class'=>'form-control select2']) !!}
                          
                        </div>
                        <br><br><br><br>
                        <div class="col-md-12">
                          {!! Form::label('id', 'Roles') !!}
                        </div>
                          
                          
                        @foreach($roles as $role)
                        <?php $ch="";?>
                            @foreach($chek as $chk)
                                <?php if($chk->id_role==$role->id){$ch="true";}?>
                            @endforeach
                        <div class="col-md-4">
                            <label>
                                {{$role->title}}                                    
                                {{ Form::checkbox('role[]', $role->id,$ch)}} 
                              </label>
                            
                          </div>
                        @endforeach
           
                       
                        <div class="col-md-6">
                            <div class="col-md-2"> <br> <br>
                                {!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                             </div>
                        </div>  </div>  

                    {!!Form::close()!!}
@stop
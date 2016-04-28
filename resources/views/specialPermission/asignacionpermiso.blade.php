@extends('layouts.app')
@section('content')
    <div class="col-md-6"><h3 class="head">Permisos especiales</h3>
    </div>
          <div class="form-group" id="frmLogin">      
                <br><br><br>               
                    {!!Form::open(['route'=>'admin.assignment.store','method','POST'])!!}                
                        <div class="col-md-12">
                             {!! Form::hidden('idUsuario', $id) !!}
                            {!! Form::label('id', 'Permiso especial a:') !!}
                            {!! Form::select('size', array('nombre' => $nombreCompleto), null,['class'=>'form-control select2']) !!}
                          
                        </div>
                        <br><br><br><br>
                        <div class="col-md-12">
                          {!! Form::label('id', 'Permisos') !!}
                        </div>
                          
                          
                        
                        <div class="col-md-6">
                            <div class="col-md-2"> <br> <br>
                                {!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                             </div>
                        </div>  </div>  

                    {!!Form::close()!!}
@stop
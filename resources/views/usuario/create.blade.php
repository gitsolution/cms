@extends('layouts.app')
@section('content')

<?php  

if(isset($user)) {
    $message='Edit';
    $id_login=$user->id;
    $name=$user->name;
    $lastName=$user->lastName;
    $email=$user->email;
    $chk=$user->active;
    if($chk==1)
    {
      $chkActivado = "checked";
    }
     
    else
    {
      $chkActivado = ""; 
    }

    $created_at = date_create($user->created_at);
    $nombreBoton='Editar';
    
    $categories= App\usr_role::lists('title','id');
}

else
{  
    $message='New';
    $id_login=0;
    $user=Null;
    $name=$user;
    $lastName=$user;
    $email = $user;
    $chkActivado="0";
    $nombreBoton='Registrar';
    $categories= App\usr_role::lists('title','id');
}

 ?>

@if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    
    <div class="col-md-12"><h3 class="head">USUARIO</h3>
                      <p>PÁGINA PARA LOS USUARIOS</p>
                  </div>
                
                <br><br><br>               					   
               
               @if($message=='Edit')
                {!!Form::model($user,['route'=>['usuario.update',$user->id],'method'=>'PUT'])!!} 
                @else
                  {!!Form::open(['route'=>'usuario.store','method','POST'])!!} 
                @endif
                    
					<div class="form-group" id="frmLogin">
					 <div class="col-xs-4">
            		{!!Form::label('nombre','Nombre')!!}
            		{!!Form::text('name',$name,['class'=>'form-control frmEspacios','placeholder'=>'Nombre'])!!}
            		</div>

            		<div class="col-xs-4">
            		{!!Form::label('apellidos','Apellidos')!!}
            		{!!Form::text('lastName',$lastName,['class'=>'form-control frmEspacios','placeholder'=>'Apellidos'])!!}
            		</div>

            		<div class="col-xs-4">
            		{!!Form::label('Correo electrónico')!!}
            		{!!Form::email('email',$email,['class'=>'form-control frmEspacios','placeholder'=>'Correo electronico'])!!}
            		</div>

					<div class="col-xs-6">
						{!!Form::label('Contraseña')!!}
            			{!!Form::password('password',	['class'=>'form-control frmEspacios','placeholder'=>'Contraseña'])!!}
            		</div>

            		<div class="col-xs-6">
						{!!Form::label('Confirmar contraseña')!!}
            			{!!Form::password('password_confirmation',['class'=>'form-control frmEspacios','placeholder'=>'Confirmar contraseña'])!!}
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
                    	
            				{!!Form::submit($nombreBoton,['class'=>'btn  btn-primary frmEspacios','placeholder'=>'Nombre'])!!}
                            {!! link_to('usuario', 'Cancelar',array('class'=>'btn btn-danger')) !!}
                        
            		</div>		
				</div>
            	{!!Form::close()!!}

@stop
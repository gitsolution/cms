<?php
    $chkActivado="checked";
?>


@extends('layouts.app')
@section('content')


<div class="row">
<br>
<div class="col-md-10"><h3>Asignacion de roles a: Iver Fabian</h3></div> <!--divide la columna en 10 y 2-->
<div class="col-md-2">
{!!Form::open(['route'=>'admin.rol.store','method','POST'])!!} 
 {!!Form::submit('Registrar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
</div>
    </div>


<table class="table table-hover table-responsive">
          <thead class="center-text" >
            <th  class="ColumColor text-left">
            Rol
            </th>   
            <th class="ColumColor text-left width='10px'" >
            Descripcion
            </th> 
             <th class="ColumColor text-left" >
            activar
            </th>        
          </thead>
           

		@foreach($usrRole as $user)
        <?php 
            $created_at = substr($user->created_at,0,10);
        ?>
			<tbody>
				<td>{{$user->title}}</td>
				<td>{{$user->description}}</td>
                <td><div class="col-xs-3">
                      <div class="">
                          {!!Form::label('','')!!}
                          <div class=" pull-right">
                           <input id="{{$user->id}}" name="chkSelect[]" <?php 
                              if($user->active=="1")
                              {
                                $chkActivado="checked";
                              }

                              else
                              {
                                 $chkActivado="";
                              }

                              echo $chkActivado;

                              ?>  type="checkbox"/>
                              <label for="someSwitchOptionSuccess" class="label-success"></label>
                          </div>           
                      </div>
                    </div>
                </td>

			</tbody>
		  @endForeach
        {!!Form::close()!!}
	</table>
        
        <div class="text-center">
            {!!$usrRole->render()!!}
        </div>


	
@stop
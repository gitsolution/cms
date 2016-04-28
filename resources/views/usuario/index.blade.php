@extends('layouts.app')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')


<div class="container-fluid">

<br>
<div class="col-md-10"><h3>Catálago de usuarios</h3></div> <!--divide la columna en 10 y 2-->
@can('Usuarios.Crear')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/userNew', 'Nuevo usuario ',array('class'=>'btn btn-success ')) !!}
 {!!Form::close()!!}
</div>
@endcan

</div>
<div class="table-responsive">
<table class="table table-hover">
          <thead class="center-text" >
            <th class="ColumColor text-left" >
            ID
            </th> 
            <th  class="ColumColor text-left" >
            Nombre
            </th>
            <th  class="ColumColor text-left" >
            Apellidos
            </th>
            <th class="ColumColor text-left" >
            Correo eléctronico
            </th>
            <!--<th class="ColumColor text-left" >
            Rol-->
            </th>
            <th class="ColumColor text-left" >
            Creado el
            </th>
            <th class="ColumColor text-left">
           	Acciones
            </th>
           
          </thead>
		@foreach($users as $user)
        <?php 
            $created_at = substr($user->created_at,0,10);
        ?>
			<tbody>
				<td>{{$user->id}}</td>
				<td>{{$user->name}}</td>
				<td>{{$user->lastname}}</td>
                <td>{{$user->email}}</td>

               
                    <!--<td>{{$user->roles}}</td>-->

				<td>{{$created_at}}</td>
				<td>
                @can('Usuarios.Editar')
				    {!! link_to('admin/userEdit/'.$user->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!} 
                @endcan
                @can('Usuarios.Asignarroles')
                    {!! link_to('admin/permissionEdit/'.$user->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-flag')) !!}
                @endcan
                @can('Usuarios.Asignarpermisosespeciales')
                    {!! link_to('admin/specialEdit/'.$user->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-lock')) !!}   
                @endcan     
				</td>
			</tbody>
		@endForeach

	</table></div>
        <div class="text-center">
            {!!$users->render()!!}
        </div>

 
 </div>
 
	
@stop
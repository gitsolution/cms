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
<div class=" form-group row">
<div class="col-md-10"><h3>Catálago de roles</h3></div> <!--divide la columna en 10 y 2-->
@can('Roles.Crear')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/rolesNew', 'Nuevo roles ',array('class'=>'btn btn-success ')) !!}
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
            Titulo
            </th>
            <th  class="ColumColor text-left" >
            Descripcion
            </th>
            @can('roles-activo')
              <th  class="ColumColor text-left" >
               Activo
              </th>
            @endcan
            <th  class="ColumColor text-left" >
             Creado el
            </th>
            <th  class="ColumColor text-left" >
             Acciones
            </th>
           
          </thead>

	

	@foreach($roles as $rol)
			<tbody>
				<td>{{$rol->id}}</td>
				<td>{{$rol->title}}</td>
				<td>{{$rol->description}}</td>
				  
        @can('roles-activo')
            <td> 
              <?php 
                if($rol->active=='1'){
              ?>                  
                  {!!link_to('admin/rolActive/'.$rol->id.'/False', '',array('class'=>'fa fa-check')) !!}
               <?php 
                    } 
                   
                   else{ 
                ?>                    
                  {!!link_to('admin/rolActive/'.$rol->id.'/True', '',array('class'=>'fa fa-times')) !!}
                
                <?php } 
                ?>
					   
            </td>
        @endcan
				<td>{{$rol->created_at}}</td>
				<td>
        @can('Roles.Editar')
				  {!! link_to('admin/rolesEdit/'.$rol->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
        @endcan

        @can('Roles.Eliminar')
          {!! link_to('admin/rolesDelete/'.$rol->id, '',array('class'=>'btn btn-danger glyphicon glyphicon-trash')) !!}
        @endcan 
				</td>

			</tbody>
		@endForeach

	</table>
</div>
	</div>

@stop
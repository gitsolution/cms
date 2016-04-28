@extends('layouts.app')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')


<div class="container-fluid">
<br><div class="row">
<div class="col-md-10"><h3>Catálago de cms</h3></div> <!--divide la columna en 10 y 2-->

@can('modulos-nuevo')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/moduleNew', 'Nuevo Módulo ',array('class'=>'btn btn-success ')) !!}
 {!!Form::close()!!}
</div>
@endcan

</div>
    <div class="table-responsive">
<table class="table table-hover ">
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
            @can('modulos-submenus')
              <th  class="ColumColor text-left" >
              Submenus
              </th>
            @endcan
            <th  class="ColumColor text-left" >
             Acciones
            </th>
           
          </thead>

	

	@foreach($cms as $cm)
			<tbody>
				<td>{{$cm->id}}</td>
				<td>{{$cm->title}}</td>
				<td>{{$cm->description}}</td>
        
        @can('modulos-submenus')
          <td>
            {!!link_to('admin/submodules/'.$cm->id, '',array('class'=>'glyphicon glyphicon-menu-hamburger')) !!}
          </td>
        @endcan
				<td>
          @can('modulos-editar')
  				  {!! link_to('admin/moduleEdit/'.$cm->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
          @endcan
          @can('modulos-eliminar')
            {!!link_to('admin/moduleActive/'.$cm->id.'/False', '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
          @endcan
          @can('modulos-especiales')
            {!! link_to('admin/modulePermissionEdit/'.$cm->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-lock')) !!}
          @endcan
        </td>

			</tbody>
		@endForeach

	</table>
	</div>
</div>
	
@stop
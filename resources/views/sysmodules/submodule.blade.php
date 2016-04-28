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
<div class="col-md-10"><h3>Catálago de submodulos</h3></div> <!--divide la columna en 10 y 2-->
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/submoduleNew/'.$idMenu, 'Nuevo SubMódulo ',array('class'=>'btn btn-success ')) !!}
 {!!Form::close()!!}
</div>
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
            <th  class="ColumColor text-left" >
             Acciones
            </th>
           
          </thead>

	

	@foreach($cms as $cm)
			<tbody>
				<td>{{$cm->id}}</td>
				<td>{{$cm->title}}</td>
				<td>{{$cm->description}}</td>
				<td>
  				{!! link_to('admin/submoduleEdit/'.$cm->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
          {!!link_to('admin/submoduleActive/'.$cm->id.'/'.$cm->id_parent, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
          {!! link_to('admin/modulePermissionEdit/'.$cm->id, '',array('class'=>'btn btn-primary glyphicon glyphicon-lock')) !!}
        </td>

			</tbody>
		@endForeach

	</table>
	</div>
</div>
	
@stop
@extends('layouts.app')
@section('content')

<div class="container-fluid">

<div class="row">
<br>
<div class="col-md-10"><h3>Catálogo de Tipos </h3></div> <!--divide la columna en 10 y 2-->
@can('admin.Tipos.Crear')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/typesnew', 'Nuevo Tipo ',array('class'=>'btn btn-success ')) !!}
 {!!Form::close()!!}
</div>
@endcan
    </div>

        <div class="row text-center">
            {{$Types->render()}}
        </div>
        <div class="table-responsive">
    <table class="table table-hover"> 
          <thead class="center-text" >
            <th class="ColumColor" >
            ID
            </th> 
            <th  class="ColumColor text-center" >
            Titulo
            </th>
            <th  class="ColumColor text-center" >
            Descripcion
            </th>
            <th class="ColumColor text-center" >
            Creado
            </th>
            <th class="ColumColor text-center">
            Acciones
            </th>
          </thead>


@foreach($Types as $med)
        <?php 
            $creat = substr($med->created_at,0,10); ?> 
          <tr>
          <td> {{$med->id}}</td>
          <td> {{$med->title}}</td>         
          <td> {{$med->description}}</td> 
          <td> {{$creat}}</td>
          <td class="text-center"> 

          @can('tipos-editar')
          {!! link_to('admin/typesedit/'.$med->id,' ',array('class'=>'btn btn-primary glyphicon glyphicon-pencil')) !!}
          <!--{!!link_to_route('admin.types.edit', $title = '', $parameters = $med->id, $attributes = ['class'=>'btn btn-primary glyphicon glyphicon-pencil'])!!}-->
          @endcan
          
          @can('tipos-eliminar')
          {!!link_to('admin/typedel/'.$med->id, '',array('class'=>'btn btn-danger glyphicon glyphicon-trash')) !!}
          @endcan
          </td>
              <!-- {!!Form::close()!!}-->
          </tr>

@endforeach
      </table> 
      </div>
          <div class="row text-center">
                {{$Types ->render()}}
                
          </div>
  </div>  
@stop
<!--este es el formulario para el index estilos-->
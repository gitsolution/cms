@extends('layouts.app')
@if(Session::has('message'))
<div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('message')}}
</div>
@endif
@section('content')

<div class="container-fluid">
<div class="row">
<br>
<div class="col-md-10"><h3>Catálogo Configuraciones</h3></div> <!--divide la columna en 10 y 2-->
@can('Configuraciónes.Crearmetas')
  <div class="col-md-2">
   {!!Form::open()!!}
      {!! link_to('admin/setingnew', 'Nueva Configuracion ',array('class'=>'btn btn-success ')) !!}
   {!!Form::close()!!}
  </div>
@endcan
    </div>
        <div class="row text-center">
            {{$Sections->render()}}
        </div>
        <div class="table-responsive">
    <table class="table table-hover">
          <thead class="center-text" >
            <th class="ColumColor columbord" >
            ID
            </th> 
            <th  class="ColumColor text-center " >
            clave
            </th>
            <th  class="ColumColor text-center" >
            valor
            </th>
          
            <th class="ColumColor text-center columbord"  >
            Acciones
            </th>
          </thead>


@foreach($Sections as $med)
         
          <tr>
          <td> {{$med->id}}</td>
          <td> {{$med->clave}}</td>
          <td> {{$med->value}}</td>
      
     
          <td class="text-center"> 
          @can('Configuraciónes.Editar')
            {!!link_to_route('admin.seting.edit', $title = '', $parameters = $med->id, $attributes = ['class'=>'btn btn-primary glyphicon glyphicon-pencil'])!!}
          @endcan

          @can('Configuraciónes.Eliminar')
            {!!link_to('admin/setingdel/'.$med->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
          @endcan
           </td>
              

          </tr>

@endforeach
      </table> 
      </div>
          <div class="row text-center">
                {{$Sections ->render()}}
                <?php //echo $medias->render(); ?>
          </div>
  </div>  
@stop
<!--este es el formulario para el index estilos-->
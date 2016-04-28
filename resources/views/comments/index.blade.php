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
<div class="col-md-10"><h3>Catálogo de Comentarios </h3></div> <!--divide la columna en 10 y 2-->
    </div>
        <div class="row text-center">
            {{$Coments->render()}}
        </div>
        <div class="table-responsive">
    <table class="table table-hover">
          <thead class="center-text" >
            <th class="ColumColor " >
            ID
            </th> 
            <th  class="ColumColor text-center " >
            Documento
            </th>
            <th  class="ColumColor text-center" >
            Comentario
            </th>
            @can('Comentarios.Publicar')
              <th class="ColumColor text-center" >
              Publicado
              </th>
            @endcan
            <th class="ColumColor text-center" >
            Fecha Publicación
            </th>
            @can('Comentarios.Eliminar')
              <th class="ColumColor text-center"  >
              Eliminar
              </th>
            @endcan
          </thead>


@foreach($Coments as $med)
        <?php 
            $publish_date = substr($med->created_at,0,10);
           
        ?> 
          <tr>
          <td> {{$med->id}}</td>
          <td> {{$med->titleDoc}}</td>
          <td> {{$med->content}}</td>
          
          @can('Comentarios.Publicar')
          <td class="text-center">
              <?php if($med->publish=='1'){?>
                
                {!! link_to('admin/commentPublic/'.$med->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
              <?php } 
              else{ ?>
                
                {!! link_to('admin/commentPublic/'.$med->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
              <?php } ?>
          </td>
          @endcan
          <td class="text-center"> {{$publish_date}}</td> 
          @can('Comentarios.Eliminar')
            <td>
              {!!link_to('admin/commentdel/'.$med->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
            </td>
          @endcan
          </tr>

@endforeach
      </table> 
      </div>
          <div class="row text-center">
                {{$Coments ->render()}}
          </div>
  </div>  
@stop
<!--este es el formulario para el index estilos-->
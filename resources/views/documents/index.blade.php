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
<div class="col-md-10"><h3>Catálogo de Documentos </h3></div> <!--divide la columna en 10 y 2-->
@can('Documentos.Crear')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/documentnew', 'Nuevo Documento ',array('class'=>'btn btn-success ')) !!}
 {!!Form::close()!!}
</div>
 @endcan
    </div>
        <div class="row text-center">
            {{$Document->render()}}
        </div>
<div class="table-responsive">
    <table class="table table-hover "> 
          <thead class="center-text" >
            <th class="ColumColor" >
            ID
            </th> 
            <th  class="ColumColor " >
         	  Categoria
            </th>
            <th  class="ColumColor " >
            Titulo
            </th>
            @can('Documentos.acceso')
              <th class="ColumColor text-center" >
              Acceso
              </th>
            @endcan
            @can('Documentos.Publicar')
              <th class="ColumColor text-center" >
              Publicado
              </th>
            @endcan
            <th class="ColumColor " >
            Fecha Publicación
            </th>
            <th class="ColumColor ">
            Vistas
            </th>
            @can('Documentos.ordenar')
              <th class="ColumColor" colspan="2"s>
              Orden
              </th>
            @endcan
            <th class="ColumColor text-center" >
            Acciones
            </th>
          </thead>


@foreach($Document as $med)
        <?php 
            $publish_date = substr($med->publish_date,0,10);
            $down=$med->order_by-1;
            $up=$med->order_by+1;   
            if($down==0)$down=$med->order_by;
        ?> 
          <tr>
          <td> {{$med->id}}</td>
          <td> {{$med->category}}</td>
          <td> {{$med->title}}</td>

          @can('Documentos.acceso')
          <td class="text-center"> 
            <?php if($med->private=='1'){?>
                
             {!!link_to('admin/documentPriva/'.$med->id.'/False', '',array('class'=>'fa fa-lock fa-lg')) !!}
             <?php } 
             else{ ?>                    
             {!!link_to('admin/documentPriva/'.$med->id.'/True', '',array('class'=>'fa fa-unlock fa-lg')) !!}
                  <?php } ?>
          </td>
          @endcan

          @can('Documentos.Publicar')
          <td class="text-center">
             <?php if($med->publish=='1'){?>
                {!! link_to('admin/documentPublic/'.$med->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
              <?php } 
              else{ ?>
                
                {!! link_to('admin/documentPublic/'.$med->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
              <?php } ?>
          </td>
          @endcan

          <td class="text-center"> {{$publish_date}}</td>
          <td>{{$med->hits}}</td>

          @can('Documentos.ordenar')
            <td> {!!link_to('admin/documentorder/'.$med->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}
            </td>
            <td> {!!link_to('admin/documentorder/'.$med->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down'))!!}
            </td>
          @endcan
          <td class="text-center"> 
          @can('Documentos.Editar')
            {!!link_to_route('admin.document.edit', $title = '', $parameters = $med->id, $attributes = ['class'=>'btn btn-primary glyphicon glyphicon-pencil'])!!}
         @endcan
         @can('Documentos.Eliminar')
           {!!link_to('admin/documentdel/'.$med->id, '',array('class'=>'btn btn-danger glyphicon glyphicon-trash')) !!}
         @endcan
          </td>
               
          </tr>

@endforeach
      </table> 
      </div>
          <div class="row text-center">
                {{$Document ->render()}}
               
          </div>
  </div>  

@stop
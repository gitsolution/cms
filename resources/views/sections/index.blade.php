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
<div class="col-md-10"><h3>Catálogo de secciones </h3></div> <!--divide la columna en 10 y 2-->
@can('Secciones.Crear')
<div class="col-md-2">
 {!!Form::open()!!}
    {!! link_to('admin/sectionsnew', 'Nueva Sección ',array('class'=>'btn btn-success ')) !!}
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
            Tipo
            </th>
            <th  class="ColumColor text-center" >
            Sección
            </th>
            @can('Secciones.acceso')
              <th class="ColumColor text-center" >
              Acceso
              </th>
            @endcan

            @can('Secciones.publicar')
              <th class="ColumColor text-center" >
              Publicado
              </th>
            @endcan
            <th class="ColumColor text-center" >
            Fecha Publicación
            </th>
            @can('Secciones.ordenar')
            <th class="ColumColor text-center" colspan="2"> 
            orden
            </th>
            @endcan
            <th class="ColumColor text-center" >
            Vistas
            </th>
            <th class="ColumColor text-center columbord"  >
            Acciones
            </th>
          </thead>


@foreach($Sections as $med)
        <?php 
            $publish_date = substr($med->publish_date,0,10);
            $down=$med->order_by-1;
            $up=$med->order_by+1;   
            if($down==0)$down=$med->order_by;
        ?> 
          <tr>
          <td> {{$med->id}}</td>
          <td> {{$med->type}}</td>
          <td> {{$med->title}}</td>
          @can('Secciones.acceso')
              <td class="text-center"> 
                 <?php if($med->private=='1'){?>
                    
                  {!!link_to('admin/sectionsPriva/'.$med->id.'/False', '',array('class'=>'fa fa-lock fa-lg')) !!}
                 <?php } 
                 else{ ?>                    
                  {!!link_to('admin/sectionsPriva/'.$med->id.'/True', '',array('class'=>'fa fa-unlock fa-lg')) !!}
                      <?php } ?>
              </td>
          @endcan

          @can('Secciones.publicar')
              <td class="text-center">
                  <?php if($med->publish=='1'){?>
                    
                    {!! link_to('admin/sectionsPublic/'.$med->id.'/False', '',array('class'=>'glyphicon glyphicon-ok')) !!}
                  <?php } 
                  else{ ?>
                    
                    {!! link_to('admin/sectionsPublic/'.$med->id.'/True', '',array('class'=>'glyphicon glyphicon-ban-circle')) !!}
                  <?php } ?>
              </td>
          @endcan
          <td class="text-center"> {{$publish_date}}</td>
          
          @can('Secciones.ordenar')
            <td> {!!link_to('admin/sectionorder/'.$med->id.'/Up/'.$up, '',array('class'=>'glyphicon glyphicon-chevron-up')) !!}</td>         


            <td> {!!link_to('admin/sectionorder/'.$med->id.'/Down/'.$down, '',array('class'=>'glyphicon glyphicon-chevron-down'))!!}</td>
          @endcan
          <td class="text-center"> {{$med->hits}}</td> 

          <td> 
          @can('Secciones.editar')
            {!!link_to_route('admin.sections.edit', $title = '', $parameters = $med->id, $attributes = ['class'=>'btn btn-primary glyphicon glyphicon-pencil'])!!}
          @endcan
           
          @can('Secciones.eliminar')
            {!!link_to('admin/sectiondel/'.$med->id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-trash')) !!}
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
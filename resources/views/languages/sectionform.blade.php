@extends('layouts.app')
  @section('content')
       <!---contact-->

<?php  
if(isset($Section)) 
{
    $botonTitulo='Guardar'; // para cambiar de nombre al submit si es editar o guardar
    $message='Edit';
    $id=$Section->id;
    $id_type=$Section->id_type;
    $title=$Section->title;
    $resumen=$Section->resumen;
    $content=$Section->content;
    $main_picture=$Section->main_picture;
  if($Section->private=="0")
      {
        $ChekPrivado = "";
      }
  else{
        $ChekPrivado = "checked"; 
      } 
    $publish_date = date_create($Section->publish_date);
  if($Section->publish=="0")
      {
        $ChekPublicar = "";  
      }
  else{
        $ChekPublicar = "checked"; 
      } 
    $uri=$Section->uri;
    $hits=$Section->hits;
    $order_by= $Section->order_by;
    $path = '../../../'.$Section->main_picture;

}

else{ 
    $botonTitulo='Guardar';
    $message='New'; 
    $Section=Null;
    $title=$Section;
    $resumen=$Section;
    $content=$Section;
    $ChekPrivado=$Section;
    $ChekPublicar = $Section;
    $publish_date = date('Y-m-d');
    $order_by= $Section;
    $id_type=$Section;
    $path = $Section;
    $id=$Section;
  }

 ?>

@if($message=='Edit')
 {!!Form::model($Section,['route'=>['admin.sections.update',$Section->id],'method'=>'PUT', 'novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.sections.store','method'=>'POST','novalidate' => 'novalidate','files' => true])!!}
@endif

  <div class="container-fluid">

      <div class="row">
        <div class="row">
            <div class="form-group">
                  <div class="col-md-12"><h3 class="head">SECCION</h3>
                      <p>PAGINA PARA LA SECCION</p>
                  </div>
                 
                 <div class="col-md-3" >
                    {!!Form::label('Idioma:')!!}
                    {!!Form::select('id_language', \App\cms_language::lists('label','id'),null,['class'=>'form-control'] )!!}
               
                </div><div class="col-md-12"></div>
         
              
                <div class="col-md-3">
                  {!!Form::label('tipo','Tipo:')!!}
                  {!!Form::select('id_type', \App\cms_type::lists('title','id'),null,['class'=>'form-control select2'] )!!}
                <br>
                </div>
                <div class="col-md-5">
                  <div class="publiChec">
                      {!!Form::label('privado','Publicar')!!}
                          <div class="material-switch pull-right">
                            <input id="someSwitchOptionInfo" name="ChekPublicar" <?php echo $ChekPublicar ?> type="checkbox"/>
                            <label for="someSwitchOptionInfo" class="label-info"></label>
                        </div>     
                  </div>
                </div>
                       <!---CheckBox-->
                <div class="col-md-3">
                  <div class="priChec">
                      {!!Form::label('privado','Privado')!!}
                      <div class="material-switch pull-right">
                          <input id="someSwitchOptionSuccess" name="ChekPrivado" <?php echo $ChekPrivado ?>  type="checkbox"/>
                          <label for="someSwitchOptionSuccess" class="label-success"></label>
                      </div>           
                  </div>
                </div>


          <div class="col-md-12">
              {!!Form::label('date','Fecha De Publicación:')!!}  
          </div>
          
          <div class="col-md-3">
              {!!Form::date('publish_date', $publish_date,['class'=>'form-control'])!!}              
          </div>
      <br>


       <div class="form-group" >    
        <div class="col-md-12">
               <input type='file' name='file' id="imgLoad"  />
        </div>
      </div>
    
       <div class="row">

       <div class="form-group" >    
        
          <div class="col-md-12">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <center>
              <div class="panel panel-primary" style="width:300px;">
                              <div class="panel-heading">                                  
                                  Imagen 
                              </div>
                              <div class="panel-body">
                                  <img id="imgUpTo" src="<?php echo $path ?>" alt="Imagen" class="img-responsive" />
                              </div>
                              <div class="panel-footer text-right">
                                @if($message=='Edit')
                                  {!!link_to('admin/delsecpic/'.$id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-remove ')) !!}
                                @endif
                              </div>
                      </div>      
            </center>
        </div>                     
      
      </div>
        
      <br>
      </div>
</div>
</div>


      <div class="form-group">
          {!!Form::label('titulo','Titulo:')!!}
          {!!Form::text('title',null,['class'=>'form-control','placeholder'=>''])!!}

       </div>
    
          <div class="form-group">
                {!!Form::label('Resume','Resumen')!!}
                {!!Form::textarea('resumen',$resumen,['class'=>'form-control'])!!}
                <script  type = "text/javascript" > 
                  CKEDITOR . replace (  'resumen'  ); 
                  CKEDITOR . add            
                </script>
          </div>

          <div class="form-group">
                {!!Form::label('Resume','Contenido')!!}
                {!!Form::textarea('content',$content,['class'=>'form-control'])!!}
                <script  type = "text/javascript" > 
                  CKEDITOR . replace (  'content'  ); 
                  CKEDITOR . add            
                </script>
          </div>

          {!!Form::submit( $botonTitulo,['class'=>'btn btn-primary'])!!}
           {!! link_to('admin/sections', 'Cancelar',array('class'=>'btn btn-danger')) !!}
        {!!Form::close()!!} 
      </div>
      <br><br>
</div>

  @stop
<!--formulario para editar y nueva seccion-->
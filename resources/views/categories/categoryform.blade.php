@extends('layouts.app')
  @section('content')
       <!---contact-->

<?php  
if(isset($Catego)) 
{
    $botonTitulo='Guardar'; // para cambiar de nombre al submit si es editar o guardar
    $message='Edit';
    $id=$Catego->id;
    $id_type=$Catego->id_type;
    $title=$Catego->title;
    $resumen=$Catego->resumen;
    $content=$Catego->content;
    $main_picture=$Catego->main_picture;
  if($Catego->private=="0")
      {
        $ChekPrivado = "";
      }
  else{
        $ChekPrivado = "checked"; 
      } 
    $publish_date = date_create($Catego->publish_date);
  if($Catego->publish=="0")
      {
        $ChekPublicar = "";  
      }
  else{
        $ChekPublicar = "checked"; 
      } 
    $uri=$Catego->uri;
    $hits=$Catego->hits;
    $order_by= $Catego->order_by;
     $path = '../../../'.$Catego->main_picture;


}

else{ 
    $botonTitulo='Guardar';
    $message='New'; 
    $Catego=Null;
    $title=$Catego;
    $resumen=$Catego;
    $content=$Catego;
    $ChekPrivado=$Catego;
    $ChekPublicar = $Catego;
    $publish_date = date('Y-m-d');
    $order_by= $Catego;
    $id_type=$Catego;
    $path = $Catego;
    $id=$Catego;

  }
 ?>

@if($message=='Edit')
 {!!Form::model($Catego,['route'=>['admin.category.update',$Catego->id],'method'=>'PUT','novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.category.store','method'=>'POST', 'novalidate' => 'novalidate','files' => true])!!}
@endif


  <div class="container-fluid">
       

     <div class="row">
      <div class="form-group">


<div class="row">
            <div class="form-group">
                  <div class="col-md-12"><h3 class="head">CATEGORÍA</h3>
                      <p>PAGINA PARA LA CATEGORÍA</p>
                  </div>
                <div class="col-md-3">
                  {!!Form::label('seccion','Seccion:')!!}
                  {!!Form::select('id_section', \App\cms_section::lists('title','id'),null,['class'=>'form-control select2'] )!!}
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
              </div>
          </div>

  
      <div class="row">
          <div class="col-md-12">
              {!!Form::label('date','Fecha De Publicación:')!!}  
          </div>
          
          <div class="col-md-3">
              {!!Form::date('publish_date', $publish_date,['class'=>'form-control'])!!}              
          </div>
      </div>
     
  
 
       <div class="row">

       <div class="form-group" >    
        <div class="col-md-12">
               <input type='file' name='file' id="imgLoad"  />
        </div>
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
                                  {!!link_to('admin/delcatpic/'.$id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-remove ')) !!}
                                @endif
                              </div>
                      </div>      
            </center>
        </div>                     
      
      </div>
        
      <br>
      </div>




      
          {!!Form::label('titulo','Titulo:')!!}
          {!!Form::text('title',$title,['class'=>'form-control','placeholder'=>''])!!}
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
           {!! link_to('admin/category', 'Cancelar',array('class'=>'btn btn-danger')) !!}
        {!!Form::close()!!} 
          
  </div>
  <br><br>
</div>
  @stop
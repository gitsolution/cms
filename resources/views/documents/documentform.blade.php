@extends('layouts.app')
  @section('content')
       <!---contact-->

<?php  
if(isset($Document)) 
{
    $botonTitulo='Guardar'; // para cambiar de nombre al submit si es editar o guardar
    $message='Edit';
    $id=$Document->id;
    $id_category=$Document->id_category;
    $title=$Document->title;
    $resumen=$Document->resumen;
    $content=$Document->content;


  if($Document->private=="0")
      {
        $ChekPrivado = "";
      }
  else{
        $ChekPrivado = "checked"; 
      } 
    $publish_date = date_create($Document->publish_date);
  if($Document->publish=="0")
      {
        $ChekPublicar = "";  
      }
  else{
        $ChekPublicar = "checked"; 
      } 
    $uri=$Document->uri;
    $hits=$Document->hits;
    $order_by= $Document->order_by;
    $path='../../../'.$Document->main_picture;
 
}

else{ 
    $publish_date= date('Y-m-d');
    $botonTitulo='Guardar';
    $message='New'; 
    $Document=Null;
    $title=$Document;
    $resumen=$Document;
    $content=$Document;
    $ChekPrivado=$Document;
    $ChekPublicar = $Document; 
    $order_by= $Document;
    $id_category=$Document;
    $id=$Document;
    $path=$Document;
  }
 ?>

@if($message=='Edit')
 {!!Form::model($Document,['route'=>['admin.document.update',$Document->id],'method'=>'PUT','novalidate' => 'novalidate','files' => true])!!} 
@else
 {!!Form::open(['route'=>'admin.document.store','method'=>'POST','novalidate' => 'novalidate','files' => true])!!}
@endif


  <div class="container-fluid">
      

  <div class="row">
   <div class="row">
            <div class="form-group">
                  <div class="col-md-12"><h3 class="head">DOCUMENTO</h3>
                      <p>PAGINA PARA LA DOCUMENTO</p>
                  </div>
                <div class="col-md-3">
                  {!!Form::label('seccion','Sección:')!!}
                  <select name="id_section" id="id_section"  class="form-control select2">
                  @foreach($Sections as $sec)
                  <option value="<?php echo $sec->id; ?>"><?php echo $sec->title; ?></option>
                  @endforeach
                </select>                  
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

              <div class="form-group">
            
              <div class="col-md-3">
                  {!!Form::label('seccion','Categoria:')!!}


                  <select name="id_category" id="id_category" class="form-control select2">
                  @foreach($Categories as $cat)

                  <option value="<?php echo $cat->id; ?>"><?php echo $cat->title; ?></option>
                  @endforeach
                </select>

                <br>
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
                                  {!!link_to('admin/deldocpic/'.$id, '',array('class'=>'img-responsive btn btn-danger glyphicon glyphicon-remove ')) !!}
                                @endif
                              </div>
                      </div>      
            </center>
        </div>                     
      
      </div>      
      </div>
      <br>
      <div class="form-group">
          {!!Form::label('titulo','Titulo:')!!}
          {!!Form::text('title',null,['class'=>'form-control','placeholder'=>''])!!}
      </div>
          
          <div class="form-group">
                {!!Form::label('Resume','Resumen')!!}
                {!!Form::textarea('resumen',$resumen,['class'=>'form-control'])!!}
                <script  type = "text/javascript" > 
                  CKEDITOR.replace (  'resumen'  ); 
                  CKEDITOR.add            
                </script>
          </div>

          <div class="form-group">
                {!!Form::label('Resume','Contenido')!!}
                {!!Form::textarea('content',$content,['class'=>'form-control'])!!}
                <script  type = "text/javascript" > 
                  CKEDITOR.replace (  'content'  ); 
                  CKEDITOR.add            
                </script>
          </div>

       

          {!!Form::submit( $botonTitulo,['class'=>'btn btn-primary'])!!}
           {!! link_to('admin/document', 'Cancelar',array('class'=>'btn btn-danger')) !!}

        {!!Form::close()!!} 
          
  </div>
  <br><br>
</div>
  @stop
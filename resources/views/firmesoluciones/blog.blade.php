@extends('firmesoluciones.index')
@section('home')
<?php 
  $band=Session::get('band');
   ?>
    <!-- Page Content -->
    <div class="container">
    <div class="breadcrumb">
      @foreach($uris as $uri)
        {!! $uri !!}
      @endforeach                
    </div>        
   <hr>
        <div class="row">
        <div class="col-md-8" style="text-align: justify;">     
  @if(isset($Documents))
    @foreach($Documents as $Doc)
      <h4><?php echo $Doc->title; ?> </h4>
      <p>
        <?php 
        	if($Doc->main_picture!="")
           {
            	echo ("<img src='../".$Doc->main_picture."' >");
            };
         ?>
      </p>
                
      <p>
         <?php 
          echo $Doc->resumen;
         ?>
      </p>
      @if(!isset($post))
          @if($Doc->content!="")
           <p class="text-left">
           <a href="Blog/<?php echo $Doc->uri; ?>">Ver más</a>
           </p>
          @endif
          @else
            <p>
             <?php 
              echo $Doc->content; ?>
              <br>
              <hr>
      @if(Session::has('message'))
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span>
            </button>
            {{Session::get('message')}}
          </div>
      @endif 

     <p class="comentario">Comentarios: <?php echo $cont->user_count;  ?></p>  

        @foreach($coments as $coment)
          @if($coment->iddoc==$Doc->id)
              <div class="comments-container">
                <ul id="comments-list" class="comments-list">
                  @if($coment->id_comment==0)
                    <li>
                        <div class="comment-main-level">     
                              <!-- Contenedor del Comentario -->
                              <div class="comment-box">
                                  <div class="comment-head">
                                      <h6 class="comment-name by-author"><a href=""><?php echo $coment->mail; ?></a>
                                      </h6>
                                      <span><?php echo $coment->created_at;  ?></span>
                                      <i class="fa fa-reply">
                                           <?php  $Uri = 'Blog/'. $Doc->uri;   ?>
                                        {!!link_to('admin/commentresp/'.$coment->id.'/'.$Doc->uri, 'Responder',array('class'=>'')) !!}
                                        </i>
                                      <i class="fa fa-heart"></i>
                                  </div>
                                      <div class="comment-content">
                                        <?php echo $coment->content;  ?>
                                      </div>
                              </div>
                        </div>
                        @if($band!=null &&$band==$coment->id  ) 
                        <br>        
                            @include('frontend.formcomentarios')
                            <br>
                        @endif
                  @endif
                        @foreach($coments as $coment2)     
                            @if($coment->id==$coment2->id_comment &&$coment->id!=$coment2->id)
                                <!--    Respuestas de los comentarios -->
                                <br>
                                 <ul class="comments-list reply-list">
                                      <li>     
                                          <!-- Contenedor del Comentario -->
                                          <div class="comment-box">
                                             <div class="comment-head">
                                                  <h6 class="comment-name"><a href=""><?php echo $coment2->mail; ?></a></h6>
                                                  <span><?php echo $coment2->created_at;  ?></span>
                                                  <i class="fa fa-reply"></i>
                                                  <i class="fa fa-heart"></i>
                                             </div>
                                             <div class="comment-content">
                                                  <?php echo $coment2->content;  ?>
                                             </div>
                                         </div>
                                     </li>
                                 </ul>
                            @endif
                        @endforeach
                    </li>
                </ul>
              </div>
                    <!--termina maquetacion -->
                      
          @endif
        @endforeach
      
        @if($band==null)         
            @include('firmesoluciones.formcomentarios')
        @endif
                               
        @endif            
        <br> 
    @endforeach
   @else
    <br>
    <br>
    <br>
    <br>                          
    <h2>No existe contenido en esta sección</h2>
  @endif

</div>
  <div class="col-md-4">
    @include('frontend.frmcotizacion')
  </div>
<div>
  {{$Documents->render()}}
</div>
</div>
</div>
@stop
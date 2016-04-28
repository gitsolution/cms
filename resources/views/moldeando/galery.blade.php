@extends('moldeando.index')
@section('maincontent')
<br>
<div class="container">
  <?php $cont=0;  $aux=0;?>
  @if($band==1) 
      <div class="row text-center">
            {{$media->render()}}
      </div>
    @foreach($media as $med)
      @if($cont==3)
      	<?php echo "&nbsp<br>" ?>
      @endif
      @if($media!=null)
        @if($med->pic==null)
                  <div class="col-md-4">
                    <div class="panel-heading">                                  
                            <?php echo $med->title?>
                    </div> 
                      <img class=" img-center" width="100%"; height="180px" src="../../../store/CAT/		nodisponible.png ?>">
                    <div class="panel-footer">
                           <?php echo $med->description?> 
                    </div>
                  </div>
        @else
        @if($med->id==$med->idal && $aux!=$med->id && $med->pic!=null)
                <div class="col-md-3 ">
        				  <?php echo $med->title?>
                  <div class="panel panel-primary shadow" >
                    <a href="Galleries/<?php echo $med->uri?>">  		
                       <img class=" img-center" width="100%" height="150px" id="idImagen" src="<?php echo $med->pic?>" alt="">   
                          
                    </a>  
             		  </div>

                </div>
                <?php $cont++; ?>                    
                <?php $aux=$med->id; ?>
        @endif
        @endif
      @else  
         	     <br> 
               <h2>No existe contenido en esta sección</h2>
      @endif
    @endforeach
  @endif

    @if($band==0)
      <div class="row text-center">
         {{$items->render()}}
      </div>
     
      @foreach($items as $pics)
        @if($cont==4)
          <?php echo "&nbsp;<br>" ?>
        @endif       
        <div class="col-md-3">
          <div class="" style="width:240px;">
            <div class="panel panel-primary shadow">
              <a href="<?php echo $pics->path?> " data-lightbox="Galeria" data-title="<?php echo $pics->title?>"> 
              <img class=" img-center" width="100%" height="150px" src="<?php echo $pics->path?>" alt=""></a>
            </div>
            <div style="background:#eee;border:1px solid #ccc;padding:5px 10px; height:150px; ">
            <?php echo $pics->title?><br><?php echo $pics->description?>
            </div>
          </div>
        </div>
         <?php $cont++; ?>                    


@endforeach
      
<br><br><br><br>
@endif


 </div>
@stop

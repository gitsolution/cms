
@if(count($media)==0)
   <center><h2 class="text-encabezados-red">No se ha establecido Albúm para esta seccion.</h2></center>   
@else
 <div id="carrusel-1" class="carousel slide" data-ride="carousel">      
    <!--Indicadores-->
   
    <ol class="carousel-indicators">
       <?php $i=0;?>
       @foreach($media as $imagen)
          <li data-target="#carrusel-1" <?php if($i==0){ echo ' data-slide-to="0" class="active"'; }else{echo  "data-slide-to='".$i."'";  } ?>></li>
      <?php $i++; ?>
       @endforeach
    </ol>
    
    <!--Contenedor e los slide-->
    <div class="carousel-inner sliderContent " style="" role="listbox" >
      <?php $i=0;?>
      @foreach($media as $imagen)
         @if($i==0)
            <div class="item active">
         @else
            <div class="item ">
         @endif
              <center>
               <img src='{{$imagen->pic}}' class="img-responsive " alt=""  />
               <div class="carousel-caption hidden-xs">
               </div>
              </center>
            </div>
       <?php $i++; ?>
       @endforeach
    
    </div> 

  </div>
@endif

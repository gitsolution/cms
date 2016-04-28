
<?php
        $album="GALERIA1";
        $flag='1';  
        $band='1';  
        $publish='1';  
        $media=null;

        $media =  DB::table('med_albums')
            ->join('med_pictures', 'med_albums.id', '=', 'med_pictures.id_album')            
            ->select('med_albums.*', 'med_pictures.path as pic', 'med_pictures.id_album as idal')        
            ->where('med_albums.active','=', $flag)
            ->where('med_albums.publish','=', $publish)
            ->where('med_pictures.active','=', $flag)   
            ->where('med_pictures.publish','=',$publish)
            ->where('med_albums.title','=',$album)        
            ->orderBy('med_albums.order_by','DESC')->paginate(20);
?>

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
    <div class="carousel-inner " style="background:rgb(12,12,23)" role="listbox">
      <?php $i=0;?>
      @foreach($media as $imagen)
         @if($i==0)
            <div class="item active">
         @else
            <div class="item ">
         @endif
              <center>
               <img src='{{$imagen->pic}}' class="img-responsive " alt=""/>
               <div class="carousel-caption hidden-xs">
               </div>
              </center>
            </div>
       <?php $i++; ?>
       @endforeach
    
    </div> 

  </div>


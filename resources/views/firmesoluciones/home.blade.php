@extends('firmesoluciones.index')
@section('home')
     <div class="content">
      <div class="top-grids">
        <div class="wrap">          
         @if($Services!=null)
         @foreach($Services as $Ser) 
            <div class="top-grid">
              @if($Ser->main_picture!="")
            <img class="img-center" src='<?php echo $Ser->main_picture; ?>' alt="">
              @endif  
            <h3> <?php echo $Ser->title;  ?></h3>
            <?php echo $Ser->resumen;  ?>              
            <a class="button" href="">Leer más</a>              
            </div>
          @endforeach
        @endif
        <div class="clear"> </div>
      </div>
      </div>


      <!---start-mid-grids---->
      <div class="mid-grids">
        <div class="wrap">
         @if($Categories!=null)
         @foreach($Categories as $Cat) 
            <div class="mid-grid">
              @if($Cat->main_picture!="")
              <img class="img-center" src='<?php echo $Cat->main_picture; ?>' alt="">
              @endif  
              <h3> <?php echo $Cat->title;  ?></h3>
              <p>    
                  <?php echo $Cat->resumen;  ?>
              </p>              
          </div>
          @endforeach
        @endif           

        <div class="clear"> </div>
        </div>
      </div>
      <!---End-mid-grids---->      
      <div class="box">
        <div class="wrap">
          <div class="gallery">
            <h3>Galeria</h3>
            <ul>
             @include('firmesoluciones.indexgal')
            </ul>
          </div>
          <script type="text/javascript" src="../js/jquery.lightbox.js"></script>
            <link rel="stylesheet" type="text/css" href="../css/lightbox.css" media="screen">
            <script type="text/javascript">
            $(function() {
                $('.gallery a').lightBox();
            });
            </script>
          <div class="terminals">
            <h3>Datos de contacto</h3>
            <p>
              Actualmente la empresa cuenta con 32 sucursales las cuales se encuentran en cada uno de los estados de la Republica Mexicana.              
            <br>

            <br>

            </p>
            <span><a href="Contacto">Contactanos para mejorar tu atención</a></span>
          </div>
          <div class="clear"> </div>
        </div>
  </div> 
      <!---start-articals------>
   
@stop
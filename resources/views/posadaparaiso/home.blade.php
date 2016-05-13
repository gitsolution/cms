@extends('posadaparaiso.index')
@section('maincontent')


<div >
   @include('posadaparaiso.sliderShow')
</div>



<div class="ladrillos container-fluid " id="#Reservacion" >
    
    <!--para el mensaje de paypal-->
    @if(\Session::has('message'))
    <div class="alert alert-primary style-alert-orange alert-dismissible text-center" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <h2><strong><i class="fa fa-info-circle"></i></strong> {{ \Session::get('message') }}</h2>
    </div>    
    @endif
    @include('posadaparaiso.frmreservaenlinea-horizontal')
</div>

<div class="bienbenido-al-paraiso">
  <div class="container-fluid">
      <br>
      <div class="container "><!--<div class="container marco-transparente">-->
      <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10 " ><br>
          <h1 class="text-encabezados-red">{{trans('posadapraiso/pagina_index.bienvenidoalparaiso')}}</h1>
          <div class="row"><br>

                <div class="col-md-4 " >    
                   <div class="img-with-text">
                      <?php $album=$albumGaleryTours;  
                      $imageOfAlbumPath="img-posadaparaiso/tours.png";
                      $albumTitle=trans('posadapraiso/pagina_index.tours');
                      ?>
                      @include('posadaparaiso/modalGallery')
                   </div>
                 
                </div> 

                <div class="col-md-4 " >  
                   <div class="img-with-text">  
                     <!--<img class="img-center img-responsive " src="img-posadaparaiso/servicios.png" alt="">-->
                      <?php $album=$albumGaleryServices; 
                      $imageOfAlbumPath="img-posadaparaiso/servicios.png";
                      $albumTitle=trans('posadapraiso/pagina_index.servicios');
                      ?>
                      @include('posadaparaiso/modalGallery')
                  </div>
                 
                </div>
                <div class="col-md-4 ">    
                    <div class="img-with-text">
                      <?php $album=$albumGaleryRooms; 
                      $imageOfAlbumPath="img-posadaparaiso/habitaciones.png";
                      $albumTitle=trans('posadapraiso/pagina_index.habitaciones');
                      ?>
                      @include('posadaparaiso/modalGallery')
                    </div>
                </div>

            <div class="clear"> </div>  
          </div>
      </div>
    </div>
      </div>
  </div>  
  <br>
</div>

<div> </div>

<div class="suscribete " id="Suscripcion">
    @include('posadaparaiso.frmsuscribete')
</div>

<div id="History" ></div><!--Anclas para los diferentes idiomas-->
<div id="histoire" ></div>
<div class="historia-hotel container-fluid" id="Historia" >
<div class="container" >
  <div class="row">
       <div class="col-md-1"></div>
       <div class="col-md-10 text-justify">
          @if($sectionHistory != null)
              <?php
              echo "<h2>".$sectionHistory->title."</h2>"; 
              echo $sectionHistory->resumen;
                ?>
          @endif
       </div>
  </div>
</div>
</div>



<div class="ladrillos container-fluid promociones">
</div>
<div class="banner-promo" >
        <p class="text-encabezados-orange" >{{trans('posadapraiso/pagina_index.promociones')}}</p>
        <p class="text-encabezados-red">{{trans('posadapraiso/pagina_index.lasmejoresofertas')}}</p>
      
</div>

<div class="ladrillos container-fluid promociones">
   <div class="container-fluid">
      <div class="row  ">
          <div class="col-md-2"></div>
          <div class="col-md-8 ">
              <div class="row">
                <div class="col-md-4">    
                    <img class="img-center img-responsive" src="img-posadaparaiso/paraisonaranja-16.png" alt="">
                </div>
                <div class="col-md-4">    
                     <img class="img-center img-responsive" src="img-posadaparaiso/paraisonaranja-17.png" alt="">
                </div>
                <div class="col-md-4">    
                    <img class="img-center img-responsive" src="img-posadaparaiso/paraisonaranja-18.png" alt="">
                </div>
              </div>
          
          </div>
        <div class="clear"> </div>  

      </div>
   </div>
</div>


<div class="container-fluid contacto">
   <div class="container-fluid">
      <div  id="Contact"></div>
      <div class="row" id="Contacto" >
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-8 text-justify pull-right" >
                <!--<h2>{{trans('posadapraiso/pagina_index.contactanos')}}</h2> -->
                <p>
                   @if($sectionContact != null)
                      <?php echo "<h2>".$sectionContact->title."</h2>"; 
                       echo $sectionContact->resumen;  ?>
                   @endif
                </p>
                </div> 
              </div>  
            </div>

            <div class="col-md-6 "> 
               <div class="row">
                   <div class="col-md-8 form-naranja" >
                   @include('posadaparaiso.frmcontacto') 
                 </div>
               </div>
            </div>
      </div>
   </div>
</div>




<div class="container-fluid ubicacion">
   <div class="container-fluid">
      <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-8 text-justify pull-right" >
                <!--<h2 class="text-encabezados-red">{{trans('posadapraiso/pagina_index.ubicacion')}}</h2> -->
                <p>
                     @if( $sectionLocation != null)
                       <?php echo "<h2 class='text-encabezados-red'>".$sectionLocation->title."</h2>";  
                       echo  $sectionLocation->resumen;  ?>
                     @endif
                </p>
                
                </div> 
              </div>  
            </div>

            <div class="col-md-6 "> 
               <div class="row">
                   <div class="col-md-8 " >
                      <div class="map">
                          <iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.7776092732306!2d-92.64128388560663!3d16.73794462561624!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ed451623e1b687%3A0x5d1bcf0e1d4c926d!2sHOTEL+POSADA+PARAISO!5e0!3m2!1ses-419!2smx!4v1462561284043"  frameborder="0" style="border:0" allowfullscreen></iframe>       
                      </div>
                   </div>
               </div>
            </div>
      </div>
   </div>
</div>


<div id="wrap">

@stop
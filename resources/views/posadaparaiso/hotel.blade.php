@extends('posadaparaiso.index')
@section('maincontent')
<div>
  @include('posadaparaiso.sliderShow')
</div>



<div class="container-fluid ubicacion">
   <div class="container-fluid">
      <div class="row">
            <div class="col-md-6">
              <div class="row">
                <div class="col-md-10 text-justify pull-right" >
                     
                     <div class="row">
                        <div class="col-md-12">
                           @if( $sectionHotel != null)
                                <?php echo  "<h2 class='text-encabezados-red' >".$sectionHotel->title."</h2>";
                                echo  $sectionHotel->resumen;  ?>
                           @endif 
                        </div>

                     </div><br>
                   <div  id="Galery"></div><!--Anclas para los idiomas-->
                   <div  id="Galerie"></div>
                   <h2 class="text-encabezados-red text-center" id="Galeria" >Galeria</h2>
                     <div class="form-naranja text-center"><h4>Hotel</h4></div>  <br>
                     

                     <div class="row">
                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>

                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                     </div><br>
                
                     <div class="row">
                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>

                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                     </div>
                
                
                </div> 



                <div class="col-md-10 text-justify pull-right" >
                     <br><br><br><br><br><br>
                     <div class="form-naranja text-center"><h4>Habitaciones</h4></div> <br> 
                    

                     <div class="row">
                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>

                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                     </div><br>
                
                     <div class="row">
                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>

                        <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                         <div class="col-md-3">
                          <img src="img-posadaparaiso/galeria/1.jpg" class="img-responsive"> 
                        </div>
                     </div>
                
                
                </div> 

              </div>  
            </div>

            @include('posadaparaiso.slaiderderecho');
      
   </div>
</div>


<div id="wrap">

@stop
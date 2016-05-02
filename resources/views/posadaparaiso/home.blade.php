@extends('posadaparaiso.index')
@section('maincontent')
<div >
   @include('posadaparaiso.sliderShow')

</div>


<div class="ladrillos container-fluid " >
    @include('posadaparaiso.frmreservaenlinea-horizontal')
</div>

<div class="bienbenido-al-paraiso">
  <div class="container-fluid">
      <div class="container">
      <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-10"><br>
          <h1 class="text-encabezados-red">{{trans('posadapraiso/pagina_index.bienvenidoalparaiso')}}</h1>
          <div class="row"><br>

                <div class="col-md-4 " >    
                   <img class="img-center img-responsive " src="img-posadaparaiso/tours.png " alt="">
                   <div class="form-gris text-center"><h4>{{trans('posadapraiso/pagina_index.tours')}}</h4></div>
                </div> 

                <div class="col-md-4">    
                   <img class="img-center img-responsive " src="img-posadaparaiso/servicios.png" alt="">
                   <div class="form-gris text-center"><h4>{{trans('posadapraiso/pagina_index.servicios')}}</h4></div>
                </div>
                <div class="col-md-4">    
                    <img class="img-center img-responsive" src="img-posadaparaiso/habitaciones.png" alt="">
                    <div class="form-gris text-center"><h4>{{trans('posadapraiso/pagina_index.habitaciones')}}</h4></div>
                </div>

            <div class="clear"> </div>  
          </div>
      </div>
    </div>
      </div>
  </div>  
</div>

<div> </div>

<div class="suscribete ">
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
                          <iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.662324682381!2d-93.12475138457738!3d16.74369218846735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd85ed3ba7b1f%3A0x68cae440f6bdb040!2s13A.+Sur+Pte+640%2C+San+Francisco%2C+29000+Tuxtla+Guti%C3%A9rrez%2C+Chis.!5e0!3m2!1ses-419!2smx!4v1458274272743"  frameborder="0" style="border:0" allowfullscreen></iframe>       
                      </div>
                   </div>
               </div>
            </div>
      </div>
   </div>
</div>


<div id="wrap">

@stop
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
            

                  <div id="Rooms"></div><!--Anclas para los idiomas-->
                  <div id="Chambres"></div>
                  <div class="thumbnail sectionRooms" id="Habitaciones" >
                    <!--<h2 class="text-encabezados-red">{{trans('posadapraiso/pagina_restaurant.habitaciones')}}</h2>-->
                      <div class="caption"> 
                        <p class="text-justify clearfix parrafo ">
                        @if( $sectionRooms != null)
                          <?php echo  "<h2 class='text-encabezados-red'>".$sectionRooms->title."</h2>"; 
                           echo  $sectionRooms->resumen;  ?>
                        @endif
                       </p>
                      </div>
                
                  </div>



                </div> 
              </div>  
            </div>

           
      </div>
   </div>
</div>


<div id="wrap">

@stop
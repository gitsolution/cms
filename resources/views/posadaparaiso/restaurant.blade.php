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
                  <div class="thumbnail ">
                     <h2 class="text-encabezados-red">{{trans('posadapraiso/pagina_restaurant.restaurante')}}</h2>
               
                     <img src="img-posadaparaiso/restaurante3.jpg" class="img-responsive"/>
                     <div class="caption"> 
                     <p class="text-justify clearfix parrafo ">
                        @if( $sectionRestaurant != null)
                          <?php echo  $sectionRestaurant->resumen;  ?>
                        @endif
                     </p>
                     </div>
                
                  </div>



                </div> 
              </div>  
            </div>

            @include('posadaparaiso.slaiderderecho');
      </div>
   </div>
</div>


<div id="wrap">

@stop
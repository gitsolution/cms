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
                    
                    <?php $i = 0; ?> 
                    @if($albumGaleryHotel!=null)
                    @foreach($albumGaleryHotel as $picture)
                       @if($i==3)
                            <div class="row">
                       @endif
                        <div class="col-xs-3 col-md-3 " >
                           <div class="container-image">
                           <a class="example-image-link " href='{{$picture->pic}}' data-lightbox="example" data-title="" >
                              <div class="modal-content" > <img class="example-image img-thumbnail" src='{{$picture->pic}}' alt=""/></div>
                           </a>
                           </div>
                        </div>

                        @if($i==3)
                            </div><br>
                        @endif

                      <?php $i++; ?>
                      @endforeach
                    @endif  
                    {{$albumGaleryHotel->render()}}
                
                </div> 



                <div class="col-md-10 text-justify pull-right" >
                     <br><br><br><br><br><br>
                     <div class="form-naranja text-center"><h4>Habitaciones</h4></div> <br> 
                    

                     <?php $i = 0; ?> 
                    @if($albumGaleryRooms!=null)
                    @foreach($albumGaleryRooms as $picture)
                       @if($i==3)
                            <div class="row">
                       @endif
                        <div class="col-xs-3 col-md-3 Thumbnail ">
                          
                           <a class="example-image-link " href='{{$picture->pic}}' data-lightbox="example-set" data-title="" >
                              <div class="modal-content" style="height:40%"> <img class="example-image img-thumbnail" src='{{$picture->pic}}' alt=""/></div>
                           </a>
          
                        </div>

                        @if($i==3)
                            </div><br>
                        @endif

                      <?php $i++; ?>
                      @endforeach
                    @endif 
                
                {{$albumGaleryRooms->render()}}
                </div> 

              </div>  
            </div>

            @include('posadaparaiso.slaiderderecho');
      
   </div>
</div>


<div id="wrap">

@stop
  <!--Ventana modal para mostrar un album-->
   
   @if(! isset($albumTitle))
     <?php $albumTitle="Albúm";?>
   @endif   
                    <?php $i = 0; ?> 
                    @if($album!=null)
                    @foreach($album as $picture)
                
                           <div class="container-image">
                           <a class="example-image-link " href='{{$picture->pic}}' data-lightbox="{{$imageOfAlbumPath}}" data-title="" >
                              @if($i==0)
                              <div class="modal-content" > <img class="example-image img-responsive" src='{{$imageOfAlbumPath}}' alt=""/></div>
                               <div class="form-gris text-center"><h4>{{$albumTitle}}</h4></div>
                              @endif
                           </a>
                           </div>

                      <?php $i++; ?>
                      @endforeach
                    @else
                       @if($imageOfAlbumPath != null)
                          <div class="modal-content" > <img class="example-image img-responsive" src='{{$imageOfAlbumPath}}' alt=""/></div> 
                       @endif
                    @endif  
                    {{$album->render()}}



@if(count($album) < 1 || $album == null)
     @if($imageOfAlbumPath != null)
        <div class="modal-content" > <img class="example-image img-responsive" src='{{$imageOfAlbumPath}}' alt=""/></div> 
        <div class="form-gris text-center"><h4>{{$albumTitle}}</h4></div>
     @endif
@endif




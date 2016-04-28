@extends('moldeando.index')
@section('maincontent')
<?php $cont=0; $rand2=0; $cont2=0;?>

  <!-- Header Carousel -->
    <header id="myCarousel" class=" container carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                 <img src="img-moldeando/img1.png" class="img-responsive">
            </div>
            <div class="item">
                 <img src="img-moldeando/img1.png" class="img-responsive">
            </div>
            <div class="item">
                 <img src="img-moldeando/img1.png" class="img-responsive">
            </div>
        </div>
        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span></a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span></a>
    </header>
<div class="historia container ">
<div class="container">
  <div class="container">
    <div class="">
         @if($Categories!=null)
         @foreach($Categories as $Ser)   
            <div class="col-md-3 contenedor <?php echo "colorcon".$cont;?>" > 
              <h3 class="text-center"><?php echo $Ser->title; ?>  </h3>
              <?php echo $Ser->resumen;  ?>
               @if($Ser->content!="")
                                <p class="text-left">
                                <a href="Cat/<?php echo $Ser->uri; ?>">Ver más</a>
                                </p>
                              @endif
              <?php $cont++; ?>   
            </div>
          @endforeach
        @endif
        <div class="clear"> </div>  
    </div>
  </div>
</div>
</div>
 <div class="separador"> </div>  

<div class="container  ">
<div class="container">
  <div class="container">
  <div class="col-md-1"></div>
    <div class="col-md-3 ">
      <div class="categos">
          <div class="bannt text-center"><p>Noticias</p></div>
            @if($noticias!=null)
              <div id="notic" class="carousel slide">
                <div class="carousel-inner ">
                 @foreach($noticias as $not)  
                    <div <?php if($cont2==0){ echo 'class="item active"';}else{echo 'class="item"';}?>>
                        @if($not->main_picture!="")
                          <img class="img-center" style="height:230px; width:100%; " src='<?php echo $not->main_picture; ?>'>
                        @endif
                        <div style="height: 230px">
                            <h5 class="padin"><?php echo $not->title; ?>  </h5>
                             <div class="marg"> <?php echo $not->resumen;  ?></div>
                              @if($not->content!="")
                                <p class="text-left">
                                <a href="Cat/<?php echo $not->uri; ?>">Ver más</a>
                                </p>
                              @endif
                        </div>
                    </div>
                    <?php $cont2++; ?>     
                  @endforeach
                </div>  
              </div>
            @endif
      </div>
    </div>
    <div class="col-md-3">
      <div class="categos">
        <div class="banev text-center"><p>Eventos</p></div>
          @if($eventos!=null)
            <div id="event" class="carousel3 slide">
              <div class="carousel-inner ">
              <?php $cont3=0?>
               @foreach($eventos as $events)  
                  <div <?php if($cont3==0){ echo 'class="item active"';}else{echo 'class="item"';}?>>
                   <div style="height: 230px">
                        <h5 class="padin"><?php echo $events->title; ?>  </h5>
                         <div class="marg"> <?php echo $events->resumen;  ?></div>
                          @if($events->content!="")
                                <p class="text-left">
                                <a href="Cat/<?php echo $events->uri; ?>">Ver más</a>
                                </p>
                          @endif
                    </div>
                    @if($events->main_picture!="")
                      <img class="img-center" style="height:230px; width:100%; " src='<?php echo $events->main_picture; ?>'>
                    @endif
                  </div>
                  <?php $cont3++; ?>   
                @endforeach
              </div>  
            </div>
          @endif
      </div>    
    </div>
    <div class="col-md-3">
      <div class="categos">
          <div class="banpro text-center"><p>Proyectos</p></div>
            @if($proyectos!=null)
                <div id="pro" class="carousel2 slide">
                  <div class="carousel-inner ">
                  <?php $cont3=0?>
                   @foreach($proyectos as $pro)  
                      <div <?php if($cont3==0){ echo 'class="item active"';}else{echo 'class="item"';}?>>
                          @if($pro->main_picture!="")
                            <img class="img-center" style="height:230px; width:100%; " src='<?php echo $pro->main_picture; ?>'>
                          @endif 
                        <div style="height: 230px">
                            <h5 class="padin"><?php echo $pro->title; ?></h5>
                            <div class="marg"><?php echo $pro->resumen;  ?></div>
                            @if($pro->content!="")
                                <p class="text-left">
                                <a href="Cat/<?php echo $pro->uri; ?>">Ver más</a>
                                </p>
                            @endif
                        </div>
                      </div>
                      <?php $cont3++; ?>   
                    @endforeach
                  </div>  
                </div>
            @endif
      </div>
    </div>
  </div>
</div>
</div>
<br>
<br>

@stop
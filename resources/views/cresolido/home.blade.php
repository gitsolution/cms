@extends('cresolido.index')
@section('maincontent')
<div>

   <div id="inicio" id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <!-- Wrapper for Slides -->
        <div class="carousel-inner">
            <div class="item active">
                <img src="img-cresolido/img1.png" class="img-responsive">
                <div class="carousel-caption">
                  
                </div>
            </div>
            <div class="item">
               <img src="img-cresolido/img1.png" class="img-responsive">
                <div class="carousel-caption">
                   
                </div>
            </div>
            <div class="item">
               <img src="img-cresolido/img1.png" class="img-responsive">
               <div class="carousel-caption">
                   
                </div>
            </div>
        </div>
    </div>  
</div>
<div class="baner1">
  <h2>Nuestra Historia</h2>
</div>
<div class="historia container-fluid ">
<div class="container-fluid">
  <div class="row">
         @if($Services!=null)
         @foreach($Services as $Ser) 
            <div class="col-md-6">    
              @if($Ser->main_picture!="")
            <img class="img-center" src='<?php echo $Ser->main_picture; ?>' alt="">
              @endif  
            <?php echo $Ser->resumen;  ?>
            </div>
            <div class="col-md-6">
              <?php echo $Ser->content;  ?>
            </div>
          @endforeach
        @endif
        <div class="clear"> </div>  
  </div>
</div>
</div>
<div id="wrap">
<div class="content-bottom">
      <div class="map">
      <iframe width="100%" height="400" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.662324682381!2d-93.12475138457738!3d16.74369218846735!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd85ed3ba7b1f%3A0x68cae440f6bdb040!2s13A.+Sur+Pte+640%2C+San+Francisco%2C+29000+Tuxtla+Guti%C3%A9rrez%2C+Chis.!5e0!3m2!1ses-419!2smx!4v1458274272743"  frameborder="0" style="border:0" allowfullscreen></iframe>       
       </div>
    </div>
</div>
@stop
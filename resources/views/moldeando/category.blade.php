@extends('moldeando.index')
@section('maincontent')
    <!-- Page Content -->
    <div class="container">
        <div class="container">
        <div class="">
          <div class="col-md-9" style="word-wrap: break-word; text-align: justify;">
            @if($Categories!=null)
              @foreach($Categories as $Cat) 
                <h2> <?php echo $Cat->title;  ?></h2>                
                @if($Cat->main_picture!="")
                <p>
                  <img class="img-center" style="width: 100%; height: 350px;" src='../<?php echo $Cat->main_picture; ?>' alt="">
                </p>
                @endif

                <p>    
                  <?php echo $Cat->resumen;  ?>
                </p>
                <p>    
                  <?php echo $Cat->content;  ?>
                </p>              
              @endforeach

              @else
               <br><br><br><br>
                <h2>No existe contenido en esta sección</h2>
              @endif           
            </div>
    <div class="col-md-3">
      <div class="popular">
        <h4>Populares</h4>
          <hr>
        @if($Popular!=null)
          @foreach($Popular as $Popu) 
           <a href="<?php echo $Popu->uri; ?>">
           <div class="conpopu">
           <div class="col-md-3">
            @if($Popu->main_picture!="")
              <img class="img-center imgpop" src='../<?php echo $Popu->main_picture; ?>' alt="">
            @endif
            </div>
            <div class="col-md-9">
            <h5> <?php echo $Popu->title;  ?></h5>                
              
            </div>
            </div>
            </a>
          @endforeach
        
        @else
         <h4>No existe contenido en esta sección</h4>
        @endif 
      </div>
  </div>
        </div>
           </div>
<div class="row">
  {{$Categories->render()}}
</div>
 </div>
@stop



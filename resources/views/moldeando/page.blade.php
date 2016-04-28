@extends('moldeando.index')
@section('maincontent')
<div class="container">
  <div class="container">
    <div class="wrap">
        <div class="">      
          @if($Sections!=null)
            @foreach($Sections as $Sec) 
              <div class="page <?php echo $Sec->uri; ?>" style="text-align: justify;">     
                <div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">
                    <h2><?php echo $Sec->title; ?></h2> 
                </div>
                      @if($Sec->main_picture!="")
                          <img class="posimg" src='<?php echo $Sec->main_picture; ?>'>
                      @endif   
                <div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">
                  <?php echo $Sec->resumen; ?>            
                  <?php echo $Sec->content; ?> 
                </div>
                    <br>
            @endforeach   
          @endif
              </div>
             
          <div class="container-fluid wrapworl">
            <div class=" ">
              @if($Categories!=null)
                @foreach($Categories as $Ser)
                  <div class="row">
                  <div class="col-md-3   <?php echo $Sec->uri; ?>">
                    <div class="imgpage">
                      @if($Ser->main_picture!="")
                         <img class="img-center  img-responsive" style="height: 230px;" src='<?php echo $Ser->main_picture; ?>' alt="">
                      @endif  
                    </div>
                  </div>
                  <div class="col-md-8">
                    <h2 id="<?php echo $Ser->uri; ?>">   <?php echo $Ser->title; ?></h2>
                  <div style="background:#eee;border:1px solid #ccc;padding:5px 10px;">
                    <?php echo $Ser->resumen;  ?>
                    <?php echo $Ser->content;  ?>
                  </div>
                  </div>
                </div>
                <hr>
                @endforeach
              @endif
                <div class="clear"> </div>  
            </div>
          </div>

        @if($Categories==null && $Sections==null )
            <br><br>
          <h2 class="noexiste">No existe contenido en esta sección</h2>
          <br><br>
          
        @endif
    </div>
    </div>
  </div>
</div>

 
@stop

@extends('cresolido.index')
@section('maincontent')
<?php $bandera=0;?>
<div class="container-fluid">
  <div class="container">
    <div class="wrap">
        <div class="row">      
          @if($Sections!=null)
            @foreach($Sections as $Sec) 
          <div class="col-md-9 page <?php echo $Sec->uri; ?>" style="text-align: justify;">     

                    <h2>   <?php echo $Sec->title; ?></h2>  
                    <br>              
                  	<p>
                       <?php if($Sec->main_picture!=""){ echo ("<img class='img-responsive' src='".$Sec->main_picture."' >"); } ?>
                    </p>                
                  	<p>
                      <?php echo $Sec->resumen; ?>
                    </p>
                    <p> <?php echo $Sec->content; ?> </p> 
                    <br>
            @endforeach   
            @if($mapa=='Cobertura')
       <iframe src="https://www.google.com/maps/d/embed?mid=z0JrnlEslgEo.k-2YNaeTsdPc" width="100%" height="480"></iframe>
            @endif 
          @endif
      
      <div class="container-fluid wrapworl">
          <div class="row empresa">
         @if($Categories!=null)
         @foreach($Categories as $Ser)
            
            <div class="col-md-11 sectiones  <?php echo $Sec->uri; ?>">
            <div class="hr"></div> 
            @if($Ser->main_picture==null)
            <h2 id="<?php echo $Ser->uri; ?>">   <?php echo $Ser->title; ?></h2>
            @endif
            @if($mapa=='Informacion')
            
            <div id="<?php echo $Ser->uri.'a'; ?>" class="grales">
            <div class="datos">
            @endif
            <div class="imgpage">
              @if($Ser->main_picture!="")
            <img class="img-center  img-responsive" src='<?php echo $Ser->main_picture; ?>' alt="">
              @endif  
              </div>  
            <?php echo $Ser->resumen;  ?>
            @if($mapa=='Informacion')
            
            </div>
            </div>
            @endif
            </div>
          @endforeach
      @endif
        <div class="clear"> </div>  
  </div>
</div>



        @if($Categories==null && $Sections==null )
            <br><br>
          <h2 class="noexiste">No existe contenido en esta sección</h2>
          <br><br>
          <?php $bandera=1;?>
        @endif
      </div>
      @if($bandera!=1)
      <div class="col-md-3 ">
       @include('cresolido.frmcotizacion')
       </div>
       @endif
    </div>
    </div>
  </div>
</div>

 
@stop
{!! Html::script('js-cresolido/jquery-2.1.1.min.js') !!}  

<script type="text/javascript">
$(document).ready(function(){
   $("#Datos-Generales").click(function(){
      document.getElementById('Datos-Generalesa').style.display="block";
       document.getElementById('Domiciliosa').style.display="none";
         document.getElementById('Funcionariosa').style.display="none";
       document.getElementById('Escriturasa').style.display="none";
      
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
   $("#Domicilios").click(function(){
      document.getElementById('Datos-Generalesa').style.display="none";
       document.getElementById('Domiciliosa').style.display="block";
       document.getElementById('Funcionariosa').style.display="none";
       document.getElementById('Escriturasa').style.display="none";
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
   $("#Funcionarios").click(function(){
      document.getElementById('Datos-Generalesa').style.display="none";
       document.getElementById('Domiciliosa').style.display="none";
       document.getElementById('Funcionariosa').style.display="block";
       document.getElementById('Escriturasa').style.display="none";
});
});
</script>
<script type="text/javascript">
$(document).ready(function(){
   $("#Escrituras").click(function(){
      document.getElementById('Datos-Generalesa').style.display="none";
       document.getElementById('Domiciliosa').style.display="none";
       document.getElementById('Funcionariosa').style.display="none";
       document.getElementById('Escriturasa').style.display="block";
});
});
</script>

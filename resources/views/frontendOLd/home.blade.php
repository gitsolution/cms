@extends('frontend.index')
@section('content')
<!-- Image Background Page Header -->
    <!-- Note: The background image is set within the business-casual.css file. -->
 <div class="breadcrumb">
        @foreach($uris as $uri)
        {!! $uri !!} /
      @endforeach 
    </div> 
    <header class="business-header">     
    <hr>
        <div class="container">           
        <img src="../img/microfinanzas.png" class="img-responsive" class="img">           
        </div>
    </header>
 <hr>
    <!-- Page Content -->
    <div class="container">
        <hr>
        <div class="row">
            <div class="col-sm-8" style="word-wrap: break-word; text-align: justify;">
                @if($Sections!=null)
                  @foreach($Sections as $Sec) 
                <h2>   <?php echo $Sec->title; ?></h2>
                <p>
                    <?php echo $Sec->resumen; ?>
                </p>
                <p>
                    <?php echo $Sec->content; ?>
                </p>
                @endforeach
            </div>
            <div class="col-sm-4" style="word-wrap: break-word; text-align: justify;">                
              <h3> Datos de Contacto</h3>
              <b>Mail: </b>contacto@valorproductivo.com.mx
				<br>              
              <b>Teléfono de atención al cliente: </b>01 962 625 3100.
              <br>
              <address style="word-wrap: break-word; text-align: justify;">
                <b>Dirección:</b> 6a Avenida Sur No.28-B, Col. Centro, Tapachula de Córdova y Ordóñez, Chiapas.
                </address>
            </div>
        </div>
    
	<br>
    <br>
    <br>
 
 <div class="form-group">
         @if($Categories!=null)
         @foreach($Categories as $Cat) 
            <div class="col-md-4" style="text-align: justify;">
              @if($Cat->main_picture!="")
    	        <img class="img-center" src='<?php echo $Cat->main_picture; ?>' alt="">
              @endif  
              <h2> <?php echo $Cat->title;  ?></h2>
            	<p>    
                  <?php echo $Cat->resumen;  ?>
              </p>
              <p>    
                  <?php echo $Cat->content;  ?>
              </p>
              
   			</div>
          @endforeach
        @endif           
  </div>
 
        @else
            <br><br><br><br>
          <h2>No existe contenido en esta sección</h2>
        @endif
        </div>
@stop
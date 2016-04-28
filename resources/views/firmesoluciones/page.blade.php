@extends('firmesoluciones.index')
@section('home')
    <!-- Page Content -->
    <div class="content">
      <div class="wrap">    
         <div class="row">
        

        <div class="col-md-8" style="text-align: justify;">     
         @if($Sections!=null)
                  @foreach($Sections as $Sec) 
                <h2>   <?php
                   
                    echo $Sec->title;
                     ?></h2>
                
          		<p>
                    <?php 
                    	if($Sec->main_picture!=""){
                    	echo ("<img src='".$Sec->main_picture."' >");
                    }; ?>
                </p>
                
          		<p>
                    <?php 
                    echo $Sec->resumen; ?>
                </p>
                <p>
                    <?php 
                    echo $Sec->content; ?>
                </p> 

                <br>
                @endforeach    
        @else
            <br><br><br><br>
          <h2>No existe contenido en esta sección</h2>
        @endif
            </div>

      <div class="col-md-4">
       @include('firmesoluciones.frmcotizacion')
       </div>
  </div>
 <div class="clear"> </div>
            </div>
        </div>

@stop
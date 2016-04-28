@extends('frontend.index')
@section('content')
    <!-- Page Content -->
    <div class="container">
    <div class="breadcrumb">
      @foreach($uris as $uri)
        {!! $uri !!}
      @endforeach                
    </div>    
     <hr>
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
 @include('frontend.frmcotizacion')
 </div>
            </div>
        </div>

@stop
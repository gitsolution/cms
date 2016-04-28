@extends('frontend.index')
@section('content')
    <!-- Page Content -->
    <div class="container">
 <hr>
        <div class="row">
        <div class="col-md-8" style="text-align: justify;">     
        @if(isset($Documents))
        @foreach($Documents as $Doc)
            <h4>   
            <?php echo $Doc->title; ?></h4>
          		<p>
                    <?php 
                    	if($Doc->main_picture!=""){
                    	echo ("<img src='".$Doc->main_picture."' >");
                    }; ?>
                </p>
                
          		<p>
                    <?php 
                    echo $Doc->resumen; ?>
                </p>
                @if(!isset($post))
                    @if($Doc->content!="")
                    <p class="text-left">
                    <a href="Blog/<?php echo $Doc->uri; ?>">Ver más</a>
                    </p>
                    @endif
                 @else
                    <p>
                    <?php 
                    echo $Doc->content; ?>
                </p>                 
                 @endif           
            <br>
    
            @endforeach
        @else
            <br>
            <br>
            <br>
            <br>                          
          <h2>No existe contenido en esta sección</h2>
        @endif
            </div>
<div class="col-md-4">
 
 @include('frontend.frmcotizacion')
 </div>
            </div>
        </div>

@stop
@extends('frontend.index')
@section('content')

    <div class="container">
      <div class="col-lg-8 col-lg-offset-2 text-center">
        <div class="logo">
         <br><h1>404</h1>
        </div>
        <p class="lead text-primary"><h1>Página no encontrada</h1></p><br>
        <p class="lead text-muted"><h3>Lo sentimos pero la página que busca  no existe o no se puede encontrar</h3></p>
        <div class="clearfix"></div>
        <br>
        <div class="col-lg-6 col-lg-offset-3">        
            {!!link_to('Inicio', 'Regresar',array('class'=>'btn btn-success')) !!}
        </div>
      </div>

    </div>
  @stop
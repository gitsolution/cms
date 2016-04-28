<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Microfinanciera, microcreditos, creditos en chiapas, grupo solidario">
    <meta name="author" content="">
    <title>Cresolido</title>
      {!!Html::style('../bower_components/font-awesome/css/font-awesome.min.css')!!}
    <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.css')!!}  
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css-cresolido/estilos.css')!!}  
</head>
<body>
<header>
     <img src="img-cresolido/logo-cresolido.png"  class="img-responsive">
</header>
    <nav class="navbar navbar-inverse menu navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->  
            <div class="navbar-header">
             <div class="row">
             <div class="derecha col-md-7" style="width: 235px; height: 50px;">
                     
                    </div>

              <div class="col-md-5">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                </div>
                </div>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                
                <ul class="nav navbar-nav">
                <li><a href="#">inicio</a></li>
                  @include('frontend.mainmenu')

                </ul>
            </div>
        </div>
    </nav>
<div id="wrap">
    <div id="main" class="clearfix">
        <div class="container"> 
        <br>
          @yield('content')
        </div>
    </div>
</div>
    
    <footer >
      <div class="container">
        <div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-6" >
             <p>Horario de atención <br> 8:30 - 16:00 hrs. de lunes a viernes</p> 
         
             <p>13 Sur Poniente, Número 640, <br>Barrio San Francisco <br>C.P 29066, Tuxtla Gutiérrez Chiapas.</p> 
          </div>
          
          <div class="col-md-5 ">
              <p>cresolidopld@hotmail.com</p> 
        
                <p>Local: 961 663 81 10 <br>Lada sin costo: 01 800 837 80 47</p>
          </div>        
        </div>
        <div class="row text-center correo">
          CRECIMIENTO SOLIDARIO PARA EL DESARROLLO ORGANIZADO S.A. DE C.V. SOFOM ENR
        </div>

    </div>
      
        </footer>  
  </body>
   <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}    
    
    <!-- Bootstrap Core JavaScript -->
    
    {!! Html::script('js/bootstrap.min.js') !!}   
</html>
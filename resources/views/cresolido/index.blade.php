<!DOCTYPE HTML>
<html>
	<head>
		<title>CRESOLIDO SA DE CV SOFOM ENR</title>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    
	{!!Html::style('css/slider.css')!!}
    {!!Html::style('css-cresolido/estilos.css')!!}
  
	
    <!-- Custom CSS -->
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>

	</head>
	<body>
    <header>
     <img src="../img-cresolido/logo-cresolido.png"  class="img-responsive logocre">
    </header>
 <!-- Navigation -->
    <nav class="navbar navbar-inverse" role="navigation" id="menu">
        <div class="container-fluid">
            <div class="container">                
                <!-- Brand and toggle get grouped for better mobile display -->          
                <div class="navbar-header">
                <img src="../img-cresolido/logo.png"  class="img-responsive logocolapce">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                                   
                </div>            
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">                  
                      @include('cresolido.mainmenu')
                      </ul>
                </div>
            </div>
        </div>         
    </nav>
        	@yield('maincontent') 	
    <div class="container-fluid footer-box">
			
			<div class="container">
	 		<div class="row">
            <footer>
            <ul class="footer_menu">
	 			 @include('cresolido.footermenu')	 		
            </ul>
            </footer>
            </div>
            <div class="row">
                <div class="col-md-4 colapce">
                <a href="http://www.cnbv.gob.mx/Paginas/default.aspx" target="_blank"> <img  src="../images/cnbv.png" class="img-footer text-center"/></a>
                </div>
                <div class="col-md-4 colapce">
                <a href="http://www.buro.gob.mx/"  target="_blank"> <img src="../images/buro.png" class="img-footer text-center" /></a>
                </div>
                <div class="col-md-4 colapce">
                <a href="http://www.condusef.gob.mx/"  target="_blank"> <img src="../images/condusef.png" class="img-footer text-center" /> </a>
                </div>
            </div>
            <div class="clear"></div>
            <div class="row">
                <div class="col-md-6 text-left" >
               
               <h4> Unidad Especializada de Atención a Usuarios (UNE):</h4>
                <p>
                    <b>Dirección:</b> 13ª Sur Poniente, Número 640, Barrio San Francisco, C.P. 29066, Tuxtla Gutiérrez Chiapas.
                <br>
                    <b>Teléfonos:</b>
                    <br>
                    <b>Local:</b> 961 663 81 10<br> 
                    <b>Lada sin costo:</b> 01 800 837 80 47
                    <br>
                       <b>Correo electrónico:</b>cresolidopld@hotmail.com
                    <br>
                    <b>Horario de atención:</b>
                    8:30 - 16:00 hrs. de Lunes a Viernes
                    </p>                   
                </div>            
            <div class="col-md-6 text-left">
             <p>
                    <h4>Comision Nacional para la Proteccion y Defensa de los Usuarios de los Servicios Financieros (CONDUSEF)</h4>
                    <b>Telefono de Atencion a Usuarios:</b> (55) 5340 0999 y 01 (800) 999 8080
                    <br>
                    <b>Correo Electronico:</b> opinion@condusef.gob.mx
                    <br>
                    <b>Página de Internet:</b> http://www.condusef.gob.mx
                    </p>
                </div>
            </div>
	 		</div> 
	 			
 		</div> 
 
    <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}  

    <!-- Bootstrap Core JavaScript -->    
    {!! Html::script('js/bootstrap.min.js') !!}    
    <!-- sdjasdjjkd-->
    {!! Html::script('js/jquery.nivo.slider.js') !!} 
	</body>
     <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
    </script>
  
</html>


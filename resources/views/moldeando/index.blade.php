<!DOCTYPE HTML>
<html>
	<head>
		<title>Moldeando Mentes</title>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	   <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    
	{!!Html::style('css/slider.css')!!}
    {!!Html::style('css-moldeando/estilos.css')!!}
    {!!Html::style('../css/lightbox.css')!!}
	</head>
	<body>
    <div class="container-fluid">
    <div class="banhed"></div>
    </div>
    <div class="container">
     <img src="../img-moldeando/logo-moldeando.png"  class="img-responsive logocre">
    </div>
 <!-- Navigation -->
    <nav class="container navbar navbar-inverse" role="navigation" id="menu">
        <div class="container">
            <div class="container">                
                <!-- Brand and toggle get grouped for better mobile display -->          
                <div class="navbar-header">
                <img src="../img-moldeando/logo-mol-colapse.png"  class="img-responsive logocolapce">
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
    <div class="container"><div class="bansect"></div></div>

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
        <div class="clear"></div>
        <div class="row">
            <div class="col-md-3">
            <p><span class="glyphicon glyphicon-earphone"></span> Tel. +1 998 71 150 30 20</p>                          
            </div>  
            <div class="col-md-3">
            <p><span class="glyphicon glyphicon-map-marker"></span> Av. Central Poniente<br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tuxtla Gutieérrez Chiapas.</p>                          
            </div>     
            <div class="col-md-3">
            <p><span class="glyphicon glyphicon-envelope"></span>info@stylemixthemes.com</p>                          
            </div>  
                <div class="footer-col col-md-2 text-center">
                        <h4>CONTACTANOS</h4>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social"><i class=""><img src="../img-moldeando/facebook.png" class="img-responsive"></i></a>
                            </li>
                            <li>
                                 <a href="#" class="btn-social"><i class=""><img src="../img-moldeando/instagram.png" class="img-responsive"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social"><i class=""><img src="../img-moldeando/twitter.png" class="img-responsive"></i></a>
                            </li>
                        </ul>
                    </div>
                        
        </div>
	</div> 
</div> 
 
    <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}  

    <!-- Bootstrap Core JavaScript -->    
    {!! Html::script('js/bootstrap.min.js') !!} 
   
   </body>
    {!! Html::script('../js/lightbox.js') !!}   
     <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })
      $('.carousel2').carousel({
        interval: 5500 //changes the speed
    })
       $('.carousel3').carousel({
        interval: 4400 //changes the speed
    })
    </script>
  
</html>


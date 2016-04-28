<!DOCTYPE HTML>
<html>
	<head>
		<title>FIRME SOLUCIONES SA DE CV</title>
	   <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    

	{!!Html::style('css/style.css')!!}
    <!-- Custom CSS -->
    {!!Html::style('css/slider.css')!!}
    {!!Html::style('../css/lightbox.css')!!}
	</head>
	<body>
		<!----start-wrap---->
		<div class="wrap">
			<!---start-header---->
			<div class="top-links" id="top">
					<div class="contact-info">
						Teléfono: <span class="contact-info1">01 341 414 0202</span>
					</div>
					<div class="social-icons">
		                <ul>
		                    <li><a class="facebook" href="#" target="_blank"> </a></li>
		                    <li><a class="twitter" href="#" target="_blank"></a></li>
		                    <li><a class="googleplus" href="#" target="_blank"></a></li>
		                    <li><a class="pinterest" href="#" target="_blank"></a></li>		                    
		                </ul>
					</div>
					<div class="clear"> </div>
				</div>
		</div>
			<div class="header">
				<div class="wrap">
				<div class="logo">
					<a href="Inicio"><img src="../images/logo.png"  width="190px" title="logo" /></a>
				</div>
				<div class="top-nav">
					<ul>
						@include('firmesoluciones.mainmenu')						
						<div class="clear"> </div>
					</ul>
				</div>
				<div class="clear"> </div>
			</div>
			<!---End-header---->
		</div>
		 <!---start-content---->
		 @yield('home')
		 		 <!---start-footer---->
		 <div class="footer">
		 	<div class="wrap">
		 		 <ul class="footer_menu">
		 		 @include('firmesoluciones.footermenu')						
		 		 </ul>
		 		<div class="clear"> </div>
		 	</div>
		 </div>		 
	</div>
    <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}        
    <!-- Bootstrap Core JavaScript -->    
    {!! Html::script('js/bootstrap.min.js') !!}    
    <!-- sdjasdjjkd-->
    {!! Html::script('js/lightbox.js') !!} 
    	  <!-- jQuery -->
    {!! Html::script('js/jquery.min.js') !!}        
    
    {!! Html::script('js/jquery.easing.1.3.js') !!}    
    <!-- sdjasdjjkd-->
    {!! Html::script('js/camera.min.js') !!}    


	</body>
</html>


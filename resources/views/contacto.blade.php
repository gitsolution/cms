@extends('layouts.principal')

@section('content')


    <div class="row">
    	<div class="col-xs-4"> 
 		</div>
 		
 		<div class="col-xs-4 contactanos"> 
 			CONTACTANOS
 		</div>
		
		<div class="col-xs-4"> 
 		</div>
	</div>
<!-- formulari de contactos -->
	<div class="">
	<div class="row fondoContenido">
	   <form class="frmContacto" action="" methos="POST">
		<div class="form-group">
		
		<div class="col-xs-5">
			<input type="text" class="form-control separacion colorCajaTexto tamano" id="nombre" name="txtNombre" placeholder="Nombre" required autofocus>		
			<input type="text" class="form-control separacion colorCajaTexto tamano" id="telefono" name="txtTelefono" placeholder="Telefono">
			<input type="email" class="form-control separacion colorCajaTexto tamano" id="email" name="txtEmail" placeholder="E-mail">
			<textarea class="form-control  separacion colorCajaTexto"rows="5" id="informacion" name="txtInformacion" placeholder="Mensaje"></textarea>
		
			<div class="col-xs-12">
				<div class="col-xs-1">
					<buttom class="btn btn-lg btn-primary btn-block btnSolicitar separacion" type="submit">ENVIAR</buttom>	
				</div>
			</div>
		</div>
		
		</form>

		<div class="col-xs-5 mapa">
			<div class="embed-responsive embed-responsive-16by9">
			<iframe class="embed-responsive-item" src="https://www.google.com/maps/
			embed?pb=!1m18!1m12!1m3!1d3820.608669705969!2d-93.12898944621953!3d16.746
			36652695039!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!
			%3A0xaa644f1b9f519463!2sCalle+Doceava+Pte.+Sur%2C+Tuxtla+Guti%C3%A9rrez%2C+
			Chis.!5e0!3m2!1ses-419!2smx!4v1453917852602"></iframe>
			</div>
		</div>
		</div>
		</div>
	</div>

<div class="col-md-8">
      

       </div>

       </div> 
@endsection
       <!--#### pie de pagina ####--> 
       
        <!-- <footer class="container piePagina">
        	<div id="sucursales">
        	<p id="lblSucursal">SUCURSALES</p>
        	</div>

        	<div class="row informacionContactos">
 				<div class="col-md-4">
 					Tel:(961) 618-15-53/(961)618-1554<br>
					Calle 12 Poniente Norte 931-C<br>
					Bario Juy Juy<br>
					C.P.29038<br>
					Tuxtla Gutierrez, Chiapas, México
 				</div>
  				<div class="col-md-4">
  					Tel:(961) 618-15-53/(961)618-1554<br>
					Calle 12 Poniente Norte 931-C<br>
					Bario Juy Juy<br>
					C.P.29038<br>
					Tuxtla Gutierrez, Chiapas, México<br>
  				</div>
  				<div class="col-md-4">
  					Tel:(961) 618-15-53/(961)618-1554<br>
					Calle 12 Poniente Norte 931-C<br>
					Bario Juy Juy<br>
					C.P.29038<br>
					Tuxtla Gutierrez, Chiapas, México
  				</div>
			</div>


			<div class="row-fluid">
   				<div class="span12"></div>
   				<div class="span12"></div>
   				<div class="span12"></div>
			</div>

			<div class="row contactoSiguenos">
 				<div class="col-md-4">
  					Tel:(961) 618-15-53/(961)618-1554<br>
					Calle 12 Poniente Norte 931-C<br>
					Bario Juy Juy<br>
					C.P.29038<br>
					Tuxtla Gutierrez, Chiapas, México
  				</div>
  				
  			<div class="col-md-5">
  				
  					<div class="col-md-6"></div>
  					<div class="col-md-2 lblSiguenos">Siguenos:</div>
  					
  				

  				<div class="row contactoSiguenos">
  						<div class="col-md-2">
 					</div>		
					<div class="col-md-2">
 					</div>

  					<div class="col-md-2">
 						<img src="imagenes/iconoGoogleMasBlanco.png" class="img-responsive img-rounded" alt="">
 					</div>
 				
 					<div class="col-md-2">
 						<img src="imagenes/iconoFacebookBlanco.png" class="img-responsive img-rounded" alt="">
 					</div>
 				
 					<div class="col-md-2">
 						<img src="imagenes/iconoTwitterBlanco.png" class="img-responsive img-rounded" alt="">
 					</div>
  				</div>

			</div>

			<br>
			<br>

		</footer>
        	

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>



</html>-->

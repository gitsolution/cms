	{!!Form::open(['route'=>'cotizacion.store','method','POST', 'class'=>'form-group '] )!!}

	      @if (count($errors) > 0)
	      <div class="row">
	        <div class="alert alert-danger">
	            <ul>
	                @foreach ($errors->all() as $error)
	                    <li>{{ $error }}</li>
	                @endforeach
	            </ul>
	        </div>
	        </div>
   			@endif
<div class="row">
<br>
	<h3>Cotización de prestamos</h3>

</div>
<div class="row">
	     <div class="form-group ">
	    
	         <label for="inputName" class="control-label">Nombres*</label>
	             <input type="name" name ="name" class="form-control" placeholder="Nombre">
	    
	     </div>
	     <div class="form-group ">
	    
	         <label for="inputEmail" class="control-label">Email</label>
	             <input type="email" name ="email" class="form-control" placeholder="Email">
	    
	     </div>

	     <div class="form-group ">
	     
	         <label for="inputEmail" class="control-label">Telefono*</label>

	             <input type="phone" name ="phone" class="form-control" placeholder="telefono">

	     </div>

		  <div class="form-group ">
		 
		    <label class="control-label" for="exampleInputAmount " >Monto aproximando a solicitar</label>
		    <div class="input-group">
		      <div class="input-group-addon">$</div>
		      <input type="montoaproximado" class="form-control" id="exampleInputAmount" name="montoaproximado" placeholder="Monto">	
		    </div>
		 
		  </div>

		  <div class="form-group ">
		  
		    <label class="control-label" for="exampleInputAmount " >Ventas mensuales aproximadas<br></label>
		    <div class="input-group">
		      <div class="input-group-addon">$</div>
		      <input type="ventasmensuales" class="form-control" id="exampleInputAmount" name="ventasmensuales" placeholder="Ventas mensuales aproximada">	
		    </div>
		  
		  </div>

		  	<div class="form-group ">
		  
		         <label for="inputName" class="control-label">Oficio o Profesión</label>
		             <input type="oficioprofesion" class="form-control" name="oficioprofesion" placeholder="Oficio o profesion">
		         </div>
	     

	     	<div class="form-group ">
		     	
		         <label for="inputName" class="control-label">Destino del Crédito</label>
		             <input type="destinocredito" class="form-control" name="destinocredito" placeholder="Destino del credito">
		        
	     	</div>
	     
	     <div class="form-group ">
	    
	         <label for="inputPassword" class="control-label">Información Adicional</label>
	            <textarea class="form-control" name ="asunt" class="form-control" placeholder="Asunto" rows="6"></textarea>
	    
	     </div>

	      <div class="form-group">
	         
	         <br>
	            {!! Recaptcha::render() !!}
	         <div class="bg-danger" id="_recaptcha_rsgesponse_field"></div>
	         </div>
     	   

	     <div class="form-group">
	        
	         <br>
	             <button type="submit" name="solicitar" class="btn btn-primary">Solicitar</button>
	        
	     </div>

	     </div>
	{!!Form::close()!!}

	<!-- <div>
	           <?php  
					/*header("content-type: image/png");
				    $imagen = imagecreate(45,23) or die ("Ha ocurrido un error al generar captcha");
				    $color_fondo=imagecolorallocate($imagen,0,0,0);
				    $color_texto=imagecolorallocate($imagen,255,255,255);

				    function generate_captcha($chars,$length)
				    {
				    	$captcha=null;
				    	for($x=0;$x<$length;$x++)
				    	{
				    		$rand=rand(0,count($chars)-1);
				    		$captcha .= $chars[$rand];
				    	}
				    
				    	return $captcha;
				    }

				   $captcha=generate_captcha(array(0,1,2,3,4,5,6,7,8,9,'a','b','c','d','e','f'),4);

				   setcookie('captcha',sha1($captcha),time()+60*3);

				   imagestring($imagen, 5, 5, 5, $captcha, $color_texto);
				   imagepng($imagen,'im.png*/
	           ?>
	           <img src="im.png">
	          </div>-->

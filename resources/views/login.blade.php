<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
    {!!Html::style('css/admin.css')!!}
		<title>Bootstrap Login Form</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/styles.css')!!}
	</head>
	<body>
<!--login modal-->

<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">



      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h1 class="text-center">Inicie sesión</h1>
      </div>
      <div class="modal-body">
      {!!Form::open(['route'=>'log.store','method'=>'POST'])!!} 
       <div class="form-group">
                {!!Form::email('email',null,['class'=>'form-control input-lg','placeholder'=>'Correo  electronico'])!!}
        </div>
         <div class="form-group">
                {!!Form::password('password', ['class'=>'form-control input-lg','placeholder'=>'Contraseña'])!!}
          </div>

          <div class="form-group">
            {!!Form::submit('Iniciar sesion',['class'=>'btn btn-primary btn-lg btn-block','placeholder'=>'Iniciar sesion'])!!}
          </div>
      {!!Form::close()!!}
          
      </div>
      <div class="modal-footer">
          <div class="col-md-12">
          <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
		  </div>	
      </div>
  </div>
  </div>
</div>
	<!-- script references -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
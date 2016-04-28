@extends('layouts.app')
@section('content')

<?php 
	if(isset($user)) 
	{
		$message="Edit";
		 $name=$user->name;
		 $lastName=$user->lastname;
		 $buttom="Editar";
		 $id=$user->gender;
		 $path="../../../".$user->picture;
		 $genero=$user->gender;		 
		 $born_date=$user->born_date;
	}
	else
	{
		$message="New";
		$user=null;
		$name=$user;
		$lastName=$user;
		$path=$user;
		$born_date=$user;
		$genero=$user;
		$buttom="Guardar";

	}
?>
		@if($message=='Edit')
                {!!Form::model($user,['route'=>['admin.perfil.update',$user->id],'method'=>'PUT', 'novalidate' => 'novalidate','files' => true])!!} 
          
                @else
	{!!Form::open(['route'=>'admin.perfil.store','method','POST','novalidate' => 'novalidate','files' => true])!!} 
		@endif
 
			<div class="row">
				 <div class="form-group">
				 		<div class="col-md-4">
				 		<input type="hidden" name="_token"  value="{{ csrf_token() }}">  
				                        <div class="panel-body">
				                            <img id="imgUpTo" src="<?php echo $path?>" alt="Imagen" width="250px" height="250px" />
				                        </div>
				                         <div class="form-group">
				                        <div class="col-md-12">
								  			{!!Form::label('Imagen de perfil:')!!}
								   		   <input type='file' name='file' id="imgLoad" />
			  							</div>
			  							</div>	
		                  
				        </div> 
				
			 <div class="form-group" >
			 	<div class="col-md-4">
			 	  {!!Form::label('Nombre:')!!}
			 	  {!!Form::text('name',$name,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre de la imagen'])!!}<br><br>
			 	 </div>
			 	 <div class="col-md-7">
			 	  {!!Form::label('Apellidos:')!!}
			 	  {!!Form::text('lastname',$lastName,['class'=>'form-control', 'placeholder'=>'Ingresa el Nombre de la imagen'])!!}<br><br>
			 	 </div>
			 </div> 

				<div class="form-group" >
 					 <div class="col-xs-3">
                        {!! Form::label('id', 'Genero') !!}
                       
                        {!! Form::select('gender',array('masculino' => 'Masculino', 'femenino' => 'Femenino'), null,['class'=>'form-control select2']) !!}
                    </div>

                    <div class="col-md-3">
				 	  {!!Form::label('Fecha de nacimiento:')!!}
				 	  {!!Form::date('born_date',$born_date,['class'=>'form-control', 'placeholder'=>'Ingresa la Fecha de Publicación del Albúm'])!!}
					</div>
				</div>

				</div>
				<br><br>
			</div>
					<div clas="row">
						<div class="form-group" >
							<div class="col-md-12">
							 {!!Form::submit($buttom,['class'=>'btn btn-primary'])!!}
							 {!! link_to('usuario', 'Cancelar',array('class'=>'btn btn-danger')) !!}
							</div>
						</div>
					</div>

				
 {!!Form::close()!!}




@stop
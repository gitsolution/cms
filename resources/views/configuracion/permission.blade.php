@extends('layouts.app')
@section('content')

<?php
	if(isset($idRole) && isset($idModulo))
	{
		 $roles=DB::table('usr_roles')->where('id', $idRole)->first();
		 $modulo = DB::table('cms_accesses')->where('id', $idModulo)->first();
		 $chkActivado="";
	}

	else 
	{
		$idModulo=1;
	}

?>
	<h3><?php echo $modulo->title ?></h3>
	<hr></hr>
		@if($idModulo==1)  <!--opcion para Media-->
				<h4>Menú</h4>
                {!!Form::open(['route'=>'admin.configUpdate.store','method','POST'])!!} 
					<input type="hidden" name="idRole" value="<?php echo $idRole?>"></input>	
					<input type="hidden" name="idModulo" value="<?php echo $idModulo?>"></input>				
                    <br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="menuIndex[]"  value="index">
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
		                 	{!!Form::label('lblMenuIndex','Index')!!}               	
                 	</div>
                 	<div class="col-md-8">
                 	 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="menuIndex[]" value="subir imagenes" >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 			{!!Form::label('lblMenuSubirImagen','subir imagenes')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="menuIndex[]"  value="menu de galerias">
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblMenuGaleria','crear galerias')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 	  	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="menuIndex[]" value="eliminar" >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 		  {!!Form::label('lblMenuEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="menuIndex[]"  value="actualizar">
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblMenuActualizar','Actualizar')!!}                 	 
                 	</div>

                 	<br><br><br> 
                 	{!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                  
                {!!Form::close()!!}     
            
        @elseif($idModulo==2)<!--opcion para -->
        <h4>Tipos</h4>
                {!!Form::open(['route'=>'admin.configUpdate.store','method','POST'])!!} 
                	<input type="hidden" name="idModulo" value="<?php echo $idModulo?>"></input>
					<input type="hidden" name="idRole" value="<?php echo $idRole?>"></input>
                    <br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pTipoIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblTipoIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pTipoGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblTipoGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pTipoEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblTipoEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pTipoEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblTipoEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>
                 <h4>Secciones</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pSecccionIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblSeccionIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pSeccionGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblSeccionGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pSeccionEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblSeccionEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pSeccionEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblSeccionEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>
                  <h4>Categorias</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pCategoriaIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblCategoriaIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pCategoriGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblCategoriaGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pCategoriaEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblCategoriaEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pCategoriaEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblCategoriaEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>

                 <h4>Documentos</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pDocumentosIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblDocumentoIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pDocumentosGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblDocumentoGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pDocumentosEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblDocumentoEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pDocumentosEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblDocumentoEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>

                 <h4>Comentarios</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pComentariosIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblComentarioIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pComentariosGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblComentarioGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pComentariosEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblComentarioEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="pComentariosEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblComentarioEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>


                 

                  
                 	{!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                  
                {!!Form::close()!!}        


        @elseif($idModulo==3)<!--opcion para media-->
        <h4>Albums</h4>
                {!!Form::open(['route'=>'admin.configUpdate.store','method','POST'])!!} 
                	<input type="hidden" name="idModulo" value="<?php echo $idModulo?>"></input>
					<input type="hidden" name="idRole" value="<?php echo $idRole?>"></input>
                    <div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="mediaIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblMediaIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="mediaGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblMediaGuarda','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="mediaEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblMediaEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="mediaEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblMediaEliminar','Eliminar')!!}
                 	</div>

                  
				<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="mediaSubirImagen"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblMediaSubirImagen','Subir imagen')!!}                 	 
                 	</div>
                 	 

                  <br><br><br><br>
                 	{!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                {!!Form::close()!!}    


         @elseif($idModulo==4)<!--opcion para -->
         <h4>Usuarios</h4>
                {!!Form::open(['route'=>'admin.configUpdate.store','method','POST'])!!} 
                	<input type="hidden" name="idModulo" value="<?php echo $idModulo?>"></input>
					<input type="hidden" name="idRole" value="<?php echo $idRole?>"></input>
                    <br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="usuarioIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblUsuarioIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="usuarioGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblUsuarioGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="usuarioEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblUsuarioActualizar','Editar')!!}                 	 
                 	</div>
                 	 
                 	<br><br><br><br>
                 <h4>Roles</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="rolesIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblRolesIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="rolesGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblRolesGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="rolesEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblRolesActualizar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="rolesEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblRolesEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>
                  <h4>Modulos</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="moduloIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblModuloIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="moduloGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblModuloGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="moduloEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblModuloActualizar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="moduloEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblModuloEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>

                 <h4>Configuracion</h4>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="configuracionIndex"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblConfiguracionIndex','Index')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="configuracionGuardar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblConfiguracionGuardar','Guardar')!!}
                 	</div>

                 	<br><br><br><br>
                 	<div class="col-md-1"></div>
                 	<div class="col-md-3">
	                 	<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="configuracionEditar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
	                 	{!!Form::label('lblConfiguracionEditar','Editar')!!}                 	 
                 	</div>
                 	<div class="col-md-8">
                 		<div class="btn-group" data-toggle="buttons"><label class="btn btn-primary  <?php echo $chkActivado?>">
	   						 <input type="checkbox" name="configuracionEliminar"  >
						    <span class="glyphicon glyphicon-ok"></span>
						   </label></div>
                 	{!!Form::label('lblConfiguracionEliminar','Eliminar')!!}
                 	</div>

                 	<br><br><br><br>

                 	{!!Form::submit('Guardar',['class'=>'btn  btn-danger frmEspacios','placeholder'=>'Nombre'])!!}
                  
                {!!Form::close()!!}  

           
             @endif     
 
@stop

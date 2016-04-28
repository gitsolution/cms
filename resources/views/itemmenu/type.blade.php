@extends('layouts.app')
@section('content')

<div class="container-fluid">
<div class="row">
	<br>
	<div class="col-md-8">
	<h3>Seleccione un Tipo de Menú a crear </h3>
	</div> <!--divide la columna en 10 y 2-->
	<div class="col-md-2 text-right">	
 	 {!! link_to('admin/itemmenu/'.$id_menu, 'Regresar',array('class'=>'btn btn-info')) !!}
	</div>	 

</div>
 

</div>
@stop
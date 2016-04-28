@extends('layouts.app')
@section('content')

	<div class="panel-heading">
	        <br>
	        <h2 class="panel-title">
	        <i class="fa fa-pencil fa-lg">Permiso especial a: <?php echo $nombreCompleto?></i>
	            </h2> 
	  </div><br>
	   


	  	<div class="table-responsive">
<table class="table table-hover">
          <thead class="center-text" >
            <th class="ColumColor text-left" >
            Rol
            </th> 
            <th  class="ColumColor text-left" >
            Modulo
            </th>
            <th  class="ColumColor text-left" >
            Seleccionar
            </th>
           
          </thead>
			@foreach($rolesmodules as $rm)		      
			<tbody>
				@foreach($roles as $r)
					@if($rm->id_role==$r->id)
						<td>{{$r->title}}</td>
						@break
					@endif
				@endforeach

				@foreach($modules as $m)
					@if($rm->id_sysmodules==$m->id)
						<td>{{$m->title}}</td>
						@break
					@endif
				@endforeach
               
				<td>
				{!! link_to('admin/specialSelect/'.$id.'/'.$rm->id_role.'/'.$rm->id_sysmodules, 'Seleccionar',array('class'=>'btn btn-default')) !!}  
				</td>
			</tbody>
		@endForeach

	</table></div>








	
@stop
@extends('layouts.app')
@section('content')
<br><br><br>
      <div class="row">
        <div class="col-md-3"></div>
          <div class="col-md-6">
            <div class="error-template">
                <div class=""></div>
                  <h1 style="text-align: center">
                    <i class="fa fa-cog fa-spin"></i>
                        Acceso denegado
                  </h1>
                        
                  <h2 style="text-align: center">
                    No tienes permisos suficientes
                  </h2>

                  <div style="text-align: center"><br>
                    {!!link_to('admin', 'Inicio',array('class'=>'btn btn-primary btn-lg')) !!}
                  </div>  
                        
            </div> 
          </div>
                <div class="col-md-3"></div>    
      </div>        
                 
                 
@stop
<div class="container">

  <h2 >{{trans('posadapraiso/pagina_index.suscribete')}}</h2>    
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.nombre'))  }}
        {{Form::text('llegada',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>  

      <div class="form-group">
        {{Form::label(trans('posadapraiso/labels.apellidos'))  }}
        {{Form::email('apellido',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div> 

      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.email'))  }}
        {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>

      <center> 
         <div class="form-group">
              <button type="submit" name="solicitar" class="btn style-button">{{trans('posadapraiso/labels.suscribete')}} </button>
        </div>
      </center>
      <div class="col-md-4"></div>
    
   </div>
  </div>

</div>
  <div class="col-md-9">
      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.nombre'))  }}
        {{Form::text('llegada',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>  

      <div class="form-group">
        {{Form::label(trans('posadapraiso/labels.email'))  }}
        {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>

      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.direccion'))  }}
        {{Form::text('direccion',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>
   
      <div class="form-group">
        {{Form::label(trans('posadapraiso/labels.ciudad'))  }}
        {{Form::text('ciudad',NULL,['class'=>'form-control','placeholder'=>''])   }}
      </div>   

       <div class="form-group">
        {{Form::label(trans('posadapraiso/labels.mensaje'))  }}
          {!!Form::textarea('content',null,['class'=>'form-control','placeholder'=>'', 'id'=>'inputEmail','rows'=>'4', 'required'])!!}    
          
      </div>

      <div class="form-group">
           
           <br><center>
              {!! Recaptcha::render() !!}</center>
           <div class="bg-danger" id="_recaptcha_rsgesponse_field"></div>
      </div>
  </div>         

       <div class="form-group">
          
           <br>
               <button type="submit" name="solicitar" class="btn btn-primary form-control">{{trans('posadapraiso/labels.enviar')}}</button>
          
       </div>




<h2 >{{trans('posadapraiso/pagina_index.reservaenlinea')}}</h2>    
  <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.llegada'))  }}
        {{Form::text('llegada',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
    </div> 
  
    <div class="col-md-6">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.salida'))  }}
        {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-md-6">  
    <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.hab'))  }}
        {{Form::email('hab',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
    </div>
  </div>


   <div class="row">
     <div class="col-md-6">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.adultos'))  }}
        {{Form::email('adultos',NULL,['class'=>'form-control','placeholder'=>''])   }}
     </div>
     </div>


     <div class="col-md-6"> 
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.menores'))  }}
        {{Form::email('menores',NULL,['class'=>'form-control','placeholder'=>''])   }}
     </div>
     </div>

  </div>

  <div class="row">
    <div class="col-md-6">  
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.promo'))  }}
        {{Form::email('promo',NULL,['class'=>'form-control style-input','placeholder'=>''])   }}

     </div>
   </div>
  </div> 

 <center> 
        <div class="form-group">
              <button type="submit" name="solicitar" class="btn style-button">{{trans('posadapraiso/labels.vertarifa')}}</button>
       </div>
  </center>
    
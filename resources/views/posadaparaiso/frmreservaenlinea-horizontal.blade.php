<div class="container" >
<h2 >{{trans('posadapraiso/pagina_index.reservaenlinea')}}</h2>    
<div class="row">
  <div class="col-md-2">
    <div class="form-group "  >
    	{{Form::label(trans('posadapraiso/labels.llegada'),'',array('style' => 'color:white') )  }}
        {{Form::text('llegada',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
  </div>
  
  <div class="col-md-2">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.salida'),'',array('style' => 'color:white'))  }}
        {{Form::email('salida',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
  </div>
     
  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.hab'),'',array('style' => 'color:white'))  }}
        {{Form::email('hab',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
  </div>

  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.adultos'),'',array('style' => 'color:white'))  }}
        {{Form::email('adultos',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.menores'),'',array('style' => 'color:white'))  }}
        {{Form::email('menores',NULL,['class'=>'form-control','placeholder'=>''])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.promo'),'',array('style' => 'color:white'))  }}
        {{Form::email('promo',NULL,['class'=>'form-control style-input','placeholder'=>''])   }}
    </div>
  </div>

 <center> 
        <div class="form-group">
              <button type="submit" name="solicitar" class="btn style-button">{{trans('posadapraiso/labels.vertarifa')}}</button>
       </div>
  </center>
    
</div>
</div>
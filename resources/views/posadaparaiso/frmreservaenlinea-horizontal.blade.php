<div class="container" >
<h2 >{{trans('posadapraiso/pagina_index.reservaenlinea')}}</h2>    
<div class="row">
   {!!Form::open(['route'=>'Reservation.store','method','PUT'])!!} 
  
  <div class="col-md-12">
    <div class="form-group "  >
      {{Form::label(trans('posadapraiso/labels.nombre'),'',array('style' => 'color:white') )  }}
        {{Form::text('nombre',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group "  >
    	{{Form::label(trans('posadapraiso/labels.llegada'),'',array('style' => 'color:white') )  }}
        {{Form::date('llegada',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
  </div>
  
  <div class="col-md-2">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.salida'),'',array('style' => 'color:white'))  }}
        {{Form::date('salida',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
  </div>
     
  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.hab'),'',array('style' => 'color:white'))  }}
        {{Form::number('habitacion',NULL,['class'=>'form-control','placeholder'=>'','min'=>'1','max'=>'30','step'=>'1','required'] )   }}
    </div>
  </div>

  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.adultos'),'',array('style' => 'color:white'))  }}
        {{Form::number('adultos',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.menores'),'',array('style' => 'color:white'))  }}
        {{Form::number('menores',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.promo'),'',array('style' => 'color:white'))  }}
        {{Form::text('promo',NULL,['class'=>'form-control style-input','placeholder'=>'','maxlength'=>'200'])   }}
    </div>
  </div>

 <center> 
        <div class="form-group">
              {!!Form::submit(trans('posadapraiso/labels.vertarifa'),['class'=>'btn style-button'])!!}
       </div>
  </center>
  {!!Form::close()!!}
    
</div>
</div>
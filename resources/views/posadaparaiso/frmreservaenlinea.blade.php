
<h2 >{{trans('posadapraiso/pagina_index.reservaenlinea')}}</h2>    
{!!Form::open(['route'=>'Reservation.store','method','PUT'])!!} 
  <div class="row">
      <div class="col-md-12">
      <div class="form-group "  >
        {{Form::label(trans('posadapraiso/labels.nombre'),'' )  }}
        {{Form::text('nombre',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
      </div>
      </div> 
  </div>

  <div class="row">
    <div class="col-md-6">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.llegada'),'' )  }}
      {{Form::date('llegada',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
    </div> 
  
    <div class="col-md-6">
    <div class="form-group">
    	{{Form::label(trans('posadapraiso/labels.salida'),'')  }}
      {{Form::date('salida',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
    </div>
  </div>
    
  <div class="row">
    <div class="col-md-6">  
    <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.hab'),'')  }}
      {{Form::number('habitacion',NULL,['class'=>'form-control','placeholder'=>'','min'=>'1','max'=>'30','step'=>'1','required'] )   }}
    </div>
    </div>
  </div>


   <div class="row">
     <div class="col-md-6">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.adultos'),'')  }}
      {{Form::number('adultos',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
     </div>
     </div>


     <div class="col-md-6"> 
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.menores'),'')  }}
      {{Form::number('menores',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
     </div>
     </div>

  </div>

  <div class="row">
    <div class="col-md-6">  
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.promo'),'')  }}
      {{Form::text('promo',NULL,['class'=>'form-control style-input','placeholder'=>'','maxlength'=>'200'])   }}
     </div>
   </div>
  </div> 

 <center> 
        <div class="form-group">
             {!!Form::submit(trans('posadapraiso/labels.vertarifa'),['class'=>'btn style-button'])!!}
       </div>
  </center>
 {!!Form::close()!!}
    
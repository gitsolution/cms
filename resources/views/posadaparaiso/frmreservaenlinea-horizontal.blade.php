<?php $fechaActaul=date('Y-m-d');?>
<div class="container" >
<h2 >{{trans('posadapraiso/pagina_index.reservaenlinea')}}</h2>    
<div class="row">
    <!--{!!Form::open(['route'=>'Reservation.store','method','PUT'])!!} -->
    {{Form::open(['url' => 'reservationDetails'])}}
  <div class="col-md-4">
    <div class="form-group "  >
        {{Form::label(trans('posadapraiso/labels.nombre'),'' )  }}
        {{Form::text('nombre',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group "  >
        {{Form::label(trans('posadapraiso/labels.apellidos'),'' )  }}
        {{Form::text('apellidos',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group "  >
        {{Form::label(trans('posadapraiso/labels.noches'),'' )  }}
        {{Form::number('noches',NULL,['class'=>'form-control','placeholder'=>'','min'=>'1','max'=>'30','step'=>'1','required'] )   }}
    </div>
  </div>

  <div class="col-md-2">
    <div class="form-group "  >
    	{{Form::label(trans('posadapraiso/labels.llegada'),'' )  }}
      <input name="llegada" class="form-control" type="date" min="{{$fechaActaul}}" required>
    </div>
  </div>
  
  <div class="col-md-2">
    <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.salida'),'')  }}
        <input name="salida" class="form-control" type="date" min="{{$fechaActaul}}" required>
    </div>
  </div>
     
  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.hab'),'')  }}
      {{Form::number('habitacion',NULL,['class'=>'form-control','placeholder'=>'','min'=>'1','max'=>'30','step'=>'1','required'] )   }}
    </div>
  </div>

  <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.adultos'),'')  }}
      {{Form::number('adultos',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.menores'),'')  }}
      {{Form::number('menores',NULL,['class'=>'form-control','placeholder'=>'','min'=>'0','max'=>'30','step'=>'1','required'])   }}
    </div>
  </div>

   <div class="col-md-2">
     <div class="form-group">
      {{Form::label(trans('posadapraiso/labels.promo'),'')  }}
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
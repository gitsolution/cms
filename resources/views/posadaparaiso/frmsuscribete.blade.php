<div class="container">

@if(Session::has('messageSubscription'))
<div class="alert style-alert-orange  alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
  {{Session::get('messageSubscription')}}
</div>
@endif

 {!!Form::open(['route'=>'admin.suscription.store','method','POST'])!!} 

  <h2 >{{trans('posadapraiso/pagina_index.suscribete')}}</h2>    
  <div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.nombre'))  }}
        {{Form::text('name',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
      </div>  

      <div class="form-group">
        {{Form::label(trans('posadapraiso/labels.apellidos'))  }}
        {{Form::text('surnames',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
      </div> 

      <div class="form-group">
      	{{Form::label(trans('posadapraiso/labels.email'))  }}
        {{Form::email('email',NULL,['class'=>'form-control','placeholder'=>'','required'])   }}
      </div>

      <center> 
         <div class="form-group">
              <button type="submit" name="solicitar" class="btn style-button">{{trans('posadapraiso/labels.suscribete')}} </button>
      
        </div>
      </center>
      {!!Form::close()!!}
      <div class="col-md-4"></div>
    
   </div>
  </div>

</div>
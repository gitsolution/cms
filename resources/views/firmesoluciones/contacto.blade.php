@extends('firmesoluciones.index')
@section('home')
<div class="container">
    <div class="breadcrumb">
      @foreach($uris as $uri)
        {!! $uri !!}
      @endforeach                
    </div>        
<hr>
<div class="col-md-6">
{!!Form::open(['route'=>'Inicio.store','method','POST'])!!}

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

     <div class="form-group"><br>
     <div class="col-xs-12">
         <label for="inputName" class="control-label">Nombres*</label>
             <input name ="name" class="form-control" placeholder="Nombre">
         </div>
     </div>
     <div class="form-group"><br>
     <div class="col-xs-12"><br>
         <label for="inputEmail" class="control-label">Email</label>
             <input name ="email" class="form-control" placeholder="Email">
         </div>
     </div>
     <div class="form-group"><br>
     <div class="col-xs-12"><br>
         <label for="inputEmail" class="control-label">Telefono*</label>
             <input type="phone" name ="phone" class="form-control" placeholder="telefono">
         </div>
     </div>
     <div class="form-group"><br>
     <div class="col-xs-12"><br>
         <label for="inputPassword" class="control-label">Comentario*</label>
             <textarea class="form-control" name ="asunt" class="form-control" placeholder="Comentario" rows="6" ></textarea>
         </div>
     </div>
     
      <div class="form-group">
         <div class="col-xs-10"><br>
            {!! Recaptcha::render() !!}
         </div>
     </div>

     <div class="form-group">
         <div class="col-xs-10"><br>
             <button type="submit" name="enviar" class="btn btn-primary">Enviar</button>
         </div>
     </div>

{!!Form::close()!!}
</div>
<div class="col-md-6">
<br>
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d826.2863845470714!2d-92.26740050669942!3d14.906520081823249!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x858e0f2193bdb483%3A0x45cacceb26e3d55e!2sSexta+Avenida+Sur+28%2C+Centro%2C+30830+Tapachula+de+C%C3%B3rdova+y+Ordo%C3%B1ez%2C+Chis.!5e0!3m2!1ses-419!2smx!4v1456773955538" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>    

</div>
<div>
@stop
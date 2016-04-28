@extends('moldeando.index')
@section('maincontent')
<div class="container">      
<div class="container">
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
         <div class="col-xs-8"><br>
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
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3820.4408721807094!2d-93.1252524856064!3d16.754727425153334!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ecd8f15f7ecc6f%3A0x8b9ebdf575f99d3!2sAv+Central+Pte%2C+Tuxtla+Guti%C3%A9rrez%2C+Chis.!5e0!3m2!1ses-419!2smx!4v1459626968420" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
</div>
<br>
<div>
@stop
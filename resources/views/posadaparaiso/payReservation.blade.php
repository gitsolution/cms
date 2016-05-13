@extends('posadaparaiso.index')
@section('maincontent')

<!--para el mensaje de paypal-->
@if(\Session::has('message'))
<div class="alert alert-primary style-alert-orange alert-dismissible text-center" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
  <h2><strong><i class="fa fa-info-circle"></i></strong> {{ \Session::get('message') }}</h2>
</div>    
@endif

<div class="container detailReservation">
  <div class="row"><br>
     <div class="col-md-12 text-center"><h2>Detalles de su Reservación</h2></div> 
  </div>
<div class="row sectionFormPay">
<?php    
      $nombre=$arrayItemToPay['nombre'];
      $llegada=$arrayItemToPay['llegada'];
      $salida=$arrayItemToPay['salida'];
      $habitacion=$arrayItemToPay['habitacion'];
      $adultos=$arrayItemToPay['adultos'];
      $menores=$arrayItemToPay['menores'];
      $promo=$arrayItemToPay['promo'];

      $arrayItemToPaySerializado=serialize($arrayItemToPay);
 ?>

{{Form::open(['url' => 'payment','id'=>'form-pago'])}}
<!--<form action="payment" id="form-pago" method="">-->
  <input name="arrayItemToPay" type="hidden" value="{{$arrayItemToPaySerializado}}"> 
  <div class="col-md-5">
    <?php $numRooms=$habitacion?>
     
      @for ($i = 0; $i < $numRooms; $i++)
                    <table class="table table-bordered table-hover habitacionClass" id="numHabTable{{$i}}">
                      <th class="text-center" style="background:rgb(225,213,170);"><b>Habitación {{$i+1}} </b></th>
                     <tr>
                         <td  id="numHab{{$i}}">
                         Tipo :
                          <SELECT id="select{{$i}}"  NAME="precios[]" class="form-control" required >
                               <OPTION  data-price="0" VALUE="" selected> </OPTION> 
                               @if($dataPrices !=null)
                                @foreach($dataPrices as $item)
                                  <OPTION  id="option{{$item->id}}" data-price="{{$item->price}}" data-iva="{{$item->iva}}" VALUE="{{$item->id}}" > {{$item->type_room }} &nbsp; &nbsp;  (${{$item->price}}) </OPTION> 
                                @endforeach
                               @endif
                           </SELECT> 
                         </td>

                       </tr>  
                       <tr>
                         <td>
                         IVA $
                           <span id="price-selected{{$i}}"  class="precio"></span>

                         </td>
                       </tr>
                  </table>
                    
       @endfor

    </div>

    <div class="col-md-7">
       <ul class="list-group">        
               <li class="list-group-item">
                    <b> A nombre de: </b> 
                    {{$nombre}}  
               </li>
               <li class="list-group-item">
                    <b> Numero de habitaciones: </b> 
                     {{$habitacion}} 
               </li>
               <li class="list-group-item" >
                     <b>LLegada : </b>
                     {{$llegada}}   
               </li>
               <li class="list-group-item" >
                     <b>Salida : </b>
                     {{$salida}}   
               </li>
               <li class="list-group-item" >
                     <b>Adultos : </b>
                     {{$adultos}}   
               </li>
                 <li class="list-group-item" >
                     <b>Menores : </b>
                     {{$menores}}   
               </li>

 
                <li class="list-group-item text-center" >
                     <b>SubTotal : </b>$
                     <span id="total-reservation"class="">0</span>   
                     <input id="total-input" type="hidden" name="total" /> 
                </li>
                 <li class="list-group-item text-center" >
                               <b>IVA: </b>$
                               <span id="suma-de-ivas"class="">0</span>   
                               <input id="suma-de-ivas-input" type="hidden" name="suma-de-ivas" /> 
                 </li>
                 <li class="list-group-item text-center" >
                              <h4><b>Total:$ </b>
                               <span id="total-reservation-con-iva"class="">0</span>   
                               <input id="total-reservation-con-iva-input" type="hidden" name="total-reservation-con-iva" />
                             </h4> 
                 </li>
       </ul>
    
    
       <div class="form-group">
        Pagar Con
         <center> 
                  {!!Form::submit('PayPal',['class'=>'btn btn-primary'])!!}
                  {!!Form::submit('Mercado de pago',['class'=>'btn btn-primary','id'=>'bttsubmit-mercadopago'])!!}
         </center>
       </div>

    </div>
 
    
  </div>
  {!!Form::close()!!}
</div>






@stop
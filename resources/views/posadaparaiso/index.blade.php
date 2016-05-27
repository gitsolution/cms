<!DOCTYPE HTML>
<html>
	<head>
		<title>Posada paraiso</title>
            <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    {!!Html::style('css/posadaparaiso/style.css')!!}
  

	   <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}    
	{!!Html::style('css/slider.css')!!}

    {!!Html::style('css/posadaparaiso/ligthBoxGallery/css/lightbox.css')!!}
    <!-- Custom CSS -->
    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>
    <!--<script src='https://www.google.com/recaptcha/api.js'></script>-->
	</head>
	<body>
    <header>
    <!-- <img src="../img-cresolido/paraisonaranja-22.png"  class="img-responsive logocre">-->
    </header>
 <!-- Navigation -->
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation" id="menu">
        <div class="container-fluid main-menu">
            <div class="container ">                
                <!-- Brand and toggle get grouped for better mobile display -->          
                <div class="navbar-header " >
                
                    <button style="color:orange;" type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">

                        <span class="sr-only" >Toggle navigation</span>
                        <span class="icon-bar" style="color:blue;"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                          
                      <div class="icon-logo-empresa  hidden-xs " > <a href="/">  <img src="../img-posadaparaiso/paraisonaranja-22.png" class="img-responsive " ></a> </div> 
                      <div class="icon-logo-empresa  visible-xs  " > <a href="/">  <img src="../img-posadaparaiso/paraisonaranja-22.png" class="img-responsive " style="width:100px"></a> </div>        
                </div>            
                <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav " id="menu-main">                  
                      <li class="flag"><a href="/es"><img src="../img-posadaparaiso/es.jpg" class=" img-flag"/></a></li>
                      <li><a href="/en"><img src="../img-posadaparaiso/en.jpg"/></a></li>
                      <li><a href="/fr"><img src="../img-posadaparaiso/fr.jpg"/></a></li>
                      @include('posadaparaiso.mainmenu')
                      </ul>
                </div>
            </div>
        </div>         
    </nav>
            <div class="relleno"></div>
        	@yield('maincontent') 	
    <div class="container-fluid footer-menu sombrainterior-naranja">
        
        	 @include('posadaparaiso.footermenu')	 		
 
    </div> 
  
    <!--ligthBox-->
    
    {!! Html::script('css/posadaparaiso/ligthBoxGallery/js/lightbox-plus-jquery.js') !!}  

    <!-- jQuery -->
    {!! Html::script('js/jquery.js') !!}  

    <!-- Bootstrap Core JavaScript -->    
    {!! Html::script('js/bootstrap.min.js') !!}    
    <!-- sdjasdjjkd-->
    {!! Html::script('js/jquery.nivo.slider.js') !!} 
	</body>
     <script>
    $('.carousel').carousel({
        interval: 3000 //changes the speed
    })

    
    /*Cambia el color del item del menu en la sección en la que el usuario se encuentra*/
     var pathname = window.location.pathname;
     var itema_ctive = pathname.split('/');
     itema_ctive=itema_ctive[itema_ctive.length-1];
     item=$("#itemMenu"+itema_ctive);
     item.addClass('itema-active');
     item.addClass('disabled');
     


     /*var URLhash = window.location.hash;
     if(URLhash!="")
     {   //URLhash=URLhash.substr(1);//quito el #
        var destino=URLhash;
        var posicion = $(destino).offset().top;
          $("html, body").animate({
            scrollTop: posicion
           }, 2000); 
     }*/

    /*Animacion de deslizamiento hacia abajo para los enlaces en la misma pagina */
    $("li a").each(function (index)//recorreo todos lo li 
    {      
      $(this).on("click", function(){
           href=$(this).attr('href');
                 if(href.split('#').length>1)//si el elemento del menu tiene #
           {
                 var posicion = $(href).offset().top;
                 $("html, body").animate({
                     scrollTop: posicion
                    }, 2000); 
                 }
      });   
     });








     /*Para las reservaciones*/

$(document).ready(function(){
   


$("#bttsubmit-mercadopago").click(function(){
    $('#form-pago').attr("action", "paymentMercadoPago");
});

  $("select[ name='precios[]' ]").change(function(){
   $i=0; total=0;
   totalConIva=0;sumaDeIvas=0;iva=0;
     $(".habitacionClass").each(function (index)
         {
             //alert($(this).attr("id")); 
             idTable=$(this).attr("id");
            // alert("Tabla "+$i+" ValDeselect:" +$("#"+idTable+" #select"+$i).val());
             //inputSelect=$("#"+idTable+" #select"+$i);/*Obtengo el obj select*/

             
             
            id_seleccionado=$("#"+idTable+' select[name="precios[]"').val();
            //alert("input Selecionado id:"+id_seleccionado);
            precio=$("#"+idTable+" #option"+id_seleccionado).attr("data-price");
            iva=$("#"+idTable+" #option"+id_seleccionado).attr("data-iva");
            //alert(precio);
            
            $("#price-selected"+$i).html(iva);
            
            if(precio!=null){
                total=parseFloat(total)+parseFloat(precio);
                if(iva!=null)
                    {
                     sumaDeIvas=sumaDeIvas+parseFloat(iva);
                     totalConIva=total+sumaDeIvas;
                    }
            }
            $("#total-reservation").html(total);
            $("#suma-de-ivas").html(sumaDeIvas);
            $("#total-reservation-con-iva").html(totalConIva);
            
            $("#total-input").val(totalConIva);
            $i++;

         }) 



            /*id_habitacion=$1;
            id_seleccionado=$('select[name=precios]').val();
            //alert(id_seleccionado);
            precio=$("#price"+id_seleccionado).attr("data-price");
            //alert(precio);
            $("#price-selected"+id_habitacion).html(precio);
            $("#total-reservation").html(precio);*/
        });
 
});



    </script>
  
</html>


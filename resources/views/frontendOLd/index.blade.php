<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Microfinanciera, microcreditos, creditos en chiapas, grupo solidario">
    <meta name="author" content="">
    <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
    <title>Valor Productivo SA de CV SOFOM ENR</title>

    <!-- Bootstrap Core CSS -->
    {!!Html::style('css/bootstrap.min.css')!!}
    {!!Html::style('css/admin.css')!!}
    <!-- Custom CSS -->
    {!!Html::style('css/business-frontpage.css')!!}
    {!!Html::style('../css/lightbox.css')!!}
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->  
            <div class="navbar-header">
             <div class="row">
             <div class="derecha col-md-7" style="width: 235px; height: 50px;">
                     <a href="Inicio">
                      <img src="../img/logo.png" class="img-responsive logo"></a>
                    </div>

              <div class="col-md-5">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                </div>
                </div>
                
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">                
                <ul class="nav navbar-nav">
                  @include('frontend.mainmenu')
                </ul>
            </div>
        </div>
    </nav>
<div id="wrap">

    <div id="main" class="clearfix">
        <div class="container">
          <hr>    
          @yield('content')
        </div>

    </div>

</div>
        <footer class="panel-footer">
            <div class="container">
                <div class="row">
               <div class="col-md-12">
            <ul class="footer_menu">
              @include('frontend.footermenu')
            </ul>
                </div>
                </div>
            <div class="row">
                <div class="col-md-4 " >
             <div class="footcontac">
            
<b>Mail:</b> contacto@valorproductivo.com.mx
<br> 
<b>Teléfono de atención al cliente:</b> 01 962 625 3100.     
<br>
                <address> <strong>
                   Dirección: 6a Avenida Sur No.28-B, Col. Centro, 
                   <br>Tapachula de Córdova y Ordóñez, Chiapas.
                   </strong>
                </address> 
                </div>
                </div>
                <div class="col-md-2 text-center ">
                 
                  <a href="http://www.cnbv.gob.mx/Paginas/default.aspx" target="_blank"> <img src="../img/cnbv.png " class="../img-responsive text-center " style="width: 200px;"></a>

                    </div>
                    <div class="col-md-2">
                   <a href="http://www.condusef.gob.mx/"  target="_blank"> <img src="../img/condusef.png" class="text-center" style="width: 110px;"></a> 
                   </div>
                   <div class="col-md-2">           
                  <a href="http://www.buro.gob.mx/"  target="_blank">  <img src="../img/buroent.png" class="img-responsive" style="width: 80px;"></a>
                  </div>
                   


                </div>

            </div>
        </div>
        </footer>   

    
</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <link rel="stylesheet" type="text/css" href="../css/admin.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    
    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="../dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../bower_components/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


    {!!Html::style('css/admin.css')!!}
    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    {!!Html::style('../bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
    {!!Html::style('../bower_components/metisMenu/dist/metisMenu.min.css')!!}
    {!!Html::style('../dist/css/timeline.css')!!}
    {!!Html::style('../dist/css/sb-admin-2.css')!!}
    {!!Html::style('../bower_components/morrisjs/morris.css')!!}
    {!!Html::style('../bower_components/font-awesome/css/font-awesome.min.css')!!}

</head>

<body>
<br><br><br>







<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Registrarse</div>
                <div class="panel-body">

                <div class="text-info">
                    @if(Session::has('message'))
                        {{Session::get('message')}}
                    @endif
                </div>


                <form method="POST" action="{{url('auth/register')}}">

                    {!! csrf_field() !!}

 
                <div class="form-group">

                    <label for="name">Nombre:</label>

                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" />

                    <div class="text-danger">{{$errors->first('name')}}</div>

                </div>

 
                <div class="form-group">

                    <label for="lastName">Apellidos:</label>

                    <input type="lastName" name="lastName" class="form-control" value="{{ old('lastName') }}" />

                    <div class="text-danger">{{$errors->first('lastName')}}</div>

                </div>

                <div class="form-group">

                    <label for="email">Email:</label>

                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" />

                    <div class="text-danger">{{$errors->first('email')}}</div>

                </div>

 
                <div class="form-group">

                    <label for="password">Password:</label>

                    <input type="password" class="form-control" name="password" />
                    <div class="text-danger">{{$errors->first('password')}}</div>

                </div>

 

                <div class="form-group">

                    <label for="password_confirmation">Confirmar Password:</label>

                    <input type="password" class="form-control" name="password_confirmation" />

                </div>


                <div class="form-group">
                 <div class="col-xs-10"><br>
                    {!! Recaptcha::render() !!}
                    <div class="text-danger">{{$errors->first('g-recaptcha-response')}}</div>
                 <div class="bg-danger" id="_recaptcha_rsgesponse_field"></div>
                 </div>
                </div>
 

                <div>
                    <button type="submit" class="btn btn-primary">Registrarme</button>
                </div>

</form>
               
                        
                </div>
            </div>
        </div>
    </div>
</div>





<!-- fin de contenido-->



    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>


    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->

    <!-- Morris Charts JavaScript -->
    <script src="../bower_components/raphael/raphael-min.js"></script>

    <!-- Custom Theme JavaScript -->

    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
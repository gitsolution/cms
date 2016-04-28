<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

 
    {!!Html::style('css/bootstrap.css')!!}
    {!!Html::style('css/admin.css')!!}
    {!!Html::script('js/ckeditor.js')!!}
    {!!Html::script('js/sample.js')!!}

    <title>SB Admin 2 - Bootstrap Admin Theme</title>
    {!!Html::style('../bower_components/bootstrap/dist/css/bootstrap.min.css')!!}
    {!!Html::style('../bower_components/metisMenu/dist/metisMenu.min.css')!!}
    {!!Html::style('../dist/css/timeline.css')!!}
    {!!Html::style('../dist/css/sb-admin-2.css')!!}
    {!!Html::style('../bower_components/morrisjs/morris.css')!!}
    {!!Html::style('../bower_components/font-awesome/css/font-awesome.min.css')!!}

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="http://itsolution.mx" target="_blank">IT Solution. Web Solution.</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-envelope fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                   
                    <!-- /.dropdown-messages -->
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-tasks fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    
                    <!-- /.dropdown-tasks -->
                </li>
      
           
          <!-- /.dropdown -->
                <li class="dropdown">

                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">

                    @if (Auth::guest())
                       
                    @else
                        <li class="dropdown">

                          
                               <div class="UserColor">&nbsp;&nbsp;&nbsp;{{ Auth::user()->email }} </div>
                                 
                            

                          
                        </li>
                    @endif
                        <li>
                        {!!link_to('admin/perfilNew', '&nbsp;&nbsp;&nbsp; Perfil',array('class'=>'fa fa-user')) !!}
                        </li>
                        <li>
                             {!!link_to('admin/menus', '&nbsp;&nbsp;&nbsp; Menú',array('class'=>'fa fa-file-o')) !!}
                   
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>

                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>

                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>


                        <li>
                            {!!link_to('/admin', '&nbsp;Inicio',array('class'=>'fa fa-home')) !!}                          
                        </li>

                            @can('menus.Modulodemenu')
                                <li>
                                    <a href="#"><i class="fa fa-magic"></i> Menús <span class="fa arrow "></span></a>
                                   
                                    <!-- /.nav-third-level --><ul class="nav nav-second-level">
                                      <li>
                                              {!!link_to('admin/menus', '&nbsp;&nbsp;&nbsp; Menú',array('class'=>'fa fa-file-o')) !!}

                                        </li>
                                    </ul>
                                </li>
                            @endcan
                            
                            @can('Publicaciones.ModulodePublicaciones')
                                <li>
                                    <a href="#"><i class="fa fa-newspaper-o"></i> Publicaciones <span class="fa arrow "></span></a>
                                    <ul class="nav nav-second-level">
                                    @can('Tipos.Submodulodetipos')
                                         <li>
                                              {!!link_to('admin/types', '&nbsp;&nbsp;&nbsp; Tipos',array('class'=>'fa fa-file-o')) !!}
                                        </li>
                                    @endcan

                                    @can('Secciones.SubmodulodeSecciones')
                                        <li>
                                              {!!link_to('admin/sections', ' Secciones',array('class'=>'glyphicon glyphicon-book')) !!}
                                        </li>
                                    @endcan

                                    @can('Categorias.SubmodulodeCategorias')
                                        <li>
                                             {!!link_to('admin/category', ' Categorias',array('class'=>'glyphicon glyphicon-object-align-horizontal')) !!}
                                        </li>
                                    @endcan

                                    @can('Documentos.SubmodulodeDocumentos')
                                        <li>
                                             {!!link_to('admin/document', '&nbsp;&nbsp;&nbsp; Documentos',array('class'=>'fa fa-book')) !!}
                                        </li>
                                    @endcan

                                    @can('Comentarios.SubmodulodeComentarios')
                                        <li>
                                            {!!link_to('admin/comments', '&nbsp;&nbsp;&nbsp; Comentarios',array('class'=>'fa fa-comment-o')) !!}
                                        </li>
                                    @endcan
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>  
                            @endcan     

                            @can('archivos')
                                <li>
                                    <a href="#" class="fa fa-camera"> Archivos <span class="fa arrow"></span></a>
                                    <ul class="nav nav-second-level">
                                    @can('Albums.SubmodulodeAlbums')
                                        <li>
                                            {!!link_to('admin/media', '&nbsp;&nbsp;&nbsp;Albums',array('class'=>'fa fa-picture-o ')) !!}
                                        </li> 
                                    @endcan

                                    @can('Directorio.SubmodulodeDirectorio')                                   
                                        <li>
                                            {!!link_to('admin/directory', '&nbsp;&nbsp;&nbsp;Directorio',array('class'=>'fa fa-folder-open ')) !!}
                                        </li>
                                    @endcan
                                    </ul>
                                </li>   
                            @endcan   

                        @can('Usuarios.ModulodeUsuarios')                                   
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i>Usuarios<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            @can('Usuarios.SubmodulodeUsuarios')
                                <li>
                                    {!!link_to('/usuario', '&nbsp;&nbsp;&nbsp;Usuarios',array('class'=>'fa fa-user ')) !!}                                   
                                </li>
                            @endcan  

                            @can('Roles.SubmodulodeRoles')
                                <li>
                                    {!!link_to('admin/roles', '&nbsp;&nbsp;&nbsp;Roles',array('class'=>'fa fa-flag-o ')) !!}                                     
                                </li>
                            @endcan

                            @can('Módulos.Asignarpermisos')
                                 <li>
                                    {!!link_to('admin/cms', '&nbsp;&nbsp;&nbsp;Módulos',array('class'=>'fa fa-cubes')) !!}                         
                                </li>
                            @endcan

                            @can('Configuración.Asignarpermisosamodulos')
                                <li>
                                    {!!link_to('admin/configPermission', '&nbsp;&nbsp;&nbsp;Configuracion',array('class'=>'fa fa fa-cog')) !!}
                                </li>
                            @endcan
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        @endcan

                        @can('Configuraciónes.Modulodeconfiguraciondemetas')  
                            <li>
                                <a href="#"><i class="fa fa-cogs fa-lg"></i> Cofiguración<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                    <li>
                                        {!!link_to('admin/seting', '&nbsp;&nbsp;&nbsp;Confi Metas',array('class'=>'fa fa fa-cog')) !!}
                                    </li>
                                </ul>
                            </li>
                        @endcan
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

 <div id="page-wrapper">
         
            @yield('content')

         
</div>
 <div class="panel-footer">   
 </div>
<!-- fin de contenido-->
   
    <!-- /#wrapper -->

    <!-- jQuery -->
    {!! Html::script('../bower_components/jquery/dist/jquery.min.js') !!}

    <!-- Bootstrap Core JavaScript -->
    {!! Html::script('../bower_components/bootstrap/dist/js/bootstrap.min.js') !!}    

    <!-- Metis Menu Plugin JavaScript -->
    {!! Html::script('../bower_components/metisMenu/dist/metisMenu.min.js') !!}    
    


    <!-- Morris Charts JavaScript -->
    {!! Html::script('../bower_components/raphael/raphael-min.js') !!}    
    
    <!-- Custom Theme JavaScript -->

    <!-- Morris Charts JavaScript -->
    {!! Html::script('../bower_components/raphael/raphael-min.js') !!}    
    

    <!-- Custom Theme JavaScript -->
    {!! Html::script('../dist/js/sb-admin-2.js') !!}        
    
<script>
        function imageUp(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imgUpTo').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

    $("#imgLoad").change(function(){
        imageUp(this);
    });
</script>

<script>

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$("#id_section").change(event => {    
    $.get(`getSelect/${event.target.value}`, function(res, sta){
        $("#id_category").empty();
        res.forEach(element => {
            console.log(element.title);
            console.log(element.id);
            $("#id_category").append(`<option value=${element.id}> ${element.title} </option>`);
        });
    });
});


$("#id_section_menu").change(event => {    
    $.get(`../../getSelect/${event.target.value}`, function(res, sta){
        $("#id_category_menu").empty();
        res.forEach(element => {
            console.log(element.title);
            console.log(element.id);
            $("#id_category_menu").append(`<option value=${element.id}> ${element.title} </option>`);
        });
    });
});


$("#id_category_menu").change(event => {    
    $.get(`../../getSelectDoc/${event.target.value}`, function(res, sta){
        $("#id_document_menu").empty();
        res.forEach(element => {
        console.log(event.target.value);
           console.log(element.title);
           console.log(element.id);            
           $("#id_document_menu").append(`<option value=${element.id}> ${element.title} </option>`);
        });
    });
});


</script>

<script>
  initSample();
</script>
</body>
</html>
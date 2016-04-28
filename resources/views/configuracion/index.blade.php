@extends('layouts.app')
@section('content')

<?php

$banderaModulo=0;


if(isset($modulos)) 
{
    $banderaModulo=1;
}

else
{
    $modulos=null;
}


 ?>


    <div class="col-md-12"><h3 class="head">Modulos</h3>
    </div>                
                <br><br><br>              					   
               
                  {!!Form::open(['route'=>'admin.config.store','method','POST'])!!}                   
                    <div class="col-md-12">
                        {!! Form::label('id', 'Selecciona el rol') !!}
                        {!! Form::select('id',$roles, null,['class'=>'form-control select2']) !!}

                    <br><br>
                    @if($banderaModulo==1 && $modulos!=null)
                        @foreach($modulos as $modulo)
                        <div class="btn-group">
                          <button type="submit" class="btn btn-default" name="boton"  value="<?php echo $modulo->id ?>">
                            <?php echo $modulo->title ?>
                          </button>

                          <button type = "button" class = "btn btn-primary dropdown-toggle" data-toggle = "dropdown">
                              <span class = "caret"></span>                             
                          </button>

                            <ul class = "dropdown-menu" role = "menu">
                               
                           @foreach($submodulos as $m)
                               @if($modulo->id==$m->id_parent)  <li>
                                    <button type="submit" class="btn btn-default" style="width: 100%; border:none;" name="boton" value="<?php echo $m->id ?>"><?php echo $m->title ?></button>  </li>  
                                @endif
                            @endForeach
                           
                             </ul>  
                        </div>
                            @endForeach                        
                    @else
                        <div class="col-md-12"><h3 class="head">No hay módulos disponibles</h3>
                        </div>
                    @endif
                    
</div>
                 {!!Form::close()!!}
                        
    </div>               

@stop


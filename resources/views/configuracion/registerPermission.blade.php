<?php
  if(isset($path))
  {
    
  }

  else
  {
    $path="";
  }

?>

@extends('layouts.app')
@section('content')
  <div class="panel-heading">
        <br>
        <h2 class="panel-title">
        <i class="fa fa-pencil fa-lg"><?php echo "Rol: ".$nombreRol?></i>&nbsp;&nbsp;&nbsp;&nbsp;
        <i class="fa fa-cube fa-lg"> <?php echo "Modulo: ".$nombreModulo?></i>
            </h2> 
  </div>          
                <!---CheckBox-->
                {!!Form::open(['route'=>'admin.config.store','method','POST'])!!}                
                {!! Form::hidden('idRole', $idRole) !!}
                {!! Form::hidden('idModule', $idModulo) !!}
                <input type="hidden" name="jsn" id="jsn"><br>
 
                <!--<input type="checkbox" name="all" id="all" value="all" onclick="checkAll()"/>-->
                <div class="row">
                  <div class="col-md-3">
                    <label onclick="checkAll()" style="color: #008CBA">Seleccionar todo</label>
                  </div>
                  <div class="col-md-3">
                    <label onclick="uncheckAll()" style="color: #008CBA">Deseleccionar todo</label>
                  </div>
                 </div>
                 <br>
                 <div class="row">
                <div class="permissionGroup">
                  <div class="col-md-12">

                  <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">


                  <div class="col-md-12">
              <div class="well well-sm" style="height: 150px; overflow: auto;">

                  <div class="checkboxes">
                    @if($json!=null)
                        @if($b==1)
                         @foreach ($json as $item=>$valor)
                            <?php
                              $array=explode('.', $item);
                              $nombre=array_pop($array);
                            ?>
                              <?php 
                                if($valor=="1"){$ch="checked";}
                                else{$ch="unchecked";} 
                              ?>
                               <div class="checkbox">  
                                <label>                     
                                      <input type="checkbox" name="role[]" value="<?php echo $nombre; ?>" onclick="check()" <?php echo $ch; ?>/><?php echo $nombre; ?>
                                </label> 
                              </div> 
                          @endforeach

                       

                        @else
                          @foreach ($json as $item)
                              <div class="checkbox">  
                                <label>                     
                                      <input type="checkbox" name="role[]" value="<?php echo $item->title; ?>  " onclick="check()" unchecked/><?php echo $item->title; ?>
                                </label> 
                              </div> 
                             
                          @endforeach
                           @endif
                      @else
                        <label>No hay permisos para este Módulo</label>
                    @endif
                   </div>
                  </div>
                </div>
                      @if($json!=null)
                         <div class="pull-right">
                            <div class="col-md-2"> <br> <br>
                                {!!Form::submit('Guardar',['class'=>'btn  btn-primary frmEspacios','placeholder'=>''])!!}
                            </div>
                        </div>
                      @endif

                    
                    </div>
                  </div>
                </div>
                 {!!Form::close()!!}

 <?php $d=$_SERVER['HTTP_HOST'];?>
<script>  
   function checkAll()
   {
      var boxes=document.getElementsByTagName('input');
    
      for(i=0;i<boxes.length-1;i++)
      {
        boxes[i].checked=true;
      }      

      check();
    }

    function uncheckAll()
   {
      var boxes=document.getElementsByTagName('input');
    
      for(i=0;i<boxes.length-1;i++)
      {
        boxes[i].checked=false;
      }      

       check();
    }

    function check()
    {
      document.getElementById("jsn").value = "";

      var boxes=document.getElementsByTagName('input');
      
      var path="";
      var path="<?php  echo $path;?>";
      var json="";
      var json="{";

      for(i=6;i<boxes.length-1;i++)
      {
        var value = boxes[i].value;
        var active=boxes[i].checked;
        
        json = json +'"'+path+"."+value+'"'+ ":" + active + ",";
      }

      json=json.slice(0,-1);

      json+="}";

      if(json.length<2)
      {
        document.getElementById("jsn").value = "";
      }

      else
      {
        document.getElementById("jsn").value = json;
      }

    }


</script>
@stop
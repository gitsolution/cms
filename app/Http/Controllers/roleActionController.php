<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\usr_role_action;
use DB;
use Session;
use Redirect;
use Auth;
use View;

class roleActionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function store(Request $request)
    {
        $idRole=$request['idRole'];
        $idModulo=$request['idModulo'];
        
        $valida=DB::table('usr_role_actions')->where('id_role', $request['idRole'])->where('id_access', $request['idModulo'])->where('action', $request['action'])->first();

                if($valida==null)
                {
                    $activado='0';
                    if($request ['chkActivado']== "on")
                    {
                        $activado='1';
                    }

                    $acceso='0';
                    if($request ['chkAcceso']== "on")
                    {
                        $acceso='1';
                    }

                    \App\usr_role_action::create([
                        'id_role'=>$request['idRole'],
                        'id_access'=>$request['idModulo'],
                        'action'=>$request['action'],
                        'allowed'=>'1',
                        'access'=>$acceso,
                        'active'=>$activado,
                        'register_by'=>Auth::User()->id,
                        'modify_by'=>Auth::User()->id,

                    ]);

                    return View::make("configuracion/registerpermission",compact('idRole','idModulo'));
                }

                else
                {       
                    return View::make("configuracion/registerpermission",compact('idRole','idModulo'));
                }
           


    }

    public function actualizar($idRole,$idModulo,$action,$active)
    {   
            $roleAction = new usr_role_action;
            if($active=='True')
            { 
                $act = 0;
            }
            
            else
            { 
                $act = 1; 
            }
            
            $usrRol = DB::table('usr_role_actions')->where('id_role','=', $idRole)->where('id_access', '=',$idModulo)->where('action','=', $action)->update(['active'=>$act]); 

            return View::make("configuracion/registerpermission",compact('idRole','idModulo'));
        }

     
}







        /*
        echo $request['idRole']."<br>";
        echo $request['idModulo']."<br>";

         
        echo json_encode($request['menuIndex']);
        echo json_encode($request['index']);
        return ;

        $dato = $request['menuIndex'];
        $num=count($dato);

        $chkJson='[{';      

        for($i=0;$i<$num;$i++)
        {
            $chkJson.= '"'.$dato[$i].'":"1",';
        }

        $chkJson=substr($chkJson,0,-1);
        $chkJson.='}]';

        echo "Json: ".$chkJson;
        
        $ura = new \App\usr_role_action;
        $ura=$chkJson->toJson();
      
        $ura->save();
        


        $ura = new \App\usr_role_action;
        $ura->id_role=$request['idRole'];
        $ura->id_access=$request['idModulo'];
        $ura->action=json_encode(array($chkJson[0],true));
        $ura->allowed='1';
        $ura->access='0';
        $ura->active='0';

        $ura->save();

        return "<br><br>guardados";

















        \App\usr_role_action::create([
                'id_role'=>$request['idRole'],
                'id_access'=>$request['idModulo'],
                'action'=>json_encode(array($chkJson=> [0]) ),
                'allowed'=>json_encode(array('valor'=>$chkJson[0]) ),
                'access'=>'0',
                'active'=>'0',
            ]);
        

        for($i=0;$i<$num;$i++)
        {
            $action=$dato[$i];
            \App\usr_role_action::create([
                'id_role'=>$request['idRole'],
                'id_access'=>$request['idModulo'],
                'action'=>$action,
                'allowed'=>'1',
                'access'=>'0',
                'active'=>'0',
            ]);
        }

        return "Datos guardados";
        */
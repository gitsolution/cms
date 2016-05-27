<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Session; 
use User;
use Auth;
use Redirect;
use Gate;

class typeController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {
      if(Gate::denies('Publicaciones.ModulodePublicaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Tipos.Submodulodetipos'))
      {
        Auth::logout();
        return Redirect('login');
      }
      
    $flag='1';  
    $Types =  DB::table('cms_types')->where('active','=', $flag)->paginate(20);
    
        return view('types/index',compact('Types'));
   }



   public function type()
    {
       if(Gate::denies('Publicaciones.ModulodePublicaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Tipos.Submodulodetipos'))
      {
        Auth::logout();
        return Redirect('login');
      }
          $Types=null;
        return view('types.typeform','Types');
    }
public function typenew(){
   if(Gate::denies('Publicaciones.ModulodePublicaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Tipos.Submodulodetipos'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('admin.Tipos.Crear'))
      {
        Auth::logout();
        return Redirect('login');
      }
    return view('types/typeform');
  }


    public function store(Request $request)
    {
       if(Gate::denies('Publicaciones.ModulodePublicaciones'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('Tipos.Submodulodetipos'))
      {
        Auth::logout();
        return Redirect('login');
      }

      if(Gate::denies('admin.Tipos.Crear'))
      {
        Auth::logout();
        return Redirect('login');
      }

      \App\cms_type::create([
      'title' => $request['title'],
      'description'=>$request['description'],
      'active'=>'1',

      'register_by'=>Auth::User()->id,
      
      'modify_by'=>Auth::User()->id,
      
      ]);
      return redirect('admin/types');
      
    }
     public function edit($id)
      {
        if(Gate::denies('Publicaciones.ModulodePublicaciones'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Tipos.Submodulodetipos'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('tipos-editar'))
        {
          Auth::logout();
          return Redirect('login');
        }

          $Types = \App\cms_type::find($id);
          return view('types/typeform')->with('Types',$Types);
      }
     public function update($id, Request $request)
      {
        if(Gate::denies('Publicaciones.ModulodePublicaciones'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Tipos.Submodulodetipos'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('tipos-editar'))
        {
          Auth::logout();
          return Redirect('login');
        }
            $Types = \App\cms_type::find($id);
            $Types->fill($request->all());
            $Types->modify_by=Auth::User()->id;
            $Types->save();
            Session::flash('message','Usuario Actualizado Correctamente');    
            return redirect('admin/types')->with('message','store');       
      }

      public function delete($id)
      {
        if(Gate::denies('Publicaciones.ModulodePublicaciones'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('Tipos.Submodulodetipos'))
        {
          Auth::logout();
          return Redirect('login');
        }

        if(Gate::denies('tipos-eliminar'))
        {
          Auth::logout();
          return Redirect('login');
        }
          $Types = \App\cms_type::find($id);
          $Types->active=0;
          $Types->save();
          Session::flash('message','Usuario Eliminado Correctamente');    
          return redirect('admin/types')->with('message','store');
      }

    

    
}

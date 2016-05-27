<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;
use Auth;
use Gate;

class languageController extends Controller
{
    //
  public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
  {
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }
         $flag='1'; 
         $languages =  DB::table('cms_language')->where('active','=', $flag)->orderBy('id','ASC')->paginate(20);
         return view('languages/index',['languages'=>$languages ]);
  }


  public function create(){
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Lenguajes.Crearlenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    return view('languages/languageform');
  }


  public function store(Request $request){
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Lenguajes.Crearlenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }
       $active='1'; 
       \App\cms_language::create([
      'label'=>$request['label'],
      'description'=>$request['description'],
      'code'=>$request['code'],
      'short_code'=>$request['short_code'],
      'active'=>$active,
      'status'=>"",
      ]);
      Session::flash('message','Registro Guardado Correctamente');    

      return redirect('/admin/languages');

  }

  public function edit($id){
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Lenguajes.Editarlenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }
      $language = \App\cms_language::find($id);
      return view('languages/languageform')->with('language',$language);
  }

  public function update($id,Request $request){
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Lenguajes.Editarlenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }
    $menu = \App\cms_language::find($id);
    $menu->fill($request->all());   
    $menu->save();   
    return redirect('/admin/languages')->with('message','Lenguaje Actualizado Correctamente');
  }

  public function destroy($id){
    if(Gate::denies('Lenguajes.Modulodelenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    if(Gate::denies('Lenguajes.Eliminarlenguaje'))
    {
      Auth::logout();
      return Redirect('login');
    }

    
    $language = \App\cms_language::find($id);
    $language->active=0;
    $language->save(); 
    return redirect('/admin/languages')->with('message','Lenguaje Eliminado');
  }

}

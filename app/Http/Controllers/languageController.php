<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use DB;

class languageController extends Controller
{
    //
  public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {
        
         $flag='1'; 
         $languages =  DB::table('cms_language')->where('active','=', $flag)->orderBy('id','ASC')->paginate(20);
         return view('languages/index',['languages'=>$languages ]);
   }


  public function create(){
    return view('languages/languageform');
  }


  public function store(Request $request){
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
      $language = \App\cms_language::find($id);
      return view('languages/languageform')->with('language',$language);
      }

  public function update($id,Request $request){
    $menu = \App\cms_language::find($id);
    $menu->fill($request->all());   
    $menu->save();   
    return redirect('/admin/languages')->with('message','Lenguaje Actualizado Correctamente');
  }

  public function destroy($id){
    $language = \App\cms_language::find($id);
    $language->active=0;
    $language->save(); 
    return redirect('/admin/languages')->with('message','Lenguaje Eliminado');
  }

}

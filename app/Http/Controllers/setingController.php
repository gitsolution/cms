<?php

namespace App\Http\Controllers;
use Session;
use Illuminate\Http\Request;
use DB;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class setingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }  
    
  public function index()
   {       
    $flag='1';
 
    $Sections = DB::table('cms_senttingspages')
            ->select('cms_senttingspages.*')
            ->where('cms_senttingspages.active','=', $flag)
            ->orderBy('id','DESC')            
            ->paginate(20);
            return view('setings/index',compact('Sections'));

   }


  public function seting()
    {
        
        $Sections=null;
        return view('setings.sectionform',['Sections'=>$Sections]);
    }

    
  public  function store(Request $request)
    {   
      
		  \App\cms_senttingspage::create([
          'clave'=>$request['clave'],
          'value' => $request['value'],
          'active'=>'1',//$request[''],
          'register_by'=>Auth::User()->id,
          'modify_by'=>Auth::User()->id,
      
          ]);
                      

          return redirect('admin/seting');
      }

  public function edit($id)
      {
          
          $Seting = \App\cms_senttingspage::find($id);

          return view('setings.sectionform', compact('Seting'));
      }


  public function update($id, Request $request)
      {
            $Section = \App\cms_senttingspage::find($id);                      
            $Section->fill($request->all());
            $Section->modify_by=Auth::User()->id;
         
            $Section->save();
            Session::flash('message','Seccion Actualizada Correctamente');    
            return redirect('admin/seting');       
      }
      public function delete($id)
      {
          $Section = \App\cms_senttingspage::find($id);
          $Section->active=0;
          $Section->save();
          Session::flash('message','Sección Eliminada Correctamente');    
          return redirect('/admin/seting');
      }


    

}

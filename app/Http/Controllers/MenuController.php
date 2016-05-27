<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use DB;
use Auth;
use Redirect;
use Gate;

class MenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
		$flag='1';	
		$menus =  DB::table('men_menus')->where('active','=', $flag)->orderBy('order_by','DESC')->paginate(20);
		return view('menu/index',compact('menus'));
	}

	public function menunew(){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.Crear'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
		return view('menu/menuform');
	}


	public function create(){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.Crear'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
		return view('menuform');
	}


	public function store(Request $request){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.Crear'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

		$publish= 0;
		$index_page=0;
		if($request['publish']='on')
		{
			$publish=1;
		}

	   $flag=1;
       $orderBy =  (DB::table('men_menus')->where('active','=', $flag)->max('order_by'))+1;
     		\App\Menu::create([
			'id_men_type'=>$request['id_men_type'],	
			'id_language'=>$request['id_language'],
			'title'=>$request['title'],
			'description'=>$request['description'],
			'uri'=>'',
			'order_by'=>$orderBy,
			'active'=>'1',//$request['active'],
			'register_by'=>'1',//$request['resgiter_by'],
			'modify_by'=>'1',//$request['modify_by'], 
			]);
			Session::flash('message','Registro Guardado Correctamente');		

		return redirect('/admin/menus');

	}


	public function show($id){
		return "SHOW ".$id;
	}

	public function edit($id){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.editar'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
			$menu = \App\Menu::find($id);
			return view('menu/menuform')->with('menu',$menu);
    	}



	public function update($id,Request $request){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.editar'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

        $menu = \App\Menu::find($id);
		$menu->fill($request->all());		
		$menu->save();
		Session::flash('message','Usuario Actualizado Correctamente');		
		return redirect('/admin/menus')->with('message','store');
	}

	public function delete($id){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.eliminar'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

        $menu = \App\Menu::find($id);
		$menu->active=0;
		$menu->save();
		Session::flash('message','Usuario Eliminado Correctamente');		
		return redirect('/admin/menus')->with('message','store');
	}


	public function order($id, $orderBy, $no){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.ordenar'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

		// Actualizamos el registro con id
		$flag=1;
		$this->setOrderItem($flag,$orderBy, $no);	
		$menu = \App\Menu::find($id);
		$menu->order_by=$no;
		$menu->save();		
		Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/menus');
	}


	public function setOrderItem($flag,$orderBy, $no)
	{
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }

	    if(Gate::denies('menu.ordenar'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
		$noAux=$no;
		$menu = DB::table('men_menus')->where('active','=', $flag)->where('order_by', '=',$no)->get();		
		if($orderBy=='Up'){	
			$noAux=$noAux-1;
			}else { 		
			$noAux=$noAux+1;			
		}
		$menu =  Null;	
		$menu = DB::table('men_menus')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);		
	}

	public function publicate($id,$pub){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
		$flag=1;
		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
		$menu = DB::table('men_menus')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);			       
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/menus')->with('message','store');
	}

  
	public function index_page($id,$ind){
		if(Gate::denies('menus.Modulodemenu'))
	    {
	      Auth::logout();
	      return Redirect('login');
	    }
       	$flag=1; 
			if($ind=='True'){ $ind = 1;}else{ $ind = 0; }
		$menu = DB::table('men_menus')->where('active','=', $flag)->where('id', '=',$id)->update(['index_page'=>$ind]);			       
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/menus')->with('message','store');
	
	}
	public function destroy($id)
	{
	
	}


}

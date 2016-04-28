<?php

namespace App\Http\Controllers;

use Storage;
use File;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;
use View;
use Session;
use Redirect;

class ItemMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index($id_menu, $id_parent){
		$flag = '1';	
		$level='0';
		if($id_parent>0){
			$menuItem = \App\ItemMenu::find($id_parent); 					
			$level = $menuItem->level+1;
		}

		$menu=\App\Menu::find($id_menu); 	
		$itemMenus =  DB::table('men_items')
		    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
            ->select('men_items.*', 'men_menus.title as menuname')        
        	->where('men_items.active','=', $flag)
        	->where('men_items.id_parent','=', $id_parent)
        	->where('men_items.id_menu','=',$id_menu)->orderBy('men_items.order_by','DESC')->paginate(20);    
         	return view('itemmenu/index',['itemMenus'=>$itemMenus,'menu'=>$menu, 'id_parent'=>$id_parent, "level"=>$level]);
       }


public function optionmenu($option, $id_menu, $id_parent){
		$flag='1';
		$level='0';	
		$menu=\App\Menu::find($id_menu); 	
		$itemMenus =  DB::table('men_items')
		    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
            ->select('men_items.*', 'men_menus.title as menuname')        
        	->where('men_items.active','=', $flag)
        	->where('men_items.id_menu','=',$id_menu)->orderBy('men_items.order_by','DESC')->paginate(20);        	

        	if($id_parent>0)
			{
				$menuItem=\App\ItemMenu::find($id_parent); 
				$level=$menuItem->level+1;
			}


		/*
					if($id_parent=='0')
					{
						$level=0;
					}
					else
					{
						$level=  (DB::table('men_items')->where('active','=', $flag)->where('id_menu','=', $id_menu)->where('id','=', $id_parent)->max('order_by'))+1;
					}
		*/

		switch($option)		
		{
	 
		case 'optionmenu':
			return view('itemmenu/option',['id_menu'=>$id_menu,'id_parent'=>$id_parent,'level'=>$level]);

		break;
		case 'LinkTo':		 
		return view('itemmenu/itemmenuform',['menu'=>$menu,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
		break;
		case 'LinkToSec':		
			$Sections =  DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	$Categories = null;
		   	$Documents = null;
		   	return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections, 'Categories'=>$Categories, 'Documents'=>$Documents,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
 			break;
		  	case 'LinkToCatList':
		    $Sections =  DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	$id_section=  (DB::table('cms_sections')->where('active','=', $flag)->min('id'));
		   	$Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->orderBy('order_by','DESC')->get();  		
			$Documents = null;		   			    
			return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections, 'Categories'=>$Categories, 'Documents'=>$Documents,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
		    break;
		     case 'LinkToCat':
			$Sections =  DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	$id_section=  (DB::table('cms_sections')->where('active','=', $flag)->min('id'));
		   	$Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->orderBy('order_by','DESC')->get();  		
			$Documents = null;		   			    		    
			return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections, 'Categories'=>$Categories, 'Documents'=>$Documents,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
		    
		    break;       
		    case 'LinkToDocList':
		   	$Sections = DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	$id_section = (DB::table('cms_sections')->where('active','=', $flag)->min('id'));
		   	$Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->orderBy('order_by','DESC')->get();
		   
		   	$id_category = (DB::table('cms_categories')->where('active','=', $flag)->min('id'));		   	  		
					   			    
			$Documents = DB::table('cms_documents')->where('active','=', $flag)->where('id_category','=', $id_category)->orderBy('order_by','DESC')->get();  		
			$id_document = (DB::table('cms_documents')->where('active','=', $flag)->min('id'));		   	  		
			
			return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections, 'Categories'=>$Categories, 'Documents'=>$Documents,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
 				
		    break;
		    case 'LinkToDoc':
		    $Sections = DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	$id_section = (DB::table('cms_sections')->where('active','=', $flag)->min('id'));
		   	$Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section','=', $id_section)->orderBy('order_by','DESC')->get();
		   
		   	$id_category = (DB::table('cms_categories')->where('active','=', $flag)->min('id'));		   	  		
					   			    
			$Documents = DB::table('cms_documents')->where('active','=', $flag)->where('id_category','=', $id_category)->orderBy('order_by','DESC')->get();  		
			$id_document = (DB::table('cms_documents')->where('active','=', $flag)->min('id'));		   	  		
			
			return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections, 'Categories'=>$Categories, 'Documents'=>$Documents,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
 			

		    break;      
		    case 'LinkToGalList':		    
		    $Galleries = DB::table('med_albums')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	
			return view('itemmenu/gallerymenuform',['menu'=>$menu,'Galleries'=>$Galleries, 'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);		
		    break;   
		    case 'LinkToGallery':
			$Galleries = DB::table('med_albums')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  				   	
			return view('itemmenu/gallerymenuform',['menu'=>$menu,'Galleries'=>$Galleries, 'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent,'option'=>$option]);				   
		    break;      
		default:
		return ;
	}

}



	public function submenu($id_menu, $id_item){

		$flag='1';	
		$menu=\App\Menu::find($id_menu);				 	
		$itemMenus =  DB::table('men_items')
		    ->join('men_menus', 'men_items.id_menu', '=', 'men_menus.id')            
            ->select('men_items.*', 'men_menus.title as menuname')        
        	->where('men_items.active','=', $flag)
        	->where('men_items.id_menu','=',$id_menu) 
        	->where('men_items.id_menu','=',$id_item)
        	->orderBy('men_items.order_by','DESC')->paginate(20);        	
			return view('itemmenu/index',['itemMenus'=>$itemMenus,'menu'=>$menu]);
	}

	public function addmenu($menu){
		 
	}

	public function addsubmenu($option, $id_menu){
		


	   return view('itemmenuform',['itemMenu'=>$itemMenu,'menu'=>$menu]);		
	}




	public function itemnew($id_menu){
		$flag='1';	 
		$menu=\App\Menu::find($id_menu);
		$itemMenu= null;
        return view('itemmenu/itemmenuform',['itemMenu'=>$itemMenu,'menu'=>$menu]);		
	}

	public function optionnew($id_menu, $typemenu){
		$flag='1';	 
		$menu=\App\Menu::find($id_menu);
		$itemMenu= null;
        return view('itemmenu/itemmenuform',['itemMenu'=>$itemMenu,'menu'=>$menu,'typemenu'=>$typemenu]);		
	}
	
	 

	public function typemenu($id_menu, $id_parent, $typemenu){
		$flag=1;
		$menu = \App\Menu::find($id_menu); 	
		$menu=\App\ItemMenu::find($id_menu); 
			$id_parent = $menu->id;


			if($id_parent=='0')
			{
				$level=0;
			}
			else
			{
				$level=  (DB::table('men_items')->where('active','=', $flag)->where('id_menu','=', $id_menu)->where('id','=', $id_parent)->max('order_by'))+1;
			}	

		    switch ($typemenu){
		    case 'LinkTo':
		   	return view('itemmenu/itemmenuform',['menu'=>$menu,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent]);		
		   	break;		    
		    case 'LinkToSec':
			//$id_type=1;/// 1 = Tipo Página
			$Sections =  DB::table('cms_sections')->where('active','=', $flag)->orderBy('order_by','DESC')->get();  		
		   	return view('itemmenu/pagesmenuform',['menu'=>$menu,'Sections'=>$Sections,'id_menu'=>$id_menu,'level'=>$level, 'id_parent'=>$id_parent]);		
		    
		    break;
		  		    
		   
		    default:
		    }


		  	
	}

	public function create($id_menu){	
		$flag='1';	
		$menu = DB::table('med_albums')->where('active','=', $flag)->orderBy('order_by','DESC')->get();
		$itemMenu = null;		
        return view('itemmenu.itemmenuform',['itemMenu'=>$itemMenu,'menu'=>$menu]);	
	}


	public function store(Request $request){
		$publish = 0;
		$private = 0;
		$id_parent=0;
		$uri="";
		
		$id_menu=$request['id_menu'];

		if($request['publish']=='on')			
		{
			$publish=1;
		}
		else
		{
			$publish=0;		
		}

		if($request['id_parent']!="")
		{
			$id_parent=$request['id_parent']; 
		}
 /******************************************************/

		switch($request['option'])		
		{
	 	
		case 'LinkTo':		
			
		if($request['uri']!=""){
				$uri=$request['uri'];
		}
		break;
		case 'LinkToSec':		
			$id_section = $request['id_section_menu'];

			$Section=\App\cms_section::find($id_section); 	

			if($id_section>0){
				$uri="Sec/".$Section->uri;
			}
				
			break;
		  	case 'LinkToCatList':
		    $id_section = $request['id_section_menu'];
			$Section=\App\cms_section::find($id_section); 	
			if($id_section!=""){
				$uri="CatList/".$Section->uri;
			}
				

		    break;
		     case 'LinkToCat':
		    
		   	$id_category = $request['id_category_menu'];
			$Category=\App\cms_category::find($id_category); 	

		   	if($id_category>0){
				$uri="Cat/".$Category->uri;
			}


		    break;       
		    case 'LinkToDocList':
		    $id_category = $request['id_category_menu'];
			$Category=\App\cms_category::find($id_category); 	
		   	if($id_category!=""){
				$uri="DocList/".$Category->uri;
			}

		    break;
		    case 'LinkToDoc':
		    $id_document = $request['id_document_menu'];
			$Document=\App\cms_document::find($id_document);
			
		    if($id_document>0){
				$uri="Doc/".$Document->uri;
			}		
		    break;      
		    case 'LinkToGalList':		    
		    $id_galleries=1;

		    	$uri="Galleries";
			
		    break;   
		    case 'LinkToGallery':
			
		    $id_galleries=$request['id_galleries'];
		    $Gallery=\App\Media::find($id_galleries);
		   	
			if($id_galleries>0){
				$uri="Gal/".$Gallery->uri;
			}	

		    break;      
			default:
			return null ;
}
 
/*******************************************************/


 	 $file = $request->file('file');    
      if($file!=""){ 
      $path='store/MEN/'.uniqid().'.'.$file->getClientOriginalExtension();
      //indicamos que queremos guardar un nuevo archivo en el disco local
       Storage::disk('local')->put($path,  File::get($file));
      $ext=$file->getClientOriginalExtension();
      }
      else
      {
        $path="";
        $ext="";
      }


      if($request['ChekPrivado']=="on")
		{
			$private=1;
		}


/*******************************************************/		


		$level = $request['level'];
		$size = $request['size'];


		 //obtenemos el campo file definido en el formulario
       	 $flag=1;
          
         $orderBy =  (DB::table('men_items')->where('active','=', $flag)->where('id_menu','=', $id_menu)->where('id_parent','=', $id_parent)->max('order_by'))+1;
   
			\App\ItemMenu::create([
			'id_menu'=>$id_menu,	
			'id_parent'=>$id_parent,
			'title'=>$request['title'],
			'description'=>'',
			'size'=>$size,
			'target'=>$request['target'],
			'uri'=>$uri,
			'img'=>$path,
			'ext'=>$ext,
			'level' =>$level,			
			'order_by'=>$orderBy,
			'private'=>$private,									
			'publish'=>$publish,						
			'active'=>'1',
			'register_by'=>Auth::User()->id,
          	'modify_by'=>Auth::User()->id,
			]);	

			return redirect('/admin/itemmenu/'.$id_menu.'/'.$id_parent);

	}


	public function showItems($id_menu){
		$menu = \App\Menu::find($id_menu);
		$flag='1';	
		$items =  DB::table('men_items')->where('active','=', $flag)->where('id_menu','=',$id_menu)->orderBy('order_by','DESC')->paginate(20);
		return view('itemmenu/index',compact('items'));
	}

	public function show($id){
		$flag='1';	
		$items =  DB::table('med_pictures')->where('active','=', $flag)->orderBy('order_by','DESC')->paginate(20);
		return view('itemmenu/index',compact('items'));
	}



	public function edit($id){
		$flag='1';	
		$item =  \App\ItemMenu::find($id); 		
		$menu = \App\Menu::find($item->id_menu); 		

        return view('itemmenu/itemform',['item'=>$item,'menu'=>$menu]);		
    	}

	public function update($id,Request $request){
         $isUpImg=false;
  		 $item = \App\ItemMenu::find($id);		 
         $menu = \App\Menu::find($item->id_menu);
            $path=null;
            $file = $request->file('file');    

            if($file!=""){
            $picture=$item->path;

            $path = uniqid().'.'.$file->getClientOriginalExtension();                                    
            

              if($picture!=$path)
              {

                $isUpImg=true;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('local')->put($path,  File::get($file));

              }
            }
          
            $item->fill($request->all());            
            if($isUpImg){
	            $item->path=$menu->path.$path;
            }

        
		$item->save();
		Session::flash('message','Usuario Actualizado Correctamente');		
				return redirect('/admin/itemmenu/'.$item->id_menu.'/'.$item->id_parent);

	}

	public function delete($id){
        $item = \App\ItemMenu::find($id);
		$item->active=0;
		$item->save();
		Session::flash('message','Imagen Eliminada Correctamente');		
		return redirect('/admin/itemmenu/'.$item->id_menu.'/'.$item->id_parent);

	}

    public function deleteItem($id)
      {

          $item = \App\ItemMenu::find($id);
          $menu = \App\menu::find($item->id_menu);		
          $item->path="";
          $item->save();
          Session::flash('message','Imagen Eliminada Correctamente'); 
          return view('itemmenu.itemmenuform',['item'=>$item,'menu'=>$menu]);

      }

	public function order($id, $orderBy, $no){
		// Actualizamos el registro con id
		$flag=1;
		$this->setOrderItem($flag,$orderBy, $no);

		$item = \App\ItemMenu::find($id);

		$item->order_by=$no;
		$item->save();		
		Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/itemmenu/'.$item->id_menu.'/'.$item->id_parent);
	}


	public function setOrderItem($flag,$orderBy,$no)
	{
		$noAux=$no;
		$item = DB::table('men_items')->where('active','=', $flag)->where('order_by', '=',$no)->get();		
		if($orderBy=='Up'){	
			$noAux=$noAux-1;
			}else { 		
			$noAux=$noAux+1;			
		}
		$item =  Null;	
		$item = DB::table('men_menus')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);		
	}

	public function publicate($id,$pub){
		$flag=1;
		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
		$item = DB::table('men_items')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);	
		$item = \App\ItemMenu::find($id);		       
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/itemmenu/'.$item->id_menu.'/'.$item->id_parent);

	}
 
      public function getEditCategories($no, $id_section, Request $request)
      {
        $Categories=null;
      if($request->ajax()){
          $flag=1;
          $Categories = DB::table('cms_categories')->where('active','=', $flag)->where('id_section', '=',$id_section)->get();     
        return response()->json($Categories);
       }
      }

    public function getEditDocuments($id_category, Request $request)
    {
        $Documents=null;
        if($request->ajax()){
          $flag=1;
          $Documents = DB::table('cms_documents')->where('active','=', $flag)->where('id_category', '=',$id_category)->get();     
          return response()->json($Documents);
   	 }  
    }


	public function index_page($id,$ind){
       	$flag=1; 
			if($ind=='True'){ $ind = 1;}else{ $ind = 0; }
		$item = DB::table('men_items')->where('active','=', $flag)->where('id', '=',$id)->update(['index_page'=>$ind]);			       
	    Session::flash('message','Menú actualizado');		
		return redirect('/admin/itemmenu/'.$item->id_menu);
	
	}
	public function destroy($id)
	{
	
	}


}

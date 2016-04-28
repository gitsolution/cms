<?php

namespace App\Http\Controllers;
use Storage;
use File;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Session;
use DB;


class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index($id_media){

		$flag='1';	
		$media=\App\Media::find($id_media); 	
		$items =  DB::table('med_pictures')
		    ->join('med_albums', 'med_pictures.id_album', '=', 'med_albums.id')            
            ->select('med_pictures.*', 'med_albums.title as album')        
        	->where('med_pictures.active','=', $flag)
        	->where('id_album','=',$id_media)->orderBy('med_pictures.order_by','DESC')->paginate(20);
			return view('pics/index',['items'=>$items,'media'=>$media]);
		
		
	}

	public function itemnew($id_media, Request $request){
		$flag='1';	 
		$media=\App\Media::find($id_media);
		$item= null;

        return view('pics/itemform',['item'=>$item,'media'=>$media]);		
	}


	public function create($id_album){	
		$flag='1';	
		$media = DB::table('med_albums')->where('active','=', $flag)->orderBy('order_by','DESC')->get();
		$item = null;		
        return view('pics.itemform',['item'=>$item,'media'=>$media]);	
	}


	public function store(Request $request){
		$publish= 0;
		$index_page=0;
		$extension="";
		if($request['publish']=='on')
		{
			$publish=1;
		}



		if($request['index_page']=='on')
		{
			$index_page=1;
		}
		     //obtenemos el campo file definido en el formulario
       	  $flag=1;
          $orderBy =  (DB::table('cms_categories')->where('active','=', $flag)->max('order_by'))+1;
          $file = $request->file('file');     
          

          if($file!=""){       
          $media = \App\Media::find($request->id_album);
		  $path=$media->path.uniqid().'.'.$file->getClientOriginalExtension();
          $extension = $file->getClientOriginalExtension();
          //indicamos que queremos guardar un nuevo archivo en el disco local
           Storage::disk('local')->put($path,  File::get($file));
          }
          else{
            $path="";
          }


 	   $flag=1;	   
       $orderBy =  (DB::table('med_pictures')->where('active','=', $flag)->max('order_by'))+1;		 
			\App\Item::create([
			'id_album'=>$request['id_album'],	
			'title'=>$request['title'],
			'description'=>$request['description'],
			'uri'=>$path,
			'publish'=>$publish,
			'publish_date'=>$request['publish_date'],
			'path'=>$path,
			'mime_type'=>$extension,
			'extension'=>$extension,
			'hits'=>'0',//$request['hits'],
			'order_by'=>$orderBy,			
			'active'=>'1',//$request['active'],
			'register_by'=>'1',//$request['resgiter_by'],
			'modify_by'=>'1',//$request['modify_by'], 
			]);

		return redirect('/admin/item/'.$request->id_album);


	}


	public function showItems($id_album){
		$media = \App\Media::find($id_album);
		$flag='1';	
		$items =  DB::table('med_pictures')->where('active','=', $flag)->where('id_album','=',$id_album)->orderBy('order_by','DESC')->paginate(20);
		return view('item/index',compact('items'));
	}

	public function show($id){
		$flag='1';	
		$items =  DB::table('med_pictures')->where('active','=', $flag)->orderBy('order_by','DESC')->paginate(20);
		return view('item/index',compact('items'));
	}



	public function edit($id){
		$flag='1';	
		$item =  \App\Item::find($id); 	

		$media = \App\Media::find($item->id_album); 		

        return view('pics/itemform',['item'=>$item,'media'=>$media]);		
    	}

	public function update($id,Request $request){
         $publish= 0;
		if($request['publish']=='on')
		{
			$publish=1;
		}

         $isUpImg=false;
  		 $item = \App\Item::find($id);		 
         $media = \App\Media::find($item->id_album);
            $path=null;
            $file = $request->file('file');    

            if($file!=""){
            $picture=$item->path;

            $path = $media->path.uniqid().'.'.$file->getClientOriginalExtension();                                    
            

              if($picture!=$path)
              {

                $isUpImg=true;
                //indicamos que queremos guardar un nuevo archivo en el disco local
                Storage::disk('local')->put($path,  File::get($file));

              }
            }
          
            $item->fill($request->all());            
            if($isUpImg){
	            $item->path=$path;               
            }    
        $item->publish=$publish;
 		$item->save();
		Session::flash('message','Usuario Actualizado Correctamente');		
		return redirect('/admin/item/'.$item->id_album);
	}

	public function delete($id){
        $item = \App\Item::find($id);
		$item->active=0;
		$item->save();
		Session::flash('message','Imagen Eliminada Correctamente');		

		return redirect('/admin/item/'.$item->id_album);

	}

    public function deletePicture($id)
      {
          $item = \App\med_picture::find($id);
          $media = \App\Media::find($item->id_album);
          $item->path="";
          $item->save();
          Session::flash('message','Imagen Eliminada Correctamente'); 
          return redirect('/admin/itemedit/'.$item->id);
      }

	public function order($id, $orderBy, $no){
		// Actualizamos el registro con id
		$flag=1;
		$this->setOrderItem($flag,$orderBy, $no);
	
		$item = \App\Item::find($id);
		$item->order_by=$no;
		$item->save();		
		Session::flash('message','Ordén del Albúm actualizado');		

		return redirect('/admin/item/'.$item->id_album);

	}


	public function setOrderItem($flag,$orderBy,$no)
	{
		$noAux=$no;
		$item = DB::table('med_pictures')->where('active','=', $flag)->where('order_by', '=',$no)->get();		
		if($orderBy=='Up'){	
			$noAux=$noAux-1;
			}else { 		
			$noAux=$noAux+1;			
		}
		$item =  Null;	
		$item = DB::table('med_pictures')->where('active','=', $flag)->where('order_by', '=',$no)->update(['order_by'=>$noAux]);		
	
	}

	public function publicate($id,$pub){
		$flag=1;
		if($pub=='True'){ $pub = 1;}else{ $pub = 0; }
		$item = DB::table('med_pictures')->where('active','=', $flag)->where('id', '=',$id)->update(['publish'=>$pub]);			       
	   	$item = null;
	    $item=\App\Item::find($id);	
	    Session::flash('message','Ordén del Albúm actualizado');		
		return redirect('/admin/item/'.$item->id_album);
	

	}

  



	public function index_page($id,$ind){
       	$flag=1; 
			if($ind=='True'){ $ind = 1;}else{ $ind = 0; }
		$item = DB::table('med_pictures')->where('active','=', $flag)->where('id', '=',$id)->update(['index_page'=>$ind]);			       

	    Session::flash('message','Ordén del Albúm actualizado');		

		return redirect('/admin/item/'.$item->id_album);

	
	}
	public function destroy($id)
	{
	
	}


}

<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use App\usr_login_role;
use Gate;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(Gate::denies('verificar-rol'))
        {   
           Auth::logout();
           return redirect('/Inicio');
        }

        $permiso='admin.menu.Guardar'; 
            $roles=DB::table('usr_login_roles')
            ->select('id_role')
            ->whereid_login(3)
            ->whereactive(1)->get();
        

        $permisoC="";
            foreach ($roles as $r) {
                         $join=DB::table('user_module_rol')
                        ->select('access_granted')
                        ->whereid_role($r->id_role)
                        ->whereactive(1)->get();
                        if($join!=null)
                        {
                            foreach ($join as $j) {
                                $permisoC .=$j->access_granted;
                            }
                        }
                    }

            $permisoEspeciales=DB::table('special_permissions')
            ->select('access')
            ->whereid_user(3)
            ->whereactive(1)->get();
            
            $p=str_replace ('"', " ", $permisoC);
            $p=str_replace (' ', "", $p);
            //echo $p;
            $ca='true';
            $resultado = strpos($p, $ca);

            /*foreach ($permisoEspeciales as $pe) 
            {
                $permisoC2 =$pe->access;
            }     
                 
             $json = json_decode($permisoC2, true);
                        foreach ($json as $item=>$value) {
                            echo $item;
                        }
        
            
            if($roles!=null){$b=True;}else{$b=False;}*/

        $document="";
        $hit="";
        $documents = DB::table('cms_documents')     
            ->select('cms_documents.title', 'cms_documents.hits')    
            ->where('cms_documents.active', '=', 1)->get();

        $sections = DB::table('cms_sections')     
            ->select('cms_sections.title', 'cms_sections.hits')    
            ->where('cms_sections.active', '=', 1)->get();

        $categories = DB::table('cms_categories')     
            ->select('cms_categories.title', 'cms_categories.hits')    
            ->where('cms_categories.active', '=', 1)->get();

        $albums = DB::table('med_albums')     
            ->select('med_albums.title', 'med_albums.hits')    
            ->where('med_albums.active', '=', 1)->get();

        $pictures = DB::table('med_pictures')     
            ->select('med_pictures.title', 'med_pictures.hits')    
            ->where('med_pictures.active', '=', 1)->get();

        $directories = DB::table('sys_directories')     
            ->select('sys_directories.title', 'sys_directories.hits')    
            ->where('sys_directories.active', '=', 1)->get();

        $files = DB::table('sys_files')     
            ->select('sys_files.title', 'sys_files.hits')    
            ->where('sys_files.active', '=', 1)->get();

            $document=$this->construirTitulo($documents);
            $hitsdocument=$this->construirHits($documents);

            $section=$this->construirTitulo($sections);
            $hitssection=$this->construirHits($sections);

            $categori=$this->construirTitulo($categories);
            $hitscategories=$this->construirHits($categories);

            $album=$this->construirTitulo($albums);
            $hitsalbum=$this->construirHits($albums);

            $picture=$this->construirTitulo($pictures);
            $hitspicture=$this->construirHits($pictures);

            $directory=$this->construirTitulo($directories);
            $hitsdirectory=$this->construirHits($directories);

            $file=$this->construirTitulo($files);
            $hitsFile=$this->construirHits($files);

            $totalUsuario= DB::table('usr_profiles')   
            ->wherepicture('')->wheregender('')->count();

            $totalComentarios=DB::table('cms_comments')   
            ->wherepublish('0')->whereactive('1')->count();
            
            $totalAlbums= DB::table('med_albums')->count();
            
            return view('home',compact('document','hitsdocument','section','hitssection','categori','hitscategories','album','hitsalbum','picture','hitspicture','totalComentarios','totalUsuario','totalAlbums','directory','hitsdirectory','file','hitsFile'));
    }

    public function construirTitulo($titulos)
    {
        $t="";

         foreach ($titulos as $titulo) 
         {
            $t.='"'.$titulo->title.'",';    
         }

             $t=substr($t, 0, -1);

             return $t;
    }

    public function construirHits($hits)
    {
        $h="";

        foreach ($hits as $hit) 
        {
            $h.='"'.$hit->hits.'",';    
        }

        $h=substr($h, 0, -1);

        return $h;

    }
}

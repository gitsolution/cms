<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class graficaController extends Controller
{
    //
    public function index()
    {
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
            

    	return view('graficas/line',compact('document','hitsdocument','section','hitssection','categori','hitscategories','album','hitsalbum','picture','hitspicture'));
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

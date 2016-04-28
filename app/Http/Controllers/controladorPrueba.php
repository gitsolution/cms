<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class controladorPrueba extends Controller
{
    public function store(Request $request)
    {    	
    		$media= new Item;
	        $media ->whereuri($request['imagen'])->whereactive(1)
	        ->increment('hits');                   
    }

}

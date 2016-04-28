<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class module_permission extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index($id)
	{
		return "";
	}

    public function edit($id)
    {
    	$user = User::find($id);
        $idUser=$id;
        return View::make('modules/index',compact('user','idUser'));
    }

    public function store()
    {
    	return "store";
    }

    public function create()
    {
        return view('modules/moduloFrom');
    }

   
}

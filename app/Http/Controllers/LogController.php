<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;


class LogController extends Controller
{

    public function logout()
    {
        Auth::logout();
        return Redirect::to("Inicio");
    }
}


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
        // echo "HOLAAAA";
        // if ($request->session()->has('id'))
        // {
        //     return view('welcome');
        // }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        // $request->session()->forget('id'); //Elimina el valor del id
        //Esto debe ir en todo lado.
        if (($request->session()->has('id')) and ((int)$request->session()->get('id')!=0))
        {
            return view('welcome');
        }
        else
        {
            return redirect::to('/login');
        }
        // return view('home');
    }

    public function puedeMiembros(Request $request)
    {
        if((int)$request->session()->get('agregarMiembro')!=0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    


}

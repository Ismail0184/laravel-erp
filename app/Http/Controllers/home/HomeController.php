<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Session;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function home()
    {
        return view('dashboard');
    }

    public function module()
    {
        Session::forget('module_id');
        Session::put('module_id', request('module_id'));
        return redirect('/dashboard')->with('module_id',Session('module_id'));
    }

}

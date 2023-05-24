<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        Session::put('module_id', request('module_id'));
        return Session('module_id');
    }
}

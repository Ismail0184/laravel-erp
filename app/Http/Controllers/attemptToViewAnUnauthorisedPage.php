<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class attemptToViewAnUnauthorisedPage extends Controller
{
    public function index()
    {
        return view('layouts.no-access');
    }
}

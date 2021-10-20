<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    public function Dashboard($value='')
    {
        if (Auth::user()->role == "supmin") {
            return view('supmin.index');
        }
    }
}

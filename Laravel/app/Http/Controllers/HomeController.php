<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
public function getLogout(){
    Auth::logout();
    return redirect()->route('home');
}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

}

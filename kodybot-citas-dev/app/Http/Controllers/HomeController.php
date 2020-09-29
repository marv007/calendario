<?php

namespace App\Http\Controllers;

use App\Role;
use \Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //views for users with roles
        if (Auth::user()->role_idrole=='1') { //admin
            return view('pages.admindashboard');
        } else if(Auth::user()->role_idrole=='2') {//superadmin
            return view('pages.superadmindashboard');
        }else if(Auth::user()->role_idrole=='3') {//user         
            return view('pages.userdashboard');
        }
        
    }
}

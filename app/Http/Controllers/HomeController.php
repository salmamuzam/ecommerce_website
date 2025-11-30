<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// Used to check logged in user
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    // Check the user role
    public function index(){

        // If user is customer, redirect to user dashboard
        if(Auth::user()-> user_role =='customer'){
            return view('dashboard');
        }

        // However, if user is admin, redirect to admin dashboard
        else{
            return view ('admin.dashboard');
        }
    }

    public function adminDashboard(){
        return view ('admin.dashboard');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){

        $usertype=Auth()->user()->role;

        if($usertype=='admin')
        {
            return view('livewire.dashboard');
        }
        else if($usertype=='user')
        {
            return view('user.home');
        }
        else
        {
            return redirect("/");
        }
    }

    public function home()
    {
        return view('welcome');
    }

}

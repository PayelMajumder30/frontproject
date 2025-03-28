<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboardview(){
        return view('dashboard');
    }

    public function flotview(){
        return view('flot');
    }

    public function morrisview(){
        return view('morris');
    }

    public function tableview(){
        return view('table');
    }

    public function formsview(){
        return view('forms');
    }

    public function panelswellsview(){
        return view('panels-wells');
    }

    public function notificationsview(){
        return view('notifications');
    }

    public function typographyview(){
        return view('typography');
    }

}

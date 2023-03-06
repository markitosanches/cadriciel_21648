<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(){
        return view('about', ['nom' => 'Peter', 
                              'adresse' => 'Pie IX']);
    }
    public function homePage(){
        return 'Salut';
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index(){
        return view('home');
    }

    public function about(){
        return view('about');
    }
    
    public function message(){
        return view('message');
    }

    public function contact(){
        return view('contact');
    }

    public function formContact(Request $request){
        //return $request;

        return view('contact', ['data' => $request]);
    }
}

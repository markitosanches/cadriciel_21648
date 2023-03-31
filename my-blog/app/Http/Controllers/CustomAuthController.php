<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CustomAuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        $request->validate([
                'name' => 'required|max:25',
                'email' => 'required|email|unique:users',
                'password' => 'min:6|max:20'
            ],
            [
                'name.required' => 'Custom Message' 
            ]);

        //if false  return redirect()->back()->withErrors(validation)->withInput()
        

        $user = new User;
        $user->fill($request->all()); //insert into users (name, email, password) values (....);
        $user->password = Hash::make($request->password);
        $user->save();

        //user->fill TABLE USER col (name, email, password, reset_pass)
        //requestAll (inputs) ( name,  password, email, _token)


        return redirect(route('blog.index'))->withSuccess('User registered');
    }


    public function authentication(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

       if(!Auth::validate($credentials)):
            return redirect(route('login'))->withErrors(trans('auth.password'))->withInput();
       endif;

       $user = Auth::getProvider()->retrieveByCredentials($credentials);
     
       Auth::login($user);

       return redirect()->intended(route('user.list'));

    }
    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function userList() {
        $users = User::select('id','name', 'email')
                ->orderby('name')
                ->paginate(10);

        return view('auth.user-list', ['users' => $users]);
    }
}

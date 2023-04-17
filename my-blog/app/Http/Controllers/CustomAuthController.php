<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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

        $to_email = $request->email;
        $to_name = $request->name;

        $body = "Welcome to my-blog please <a href='#'>cliquez ici pour confirmer cotre compte</a>";

        Mail::send('email.mail', ['name' => $to_name, 
                                'body' => $body],
                            
            function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Courriel de test laravel');
            });

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

    public function forgotPassword(){
        return view('auth.forgot-password');
    }

    public function tempPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users'
        ]);

        $user = User::where('email', $request->email)->first();

        $tempPassword = Str::random(45);

        $user->temp_password = $tempPassword;
        $user->save();

        //new-password/user_id/temp_password

        $body = "Please click to <a href='".route('new-password', [$user->id, $tempPassword])."'>Reset Password</a>";
    
        $to_name = $user->name;
        $to_email = $user->email;

        Mail::send('email.mail', ['name' => $to_name, 
                                'body' => $body],
                            
            function($message) use ($to_name, $to_email){
                $message->to($to_email, $to_name)->subject('Resety Password');
            });
        
        return redirect()->back()->withSuccess('Please check your email');

    }

    public function newPassword(User $user, $tempPassword){

       if($tempPassword === $user->temp_password){

        return view('auth.new-password');

       }

        return redirect(route('login'))->withErrors('Invalid temporary password');

    }

    public function updateNewPassword(User $user, $tempPassword, Request $request){

        if($tempPassword === $user->temp_password){
            
            $request->validate([
                'password' => 'max:20|min:6|confirmed'
            ]);

            $user->password = Hash::make($request->password);
            $user->temp_password = null;
            $user->save();
            return redirect(route('login'))->withSuccess('New Password Success');

        // return view('auth.new-password');
 
        }
 
         return redirect(route('login'))->withErrors('Invalid temporary password');
 
     }

}

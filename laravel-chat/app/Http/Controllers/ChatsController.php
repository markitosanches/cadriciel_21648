<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('chat');
    }
}

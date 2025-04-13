<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(){
        $user = auth::user();
        return response()->json([
            'message'=>'user dashboard',
            'user'=>$user,
        ]);

    }
}

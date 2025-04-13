<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index(){
        $manager = auth::user();
        return response()->json([
            'message'=>'manager dashboard',
            'user'=>$manager,
        ]);

    }
}

<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use HttpResponses;

    public function login()
    {
        return "this is the login page";
    }

    public function register()
    {
        return response()->json([
            "message" => "this is the register page"
        ]);
    }
}

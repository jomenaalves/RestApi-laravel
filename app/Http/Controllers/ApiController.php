<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    public function __construct(){}

    public function autentication(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json(['error' => 'Wrong credentials'], 422);
        }

        $credentials = $request->only('email', 'password');
        if(!Auth::guard('admin')->attempt($credentials)){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json([]);
    }
}

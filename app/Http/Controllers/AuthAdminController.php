<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
        use ApiResponse;
    public function register(Request $request){
        $validated=$request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:users,id',
            'password'=>'required',
        ]);
        $user=Admin::create($validated);
        $token=$user->createToken('Register')->plainTextToken;
        return $this->success('Registered Successfuylly',201,$token);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $admin=Admin::where('email',$request->email)->first();
        if(!$admin || !password_verify($request->password,$admin->password)){
            return $this->error('credintials is false',401);
        }
       $token= $admin->createToken('login_token')->plainTextToken;

        return $this->success('Login Successfully',200,$token);

    }

    public function logout(){
        auth('admin')->user()->currentAccessToken()->delete();
        return $this->success('Logout Successfully',200);
    }
}

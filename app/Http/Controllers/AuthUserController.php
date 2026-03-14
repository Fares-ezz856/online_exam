<?php

namespace App\Http\Controllers;

use App\ApiResponse;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthUserController extends Controller
{
    use ApiResponse;
    public function register(Request $request){
        $validated=$request->validate([
            'name'=>'required|string',
            'email'=>'required|unique:users,id',
            'password'=>'required',
        ]);
        $user=User::create($validated);
        $token=$user->createToken('Register')->plainTextToken;
        return $this->success('Registered Successfuylly',201,$token);
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $user=User::where('email',$request->email)->first();
        if(!$user || !password_verify($request->password,$user->password)){
            return $this->error('credintials is false',401);
        }
       $token= $user->createToken('login_token')->plainTextToken;

        return $this->success('Login Successfully',200,$token);

    }

    public function logout(){
        auth('user')->user()->currentAccessToken()->delete();
        return $this->success('Logout Successfully',200);
    }
}

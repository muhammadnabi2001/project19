<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:3,max:30'
        ]);
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        $token=$user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success'=>true,
            'data'=>$user,
            'token'=>$token
        ],200);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:3|max:30'
        ]);
        Auth::attempt($request->only('email','password'));
        if(Auth::check()){
            $token=Auth::user()->createToken('Token')->plainTextToken;
            $responce=[
                'success'=>true,
                'data'=>Auth::user(),
                'token'=>$token
            ];
            return response()->json($responce,200);
        }
        return response()->json(['error'=>'Unautherized'],401);
    }
    public function edituser(Request $request)
    {
       // return response()->json(['success'=>'sdfasdf']);
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
        $user = $request->user(); 
        if ($user) {
            $user->name = $request->name;
            $user->password = bcrypt($request->password); 
            $user->save();
    
            return response()->json([
                'message' => 'success',
                'user' => $user,
            ]);
        } else {
            return response()->json(['error' => 'User not found'], 404);
        }
    }
    
}

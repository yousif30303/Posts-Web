<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware(['guest'])->except(['Logout']);
    }


    public function ShowReg()
    {
        return view('user.register');
    }

    public function ShowLog()
    {
        return view('user.login');
    }

    public function register(Request $req)
    {
        $req->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required|unique:users',
            'password'=>'required|confirmed',
        ]);

        $user = User::create([
            'name'=>$req['name'],
            'username'=>$req['username'],
            'email'=>$req['email'],
            'password'=>Hash::make($req['password']),
        ]);

        auth()->attempt($req->only('email','password'));

        return redirect()->route('dashboard');

    }

    public function Login(Request $req)
    {
        $req->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(!auth()->attempt($req->only('email','password'),$req->remember)){
            return redirect('/Login')->with('status', 'Invalid User Details!');
        }


        return redirect()->route('dashboard');
    }

    public function Logout(){
        auth()->logout();

        return redirect()->route('dashboard');
    }
}

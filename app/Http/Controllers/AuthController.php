<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function showLoginForm(){
        return view('sessions.login');
    }

    public function login(Request $request){

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();

            if (Auth::user()->type == 3) {
                $request->session()->put('admin', true);
                return redirect()->route('properties.index');
            }else{
                $request->session()->put('admin', false);
                $request->session()->put('user', $request->email);
            }
            // dd($request->session()->get('admin', false));
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Usuario o contraseña incorrectos',
        ]);
    }

    public function registerView(){
        return (view('sessions.register'));
    }

    public function registerUser(Request $request){
        
        $request->validate([
            'email'=>'required|unique:users,email|max:100|email:rfc,dns',
            'name'=>'required|string',
            'password'=>'required|min:4'
        ]);
        

        $user=new User;

        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=Hash::make($request->password);
        $user->type=0;
        $user->phone='000000000';
        if(!empty($request->image)){
            $user->image=$request->image;
        }else{
            $user->image='Images/assets/noimage.png';
        }

        $user->save();

        return redirect()->route('login')->with('success','Registrado correctamente. Inicie Sesión.');
    }


    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

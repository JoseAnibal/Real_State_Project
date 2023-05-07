<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    //Request para saber que tipo de dato es
    public function store(Request $request){
        $request->validate([
            'email'=>'required|unique:users,email|email:rfc,dns',
            'name'=>'required',
            'password'=>'required',
            'phone'=>'required',
            'type'=>'required'
        ]);

        $user=new User;
        $user->email=$request->email;
        $user->name=$request->name;
        $user->password=Hash::make($request->password);
        $user->phone=$request->phone;
        $user->image=$request->image;
        $user->type=$request->type;

        $user->save();

        return redirect()->route('user_added')->with('Exito','Usuario insertado correctamente!😀');
    }
}

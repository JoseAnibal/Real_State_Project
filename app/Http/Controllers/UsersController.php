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

    public function index(){
        $users= User::all();

        return view('users.index',['users'=>$users]);
    }

    public function show($user){
        //
        
    }

    
    public function edit($user){
        $user_o=User::find($user);

        if(empty($user_o)){
            return redirect(route("properties.index"));
        }

        //PASAR EL JAVASCRIPT PARA EL USUARIO
        return view('users.edit',['user'=>$user_o, 'js'=>asset("js/Properties/update_property.js")]);

    }

    public function update(Request $request, $user)
    {
        

    }

    public function destroy($user)
    {
        $user_o=User::find($user);
        $user_o->delete();

        return redirect()->route('users.index')->with('success','Usuario eliminado!🤯');

    }
}

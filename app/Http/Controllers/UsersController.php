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
        //GET ALL USERS EXCEPT ADMINS
        $users= User::where('type','!=',3)->get();

        return view('users.index',['users'=>$users]);
    }

    public function show($user){
        //
        
    }

    
    public function edit($user){
        $user_o=User::find($user);

        if(empty($user_o)){
            return redirect(route("users.index"));
        }

        //PASAR EL JAVASCRIPT PARA EL USUARIO
        return view('users.edit',['user'=>$user_o, 'js'=>asset("js/Users/create_user.js")]);

    }

    public function update(Request $request, $user){
        $user_o=User::find($user);
        $request->validate([
            'email'=>'unique:users,email,'.$user.'| max:100 | email:rfc,dns',
            'name'=>'string',
            'password'=>'min:3',
            'phone'=>'numeric | unique:users,phone,'.$user,
            'type'=>'required | numeric'
        ]);

        $user_o->email=$request->email;
        $user_o->name=$request->name;

        if(!empty($request->password)){
            $user_o->password=Hash::make($request->password);
        }
        
        $user_o->phone=$request->phone;
        $user_o->type=$request->type;

        // MULTIPLE IMAGES PICKER AND VALIDATION
        $allowed=['png','jpg','jpeg','webp'];
        $message='Imágen actualizada! 🌄';

        if($request->file('image')){

            //DELETE IMAGE FROM LOCAL
            if(!empty($user_o->image)){
                unlink(public_path($user_o->image));
            }

            $image_name=$user_o->id.'_'.md5(rand(1000,2000));
            $extension=strtolower($request->file('image')[0]->getClientOriginalExtension());

            if(in_array($extension,$allowed)){
                $image_full_name = $image_name.'.'.$extension;
                $path='Images/Users/';
                $image_url=$path.$image_full_name;

                $user_o->image=$image_url;
                $request->file('image')[0]->move($path,$image_full_name);
            }
        }
        $user_o->save();
        // dd($user_o);

        return redirect()->route('users.index')->with('success','Usuario editado correctamente!👌');

    }

    public function destroy($user){
        $user_o=User::find($user);
        $user_o->delete();

        return redirect()->route('users.index')->with('success','Usuario eliminado!🤯');

    }
}

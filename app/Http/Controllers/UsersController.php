<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{

    public function index(){
        // $users= User::where('type','!=',3)->take(5)->get();

        return view('users.index',['js'=>asset("js/Users/index_user.js")]);
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
        if(!empty($request->image)){
            $user->image=$request->image;
        }else{
            $user->image='Images/assets/noimage.png';
        }
        $user->phone=$request->phone;
        $user->type=$request->type;

        $user->save();

        return redirect()->route('user_added')->with('success','Usuario insertado correctamente!😀');
    }

    public function update(Request $request, $user){
        $user_o=User::find($user);

        $request->validate([
            'email'=>'unique:users,email,'.$user.'| max:100 | email:rfc,dns',
            'name'=>'string',
            'phone'=>'nullable| numeric ',
            'type'=>'required | numeric',
            'password'=>'nullable | min:4'
        ]);

        $user_o->email=$request->email;
        $user_o->name=$request->name;

        if(!empty($request->password)){
            $user_o->password=Hash::make($request->password);
        }
        
        $user_o->phone=$request->phone;
        $user_o->type=$request->type;

        //VALIDATION
        $allowed=['png','jpg','jpeg','webp'];

        if($request->file('image')){

            //DELETE IMAGE FROM LOCAL
            if(!empty($user_o->image)){

                if(file_exists(public_path($user_o->image))){
                    if(implode('/',array_slice(explode('/',asset($user_o->image)), -3))!='Images/assets/noimage.png'){
                        unlink(public_path($user_o->image));
                    }
                }
                
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

        return redirect()->route('users.index')->with('success','Usuario editado correctamente!👌');

    }

    public function destroy($user){
        $user_o=User::find($user);
        $user_o->delete();

        return redirect()->route('users.index')->with('success','Usuario eliminado!🤯');

    }

    public function getUsers(Request $request){
        $query='';
        $data=[];
        $limit=6;

        if(!empty($request->all())){
            $query="SELECT * FROM users WHERE email LIKE ? AND phone LIKE ?";
            
            $data[]="$request->email%";
            $data[]="$request->phone%";
    
            if($request->type!='all'){
                $query.=" AND type LIKE ?";
                $data[]=$request->type;
            }
            
            $data[]=intval($request->offset)*$limit;

            $query.=" AND type != 3 LIMIT $limit OFFSET ?";
        }else{
            $query="SELECT * FROM users WHERE type != 3 LIMIT $limit";
        }

        $users=DB::select($query, [...$data]);

        return response()->json(['users' => $users]);
    }

    public function deleteAPI(Request $request, $user){
        
        $user_o=User::find($user);

        if(file_exists(public_path($user_o->image))){
            if(implode('/',array_slice(explode('/',asset($user_o->image)), -3))!='Images/assets/noimage.png'){
                unlink(public_path($user_o->image));
            }
        }
        
        $user_o->delete();

        return response()->json(['message' => 'Usuario eliminado correctamente!']);
    }
}

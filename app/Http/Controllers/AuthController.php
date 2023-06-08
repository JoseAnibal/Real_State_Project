<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            if(isset($request->keepsession)){
                setcookie('user',Auth::user()->email."-".Auth::user()->id,time()+20*24*60*60);
            }
            $request->session()->regenerate();

            if (Auth::user()->type == 3) {

                $request->session()->put('admin', true);
                return redirect()->route('properties.index');

            }else if(Auth::user()->type == 1){

                $user_o=Auth::user();

                $request->session()->put('admin', false);
                $request->session()->put('email', $request->email);
                $request->session()->put('user', $user_o->id);
                $request->session()->put('name', $user_o->name);
                $request->session()->put('type', $user_o->type);
                $request->session()->put('image', $user_o->image);

                $property=DB::select("SELECT
                                    r.property_id 
                                FROM
                                    users AS u
                                    INNER JOIN rentals AS r ON r.user_id = u.id 
                                WHERE
                                    u.id = ? 
                                    AND r.active = 1;", [$user_o->id]);

                if(empty($property)){
                    if (isset($_COOKIE['user'])) {
                        setcookie('user', '', time()-100);
                    }
                    $sessionManager = app(Session::class);
                    $sessionManager->flush();
                    $sessionManager->regenerate();

                    Auth::logout();

                    return back()->withErrors([
                        'error' => 'Tu alquiler ya ha terminado.',
                    ]);

                }else{
                    $request->session()->put('property',reset($property)->property_id);
                }
                
                return redirect()->route('registered.index',['property'=>reset($property)->property_id]);

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
        if (isset($_COOKIE['user'])) {
            setcookie('user', '', time()-100);
        }

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}

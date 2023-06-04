<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

use function PHPSTORM_META\type;

class RegisteredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($property)
    {
        $idusersin=DB::select("SELECT
                                u.id
                            FROM
                                users AS u
                                INNER JOIN rentals AS r ON r.user_id = u.id
                                INNER JOIN properties AS p ON r.property_id = p.id 
                                AND r.active = 1
                            WHERE
                                p.id = ?;",[$property]);

        $ids=[];
        foreach($idusersin as $obj){
            $ids[]=$obj->id;
        }

        if(!in_array(session()->get('user'),$ids)){
            return back()->withErrors([
                'prohibido' => 'Acceso denegado',
            ]);
        }

        $property_o= Property::find($property);
        $users=DB::select("SELECT
                    u.name,
                    u.image
                FROM
                    users AS u
                    INNER JOIN rentals AS r ON r.user_id = u.id
                    INNER JOIN properties AS p ON r.property_id = p.id 
                WHERE
                    p.id = ? 
                    AND r.active = 1 
                    AND u.id != ?;",[$property,session()->get('user')]);
        
        return view('registered.index',['property'=>$property_o,'users'=>$users,'js'=>asset('js/Registered/index.js')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showincidences($property)
    {
        $idusersin=DB::select("SELECT
                                u.id
                            FROM
                                users AS u
                                INNER JOIN rentals AS r ON r.user_id = u.id
                                INNER JOIN properties AS p ON r.property_id = p.id 
                                AND r.active = 1
                            WHERE
                                p.id = ?;",[$property]);

        $ids=[];
        foreach($idusersin as $obj){
            $ids[]=$obj->id;
        }

        if(!in_array(session()->get('user'),$ids)){
            return back()->withErrors([
                'prohibido' => 'Acceso denegado',
            ]);
        }

        $property_o= Property::find($property);
        $status=[
            0=>"<i class='fa-regular fa-circle fa-lg' style='color: #7ceef8;'></i> Creada",
            1=>"<i class='fa-solid fa-spinner fa-lg' style='color: #fbcf7d;'></i> En curso",
            2=>"<i class='fa-solid fa-xmark fa-xl' style='color: #fe8386;'></i> Rechazada",
            3=>"<i class='fa-solid fa-check fa-xl' style='color: #80ff86;'></i> Finalizada"
        ];
        
        return view('incidences.index',['incidences'=>$property_o->incidences,'status'=>$status]);
    }

    public function createincidence($property){

        $idusersin=DB::select("SELECT
                                u.id
                            FROM
                                users AS u
                                INNER JOIN rentals AS r ON r.user_id = u.id
                                INNER JOIN properties AS p ON r.property_id = p.id 
                                AND r.active = 1
                            WHERE
                                p.id = ?;",[$property]);

        $ids=[];
        foreach($idusersin as $obj){
            $ids[]=$obj->id;
        }

        if(!in_array(session()->get('user'),$ids)){
            return back()->withErrors([
                'prohibido' => 'Acceso denegado',
            ]);
        }


        return view('incidences.create',['js'=>asset('js/Users/create_user.js')]);

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeincidence(Request $request)
    {

        $incidence= new Incidence;

        $incidence->property_id=session()->get('property',false);
        $incidence->date=date('Y-m-d');
        $incidence->status=0;
        $incidence->title=$request->title;
        $incidence->description=$request->description;

        if($request->file('image')){
            $allowed=['png','jpg','jpeg','webp'];

            $image_name=session()->get('property',false).'_'.md5(rand(1000,2000));
            $extension=strtolower($request->file('image')->getClientOriginalExtension());

            if(in_array($extension,$allowed)){
                $image_full_name = $image_name.'.'.$extension;
                $path='Images/Incidences/';
                $image_url=$path.$image_full_name;
                $request->file('image')->move($path,$image_full_name);
            }

            $incidence->image_url=$image_url;

        }else{
            $incidence->image_url="Images/assets/noimage.png";
        }

        $incidence->save();
        
        return redirect()->route('registered.index',['property'=>session()->get('property',false)])->with('success','Incidencia creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

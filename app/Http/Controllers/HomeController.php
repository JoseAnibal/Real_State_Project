<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use stdClass;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        if(isset($_COOKIE['user'])){
            $user_o=User::find(explode('-',$_COOKIE['user'])[1]);

            if($user_o->isAdmin()){

                Auth::login($user_o);
                
                session()->put('admin', true);
                // return redirect()->route('properties.index');

            }else{
                Auth::login($user_o);

                session()->regenerate();
                session()->put('admin', false);
                session()->put('email', $user_o->email);
                session()->put('user', $user_o->id);
                session()->put('name', $user_o->name);
                session()->put('type', $user_o->type);
                session()->put('image', $user_o->image);

                $property=DB::select("SELECT
                                            r.property_id 
                                        FROM
                                            users AS u
                                            INNER JOIN rentals AS r ON r.user_id = u.id 
                                        WHERE
                                            u.id = ? 
                                            AND r.active = 1;", [$user_o->id]);

                if(empty($property)){

                    return back()->withErrors([
                        'error' => 'Tu alquiler ya ha terminado.',
                    ]);

                }
                session()->put('property',reset($property)->property_id);

                // return redirect()->route('registered.index',['property'=>reset($property)->property_id]);
            }

        }

        $propertymain=Property::whereExists(function ($query) {
            $query->select('id')
                ->from('images')
                ->whereColumn('images.property_id', 'properties.id');
                })->where('status', 0)->inRandomOrder()->first();

        $imagemain=$propertymain->images;
        $imagebanner=$imagemain[0]->toArray()['image_url'];

        return view('index',['propertymain'=>$propertymain,'imagebanner'=>$imagebanner,0,'js'=>asset('js/Home/index_home.js')]);
    }

    public function showproperty($property){
        $property_o=Property::find($property);

        if(empty($property_o)){
            return redirect()->route('home');
        }

        return view('users.property_show',['property'=>$property_o,'js'=>asset("js/Properties/show_property.js")]);
    }

    public function rentalproperties(){
        return view('home.propertiesrental',['js'=>asset('js/Home/propertiesrental.js')]);
    }

    public function getPropertiesRental(Request $request){
        $query='';
        $data=[];
        $limit=4;

        if(!empty($request->all())){
            $query="SELECT * FROM properties WHERE title LIKE ? AND adress LIKE ? AND status = 0";
            
            $data[]="$request->title%";
            $data[]="$request->adress%";
    
            if($request->type!='all'){
                $query.=" AND type LIKE ?";
                $data[]=$request->type;
            }

            $order= $request->order == "DESC" ? "DESC" : "ASC";
            $data[]=intval($request->offset)*$limit;
            $query.=" ORDER BY price $order LIMIT $limit OFFSET ?";
        }else{
            $query="SELECT * FROM properties AND status = 0 LIMIT $limit";
        }

        $properties=DB::select($query, [...$data]);

        foreach($properties as $property){
            $image=DB::select("SELECT image_url FROM images  WHERE property_id = $property->id");

            $property_new=new stdClass();
            $property_new=$property;
            $property_new->image=$image[0]->image_url;
        }

        return response()->json(['properties' => $properties]);
    }

    public function landing(){
        $properties_1 = Property::where('type', 0)->where('status', 0)
        ->inRandomOrder()
        ->take(3)
        ->get();

        foreach($properties_1 as $property){
            $image=DB::select("SELECT image_url FROM images  WHERE property_id = $property->id");

            $property_new=new stdClass();
            $property_new=$property;
            $property_new->image=$image[0]->image_url;
        }

        $properties_2 = Property::where('type', 1)->where('status', 0)
        ->inRandomOrder()
        ->take(3)
        ->get();

        foreach($properties_2 as $property){
            $image=DB::select("SELECT image_url FROM images  WHERE property_id = $property->id");

            $property_new=new stdClass();
            $property_new=$property;
            $property_new->image=$image[0]->image_url;
        }

        $properties_3 = Property::where('type', 2)->where('status', 0)
        ->inRandomOrder()
        ->take(3)
        ->get();

        foreach($properties_3 as $property){
            $image=DB::select("SELECT image_url FROM images  WHERE property_id = $property->id");

            $property_new=new stdClass();
            $property_new=$property;
            $property_new->image=$image[0]->image_url;
        }

        return view('landing',['properties_1'=>$properties_1,'properties_2'=>$properties_2,'properties_3'=>$properties_3]);
    }

    public function whoarewe(){
        
        return view('ourinfo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

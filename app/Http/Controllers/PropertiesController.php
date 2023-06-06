<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Property;
use App\Models\Image;
use App\Models\GeneralFunction;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use stdClass;

use function PHPSTORM_META\map;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        // $properties= Property::all();

        return view('properties.index',['js'=>asset("js/Properties/index_property.js")]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $formu=GeneralFunction::dropdownTypes();
        return view('properties.create',['formu'=>$formu,'js'=>asset("js/Properties/create_property.js")]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $rules = [
            'title'=>'required|unique:properties,title|max:150',
            'description'=>'required|max:500',
            'adress'=>'required|max:300',
            'm2'=>'required|numeric|min:1',
            'type'=>'required',
            'price'=>'required|numeric|min:1',
            'coordinates'=>'required',
            'status'=>'required'
        ];

        try {

            $validatedData = $request->validate($rules);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 400);

        }

        $property=new Property;

        $property->title=$request->title;
        $property->description=$request->description;
        $property->adress=$request->adress;
        $property->m2=$request->m2;
        $property->type=$request->type;
        $property->rooms=$request->rooms;
        $property->baths=$request->baths;
        $property->price=$request->price;
        $property->coordinates=$request->coordinates;
        $property->status=$request->status;

        $property->save();

        // MULTIPLE IMAGES PICKER AND VALIDATION
        $allowed=['png','jpg','jpeg','webp'];
        $message='Propiedad creada! 😀';

        if($request->file('image')){

            foreach($request->file('image') as $file){

                $image_name=$property->id.'_'.md5(rand(1000,2000));
                $extension=strtolower($file->getClientOriginalExtension());

                if(in_array($extension,$allowed)){
                    $image_full_name = $image_name.'.'.$extension;
                    $path='Images/Properties/';
                    $image_url=$path.$image_full_name;
                    $file->move($path,$image_full_name);
                    $image[]=$image_url;
                }

            }

            if(count($request->file('image'))>count($image)){
                $message.=' (Se ha descartado los archivos que no eran imágenes)';
            }

            foreach($image as $key=>$value){
                Image::create([
                    'property_id'=>$property->id,
                    'image_url'=>$value
                ]);
            }

            return response()->json([

                'message'=>$message

            ]);
            // return redirect()->route('properties.index')->with('success',$message);
        }else{
            $message.=' (Sin imágenes)';
            Image::create([
                'property_id'=>$property->id,
                'image_url'=>'Images/assets/noimage.png'
            ]);
            return response()->json([

                'message'=>$message

            ]);
            // return redirect()->route('properties.index')->with('warning',$message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($property)
    {
        //
        $property_o=Property::find($property);

        if(empty($property_o)){
            return redirect()->route('properties.index');
        }

        return view('properties.show',['property'=>$property_o,'js'=>asset("js/Properties/show_property.js")]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($property)
    {
        //
        $property_o=Property::find($property);

        if(empty($property_o)){
            return redirect(route("properties.index"));
        }

        return view('properties.edit',['property'=>$property_o, 'js'=>asset("js/Properties/update_property.js")]);
    }

    public function showincidencesadmin($property){

        $property_o= Property::find($property);
        $status=[
            0=>"<i class='fa-regular fa-circle fa-lg' style='color: #7ceef8;'></i> Creada",
            1=>"<i class='fa-solid fa-spinner fa-lg' style='color: #fbcf7d;'></i> En curso",
            2=>"<i class='fa-solid fa-xmark fa-xl' style='color: #fe8386;'></i> Rechazada",
            3=>"<i class='fa-solid fa-check fa-xl' style='color: #80ff86;'></i> Finalizada"
        ];

        return view('incidences.showincidencesadmin',['incidences'=>$property_o->incidences,'status'=>$status]);

    }

    public function showbillsadmin($property){
        $bills=DB::select("SELECT
                                b.id,
                                b.total,
                                b.date,
                                u.email
                            FROM
                                bills AS b
                                INNER JOIN rentals AS r ON r.id = b.rental_id
                                INNER JOIN properties AS p ON p.id = r.property_id
                                INNER JOIN users AS u ON r.user_id = u.id 
                                AND r.active = 1 
                                AND p.id = ?
                                ORDER BY b.date DESC;",[$property]);

        return view('bills.index',['bills'=>$bills,'property'=>$property]);
    }

    public function createbillform($property){

        $property_o=Property::find($property);

        $idusersin=DB::select("SELECT
                                u.email,
                                r.id
                            FROM
                                users AS u
                                INNER JOIN rentals AS r ON r.user_id = u.id
                                INNER JOIN properties AS p ON r.property_id = p.id 
                                AND r.active = 1
                            WHERE
                                p.id = ?;",[$property]);

        $rentals=[];
        foreach($idusersin as $obj){
            $rentals[$obj->id]=$obj->email;
        }
        
        return view('bills.create',['rentals'=>$rentals,'property'=>$property,'js'=>asset('js/Bills/createbill.js')]);
    }

    public function createbill(Request $request, $property){

        $request->validate([
            'water'=>'required| numeric | min:0',
            'gas'=>'required| numeric | min:0',
            'light'=>'required| numeric | min:0',
            'internet'=>'required| numeric | min:0',
            'extra'=>'required| numeric | min:0'
        ]);

        $bill=new Bill;
        $bill->rental_id=$request->rental;
        $bill->date=$request->date;
        $bill->extra=$request->extra;
        $bill->water=$request->water;
        $bill->gas=$request->gas;
        $bill->light=$request->light;
        $bill->internet=$request->internet;
        $bill->total=intval($request->extra)+intval($request->water)+intval($request->gas)+intval($request->light)+intval($request->internet);

        $bill->save();

        return redirect()->route('properties.bills',['property'=>$property])->with('success','Factura creada correctamente');

    }

    public function showbilladmin($bill){
        $bill_o=Bill::find($bill);
        return view('properties.showbill',['bill'=>$bill_o]);
    }

    public function propertyImages($property){
        $property_o=Property::find($property);

        if(empty($property_o->images)){
            return response()->json(['errors' => 'Esta propiedad no tiene imagenes'], 400);
        }

        $images=array_map(function($item) {
            return $item['image_url'];
        }, ($property_o->images)->toArray());

        return response()->json(['data' => $images]);
    }

    public function uploadImages(Request $request,$property){
        $property_o=Property::find($property);

        // MULTIPLE IMAGES PICKER AND VALIDATION
        $allowed=['png','jpg','jpeg','webp'];
        $message='Imágenes actualizadas! 🌄';

        if($request->file('image')){

            //DELETE IMAGES FROM DATABASE AND LOCAL
            foreach(($property_o->images)->toArray() as $image){
                unlink(public_path($image['image_url']));
            }
            $property_o->images()->delete();

            $image=[];
            //PROCESS TO UPLOAD NEW IMAGES
            foreach($request->file('image') as $file){

                $image_name=$property_o->id.'_'.md5(rand(1000,2000));
                $extension=strtolower($file->getClientOriginalExtension());

                if(in_array($extension,$allowed)){
                    $image_full_name = $image_name.'.'.$extension;
                    $path='Images/Properties/';
                    $image_url=$path.$image_full_name;
                    $file->move($path,$image_full_name);
                    $image[]=$image_url;
                }

            }

            foreach($image as $key=>$value){
                Image::create([
                    'property_id'=>$property_o->id,
                    'image_url'=>$value
                ]);
            }

            return response()->json([

                'message'=>$request->file('image')

            ]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateApi(Request $request, $property)
    {
        //
        // $request->validate([
        //     'title'=>'required|unique:properties,title,'.$property,
        //     'description'=>'required',
        //     'adress'=>'required',
        //     'm2'=>'required|numeric|min:1',
        //     'price'=>'required|numeric|min:1',
        //     'coordinates'=>'required',
        //     'status'=>'required|numeric'
        // ]);

        $property_o=Property::find($property);

        $rules = [
            'title'=>'required|unique:properties,title,'.$property.'| max:100',
            'description'=>'required|max:500',
            'adress'=>'required|max:255',
            'm2'=>'required|numeric|min:1',
            'price'=>'required|numeric|min:1',
            'coordinates'=>'required',
            'status'=>'required|numeric'
        ];

        try {

            $validatedData = $request->validate($rules);

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json(['errors' => $e->errors()], 400);

        }

        $property_o->title=$request->title;
        $property_o->description=$request->description;
        $property_o->adress=$request->adress;
        $property_o->m2=$request->m2;
        $property_o->rooms=$request->rooms;
        $property_o->baths=$request->baths;
        $property_o->price=$request->price;
        $property_o->coordinates=$request->coordinates;
        $property_o->status=$request->status;

        $property_o->save();

        return response()->json(['message' => 'Propiedad editada!']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($property)
    {
        //
        $property_o=Property::find($property);

        foreach(($property_o->images)->toArray() as $image){
            unlink(public_path($image['image_url']));
        }

        $property_o->images()->delete();
        $property_o->delete();

        return redirect()->route('properties.index')->with('success','Propiedad eliminada!🤯');

    }

    public function userList($property){

        $property_o=Property::find($property);
        $users=[];

        $rentals=$property_o->rentals;
        foreach($rentals as $rental){

            if($rental->active){
                $rental->user->rental=$rental->id;
                $users[]=$rental->user;
            }
           
        }

        // dd($users);

        return view('properties.userlist',['property'=>$property,'users'=>$users]);
    }

    public function userAdd(Request $request, $property){

        return view('properties.useradd',['js'=>asset("js/Properties/user_add.js")]);
    }

    public function userDelete(Request $request, $property){

        // $request->

        $property_o=Property::find($property);
        $users=[];

        $rentals=$property_o->rentals;
        foreach($rentals as $rental){

            if($rental->active)  $users[]=$rental->user;
           
        }

        return view('properties.userlist',['property'=>$property,'users'=>$users]);
    }

    public function coordsProperty($property){
        
        $property_o=Property::find($property);

        if(empty($property_o)){
            return response()->json(['error' => 'Propiedad no encontrada']);
        }

        return response()->json(['coords' => $property_o->coordinates]);
    }

    public function getProperties(Request $request){
        $query='';
        $data=[];
        $limit=4;

        if(!empty($request->all())){
            $query="SELECT * FROM properties WHERE title LIKE ? AND adress LIKE ?";
            
            $data[]="$request->title%";
            $data[]="$request->adress%";
    
            if($request->type!='all'){
                $query.=" AND type LIKE ?";
                $data[]=$request->type;
            }
            
            $data[]=intval($request->offset)*$limit;
            $query.=" LIMIT $limit OFFSET ?";
        }else{
            $query="SELECT * FROM properties LIMIT $limit";
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

    public function indexproperties(Request $request){
        $query='';
        $data=[];
        $limit=4;

        $data[]=intval($request->offset)*$limit;
        $query="SELECT * FROM properties LIMIT $limit OFFSET ?";


        $properties=DB::select($query, [...$data]);

        foreach($properties as $property){
            $image=DB::select("SELECT image_url FROM images  WHERE property_id = $property->id");

            $property_new=new stdClass();
            $property_new=$property;
            $property_new->image=$image[0]->image_url;
        }

        return response()->json(['properties' => $properties]);
    }

    public function deletePAPI($property){

        $property_o=Property::find($property);

        foreach(($property_o->images)->toArray() as $image){
            unlink(public_path($image['image_url']));
        }

        $property_o->images()->delete();
        $property_o->delete();

        return response()->json(['message' => 'Propiedad eliminada correctamente!']);
    }

    public function norentalUsers(Request $request){
        $query='';
        $data=[];
        $limit=2;

        $query="SELECT
                    * 
                FROM
                    users u 
                WHERE
                    (u.id NOT IN ( SELECT DISTINCT user_id FROM rentals ) 
                    OR u.id IN ( SELECT DISTINCT user_id FROM rentals WHERE active = 0 ) )
                    AND u.type = 1
                    AND u.email LIKE ? 
                    AND u.phone LIKE ?";
        
        $data[]="$request->email%";
        $data[]="$request->phone%";
        $data[]=intval($request->offset)*$limit;

        $query.=" LIMIT $limit OFFSET ?";

        $users=DB::select($query, [...$data]);

        return response()->json(['users' => $users]);
    }

    public function processRental(Request $request, $property){
        
        $usersform = explode(',',$request->idusers);

        foreach($usersform as $user){
            $rental= new Rental();
            $rental->user_id=$user;
            $rental->property_id=$property;
            $rental->date_start=$request->datestart;
            $rental->date_end=$request->dateend;
            $rental->active=1;

            $rental->save();
        }

        return response()->json(['success'=>'Alquileres creados correctamente!']);
    }
}

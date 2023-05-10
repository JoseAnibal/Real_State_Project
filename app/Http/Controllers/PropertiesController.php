<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Image;
use App\Models\GeneralFunction;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Storage;

use function PHPSTORM_META\map;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $properties= Property::all();

        return view('properties.index',['properties'=>$properties]);
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
        // $request->validate([
        //     'title'=>'required|unique:properties,title',
        //     'description'=>'required',
        //     'adress'=>'required',
        //     'm2'=>'required|numeric|min:1',
        //     'type'=>'required',
        //     'price'=>'required|numeric|min:1',
        //     'coordinates'=>'required',
        //     'status'=>'required'
        // ]);
        $rules = [
            'title'=>'required|unique:properties,title|max:100',
            'description'=>'required|max:255',
            'adress'=>'required|max:255',
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
            return redirect('properties.index');
        }

        return view('properties.show',['property'=>$property_o]);
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
            'description'=>'required|max:255',
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
}

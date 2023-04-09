<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\Image;
use Illuminate\Http\Request;

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
        return view('properties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $request->validate([
            'title'=>'required|unique:properties,title',
            'description'=>'required',
            'adress'=>'required',
            'm2'=>'required|numeric|min:1',
            'type'=>'required',
            'price'=>'required|numeric|min:1',
            'coordinates'=>'required',
            'status'=>'required'
        ]);

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

        //MULTIPLE IMAGES PICKER AND VALIDATION
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
            return redirect()->route('properties.index')->with('success',$message);
        }else{
            $message.=' (Sin imágenes)';
            return redirect()->route('properties.index')->with('warning',$message);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $property)
    {
        //
        $property_o=Property::find($property);

        $property_o->title=$request->title;
        $property_o->description=$request->description;
        $property_o->adress=$request->adress;
        $property_o->m2=$request->m2;
        $property_o->type=$request->type;
        $property_o->rooms=$request->rooms;
        $property_o->baths=$request->baths;
        $property_o->price=$request->price;
        $property_o->coordinates=$request->coordinates;
        $property_o->status=$request->status;

        $property_o->save();

        return redirect()->route('properties.index')->with('success','Propiedad actualizada!😀');
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
        $property_o->delete();

        return redirect()->route('properties.index')->with('success','Propiedad eliminada!🤯');

    }
}

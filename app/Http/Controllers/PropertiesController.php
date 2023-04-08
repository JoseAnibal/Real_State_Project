<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties= Property::all();

        // return view('',['properties'=>$properties]);
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
    public function store(Request $request){
        $request->validate([
            'title'=>'required',
            'description'=>'required',
            'adress'=>'required',
            'm2'=>'required|numeric|min:1',
            'type'=>'required',
            'price'=>'required|numeric|min:1',
            'coordinates'=>'required',
            'status'=>'required'
        ]);

        //All attributes.

        $attr=[null,
                null,
                $request->title,
                $request->description,
                $request->adress,
                $request->m2,
                $request->type,
                $request->rooms,
                $request->baths,
                $request->price,
                $request->coordinates,
                $request->status];

        $property=new Property(...$attr);
        $property->save();

        return redirect()->route('property_added')->with('success','Propiedad creada correctamente!😀');
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

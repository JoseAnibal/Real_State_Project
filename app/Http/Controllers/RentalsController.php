<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;

class RentalsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function edit($rental)
    {
        //
        $rental_o=Rental::find($rental);

        return view('rentals.edit',['rental'=>$rental_o,'username'=>$rental_o->user->email,'js'=>asset("js/Rentals/edit_rental.js")]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rental)
    {
        //
        $rental_o=Rental::find($rental);
        $rental_o->date_start=$request->date_start;
        $rental_o->date_end=$request->date_end;
        $rental_o->active=$request->active;
        
        $rental_o->save();

        return redirect()->route('properties.userlist',['property'=>$rental_o->property_id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rental)
    {
        //
        $rental_o=Rental::find($rental);
        $property=$rental_o->property_id;
        $rental_o->delete();
        //REDRECT WITH MESSAGE AND SEE DELETE ERRROR (SHOW MESSAGE)
        return redirect()->route('properties.userlist',['property'=>$property]);
    }
}

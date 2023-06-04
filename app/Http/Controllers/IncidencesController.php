<?php

namespace App\Http\Controllers;

use App\Models\Incidence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use stdClass;

class IncidencesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $incidences_o=Incidence::orderBy('date', 'desc')->get();

        // dd($incidences_o->toArray());

        return view('properties.incidencesgeneral',['js'=>asset("js/Incidences/incidencesgeneral.js")]);

    }

    public function getIncidences(Request $request){
        $query='';
        $data=[];
        $limit=4;

        if(!empty($request->all())){
            $query="SELECT * FROM incidences WHERE title LIKE ?";
            
            $data[]="$request->title%";
    
            if($request->type!='all'){
                $query.=" AND status = ?";
                $data[]=$request->type;
            }

            $order= $request->date == "DESC" ? "DESC" : "ASC";
            $data[]=intval($request->offset)*$limit;
            $query.=" ORDER BY date $order LIMIT $limit OFFSET ?";
        }else{
            $data[]="$request->date";
            $query="SELECT * FROM incidences ORDER BY date ? LIMIT $limit";
        }

        $incidences=DB::select($query, [...$data]);

        return response()->json(['incidences' => $incidences]);
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
    public function show($incidence)
    {
        //
        $incidence_o=Incidence::find($incidence);
        $property_o=$incidence_o->property;
        $status=[
            0=>"<i class='fa-regular fa-circle fa-lg' style='color: #7ceef8;'></i> Creada",
            1=>"<i class='fa-solid fa-spinner fa-lg' style='color: #fbcf7d;'></i> En curso",
            2=>"<i class='fa-solid fa-xmark fa-xl' style='color: #fe8386;'></i> Rechazada",
            3=>"<i class='fa-solid fa-check fa-xl' style='color: #80ff86;'></i> Finalizada"
        ];

        return view('incidences.show',['incidence'=>$incidence_o,'property'=>$property_o,'status'=>$status]);
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
    public function update(Request $request, $incidence)
    {

        $incidence_o=Incidence::find($incidence);
        $incidence_o->status=$request->status;
        $incidence_o->save();
        
        return redirect(route('incidences.index'))->with('success','Incidencia actualizada');
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

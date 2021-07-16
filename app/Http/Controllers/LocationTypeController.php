<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\LocationType;
use Illuminate\Http\Request;

class LocationTypeController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('locations.location-type');
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
        if($request->ajax()){
            $data = $request->validate([
                'location_type_description' => 'required'
            ]);

            if($data){
                LocationType::create([
                    'location_type_description' => $data['location_type_description']
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data has been stored'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $locationType = LocationType::all();

        return json_encode([
            'data' => $locationType
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $locationType = LocationType::findOrFail($id);

        return response()->json($locationType);
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
        if($request->ajax()){
            $data = $request->validate([
                'location_type_description' => 'required'
            ]);

            if($data){
                $locationType = LocationType::findOrFail($id);
                $locationType->update($data);
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Data has been updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::where('location_type_code', '=' , $id)->first();
        if($location == null){
            $locationType = LocationType::findOrFail($id);
            $locationType->delete();
            return response()->json([
                'status' => true,
                'message' => 'Data delete successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your data cant be deleted'
            ]);    
        }

    }
}

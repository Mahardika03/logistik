<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\LocationType;
use App\Models\Location;
use Illuminate\Http\Request;
use App\Models\Shipment;

class LocationController extends Controller
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
        $addresses = Address::all();
        $locationTypes = LocationType::all();
        return view('locations.location', [
            'addresses' => $addresses,
            'locationTypes' => $locationTypes
        ]);
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
                'address_id' => 'required',
                'location_type_code' => 'required',
                'location_detail' => 'required'
            ]);

            if($data){
                Location::create([
                    'address_id' => $data['address_id'],
                    'location_type_code' => $data['location_type_code'],
                    'location_detail' => $data['location_detail']
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
        $location = Location::with('address', 'locationType')->get();

        return json_encode([
            'data' => $location
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
        $location = Location::findOrFail($id);
        return response()->json($location);
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
                'address_id' => 'required',
                'location_type_code' => 'required',
                'location_detail' => 'required'
            ]);

            if($data){
                $location = Location::findOrFail($id);
                $location->update($data);
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
        $shipment = Shipment::where('start_location_id', '=', $id)->orWhere('end_location_id', '=', $id)->first();
        if($shipment == null){
            $location = Location::findOrFail($id);
            $location->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data deleted successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your data cant be deleted'
            ]);
        }
    }
}

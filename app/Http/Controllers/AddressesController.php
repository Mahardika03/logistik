<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Location;
use Illuminate\Http\Request;

class AddressesController extends Controller
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
        return view('addresses.addresses');
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
                'address_detail' => 'required'
            ]);

            if($data){
                Address::create([
                    'address_detail' => $data['address_detail']
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
        $address  = Address::all();

        return json_encode([
            'data' => $address
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
        $address = Address::findOrFail($id);
        return response()->json($address);
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
                'address_detail' => 'required'
            ]);

            if($data){
                $address = Address::findOrFail($id);
                $address->update([
                    'address_detail' => $data['address_detail']
                ]);
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
        $location = Location::where('address_id', '=' , $id)->first();
        if($location == null){
            $address = Address::findOrFail($id);
            $address->delete();
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

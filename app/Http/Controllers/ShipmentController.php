<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Message;
use App\Models\Product;
use App\Models\Shipment;
use App\Models\ShipmentProduct;
use Illuminate\Http\Request;

class ShipmentController extends Controller
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
        $products = Product::all();
        $locations = Location::all();
        return view('shipments.shipment', [
            'products' => $products,
            'locations' => $locations
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
                'start_location_id' => 'required',
                'end_location_id' => 'required',
                'start_date_expected' => 'required',
                'end_date_expected' => 'required',
                'product_id' => 'required',
                'quantity' => 'required',
                'other_details' => 'required'
           ]);

           if($data){
               $shipment = Shipment::create([
                    'start_location_id' => $data['start_location_id'],
                    'end_location_id' => $data['end_location_id'],
                    'start_date_expected' => $data['start_date_expected'],
                    'end_date_expected' => $data['end_date_expected'],
                    'other_details' => $data['other_details']
               ]);
               
               $productIdentity = $request->product_id;
               $quantity = $request->quantity;

               for($count = 0; $count < count($productIdentity); $count++){
                    
                    $shipmentProduct = new ShipmentProduct();
                    $shipmentProduct->shipment_id = $shipment->shipment_id;
                    $shipmentProduct->product_id = $productIdentity[$count];
                    $shipmentProduct->quantity = $quantity[$count];
                    $shipmentProduct->other_details = $request->other_details;
                    $shipmentProduct->save();
               }
           }

           return response()->json([
                'status' => true,
                'message' => 'Data has been stored'
           ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $shipments = Shipment::with('locationOne', 'locationTwo')->get();

        return json_encode([
            'data' => $shipments
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
        $message = Message::where('shipment_id', '=', $id)->first();
        if($message == null){
            $shipmentProduct = ShipmentProduct::where('shipment_id', '=', $id);
            $shipmentProduct->delete();

            $shipment = Shipment::where('shipment_id', '=', $id);
            $shipment->delete();

            return response()->json([
                'status' => true,
                'message' => 'Data has been deleted'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your data cant be deleted'
            ]); 
        }
        
    }
}

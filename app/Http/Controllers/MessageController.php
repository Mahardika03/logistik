<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageType;
use App\Models\Shipment;
use Illuminate\Http\Request;

class MessageController extends Controller
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
        $shipments = Shipment::all();
        $messageTypes = MessageType::all();

        return view('message.message', [
            'shipments' => $shipments,
            'message_types' => $messageTypes
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
                'message_type_code' => 'required',
                'shipment_id' => 'required'
            ]);

            if($data){
                Message::create([
                    'message_type_code' => $data['message_type_code'],
                    'shipment_id' => $data['shipment_id']
                ]);
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
        $messages = Message::with('messageType', 'shipment')->get();

        return json_encode([
            'data' => $messages
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
        $message = Message::where('message_id', '=', $id)->first();

        return response()->json($message);
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
                'message_type_code' => 'required',
                'shipment_id' => 'required'
            ]);

            if($data){

                $message = Message::where('message_id', '=', $id)->first();
                $message->update($data);
            }

            return response()->json([
                'status' => true,
                'message' => 'Data has been updated'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::where('message_id', '=', $id);
        $message->delete();

        return response()->json([
            'status' => true,
            'message' => 'Data has been deleted'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageType;
use Illuminate\Http\Request;

class MessageTypeController extends Controller
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
        return view('message.message-type');
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
        if($request->json()){
            $data = $request->validate([
                'message_type_description' => 'required'
            ]);
            
            if($data){
                MessageType::create([
                    'message_type_description' => $request->message_type_description
                ]);
            }

        }

        return response()->json(['status' => true, 'message' => 'Data has been stored']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $messageTypes = MessageType::all();
        

        return json_encode([
            'data' => $messageTypes
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
        $messageType = MessageType::where('message_type_code', '=', $id)->first();

        return response()->json($messageType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        if($request->json()){
            $data = $request->validate([
                'message_type_description' => 'required'
            ]);
            
            if($data){
                $messageType = MessageType::where('message_type_code', '=', $request->message_type_code);
                $messageType->update($data);
            }
        }

        return response()->json(["status" => true, "message" => "Your data has been successfully updated"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $message = Message::where('message_type_code', '=', $id)->first();
        if($message == null){
            $messageType = MessageType::where('message_type_code', '=', $id);
            $messageType->delete();

            return response()->json(['status' => true,'message' => 'Data deleted successfully']);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your data cant be deleted'
            ]); 
        }
        
    }
}

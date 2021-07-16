<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\File;
use App\Models\ShipmentProduct;
use Illuminate\Http\Request;

class ProductController extends Controller
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
        return view('product.product');
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
                'product_name' => 'required',
                'product_detail' => 'required',
                'product_photo' => 'required'
            ]);

            $product = new Product;

            if($data){
                $data['product_photo'] = $request->file('product_photo')->store('assets/gallery/product', 'public');

                $product->product_name = $data['product_name'];
                $product->product_detail = $data['product_detail'];
                $product->product_photo = $data['product_photo'];
                $product->save();
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product was stored'
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
        $product = Product::all();

        return json_encode([
            'data' => $product
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
        $product = Product::where('product_id', '=', $id)->first();

        return response()->json($product);
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
                'product_name' => 'required',
                'product_detail' => 'required',
                'product_photo' => 'nullable'
            ]);

            if($data){
                $product = Product::findOrFail($id);
                if($request->has('product_photo')){
                    File::delete(public_path('storage/'.$product->product_photo));
                    $data['product_photo'] = $request->file('product_photo')->store('assets/gallery/product', 'public');
                    $product->update([
                        'product_name' => $data['product_name'],
                        'product_detail' => $data['product_detail'],
                        'product_photo' => $data['product_photo']
                    ]);
                } else {
                    $product->update([
                        'product_name' => $data['product_name'],
                        'product_detail' => $data['product_detail'],
                    ]);
                }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'Product was updated'
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
        $shipmentProduct = ShipmentProduct::where('product_id', '=', $id)->first();
        if($shipmentProduct == null){
            $product = Product::findOrFail($id);

            if(File::exists(public_path('storage/'.$product->product_photo))){
                File::delete(public_path('storage/'.$product->product_photo));
                $product->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data successfully deleted'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Your data cant be deleted'
            ]);  
        }
        // Storage::delete(public_path('storage/'.$product->product_photo));
    }
}

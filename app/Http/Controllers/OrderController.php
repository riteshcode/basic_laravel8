<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderFormRequest;

use App\Models\Orders;
use App\Models\OrderProducts;
use App\Models\OrderShippings;
use App\Models\User;

use Illuminate\Support\Str;

use App\Notifications\OrderNotification;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(OrderFormRequest $request)
    {
        $order_id = strtoupper(Str::random(8));
        
        $total_quantity = $total_amount = 0;

        foreach($request->product as $product){
            
            $total_amount +=   (float)$product['selling_price'] * (int)$product['pqty'];          
            $total_quantity += (int)$product['pqty'];            
        }

        // crete order
        $order = Orders::create([
            'order_id'=>$order_id,
            'user_id'=>0,
            'total_amount'=>(float)$total_amount,'total_quantity'=>$total_quantity,
            'transaction_id'=>$order_id,'payment_name'=>$request->payment_method,'payment_type'=>$request->payment_method
        ]);

        foreach($request->product as $product){

            OrderProducts::create([
                'order_id'=>$order->id,

                'product_id'=>$product['id'],
                'price'=>$product['selling_price'],
                'quantity'=>$product['pqty'],
                'is_order'=>'yes',

            ]);
                        
        }

        // billing shipping store
        $shipping = $billing = [];

        $billing['order_id'] =  $order->id;
        $billing['address_type'] =  'billing';
        $billing['full_address'] =  $request->billing_add1;
        $billing['city'] =  $request->billing_city;
        $billing['state'] =  $request->billing_state;
        $billing['country'] =  $request->billing_country;
        $billing['pincode'] =  $request->billing_zipcode;

        $shipping['order_id'] =  $order->id;
        $shipping['address_type'] =  'shipping';
        $shipping['full_address'] =  $request->shipping_add1;
        $shipping['city'] =  $request->shipping_city;
        $shipping['state'] =  $request->shipping_state;
        $shipping['country'] =  $request->shipping_country;
        $shipping['pincode'] =  $request->shipping_zipcode;

        OrderShippings::create($billing);

        if($request->shipping_diff){

            OrderShippings::create($shipping);

        }else{    

            $billing['address_type'] = 'shipping';
            OrderShippings::create($billing);

        }
        
        // generate notification to admin and use and database notification
        $notification = ['data'=> 'Order generated:'.$order_id ];
        $admin_user = User::role('superadmin')->get();
        $admin_user[0]->notify(new OrderNotification($notification));



        return response()->json([
            'status'=>true,
            'order_id'=>$order_id
        ]);
        
        

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

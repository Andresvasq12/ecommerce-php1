<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;

use Illuminate\Support\Facades\Validator ;


class OrderApi2Controllers extends Controller
{   protected function store(Request $request){
    


 
     

    foreach ($request->product as $order){
   
    
    
    
            $validator = Validator:: make($order,
            
    [//'email'=>['required', 'string', 'email', 'max:100'] ,
        'id'=>"required","exists:products,id",
           'quantity' => ['required','gt:0',],
     
     ]);
    
     if($validator->fails()){
         return $validator->errors();
     }   
    
     $stock=Product::find($order["id"]);
     if($stock->inventory<$order["quantity"]){
         
         return response()->json(['message' => 'Out of stock'], 201);} }
    $validator = Validator:: make($request->all(),
            
    ['email'=>['required', 'string', 'email', 'max:100'] ,
     
    ]);
    
     if($validator->fails()){
         return $validator->errors();
     }   



     $userorder= Order::create(
        [
        
            'email' => $request->email ])
        
        ;

  


    foreach ($request->product as $order){
    $poducts=OrderProduct::create(
         ['order_id'=>$userorder->id,
         'product_id'=>$order["id"],
    
          'quantity'=>$order["quantity"],
         ]);
        $stock=Product::find($order["id"]);
    
         $stock->inventory =$stock["inventory"]-$order["quantity"];

         $stock->save();
    
         }
    

     return  response()->json($userorder);
}


    protected function index(Request $request){
        $orders = OrderProduct::with('order')->get();
        return response()->json($orders, 200);
        
        // $list  =OrderProduct::with([  'Order',])
        //                     ->where('email', $request->email)    
        //                     ->first();

        // if (empty($list)) {
        //     return response()->json(['message' => 'Not Found'], 404);
        // }      

        // return response()->json($list, 200);
    }
}
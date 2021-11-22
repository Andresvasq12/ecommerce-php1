<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Orders;
use App\Models\Product;


class OrderApiController extends Controller
{
   

    protected function store(Request $request)
    {
        // $this->validate($request, [
            
    
        //     'email' => ['required', 'string', 'email', 'max:100' ],
           
        //     'quantity' => ['required','gt:0',],
        //     'product_id'=>"exists:products,id"
             

  
        $stoke=Product::find($request->product);
        if(empty($stoke)){
            return response()->json(['message' => 'Incorrect Product ID'], 201);
        }
         if($stoke->inventory<$request->quantity){
         return response()->json(['message' => 'Incorrect Quantity'], 201);}
        
        
        try { $validator = Validator:: make($request->all(),
            
            ['email'=>['required', 'string', 'email', 'max:100' ],

            'quantity' => ['required','gt:0',],
             
             'product_id'=>"exists:products,id",

        ]);

   
             
        
            $order= Orders::create(
                [
                
                    'email' => $request->input('email'),
                    'quantity' => $request->input('quantity'),
                    'product_id' => $request->input('product'),
            ]);
            
    
    
           $stoke=Product::find($order["product_id"]);
           
           $stoke->inventory =$stoke["inventory"]-$order["quantity"];
    
           $stoke->save();
            
            
            
            return response()->json($order, 201);









        }
        catch(\Exception $e){
            return ;
        }
            

            
            

  
        
   

        

        
     
            
       
       // $stoke=Product::find($order["product_id"]);
       
       $stoke->inventory =$stoke["inventory"]-$order["quantity"];

       $stoke->save();
        
    

  
        
        
        return response()->json($order, 201);
      
    

        
    }
}


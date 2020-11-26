<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\History;
use App\Http\Controllers\Controller;
use App\Order;
use App\Product;
use App\Purchase;
use App\Seller;
use App\Store;
use App\User;
use App\BarcodeMovement;
use App\Barcode;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use Validator;
use App\ProductStoreQuantity;
use DB;
use App\Usertypeprice;
use App\Progress;

class sellerApiController extends Controller
{
  public function get_in_progress(Request $request)
  {
       $validator = Validator::make($request->all(), [
          'api_token'   => 'required|exists:sellers,api_token',
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors()->first(),
                      'dest' => 'getInProgress',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
         else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'getInProgress',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

        $items    = Progress::where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();
        $arr = array();
       /* foreach ($items as $itemm) {
                 if (in_array($itemm->bill_id, $arr)) 
                  {
                      continue;
                  }
                  else
                  {
                      array_push($arr, $history->bill_id);
                  }
        }*/
            if (count($items) <= 0)    
            {
               /*$items    = Progress::whereIn('bill_id', $arr)
                            ->where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();*/
               return response()->json([
                      'message' => __('translations.no_orders_inprogress_from_this_store'),
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
            else
            {
                foreach ($items as $item) 
                {
                   $item->makeHidden(['id', 'deleted_at', 'user_id', 'store_id', 'seller_id', 'payment_method_id', 'updated_at']);
                   $item->makeHidden('user');
                   $item->makeHidden('user');
                   $item->makeHidden('product');
                   $item->makeHidden('store');
                   $item['quantity']       = -($item->quantity); 
                   $item['user_name']      = $item->user->name; 
                   $item['store_name']     = $item->store->name; 
                   $item['product_name']   = $item->product->name; 
                   $item['bought_price']   = $item->price * $item->quantity; 
                   $item['bill_price_without_shipment']  = $item->purchase_price - $item->shipment; 
                }
                return response()->json([
                      'items' => $items->groupBy('bill_id'),
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
  }

  public function get_in_progress2(Request $request)
  {
       $validator = Validator::make($request->all(), [
          'api_token'   => 'required|exists:sellers,api_token',
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors()->first(),
                      'dest' => 'getInProgress',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
         else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'getInProgress',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

        $items    = Progress::where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();
        $arr = array();
       /* foreach ($items as $itemm) {
                 if (in_array($itemm->bill_id, $arr)) 
                  {
                      continue;
                  }
                  else
                  {
                      array_push($arr, $history->bill_id);
                  }
        }*/
            if (count($items) <= 0)    
            {
               /*$items    = Progress::whereIn('bill_id', $arr)
                            ->where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();*/
               return response()->json([
                      'message' => __('translations.no_orders_inprogress_from_this_store'),
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
            else
            {
                foreach ($items as $item) 
                {
                   $item->makeHidden(['id', 'deleted_at', 'user_id', 'store_id', 'seller_id', 'payment_method_id', 'updated_at', 'purchase_id', 'created_at', 'use_promo', 'shipment', 'bill_id', 'purchase_price']);
                   $item->makeHidden('user');
                   $item->makeHidden('user');
                   $item->makeHidden('product');
                   $item->makeHidden('store');
                   $item['quantity']       = -($item->quantity); 
                  // $item['user_name']      = $item->user->name; 
                  // $item['store_name']     = $item->store->name; 
                   $item['product_name']   = $item->product->name; 
                   $item['bought_price']   = $item->price * $item->quantity; 
                  // $item['bill_price_without_shipment']  = $item->purchase_price - $item->shipment; 
                
                $ones = $items->groupBy('bill_id'); 
                foreach ($ones as $oo) 
                {                   
                   $oo['purchase_id'] = $item->purchase_id; 
                   $oo['shipment']    = $item->shipment; 
                   $oo['use_promo']   = $item->use_promo; 
                   $oo['purchase_price']   = $item->purchase_price; 
                   $oo['bill_price_without_shipment'] = $item->purchase_price - $item->shipment;  
                   $oo['store_name']     = $item->store->name; 
                   $oo['user_name']      = $item->user->name; 
                   $oo['created_at']  = $item->created_at->format('Y-m-d H:i:s'); 
                }
}
                return response()->json([
                      'items' => $ones,
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
  }

   public function get_in_progress3(Request $request)
  {
       $validator = Validator::make($request->all(), [
          'api_token'   => 'required|exists:sellers,api_token',
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors()->first(),
                      'dest' => 'getInProgress',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'getInProgress',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
         else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'getInProgress',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'getInProgress',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ], 401);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

        $items    = Progress::where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();
        $arr = array();
        foreach ($items as $itemm) {
                 if (in_array($itemm->bill_id, $arr)) 
                  {
                      continue;
                  }
                  else
                  {
                      array_push($arr, $itemm->bill_id);
                  }
        }
            if (count($items) <= 0)    
            {              
               return response()->json([
                      'message' => __('translations.no_orders_inprogress_from_this_store'),
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
            else
            {
              $records = array();
              foreach ($arr as $bill) 
              {
               $items    = Progress::where('bill_id', $bill)
                            ->where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->select('user_id','product_id','order_status','quantity','price','purchase_price','bill_id','purchase_id','store_id','seller_id','payment_method_id','use_promo','shipment')
                            ->get();
 foreach ($items as $item) 
                {
                   $item->makeHidden(['id', 'deleted_at', 'user_id', 'store_id', 'seller_id', 'payment_method_id', 'updated_at', 'purchase_id', 'created_at', 'use_promo', 'shipment', 'bill_id', 'purchase_price']);
                   $item->makeHidden('user');
                   $item->makeHidden('user');
                   $item->makeHidden('product');
                   $item->makeHidden('store');
                   $item['quantity']       = -($item->quantity); 
                   $item['order_status']   = __('translations.in progress'); 
                  // $item['user_name']      = $item->user->name; 
                  // $item['store_name']     = $item->store->name; 
                   $item['product_name']   = $item->product->name; 
                   $item['bought_price']   = $item->price * $item->quantity; 
}        

$bill_details  = Progress::where('bill_id', $bill)
                            ->where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->first();

                array_push($records, [
                   'bill_products'          => $items, 
                   'bill_id'                => $bill_details->bill_id,
                   'purchase_id'            => $bill_details->purchase_id,
                   'shipment'               => $bill_details->shipment,
                   'use_promo'              => $bill_details->use_promo, 
                   'purchase_price'         => $bill_details->purchase_price,
                   'bill_price_without_shipment' => $bill_details->purchase_price - $bill_details->shipment, 
                   'store_name'                  => $bill_details->store->name,
                   'user_name'                   => $bill_details->user->name,
                   'created_at'                  => $bill_details->created_at->format('Y-m-d H:i:s'), 
                ]);
              }
                return response()->json([
                      'items' => $records,
                      'dest' => 'getInProgress',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }
  }

  public function seller_deliver_order2(Request $request)
  {

       $validator = Validator::make($request->all(), [
          'api_token'    => 'required|exists:sellers,api_token',
          'purchase_id'  => 'required|integer',
          // 'product_id'   => 'required|integer|exists:products,id',
          'product_ids'      => 'required|min:1'
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors(),
                      'dest' => 'sellerDeliver',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
                        return response()->json([
                          'message' => $validator->errors(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
        else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'sellerDeliver',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

        $purchase = Purchase::find($request->purchase_id);
        if (!$purchase) {
            return response()->json([
                          'message' => __('translations.purchase_doesnot_exist'),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
        }

      $codes = $request['product_ids'];
      $codes = trim($codes, ' ');
      $codes = trim($codes, '"');
      
      if(!is_array($codes)){
        $codes = json_decode($codes);
      }

      // added ahmed
      
      if ($codes === NULL) 
      {
             return response()->json([
                'message' => __('translations.empty_barcode'), 
                'code'    => 202,
            ], 201);
      }
      else
      {
            foreach ($codes as $key => $value)
            {
                 $typee = gettype($value);
                 if ($typee === NULL)
                 {
                    return response()->json([
                        'message' => __('translations.empty_barcode'), 
                        'code'    => 203,
                    ], 201);
                }
            }
      }  

        if ($purchase) 
        {
            $codes = array_count_values($codes);
            foreach ($codes as $key => $value)
            {
              // return $key;
                   if ($value > 1){
                      return $key. ' ' .__('translations.can_not_be_repeated');
                  }
                  $existProduct = Product::where('id', $key)->first();
                  if (!$existProduct) {
                     return response()->json([
                              'message' => __('translations.product_doesnot_exist').' '. $key,
                              'dest' => 'sellerDeliver',
                              'code' => 400,
                              'auth_id' => $seller->id,
                          ], 400);
                  }

                    if ($existProduct && $existProduct->archive == 1) 
                    {
                       return response()->json([
                                'message' => __('translations.this_product_has_been_archived').' '. $key,
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                    }

                   /*  if ($existProduct && $existProduct->available_online != 1) {
                       return response()->json([
                                'message' => __('translations.prod_not_available_online'),
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                    }*/

              
               $inProgress_orNot = Progress::where('order_status', 'in progress')
                                           ->where('purchase_id', $purchase->id)
                                           ->first();
                    if (!$inProgress_orNot) {
                        return response()->json([
                                  'message' => 'Not In Progress Yet',
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }

                  if ($inProgress_orNot) 
                  {
                           $product_in_purchase = Progress::where('order_status', 'in progress')
                                                 ->where('purchase_id', $purchase->id)
                                                 ->where('product_id', $key)
                                                 ->first();
                          if (!$product_in_purchase) 
                          {                
                            $p = Product::select('name')->where('id', $key)->first();
                              return response()->json([
                                        'message' =>  __('translations.product_does_not_belong_to_this_purchase').' '. $p->name,
                                        'dest' => 'sellerDeliver',
                                        'code' => 400,
                                        'auth_id' => $seller->id,
                                    ], 400);
                          }

                    $store_in_purchase = Progress::where('purchase_id', $purchase->id)
                                       ->where('product_id', $key)
                                       ->where('store_id', $store_id)
                                       ->first();
                    if ($store_in_purchase && $store_in_purchase->order_status == 'delivered') 
                    {                
                       $p = Product::select('name')->where('id', $key)->first();
                        return response()->json([
                                  'message' =>  __('translations.purchase_product_delivered_from_this_store_earlier').' '. $p->name,
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }

                    if (!$store_in_purchase) 
                    {                
                       $p = Product::select('name')->where('id', $key)->first();
                        return response()->json([
                                  'message' => __('translations.product_does_not_belong_to_this_purchase').' '. $p->name,
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }
           }
        } // end foreach
      }  // end if purchase
      foreach ($codes as $key => $value) 
      {
                    $item    = Progress::where('order_status', 'in progress')
                                        ->where('store_id', $store_id)
                                        ->where('quantity', '!=', 0)
                                        ->where('purchase_id', '!=', null)
                                        ->where('purchase_id', $request->purchase_id)
                                        ->where('product_id', $key)
                                        ->first();

                     $itemHistory   = History::where('order_status', 'in progress')
                                        ->where('store_id', null)
                                        ->where('quantity', '>=', -$item->quantity)
                                        ->where('purchase_id', '!=', null)
                                        ->where('bill_id', $item->bill_id)
                                        ->where('purchase_id', $item->purchase_id)
                                        ->where('product_id', $item->product_id)
                                        ->first();

                    $itemQuantity   = ProductStoreQuantity::where('custom_status', 'in progress')
                                        ->where('store_id', $store_id)
                                       // ->where('quantity', '==', $item->quantity)
                                        ->where('purchase_id', '!=', null)
                                        //->where('bill_id', $item->bill_id)
                                        ->where('purchase_id', $item->purchase_id)
                                        ->where('product_id', $item->product_id)
                                                  ->first();
                       if (!$itemHistory) 
                      {
                         return response()->json([
                                'message' => __('translations.can not deliver order'),
                                'dest' => 'sellerDeliver',
                                'code' => 200,
                                'auth_id' => $seller->id,
                            ], 200);
                      }      

                      if (!$itemQuantity) 
                      {
                         return response()->json([
                                'message' => __('translations.can not deliver order'),
                                'dest' => 'sellerDeliver',
                                'code' => 200,
                                'auth_id' => $seller->id,
                            ], 200);
                      }      

                    if ($item && $itemHistory && $itemQuantity) 
                    {
                        if (-$item->quantity < $itemHistory->quantity) 
                        {
                            $former_quantity = $itemHistory->quantity;
                               $itemHistory->update([
                                'quantity' => $itemHistory->quantity + $item->quantity,
                                'price' =>  doubleval($item->price) * ($itemHistory->quantity + $item->quantity),
                              //  'seller_id'    => $seller->id,
                              //  'store_id'     => $store_id,
                               ]);

                               $history = History::create([
                                    'user_id' => $item->user_id,
                                    'product_id' => $item->product_id,
                                    'purchase_id' => $item->purchase_id,
                                    'price' => doubleval($item->price) * -$item->quantity,
                                    'order_status' => 'delivered',
                                    'quantity' => -$item->quantity,
                                    'bill_id' => $item->bill_id,
                                    'order_id' => $itemHistory->order_id,
                                    'store_id' => $seller->store_id,
                                    'seller_id' => $seller->id,
                                    'original' => -$item->quantity,
                                ]);


                               $item->update([
                                'order_status' => 'delivered',
                                'seller_id' => $seller->id,
                            ]);

                                $itemQuantity->update([
                                'custom_status' => 'delivered',
                                'seller_id' => $seller->id,
                            ]);

                        $purchase_original = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'in progress')
                                                     ->count();

                         $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'delivered')
                                                     ->count();
                         
                          if ($purchase_original <= 0) {
                            $purchase->update(['purchase_status' => 'total delivered']);
                          }

                           if ($purchase_original > 0 && $purchase_delivered > 0) {
                            $purchase->update(['purchase_status' => 'partially delivered']);
                          }
                               /* return response()->json([
                                      'message' => __('translations.purchase_delivered_partially'),
                                      'dest' => 'getInProgress',
                                      'code' => 200,
                                      'auth_id' => $seller->id,
                                  ], 200);*/
                        }

                         if (-$item->quantity  == $itemHistory->quantity) 
                        {
                       
                               $itemHistory->update([
                                'order_status' => 'delivered',
                                'seller_id'    => $seller->id,
                                'store_id'     => $store_id,
                               ]);

                               $item->update([
                                'order_status' => 'delivered',
                                'seller_id'    => $seller->id,
                            ]);

                                $itemQuantity->update([
                                'custom_status' => 'delivered',
                                'seller_id' => $seller->id,
                            ]);


                        $purchase_original = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'in progress')
                                                     ->count();

                         $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'delivered')
                                                     ->count();
                         
                          if ($purchase_original <= 0) {
                            $purchase->update(['purchase_status' => 'total delivered']);
                          }

                           if ($purchase_original > 0 && $purchase_delivered > 0) {
                            $purchase->update(['purchase_status' => 'partially delivered']);
                          }
                              /* return response()->json([
                                      'message' => __('translations.purchase_delivered_completely'),
                                      'dest' => 'getInProgress',
                                      'code' => 200,
                                      'auth_id' => $seller->id,
                                  ], 200);*/
                        }
                    }    
              } // end foreach prods

              return response()->json([
                                      'message' => __('translations.purchase_delivered'),
                                      // 'message' => __('translations.purchase_delivered'),
                                      'dest' => 'sellerDeliver',
                                      'code' => 200,
                                      'auth_id' => $seller->id,
                                  ], 200);
  }

  public function seller_deliver_order3(Request $request)
  {
       $validator = Validator::make($request->all(), [
          'api_token'    => 'required|exists:sellers,api_token',
          'purchase_id'  => 'required|integer',
          // 'product_id'   => 'required|integer|exists:products,id',
         // 'product_ids'      => 'required|min:1'
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors(),
                      'dest' => 'sellerDeliver',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
                        return response()->json([
                          'message' => $validator->errors(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
        else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'sellerDeliver',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

         $indexses    = Progress::where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->get();
        if (count($indexses) <= 0) {
          return response()->json([
                          'message' => __('translations.no_orders_inprogress_from_this_store'),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
        }
        $purchase = Purchase::find($request->purchase_id);
        if (!$purchase) {
            return response()->json([
                          'message' => __('translations.purchase_doesnot_exist'),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
        }

        $inProgress_orNot = Progress::where('order_status', 'in progress')
                                          ->where('quantity', '!=', 0)
                                           ->where('purchase_id', $purchase->id)
                                           ->first();
                  
  if (!$inProgress_orNot) {
if ($purchase->purchase_status == 'pending') {
                              return response()->json([
                                  'message' => __('translations.Not_In_Progress_Yet'),
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
}
}

if ($purchase->purchase_status == 'total delivered') {
   return response()->json([
                                  'message' => __('translations.purchase_product_delivered_from_this_store_earlier'),
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
}
      $codes = Progress::where('purchase_id', $request->purchase_id)
                       ->where('store_id', $store_id)
                       ->where('quantity', '!=', 0)
                       ->select('product_id')->get();
    
        if ($purchase) 
        {
          $thisStore = Store::find($store_id);
            foreach ($codes as $key)
            {
                  $existProduct = Product::where('id', $key->product_id)->first();
                  if (!$existProduct) {
                     return response()->json([
                              'message' => __('translations.product_doesnot_exist').' '. $key->product_id,
                              'dest' => 'sellerDeliver',
                              'code' => 400,
                              'auth_id' => $seller->id,
                          ], 400);
                  }

                    if ($existProduct && $existProduct->archive == 1) 
                    {
                       return response()->json([
                                'message' => __('translations.this_product_has_been_archived').' '. $key->product_id,
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                    }


               $inProgress_orNot = Progress::where('order_status', 'in progress')
                                           ->where('purchase_id', $purchase->id)
                                           ->first();
                    if (!$inProgress_orNot) {
                        return response()->json([
                                  'message' => __('translations.Not_In_Progress_Yet'),
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }

                  if ($inProgress_orNot) 
                  {
                           $product_in_purchase = Progress::where('order_status', 'in progress')
                                                 ->where('purchase_id', $purchase->id)
                                                  ->where('product_id', $key->product_id)
                                                 ->first();
                          if (!$product_in_purchase) 
                          {                
                           $p = Product::select('name')->where('id', $key->product_id)->first();
                              return response()->json([
                                        'message' =>  __('translations.product_does_not_belong_to_this_purchase')
                                       .' '. $p->name,
                                        'dest' => 'sellerDeliver',
                                        'code' => 400,
                                        'auth_id' => $seller->id,
                                    ], 400);
                          }

                    $store_in_purchase = Progress::where('purchase_id', $purchase->id)
                                       // ->where('product_id', $key->product_id)
                                       ->where('store_id', $store_id)
                                       ->first();
                    if ($store_in_purchase && $store_in_purchase->order_status == 'delivered') 
                    {                
                       //$p = Product::select('name')->where('id', $key->product_id)->first();
                        return response()->json([
                                  'message' =>  __('translations.purchase_product_delivered_from_this_store_earlier'), //.' '. $p->name,
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }

                    if (!$store_in_purchase) 
                    {                
                       $p = Product::select('name')->where('id', $key->product_id)->first();
                        return response()->json([
                                  'message' => __('translations.product_does_not_belong_to_this_purchase').' '. $p->name,
                                  'dest' => 'sellerDeliver',
                                  'code' => 400,
                                  'auth_id' => $seller->id,
                              ], 400);
                    }

                     $item    = Progress::where('order_status', 'in progress')
                                        ->where('store_id', $store_id)
                                        ->where('purchase_id', $request->purchase_id)
                                        ->where('product_id', $key->product_id)
                                        ->first();

                    if ($existProduct && ($thisStore->quantity_in_store($key->product_id) < -$item->quantity)) 
                    {
                       return response()->json([
                                'message' => __('translations.neededed_qty_notAvailable').' ( '. $item->product->name. ' )',
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                    }
           }
        } // end foreach
      }  // end if purchase
      foreach ($codes as $key) 
      {
                    $item    = Progress::where('order_status', 'in progress')
                                        ->where('store_id', $store_id)
                                        ->where('quantity', '!=', 0)
                                        ->where('purchase_id', $request->purchase_id)
                                        ->where('product_id', $key->product_id)
                                        ->first();

                     $itemHistory   = History::where('order_status', 'in progress')
                                       // ->where('bill_id', $item->bill_id)
                                        ->where('purchase_id', $request->purchase_id)
                                        ->where('product_id', $key->product_id)
                                        ->first();

                    $itemQuantity   = ProductStoreQuantity::where('custom_status', 'in progress')
                                        ->where('store_id', $store_id)
                                        //->where('bill_id', $item->bill_id)
                                        ->where('quantity', '!=', 0)
                                        ->where('purchase_id', $request->purchase_id)
                                        ->where('product_id', $key->product_id)
                                        ->first();
                   // return $itemQuantity;
                       if (!$itemHistory) 
                      {
                         return response()->json([
                                'message' => __('translations.can_not_deliver_orderhistorytable'),
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                      }     

                      if (!($itemQuantity)) 
                      {
                         return response()->json([
                                'message' => __('translations.can_not_deliver_orderqtytable'),
                                'dest' => 'sellerDeliver',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ], 400);
                      }    
                      //else{
                      //  return 'll';
                     // }  
                    if ($item && $itemHistory && $itemQuantity) 
                    {
                        if (-$item->quantity < $itemHistory->quantity) 
                        {
                          // return $itemHistory->quantity;
                                $former_quantity = $itemHistory->quantity;
                                   $itemHistory->update([
                                    'quantity' => $itemHistory->quantity + $item->quantity,
                                    'price'    =>  doubleval($item->price) * ($itemHistory->quantity + $item->quantity),
                                  //  'seller_id'    => $seller->id,
                                  //  'store_id'     => $store_id,
                                   ]);

                                   $history = History::create([
                                        'user_id' => $item->user_id,
                                        'product_id' => $item->product_id,
                                        'purchase_id' => $item->purchase_id,
                                        'price' => doubleval($item->price) * -$item->quantity,
                                        'order_status' => 'delivered',
                                        'quantity' => -$item->quantity,
                                        'bill_id' => $item->bill_id,
                                        'order_id' => $itemHistory->order_id,
                                        'store_id' => $seller->store_id,
                                        'seller_id' => $seller->id,
                                        'original' => -$item->quantity,
                                    ]);


                                   $item->update([
                                    'order_status' => 'delivered',
                                    'seller_id' => $seller->id,
                                ]);

                                    $itemQuantity->update([
                                    'custom_status' => 'delivered',
                                    'seller_id' => $seller->id,
                                ]);

                            $purchase_original = History::where('purchase_id', $purchase->id)
                                                         ->where('order_status', 'in progress')
                                                         ->count();

                             $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                         ->where('order_status', 'delivered')
                                                         ->count();
                             
                              if ($purchase_original <= 0) {
                                $purchase->update(['purchase_status' => 'total delivered']);
                              }

                               if ($purchase_original > 0 && $purchase_delivered > 0) {
                                $purchase->update(['purchase_status' => 'partially delivered']);
                              }
                                   /* return response()->json([
                                          'message' => __('translations.purchase_delivered_partially'),
                                          'dest' => 'getInProgress',
                                          'code' => 200,
                                          'auth_id' => $seller->id,
                                      ], 200);*/
                        }

                         else // (-$item->quantity  == $itemHistory->quantity) 
                        {
                       
                               $itemHistory->update([
                                'order_status' => 'delivered',
                                'seller_id'    => $seller->id,
                                'store_id'     => $store_id,
                               ]);

                               $item->update([
                                'order_status' => 'delivered',
                                'seller_id'    => $seller->id,
                            ]);

                                $itemQuantity->update([
                                'custom_status' => 'delivered',
                                'seller_id' => $seller->id,
                            ]);


                        $purchase_original = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'in progress')
                                                     ->count();

                         $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'delivered')
                                                     ->count();
                         
                          if ($purchase_original <= 0) {
                            $purchase->update(['purchase_status' => 'total delivered']);
                          }

                           if ($purchase_original > 0 && $purchase_delivered > 0) {
                            $purchase->update(['purchase_status' => 'partially delivered']);
                          }
                              /* return response()->json([
                                      'message' => __('translations.purchase_delivered_completely'),
                                      'dest' => 'getInProgress',
                                      'code' => 200,
                                      'auth_id' => $seller->id,
                                  ], 200);*/
                        }
                    }    
              } // end foreach prods

              return response()->json([
                                      'message' => __('translations.purchase_delivered'),
                                      'store_name'  => $seller->store->name,
                                      'seller_name' => $seller->name,
                                      'bill_id'     => $purchase->bill_id, 
                                      // 'message' => __('translations.purchase_delivered'),
                                      'dest' => 'sellerDeliver',
                                      'code' => 200,
                                      'auth_id' => $seller->id,
                                  ], 200);
  }


  public function seller_deliver_order(Request $request)
  {

       $validator = Validator::make($request->all(), [
          'api_token'    => 'required|exists:sellers,api_token',
          'purchase_id'  => 'required|integer',
          'product_id'   => 'required|integer|exists:products,id',
        ]);

         if ($validator->fails()) 
        {
            if (!$request->has('api_token') || $request->api_token == '') 
            {
                     return response()->json([
                      'message' => $validator->errors()->first(),
                      'dest' => 'sellerDeliver',
                      'code' => 400,
                      'auth_id' => null,
                  ], 400);
            }

            if ($request->has('api_token') && $request->api_token != '') 
            {
                if (!Seller::where(['api_token' => $request->api_token])->first()) 
                {
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => null,
                      ], 400);
                }

                if ($seller = Seller::where(['api_token' => $request->api_token])->first()) 
                {   
                     if ($seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
                        return response()->json([
                          'message' => $validator->errors()->first(),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
                }
            }
        }    // end newvalidation
         else
        {
            if ($request->has('api_token') && $request->api_token != '') 
            {
                   $seller = Seller::where(['api_token' => $request->api_token])->first();
                    if (!$seller)
                    {
                            return response()->json([
                              'message' => $validator->errors(),
                              'dest'    => 'sellerDeliver',
                              'code'    => 400,
                              'auth_id' => null,
                          ], 400);
                    }
                
                    if ($seller && $seller->suspend == 1) 
                    {
                        return response()->json([
                            'message' => __('translations.banned_seller'),
                            'dest' => 'sellerDeliver',
                            'code' => 401,
                            'auth_id' => $seller->id,
                        ]);
                    }
            }
        }
        $seller   = Seller::where(['api_token' => $request->api_token])->first();
        $store_id = $seller->store_id;

        $purchase = Purchase::find($request->purchase_id);
        if (!$purchase) {
            return response()->json([
                          'message' => __('translations.purchase_doesnot_exist'),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
        }
        if ($purchase) {
           $inProgress_orNot = Progress::where('order_status', 'in progress')
                                       ->where('purchase_id', $purchase->id)
                                       ->first();
            if (!$inProgress_orNot) {
                return response()->json([
                          'message' =>  __('translations.Not_In_Progress_Yet'),
                          'dest' => 'sellerDeliver',
                          'code' => 400,
                          'auth_id' => $seller->id,
                      ], 400);
            }

             if ($inProgress_orNot) 
             {
                 $product_in_purchase = Progress::where('order_status', 'in progress')
                                       ->where('purchase_id', $purchase->id)
                                       ->where('product_id', $request->product_id)
                                       ->first();
                if (!$product_in_purchase) 
                {                
                    return response()->json([
                              'message' => __('translations.product_does_not_belong_to_this_purchase'),
                              'dest' => 'sellerDeliver',
                              'code' => 400,
                              'auth_id' => $seller->id,
                          ], 400);
                }

                 $store_in_purchase = Progress::where('purchase_id', $purchase->id)
                                       ->where('product_id', $request->product_id)
                                       ->where('store_id', $store_id)
                                       ->first();
                if ($store_in_purchase && $store_in_purchase->order_status == 'delivered') 
                {                
                    return response()->json([
                              'message' => __('translations.purchase_product_delivered_from_this_store_earlier'),
                              'dest' => 'sellerDeliver',
                              'code' => 400,
                              'auth_id' => $seller->id,
                          ], 400);
                }

                if (!$store_in_purchase) 
                {                
                    return response()->json([
                              'message' => __('translations.purchase_product_does_not_belong_to_this_store'),
                              'dest' => 'sellerDeliver',
                              'code' => 400,
                              'auth_id' => $seller->id,
                          ], 400);
                }
            }
        }

        $item    = Progress::where('order_status', 'in progress')
                            ->where('store_id', $store_id)
                            ->where('quantity', '!=', 0)
                            ->where('purchase_id', '!=', null)
                            ->where('purchase_id', $request->purchase_id)
                            ->where('product_id', $request->product_id)
                            ->first();

         $itemHistory   = History::where('order_status', 'in progress')
                            ->where('store_id', null)
                            ->where('quantity', '>=', -$item->quantity)
                            ->where('purchase_id', '!=', null)
                            ->where('bill_id', $item->bill_id)
                            ->where('purchase_id', $item->purchase_id)
                            ->where('product_id', $item->product_id)
                            ->first();

        $itemQuantity   = ProductStoreQuantity::where('custom_status', 'in progress')
                            ->where('store_id', $store_id)
                           // ->where('quantity', '==', $item->quantity)
                            ->where('purchase_id', '!=', null)
                            //->where('bill_id', $item->bill_id)
                            ->where('purchase_id', $item->purchase_id)
                            ->where('product_id', $item->product_id)
                            ->first();
             if (!$itemHistory) 
            {
               return response()->json([
                      'message' => __('translations.can_not_deliver_order'),
                      'dest' => 'sellerDeliver',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }      

            if (!$itemQuantity) 
            {
               return response()->json([
                      'message' => __('translations.can_not_deliver_order'),
                      'dest' => 'sellerDeliver',
                      'code' => 200,
                      'auth_id' => $seller->id,
                  ], 200);
            }      

            if ($item && $itemHistory && $itemQuantity) 
            {
                if (-$item->quantity < $itemHistory->quantity) 
                {
                    $former_quantity = $itemHistory->quantity;
                       $itemHistory->update([
                        'quantity' => $itemHistory->quantity + $item->quantity,
                        'price' =>  doubleval($item->price) * ($itemHistory->quantity + $item->quantity),
                      //  'seller_id'    => $seller->id,
                      //  'store_id'     => $store_id,
                       ]);

                       $history = History::create([
                            'user_id' => $item->user_id,
                            'product_id' => $item->product_id,
                            'purchase_id' => $item->purchase_id,
                            'price' => doubleval($item->price) * -$item->quantity,
                            'order_status' => 'delivered',
                            'quantity' => -$item->quantity,
                            'bill_id' => $item->bill_id,
                            'order_id' => $itemHistory->order_id,
                            'store_id' => $seller->store_id,
                            'seller_id' => $seller->id,
                            'original' => -$item->quantity,
                        ]);


                       $item->update([
                        'order_status' => 'delivered',
                        'seller_id' => $seller->id,
                    ]);

                        $itemQuantity->update([
                        'custom_status' => 'delivered',
                        'seller_id' => $seller->id,
                    ]);

                 $purchase_original = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'in progress')
                                                     ->count();

                         $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'delivered')
                                                     ->count();
                         
                          if ($purchase_original <= 0) {
                            $purchase->update(['purchase_status' => 'total delivered']);
                          }

                           if ($purchase_original > 0 && $purchase_delivered > 0) {
                            $purchase->update(['purchase_status' => 'partially delivered']);
                          }
                       return response()->json([
                              'message' => __('translations.purchase_delivered_partially'),
                              'dest' => 'sellerDeliver',
                              'code' => 200,
                              'auth_id' => $seller->id,
                          ], 200);
                }

                 if (-$item->quantity  == $itemHistory->quantity) 
                {
               
                       $itemHistory->update([
                        'order_status' => 'delivered',
                        'seller_id'    => $seller->id,
                        'store_id'     => $store_id,
                       ]);

                       $item->update([
                        'order_status' => 'delivered',
                        'seller_id'    => $seller->id,
                    ]);

                        $itemQuantity->update([
                        'custom_status' => 'delivered',
                        'seller_id' => $seller->id,
                    ]);


                 $purchase_original = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'in progress')
                                                     ->count();

                         $purchase_delivered = History::where('purchase_id', $purchase->id)
                                                     ->where('order_status', 'delivered')
                                                     ->count();
                         
                          if ($purchase_original <= 0) {
                            $purchase->update(['purchase_status' => 'total delivered']);
                          }

                           if ($purchase_original > 0 && $purchase_delivered > 0) {
                            $purchase->update(['purchase_status' => 'partially delivered']);
                          }

                       return response()->json([
                              'message' => __('translations.purchase_delivered_completely'),
                              'dest' => 'sellerDeliver',
                              'code' => 200,
                              'auth_id' => $seller->id,
                          ], 200);
                }
            }           
  }

    public function customer_register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:30',
            'phone'       => 'required|size:11|regex:/(01)[0-9]{9}/',
            'usertype_id' => 'required|exists:usertypes,id',
            'api_token'   => 'required',

        ]);

        $seller = Seller::where(['api_token' => $request->api_token])->first();

        if ($validator->fails())
        {
            return response()->json([
                'code'    => 400,
                'dest'    => 'registercustomer',
                'error'   => $validator->errors(), 
                'auth_id' => $seller->id,
            ], 400);
        }
        if ($request->has('phone') && $request->phone != '') {
            if(strstr($request->phone, '.'))
            {
               return response()->json([
                        'code'    => 400,
                        'dest' => 'registercustomer',
                        'auth_id' => $seller->id,
                        'error'   => 
                        ['phone' => [ __('translations.phone_cant_contain_dots')]],
                    ], 400);
            }
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => 'user',
            'api_token' => str_random(30),
            'usertype_id' => $request->usertype_id,
        ]);

        return response()->json([
            'api_token' => $user->api_token,
            'dest' => 'registercustomer',
            'code' => 200,
            'auth_id' => $seller->id,
        ], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails())
        {
            return response()->json([
                'message' => false,
                'code' => 400,
                'error'   => $validator->errors(),
                'dest' => 'selllogin',
            ], 400);
        }
        $seller = Seller::where(['email' => $request->email])->first();
        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
               return response()->json([
                'code' => 401, 
                'dest' => 'selllogin',
                'message' => __('translations.banned_seller')], 401);
             }
        }
        if ($seller && Hash::check($request->password, $seller->password)) {
            return response()->json([
                'code' => 200,
                'seller_discount' => $seller->discount,
                'seller_name'      => $seller->name,
                'seller_store_name' => $seller->store->name,
                'seller_store_address' => $seller->store->address,
                'apitoken' => $seller->api_token,
                'dest' => 'selllogin',
            ]);
        }
        return response()->json([
            'message' => __('translations.wrong_email_or_password'),
            'dest'  => 'selllogin',
            'code'  => 401,
        ], 401);
    }

    // get product prices by array of products code sent inthe request
    public function getProductsPrices(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codes' => 'required|min:1',
            'api_token' => 'required',
        ]);

        $seller = Seller::where(['api_token' => $request->api_token])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'productPrices', 
              'code' => 201,
              'auth_id' => $seller->id,
          ]);
        }
        $codes = $request->codes;
        //return $codes;
        if(!is_array($codes)){
          $codes = json_decode($codes);
        }
        // return $codes;

        $client_products = array();

        $codes = array_count_values($codes);
        foreach ($codes as $code => $quantity) {
            $product = Product::where(['unique_id' => $code, 'archive' => 0])->first();

            if (!$product) {
                return response()->json([
                    'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                    'dest' => 'productPrices', 
                    'code' => 201,
                    'auth_id' => $seller->id,
                ]);
            }
            // added
            $product_quantity = ProductStoreQuantity::where('product_id', $product->id)->sum('quantity'); 
            if ($product_quantity > 0) 
            {           
                    $currency = __('translations.egp');
                    $product_ = [
                    'name'      => $product['name'] , 
                    'unique_id' => $product['unique_id'],
                    'discount'  => $product->discount, 
                    'price'     => $product->pricing($product->id). ' ' .$currency, 
                    'price_after_discount' => $product->priceafterdiscount($product->id),
                    'currency'  => $currency,
                    'quantity'  => $product_quantity, 
                     ];
            }
            else
            {
                continue;
            }
             array_push($client_products, $product_);
        }

        if (empty($client_products)) 
        {
            return response()->json([
            'products' => __('translations.no_quantity_available_in_stores'),
            'dest' => 'productPrices', 
            'code' => 200,
            'auth_id' => $seller->id,
        ]);
        }

        return response()->json([
            'products' => $client_products,
            'dest' => 'productPrices', 
            'code' => 200,
            'auth_id' => $seller->id,
        ]);
    }

    public function getProductsPrices_phone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codes' => 'required|min:1',
            'api_token' => 'required',
            'phone' => 'required|size:11|regex:/(01)[0-9]{9}/',
            'api_token' => 'required',
        ]);

         $seller = Seller::where(['api_token' => $request->api_token])->first();
        
        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'productsPhone',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }

       
        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
               return response()->json([
                'code' => 401, 
                'dest' => 'productsPhone',
                'auth_id' => $seller->id,
                'message' => __('translations.banned_seller')], 401);
            }
        }
        else
        {
             return response()->json([
                'code' => 401, 
                'dest' => 'productsPhone',
                'auth_id' => $seller->id,
                'message' => __('translations.seller_not_found')
            ], 401);
        }
        $codes = $request->codes;
        //return $codes;
        if(!is_array($codes)){
          $codes = json_decode($codes);
        }
        // return var_dump($codes);
       /* $nums = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        if ($request->has('phone') && $request->phone != '') 
        {
            for($i= 0; $i<strlen($request->phone); $i++) {
                if (!in_array($request->phone[$i], $nums)) {
                    return response()->json([
                        //'phon' => $request->phone[$i]]);
                    'message' => __('translations.client_not_found'),
                    'dest' => 'productsPhone',
                    'auth_id' => $seller->id,
                    'code' => 400,
                    ], 400);
                }
            }
        }*/
        if ($request->has('phone') && $request->phone != '') 
        {
           $user = User::where('phone', $request->phone)->withTrashed()->first();
           if (!$user) 
           {
               return response()->json([
                'message' => __('translations.client_not_found'),
                'dest' => 'productsPhone',
                'auth_id' => $seller->id,
                'code' => 400,
               ], 400);
           }
           else
           {
              if($user->deleted_at > 0)
              {
                return response()->json([
                'message' => __('translations.user_blocked'),
                'dest' => 'productsPhone',
                'auth_id' => $seller->id,
                'code' => 400,
               ], 400);
              }

              elseif($user->suspend == 1)
              {
                return response()->json([
                'message' => __('translations.user_blocked'),
                'dest' => 'productsPhone',
                'code' => 400,
                'auth_id' => $seller->id,
               ], 400);
              }
              else
              {
                        if (empty($user->usertype_id)) 
                        {
                            return response()->json([
                                'message' => __('translations.make_sure_about_number'),
                                'dest' => 'productsPhone',
                                'code' => 400,
                                'auth_id' => $seller->id,
                            ]);
                        }
                        else
                        {
                            $usertype_id = $user->usertype_id;
                        }
              }
           }
        }

        $client_products = array();

        $codes = array_count_values($codes);
        foreach ($codes as $code => $quantity) {
            $product = Product::where(['unique_id' => $code, 'archive' => 0])->first();
            
            if (!$product) {
                return response()->json([
                    'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                    'dest' => 'productsPhone',
                    'code' => 400,
                    'auth_id' => $seller->id,
                ]);
            }

            else 
            {   
                $item = Usertypeprice::where('product_id', $product->id)
                                       ->where('usertype_id', $usertype_id)
                                       ->first();  
// return $item;
                    if ($item->usertype_id == 1) 
                    {
                        $currency = __('translations.egp');
                    $product_ = [
                    'name'      => $product['name'] , 
                    'unique_id' => $product['unique_id'],
                    'discount'  => $product->discount, 
                    'price'     => $product->pricing($product->id). ' ' .$currency, 
                    'price_after_discount' => $product->priceafterdiscount($product->id),
                    'currency'  => $currency,
                    'quantity'  => $product['quantity'], 
                    'user_type' => $item->usertype->name,
                    'user_price' => $item->price. ' ' .$currency, 
                     ];
                    }
                    else
                    {
                            $currency = __('translations.egp');
                            $product_ = [
                            'name'      => $product['name'] , 
                            'unique_id' => $product['unique_id'],
                            //'discount'  => $product->discount, 
                            //'price'     => $product->pricing($product->id). ' ' .$currency, 
                           // 'price_after_discount' => $product->priceafterdiscount($product->id),
                            'currency'  => $currency,
                            'quantity'  => $product['quantity'], 
                            'user_type' => $item->usertype->name,
                            'user_price' => $item->price. ' ' .$currency, 
                             ];
                    }
            }
             array_push($client_products, $product_);
        }

        return response()->json([
            'products' => $client_products,
            'dest' => 'productsPhone',
            'code' => 200,
            'auth_id' => $seller->id,
        ]);
    }

    // get seller's store products
    public function getSellerProducts(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'api_token' => 'required',
        ]);

        $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'sellerproducts',
              'code' => 400,
              'auth_id' => $seller->id,
          ], 400);
        }

        
        if (!$seller) {
            return response()->json([
                'message' => __('translations.invalid_seller'),
                'dest' => 'sellerproducts',
                'code' => 404,
                'auth_id' => $seller->id,
            ], 404);
        }
        $store = Store::where('id', $seller->store_id)->first();
        if (!$store) {
            return response()->json([
                'message' => __('translations.invalid_seller_store'),
                'dest' => 'sellerproducts',
                'code' => 404,
                'auth_id' => $seller->id,
            ], 404);
        }
           // $products = $store->products;
        $stores = ProductStoreQuantity::where('store_id', $store->id)->get();
       // return response()->json([$stores]);
        $seller_products = [];

        foreach ($stores as $store) {
            //echo $store->quantity;
            if ($store->quantity > 0) 
            {
                array_push($seller_products, $store->product_id);
            }
          /*  $product = Product::where('id', $store->product_id)->first();
            if ($product->quantity > 0){
                array_push($seller_products, $product->id);
            }*/
        }
        $products = Product::whereIn('id', $seller_products)->get();
        foreach ($products as $product) 
        {
            $product['price'] = $product->priceafterdiscount($product->id); 
            $product['currency'] = 'جنيه'; 
        }
       
        $all_products = [];
        // $country = $products[0]['country_code'];

        return response()->json([
            'products' => $products,
            'dest' => 'sellerproducts',
            'code' => 200,
            'auth_id' => $seller->id,
        ]);
    }

    public function getProduct(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'code'      => 'required',
            'api_token' => 'required',
        ]);

      $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'getproduct_dest',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }

        if (!$seller) {
            return response()->json([
                'message' => __('translations.unauthorized_seller'),
                'dest' => 'getproduct_dest',
                'code' => 401,
                'auth_id' => $seller->id,
            ]);
        }
        $product = Product::where([
            'unique_id'=>$request->code, 
            'archive' => 0,
        ])->first();

        if (!$product) {
            return response()->json([
                'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                'dest' => 'getproduct_dest',
                'code' => 400,
                'auth_id' => $seller->id,
            ], 400);
        }

        $currency = __('translations.egp');
        $product_quantity = ProductStoreQuantity::where('product_id', $product->id)->sum('quantity');
        $product_ = [
                    'name' => $product['name'] , 
                    'unique_id' => $product['unique_id'], 
                    'price' => $product->pricing($product->id). ' ' .$currency, 
                    'discount'  => $product->discount, 
                    'price_after_discount' => $product->priceafterdiscount($product->id),
                    'currency' => $currency, 
                    'quantity' => $product_quantity,                   
                ];

            
            $product_store_quantities = [];
            // added 
            // if ($product_quantity > 0) 
            // {
                $stores = $product->stores;
                foreach ($stores as $key => $store) 
                {
                      $product_store_quantities [$key] =
                      ['product_id' => $store->product_id ,
                      'store_id' => $store->id ,
                      'store_name' => $store->name,
                      'quantity' => (int)$store->quantity_in_store($product->id)
                    ];
                }

                $product_['product_store_quantities'] = $product_store_quantities;
                return response()->json([
                    'product' => $product_,
                    'dest' => 'getproduct_dest',
                    'code' => 200,
                    'auth_id' => $seller->id,
                ]);
            // }
            // else
            // {
            //   $product_['product_store_quantities'] = __('translations.no_quantity_available_in_stores'); 
            //            return response()->json([
            //         'product' => $product_,
            //         'code' => 200,
            //     ]);  
            // }
    }
    public function putProduct(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'code'      => 'required',
            'api_token' => 'required',
        ]);

      $seller = Seller::select('id')->where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'putproduct_dest',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }

        if (!$seller) {
            return response()->json([
                'message' => __('translations.unauthorized_seller'),
                'dest' => 'putproduct_dest',
                'code' => 401,
                'auth_id' => $seller->id,
            ]);
        }
      
        $product = Product::select('id','name','unique_id', 'discount')->where([
            'unique_id'=>$request->code, 
            'archive' => 0,
        ])->first();
       
        if (!$product) {
            return response()->json([
                'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                'dest' => 'putproduct_dest',
                'code' => 400,
                'auth_id' => $seller->id,
            ], 400);
        }
        
            $currency = __('translations.egp');
        $product_ = [
                    'name' => $product['name'] , 
                    'unique_id' => $product['unique_id'], 
                    'price' => $product->pricing($product->id). ' ' .$currency, 
                    'discount'  => $product->discount, 
                    'price_after_discount' => $product->priceafterdiscount($product->id),
                    'currency' => $currency,                    
                ];

                return response()->json([
                    'product' => $product_,
                    'dest' => 'putproduct_dest',
                    'code' => 200,
                    'auth_id' => $seller->id,
                ]);     
    }

    public function checkout(Request $request)
    {
      $codes = $request['codes'];
      if(!is_array($codes)){
        $codes = json_decode($codes);
      }

      $seller = Seller::where([
            'api_token' => $request->api_token,
        ])->first();

      $validator = Validator::make($request->all(), [
            'codes' => 'required|min:1',
            'api_token' => 'required',
            'phone' => 'required|size:11|regex:/(01)[0-9]{9}/',
        ]);
        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'checkout',
              'code' => 400,
              'auth_id' => $seller->id,
          ], 400);
        }
            $country = 'EG';

        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
            return response()->json([
                'code' => 401,
                'dest' => 'checkout', 
                'auth_id' => $seller->id,
                'message' => __('translations.banned_seller')], 401);
            }
        }else {
            return response()->json([
                'code' => 401, 
                'dest' => 'checkout',
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }
        $usertype_id = 0 ;
        $user_idd = 0 ;

        if ($request->has('phone') && $request->phone  != '') {
            $phone_validator = Validator::make($request->all(), [
                 'phone'  => 'required|size:11|regex:/(01)[0-9]{9}/',
                ]);

            if ($phone_validator->fails()) 
                {
                    return response()->json([
                        'code'    => 400,
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'message' => $phone_validator->errors()->first(),
                    ], 400); 
                }
        }

        if ($request->has('phone') && $request->phone != '') {
            if(strstr($request->phone, '.'))
            {
               return response()->json([
                        'code'    => 400,
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'error'   => 
                        ['phone' => [ __('translations.phone_cant_contain_dots')]],
                    ], 400);
            }
        }


        if ($request->has('discount') && $request->discount > 0 && (!$request->has('phone') || $request->phone == '')) 
        {
            return response()->json([
                'message' => __('translations.add_phone_to_beable_to_discount'),
                'dest' => 'checkout',
                'auth_id' => $seller->id,
                'code' => 400
              ], 400);
        }
        else {

                $discount_validator = Validator::make($request->all(), [
                    'discount' => 'required|numeric',
                ]);
         
                if ($discount_validator->fails()) 
                {
                    return response()->json([
                        'code'    => 400,
                        'dest' => 'checkout',
                        'message' => $discount_validator->errors(),
                        'auth_id' => $seller->id,
                    ], 400); 
                }
                if ($request->discount > $seller->discount) {
                    return response()->json([
                        'code' => 400,
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'message' => __('translations.you_couldnot_add_more_than') . $seller->discount . __('translations.as_a_discount'),
                    ], 400);
                }                             
        }

        if ($request->has('phone') && $request->phone != '') 
        {
            $user = User::where('phone', $request->phone)->withTrashed()->first();
            if ($user) 
            {
                if ($user->deleted_at) 
                {
                    return response()->json([
                        'error' => 
                        ['phone' => [ __('translations.this_user_banned_from_purchasing')]],
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'code' => 404,
                    ], 404);
                }
                if ($user->suspend == 1) {
                    return response()->json([
                        'error' => 
                        ['phone' => [ __('translations.this_user_banned_from_purchasing')]],
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'code' => 404,
                    ], 404);
                }

                if (empty($user->usertype_id)) {
                    return response()->json([
                        'error' => 
                        ['phone' => [ __('translations.make_sure_about_number_checkout')]],
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'code' => 404,
                    ], 404);
                }
            }
            else
            {
                return response()->json([
                    'message' => __('translations.invalid_user_phone'),
                    'dest' => 'checkout',
                    'auth_id' => $seller->id,
                    'code' => 201,
                ], 201);
            }
            $user_idd    = $user->id ;
            $usertype_id = $user->usertype_id;  
        }
        
        $client_products = array();

         $codes = $request['codes'];
      if(!is_array($codes))
      {
        $codes = json_decode($codes);
      }


    //    $codes = array_count_values($codes);
        $checkout_amount = 0;
        $currency = '';
        $repeated = array();

        foreach ($codes as $product) 
        {
          $code     = $product['code'];
          $quantity = $product['quantity'];

          if ($quantity <= 0) 
          {
                   return response()->json([
                  'message' => __('translations.quantity_should_be_higher_than_zero'), 
                  'dest' => 'checkout',
                  'auth_id' => $seller->id,
                  'code'    => 400
                  ], 400);
          }
            
            if (in_array($code, $repeated)) {
                return response()->json([
                            'message' => __('translations.errror repeated code'),
                            'dest' => 'checkout',
                            'auth_id' => $seller->id,
                            'code' => 400,
                        ], 400);
            }
                $product = product::where(['unique_id'=>$code,'archive'=>'0'])->first();
                    if (!$product) {
                        return response()->json([
                            'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                            'dest' => 'checkout',
                            'auth_id' => $seller->id,
                            'code' => 400,
                        ], 400);
                    }
                    if ($usertype_id){
                        $price = explode(' ', $product->getSellerPriceType($quantity, $usertype_id));
                    }
                    else {
                        $price = explode(' ', $product->getSellerPriceType($quantity, 1));
                    }
             $checkout_amount += $price[0];
        }
        if ($request->has('discount') && $request->discount > 0) 
        {
            if ($checkout_amount < 250) 
            {
                return response()->json([
                        'code'    => 400,
                        'dest' => 'checkout',
                        'auth_id' => $seller->id,
                        'message' => __('translations.cant_add_discount_for_total_less_than_250'),
                    ], 400);
            } 
        }

        // create user purchase
        $purchase = new Purchase;
        $purchase->delivery_address = $seller->store->address;
        $purchase->billing_address = $seller->store->address;
        $purchase->receptor_mobile = '';
        $purchase->buyer_mobile = '';
        $purchase->receptor_name = $seller->name;
        $purchase->price = $checkout_amount;
        $purchase->bill_id = rand();
        $purchase->save();

        foreach ($codes as $index) 
        {
            $code     = $index['code'];
            $quantity = $index['quantity'];

                $product = product::where(['unique_id'=> $code,'archive'=>'0'])->first();
              
                    if (!$product) {
                        return response()->json([
                            'message' => __('translations.you_trying_to_get_wrong_inavalid_product'),
                            'dest' => 'checkout',
                            'auth_id' => $seller->id,
                            'code' => 400,
                        ], 400);
                    }
            
                    if ($usertype_id)
                    {
                        $price = explode(' ', $product->getSellerPriceType($quantity, $usertype_id));
                    }
                    else 
                    {
                        $price = explode(' ', $product->getSellerPriceType($quantity, 1));
                    }

                $new_order = Order::create([
                    'user_id' => $user_idd,                    
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'bill_id' => $purchase->bill_id,
                    'price' => $price[0],
                    'deleted_at' => Carbon::now(),
                    'purchase_id' => $purchase->id,
                    'store_id' => $seller->store_id,
                    'seller_id' => $seller->id,
                ]);

                $history = History::create([
                    'user_id' => $user_idd,
                    'product_id' => $product->id,
                    'purchase_id' => $purchase->id,
                    'price' => $price[0],
                    'order_status' => 'المعاملة تمت',
                    'quantity' => $quantity,
                    'bill_id' => $purchase->bill_id,
                    'order_id' => $new_order->id,
                    'store_id' => $seller->store_id,
                    'seller_id' => $seller->id,
                ]);
// added 
                $productmovment = ProductStoreQuantity::create([
                'product_id' =>  $product->id,
                'store_id'   => $seller->store_id,
                'quantity'   => -$quantity,
                'purchase_id' => $purchase->id,
                'reason' => __('translations.OnStorepurchase'),
                'type' => '-',
            ]);

              $product->status = 1;

            $product->save();
            //$checkout_amount += $price[0];
            $product['price'] = ($price[0] / $quantity). ' '. $price[1];
            $product['product_total'] = $price[0]. ' '. $price[1];
           // $product['seller_price'] = $price[0]. ' '. $price[1]; //$product->getSellerPrice($quantity);
            $product['seller_quantity'] = $quantity;
            $currency = $price[1];
            $product_ = [
                'name'             => $product['name'] , 
                'unique_id'        => $product['unique_id'],
                'price'            => $product['price'],
                'seller_quantity'  => $product['seller_quantity'], 
                'product_total'    => $product['product_total'],
                'status'           => $product['status'],
                'product_discount' => $product->discount > 0 ? $product->discount. ' %' : __('translations.no_product_discount'),
            ];

            array_push($client_products, $product_);

                if (isset($request->phone) && $request->phone != '')  
                {
                    $new_order->update([
                        'sellerdiscount' => $request->discount]);
                    $new_order->update([
                        'price' => $new_order->price - ($new_order->price * $new_order->sellerdiscount / 100)]);
                    $new_order->save();

                    $history->update([
                        'sellerdiscount' => $request->discount]);
                    $history->update([
                        'price' => $history->price - ($history->price * $history->sellerdiscount / 100)]);
                    $history->save();
                }
        }  // foreach

          if (isset($request->discount) && $request->discount != '') 
          {
            if (isset($request->phone) && $request->phone != '')  
            {
                $discount = ($request->discount / 100) * $checkout_amount;
                $checkout_amount = $checkout_amount - $discount;
            }
          }
            $purchase->update([
            'user_id' => $user_idd,
            'purchase_status'    => 'purchased',
            'price'              =>  $checkout_amount,
            'method'             => __('translations.cash_in_the_store'),
            'seller_id'          => $seller->id,
            'store_id'           => $seller->store_id, 
            'sellerdiscount'     => $request->discount,    
            ]);    
            $purchase->save();

        if (!empty($user))
        {
            $user->update([
                'points' => $user->points + doubleval($purchase->price),
            ]);
            $user->save();
            
            $purchase->update(['user_id' => $user->id]);
            $purchase->save();
        }
        $seller_discount = $request->discount;

        if (isset($request->discount) && $request->discount != '') 
        {
            if (!empty($user)){
                $user_name = $user->name;
                $user_phone = $user->phone;
            }
            else{
                 $user_name = __('translations.unregistered_client');
                 $user_phone = __('translations.unregistered_client');
            }
                $seller_discount = $request->discount;
        }

        if (!empty($user)){
                $user_name  = $user->name;
                $user_phone = $user->phone;
            }
            else{
                 $user_name = __('translations.unregistered_client');
                 $user_phone = __('translations.unregistered_client');
            }

        return response()->json([
            'code' => 200,
            'dest' => 'checkout',
            'auth_id' => $seller->id,
            'products' => $client_products,
            'bill_id' => $purchase->bill_id, 
            'seller_discount' => $seller_discount,
            'user_name' => $user_name,
            'user_phone' => $user_phone,
            'created_at' => $purchase->created_at,
            'total' => $checkout_amount . ' ' . $currency,
        ], 200);
    }

    // get history of the store
    public function history(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'per_page' => 'required',
        ]);

      $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();
        
        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'sellerhistory',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }

        if (!$seller) {
            return response()->json([
                'code' => 401,
                'dest' => 'sellerhistory',
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }

        // get history by dates OR not
        $per_page = $request->per_page;
        if (isset($request->date) && $request->date != '') {
          $validator = Validator::make($request->all(), [
                'date' => 'required|date_format:Y-m-d',
            ]);
            if ($validator->fails()) {
              return response()->json([
                  'message' => $validator->errors()->first(),
                  'dest' => 'sellerhistory',
                  'auth_id' => $seller->id,
                  'code' => 400,
              ], 400);
            }
            $date      = Carbon::parse($request->date)->toDateTimeString();
            $histories = History::where(['seller_id' => $seller->id])
                             -> where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                ->whereDate('created_at', '=', $date)
                ->paginate($per_page);

        } else {
            $date = Carbon::now();
            $histories = History::where(['seller_id' => $seller->id])
                             ->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                ->whereDate('created_at', '<=', $date)
                ->select('id', 'user_id', 'product_id', 'order_status', 'quantity', 'price', 'refunded', 'created_at', 'bill_id', 'purchase_id')
                ->paginate($per_page);
        }

        foreach ($histories as $history) {
                $currency = 'جنيه';
                $product = Product::where('id', $history->product_id)->first();
                if ($history->quantity == 0) 
                {
                   $item_price = 0;
                }
                else
                {  
                    $item_price = $history->price / $history->quantity;
                }

                $purchase    = Purchase::where('id', $history->purchase_id)->first(); 
                $price_after_discount = $purchase->price; 
                $total_price = $price_after_discount;


                $history['id'] = $history->id;
                $history['user_id'] = $history->user_id;
                $history['product_id'] = $history->product_id;
                $history['order_status'] = $history->order_status;
                $history['item_price'] = $item_price. ' '. $currency;
                $history['quantity'] = $history->quantity;
                $history['total_price'] = $total_price;
                $history['product_name'] = $product->name;
                $history['product_unique_id'] = $product->unique_id;
                $history['quantity'] = $history->quantity;
                // $history['product_category'] = $product->category->name;
                //$history['product_subcategory'] = $product->subcategory->name;
                $history['created_at'] = $history->created_at;
                $history['bill_id'] = $history->bill_id;
                //$history['seller_discount'] = $seller->discount;

        }

        return response()->json([
            'histories' => $histories,
            'dest' => 'sellerhistory',
            'auth_id' => $seller->id,
            'code' => 200,
        ]);

    }
        // refers to history invoice of bills 
    public function history2(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            //'per_page' => 'required',
        ]);

      $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'history_invoice',
              'code' => 400,
              'auth_id' => $seller->id,
          ], 400);
        }

        if (!$seller) {
            return response()->json([
                'code' => 401,
                'dest' => 'history_invoice', 
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }
            $histories = History::where(['seller_id' => $seller->id])->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
               // ->whereDate('created_at', '<=', $date)
                ->select('id', 'user_id', 'product_id', 'order_status', 'quantity', 'price', 'refunded', 'created_at', 'bill_id', 'purchase_id', 'sellerdiscount')
                 ->orderBy('created_at', 'desc')
                 ->get();
                 //->paginate($per_page);
      
        $arr = array();

        foreach ($histories as $history) {
            
                $currency = 'جنيه';
                $product = Product::where('id', $history->product_id)->first();
                if ($history->quantity == 0) 
                {
                   $item_price = 0;
                }
                else
                {  
                    $item_price = $history->price / $history->quantity;
                }

                $purchase    = Purchase::where('id', $history->purchase_id)->first(); 
                $price_after_discount = $purchase->price; 
                $total_price = $price_after_discount;

                if (in_array($history->bill_id, $arr)) 
                {
                    continue;
                }
                else
                {
                    array_push($arr, $history->bill_id);
                }
        }

       
           $ones = History::where(['seller_id' => $seller->id])->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                //->whereDate('created_at', '<=', $date)
                ->whereIn('bill_id', $arr)
                ->select('id', 'user_id', 'product_id', 'order_status', 'quantity', 'price', 'refunded', 'created_at', 'bill_id', 'purchase_id', 'sellerdiscount')
                ->orderBy('created_at', 'desc')
                ->get();
      
                foreach($ones as $one)
                {
                    $product          = Product::where('id', $one->product_id)->first();
                    $bill_total_price = Purchase::where('bill_id', $one->bill_id)->sum('price');
                    
                    $one['product_name']      = $product->name;
                    $one['product_unique_id'] = $product->unique_id;
                    $one['bill_total_price']  = $bill_total_price;
                }
        return response()->json([
            // 'histories' => $ones->groupBy('bill_id'),
            'histories' => $ones->groupBy('bill_id')->take(30),
            'dest' => 'history_invoice',
            'auth_id' => $seller->id,
            'code' => 200,
        ]);
    }

    public function scan_bill(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bill_id'      => 'required|numeric',
            'api_token'    => 'required',
        ]);

        $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) 
        {
             return response()->json([
                'message' => $validator->errors()->first(),
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'code' => 400,
            ], 400);
        }

        $bill_id  =  $request->bill_id;
        $purchase = Purchase::where('bill_id', $bill_id)->first();

        if (empty($purchase)) 
        {
            return response()->json([
                'message' => __('translations.make_sure_about_bill_id'),
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'code' => 404,
            ], 404);
        }

        //$bill_products = History::where('bill_id', $bill_id)->where('quantity', '!=', 0)->get();
        $quantity = History::where('bill_id', $bill_id)
                                ->sum('quantity');
        if ($quantity <= 0) 
        {
            return response()->json([
                'code' => 400, 
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'message' => __('translations.you_refunded_bill')], 400);
        }
       
            $bill_products = History::where('bill_id', $bill_id)
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->select( 'id', 'user_id','product_id', 'order_status', 'quantity', 'refunded', 'price', 'bill_id', 'sellerdiscount')
                                  ->get();

           
        $details = [];
        foreach($bill_products as $item)
        {
           // return $item;
            $product  = Product::where('id', $item->product_id)->first();
            $quantity = History::where('bill_id', $bill_id)
                               ->where('product_id', $item->product_id)
                               //->where('quantity', '>', 0)
                              // ->groupBy('product_id')
                               ->sum('quantity');

           $price = History::where('bill_id', $bill_id)
                               ->where('product_id', $item->product_id)
                               //->where('quantity', '>', 0)
                              // ->groupBy('product_id')
                               ->sum('price');
                
                $exist_quantity = $item->quantity - $item->refunded;
                if($exist_quantity <= 0)
                {
                    continue;    
                }
                else
                {
                    if (!empty($item->refunded)) {
                        $num = $item->quantity - $item->refunded;
                            $status = __('translations.partially_refunded');
                    }
                    else{
                        $status = $item->order_status;
                        if ($status == 'pending' || $status == 'in progress') 
                        {
                           $status = __('translations.bill_processed');
                        }
                        elseif($status == 'delivered') 
                        {
                            $status = __('translations.delivered');
                        }
                        else
                        {
                            $status = $item->order_status;
                        }
                    }
                   array_push($details,[
                    'id'                 => $item->id,
                    'user_id'            => $item->user_id,
                    'product_id'         => $item->product_id,
                    'product_name'       => $product->name,
                    'product_unique_id'  => $product->unique_id,
                    'order_status'       => $status,
                    'quantity'           => $quantity,
                    'price'              => $price,
                    'refunded'           => $item->refunded,
                    'bill_id'            => $item->bill_id,
                    ]);
                }
        }
        return response()->json([
            'bill_products' => $details,
            'dest' => 'scan_bill',
            'auth_id' => $seller->id,
            'code' => 200
        ], 200);
    
    }

     public function scan_bill2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bill_id'      => 'required|numeric',
            'api_token'    => 'required',
        ]);

        $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) 
        {
             return response()->json([
                'message' => $validator->errors()->first(),
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'code' => 400,
            ], 400);
        }

        $bill_id  =  $request->bill_id;
        $purchase = Purchase::where('bill_id', $bill_id)->first();

        if (empty($purchase)) 
        {
            return response()->json([
                'message' => __('translations.make_sure_about_bill_id'),
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'code' => 404,
            ], 404);
        }

        //$bill_products = History::where('bill_id', $bill_id)->where('quantity', '!=', 0)->get();
        $quantity = History::where('bill_id', $bill_id)
                            ->sum('quantity');

         $del_or_not = History::where('bill_id', $bill_id)
                              ->where('order_status' , '!=', 'in progress')
                              ->where('order_status' , '!=', 'pending')
                              ->where('order_status' , '!=', 'canceled')
                              ->count();
        // return $quantity;
        if ($quantity <= 0) 
        {
            return response()->json([
                'code' => 400, 
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'message' => __('translations.you_refunded_bill')], 400);
        }

        if ($del_or_not <= 0) 
        {
            return response()->json([
                'code' => 400, 
                'dest' => 'scan_bill',
                'auth_id' => $seller->id,
                'message' => __('translations.cant_refund_this_product')], 400);
        }
       
            $bill_products = History::where('bill_id', $bill_id)
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->select( 'id', 'user_id','product_id', 'order_status', 'quantity', 'refunded', 'price', 'bill_id', 'sellerdiscount')
                                  ->get();

           
        $details = [];
        $unique  = [];
        foreach($bill_products as $item)
        {
           // return $item;
          if (in_array($item->product_id, $unique)) {
            continue;
          }
          else{

              $product       = Product::where('id', $item->product_id)->first();
              $item_quantity = History::where('bill_id', $bill_id)
                                 ->where('product_id', $item->product_id)
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'canceled')
                                 //->where('quantity', '>', 0)
                                // ->groupBy('product_id')
                                 ->sum('quantity');

               $Rquantity = History::where('bill_id', $bill_id)
                                 ->where('product_id', $item->product_id)
                                 ->where('order_status' , '!=', 'in progress')
                                 ->where('order_status' , '!=', 'pending')
                                 ->where('order_status' , '!=', 'canceled')
                                 ->where('quantity', '<', 0)
                                 ->where('price', '<', 0)
                                 ->sum('quantity');

              $org_quantity = History::where('bill_id', $bill_id)
                                 ->where('product_id', $item->product_id)
                                 ->where('quantity', '>', 0)
                                 ->where('price', '>', 0)
                                 ->sum('quantity');

             $price = History::where('bill_id', $bill_id)
                                 ->where('product_id', $item->product_id)
                                 ->where('quantity', '>', 0)
                                // ->groupBy('product_id')
                                 ->sum('price');
                  
                  // $exist_quantity = $item->quantity - $item->refunded;
                  if($item_quantity <= 0)
                  {
                      continue;    
                  }
                  else
                  {
                      if ($Rquantity != 0) {
                          $num = $item_quantity;
                          $status = __('translations.partially_refunded');
                      }
                      else{
                         $num = $item_quantity;
                         $status = __('translations.delivered');
                      }
                  }
                     array_push($details,[
                      'id'                 => $item->id,
                      'user_id'            => $item->user_id,
                      'product_id'         => $item->product_id,
                      'product_name'       => $product->name,
                      'product_unique_id'  => $product->unique_id,
                      'order_status'       => $status,
                      'quantity'           => $item_quantity,
                      'piece_price'        => $price / ($org_quantity),
                      'price'              => ($price / ($org_quantity)) * $item_quantity,
                      'refunded'           => $Rquantity,
                      'bill_id'            => $item->bill_id,
                      ]);
                     array_push($unique, $item->product_id);
          }
        }
        return response()->json([
            'bill_products' => $details,
            'dest' => 'scan_bill',
            'auth_id' => $seller->id,
            'code' => 200
        ], 200);
    
    }

  public function refund2(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'api_token'    => 'required',
            'bill_id'      => 'required|numeric',
            'refunds'      => 'required|min:1'
        ]);

      $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'refundbill',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }

        if (!$seller) {
            return response()->json([
                'code' => 401,
                'dest' => 'refundbill', 
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }
        else
        {
            $store_id = $seller->store_id;
        }

        $purchase = Purchase::where('bill_id', $request->bill_id)->first();
        if (empty($purchase)) 
        {
            return response()->json([
                'message' => __('translations.make_sure_about_bill_id'),
                'dest' => 'refundbill',
                'auth_id' => $seller->id,
                'code' => 404,
            ], 404);
        }

        $histories_ids = array();

         foreach ($request->refunds as $refund) 
        {
                $unique_id   = $refund['unique_id'];
                $quantity    = $refund['quantity'];
 // return gettype($quantity);
                if ($quantity <= 0 || empty(intval($quantity))) {
                  return response()->json([
                        'message' => __('translations.quantity_should_be_higher_than_zero').' '. $unique_id, 
                        'dest' => 'refundbill',
                        'auth_id' => $seller->id,
                        'code' => 400,
                    ], 400);
                }

                $product = Product::where([
                        'unique_id' => $unique_id, 
                        'archive'   => 0,
                    ])->first();
           
                if (!$product) {
                    return response()->json([
                        'message' => __('translations.you_trying_to_get_wrong_inavalid_product').' '. $unique_id, 
                        'dest' => 'refundbill',
                        'auth_id' => $seller->id,
                        'code' => 400,
                    ], 400);
                }

             $item = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                            ->first();

             $item_quantity = History::where(['product_id' => $product->id, 'bill_id' => $request->bill_id])
                                  ->where('seller_id', '>', 0)
                                  ->where('store_id', '>', 0)
                                  // ->where('quantity', '>', 0)
                                  ->sum('quantity');

             $refundedQty = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                                  ->where('seller_id', '>', 0)
                                  ->where('store_id', '>', 0)
                                  ->where('quantity', '<', 0)
                                  ->sum('quantity');

             $PurchasedQty = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                                  ->where('seller_id', '>', 0)
                                  ->where('store_id', '>', 0)
                                  ->where('quantity', '>', 0)
                                  ->sum('quantity');

             $deliverdOrNot = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                            ->where('seller_id', '>', 0)
                            ->where('store_id', '>', 0)
                            ->where('order_status', '!=', 'pending')
                            ->where('order_status', '!=', 'in progress')
                            ->where('order_status', '!=', 'canceled')
                            ->count();
            if (!$item) 
            {
                return response()->json([
                    'message' => __('translations.billid_doesnot_contain_this_product'),
                    'dest' => 'refundbill',
                    'auth_id' => $seller->id,
                    'code' => 400,
                ], 400);
            }

              if ($item && $deliverdOrNot <= 0) 
            {
                return response()->json([
                    'message' => __('translations.cant_refund_this_product'),
                    'dest' => 'refundbill',
                    'auth_id' => $seller->id,
                    'code' => 404,
                ], 404);
            }

            if ($quantity > $item_quantity) 
            {
                if (($PurchasedQty + $refundedQty) == 0) {
                   return response()->json([
                'message' => __('translations.hole_refunded_product'),//. ' '.  $product->unique_id, 
                'dest' => 'refundbill',
                'auth_id' => $seller->id,
                'code'    => 400
                    ], 400);
                }
                    return response()->json([
                    'message' => __('translations.quantity_purchased_less_than_required_to_refund'), 
                    'dest' => 'refundbill',
                    'auth_id' => $seller->id,
                    'code'    => 400
                    ], 400);
            }
}
        foreach ($request->refunds as $refund) 
        {
                $unique_id   = $refund['unique_id'];
                $quantity    = $refund['quantity'];

                 $product = Product::where([
                        'unique_id' => $unique_id, 
                        // 'archive'   => 0,
                    ])->first();

             $item = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                            ->first();

             $deliverdOrNot = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])
                            ->where('seller_id', '>', 0)
                            ->where('store_id', '>', 0)
                            ->sum('quantity');
      

            $item_quantity = History::where(['product_id' => $product->id, 'bill_id' => $request->bill_id])
                                  ->where('seller_id', '>', 0)
                                  ->where('store_id', '>', 0)
                                  ->sum('quantity');

            if($quantity < $item_quantity) 
            {
                $new_item_movement = ProductStoreQuantity::create([
                'product_id' => $product->id,
                'store_id'   => $seller->store_id,
                'type'       => '+',
                'quantity'   => $quantity,
                'reason'     => __('translations.partially_refunded'),
              ]);
               
                    //$piece_price = explode(' ', $product->getSellerPriceType($quantity, $user->usertype_id)); 

                  $gotten = History::where(['product_id' => $product->id, 'bill_id' => $request->bill_id])
                                   ->where('seller_id', '>', 0)
                                   ->where('store_id', '>', 0)
                                   ->where('quantity', '>', 0)
                                   ->first();
                  
                  $bought_price = $gotten->price / $gotten->quantity;
            
                $newpurchase = new Purchase;
                $newpurchase->delivery_address = $seller->store->address;
                $newpurchase->billing_address = $seller->store->address;
                $newpurchase->receptor_mobile = '';
                $newpurchase->buyer_mobile = '';
                $newpurchase->receptor_name = $seller->name;
                $newpurchase->price   = 0;
                $newpurchase->store_id   = $seller->store_id;
                $newpurchase->seller_id  = $seller->id;
                $newpurchase->bill_id = $request->bill_id;
                $newpurchase->save();

                if (!empty($item->user_id)) 
                {
                    $user_id = $item->user_id;
                }
                else
                {
                    $user_id = 0;
                }               
/*
                $ordered_item = DB::table('orders')->where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->limit(1)->get();

                        $ordered_itemm = DB::table('orders')->where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->limit(1);
                        
                        if (empty($ordered_item[0]->refunded)) 
                        {
                            $already_refunded = 0;
                        }
                        else
                        {
                            $already_refunded = $ordered_item[0]->refunded;
                        }

                       $ordered_itemm->update([
                            'refunded'  => $already_refunded + $quantity,
                        ]);
                       //$ordered_itemm->save();

                       $refunded_item = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->first();
                        if (empty($refunded_item->refunded)) 
                        {
                            $exist_refunded = 0;
                        }
                        else
                        {
                            $exist_refunded = $refunded_item->refunded;
                        }

                        $refunded_item->update([
                            'refunded'     => $exist_refunded + $quantity,
                        ]);
                        //$refunded_item->save();
                        if (!empty($item->sellerdiscount)) 
                        {
                            $disc = $item->sellerdiscount;
                        }
                        else{
                            $disc = 0;
                        }*/
                        $new_order = Order::create([

                            'user_id' => $user_id,                    
                            'product_id' => $product->id,
                            'quantity' => -$quantity,
                            'bill_id' => $request->bill_id,
                            'refunded' => -$quantity,
                            // 'price'     => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'purchase_id' => $newpurchase->id,
                            'store_id' => $seller->store_id,
                            'seller_id' => $seller->id,
                            'deleted_at' => Carbon::now(),
                        ]);
                        $history = History::create([
                            'user_id' => $user_id,
                            'product_id' => $product->id,
                            'purchase_id' => $newpurchase->id,
                           // 'price' => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'order_status' => __('translations.partially_refunded'),
                            'refunded' => -$quantity,
                            'quantity' => -$quantity,
                            'bill_id' => $newpurchase->bill_id,
                            'order_id' => $new_order->id,
                            'store_id' => $seller->store_id,
                            'seller_id' => $seller->id,
                        ]);

                         array_push($histories_ids, $history->id);

                        $newpurchase->update([
                            // 'price' => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'purchase_status'    => __('translations.partially_refunded'),
                            'user_id'    => $user_id,
                            //'method'             => __('translations.cash_in_the_store'),
                        ]);
                       $newpurchase->save();
                    

                     if ($item->user_id != 0) 
                    {
                        $user = User::where('id', $item->user_id)->first();
                        $user->update([
                   // 'points' => $user->points - ($piece_price[0] -($piece_price[0] * $disc / 100)),
                    'points' => $user->points - ($bought_price * $quantity),
                        ]);
                        $user->save();
                    }
            }

            else 
            {
                $new_item_movement = ProductStoreQuantity::create([
                'product_id' => $product->id,
                'store_id'   => $seller->store_id,
                'type'       => '+',
                'quantity'   => $quantity,
                'reason'     => __('translations.hole_refunded'),
              ]);

                $gotten = History::where(['product_id' => $product->id, 'bill_id' => $request->bill_id])
                                  ->where('seller_id', '>', 0)
                                  ->where('store_id', '>', 0)
                                  ->where('quantity', '>', 0)
                                  ->where('quantity', '>', 0)->first();

                $bought_price = $gotten->price / $gotten->quantity;

                if (!empty($item->user_id)) 
                {
                    $user_id = $item->user_id;
                }
                else
                {
                    $user_id = 0;
                }

                $newpurchase = new Purchase;
                $newpurchase->delivery_address = $seller->store->address;
                $newpurchase->billing_address = $seller->store->address;
                $newpurchase->receptor_mobile = '';
                $newpurchase->buyer_mobile = '';
                $newpurchase->receptor_name = $seller->name;
                $newpurchase->price   = 0;
                $newpurchase->store_id   = $seller->store_id;
                $newpurchase->seller_id  = $seller->id;
                $newpurchase->bill_id = $request->bill_id;
                $newpurchase->save();
/*
                $ordered_item = DB::table('orders')->where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->limit(1)->get();

                        $ordered_itemm = DB::table('orders')->where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->limit(1);
                        
                        if (empty($ordered_item[0]->refunded)) 
                        {
                            $already_refunded = 0;
                        }
                        else
                        {
                            $already_refunded = $ordered_item[0]->refunded;
                        }

                       $ordered_itemm->update([
                            'refunded'  => $already_refunded + $quantity,
                        ]);
                       //$ordered_itemm->save();

                       $refunded_item = History::where(['bill_id' => $request->bill_id, 'product_id' => $product->id])->first();
                        if (empty($refunded_item->refunded)) 
                        {
                            $exist_refunded = 0;
                        }
                        else
                        {
                            $exist_refunded = $refunded_item->refunded;
                        }

                        $refunded_item->update([
                            'refunded'     => $exist_refunded + $quantity,
                        ]);
                       // $refunded_item->save();

                        if (!empty($item->sellerdiscount)) 
                        {
                            $disc = $item->sellerdiscount;
                        }
                        else{
                            $disc = 0;
                        }
*/
                        $new_order = Order::create([
                            'user_id' => $user_id,                    
                            'product_id' => $product->id,
                            'quantity' => -$quantity,
                            'bill_id' => $request->bill_id,
                            'refunded' => -$quantity,
                           // 'price'     => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'purchase_id' => $newpurchase->id,
                            'store_id' => $seller->store_id,
                            'seller_id' => $seller->id,
                            'deleted_at' => Carbon::now(),
                        ]);
                        $history = History::create([
                            'user_id' => $user_id,
                            'product_id' => $product->id,
                            'purchase_id' => $newpurchase->id,
                          //  'price' => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'order_status' => __('translations.hole_refunded'),
                            'refunded' => -$quantity,
                            'quantity' => -$quantity,
                            'bill_id' => $newpurchase->bill_id,
                            'order_id' => $new_order->id,
                            'store_id' => $seller->store_id,
                            'seller_id' => $seller->id,
                        ]);

                        array_push($histories_ids, $history->id);
                        $newpurchase->update([
                           // 'price' => -($piece_price[0] -($piece_price[0] * $disc / 100)),
                            'price'     => -$bought_price * $quantity,
                            'purchase_status'    => __('translations.hole_refunded'),
                            //'method'             => __('translations.cash_in_the_store'),
                            'user_id'    => $user_id,
                        ]);
                       $newpurchase->save();
                
            if ($item->user_id != 0) 
            {
                $user = User::where('id', $item->user_id)->first();
                $user->update([
                 // 'points' => $user->points - ($piece_price[0] -($piece_price[0] * $disc / 100)),
                  'points' => $user->points - ($bought_price * $quantity),
                ]);
                $user->save();
            }
        } // else 
    } //foreach

    return response()->json([
                'message'       => __('translations.the_item_has_been_refunded_succ'), 
                'bill_id'       => $request->bill_id,
                'refunded_at'   => $history->created_at, 
                'code'          => 200,
                'dest'          => 'refundbill',
                'auth_id'       => $seller->id,
                'histories_ids' => $histories_ids,
            ], 200);
  }

  public function store_last_7_days_history(Request $request)
  {
     $validator = Validator::make($request->all(), [
            'api_token'    => 'required',
            //'store_id'      => 'required|integer',
        ]);

      $seller = Seller::where(['api_token' => $request->api_token])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'store_last_7_days_history',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }
        if (!$seller) {
            return response()->json([
                'code' => 401, 
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller'),
            ], 401);
        }
        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
               return response()->json([
                                        'code' => 401, 
                                        'dest' => 'store_last_7_days_history',
                                        'auth_id' => $seller->id,
                                        'message' => __('translations.banned_seller')], 401);
             }
             else
            {
                $store_id = $seller->store_id;
            }
        }

        //$store_id   = $request->store_id;
        $from = Carbon::today()->subDays(7)->toDateString();
        $from = $from.' 00:00:00';
        $to   = Carbon::today()->toDateString();
        $to = $to.' 23:59:59';

        $days_solds = History::where('store_id', $store_id)->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $from)
                             ->where('created_at', '<=', $to)
                             ->orderBy('created_at', 'desc')
                             ->select('price', 'created_at')
                             //->groupBy('created_at');
                             //->sum('price');
                             ->get();
        //$ones = $days_solds->groupBy('product_id');
                             //return $days_solds;
        $arr   = array();
        $arr_2 = array();
       foreach($days_solds as $day)
       {
            $created_at = $day->created_at->toDateString();
            
            if (in_array($created_at, $arr)) {
                continue;
            }
            else{
                array_push($arr, $created_at);
            }
       }

       foreach ($arr as $value) 
       {
        $value_from = $value.' 00:00:00';
        $value_to = $value.' 23:59:59';

           $one = History::where('store_id', $store_id)->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $value_from)
                             ->where('created_at', '<=', $value_to)
                             ->sum('price');

            array_push($arr_2, [
                'day' => $value,
                'day_total_price' => $one . ' '. __('translations.egp'),
            ]);
       }

       return response()->json([
        'day_details' => $arr_2,
        'dest' => 'store_last_7_days_history',
        'code' => 200,
        'auth_id' => $seller->id,
       ], 200);    
  }

  public function store_last_7_days(Request $request)
  {
    $validator = Validator::make($request->all(), [
            'api_token'    => 'required',
        ]);

     $seller = Seller::where(['api_token' => $request->api_token])->first();

        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'store_last_7_days_total',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }
        if (!$seller) {
            return response()->json([
                'code' => 401, 
                'dest' => 'store_last_7_days_total',
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }
        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
               return response()->json([
                'code' => 401,
                'dest' => 'store_last_7_days_total', 
                'auth_id' => $seller->id,
                'message' => __('translations.banned_seller')], 401);
             }
             else
            {
                $store_id = $seller->store_id;
            }
        }
      //  $store_id   = $request->store_id;
        
        $day  = Carbon::now()->format( 'l' );
        //return $day;
        $week = [
            'Saturday'   => 1,
            'Sunday'     => 2,
            'Monday'     => 3,
            'Tuesday'    => 4,
            'Wednesday'  => 5,
            'Thursday'   => 6,
            'Friday'     => 7,
        ];
        if (array_key_exists($day, $week)) 
        {
            $tod = $week[$day];
        }
        //return $day;

        $from = Carbon::today()->subDays($tod-1)->toDateString();
        $to   = Carbon::today()->toDateString();
        
        $from = $from.' 00:00:00';
        $to = $to.' 23:59:59';

        $total_price_sold = History::where('store_id', $store_id)->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $from)
                             ->where('created_at', '<=', $to)
                             ->orderBy('created_at', 'DESC')
                             //->get();
                             ->sum('price');

        return response()->json([
            'total_price_sold' => $total_price_sold. ' '. __('translations.egp'),
            'dest' => 'store_last_7_days_total',
            'auth_id' => $seller->id,
            'code' => 200
        ], 200);
  }

  public function store_last_10_days(Request $request)
  {
    // return $request->api_token;
    $validator = Validator::make($request->all(), [
            'api_token'    => 'required',
        ]);

    $seller = Seller::where(['api_token' => $request->api_token])->first();
       
        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'dest' => 'last10_days',
              'code' => 400,
              'auth_id' => $seller->id,
          ]);
        }
        if (!$seller) {
            return response()->json([
                'code' => 401, 
                'dest' => 'last10_days',
                'auth_id' => $seller->id,
                'message' => __('translations.unauthorized_seller')], 401);
        }
        if ($seller) 
        {
            if ($seller->suspend == 1) 
            {
               return response()->json([
                'code' => 401, 
                'dest' => 'last10_days',
                'auth_id' => $seller->id,
                'message' => __('translations.banned_seller')], 401);
             }
             else
            {
                $store_id = $seller->store_id;
            }
        }

        $from = Carbon::today()->subDays(10)->toDateString();
        $from = $from.' 00:00:00';
        $to   = Carbon::today()->toDateString();
        $to   = $to.' 23:59:59';

        $ids       = array();
        $movements = ProductStoreQuantity::where('store_id', $store_id)
                             ->where('quantity', '!=', 0)
                             ->where('created_at', '>=', $from)
                             ->where('created_at', '<=', $to)
                             ->where('refund_id', null)
                             ->where('settle_id', null)
                             ->orderBy('created_at', 'desc')
                             ->get();

          foreach ($movements as $movement) {
           //  return $movement->status;
            if ($movement->status == 'a' || $movement->status == 'r' || $movement->reason == __('translations.purchase')) {
               array_push($ids, $movement->id);
            }
          }
        $days_solds = ProductStoreQuantity::whereIn('id', $ids)
                                          ->orderBy('created_at', 'desc')
                                          ->get(); 

        // return $days_solds;   

        if (count($days_solds) <= 0) {
            return response()->json([
                'code' => 200,
                'dest' => 'last10_days',
                'auth_id' => $seller->id,
                'message' => __('translations.no_products_added_or_removed_for_this_period')
            ], 400);
        }
        else
        {
                   foreach($days_solds as $day)
                   {
                      $product = Product::where('id', $day->product_id)->first();
                      $store   = Store::where('id', $day->store_id)->first();
                      $day['product_name']      = $product->name;
                      $day['product_unique_id'] = $product->unique_id;
                      $day['store_name']        = $store->name;
                   }
        }

       return response()->json([
        'details' => $days_solds,
        'dest' => 'last10_days',
        'auth_id' => $seller->id,
        'code'    => 200,
    ], 200);
  }


}


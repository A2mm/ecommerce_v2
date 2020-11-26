<?php

namespace App\Http\Controllers;

use App\Store;
use App\Vendor;
use App\Product;
use App\ProductStoreQuantity;
use App\Purchase;
use App\Seller;
use View ;
use App\History;
use App\User;
use PDF;
use Carbon\Carbon;
use App\Exports\StoresExport;
use App\Exports\StorePurchasesExport;
use App\Exports\StoreProductMovementsExport;
use App\Exports\StoreWeekExport;
use App\Exports\StoresPurchasesExport;
use App\Exports\StoresOrdersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Exports\StoreMovementsExport;
use App\Exports\ShowStoreExport;
use App\Exports\allStoresRefundsExport;
use App\Exports\allStoresSettlesExport;
use App\Exports\allStoresTransfersExport;
use App\Exports\allStoresShipedOrdersExport;
use App\Exports\eachStorePurchasesExport;

class OwnerStoreController extends Controller
{
    public function getShowAll()
    {
        $stores = Store::all();
        return view('owner_dashboard.stores.all', compact('stores'));
    }

    public function getCreate()
    {
        return view('owner_dashboard.stores.create');
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:55|unique:stores',
            'address' => 'required|max:255|min:10',
            'phone' => 'required|regex:/(01)/|size:11|unique:stores,phone',
        ]);

        $store = Store::create([
            'name' => $request['name'],
            'address' => $request['address'],
            'phone' => $request['phone'],

        ]);
        return redirect()->route('manage.store.all')->withMessage(__('translations.store_created_succ'));

    }

    public function ship_order($id)
    {
         $store  = Store::find($id);
         $stores = Store::get();
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $products   = Product::where('archive', 0)->get();
        $count_products = count($products);

        return view('owner_dashboard.stores.ship_order', compact('stores', 'count_products', 'store', 'products'));
    }

    public function post_ship_order(Request $request)
    {
     // return $request->product_id;
      $store_id     = $request->store_id;
      $shiporder_id = $request->shiporder_id;

      $this->validate($request, [
            'shiporder_id'             => 'required|unique:product_store_quantities,shiporder_id|digits_between:1,9',
            'store_quantities.*'  => 'required|min:1',
            'product_id'      => 'required',
        ]);

      /* if($request->product_id)
        {
            $repeated_products = array_count_values($request->product_id);
            foreach ($request->product_id as $key => $value)
            {
                if ($repeated_products[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this product before change quantity better');
                }
            }
        } */

        if($request->product_id)
        {
            foreach($request->product_id as $product)
            {
               if (empty($product))
                {
                    return redirect()->back()->withErrors(__('translations.product_can_not_be_empty'));
                }
            }
        }

       if($request->store_quantities)
        {
            foreach($request->store_quantities as $quantity)
            {
               if (empty($quantity))
                {
                    return redirect()->back()->withErrors(__('translations.quantity_can_not_be_empty'));
                }
                if (!is_numeric($quantity))
                {
                    return redirect()->back()->withErrors('quantity must be anumber');
                }
                if ($quantity <= 0)
                {
                    return redirect()->back()->withErrors('quantity can not be less than 1');
                }
            }
        }

      if (isset($request->product_id) && $request->product_id != '')
        {
            $products     = $request->product_id;
           $quantities  = $request->store_quantities;

          foreach ($products as $key => $loop_id)
          {

                    $product_store_quantity = ProductStoreQuantity::create([
                    'shiporder_id' => $shiporder_id,
                    'product_id' => $loop_id,
                    'store_id' => $store_id,
                    'quantity' => $quantities[$key],
                    'reason' => __('translations.add'),
                    'status' => 'a',
                    'type' => '+',
                   ]);
          }
      }

      // return redirect()->back()->withMessage(__('translations.shiporder_created_successfully'));
      return redirect()->route('manage.store.all')->withMessage(__('translations.shiporder_created_successfully'));
  }

  public function shiped_orders(Request $request)
  {
    if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
      $from = Carbon::today()->subDays(1)->toDateString();
      $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
   
    $items = ProductStoreQuantity::where('shiporder_id', '!=', 1)
                                 ->where('created_at', '>=', $date_from)
                                 ->where('created_at', '<=', $date_to)
                                 ->orderBy('created_at', 'desc')
                                 ->paginate(10);

    return view('owner_dashboard.stores.shiped_orders', compact('items', 'from', 'to'));
  }

  public function view_shipedorders_details($id)
  {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.orders.shiped')->withErrors(__('translations.shiporder_not_found'));
    }
    // $stores   = Store::select()->get();
    // $products = Product::select()->get();

    return view('owner_dashboard.stores.view_shipedorders_details', compact('order'));
  }

  public function view_refunds_details($id)
  {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
    }
    // $stores   = Store::select()->get();
    // $products = Product::select()->get();

    return view('owner_dashboard.stores.shiped.view_refunds_details', compact('order'));
  }

  /* public function edit_shipedorders_details_store(Request $request)
  {
     return view('owner_dashboard.stores.edit_shipedorders_details', compact('order', 'stores', 'products'));
    return $request->ship_id;
  } */

   public function edit_shipedorders_number($id)
   {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.orders.shiped')->withErrors(__('translations.shiporder_not_found'));
    }
    return view('owner_dashboard.stores.shiped.edit_number', compact('order'));
   }

   public function edit_shipedorders_number_save(Request $request)
   {
       // return $request->ship_id;
    $id     = $request->ship_id;
    $number = $request->shiporder_id;
    $order  = ProductStoreQuantity::find($id);
    $this->validate($request, [
            'shiporder_id'  => 'required|digits_between:1,9|unique:product_store_quantities,shiporder_id,'.$order->id,
          ]);
       // $order = ProductStoreQuantity::find($id);
       $order->update(['shiporder_id' => $number]);
       return redirect()->route('manage.orders.shiped')->withMessage(__('translations.shiporder_number_updated_successfully'));
   }

   public function edit_shipedorders_store($id)
   {
      $order = ProductStoreQuantity::find($id);
     
    if (!$order){
      return redirect()->route('manage.orders.shiped')->withErrors(__('translations.shiporder_not_found'));
    }
     $stores = Store::select('id', 'name')->get();
    return view('owner_dashboard.stores.shiped.edit_store', compact('order', 'stores'));
   }

   public function edit_shipedorders_store_save(Request $request)
   {
       $id           = $request->ship_id;
       $store_id     = $request->store_id;
       $order        = ProductStoreQuantity::find($id);
       $product_id   = $order->product_id; 
       $shiporder_id = $order->shiporder_id;
       $this->validate($request, [
            'store_id'  => 'required|exists:stores,id',
          ]);

       $order_exists        = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('shiporder_id', $shiporder_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        {
           $order->update(['store_id' => $store_id]);  
        }
      
       return redirect()->route('manage.orders.shiped')->withMessage(__('translations.shiporder_store_updated_successfully'));

   }

   public function edit_shipedorders_product($id)
   {
      $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.orders.shiped')->withErrors(__('translations.shiporder_not_found'));
    }
    $products = Product::where('archive', 0)->select('id', 'name')->get();
    return view('owner_dashboard.stores.shiped.edit_product', compact('order', 'products'));
   }

   public function edit_shipedorders_product_save(Request $request)
   {
       $id           = $request->ship_id;
       $product_id   = $request->product_id;
       $order        = ProductStoreQuantity::find($id);
       $store_id     = $order->store_id; 
       $shiporder_id = $order->shiporder_id;
       $this->validate($request, [
            'product_id'  => 'required|exists:products,id',
          ]);
        $order_exists        = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('shiporder_id', $shiporder_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        {
           $order->update(['product_id' => $product_id]);  
        }
      
       return redirect()->route('manage.orders.shiped')->withMessage(__('translations.shiporder_product_updated_successfully'));
   }

   public function edit_shipedorders_quantity($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.orders.shiped')->withErrors(__('translations.shiporder_not_found'));
      }
     return view('owner_dashboard.stores.shiped.edit_quantity', compact('order'));
   }

   public function edit_shipedorders_quantity_save(Request $request)
   {
       $id         = $request->ship_id;
       $quantity   = $request->quantity;
       $order      = ProductStoreQuantity::find($id);
       $order->update(['quantity' => $quantity]);
       return redirect()->route('manage.orders.shiped')->withMessage(__('translations.shiporder_quantity_updated_successfully'));
   }

// edit refunds details start 

   public function edit_refunds_number($id)
   {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
    }
    return view('owner_dashboard.stores.refunds.edit_number', compact('order'));
   }

   public function edit_refunds_number_save(Request $request)
   {
       // return $request->ship_id;
    $id     = $request->ship_id;
    $number = $request->refund_id;
    $order  = ProductStoreQuantity::find($id);
    $this->validate($request, [
            'refund_id'  => 'required|unique:product_store_quantities,refund_id,'.$order->id,
          ]);
       // $order = ProductStoreQuantity::find($id);
       $order->update(['refund_id' => $number]);
       return redirect()->route('manage.allstores.refunds')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_refunds_store($id)
   {
      $order = ProductStoreQuantity::find($id);
     
    if (!$order){
      return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
    }
    $stores = Store::select('id', 'name')->get();
    return view('owner_dashboard.stores.refunds.edit_store', compact('order', 'stores'));
   }

   public function edit_refunds_store_save(Request $request)
   {
       $id           = $request->ship_id;
       $store_id     = $request->store_id;
       $order        = ProductStoreQuantity::find($id);
       $product_id   = $order->product_id; 
       $refund_id    = $order->refund_id;
       $this->validate($request, [
            'store_id'  => 'required|exists:stores,id',
          ]);

      /* $order_exists  = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('refund_id', $refund_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        { */
           $order->update(['store_id' => $store_id]);  
      //  }
      
       return redirect()->route('manage.allstores.refunds')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_refunds_product($id)
   {
      $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
    }
   // $products = Product::where('archive', 0)->select('id', 'name')->get();

    $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
           $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('refund_id', $order->refund_id)->get();
                                        // return $existtransfered;
            if (count($existtransfered) <= 0) 
            {    
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.refunds.edit_product', compact('order', 'products', 'count_products'));
   }

   public function edit_refunds_product_save(Request $request)
   {
       $id           = $request->ship_id;
       $product_id   = $request->product_id;
       $order        = ProductStoreQuantity::find($id);
       $store_id     = $order->store_id; 
       $quantity     = abs($order->quantity); 
       $refund_id    = $order->refund_id;
       $this->validate($request, [
            'product_id'  => 'required|exists:products,id',
          ]);

         $foundqty   = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                return redirect()->back()->withErrors('لا يمكن ارجاع اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
    
      /*  $order_exists        = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('refund_id', $refund_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        { */
           $order->update(['product_id' => $product_id]);  
      //  }
      
       return redirect()->route('manage.allstores.refunds')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_refunds_quantity($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
      }
     return view('owner_dashboard.stores.refunds.edit_quantity', compact('order'));
   }

   public function edit_refunds_quantity_save(Request $request)
   {
       $id         = $request->ship_id;
       $quantity   = $request->quantity;
       $order      = ProductStoreQuantity::find($id);
       $product_id = $order->product_id;
       $store_id   = $order->store_id;
       $foundqty   = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن ارجاع اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
              else
              {
                $order->update(['quantity' => -$quantity]);
                return redirect()->route('manage.allstores.refunds')->withMessage(__('translations.it_updated_successfully'));
              }
   }
// edit refunds details end

   // edit transfers details start 

   public function view_transfers_details($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.allstores.transfers')->withErrors(__('translations.shiporder_not_found'));
      }
      return view('owner_dashboard.stores.shiped.view_transfers_details', compact('order'));
   }
   public function edit_transfers_number($id)
   {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.transfers')->withErrors(__('translations.shiporder_not_found'));
    }
    return view('owner_dashboard.stores.transfers.edit_number', compact('order'));
   }

   public function edit_transfers_number_save(Request $request)
   {
       // return $request->ship_id;
    $id     = $request->ship_id;
    $number = $request->transfer_id;
    $order  = ProductStoreQuantity::find($id);
    $product_id  = $order->product_id;
    $store_id    = $order->store_id;
    $to_store    = $order->to_store;
    $from_store  = $order->from_store;
    $transfer_id = $order->transfer_id;
    $this->validate($request, [
            'transfer_id'  => 'required|integer|unique:product_store_quantities,transfer_id,'.$order->id,
          ]);

    $converts   = ProductStoreQuantity::where([
                               'product_id'   => $product_id,
                               'to_store'     => $to_store,
                               'from_store'   => $from_store,
                               'transfer_id'  => $transfer_id,
                                ])->get();
                 foreach ($converts as $convert) {
                   $convert->update(['transfer_id' => $number]);
                 }
       // $order->update(['transfer_id' => $number]);
       return redirect()->route('manage.allstores.transfers')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_transfers_store($id)
   {
      $order = ProductStoreQuantity::find($id);
     
    if (!$order){
      return redirect()->route('manage.allstores.transfers')->withErrors(__('translations.shiporder_not_found'));
    }
    $stores = Store::select('id', 'name')->get();
    return view('owner_dashboard.stores.transfers.edit_store', compact('order', 'stores'));
   }

   public function edit_transfers_store_save(Request $request)
   {
       $id           = $request->ship_id;
       $new_to_store = $request->store_id;
       $order        = ProductStoreQuantity::find($id);
       $product_id   = $order->product_id; 
       $transfer_id  = $order->transfer_id;
       $to_store     = $order->to_store;
       $from_store   = $order->from_store;

       $this->validate($request, [
            'store_id'  => 'required|exists:stores,id',
          ]);

       $order_exists        = ProductStoreQuantity::where('id', '!=', $id)->where('product_id', $product_id)
                                            ->where('to_store', $new_to_store)
                                            ->where('transfer_id', $transfer_id)
                                            ->first();
      /*  if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        {*/
           // $order->update(['to_store' => $to_store]);  

           $one =  ProductStoreQuantity::where([
                               'product_id'   => $product_id,
                               'to_store'     => $to_store,
                               'from_store'   => $from_store,
                               'transfer_id'  => $transfer_id,
          ])->where('quantity', '>', 0);
          $one->update(['store_id' => $new_to_store]);

            $converts   = ProductStoreQuantity::where([
                               'product_id'   => $product_id,
                               'to_store'     => $to_store,
                               'from_store'   => $from_store,
                               'transfer_id'  => $transfer_id,
                                ])->get();
                 foreach ($converts as $convert) 
                 {
                   $convert->update(['to_store' => $new_to_store]);
                 }

        // }
      
       return redirect()->route('manage.allstores.transfers')->withMessage(__('translations.it_updated_successfully'));

   }

   public function edit_transfers_product($id)
   {
      $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.transfers')->withErrors(__('translations.shiporder_not_found'));
    }
    // $products = Product::where('archive', 0)->select('id', 'name')->get();

    $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                        //->where('transfer_id', null)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
             $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('transfer_id', $order->transfer_id)->get();
            // return count($existtransfered);
            if (count($existtransfered) <= 0) 
            {    
              // return 'ooo';
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.transfers.edit_product', compact('order', 'products', 'count_products'));
   }

   public function edit_transfers_product_save(Request $request)
   {
      // return 'ooooo';
       $id           = $request->ship_id;
       $product_id   = $request->product_id;
       $order        = ProductStoreQuantity::find($id);
       $store_id     = $order->store_id; 
       $old_product_id = $order->product_id; 
       $to_store     = $order->to_store;
       $quantity     = abs($order->quantity); 
       $from_store   = $order->from_store;
       $transfer_id  = $order->transfer_id;

       $this->validate($request, [
            'product_id'  => 'required|exists:products,id',
          ]);
        $order_exists        = ProductStoreQuantity::where('product_id', $old_product_id)
                                            ->where('store_id', $store_id)
                                            ->where('transfer_id', $transfer_id)
                                            ->first();
       /* if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else 
        { */

          // $quantity     = abs($order->quantity); 
          $foundqty   = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                return redirect()->back()->withErrors('لا يمكن  تحويل   اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           // $order->update(['product_id' => $product_id]);  
           $converts   = ProductStoreQuantity::where([
                               'product_id'   => $old_product_id,
                               'to_store'     => $to_store,
                               'from_store'   => $from_store,
                               'transfer_id'  => $transfer_id,
                                ])->get();
                 foreach ($converts as $convert) 
                 {
                   $convert->update(['product_id' => $product_id]);
                 }
      
       return redirect()->route('manage.allstores.transfers')->withMessage(__('translations.it_updated_successfully'));
    //  }
   }

   public function edit_transfers_quantity($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.allstores.transfers')->withErrors(__('translations.shiporder_not_found'));
      }
     return view('owner_dashboard.stores.transfers.edit_quantity', compact('order'));
   }

   public function edit_transfers_quantity_save(Request $request)
   {
       $id          = $request->ship_id;
       $quantity    = $request->quantity;
       // return $quantity;
       $order       = ProductStoreQuantity::find($id);
       $product_id  = $order->product_id;
       $store_id    = $order->store_id;
       $to_store    = $order->to_store;
       $from_store  = $order->from_store;
       $transfer_id = $order->transfer_id;
       $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن  تحويل  اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
              else
              {
                $order->update(['quantity' => -$quantity]);

                 $converts   = ProductStoreQuantity::where('id', '!=', $id)->where([
                               'product_id'   => $product_id,
                               'to_store'     => $to_store,
                               'from_store'   => $from_store,
                               'transfer_id'  => $transfer_id,
                                ])->get();
                 foreach ($converts as $convert) {
                   $convert->update(['quantity' => $quantity]);
                 }
                return redirect()->route('manage.allstores.transfers')->withMessage(__('translations.it_updated_successfully'));
              }
   }
// edit transfers details end

   // edit settles details start 

   public function view_settles_details($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
      }
      return view('owner_dashboard.stores.shiped.view_settles_details', compact('order'));
   }
   public function edit_settles_number($id)
   {
    $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
    }
    return view('owner_dashboard.stores.settles.edit_number', compact('order'));
   }

   public function edit_settles_number_save(Request $request)
   {
       // return $request->ship_id;
    $id     = $request->ship_id;
    $number = $request->settle_id;
    $order  = ProductStoreQuantity::find($id);
    $this->validate($request, [
            'settle_id'  => 'required|unique:product_store_quantities,settle_id,'.$order->id,
          ]);
       // $order = ProductStoreQuantity::find($id);
       $order->update(['settle_id' => $number]);
       return redirect()->route('manage.allstores.settlements')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_settles_store($id)
   {
      $order = ProductStoreQuantity::find($id);
     
    if (!$order){
      return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
    }
    $stores = Store::select('id', 'name')->get();
    return view('owner_dashboard.stores.settles.edit_store', compact('order', 'stores'));
   }

   public function edit_settles_store_save(Request $request)
   {
       $id           = $request->ship_id;
       $store_id     = $request->store_id;
       $order        = ProductStoreQuantity::find($id);
       $product_id   = $order->product_id; 
       $settle_id    = $order->settle_id;
       $this->validate($request, [
            'store_id'  => 'required|exists:stores,id',
          ]);

      /* $order_exists        = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('settle_id', $settle_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        { */
           $order->update(['store_id' => $store_id]);  
       // }
      
       return redirect()->route('manage.allstores.settlements')->withMessage(__('translations.it_updated_successfully'));

   }

   public function edit_settles_product($id)
   {
      $order = ProductStoreQuantity::find($id);

    if (!$order){
      return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
    }
    // $products = Product::where('archive', 0)->select('id', 'name')->get();
      $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
           $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('settle_id', $order->settle_id)->get();
            if (count($existtransfered) <= 0) 
            {    
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.settles.edit_product', compact('order', 'products', 'count_products'));
   }

   public function edit_settles_product_save(Request $request)
   {
       $id           = $request->ship_id;
       $product_id   = $request->product_id;
       $order        = ProductStoreQuantity::find($id);
       $store_id     = $order->store_id; 
       $quantity     = abs($order->quantity); 
       $settle_id    = $order->settle_id;
       $this->validate($request, [
            'product_id'  => 'required|exists:products,id',
          ]);
      
      /*  $order_exists        = ProductStoreQuantity::where('product_id', $product_id)
                                            ->where('store_id', $store_id)
                                            ->where('settle_id', $settle_id)
                                            ->first();
        if (!empty($order_exists)) 
        {
            $order_exists->update(['quantity' => $order_exists->quantity + $order->quantity]);  
            $order->delete();
        }
        else
        { */

          // $quantity     = abs($order->quantity); 
          $foundqty   = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                return redirect()->back()->withErrors('لا يمكن  تسوية   اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           $order->update(['product_id' => $product_id]);  
      //  }
      
       return redirect()->route('manage.allstores.settlements')->withMessage(__('translations.it_updated_successfully'));
   }

   public function edit_settles_quantity($id)
   {
      $order = ProductStoreQuantity::find($id);
      if (!$order){
        return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
      }
     return view('owner_dashboard.stores.settles.edit_quantity', compact('order'));
   }

   public function edit_settles_quantity_save(Request $request)
   {
       $id         = $request->ship_id;
       $quantity   = $request->quantity;
       // return $quantity;
       $order      = ProductStoreQuantity::find($id);
       $product_id = $order->product_id;
       $store_id   = $order->store_id;
       $foundqty   = ProductStoreQuantity::where([
                               'product_id' => $product_id,
                               'store_id'   => $store_id,
                                ])->where('id', '!=', $id)->sum('quantity');

              if ($quantity > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $product_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن  تسوية   اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
              else
              {
                $order->update(['quantity' => -$quantity]);
                return redirect()->route('manage.allstores.settlements')->withMessage(__('translations.it_updated_successfully'));
              }
   }
// edit settles details end

   public function ship_known_order($id)
   {
      $order          = ProductStoreQuantity::find($id);
      $order_products = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('shiporder_id', $order->shiporder_id)
                                            ->pluck('product_id');
      $products       = Product::whereNotIn('id', $order_products)->where('archive', 0)->get();
      $count_products = count($products);
      $stores         = Store::get();
      return view('owner_dashboard.stores.shiped.ship_known_order', compact('order', 'stores', 'products', 'count_products'));
   }

   public function ship_known_order_save(Request $request)
   {
      $id    = $request->ship_id;
      $order = ProductStoreQuantity::find($id);

      $this->validate($request, [
          //  'shiporder_id'             => 'required|unique:product_store_quantities,shiporder_id,'.$order->id,
            'store_quantities.*'  => 'required|min:1',
            'product_id'      => 'required',
        ]);

      /* if($request->product_id)
        {
            $repeated_products = array_count_values($request->product_id);
            foreach ($request->product_id as $key => $value)
            {
                if ($repeated_products[$value] > 1)
                {
                    return redirect()->back()->withErrors('you selected this product before change quantity better');
                }
            }
        } */

         $store_id     = $request->store_id;
         $shiporder_id = $request->shiporder_id;

        if($request->product_id)
        {
            foreach($request->product_id as $product)
            {
               if (empty($product))
                {
                    return redirect()->back()->withErrors(__('translations.product_can_not_be_empty'));
                }
            }
        }

       if($request->store_quantities)
        {
            foreach($request->store_quantities as $quantity)
            {
               if (empty($quantity))
                {
                    return redirect()->back()->withErrors(__('translations.quantity_can_not_be_empty'));
                }
                if (!is_numeric($quantity))
                {
                    return redirect()->back()->withErrors('quantity must be anumber');
                }
                if ($quantity <= 0)
                {
                    return redirect()->back()->withErrors('quantity can not be less than 1');
                }
            }
        }

      if (isset($request->product_id) && $request->product_id != '')
      {
            $products     = $request->product_id;
            $quantities   = $request->store_quantities;

          foreach ($products as $key => $loop_id)
          {

                    $product_store_quantity = ProductStoreQuantity::create([
                    'shiporder_id' => $shiporder_id,
                    'product_id'   => $loop_id,
                    'store_id'     => $store_id,
                    'quantity'     => $quantities[$key],
                    'reason'       => __('translations.add'),
                    'status'       => 'a',
                    'type'         => '+',
                   ]);
          }
      }

    return redirect()->back()->withMessage(__('translations.shiporder_created_successfully'));

   }

   public function transfer_order2($id)
   {
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $stores       = Store::where('id', '!=', $this_store->id)->get();
        $products_ids = ProductStoreQuantity::where('store_id', $this_store->id)
                                        // ->where('shiporder_id', '!=', 1)
                                        ->where('shiporder_id', '!=', null)
                                        ->pluck('product_id');
        $products  = Product::whereIn('id', $products_ids)->where('archive', 0)->select('id', 'name')->get();
        $count_products = count($products);
        return view('owner_dashboard.stores.shiped.transfer_rorder', compact('count_products', 'this_store', 'stores', 'products'));
   }

   public function transfer_order_save2(Request $request)
   {
        $id = $request->id;
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        $this->validate($request, [
          'from_store' => 'required|integer|exists:stores,id',
          // 'to_store'   => 'required|integer|unique:transfers,id',
          'transfer_id' => 'required|integer|unique:product_store_quantities,transfer_id',
          'to_store'   => 'required|integer|exists:stores,id',
        ]);

         if(isset($request->activations) && $request->activations != '')
         {
            $quantities = $request->quantity;
            foreach ($request->activations as $key => $activation) 
            {
             // echo $key .' is '.$activation.'<br>';
            //  echo $quantities[$activation].'<br>';
              $from_store = ProductStoreQuantity::create([
                'product_id'  => $activation, 
                'store_id'    => $request->id, 
                'quantity'    => -$quantities[$activation], 
                'reason'      => __('translations.transfer'), 
                'type'        => '-', 
                'status'      => 'r', 
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->id, 
              ]);

              $to_store = ProductStoreQuantity::create([
                'product_id'  => $activation, 
                'store_id'    => $request->to_store, 
                'quantity'    => $quantities[$activation], 
                'reason'      => __('translations.transfer'), 
                'type'        => '+', 
                'status'      => 'a', 
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->id, 
              ]);
           }
        }

      return redirect()->back()->withMessage(__('translations.transfer_created_successfully'));
   }

   public function transfer_order($id)
   {
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $stores       = Store::where('id', '!=', $this_store->id)->select('id', 'name')->get();

        $products_ids = ProductStoreQuantity::where('store_id', $this_store->id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
          $sumqty = ProductStoreQuantity::where('store_id', $this_store->id)
                                        ->where('product_id', $productid->product_id)
                                        ->sum('quantity');
           if ($sumqty > 0) 
           {
              array_push($selected, $productid->product_id);
           }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);
        return view('owner_dashboard.stores.shiped.transfer_rorder', compact('count_products', 'this_store', 'products', 'stores'));
   }

   public function transfer_order_save(Request $request)
   {
        $id = $request->id;
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        $this->validate($request, [
            'store_quantities.*'  => 'required|min:1',
            'from_store'        => 'required|integer|exists:stores,id',
            'to_store'          => 'required|integer|exists:stores,id',
            'product_id'        => 'required',
            'transfer_id'       => 'required|integer|unique:product_store_quantities,transfer_id',
        ]);

    if (isset($request->product_id) && $request->product_id != '')
    {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن تحويل  اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
            $from_store = ProductStoreQuantity::create([
                'product_id'  => $loop_id, 
                'store_id'    => $request->id, 
                'quantity'    => -$quantities[$key],
                'reason'      => __('translations.transfer'), 
                'type'        => '-', 
                'status' => 'r',
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->id, 
              ]);

            $to_store = ProductStoreQuantity::create([
                'product_id'  => $loop_id, 
                'store_id'    => $request->to_store, 
                'quantity'    => $quantities[$key],
                'reason'      => __('translations.transfer'), 
                'type'        => '+', 
                'status' => 'a',
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->id, 
              ]);
          }
      }

      return redirect()->route('manage.store.all')->withMessage(__('translations.transfer_created_successfully'));
      //return redirect()->back()->withMessage(__('translations.transfer_created_successfully'));
   }

   public function allstores_refunds(Request $request)
   {
    if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
      $from = Carbon::today()->subDays(1)->toDateString();
      $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
     $storesRefunds = ProductStoreQuantity::where('refund_id', '!=', null)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->orderBy('created_at', 'DESC')
                                          ->paginate(10);

     return view('owner_dashboard.stores.shiped.allstores_refunds', compact('storesRefunds', 'from', 'to'));
   }

   public function allstores_transfers(Request $request)
   {
    if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
       $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
     $storesTransfers = ProductStoreQuantity::where('transfer_id', '!=', null)
                                            ->where('created_at', '>=', $date_from)
                                            ->where('created_at', '<=', $date_to)
                                            ->where('quantity', '<', 0)
                                            ->orderBy('created_at', 'DESC')
                                            ->paginate(10);
     return view('owner_dashboard.stores.shiped.allstores_transfers', compact('storesTransfers', 'from', 'to'));
   }

   public function allstores_settlements(Request $request)
   {
    if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
       $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
     $storesSettlements = ProductStoreQuantity::where('settle_id', '!=', null)
                                              ->where('created_at', '>=', $date_from)
                                              ->where('created_at', '<=', $date_to)
                                              ->orderBy('created_at', 'DESC')
                                              ->paginate(10);
     return view('owner_dashboard.stores.shiped.allstores_settlements', compact('storesSettlements', 'from', 'to'));
   }

   public function refund_stock($id)
   {
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
    //    $stores       = Store::where('id', '!=', $this_store->id)->get();
        $products_ids = ProductStoreQuantity::where('store_id', $this_store->id)
                                        // ->where('shiporder_id', '!=', 1)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
          $sumqty = ProductStoreQuantity::where('store_id', $this_store->id)
                                        ->where('product_id', $productid->product_id)
                                       // ->where('shiporder_id', '!=', null)
                                        ->sum('quantity');
           if ($sumqty > 0) 
           {
              array_push($selected, $productid->product_id);
           }
           /*else
           {
            continue;
           }*/
        }

    //  $stores = Store::get();
      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);
      return view('owner_dashboard.stores.shiped.refund_stock', compact('this_store', 'products', 'count_products'));
   }

   public function refund_stock_save(Request $request)
   {
      $store_id     = $request->store_id;
      // $shiporder_id = $request->shiporder_id;

      $this->validate($request, [
           // 'shiporder_id'      => 'required|unique:product_store_quantities',
            'store_quantities.*'  => 'required|min:1',
            'product_id'        => 'required',
            'refund_id'         => 'required|integer|unique:product_store_quantities,refund_id',
        ]);

    if (isset($request->product_id) && $request->product_id != '')
        {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $store_id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن ارجاع اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
                    $product_store_quantity = ProductStoreQuantity::create([
                    'product_id'   => $loop_id,
                    'store_id'     => $store_id,
                    'quantity'     => -$quantities[$key],
                    'reason'       => __('translations.refundedorder'),
                    'status'       => 'r',
                    'type'         => '-',
                    'refund_id'    => $request->refund_id, 
                   ]);
          }
      }

      return redirect()->route('manage.store.all')->withMessage(__('translations.refunded_created_successfully'));
      //return redirect()->back()->withMessage(__('translations.refunded_created_successfully'));
   }
   
   // addnewrefund
   public function stock_add_refund($id)
   {
       $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.refunds')->withErrors(__('translations.shiporder_not_found'));
    }

       $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
           $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('refund_id', $order->refund_id)->get();
            if (count($existtransfered) <= 0) 
            {    
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.refunds.stock_add_refund', compact('order', 'products', 'count_products'));
  
   }

   public function stock_add_refund_save(Request $request)
   {
       $this->validate($request, [
           // 'shiporder_id'      => 'required|unique:product_store_quantities',
            'store_quantities.*'  => 'required|min:1',
            'product_id'        => 'required',
          //  'refund_id'         => 'required|integer|unique:product_store_quantities.*,refund_id',
        ]);

      $store_id  = $request->store_id; 
      $refund_id = $request->refund_id; 
      $id        = $request->ship_id; 

    if (isset($request->product_id) && $request->product_id != '')
        {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $store_id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن ارجاع اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
                    $product_store_quantity = ProductStoreQuantity::create([
                    'product_id'   => $loop_id,
                    'store_id'     => $store_id,
                    'quantity'     => -$quantities[$key],
                    'reason'       => __('translations.refundedorder'),
                    'status'       => 'r',
                    'type'         => '-',
                    'refund_id'    => $refund_id, 
                   ]);
          }
      }

      return redirect()->back()->withMessage(__('translations.refunded_created_successfully'));
   }

   // addnewtransfer
   public function stock_add_transfer($id)
   {
       $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
    }

       $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
           $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('transfer_id', $order->transfer_id)->get();
            if (count($existtransfered) <= 0) 
            {    
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.transfers.stock_add_transfer', compact('order', 'products', 'count_products'));
  
   }

   public function stock_add_transfer_save(Request $request)
   {
       $this->validate($request, [
            'store_quantities.*'  => 'required|min:1',
            'product_id'        => 'required',
        ]);

      $store_id    = $request->store_id; 
      $transfer_id = $request->transfer_id; 
      $to_store    = $request->to_store; 
      $from_store  = $request->from_store; 
      $id          = $request->ship_id; 
   
    if (isset($request->product_id) && $request->product_id != '')
    {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $store_id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن  تحويل  اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
            $from_store = ProductStoreQuantity::create([
                'product_id'  => $loop_id, 
                'store_id'    => $request->store_id, 
                'quantity'    => -$quantities[$key],
                'reason'      => __('translations.transfer'), 
                'type'        => '-', 
                'status'      => 'r',
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->from_store, 
              ]);

            $to_store = ProductStoreQuantity::create([
                'product_id'  => $loop_id, 
                'store_id'    => $request->to_store, 
                'quantity'    => $quantities[$key],
                'reason'      => __('translations.transfer'), 
                'type'        => '+', 
                'status'      => 'a',
                'transfer_id' => $request->transfer_id, 
                'to_store'    => $request->to_store, 
                'from_store'  => $request->from_store, 
              ]);
          }
      }

      return redirect()->back()->withMessage(__('translations.transfer_created_successfully'));
   }

   // addnewsettle
   public function stock_add_settle($id)
   {
       $order = ProductStoreQuantity::find($id);
    if (!$order){
      return redirect()->route('manage.allstores.settlements')->withErrors(__('translations.shiporder_not_found'));
    }

       $products_ids = ProductStoreQuantity::where('store_id', $order->store_id)
                                       ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
           $existtransfered = ProductStoreQuantity::where('store_id', $order->store_id)
                                         ->where('product_id', $productid->product_id)
                                         ->where('settle_id', $order->settle_id)->get();
            if (count($existtransfered) <= 0) 
            {    
              $sumqty = ProductStoreQuantity::where('store_id', $order->store_id)
                                            ->where('product_id', $productid->product_id)
                                            ->sum('quantity');
               if ($sumqty > 0) 
               {
                  array_push($selected, $productid->product_id);
               }
            }
        }

      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);

    return view('owner_dashboard.stores.settles.stock_add_settle', compact('order', 'products', 'count_products'));
  
   }

   public function stock_add_settle_save(Request $request)
   {
       $this->validate($request, [
           // 'shiporder_id'      => 'required|unique:product_store_quantities',
            'store_quantities.*'  => 'required|min:1',
            'product_id'        => 'required',
            'reason'            => 'required|string|max:50',
          //  'refund_id'         => 'required|integer|unique:product_store_quantities,refund_id',
        ]);

      $store_id  = $request->store_id; 
      $settle_id = $request->settle_id; 
      $id        = $request->ship_id; 

    if (isset($request->product_id) && $request->product_id != '')
        {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $store_id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن  تسوية  اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
                    $product_store_quantity = ProductStoreQuantity::create([
                    'product_id'   => $loop_id,
                    'store_id'     => $store_id,
                    'quantity'     => -$quantities[$key],
                    'reason'       => $request->reason,
                    'status'       => 'r',
                    'type'         => '-',
                    'settle_id'    => $settle_id, 
                   ]);
          }
      }

      return redirect()->back()->withMessage(__('translations.settle_created_successfully'));
   }

   public function settle_stock($id)
   {
        $this_store  = Store::find($id);
        if (!$this_store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
       // $stores       = Store::where('id', '!=', $this_store->id)->get();
        $products_ids = ProductStoreQuantity::where('store_id', $this_store->id)
                                        // ->where('shiporder_id', '!=', 1)
                                        ->where('shiporder_id', '!=', null)
                                        ->select('product_id')->get();
       
        $uniquids = $products_ids->unique('product_id');
      /*  foreach ($uniquids as $key => $value) {
          return $value->product_id;
        }*/
        $selected = array();
        foreach ($uniquids as $key => $productid) 
        {
          $sumqty = ProductStoreQuantity::where('store_id', $this_store->id)
                                        ->where('product_id', $productid->product_id)
                                        // ->where('shiporder_id', '!=', null)
                                        ->sum('quantity');
           if ($sumqty > 0) 
           {
              array_push($selected, $productid->product_id);
           }
          /* else
           {
            continue;
           }*/
        }

      // $stores = Store::get();
      $products  = Product::whereIn('id', $selected)->where('archive', 0)->select('id', 'name')->get();
      $count_products = count($products);
      return view('owner_dashboard.stores.shiped.settle_stock', compact('this_store', 'products', 'count_products'));
   }

   public function settle_stock_save(Request $request)
   {
      $store_id     = $request->store_id;
      // $shiporder_id = $request->shiporder_id;

      $this->validate($request, [
           // 'shiporder_id'      => 'required|unique:product_store_quantities',
            'store_quantities.*'  => 'required|min:1',
            'product_id'        => 'required',
            'settle_id'         => 'required|integer|unique:product_store_quantities,settle_id',
            'reason'            => 'required|string|max:50',
        ]);

    if (isset($request->product_id) && $request->product_id != '')
        {
          $products     = $request->product_id;
          $quantities   = $request->store_quantities;

           foreach ($products as $key => $loop_id)
           {
             $refundedqty = $quantities[$key];
             $foundqty    = ProductStoreQuantity::where([
                               'product_id' => $loop_id,
                               'store_id'   => $store_id,
                                ])->sum('quantity');

              if ($refundedqty > $foundqty) 
              {
                $prodname = Product::where('archive', 0)->where('id', $loop_id)->select('id', 'name')->first();
                // return $prodname->name;
                return redirect()->back()->withErrors('لا يمكن  تسوية  اكثر من '. $foundqty. 'للمنتج  '. $prodname->name);
              }
           }

          foreach ($products as $key => $loop_id)
          {
                    $product_store_quantity = ProductStoreQuantity::create([
                    'product_id'   => $loop_id,
                    'store_id'     => $store_id,
                    'quantity'     => -$quantities[$key],
                    'reason'       => $request->reason,
                    'status'       => 'r',
                    'type'         => '-',
                    'settle_id'    => $request->settle_id, 
                   ]);
          }
      }

      return redirect()->route('manage.store.all')->withMessage(__('translations.settle_created_successfully'));
      // return redirect()->back()->withMessage(__('translations.settle_created_successfully'));
   }

  public function allstores_purchases2(Request $request)
    {
       ini_set("memory_limit",-1);
       if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
        $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }


       // all store price
        $count_price  = History::where('store_id', '>', 0)->where('order_status' , '!=', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price');

        $records  = History::where('store_id', '>', 0)->where('order_status' , '!=', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                           ->where('created_at', '>=', $date_from)
                           ->where('created_at', '<=', $date_to)
                           ->get();
        $unique_stores = array();
        $repeated      = array();

        foreach ($records as $record)
        {
           if (in_array($record->store_id, $repeated)) {
             continue;
           }
           else{
            $store_price = History::where('store_id', $record->store_id)->where('order_status' , '!=', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->sum('price');

            $store = Store::where('id', $record->store_id)->first();
            // dd($store->name);
            $store_name = $store->name ?? NULL;
            array_push($unique_stores, ['store_name' => $store_name, 'store_price' => $store_price]);
            array_push($repeated, $record->store_id);
           }
        }

    return view('owner_dashboard.purchases.allstores_purchases2', compact('from', 'to', 'count_price', 'unique_stores'));
    }
    
    public function getEditStore($id)
    {
        $store = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        return view('owner_dashboard.stores.edit', compact('store'));
    }

    public function postEditStore(Request $request, $id)
    {
        $store = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $this->validate($request, [
            'name' => 'required|max:55|unique:stores,name,'.$store->id,
            'address' => 'required|max:255',
            'phone' => 'required|regex:/(01)/|size:11|unique:stores,phone,'.$store->id,
        ]);

        $store->update([
            'name'    => $request['name'],
            'address' => $request['address'],
            'phone'   => $request['phone'],
        ]);
        return redirect()->route('manage.store.all')->withMessage(__('translations.store_updated_succ'));
    }

    public function getShowStore($id, Request $request)
    {
      if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
       $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      $store = Store::find($id);
      if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $products = Product::where('archive', 0)->paginate(10);
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
               $search_index = '';
               $products =  Product::where('archive', 0)->paginate(10);
               // return redirect()->back();
            }
            else
            {
                  $products = Product::where('archive', 0)->where('name', 'LIKE', "%{$search_index}%")
                                                       ->orWhere('unique_id', 'LIKE', "%{$search_index}%")
                                                       // ->orWhere('weight', 'LIKE', "%{$search_index}%")
                                                       // ->orWhere('created_at', 'LIKE', "%{$search_index}%")
                                                       // ->orWhereHas('product_store_quantity', function($q) use($search_index)
                                                       //     {
                                                         //      $q->where('quantity', 'like', '%'.$search_index.'%');
                                                          //  })
                                                        // ->orWhereHas('subcategory', function($q) use($search_index)
                                                          //  {
                                                           //     $q->where('name', 'like', '%'.$search_index.'%');
                                                           // })
                                                        ->paginate(10);
            }
        }
        return view('owner_dashboard.stores.show', compact('products', 'from' , 'to', 'search_index', 'store'));

    }
    // purchases in single Store

    public function print_week($id)
    {
      $store    = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        $from = Carbon::today()->subDays(7)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';

         $histories = History::where('store_id', $store->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->get();
                             // ->paginate(10);

      //$histories = History::where('store_id', $store->id)->get();
       return view('owner_dashboard.stores.week', compact('histories', 'store', 'from', 'to'));
    }

    public function pdfweek($id) {
        $store = Store::find($id);
        $from = Carbon::today()->subDays(7)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';

         $histories = History::where('store_id', $store->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->get();

        $pdf = PDF::loadView('owner_dashboard.stores.pdfweek', compact('histories', 'store'));
        return $pdf->stream('week.pdf');
}

public function add_order()
{
  $stores    = Store::all();
  $count_stores = count($stores);
  return view('owner_dashboard.products.add_order', compact('stores', 'count_stores'));
}
    public function getShowStorePurchases(Request $request, $id)
    {
      /*
      $products = Product::all();
      $store    = Store::find($id);
      if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
      $purchases = Purchase::all();
      return view('owner_dashboard.stores.purchase', compact('products', 'store','purchases'));
      */

       set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);

      $store    = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

      if (!isset($request->from) && !isset($request->to))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
        $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }

         $histories = History::where('store_id', $store->id)
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->paginate(10);

        $count_checkout = History::where('store_id', $store->id)
                                        ->where('order_status' , '!=', 'in progress')
                                        ->where('order_status' , '!=', 'pending')
                                        ->where('order_status' , '!=', 'canceled')
                                         ->where('order_status' , '!=', 'delivered')
                                        ->where('created_at', '>=', $date_from)
                                        ->where('created_at', '<=', $date_to)
                                        ->sum('price');

        /* $count_orders_purchased  = History::where('store_id', $store->id)
                                           ->where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();
        */
         $count_orders_purchased  = History::where('price', '>', 0)
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                           ->where('order_status' , '!=', 'delivered')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();
        $cnt_orders_purchased = count($count_orders_purchased->unique('product_id'));

        $count_orders_refunded   = History::where('store_id', $store->id)->where('price', '<', 0)
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                           ->where('order_status' , '!=', 'delivered')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_products = History::where('store_id', $store->id)
                                     ->where('order_status' , '!=', 'in progress')
                                      ->where('order_status' , '!=', 'pending')
                                      ->where('order_status' , '!=', 'canceled')
                                       ->where('order_status' , '!=', 'delivered')
                                     ->where('created_at', '>=', $date_from)
                                     ->where('created_at', '<=', $date_to)
                                     ->sum('quantity');

        $records  = History::where('store_id', $store->id)
                           ->where('order_status' , '!=', 'in progress')
                           ->where('order_status' , '!=', 'pending')
                           ->where('order_status' , '!=', 'canceled')
                           ->where('order_status' , '!=', 'delivered')
                           ->where('created_at', '>=', $date_from)
                           ->where('created_at', '<=', $date_to)
                           ->get();

        $mono_price = 0;
        foreach ($records as $record) {
          $user_id = $record->user_id;
          if ($user_id == null || $user_id == 0) {
            $mono_price += $record->price;
          }
          else
          {
            $user = User::withTrashed()->where('id', $user_id)->first();
            if(empty($user->usertype_id))
            {
              continue;
            }
            if ($user->usertype_id == 1)
            {
              $mono_price += $record->price;
            }
          }
        }

      //$histories = History::where('store_id', $store->id)->get();
      return view('owner_dashboard.stores.purchase2', compact('histories', 'store', 'from', 'to', 'count_checkout', 'count_products', 'count_orders_purchased', 'cnt_orders_purchased', 'count_orders_refunded', 'mono_price'));
    }

    public function allstores_purchases(Request $request)
    {
       if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
        $from = Carbon::today()->subDays(1)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }

         $purchases = Purchase::where('created_at', '>=', $date_from)
                            // ->whereBetween('created_at', [$from, $to])
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->paginate(10);
                             //->get();

        $price = 0;
        $count_prods = array();

        $count_orders_purchased  = History::where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_price  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price');

        $records  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();
        $mono_price = 0;
        foreach ($records as $record) {
          $user_id = $record->user_id;
          if ($user_id == null || $user_id == 0) {
            $mono_price += $record->price;
          }
          else
          {
            $user = User::where('id', $user_id)->first();
            if ($user->usertype_id == 1)
            {
              $mono_price += $record->price;
            }
          }
        }

        $count_proddds  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('quantity');

        $count_bills  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          // ->groupBy('bill_id')
                                          ->get();

        $bills = count($count_bills->groupBy('bill_id'));
        $count_orders_refunded   = History::where('price', '<', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();


        foreach ($purchases as $purchase)
        {
          $price += doubleval($purchase->price);

          $count = History::where('purchase_id', $purchase->id)->get();

          foreach ($count as $value)
          {
              array_push($count_prods, $value->quantity);
           }
        }
    $count_products = array_sum($count_prods);
    return view('owner_dashboard.purchases.allstores_purchases', compact('purchases', 'price', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_price', 'count_proddds', 'bills', 'mono_price'));
    }

    //  Movements in Single store
    public function getShowMovements($id, Request $request)
    {

      if (!$request->has('from') && !$request->has('to'))
      {
       // $from = Carbon::today()->subMonth()->toDateString();
       $from = Carbon::today()->subDays(1)->toDateString();
       $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59'; 
       // return $from;
      }
      else
      {
        $this->validate($request, [
          'from' => 'required|date|before_or_equal:to',
          'to'   => 'required|date|after_or_equal:from',
        ]);

        $from = $request->from;
        $to   = $request->to;

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';
      }

        $store = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $movementss = ProductStoreQuantity::where('store_id', $store->id)
                                              ->where('quantity', '!=', 0)
                                              ->where('created_at', '>=', $date_from)
                                              ->where('created_at', '<=', $date_to)
                                              ->orderBy('created_at', 'DESC')
                                              ->paginate(10);
        }
        else
        {
            $search_index = trim($request->search_index);

            if (empty($search_index) )
            {
              $search_index = '';
              $movementss = ProductStoreQuantity::where('store_id', $store->id)
                                                ->where('quantity', '!=', 0)
                                                ->where('created_at', '>=', $date_from)
                                                ->where('created_at', '<=', $date_to)
                                                ->orderBy('created_at', 'DESC')
                                                ->paginate(10);

              // return redirect()->back()->withErrors(__('translations.enter_product_name_to_search'));
            }
            else
            {
               $movementss = ProductStoreQuantity::where('store_id', $store->id)
                                          ->where('quantity', '!=', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->WhereHas('product', function($q) use($search_index)
                                                            {
                                                                $q->where('name', 'like', '%'.$search_index.'%');
                                                            })
                                         ->orderBy('created_at', 'DESC')
                                         ->paginate(10);
            }

        }

        return view('owner_dashboard.stores.product_movements', compact('from', 'to', 'movementss', 'search_index', 'store'));

      /*
        $from = Carbon::today()->subDays(10)->toDateString();
        $from = $from.' 00:00:00';
        $to   = Carbon::today()->toDateString();
        $to = $to.' 23:59:59';

        $ids = array();
     */
      //  $movementss = ProductStoreQuantity::where('store_id', $store->id)
                                        // ->where('created_at', '>=', $from)
                                        // ->where('created_at', '<=', $to)
        /* $movementss = ProductStoreQuantity::where('store_id', $store->id)
                                         ->orderBy('created_at', 'DESC')
                                         ->paginate(10); */
         /*
          foreach ($movementss as $movement)
          {
            if ($movement->status == 'a' || $movement->status == 'r')
            {
              array_push($ids, $movement->id);
            }
          }
          */

     //   $movements = ProductStoreQuantity::whereIn('id', $ids)->paginate(10);
       // return view('owner_dashboard.stores.product_movements', compact('movementss'));
    }

    // Sellers Name In Single Store
    public function getShowSellers($id)
    {
        $store = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $sellers = Seller::where('store_id', $store->id)->paginate(10);
        return view('owner_dashboard.stores.sellers', compact('sellers'));
    }


    public function getDeleteStore($id)
    {
        $store = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }
        $store->delete();
        return redirect()->route('manage.store.all')->withMessage(__('translations.store_deleted_succ'));

    }

    // Pdf Methods
    function index()
    {
     $products = Product::all();
     $stores = Store::all();
     $purchases = Purchase::all();
     return view('owner_dashboard.stores.reports', compact('products', 'stores','purchases'));
    }

    function pdf()
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html());
     return $pdf->stream();
    }

    function convert_customer_data_to_html($id)
     {
       $store    = Store::find($id);
        if (!$store)
        {
          return redirect()->route('manage.store.all')->withErrors(__('translations.store_not_found'));
        }

        $from = Carbon::today()->subDays(7)->toDateString();
        $to   = Carbon::today()->toDateString();

        $date_from = $from.' 00:00:00';
        $date_to   = $to.' 23:59:59';

         $histories = History::where('store_id', $store->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->get();
                             // ->paginate(10);

      //$histories = History::where('store_id', $store->id)->get();
      return view('owner_dashboard.stores.week', compact('histories', 'store', 'from', 'to'));

      return View::make('owner_dashboard.stores.week')->render();
     }

     /*========================================
         generate stores in excel sheet
     ==========================================*/
     public function excel()
     {
       return Excel::download(new StoresExport(), 'stores.xlsx');
     }
     /*========================================
       generate store purchases in excel sheet
     ==========================================*/
     public function purchases_excel()
     {
    //  set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);
       return Excel::download(new StorePurchasesExport(), 'purchases.xlsx');
     }
     /*========================================
       generate stores purchases in excel sheet
     ==========================================*/
     public function purchases2_excel(Request $request)
     {
       set_time_limit(0);
       ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
       return Excel::download(new StoresPurchasesExport($from, $to), 'storespurchases.xlsx');
     }
     /*=============================================
     generate store product movements in excel sheet
     ===============================================*/
     public function products_excel()
     {
       return Excel::download(new StoreProductMovementsExport(), 'store_products.xlsx');
     }
     /*==================================
       generate store week in excel sheet
     ====================================*/
     public function week_excel()
     {
       return Excel::download(new StoreWeekExport(), 'week.xlsx');
     }
     /*======================================
       generate stores orders in excel sheet
     =======================================*/
     public function orders_excel()
     {
       return Excel::download(new StoresOrdersExport(), 'orders.xlsx');
     }

     public function storeMovements_excel(Request $request)
    {
      if (!$request->has('search_index') || $request->search_index = '') 
      {
        $search_index = '';
      }
      else
      {
        $search_index = trim($request->search_index);
      }

       set_time_limit(0);
      ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
        $id   = $request->id;
        $search_index   = $request->search_index;
// return $request->search_index;
      return Excel::download(new StoreMovementsExport($id, $from, $to, $search_index), 'StoreMovementsExport.xlsx');
    }

    public function showStore_excel(Request $request)
    {
       set_time_limit(0);
      ini_set("memory_limit",-1);

        $id = $request->id;
        $search_index   = $request->search_index;
      return Excel::download(new ShowStoreExport($id, $search_index), 'ShowStoreExport.xlsx'); 
    }

    public function storesRefunds_excel(Request $request)
   {
      set_time_limit(0);
      ini_set("memory_limit",-1);
      
      $from = $request->from.' 00:00:00';
      $to   = $request->to. ' 23:59:59';

      return Excel::download(new allStoresRefundsExport($from, $to), 'allStoresRefundsExport.xlsx');
   }

   public function storesTransfers_excel(Request $request)
   {
      set_time_limit(0);
      ini_set("memory_limit",-1);
      
      $from = $request->from.' 00:00:00';
      $to   = $request->to. ' 23:59:59';

      return Excel::download(new allStoresTransfersExport($from, $to), 'allStoresTransfersExport.xlsx');
   }

   public function storesSettles_excel(Request $request)
   {
      set_time_limit(0);
      ini_set("memory_limit",-1);
      
      $from = $request->from.' 00:00:00';
      $to   = $request->to. ' 23:59:59';
      return Excel::download(new allStoresSettlesExport($from, $to), 'allStoresSettlesExport.xlsx');
   }

   public function storesShipedOrders_excel(Request $request)
   {
      set_time_limit(0);
      ini_set("memory_limit",-1);
      
      $from = $request->from.' 00:00:00';
      $to   = $request->to. ' 23:59:59';
      return Excel::download(new allStoresShipedOrdersExport($from, $to), 'allStoresShipedOrdersExport.xlsx');
   }

   public function eachStorePurchases_excel(Request $request)
   {
      set_time_limit(0);
      ini_set("memory_limit",-1);
      
      $from = $request->from.' 00:00:00';
      $to   = $request->to. ' 23:59:59';
      $id   = $request->id;
      
      return Excel::download(new eachStorePurchasesExport($id, $from, $to), 'eachStorePurchasesExport.xlsx');
   }
}

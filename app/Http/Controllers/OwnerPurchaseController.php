<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Product;
use App\Order;
use App\Store;
use App\Barcode;
use App\BarcodeMovement;
use App\ProductStoreQuantity;
use App\Shipment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\History;
use App\User;
use App\Exports\PurchasesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AhmedExportt;
use App\Exports\allWholesalePurchasesExport;
use App\Progress;

class OwnerPurchaseController extends Controller
{
    /*public function getData(){
    $purchases = Purchase::orderBy('created_at','desc')->get();
    return Datatables::of($purchases)
    ->addColumn('action', function ($purchase) {
    return '<a data-href="'.route('manage.purchase.delete',['id' => $purchase->id]).'" class="delete btn btn-xs btn-danger">حذف</a>
    <a href="'.route('manage.purchase.details',['id' => $purchase->id]).'" class="btn btn-xs btn-primary">عرض</a>
    <input type="hidden" name="row" value="'.$purchase->id.'" id="row">';
    })
    ->addColumn('user_name', function ($purchase) {
    return $purchase->user->name;
    })

    ->make(true);
    }*/

    public function getShowAll()
    {
        // $purchases = Purchase::where('purchase_status', '=', 'pending')->whereHas('user', function ($query) {$query->withTrashed();})->orderBy('created_at', 'desc')->get();
        $purchases = Purchase::where('purchase_status', '=', 'pending')->where('payment_method_id', '!=', 'NULL')->orderBy('created_at', 'desc')->get();
        return view('owner_dashboard.purchases.all', compact('purchases'));
    }

    public function all_wholesale_customers_purchases(Request $request)
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
         $wholesale_purchases = array();
        
         $online_bills = History::where('order_status', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->where('price', '>', 0)
                             ->pluck('bill_id');

         $purchases = History::whereNotIn('bill_id', $online_bills)->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->get();
        $count_price = History::whereNotIn('bill_id', $online_bills)->where('order_status' , '!=', 'delivered')
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->sum('price');

          foreach ($purchases as $purchase) {
            if ($purchase->user_id == null || $purchase->user_id == 0) {
              continue;
            }
            else{
              $client = User::withTrashed()->select('id', 'name', 'usertype_id')->where('id', $purchase->user_id)->first();
              if ($client->usertype_id == 1) {
                continue;
              }
              else
              {
                array_push($wholesale_purchases, $purchase->id);
              }
            }
          }
         // return $wholesale_purchases;
          $wholesale_price = History::whereIn('id', $wholesale_purchases)
                             ->sum('price');

          $needed_purchases = History::whereIn('id', $wholesale_purchases)
                                     ->orderBy('created_at', 'DESC')
                                     ->paginate(10);
                        //   return $needed_purchases;

    return view('owner_dashboard.purchases.all_wholesale_customers_purchases', compact('from', 'to', 'needed_purchases', 'wholesale_price', 'count_price'));
    }

    public function all_wholesale_customers_purchases2(Request $request)
    {
      if (!$request->has('from') && !$request->has('to'))
      {
       $from = Carbon::today()->subMonth()->toDateString();
       /// $from = Carbon::today()->subDays(1)->toDateString();
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
         $wholesale_purchases = array();
         $purchases = Purchase::where('store_id', '!=' , null)->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->get();

          foreach ($purchases as $purchase) {
            if ($purchase->user_id == null || $purchase->user_id == 0) {
              continue;
            }
            else{
              $client = User::withTrashed()->select('id', 'name', 'usertype_id')->where('id', $purchase->user_id)->first();
              if ($client->usertype_id == 1) {
                continue;
              }
              else
              {
                array_push($wholesale_purchases, $purchase->id);
              }
            }
          }
         // return $wholesale_purchases;
          $needed_purchases = Purchase::whereIn('id', $wholesale_purchases)
                             ->paginate(10);
                        //   return count($needed_purchases);
        $price = 0;
        $count_prods = array();

       /* $count_orders_purchased  = History::where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_price  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price');

        $records  = History::where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();
                                          return $records;
        $mono_price = 0;
        foreach ($records as $record) {
          $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
             continue;
             // $mono_price += $record->price;
            }
            else
            {
             // return $user_id;
              $user = User::withTrashed()->where('id', $user_id)
                                                 ->select('name', 'usertype_id')
                                                 ->first();
             // return $user;
              if ($user->usertype_id == 1)
              {
                continue;
              }
              else
              {
                 $mono_price += $record->price;
              }
            }
        }

      /*  $count_proddds  = History::where('created_at', '>=', $date_from)
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
    */
    return view('owner_dashboard.purchases.all_wholesale_customers_purchases', compact('needed_purchases', 'price', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_price', 'count_proddds', 'bills', 'mono_price'));
    }

// delivered (all transactions/ onlines ones too)
    
    public function getShowAllDone(Request $request)
    {
      set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);

      if (!$request->has('from') && !$request->has('to'))
      {
        //$from = Carbon::today()->subMonth()->toDateString();
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

         $purchases = History::where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->orderBy('created_at', 'DESC')
                             ->paginate(10);
                             //->get();
        $price = 0;
        $count_prods = array();

        $count_orders_purchased  = History::where('price', '>', 0)
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();

        $count_purchases_shipments = History::where('price', '>', 0)
                                          ->where('order_status' , 'delivered')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();

        $purchases_shipments        = $count_purchases_shipments->pluck('purchase_id');
        $count_purchases_shipments  = count($count_purchases_shipments->unique('purchase_id'));
        $sum_purchases_shipments    = Purchase::whereIn('id', $purchases_shipments)->sum('shipment');
        $sum_purchases_onlines      = Purchase::whereIn('id', $purchases_shipments)
                                              ->sum('price');
                                              // ->select('id', 'price', 'use_promo')->get();
        //return $sum_purchases_promos;

      // added ahmed
      $onlineBills  = History::where('order_status', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->pluck('bill_id');

       $onlineTotal  = History::where('order_status', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price'); 

       $onlineRefund  = History::whereIn('bill_id', $onlineBills)
                                          ->where('order_status', '!=', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('quantity' , '<', '0')
                                          ->where('price' , '<', '0')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price'); 
      // added ahmed

       $cnt_orders_purchased = count($count_orders_purchased->unique('product_id'));

        $count_price  = History::where('created_at', '>=', $date_from)
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price');

        $count_pos  = History::where('created_at', '>=', $date_from)
                                          ->where('order_status' , '!=', 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('price');

        $records  = History::where('created_at', '>=', $date_from)->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '<=', $date_to)
                                          ->get();
                                        //  return $records;
        $mono_price = 0;
        foreach ($records as $record) {
          $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
             // return 'empty';
              $mono_price += $record->price;
            }
            else
            {
             // return $user_id;
              $user = User::withTrashed()->where('id', $user_id)
                                                 ->select('name', 'usertype_id')
                                                 ->first();
             // return $user;
              if ($user->usertype_id == 1)
              {
                $mono_price += $record->price;
              }
              else
              {
                continue;
              }
            }
        }

        $count_proddds  = History::where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->sum('quantity');

        $count_bills  = History::where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          // ->groupBy('bill_id')
                                          ->get();

        $bills = count($count_bills->groupBy('bill_id'));
        $count_orders_refunded   = History::where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('price', '<', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();


        foreach ($purchases as $purchase)
        {
          $price += doubleval($purchase->price);

          $count = History::where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('purchase_id', $purchase->id)->get();

          foreach ($count as $value)
          {
              array_push($count_prods, $value->quantity);
           }
        }
    $count_products = array_sum($count_prods);
    // return $sum_purchases_shipments;
    return view('owner_dashboard.purchases.delivered2', compact('purchases', 'price', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'cnt_orders_purchased', 'count_price', 'count_proddds', 'bills', 'mono_price', 'count_purchases_shipments', 'sum_purchases_shipments', 'purchases_shipments', 'count_pos', 'sum_purchases_onlines', 'onlineTotal', 'onlineRefund'));
    }

    public function getShowAllDone2(Request $request)
    {
      if (!$request->has('from') && !$request->has('to'))
      {
        //$from = Carbon::today()->subMonth()->toDateString();
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

         $purchases = Purchase::where('store_id', '!=', null)->where('created_at', '>=', $date_from)
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
                                        //  return $records;
        $mono_price = 0;
        foreach ($records as $record) {
          $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
             // return 'empty';
              $mono_price += $record->price;
            }
            else
            {
              $user = User::select('name', 'usertype_id')->where('id', $user_id)->first();
             // return $user->usertype_id;
              if ($user->usertype_id == 1)
              {
                $mono_price += $record->price;
              }
              else
              {
                continue;
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
    return view('owner_dashboard.purchases.delivered', compact('purchases', 'price', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_price', 'count_proddds', 'bills', 'mono_price'));
    }

    public function get(Request $request)
    {
      return $request->all();
    }

    public function getShowAllInProgress()
    {
        // $purchases = Purchase::where('purchase_status', 'in progress')->whereHas('user', function ($query) {$query->withTrashed();})->orderBy('created_at', 'desc')->get();
        $purchases = Purchase::where('purchase_status', 'in progress')->orderBy('created_at', 'desc')->get();
        return view('owner_dashboard.purchases.in_progress', compact('purchases'));
    }

    public function getEditPurchase($id)
    {
        $purchase = Purchase::find($id);
        if($purchase->purchase_status != 'pending'){
          return redirect()->back()->withErrors([__('translations.you_cant_edit_transaction_because_it_is_already_moved')]);
        }
        $orders =  $purchase->orders;
        if ($purchase && $orders->count() > 0) {
            return view('owner_dashboard.purchases.edit', compact('purchase', 'orders'));
        }
        abort(404);
    }

    public function to_delivered($id)
    {
        $purchase = Purchase::find($id);
        if($purchase->purchase_status != 'pending'){
          $histories = History::where('purchase_id' , $id)->get();
          foreach ($histories as $key => $value) {
            $value->update([
              'order_status' => 'delivered',
            ]);
          }
          $updated = $purchase->update(['purchase_status' => 'delivered']);
          if ($updated){
            return redirect()->route('in_progress.purchases')
                             ->withMessage(__('translations.purchase_updated_succ'));
          }
          else{
            return redirect()->back()->withMessage(__('translations.purchase_updated_succ'));
          }
        }
        abort(404);
    }

    public function postEditPurchase(Request $request, $id)
    {
        $this->validate($request, [
            'product_store_quantity' => 'required|array',
        ]);

        try {
          foreach ($request->product_store_quantity as $order_id => $body) {
            $order = Order::where('id', $order_id)->withTrashed()->first();
            $single_product_amount = 0;
            foreach ($body as $store_id => $amount) {
              $single_product_amount += intval($amount);
              $amount_in_store = Store::where('id', $store_id)->first();
              $amount_in_store = $amount_in_store->quantity_in_store($order->product_id);
              if( $amount > $amount_in_store){
                return redirect()->back()->withErrors([__('translations.store_doesnt_has_this_mount')]);
              }
            }
            if($single_product_amount != $order->quantity){
              return redirect()->back()->withErrors([__('translations.you_must_match_order_quantity')]);
            }
          }
        }
        catch(Exception $e) {
          return redirect()->back()->withErrors([__('translations.please_review_your_stores_and_quantities')]);
        }

        $purchase = Purchase::find($id);
        if ($purchase) {
            $purchase->update([
                'purchase_status' => 'in progress',
            ]);

          $histories = History::where('purchase_id' , $id)->get();
          foreach ($histories as $key => $value) {
            $value->update([
              'order_status' => 'in progress' ,
            ]) ;
          }
            foreach ($request->product_store_quantity as $order_id => $body) {
              $order = Order::where('id', $order_id)->withTrashed()->first();
              foreach ($body as $store_id => $amount) {
                if ($amount == "") {
                  $amount = 0 ;
                }else {
                  $amount = - $amount ;
                }
                ProductStoreQuantity::create([
                    'product_id' => $order->product_id,
                    'store_id' => $store_id,
                    'quantity' => $amount,
                    'purchase_id' => $id,
                    'reason' => __('translations.purchase'),
                    'type' => '-',
                    'custom_status' => 'in progress',
                ]);
                      // new added ahmed 
                $thisItem = History::where('purchase_id', $purchase->id)
                      ->where('bill_id', $purchase->bill_id)
                      ->where('product_id', $order->product_id)
                      ->where('store_id', null)
                      ->where('seller_id', null)
                      ->first();

                $thisItem_price =  $thisItem->price;
                $thisItem_quantity =  $thisItem->quantity;

                  $progress = Progress::create([
                    'user_id' => $purchase->user_id,
                    'product_id' => $order->product_id,  // ahmed 
                    'purchase_id' => $purchase->id,
                    'price' => doubleval($thisItem_price) / $thisItem_quantity, // ahmed
                    'purchase_price' => doubleval($purchase->price),
                    'order_status' => 'in progress',
                    'quantity' => $amount,
                    'bill_id' => $purchase->bill_id,
                    'store_id' => $store_id, // ahmed
                    'seller_id' => $purchase->seller_id,
                    'payment_method_id' => $purchase->payment_method_id,
                    'use_promo' => $purchase->use_promo,  // new
                    'shipment'  => doubleval($purchase->shipment),
                ]);                
              }
            }

            //return redirect()->route('manage.purchase.all')->withMessage('purchase Updated Succeffully');
            return redirect()->route('pending.purchases')->withMessage(__('translations.purchase_updated_succ'));
        }
        abort(404);
    }

    public function getShowDetails($id)
    {

        $purchase = Purchase::find($id);
        if ($purchase) {
            $orders = $purchase->orders;
            //dd($purchase->histories);
            return view('owner_dashboard.purchases.details', compact('purchase', 'orders'));
        }
        abort(404);
    }

    public function getDeletePurchase($id)
    {

        $purchase = Purchase::find($id);
        if ($purchase) {
            $purchase->delete();
            return redirect()->route('manage.purchase.all')->withMessage(__('translations.purchase_deleted_succ'));
        }
        abort(404);
    }

    // all purchases reports
    public function getReports(){
      $purchases = Purchase::all();
      return view('owner_dashboard.purchases.reports' , compact('purchases'));
    }

    public function getUnassginedBills($vendor_id)
    {
        $bills = ProductStoreQuantity::where('type', '-')
        ->whereHas('store', function ($query) use ($vendor_id){
          $query->whereHas('vendor', function ($query) use ($vendor_id){
            $query->where('id', $vendor_id);
          });
        })
        ->orderBy('created_at', 'desc')
        ->get();
        // return $bills;

        foreach ($bills as $key => $bill) {
          if (abs($bill->quantity) <= $bill->barcodes()->count()) {
            $bills->forget($key);
          }
        }

        return view('owner_dashboard.bills.unfinished_bills', compact('bills'));
    }

    public function billSettle($bill_id)
    {
      $bill = ProductStoreQuantity::find($bill_id);
      if ($bill) {
          return view('owner_dashboard.bills.details', compact('bill'));
      }
      abort(404);
    }

    public function postBillSettle(Request $request)
    {
      $this->validate($request, [
          'barcodes' => 'required|array',
          'bill_id' => 'required|numeric',
      ]);


      $bill = ProductStoreQuantity::find($request->bill_id);
      $product = Product::find($bill->product_id);

      $product_code = $bill->product->unique_id;


      foreach ($request->barcodes as $barcode) {
        // $code = Barcode::where('code',$barcode)->get();
        // return response()->json([
        //     $code->code
        //   ]);
        // if($code){
        //   if($code->store_id != $bill->store_id){
        //     return response()->json([
        //       'code' => 201,
        //       'message' => "This Barcode doesn't belong to this Store",
        //     ]);
        //   }
        // }
        // else {
        //   return response()->json([
        //     'code' => 201,
        //     'message' => 'Please scan the right product, code '.$barcode_code.' isn\'t the right'
        //   ]);
        // }
        $barcode_code = mb_substr($barcode, 0, 13);
        if(!($product_code == $barcode_code)){
          return response()->json([
              'code' => 201,
              'message' => __('translations.please_scan_the_right_product_code').$barcode_code. __('translations.isnt_the_right'),
          ]);
        }
      }
      // return $request->barcodes;
      if (count($request->barcodes) > abs($bill->quantity)) {
        return response()->json([
            'code' => 201,
            'message' => __('translations.you_scanned_more_than_required'),
        ]);
      }
      foreach ($request->barcodes as $key => $barcode) {
        $code = Barcode::where('code',$barcode)->first();
        if($code && $code->state == 0){
          $product->remove_barcodes_for_product($code->code, $bill->store_id, $bill->id);
        }
        else {
          return response()->json(['code'=>200,'message'=>__('translations.this_item_isnt_available')]);
        }
      }

      $flag = Barcode::whereIn('code', $request->barcodes)->update(['product_store_quantity_id' => $request->bill_id]);

      if ($flag) {
        return response()->json(['code' => 200]);
      }

      return response()->json([
          'code' => 201,
          'message' => __('translations.no_product_found'),
      ]);
    }
    public function getRefund()
    {
      $stores = Store::all();
      return view('owner_dashboard.bills.refund',compact('stores'));
    }
    public function postRefund(Request $request)
    {
      $this->validate($request,[
        'unique_id' => 'required|numeric',
        'store_id'     => 'required|exists:stores,id',
      ]);
      $unique_id = $request->unique_id;
      $product = Product::where('unique_id',$unique_id)->first();
      if($product)
      {
          $new_item_movement = ProductStoreQuantity::create([
            'product_id' => $product->id,
            'store_id'   => $request->store_id,
            'type' => '+',
            'quantity' => '1',
            'reason' => __('translations.refund'),
          ]);
      }
      else
      {
        return redirect()->back()->withErrors(__('translations.please_make_sure_you_entered_a_valid_unique_id'));
      }
      return redirect()->back()->with(['message' => __('translations.the_item_has_been_refunded_succ')]);
    }

    public function search_with_bill2(Request $request)
    {
      if ($request->has('bill_id'))
      {
         $this->validate($request, [
             'bill_id' => 'required|numeric',
        ]);
        $bill_id = $request->bill_id;
      }
      else
      {
        $bill_id = 'not';
      }

       $histories  = History::where('bill_id', $bill_id)->get();
       $bill_total = History::where('bill_id', $bill_id)->sum('price');

      if (!$histories) {
        return view('owner_dashboard.purchases.search_with_bill2')->withErrors(__('translations.make_sure_about_bill_id'));
      }
     // return $histories;
    //  return view('owner_dashboard.purchases.bill_history', compact('histories'));
      return view('owner_dashboard.purchases.search_with_bill2', compact('bill_id', 'histories', 'bill_total'));
    }

    public function get_bill_details(Request $request)
    {
      if ($request->ajax()) {
        $bill_id = $request->get('bill_id');

         $histories  = History::where('bill_id', $bill_id)->get();
         $bill_total = History::where('bill_id', $bill_id)->sum('price');

      if (count($histories) <= 0) {
        return view('owner_dashboard.purchases.search_with_bill')->withErrors(__('translations.make_sure_about_bill_id'));
      }
      else
      {
         return view('owner_dashboard.purchases.search_with_bill', compact('bill_id', 'histories', 'bill_total'));
       }
      }
    }
    /*========================================
      Display all online pending purchases
    ==========================================*/
    public function pending(Request $request)
    {
        $keyword = trim($request->get('search'));
        $perPage = 10;

        if (!empty($keyword)) {
            $purchases = Purchase::where('purchase_status', '=', 'pending')
                                 ->where('payment_method_id', '!=', 'NULL')
                                 ->where(function ($query) use ($keyword){
                                     $query->where('price' , 'LIKE' ,  "%$keyword%")
                                           ->orWhere('bill_id' , 'LIKE' ,  "%$keyword%")
                                           ->orWhere('purchase_status' , 'LIKE' ,  "%$keyword%")
                                           ->orWhereHas('user' , function ($query) use ($keyword){
                                             $query->where('name', 'LIKE', "%$keyword%");
                                     }); })
                                ->latest()->paginate($perPage);
        } else {
          $purchases = Purchase::where('purchase_status', '=', 'pending')
                                  ->where('payment_method_id', '!=', 'NULL')
                                  ->latest()->paginate($perPage);
        }

        return view('owner_dashboard.online-purchases.pending' , compact('purchases'));
    }

    /*============================================
      Display details for online pending purchases
    ==============================================*/
    public function showPending($id)
    {
        $purchase = Purchase::findOrFail($id);
        $delivery_address =  $purchase->delivery_address ;
        $shipmentPrice = $purchase->shipment ;
        $orders = $purchase->orders;
        $records = ProductStoreQuantity::where('purchase_id', $id)
                                       ->where('quantity', '!=', 0)
                                       ->where('status', null)
                                       ->get();
        $purchase_histories = History::where('purchase_id', $purchase->id)->get();
        return view('owner_dashboard.online-purchases.pending-details', compact('purchase', 'orders', 'records', 'purchase_histories' , 'shipmentPrice'));
    }
// added to view inprogress details
    public function show_inprogress_details($id)
    {
        $purchase = Purchase::findOrFail($id);
        $delivery_address =  $purchase->delivery_address ;
        $shipmentPrice = $purchase->shipment ;
        $orders = $purchase->orders;
        $records = ProductStoreQuantity::where('purchase_id', $id)
                                       ->where('quantity', '!=', 0)
                                       ->where('status', null)
                                       ->get();
        $purchase_histories = History::where('purchase_id', $purchase->id)->get();
        return view('owner_dashboard.online-purchases.show_inprogress_details', compact('purchase', 'orders', 'records', 'purchase_histories' , 'shipmentPrice'));
    }

    // added to view cancelled details
    public function show_cancelled_details($id)
    {
        $purchase = Purchase::findOrFail($id);
        $delivery_address =  $purchase->delivery_address ;
        $shipmentPrice = $purchase->shipment ;
        $orders = $purchase->orders;
        $records = ProductStoreQuantity::where('purchase_id', $id)
                                       ->where('quantity', '!=', 0)
                                       ->where('status', null)
                                       ->get();
        $purchase_histories = History::where('purchase_id', $purchase->id)->get();
        return view('owner_dashboard.online-purchases.show_cancelled_details', compact('purchase', 'orders', 'records', 'purchase_histories' , 'shipmentPrice'));
    }
// added to view delivered details

    public function show_delivered_details($id)
    {
        $purchase = Purchase::findOrFail($id);
        $delivery_address =  $purchase->delivery_address ;
        $shipmentPrice = $purchase->shipment ;
        $orders = $purchase->orders;
        $records = ProductStoreQuantity::where('purchase_id', $id)
                                       ->where('quantity', '!=', 0)
                                       ->where('status', null)
                                       ->get();
        $purchase_histories = History::where('purchase_id', $purchase->id)->get();
        return view('owner_dashboard.online-purchases.show_deivered_details', compact('purchase', 'orders', 'records', 'purchase_histories' , 'shipmentPrice'));
    }

    /*=========================================
     function method to cancel pending purchase
    ===========================================*/
    public function cancelPurchase($id)
    {
      $purchase = Purchase::findOrFail($id);

          $updated = $purchase->update(['purchase_status' => 'canceled']);
          $histories = History::where('purchase_id', $id)->get();
          foreach ($histories as $key => $value) {
            $value->update([
              'order_status' => 'canceled',
            ]);
          }
          if ($updated){

  //          $records = ProductStoreQuantity::where('purchase_id', $purchase->id)->get();
           /* foreach ($records as $record)
            {
               $record->update(['status' => 'canceled']);
            }*/
/*
            $histories = History::where('purchase_id', $purchase->id)
                                ->where('store_id', '!=', null)
                                ->where('quantity', '>', 0)
                                ->get();

            foreach ($histories as $history)
            {
              $history->update(['order_status' => 'canceled']);
            }*/

                 return redirect()->route('pending.purchases')->withMessage('تم الغاء العملية');
          }
          else{
            return redirect()->back()->withErrors('purchase not cancelled');
          }
    }
    /*========================================
     Display all online in progress purchases
    ==========================================*/
    public function in_progress(Request $request)
    {
      $keyword = trim($request->get('search'));
      $perPage = 10;

      if (!empty($keyword)) {
          $purchases = Purchase::where('purchase_status', '=', 'in progress')
                               ->where(function ($query) use ($keyword){
                                   $query->where('price' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('bill_id' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('purchase_status' , 'LIKE' ,  "%$keyword%")
                                         ->orWhereHas('user' , function ($query) use ($keyword){
                                           $query->where('name', 'LIKE', "%$keyword%");
                                   }); })
                              ->latest()->paginate($perPage);
      } else {
        $purchases = Purchase::where('purchase_status', '=', 'in progress')
                                ->latest()->paginate($perPage);
      }

      return view('owner_dashboard.online-purchases.in-progress' , compact('purchases'));
    }
    /*========================================
     Display all online delivered purchases
    ==========================================*/
    public function delieverd(Request $request)
    {
      $keyword = trim($request->get('search'));
      $perPage = 10;

      if (!empty($keyword)) {
          $purchases = Purchase::where('purchase_status', '=', 'delivered')
                               ->where(function ($query) use ($keyword){
                                   $query->where('price' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('bill_id' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('purchase_status' , 'LIKE' ,  "%$keyword%")
                                         ->orWhereHas('user' , function ($query) use ($keyword){
                                           $query->where('name', 'LIKE', "%$keyword%");
                                   }); })
                              ->latest()->paginate($perPage);
      } else {
        $purchases = Purchase::where('purchase_status', '=', 'delivered')
                                ->latest()->paginate($perPage);
      }
      return view('owner_dashboard.online-purchases.deliverd' , compact('purchases'));
    }

    /*===============================
     Display all cancelled purchases
    =================================*/
    public function cancelled(Request $request)
    {
      $keyword = trim($request->get('search'));
      $perPage = 10;

      if (!empty($keyword)) {
          $purchases = Purchase::where('purchase_status', '=', 'canceled')
                               ->where(function ($query) use ($keyword){
                                   $query->where('price' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('bill_id' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('purchase_status' , 'LIKE' ,  "%$keyword%")
                                         ->orWhereHas('user' , function ($query) use ($keyword){
                                           $query->where('name', 'LIKE', "%$keyword%");
                                   }); })
                              ->latest()->paginate($perPage);
      } else {
        $purchases = Purchase::where('purchase_status', '=', 'canceled')
                                ->latest()->paginate($perPage);
      }

      return view('owner_dashboard.online-purchases.cancelled', compact('purchases'));
    }

    /*============================
     restore cancelled purchase
    ==============================*/
    public function restorePurchase($id)
    {
      $purchase = Purchase::findOrFail($id);

          $updated = $purchase->update(['purchase_status' => 'pending']);
          if ($updated){

/*            $records = ProductStoreQuantity::where('purchase_id', $purchase->id)->get();
            foreach ($records as $record)
            {
               $record->update(['status' => 'pending']);
            }*/

            $histories = History::where('purchase_id', $purchase->id)
                                // ->where('store_id', '!=', null) // added ahmed
                                ->where('quantity', '>', 0)
                                ->get();

            foreach ($histories as $history)
            {
              $history->update(['order_status' => 'pending']);
            }

                 return redirect()->back()->withMessage('تم استرجاع العملية');
          }
          else{
            return redirect()->back()->withErrors('لم يتم استرجاع العملية');
          }
    }

    /*========================================
     generate excel sheet for all purchases
    ==========================================*/
    public function excel()
    {
       set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);

      return Excel::download(new PurchasesExport(), 'purchases.xlsx');
    }

    public function ahmed(Request $request)
    {
       // return $request->to;
       set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
//return $to;
      return Excel::download(new AhmedExportt($from, $to), 'AllPurchases.xlsx');
      // return (new PurchasesExport($request->to, $request->from))->download('ahmed.xlsx');
    }

    public function allWholesalePurchases(Request $request)
    {
       set_time_limit(0);
      ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
      return Excel::download(new allWholesalePurchasesExport($from, $to), 'allWholesalePurchases.xlsx');

    }

     public function show_deivered_details_stores($id, $purchase_id){

      $prod_details = History::where('product_id', $id)
                             ->where('purchase_id', $purchase_id)->get();

      $store_details = Progress::where('product_id', $id)
                            ->where('quantity', '!=', 0)
                             ->where('purchase_id', $purchase_id)->get();

      return view('owner_dashboard.online-purchases.show_deivered_details_stores', compact('prod_details', 'store_details'));
    }

     public function show_delivered_details2($id)
    {
        $purchase = Purchase::findOrFail($id);
        $delivery_address =  $purchase->delivery_address ;
        $shipmentPrice = $purchase->shipment ;
        // $orders = $purchase->histories;
       /* 
       $records = ProductStoreQuantity::where('purchase_id', $id)
                                       ->where('quantity', '!=', 0)
                                       ->where('status', null)
                                       ->get(); */

        $purchase_histories = History::where('purchase_id', $purchase->id)->get();
        return view('owner_dashboard.online-purchases.show_deivered_details_cop', compact('purchase', 'purchase_histories' , 'shipmentPrice'));
    }

     public function delieverd2(Request $request)
    {
      $keyword = trim($request->get('search'));
      $perPage = 10;

      if (!empty($keyword)) {
          $purchases = Purchase::where('purchase_status', 'partially delivered')
                               ->orWhere('purchase_status', 'total delivered')
                               ->where(function ($query) use ($keyword){
                                   $query->where('price' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('bill_id' , 'LIKE' ,  "%$keyword%")
                                         ->orWhere('purchase_status' , 'LIKE' ,  "%$keyword%")
                                         ->orWhereHas('user' , function ($query) use ($keyword){
                                           $query->where('name', 'LIKE', "%$keyword%");
                                   }); })
                              ->latest()->paginate($perPage);
      } else {
        $purchases = Purchase::where('purchase_status', 'partially delivered')
                               ->orWhere('purchase_status', 'total delivered')
                                ->latest()->paginate($perPage);
      }
      return view('owner_dashboard.online-purchases.deliverd_cop' , compact('purchases'));
    }

    public function aa()
    {
       $records = History::where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->select('seller_id', 'store_id', 'price')
                          ->get();

      $sellers = History::where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->select('seller_id')
                          ->get();

      $sellers   =  $sellers->unique('seller_id');
      $store_uni = array();

      foreach ($sellers as $seller) 
      {
        $unique = array();
        // return $seller->seller_id;
            foreach ($records as $record) 
            {
                  if ($record->seller_id == $seller->seller_id) 
                  {
                          if (in_array($record->store_id, $unique)) 
                          {
                           continue;
                          }
                          else
                          {
                            array_push($store_uni, [
                                 'seller_id' => $seller->seller_id, 
                                 'store_id'  => $record->store_id, 
                              ]);
                          }
                  }
                  else
                  {
                      continue;
                  }
              array_push($unique, $record->store_id);  
            }
      }
    return $store_uni;
   }
}

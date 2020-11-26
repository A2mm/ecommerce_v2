<?php

namespace App\Http\Controllers;

use App\Seller;
use App\Store;
use App\History;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Subcategory;
use App\Category;
use App\User;
use App\Product;
use Spatie\Activitylog\Models\Activity;
use App\Exports\SellersExport;
use App\Exports\SellerReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\allSellersKiloExport;

class OwnerSellerController extends Controller
{
  public function sellers_log()
  {
    $records =  Activity::where('subject_type', 'App\Seller')->get();
    return view('owner_dashboard.sellers.log_activities', compact('records'));
  }

  public function specific_log($id)
  {
    $activity = Activity::where('id', $id)->first();
    return view('owner_dashboard.owners.log_activities_specific', compact('activity'));
  }

    public function getShowAll()
    {
        $sellers = Seller::all();
        return view('owner_dashboard.sellers.all', compact('sellers'));
    }

    public function getCreate()
    {
       $stores = Store::all();
       return view('owner_dashboard.sellers.create', compact('stores'));
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:56',
            'email' => 'required|email|max:128|unique:sellers,email',
            'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|max:30',
            'store_id' => 'required|exists:stores,id',
            'discount' => 'required|numeric|min:0|digits_between:1,2',
        ]);

        $seller = new Seller;

        $seller->email = $request->email;
        $seller->store_id = $request->store_id;
        $seller->password = bcrypt($request->password);
        $seller->name = $request->name;
        $seller->discount = $request->discount;
        $seller->api_token = bin2hex(random_bytes(50));
        if (!$seller->save()) {
            abort(404);
        }
        return redirect('/owner/manage/sellers')->withMessage(__('translations.seller_created_succ'));
    }

    public function getEdit($id)
    {
        $seller = Seller::findOrFail($id);
        $stores = Store::get();
        return view('owner_dashboard.sellers.edit', compact('stores', 'seller'));
    }

    public function postEdit(Request $request, $id)
    {
        $seller = Seller::find($id);
        if(!$seller)
        {
            return redirect()->back()->withErrors('product not found');
        }
        $this->validate($request, [
            'name' => 'required|max:56|unique:sellers,name,'.$seller->id,
            'email' => 'required|email|max:128|unique:sellers,email,' . $seller->id,
            'store_id' => 'required|exists:stores,id',
            'discount' => 'required|numeric|min:0|digits_between:1,2',
        ]);

        $seller->email = $request->email;
        $seller->store_id = $request->store_id;
        $seller->discount = $request->discount;
        if (isset($request->password) && $request->password != '') {
            $this->validate($request, [
                'password' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|max:30',
            ]);
            $seller->password = bcrypt($request->password);
        }
        $seller->name = $request->name;
        if (!$seller->save()) {
            abort(404);
        }
        return redirect('/owner/manage/sellers')->withMessage(__('translations.seller_updated_succ'));
    }

    public function getView($id)
    {
        $seller = Seller::findOrFail($id);
        return view('owner_dashboard.sellers.view', compact('seller'));
    }

    public function getSuspend($id)
    {
        $seller = Seller::findOrFail($id);
        if ($seller->suspend == 0) {
            $seller->update([
                'suspend' => 1,
            ]);
            return redirect('/owner/manage/sellers')->withMessage(__('translations.seller_status_updated_suspend'));
        }
        else {
            $seller->update([
                'suspend' => 0,
            ]);
        }

        return redirect('/owner/manage/sellers')->withMessage(__('translations.seller_status_updated_un_suspend'));
    }


    public function specific_seller(Request $request, $id)
    {
        $seller = Seller::find($id);
        if (!$seller)
        {
            return redirect()->route('manage.sellers.all')->withErrors('seller not found');
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

         $soldprods = History::where('seller_id', $seller->id)
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('order_status' , '!=', 'delivered')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                             ->orderBy('created_at', 'DESC')
                             ->paginate(10);

        $count_checkout = History::where('seller_id', $seller->id)
                              ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                                        ->where('created_at', '>=', $date_from)
                                        ->where('created_at', '<=', $date_to)
                                        ->sum('price');

        $count_orders_purchased  = History::where('seller_id', $seller->id)
                            ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                                          ->where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_orders_refunded   = History::where('seller_id', $seller->id)
                                    ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                                          ->where('price', '<', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_products = History::where('seller_id', $seller->id)
                                   ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                                     ->where('created_at', '>=', $date_from)
                                     ->where('created_at', '<=', $date_to)
                                     ->sum('quantity');

        $count_bills  = History::where('seller_id', $seller->id)
                                    ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                               ->where('created_at', '>=', $date_from)
                                ->where('created_at', '<=', $date_to)
                                ->get();

        $bills = count($count_bills->groupBy('bill_id'));

        $records  = History::where('seller_id', $seller->id)
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
            $user = User::where('id', $user_id)->first();
            if ($user->usertype_id == 1)
            {
              $mono_price += $record->price;
            }
          }
        }

       // $soldprods = $histories->groupBy('store_id');
        $count     = count($soldprods);
        return view('owner_dashboard.sellers.history', compact('soldprods', 'count', 'seller', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout', 'bills', 'mono_price'));
    }

    public function view_seller_history_by_kilo(Request $request, $id)
    {
        $seller = Seller::find($id);
        if (!$seller)
        {
            return redirect()->route('manage.sellers.all')->withErrors('seller not found');
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

         $soldprods = History::where('seller_id', $seller->id)
                              ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                            // ->where('quantity' , '>', 0)
                             ->orderBy('created_at', 'DESC')
                             ->get();
                             //->paginate(10);
        $unique = array();
        $subs   = array();

        foreach($soldprods as $prod)
        {
            if (in_array($prod->product->id, $unique))
            {
                continue;
            }
            array_push($unique, $prod->product_id);
        }

        $cat1  = 0;
        $cat2  = 0;
        $cat3  = 0;

        $category1  = Category::find(1);
        $category2  = Category::find(2);
        $category3  = Category::find(3);

        foreach($soldprods as $prod)
        {
            if ($prod->product->subcategory->category_id == 1)
            {
                $cat1 += $prod->product->weight * $prod->quantity;
            }
            elseif($prod->product->subcategory->category_id == 2) {
                $cat2 += $prod->product->weight * $prod->quantity;
            }
            else{
                $cat3 += $prod->product->weight * $prod->quantity;
            }
        }

        $records = History::where('seller_id', $seller->id)
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                            // ->where('quantity' , '>', 0)
                             ->orderBy('created_at', 'DESC')
                             ->get();
        $sub1_mono_kilo = 0;
        $sub2_mono_kilo = 0;
        $sub3_mono_kilo = 0;

        foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                  if ($record->product->subcategory->category->id == $category1->id) {
                    $sub1_mono_kilo += $record->product->weight * $record->quantity;
                  }
                  if ($record->product->subcategory->category->id == $category2->id) {
                    $sub2_mono_kilo += $record->product->weight * $record->quantity;

                  }
                  if ($record->product->subcategory->category->id == $category3->id) {
                    $sub3_mono_kilo += $record->product->weight * $record->quantity;
                  }
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                   if ($record->product->subcategory->category->id == $category1->id) {
                      $sub1_mono_kilo += $record->product->weight * $record->quantity;
                    }
                    if ($record->product->subcategory->category->id == $category2->id) {
                      $sub2_mono_kilo += $record->product->weight * $record->quantity;

                    }
                    if ($record->product->subcategory->category->id == $category3->id) {
                      $sub3_mono_kilo += $record->product->weight * $record->quantity;
                    }
              }
          }
        }

        $soldprods3 = array();
        $repeat = array();

        foreach($unique as $key => $value)
        {
            if (in_array($value, $repeat))
            {
                continue;
            }
            else
            {
                $soldprodss = History::where('seller_id', $seller->id)
                                   ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                         ->where('product_id', $value)
                         ->where('created_at', '>=', $date_from)
                         ->where('created_at', '<=', $date_to)
                        // ->where('quantity' , '>', 0)
                         ->orderBy('created_at', 'DESC')
                         //->paginate(10);
                         ->first();

             $sumquantity = History::where('seller_id', $seller->id)
                       ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('quantity');

             $records = History::where('seller_id', $seller->id)
                         ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
                                   ->where('product_id', $value)
                                   // ->where('user_id', null)
                                   //->orWhere('user_id', 0)
                                   // orWhere('user_id', 1)
                                   ->where('created_at', '>=', $date_from)
                                   ->where('created_at', '<=', $date_to)
                                   ->get();
$prod_total = 0;
              foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                    $prod_total += $record->product->weight * $record->quantity;
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                $prod_total += $record->product->weight * $record->quantity;
              }
          }
        }

             $sumprice = History::where('seller_id', $seller->id)
                 ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                              ->where('order_status' , '!=', 'delivered')
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('price');

                   $soldprodss['sumquantity'] = $sumquantity;
                   $soldprodss['sumprice'] = $sumprice;
                   $soldprodss['prod_total'] = $prod_total;

                   array_push($repeat, $value);
                   array_push($soldprods3, $soldprodss);
            }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($soldprods3);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
     //   return view('owner_dashboard.quantity.lessThree', ['rare_products' => $paginatedItems, 'search_index' => $search_index]);

       return view('owner_dashboard.sellers.seller_history_by_kilo', [
        'soldprods' => $soldprods,
       // 'count' => $count,
        'seller' => $seller,
        'from' => $from,
        'to' => $to,
       // 'count_products' => $count_products,
       // 'count_orders_purchased' => $count_orders_purchased,
       // 'count_orders_refunded' => $count_orders_refunded,
       // 'count_checkout' => $count_checkout,
        'unique' => $unique,
        'soldprods3' => $paginatedItems,
        'cat1' => $cat1,
        'cat2' => $cat2,
        'cat3' => $cat3,
        'category1' => $category1,
        'category2' => $category2,
        'category3' => $category3,
        'sub1_mono_kilo'  => $sub1_mono_kilo,
        'sub2_mono_kilo'  => $sub2_mono_kilo,
        'sub3_mono_kilo' => $sub3_mono_kilo,
        ]);

       //return view('owner_dashboard.sellers.seller_history_by_kilo', compact('soldprods', 'count', 'seller', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout'));
    }

    public function all_sellers_report(Request $request)
    {
       ini_set("memory_limit",-1);
     // $all_sellers = History::select('seller_id')->get();
    //  return $all_sellers->unique('seller_id');
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
    //    $count_price  = History::where('created_at', '>=', $date_from)
      //                                    ->where('created_at', '<=', $date_to)
       //                                   ->sum('price');

        $records  = History::where('seller_id', '!=', null)
                           ->where('created_at', '>=', $date_from)
                           ->where('created_at', '<=', $date_to)
                           ->get();
// return $records;
        $unique_sellers = array();
        $repeated      = array();

        foreach ($records as $record)
        {
           $wholesale_price = 0;

           if (in_array($record->seller_id, $repeated)) {
             continue;
           }
           else{
            $seller_price = History::where('seller_id', $record->seller_id)
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->sum('price');

            $all_users = History::where('seller_id', $record->seller_id)
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();
          // return $all_users;
            foreach ($all_users as $user)
            {
                if ($user->user_id == null || $user->user_id == 0)
                {
                  continue;
                }
                else
                {
                      $client = User::withTrashed()->where('id', $user->user_id)->first();
                      if ($client->usertype_id != 1)
                      {
                        $wholesale_price += $user->price;
                      }
                 }

            }

           // return $wholesale_price;
            $seller = Seller::where('id', $record->seller_id)->first();
            // dd($record);
            $seller_name = $seller ? $seller->name : NULL;
            array_push($unique_sellers, [
                                      'seller_name' => $seller_name,
                                      'store_name' => $seller ? $seller->store->name : NULL,
                                      'seller_price' => $seller_price,
                                      'wholesale_price' => $wholesale_price,
                                    ]);
            array_push($repeated, $record->seller_id);
           }
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($unique_sellers);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

    return view('owner_dashboard.sellers.allsellers_report', ['from' => $from, 'to' => $to, 'unique_sellers' => $paginatedItems]);
    }

    public function all_sellers_report_differentstores(Request $request)
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

     $histories = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->where('order_status', '!=', 'delivered')
                          ->where('created_at', '>=', $date_from)
                          ->where('created_at', '<=', $date_to)
                          ->select('store_id', 'seller_id', 'price') // 'quantity')
                          ->get();
     // $records   = $histories->groupBy(['seller_id', 'store_id']);
     $unique_sellers = array();
     foreach ($histories as $history) 
     {
           if (in_array([
            'seller_id' => $history->seller_id,
            'store_id'  => $history->store_id,
           ], $unique_sellers)) {
               continue;
           }
           else{
              array_push($unique_sellers, [
                'seller_id' => $history->seller_id,
                'store_id'  => $history->store_id,
              ]);
           }
       }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($unique_sellers);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

    return view('owner_dashboard.sellers.all_sellers_report_differentstores', ['from' => $from, 'to' => $to, 'unique_sellers' => $paginatedItems]);
    }

    public function all_sellers_bykilo_report(Request $request)
    {
       set_time_limit(0);
      // ini_set('max_execution_time', 0);
       ini_set("memory_limit",-1);

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


        $category1  = Category::find(1);
        $category2  = Category::find(2);
        $category3  = Category::find(3);

        $unique_sellers  = array();
        $repeated        = array();
        $qty             = 0;
        $cat1_mono       = 0;
        $cat2_mono       = 0;
        $cat3_mono       = 0;
        $cat1_wholesale  = 0;
        $cat2_wholesale  = 0;
        $cat3_wholesale  = 0;

        $records = History::where('seller_id', '!=', null)
                          ->where('created_at', '>=', $date_from)
                          ->where('created_at', '<=', $date_to)
                          ->orderBy('created_at', 'DESC')
                          ->get();

        foreach ($records as $record)
        {
           if (in_array($record->seller_id, $repeated)) {
             continue;
           }
           else{
            $soldprods = History::where('seller_id', $record->seller_id)
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();


            $seller = Seller::where('id', $record->seller_id)->first();
            $seller_name = $seller->name;

            foreach($soldprods as $prod)
            {
              $product = Product::where('id', $prod->product_id)->first();
              $qty += $product->weight * $prod->quantity;
              if($prod->user_id == null || $prod->user_id == 0)
              {
                    if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_mono += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_mono += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_mono += $prod->product->weight * $prod->quantity;
                    }
              }
              else
              {
                $thisuser_id = $prod->user_id;
                $this_user = User::select('id', 'name', 'phone', 'usertype_id')->where('id', $thisuser_id)->first();
                if ($this_user->usertype_id == 1)
                {
                     if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_mono += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_mono += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_mono += $prod->product->weight * $prod->quantity;
                    }
                }
                else
                {
                     if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_wholesale += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_wholesale += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_wholesale += $prod->product->weight * $prod->quantity;
                    }
                }
              }
            }
            array_push($unique_sellers, [
                                      'seller_name' => $seller_name,
                                      'store_name' => $seller->store->name,
                                      'totalsold_bykilo' => $qty,
                                      'cat1_mono' => $cat1_mono,
                                      'cat2_mono' => $cat2_mono,
                                      'cat3_mono' => $cat3_mono,
                                      'cat1_wholesale' => $cat1_wholesale,
                                      'cat2_wholesale' => $cat2_wholesale,
                                      'cat3_wholesale' => $cat3_wholesale,
                                     // 'wholesale_price' => $wholesale_price,
                                    ]);
            array_push($repeated, $record->seller_id);
           }
      }
/*
        $records = History::where('seller_id', $seller->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                            // ->where('quantity' , '>', 0)
                             ->orderBy('created_at', 'DESC')
                             ->get();
        $sub1_mono_kilo = 0;
        $sub2_mono_kilo = 0;
        $sub3_mono_kilo = 0;

        foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                  if ($record->product->subcategory->id == $subcategory1->id) {
                    $sub1_mono_kilo += $record->product->weight * $record->quantity;
                  }
                  if ($record->product->subcategory->id == $subcategory2->id) {
                    $sub2_mono_kilo += $record->product->weight * $record->quantity;

                  }
                  if ($record->product->subcategory->id == $subcategory3->id) {
                    $sub3_mono_kilo += $record->product->weight * $record->quantity;
                  }
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                   if ($record->product->subcategory->id == $subcategory1->id) {
                      $sub1_mono_kilo += $record->product->weight * $record->quantity;
                    }
                    if ($record->product->subcategory->id == $subcategory2->id) {
                      $sub2_mono_kilo += $record->product->weight * $record->quantity;

                    }
                    if ($record->product->subcategory->id == $subcategory3->id) {
                      $sub3_mono_kilo += $record->product->weight * $record->quantity;
                    }
              }
          }
        }

        $soldprods3 = array();
        $repeat = array();

        foreach($unique as $key => $value)
        {
            if (in_array($value, $repeat))
            {
                continue;
            }
            else
            {
                $soldprodss = History::where('seller_id', $seller->id)
                         ->where('product_id', $value)
                         ->where('created_at', '>=', $date_from)
                         ->where('created_at', '<=', $date_to)
                        // ->where('quantity' , '>', 0)
                         ->orderBy('created_at', 'DESC')
                         //->paginate(10);
                         ->first();

             $sumquantity = History::where('seller_id', $seller->id)
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('quantity');

             $records = History::where('seller_id', $seller->id)
                                   ->where('product_id', $value)
                                   // ->where('user_id', null)
                                   //->orWhere('user_id', 0)
                                   // orWhere('user_id', 1)
                                   ->where('created_at', '>=', $date_from)
                                   ->where('created_at', '<=', $date_to)
                                   ->get();
$prod_total = 0;
              foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                    $prod_total += $record->product->weight * $record->quantity;
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                $prod_total += $record->product->weight * $record->quantity;
              }
          }
        }

             $sumprice = History::where('seller_id', $seller->id)
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('price');

                   $soldprodss['sumquantity'] = $sumquantity;
                   $soldprodss['sumprice'] = $sumprice;
                   $soldprodss['prod_total'] = $prod_total;

                   array_push($repeat, $value);
                   array_push($soldprods3, $soldprodss);
            }
        }
   */
      // return view('owner_dashboard.sellers.seller_history_by_kilo', compact('soldprods', 'count', 'seller', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout', 'unique', 'soldprods3', 'subcat1', 'subcat2', 'subcat3', 'subcategory1', 'subcategory2', 'subcategory3', 'sub1_mono_kilo', 'sub2_mono_kilo', 'sub3_mono_kilo'));
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($unique_sellers);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

     return view('owner_dashboard.sellers.all_sellers_bykilo_report', ['from' => $from, 'to' => $to, 'unique_sellers' => $paginatedItems, 'category1' => $category1, 'category2' => $category2, 'category3' => $category3]);
    }

    public function all_sellers_bykilo_report_differentstores(Request $request)
    {
       set_time_limit(0);
      // ini_set('max_execution_time', 0);
       ini_set("memory_limit",-1);

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

       $records = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->where('order_status', '!=', 'delivered')
                          ->select('seller_id', 'store_id', 'price')
                          ->get();

      $sellers = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                           ->where('order_status', '!=', 'delivered')
                          ->select('seller_id')
                          ->get();

      $sellers   =  $sellers->unique('seller_id');
      $unique_sellers = array();

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
                            array_push($unique_sellers, [
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

        $category1  = Category::find(1);
        $category2  = Category::find(2);
        $category3  = Category::find(3);

       /// $unique_sellers  = array();
        $repeated        = array();
        $qty             = 0;
        $cat1_mono       = 0;
        $cat2_mono       = 0;
        $cat3_mono       = 0;
        $cat1_wholesale  = 0;
        $cat2_wholesale  = 0;
        $cat3_wholesale  = 0;

    /*    $records = History::where('seller_id', '!=', null)
                          ->where('created_at', '>=', $date_from)
                          ->where('created_at', '<=', $date_to)
                          ->orderBy('created_at', 'DESC')
                          ->get();

        foreach ($records as $record)
        {
           if (in_array($record->seller_id, $repeated)) {
             continue;
           }
           else{
            $soldprods = History::where('seller_id', $record->seller_id)
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();


            $seller = Seller::where('id', $record->seller_id)->first();
            $seller_name = $seller->name;

            foreach($soldprods as $prod)
            {
              $product = Product::where('id', $prod->product_id)->first();
              $qty += $product->weight * $prod->quantity;
              if($prod->user_id == null || $prod->user_id == 0)
              {
                    if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_mono += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_mono += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_mono += $prod->product->weight * $prod->quantity;
                    }
              }
              else
              {
                $thisuser_id = $prod->user_id;
                $this_user = User::select('id', 'name', 'phone', 'usertype_id')->where('id', $thisuser_id)->first();
                if ($this_user->usertype_id == 1)
                {
                     if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_mono += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_mono += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_mono += $prod->product->weight * $prod->quantity;
                    }
                }
                else
                {
                     if ($prod->product->subcategory->category_id == 1)
                    {
                        $cat1_wholesale += $prod->product->weight * $prod->quantity;
                    }
                    elseif($prod->product->subcategory->category_id == 2) {
                        $cat2_wholesale += $prod->product->weight * $prod->quantity;
                    }
                    else{
                        $cat3_wholesale += $prod->product->weight * $prod->quantity;
                    }
                }
              }
            }
            array_push($unique_sellers, [
                                      'seller_name' => $seller_name,
                                      'store_name' => $seller->store->name,
                                      'totalsold_bykilo' => $qty,
                                      'cat1_mono' => $cat1_mono,
                                      'cat2_mono' => $cat2_mono,
                                      'cat3_mono' => $cat3_mono,
                                      'cat1_wholesale' => $cat1_wholesale,
                                      'cat2_wholesale' => $cat2_wholesale,
                                      'cat3_wholesale' => $cat3_wholesale,
                                     // 'wholesale_price' => $wholesale_price,
                                    ]);
            array_push($repeated, $record->seller_id);
           }
      }*/

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($unique_sellers);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

     return view('owner_dashboard.sellers.all_sellers_bykilo_report_differentstores', ['from' => $from, 'to' => $to, 'unique_sellers' => $paginatedItems, 'category1' => $category1, 'category2' => $category2, 'category3' => $category3]);
    }


    public function all_sellers_bykilo_report2(Request $request)
    {
        if (!isset($request->from) && !isset($request->to))
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

         $soldprods = History::where('seller_id', $seller->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                            // ->where('quantity' , '>', 0)
                             ->orderBy('created_at', 'DESC')
                             ->get();
                             //->paginate(10);
        $unique = array();
        $subs   = array();

        foreach($soldprods as $prod)
        {
            if (in_array($prod->product->id, $unique))
            {
                continue;
            }
            array_push($unique, $prod->product_id);
        }

        $cat1  = 0;
        $cat2  = 0;
        $cat3  = 0;

        $category1  = Category::find(1);
        $category2  = Category::find(2);
        $category3  = Category::find(3);

        foreach($soldprods as $prod)
        {
            if ($prod->product->subcategory->category_id == 1)
            {
                $cat1 += $prod->product->weight * $prod->quantity;
            }
            elseif($prod->product->subcategory->category_id == 2) {
                $cat2 += $prod->product->weight * $prod->quantity;
            }
            else{
                $cat3 += $prod->product->weight * $prod->quantity;
            }
        }

        $records = History::where('seller_id', $seller->id)
                             ->where('created_at', '>=', $date_from)
                             ->where('created_at', '<=', $date_to)
                            // ->where('quantity' , '>', 0)
                             ->orderBy('created_at', 'DESC')
                             ->get();
        $sub1_mono_kilo = 0;
        $sub2_mono_kilo = 0;
        $sub3_mono_kilo = 0;

        foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                  if ($record->product->subcategory->category->id == $category1->id) {
                    $sub1_mono_kilo += $record->product->weight * $record->quantity;
                  }
                  if ($record->product->subcategory->category->id == $category2->id) {
                    $sub2_mono_kilo += $record->product->weight * $record->quantity;

                  }
                  if ($record->product->subcategory->category->id == $category3->id) {
                    $sub3_mono_kilo += $record->product->weight * $record->quantity;
                  }
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                   if ($record->product->subcategory->category->id == $category1->id) {
                      $sub1_mono_kilo += $record->product->weight * $record->quantity;
                    }
                    if ($record->product->subcategory->category->id == $category2->id) {
                      $sub2_mono_kilo += $record->product->weight * $record->quantity;

                    }
                    if ($record->product->subcategory->category->id == $category3->id) {
                      $sub3_mono_kilo += $record->product->weight * $record->quantity;
                    }
              }
          }
        }

        $soldprods3 = array();
        $repeat = array();

        foreach($unique as $key => $value)
        {
            if (in_array($value, $repeat))
            {
                continue;
            }
            else
            {
                $soldprodss = History::where('seller_id', $seller->id)
                         ->where('product_id', $value)
                         ->where('created_at', '>=', $date_from)
                         ->where('created_at', '<=', $date_to)
                        // ->where('quantity' , '>', 0)
                         ->orderBy('created_at', 'DESC')
                         //->paginate(10);
                         ->first();

             $sumquantity = History::where('seller_id', $seller->id)
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('quantity');

             $records = History::where('seller_id', $seller->id)
                                   ->where('product_id', $value)
                                   // ->where('user_id', null)
                                   //->orWhere('user_id', 0)
                                   // orWhere('user_id', 1)
                                   ->where('created_at', '>=', $date_from)
                                   ->where('created_at', '<=', $date_to)
                                   ->get();
$prod_total = 0;
              foreach ($records as $record)
        {
            $user_id = $record->user_id;
            if ($user_id == null || $user_id == 0) {
                    $prod_total += $record->product->weight * $record->quantity;
            }
          else
          {
              $user = User::where('id', $user_id)->first();
              if ($user->usertype_id == 1)
              {
                $prod_total += $record->product->weight * $record->quantity;
              }
          }
        }

             $sumprice = History::where('seller_id', $seller->id)
             ->where('product_id', $value)
             ->where('created_at', '>=', $date_from)
             ->where('created_at', '<=', $date_to)
             // ->where('quantity' , '>', 0)
             ->sum('price');

                   $soldprodss['sumquantity'] = $sumquantity;
                   $soldprodss['sumprice'] = $sumprice;
                   $soldprodss['prod_total'] = $prod_total;

                   array_push($repeat, $value);
                   array_push($soldprods3, $soldprodss);
            }
        }

       return view('owner_dashboard.sellers.seller_history_by_kilo', compact('soldprods', 'count', 'seller', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout', 'unique', 'soldprods3', 'cat1', 'cat2', 'cat3', 'category1', 'category2', 'category3', 'sub1_mono_kilo', 'sub2_mono_kilo', 'sub3_mono_kilo'));

    }


    /*========================================
        generate sellers in excel sheet
    ==========================================*/
    public function excel()
    {
      return Excel::download(new SellersExport(), 'sellers.xlsx');
    }
    /*========================================
        generate sellers in excel sheet
    ==========================================*/
    public function reports_excel(Request $request)
    {
       set_time_limit(0);
       ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
        
      return Excel::download(new SellerReportsExport($from, $to), 'sellers_reports.xlsx');
    }

    public function allSellersKilo_excel(Request $request)
    {
       set_time_limit(0);
       ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
        // return $from;
      return Excel::download(new allSellersKiloExport($from, $to), 'allSellersKiloExport.xlsx');
    }

}


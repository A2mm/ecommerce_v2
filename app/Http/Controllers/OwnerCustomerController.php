<?php

namespace App\Http\Controllers;

use App\Country;
use App\User;
use App\Usertype;
use App\Order;
use App\History;
use App\Purchase;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Exports\CustomersExport;
use App\Exports\CustomerDetailsExport;
use App\Exports\CustomersReportsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exports\AllCustomersExport;

class OwnerCustomerController extends Controller
{
    public function getShowAll(Request $request)
    {
        if (!$request->has('usertype_id') && !$request->has('search_index'))
        {
          $type          = null;
          $search_index  = null;
        }
        else
        {
          $type          = trim($request->usertype_id);
          $search_index  = trim($request->search_index);
        }

        if($type == null && $search_index == null)
        {
           $customers = User::where('role', 'user')->withTrashed()->paginate(10);
        }
            /*$this->validate($request, [
                'usertype_id' => 'required|exists:usertypes',
            ]);*/
        elseif($type != null && $search_index == null)
        {
          $customers   = User::where('role', 'user')
                                   ->where('usertype_id', $type)
                                   ->paginate(10);
        }
        elseif($type == null && $search_index != null)
        {
          $customers   = User::where('role', 'user')
                                  ->where('name', 'LIKE', "%{$search_index}%")
                                  ->orWhere('phone', 'LIKE', "%{$search_index}%")
                                  ->paginate(10);
        }
        else
        {
          /*$customers = User::where('role', 'user')
                                   ->where('usertype_id', $type);
          $one = $customers->where('name', 'LIKE', "%{$search_index}%")->count();
          if ($one > 0) {
             $customers = $customers->where('name', 'LIKE', "%{$search_index}%")->paginate(10);
          }
          if($one == 0) {
             $customers = $customers->where('phone', 'LIKE', "%{$search_index}%")->paginate(10);
          }*/

          $customers = User::where('role', 'user')
                           ->where('usertype_id', $type)
                           ->where('name', 'LIKE', "%{$search_index}%")
                           ->paginate(10);
          if (count($customers) < 1) {
             $customers = User::where('role', 'user')
                           ->where('usertype_id', $type)
                           ->where('phone', 'LIKE', "%{$search_index}%")
                           ->paginate(10);
          }
        }
        $usertypes = Usertype::get();
        return view('owner_dashboard.customers.all', compact('customers', 'type', 'usertypes', 'search_index'));
    }

    public function view_customer_profile($id)
    {
      $customer = User::find($id);
      if (!$customer) {
        return redirect()->back()->withErrors(__('translations.customer_not_found'));
      }
      return view('owner_dashboard.customers.view', compact('customer'));
    }

    public function getCreate()
    {
        $usertypes = Usertype::select('id', 'name')->get();
        return view('owner_dashboard.customers.create', compact('usertypes', 'countries'));
    }

    public function postCreate(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required|regex:/^[\p{L} ]+$/u|min:3|max:50',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|max:30',
            'phone'       => 'required|unique:users,phone|size:11|regex:/(01)[0-9]{9}/',
            'usertype_id' => 'required|exists:usertypes,id',
            'image'       => 'nullable|file|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        /*   $name = $request->name;
           if (!preg_match("/^[\p{L} ]+$/u",$name)) {
               return redirect()->back()->withErrors(__('translations.Only_letters_and_white_space_allowed'));
           }
*/
        $client = [
            'name'        => $request['name'],
            'email'       => $request['email'],
            'password'    => bcrypt($request['password']),
            'phone'       => $request['phone'],
            'usertype_id' => $request['usertype_id'],
            'api_token'   => str_random(30),
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
            $destinationPath = public_path() . '/clients/images/';
            $request->file('image')->move($destinationPath, $picture);
            $client['image'] = $picture;
        }

        $result = User::create($client);
        if ($result)
        {
            return redirect()->route('manage.customers.all')->withMessage(__('translations.customer_created_successfuly'));
        }
    }

    public function getEditCustomer($id)
    {
        $usertypes = Usertype::get();
        $customer  = User::find($id);
        if (!$customer)
        {
            return redirect()->route('manage.customers.all')->withErrors(__('translations.customer_not_found'));
        }
        else
        {
            return view('owner_dashboard.customers.edit', compact('usertypes', 'customer'));
        }
    }

    public function get_usertype_history(Request $request)
    {
        $usertype  = Usertype::where('id', $request->usertype_id)->first();
        $usertypes = Usertype::all();
        $id = $usertype->id;


        return view('owner_dashboard.customers.usertpe_history', compact('id', 'usertypes'));
    }

    public function postEditCustomer(Request $request, $id)
    {
        $customer = User::find($id);
        if (!$customer) {
             return redirect()->back()->withErrors('customer not found');
        }
        $this->validate($request, [
            'name'        => 'required|regex:/^[\p{L} ]+$/u|min:3|max:50',
            'phone' => 'required|size:11|regex:/(01)[0-9]{9}/|unique:users,phone,'.$customer->id,
            'image' => 'file|image|mimes:jpeg,png,jpg,gif,svg',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'password' => 'min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|max:30'
        ]);

        $client = [
            'name'         => $request['name'],
            'phone'        => $request['phone'],
            'email'        => $request['email'],
            'usertype_id'  => $request['usertype_id'],
        ];

        if (isset($request->password) && $request->password != '') {
            
             $client['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $picture = sha1($filename . time()) . '.' . $extension;
            $destinationPath = public_path() . '/clients/images/';
            $request->file('image')->move($destinationPath, $picture);
            $client['image'] = $picture;
        }
        if ($customer) {
            $customer->update($client);

            return redirect()->route('manage.customers.all')->withMessage(__('translations.customer_updated_successfuly'));
        }
        abort(404);
    }

    public function getBlockCustomer($id)
    {
        $customer = User::find($id);
        if ($customer) {
           // $customer->orders()->delete();
            $customer->update(['suspend' => 1]);
            return redirect()->route('manage.customers.all')->withMessage(__('translations.customer_blocked_successfuly'));
        }
        abort(404);
    }

    public function getUnBlockCustomer($id)
    {
        $customer = User::withTrashed()->where('id', $id)->first();
        if ($customer) {
           // $now = Carbon::now();
           // $customer->update(['deleted_at' => null]);
             $customer->update(['suspend' => 0]);
           // if ($customer->save()) {
                return redirect()->route('manage.customers.all')->withMessage(__('translations.customer_unblocked_successfuly'));
          //  }

        }
        abort(404);
    }

    public function getDeleteCustomer($id)
    {
        $customer = User::find($id);
         if (!$customer)
         {
            return redirect()->route('manage.customers.all')->withErrors(__('translations.customer_not_found'));
         }
        if ($customer)
        {
            $customer->orders()->delete();
            $customer->forceDelete();
            return redirect()->route('manage.customers.all')->withMessage(__('translations.customer_deleted_successfuly'));
        }
    }

    public function all_customers_report(Request $request)
    {
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

        $records  = History::where('user_id', '>', 0)
                            // ->where('order_status' , '!=', 'in progress')
                            // ->where('order_status' , '!=', 'pending')
                           //  ->where('order_status' , '!=', 'canceled')
                          ->where('created_at', '>=', $date_from)
                          ->where('created_at', '<=', $date_to)
                          ->get();

        $unique_users  = array();
        $repeated      = array();

        foreach ($records as $record)
        {
           $sumWeight     = 0;
           $total_price   = 0;

           if (in_array($record->user_id, $repeated)) {
             continue;
           }
           else{
            $client = User::withTrashed()->select('id', 'name', 'phone', 'usertype_id')
                          ->where('id', $record->user_id)->first();

            $user_price = History::where('user_id', $record->user_id)
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->sum('price');

            $userHistories = History::where('user_id', $record->user_id)
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->where('created_at', '>=', $date_from)
                                  ->where('created_at', '<=', $date_to)
                                  ->get();
            foreach ($userHistories as $userHistory) 
            {
              $sumWeight += $userHistory->product->weight * $userHistory->quantity; 
            }

            $count_purchases_shipments = History::where('user_id', $record->user_id)
                                 ->where('price', '>', 0)
                                 ->where('order_status' , 'delivered')
                                 ->where('order_status' , '!=', 'pending')
                                 ->where('order_status' , '!=', 'in progress')
                                 ->where('order_status' , '!=', 'canceled')
                                 ->where('created_at', '>=', $date_from)
                                 ->where('created_at', '<=', $date_to)
                                 ->get();

        $purchases_shipments       = $count_purchases_shipments->pluck('purchase_id');
        // $count_purchases_shipments = count($count_purchases_shipments->unique('purchase_id'));
        $sum_purchases_shipments   = Purchase::whereIn('id', $purchases_shipments)->sum('shipment');


              array_push($unique_users, [
                                      'user_name'  => $client->name,
                                      'user_phone' => $client->phone,
                                      'usertype'   => $client->usertype->name,
                                      'total'      => $user_price,
                                      'sum_purchases_shipments' => $sum_purchases_shipments,
                                      'sumWeight' => $sumWeight,
                                    ]);
            }
            array_push($repeated, $record->user_id);
        }

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($unique_users);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

    return view('owner_dashboard.customers.all_customers_report', ['from' => $from, 'to' => $to, 'unique_users' => $paginatedItems]);
    }

    public function getDetails(Request $request, $id)
    {
        $customer  = User::find($id);
        if (!$customer)
         {
            return redirect()->route('manage.customers.all')->withErrors(__('translations.customer_not_found'));
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

        $orders = History::where('user_id', $customer->id)
                                      ->where('order_status' , '!=', 'in progress')
                                      ->where('order_status' , '!=', 'pending')
                                      ->where('order_status' , '!=', 'canceled')
                                      ->where('created_at', '>=', $date_from)
                                      ->where('created_at', '<=', $date_to)
                                      ->orderBy('created_at', 'DESC')
                                      ->paginate(10);

        $count_checkout = History::where('user_id', $customer->id)
                                        ->where('order_status' , '!=', 'in progress')
                                        ->where('order_status' , '!=', 'pending')
                                        ->where('order_status' , '!=', 'canceled')
                                        ->where('created_at', '>=', $date_from)
                                        ->where('created_at', '<=', $date_to)
                                        ->sum('price');

        $count_orders_purchased  = History::where('user_id', $customer->id)
                                           ->where('order_status' , '!=', 'in progress')
                                           ->where('order_status' , '!=', 'pending')
                                           ->where('order_status' , '!=', 'canceled')
                                          ->where('price', '>', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->groupBy('product_id')
                                          ->count();

        $count_purchases_shipments = History::where('price', '>', 0)
                                          ->where('user_id', $customer->id)
                                          ->where('order_status' , 'delivered')
                                          ->where('order_status' , '!=', 'in progress')
                                          ->where('order_status' , '!=', 'pending')
                                          ->where('order_status' , '!=', 'canceled')
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->get();

        $purchases_shipments       = $count_purchases_shipments->pluck('purchase_id');
        $count_purchases_shipments = count($count_purchases_shipments->unique('purchase_id'));
        $sum_purchases_shipments   = Purchase::whereIn('id', $purchases_shipments)->sum('shipment');

        $count_orders_refunded   = History::where('user_id', $customer->id)
                                           ->where('order_status' , '!=', 'in progress')
                                           ->where('order_status' , '!=', 'pending')
                                           ->where('order_status' , '!=', 'canceled')
                                          ->where('price', '<', 0)
                                          ->where('created_at', '>=', $date_from)
                                          ->where('created_at', '<=', $date_to)
                                          ->count();

        $count_products = History::where('user_id', $customer->id)
                                    ->where('order_status' , '!=', 'in progress')
                                    ->where('order_status' , '!=', 'pending')
                                    ->where('order_status' , '!=', 'canceled')
                                    ->where('created_at', '>=', $date_from)
                                    ->where('created_at', '<=', $date_to)
                                    ->sum('quantity');

        return view('owner_dashboard.customers.details', compact('customer', 'orders', 'from', 'to', 'count_products', 'count_orders_purchased', 'count_orders_refunded', 'count_checkout', 'count_purchases_shipments', 'sum_purchases_shipments', 'purchases_shipments'));
    }

    public function delete_order($id)
    {
        $order = DB::table('orders')->where('id', $id);
        if (!$order)
        {
            return redirect()->route('manage.customers.all')->withErrors(__('translations.order_not_found'));
        }
        $order->delete();
        return redirect()->back()->withMessage(__('translations.order_deleted_successfully'));
    }

    /*========================================
        generate customers in excel sheet
    ==========================================*/
    public function excel()
    {
      return Excel::download(new CustomersExport(), 'customers.xlsx');
    }
    /*========================================
        generate customers in excel sheet
    ==========================================*/
    public function details_excel(Request $request)
    {
       set_time_limit(0);
       ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
        $id   = $request->id;
        
      return Excel::download(new CustomerDetailsExport($id, $from, $to), 'customer_details.xlsx');      
    }

    /*========================================
      generate customers reports in excel sheet
    ==========================================*/
    public function reports_excel()
    {
      return Excel::download(new CustomersReportsExport(), 'customers-reports.xlsx');
    }

    public function ahmed(Request $request)
    {
       set_time_limit(0);
      ini_set("memory_limit",-1);

        $from = $request->from.' 00:00:00';
        $to   = $request->to. ' 23:59:59';
      return Excel::download(new AllCustomersExport($from, $to), 'AllCustomers.xlsx');
    }

}

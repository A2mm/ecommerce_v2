<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;
use App\History;
use App\User;

class CustomerDetailsExport implements FromView
{
     /**
    * @return \Illuminate\Support\Collection
    */

    protected $from;
    protected $to;
    protected $id;

    public function __construct($id, $from, $to) 
   {
      $this->id   = $id;
      $this->from = $from;
      $this->to   = $to;
      return $this;
   }

  public function view(): View
  {
        $customer  = User::find($this->id);
        $orders    = History::where('user_id', $customer->id)
                                      ->where('order_status' , '!=', 'in progress')
                                      ->where('order_status' , '!=', 'pending')
                                      ->where('order_status' , '!=', 'canceled')
                                      ->where('created_at', '>=', $this->from)
                                      ->where('created_at', '<=', $this->to)
                                      ->orderBy('created_at', 'DESC')
                                      ->get();

        return view('owner_dashboard.customers.CustomerDetailsExport', compact('customer', 'orders'));
    }
}

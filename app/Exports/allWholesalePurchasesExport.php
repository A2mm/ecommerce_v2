<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\User;

class allWholesalePurchasesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $from;
    protected $to;

  public function __construct($from, $to) 
 {
 	  $this->from = $from;
    $this->to   = $to;
    return $this;
 }

    public function view(): View
    {
 
         $wholesale_purchases = array();
         $purchases = History::where('store_id', '!=' , null)->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->orderBy('created_at', 'DESC')
                             ->get();

        $count_price = History::where('store_id', '!=' , null)->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
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
                                     ->get();
                        //   return $needed_purchases;

    return view('owner_dashboard.purchases.allWholesalePurchasesExport', compact('needed_purchases', 'wholesale_price', 'count_price'));
    }
}

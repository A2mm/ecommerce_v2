<?php

namespace App\Exports;

use App\Seller;
use App\History;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class SellerReportsExport implements FromView
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
        $histories = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->where('created_at', '>=', $this->from)
                          ->where('created_at', '<=', $this->to)
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
       $fromExcel =  $this->from;
       $toExcel   =  $this->to;
    return view('owner_dashboard.sellers.reports_excel', compact('unique_sellers', 'fromExcel', 'toExcel'));
  }
}

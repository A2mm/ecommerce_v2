<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
// use App\ProductStoreQuantity;
use App\History; 
use App\Category; 
use App\User; 
use App\Seller; 
use App\Product; 


class allSellersKiloExport implements FromView
{
   // protected $id;
     protected $from;
     protected $to;
    // protected $search_index;

  public function __construct($from, $to) 
 {
 	// $this->id = $id;
 	$this->from = $from;
 	$this->to   = $to;
    // $this->search_index   = $search_index;
    return $this;
 }

    public function view(): View
    {
        
       set_time_limit(0);
       ini_set("memory_limit",-1);

       $records = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->where('created_at', '>=', $this->from)
                          ->where('created_at', '<=', $this->to)
                          ->select('seller_id', 'store_id', 'price')
                          ->get();

      $sellers = History::where('seller_id', '>', 0)
                          ->where('order_status', '!=', 'pending')
                          ->where('order_status', '!=', 'in progress')
                          ->where('order_status', '!=', 'canceled')
                          ->where('created_at', '>=', $this->from)
                          ->where('created_at', '<=', $this->to)
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
    
    $fromExcel =  $this->from;
    $toExcel   =  $this->to;

     return view('owner_dashboard.sellers.allSellersKiloExport', compact('unique_sellers', 'category1', 'category2', 'category3', 'fromExcel', 'toExcel'));
    }
}

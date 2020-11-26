<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\ProductStoreQuantity;

class allStoresShipedOrdersExport implements FromView
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
      $items = ProductStoreQuantity::where('shiporder_id', '!=', 1)
                                 ->where('created_at', '>=', $this->from)
                                 ->where('created_at', '<=', $this->to)
                                 ->orderBy('created_at', 'desc')
                                 ->get();

    return view('owner_dashboard.stores.allStoresShipedOrdersExport', compact('items'));
    }
}

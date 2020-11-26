<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\ProductStoreQuantity;

class allStoresRefundsExport implements FromView
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
    	$storesRefunds = ProductStoreQuantity::where('refund_id', '!=', null)
    	                                     ->where('created_at', '>=', $this->from)
                                             ->where('created_at', '<=', $this->to)
                                             ->orderBy('created_at', 'DESC')
                                             ->get();

      return view('owner_dashboard.stores.allStoresRefundsExport', compact('storesRefunds'));
    }
}

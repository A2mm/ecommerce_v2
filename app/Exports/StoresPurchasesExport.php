<?php

namespace App\Exports;

use App\History;
use App\Store;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class StoresPurchasesExport implements FromView
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

       // all store price
        $count_price  = History::where('store_id', '>', 0)->where('created_at', '>=', $this->from)
                                          ->where('created_at', '<=', $this->to)
                                          ->sum('price');

        $records  = History::where('store_id', '>', 0)
                           ->where('created_at', '>=', $this->from)
                           ->where('created_at', '<=', $this->to)
                           ->get();

        $unique_stores = array();
        $repeated      = array();

        foreach ($records as $record)
        {
           if (in_array($record->store_id, $repeated)) {
             continue;
           }
           else{
            $store_price = History::where('store_id', $record->store_id)
                                  ->where('created_at', '>=', $this->from)
                                  ->where('created_at', '<=', $this->to)
                                  ->sum('price');

            $store = Store::where('id', $record->store_id)->first();
            // dd($store->name);
            $store_name = $store->name ?? NULL;
            array_push($unique_stores, ['store_name' => $store_name, 'store_price' => $store_price]);
            array_push($repeated, $record->store_id);
           }
        }

    return view('owner_dashboard.stores.StoresPurchasesExport', compact('count_price', 'unique_stores'));
  }
}

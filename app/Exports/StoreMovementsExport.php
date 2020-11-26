<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\User;
use App\Product;
use App\Store;
use App\ProductStoreQuantity;

class StoreMovementsExport implements FromView
{
    protected $id;
    protected $from;
    protected $to;
    protected $search_index;

  public function __construct($id, $from, $to, $search_index) 
 {
 	$this->id = $id;
 	$this->from = $from;
 	$this->to = $to;
    $this->search_index   = $search_index;
    return $this;
 }

    public function view(): View
    {
    	// $store = Store::find($this->id);
      $index = $this->search_index;
      if ($index == 'not') 
      {
         $movementss = ProductStoreQuantity::where('store_id', $this->id)
                                                ->where('quantity', '!=', 0)
                                                ->where('created_at', '>=', $this->from)
                                                ->where('created_at', '<=', $this->to)
                                                ->orderBy('created_at', 'DESC')
                                                ->get();
      }
      else
      {
               $movementss = ProductStoreQuantity::where('store_id', $this->id)
                                          ->where('quantity', '!=', 0)
                                          ->where('created_at', '>=', $this->from)
                                          ->where('created_at', '<=', $this->to)
                                          ->WhereHas('product', function($q) use($index)
                                                            {
                                                                $q->where('name', 'like', '%'.$index.'%');
                                                            })
                                        // ->orderBy('created_at', 'DESC')
                                         ->get(); 
      }

        return view('owner_dashboard.stores.StoreMovementsExport', compact('movementss', 'store'));
    }
}

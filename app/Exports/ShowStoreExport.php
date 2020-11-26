<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\User;
use App\Product;
use App\Store;
use App\ProductStoreQuantity;

class ShowStoreExport implements FromView
{
    protected $id;
    // protected $from;
    // protected $to;
    protected $search_index;

  public function __construct($id, $search_index) 
 {
 	$this->id = $id;
 	//$this->from = $from;
 	//$this->to = $to;
    $this->search_index   = $search_index;
    return $this;
 }

    public function view(): View
    {
    	$store = Store::find($this->id);

        $index = $this->search_index;
        if ($index == 'not') 
        {
            $products = Product::where('archive', 0)->get();
        }
       
        else
        {
            $products = Product::where('archive', 0)->where('name', 'LIKE', '%'.$index.'%')
                                                       ->orWhere('unique_id', 'LIKE', '%'.$index.'%')
                                                        ->get();
        }
        return view('owner_dashboard.stores.ShowStoreExport', compact('products', 'store'));
    }
}

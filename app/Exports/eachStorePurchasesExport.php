<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
// use App\User;
use App\Store;

class eachStorePurchasesExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $id;
    protected $from;
    protected $to;


	public function __construct($id, $from, $to) 
	{
		$this->id   = $id;
	 	$this->from = $from;
	    $this->to   = $to;
	    return $this;
	}

    public function view(): View
    {
        $store     = Store::find($this->id);
        $histories = History::where('store_id', $this->id)
                             ->where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             ->where('order_status' , '!=', 'delivered')
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->orderBy('created_at', 'DESC')
                             ->get();

      return view('owner_dashboard.stores.eachStorePurchasesExport', compact('histories', 'store'));
    }
}

<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\User;

class allRefundsExport implements FromView
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
       $refunds = History::where('quantity', '<', 0)
                            ->where('created_at', '>=', $this->from)
                            ->where('created_at', '<=', $this->to)
                            ->orderBy('created_at', 'DESC')
                            ->get();
                            
        return view('owner_dashboard.products.allRefundsExport', compact('refunds'));   
    }
}

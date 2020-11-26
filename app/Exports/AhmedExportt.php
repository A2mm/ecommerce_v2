<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 

class AhmedExportt implements FromView
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
        // $this->from = $from;
        // $this->to   = $to;
 }

    public function view(): View
    {

    	$pur = History::where('order_status' , '!=', 'in progress')
                             ->where('order_status' , '!=', 'pending')
                             ->where('order_status' , '!=', 'canceled')
                             //->orderBy('created_at', 'DESC');
    	                    ->get();

    	$unique = array();

    	foreach ($pur as $p) 
    	{
    		if ($p->created_at >= $this->from) 
    		{
    			if ($p->created_at <= $this->to) 
    			{
    				if (in_array($p->id, $unique)) 
	    			{
	    			  continue;
	    			}
	    			else
	    			{
	    				array_push($unique, $p->id);
	    			}
    			}
	    			
    		}
    	}

    	$purchases = History::whereIn('id', $unique)
                            ->get(); 

    	return view('owner_dashboard.purchases.ahmed', compact('purchases'));
    }
}

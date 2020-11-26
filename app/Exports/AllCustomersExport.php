<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use App\History; 
use App\User;
use App\Purchase;

class AllCustomersExport implements FromView
{
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
    	/*
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
    	} */

    	$records  = History::where('user_id', '>', 0)
                           ->where('created_at', '>=', $this->from)
                           ->where('created_at', '<=', $this->to)
                          ->get();

        $unique_users  = array();
        $repeated      = array();


        foreach ($records as $record)
        {
           $sumWeight     = 0;
           $total_price   = 0;

           if (in_array($record->user_id, $repeated)) {
             continue;
           }
           else{
            $client = User::withTrashed()->select('id', 'name', 'phone', 'usertype_id')
                          ->where('id', $record->user_id)->first();

            $user_price = History::where('user_id', $record->user_id)
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->where('created_at', '>=', $this->from)
                                  ->where('created_at', '<=', $this->to)
                                  ->sum('price');
            
             $userHistories = History::where('user_id', $record->user_id)
                                  ->where('order_status' , '!=', 'pending')
                                  ->where('order_status' , '!=', 'in progress')
                                  ->where('order_status' , '!=', 'canceled')
                                  ->where('created_at', '>=', $this->from)
                                  ->where('created_at', '<=', $this->to)
                                  ->get();
            foreach ($userHistories as $userHistory) 
            {
              $sumWeight += $userHistory->product->weight * $userHistory->quantity; 
            }
            $count_purchases_shipments = History::where('user_id', $record->user_id)
                                 ->where('price', '>', 0)
                                 ->where('order_status' , 'delivered')
                                 ->where('order_status' , '!=', 'pending')
                                 ->where('order_status' , '!=', 'in progress')
                                 ->where('order_status' , '!=', 'canceled')
                                 ->where('created_at', '>=', $this->from)
                                 ->where('created_at', '<=', $this->to)
                                 ->get();

        $purchases_shipments       = $count_purchases_shipments->pluck('purchase_id');
        // $count_purchases_shipments = count($count_purchases_shipments->unique('purchase_id'));
        $sum_purchases_shipments   = Purchase::whereIn('id', $purchases_shipments)->sum('shipment');


              array_push($unique_users, [
                                      'user_name'  => $client->name,
                                      'user_phone' => $client->phone,
                                      'usertype'   => $client->usertype->name,
                                      'total'      => $user_price,
                                      'sum_purchases_shipments' => $sum_purchases_shipments,
                                      'sumWeight' => $sumWeight,
                                    ]);
            }
            array_push($repeated, $record->user_id);
        }

//    	$purchases = History::whereIn('id', $unique)
  //                          ->get(); 

    	return view('owner_dashboard.customers.AllCustomersExport', compact('unique_users'));
    }
}

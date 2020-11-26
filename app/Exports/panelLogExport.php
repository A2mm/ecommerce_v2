<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;

class panelLogExport implements FromView
{
   protected $from;
   protected $to;
   protected $subject_type;
   protected $description;

  public function __construct($from, $to, $subject_type, $description) 
 {
    $this->from         = $from;
    $this->to           = $to;
    $this->subject_type = $subject_type;
    $this->description  = $description;
    return $this;
        // $this->from = $from;
        // $this->to   = $to;
 }

    public function view(): View
    {
                   /* $records =  Activity::where('causer_id', '!=', null)
                                ->where('created_at', '>=', $this->from)
                                ->where('created_at', '<=', $this->to)
                                ->orderBy('created_at', 'desc')
                                ->get();*/

     
      set_time_limit(0);
      ini_set("memory_limit",-1);
 
        if ($this->from == null && $this->to == null && $this->subject_type == null && $this->description == null) 
        {
            $records =  Activity::where('causer_id', '!=', null)
                         //->where('this->subject_type', '!=', 'App\History')
                        // ->where('this->subject_type', '!=', 'App\ProductStoreQuantity')
                        ->orderBy('created_at', 'desc')
                        ->get();

        }
        elseif ($this->from != null && $this->to != null  && $this->subject_type == null && $this->description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $this->from)
                                ->where('created_at', '<=', $this->to)
                                ->orderBy('created_at', 'desc')
                                ->get();

        }
        elseif ($this->from != null && $this->to != null && $this->subject_type != null && $this->description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('subject_type', $this->subject_type)
                               // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $this->from)
                                ->where('created_at', '<=', $this->to)
                                ->orderBy('created_at', 'desc')
                                ->get();

        }
        elseif ($this->from != null && $this->to != null && $this->subject_type == null && $this->description != null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $this->description)
                                //->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $this->from)
                                ->where('created_at', '<=', $this->to)
                                ->orderBy('created_at', 'desc')
                                ->get();

        }
        else
        {               
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $this->description)
                                ->where('subject_type', $this->subject_type)
                                // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $this->from)
                                ->where('created_at', '<=', $this->to)
                                ->orderBy('created_at', 'desc')
                                ->get();
        }          
                 return view('owner_dashboard.owners.panelLogExport', compact('records'));
    }
}

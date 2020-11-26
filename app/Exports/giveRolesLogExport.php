<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;
use App\Request as Track;

class giveRolesLogExport implements FromView
{
   // protected $from;
   // protected $to;

/*  public function __construct($from, $to) 
 {
 	$this->from = $from;
    $this->to   = $to;
    return $this;
        // $this->from = $from;
        // $this->to   = $to;
 }*/

    public function view(): View
    {
       
        $logged_requests = Track::where('subject_type', 'assignUserRoles')
                                ->orderBy('created_at', 'desc')
                                ->get();
      
        return view('owner_dashboard.owners.giveRolesLogExport', compact('logged_requests'));
    }
}

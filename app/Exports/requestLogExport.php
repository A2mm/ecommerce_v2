<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Spatie\Activitylog\Models\Activity;
use App\Request as Track;

class requestLogExport implements FromView
{
    protected $from;
    protected $to;
    protected $subject_type;
    protected $auth_id;
    protected $result;

  public function __construct($from, $to, $subject_type, $auth_id, $result) 
 {
    $this->from         = $from;
    $this->to           = $to;
    $this->subject_type = $subject_type;
    $this->auth_id      = $auth_id;
    $this->result       = $result;
    return $this;
 }

    public function view(): View
    {
          /*  $requests =  Track::where('subject_type', '!=', 'assignUserRoles')
                              ->where('created_at', '>=', $this->from)
                              ->where('created_at', '<=', $this->to)
                              ->orderBy('created_at', 'desc')
                              ->get();*/
      set_time_limit(0);
      ini_set("memory_limit",-1);

// return $this->from;
        if ($this->from == null && $this->to == null && $this->subject_type == null && $this->result == null && $this->auth_id == null) {
            $requests =  Track::where('subject_type', '!=', 'assignUserRoles')->orderBy('created_at', 'desc')
                              ->get(); 
        }
        elseif($this->from != null && $this->to != null && $this->subject_type == null && $this->result == null && $this->auth_id == null)
        {       
       // return 'v';               
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }

        elseif($this->from != null && $this->to != null && $this->subject_type != null && $this->result == null && $this->auth_id == null)
        {                      
            $requests = Track::where('subject_type', $this->subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type != null && $this->result != null && $this->auth_id == null)
        {                      
            $requests = Track::where('subject_type', $this->subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('result', $this->result)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
         elseif($this->from != null && $this->to != null && $this->subject_type != null && $this->result == null && $this->auth_id != null)
        {                      
            $requests = Track::where('subject_type', $this->subject_type)
            // whereDate('created_at', $search_day)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type == null && $this->result != null && $this->auth_id == null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
                             ->where('result', $this->result)
                             // ->whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type != null && $this->result != null && $this->auth_id == null)
        {                      
            $requests = Track::where('result', $this->result)
                             // whereDate('created_at', $search_day)
                             ->where('subject_type', $this->subject_type)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type == null && $this->result != null && $this->auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
                             ->where('result', $this->result)
                             // ->whereDate('created_at', $search_day)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type == null && $this->result == null && $this->auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type != null && $this->result == null && $this->auth_id != null)
        {                      
            $requests = Track::where('subject_type', $this->subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $from_hour)
                             ->where('created_at', '<=', $to_hour)
                             ->get();
        }
        elseif($this->from != null && $this->to != null && $this->subject_type == null && $this->result != null && $this->auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('result', $this->result)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
        else
        {                      
            $requests = Track::where('subject_type', $this->subject_type)
                             ->where('result', $this->result)
                             ->where('auth_id', $this->auth_id)
                             ->where('created_at', '>=', $this->from)
                             ->where('created_at', '<=', $this->to)
                             ->get();
        }
         return view('owner_dashboard.owners.requestLogExport', compact('requests'));
    }
}

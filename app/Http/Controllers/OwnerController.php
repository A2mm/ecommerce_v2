<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Category;
use App\Subcategory;
use App\Product;
use App\Order;
use Datatables;
use App\User;
use App\OwnerPrivilege;
use App\Vendor;
use App\BProduct;
use App\Accessory;
use App\Store;
use App\Cart;
use App\Purchase;
use App\History;
use App\Link;
use App\Seller;
use App\Bannering;
use App\CategoryOnline;
use DB;
use Image;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

use Spatie\Activitylog\Models\Activity;
use App\Request as Track;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Exports\panelLogExport;
use App\Exports\requestLogExport;
use App\Exports\giveRolesLogExport;
use Maatwebsite\Excel\Facades\Excel;

class OwnerController extends Controller
{
  public function specific_api_activity($id)
  {
    $item = Track::find($id);
    return view('owner_dashboard.sellers.log_activities_specific_api', compact('item'));
  }

  public function requests_log()
  {
    $requests = Track::orderBy('created_at', 'desc')->paginate(10);
     return view('owner_dashboard.sellers.log_activities_home', compact('requests'));
  }

  public function requests_log3(Request $request)
  {
   // return $request->from_day;
    // return $fromDate;
     set_time_limit(0);
      // ini_set('max_execution_time', 0);
    ini_set("memory_limit",-1);

       if (!$request->has('from_day') && !$request->has('to_day') && !$request->has('subject_type') && !$request->has('result') && !$request->has('auth_id'))
      {
         $initfrom = Carbon::today()->subDays(1)->toDateString();
         $initto   = Carbon::now()->toDateString();

         $initfrompicker = Carbon::today()->subDays(1)->toDateTimeString();
         $inittopicker   = Carbon::now()->toDateTimeString();

        $from_day = $initfrom.' 00:00:00';
        $to_day   = $initto.' 23:59:59';

        $originalFrom  =  date("m/d/Y h:i A", strtotime($initfrompicker));
        $originalTo  =  date("m/d/Y h:i A", strtotime($inittopicker));
       
        $subject_type = null;
        $result       = null;
        $auth_id      = null;
        // 07/20/2020 12:00 AM
        // return $originalTo;
      }
      else
      {
        $this->validate($request, [
          'from_day'    => 'required|before_or_equal:to_day',
          'to_day'      => 'required|after_or_equal:from_day',
          'subject_type' => 'exists:requests',
          'result'       => 'exists:requests',
          'auth_id'      => 'exists:requests',
        ]);

        //$originalFrom     = $request->from_day;
        //$originalTo       = $request->to_day;
        $from_day     = $request->from_day;
        $to_day       = $request->to_day;
        $subject_type = $request->subject_type;
        $result       = $request->result;
        $auth_id      = $request->auth_id;

         
         $fromDate  =  date("Y-m-d", strtotime($request->from_day));
         $fromTime  =  date("h:i:s a", strtotime($request->from_day));
         $fromTime  =  date("H:i:s", strtotime($fromTime));

         $toDate  = date("Y-m-d", strtotime($request->to_day));
         $toTime =  date("h:i:s a", strtotime($request->to_day));
         $toTime =  date("H:i:s", strtotime($toTime));

         $from_day = $fromDate. ' ' . $fromTime; 
         $to_day = $toDate. ' ' . $toTime; 

          $originalFrom  =  date("m/d/Y h:i A", strtotime($from_day));
          $originalTo  =  date("m/d/Y h:i A", strtotime($to_day)); 
         
         // $from_day = date("Y-m-d h:i:s A", strtotime($request->from_day));
        //  $to_day = date("Y-m-d h:i:s A", strtotime($request->to_day));
      }
// return $from_day;
        if ($from_day == null && $to_day == null && $subject_type == null && $result == null && $auth_id == null) {
            $requests =  Track::where('subject_type', '!=', 'assignUserRoles')->orderBy('created_at', 'desc')
                              ->paginate(10); 
        }
        elseif($from_day != null && $to_day != null && $subject_type == null && $result == null && $auth_id == null)
        {       
       // return 'v';               
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }

        elseif($from_day != null && $to_day != null && $subject_type != null && $result == null && $auth_id == null)
        {                      
            $requests = Track::where('subject_type', $subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type != null && $result != null && $auth_id == null)
        {                      
            $requests = Track::where('subject_type', $subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
         elseif($from_day != null && $to_day != null && $subject_type != null && $result == null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', $subject_type)
            // whereDate('created_at', $search_day)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type == null && $result != null && $auth_id == null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
                             ->where('result', $result)
                             // ->whereDate('created_at', $search_day)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type != null && $result != null && $auth_id == null)
        {                      
            $requests = Track::where('result', $result)
                             // whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type == null && $result != null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
                             ->where('result', $result)
                             // ->whereDate('created_at', $search_day)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type == null && $result == null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type != null && $result == null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', $subject_type)
                             // whereDate('created_at', $search_day)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_hour)
                             ->where('created_at', '<=', $to_hour)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        elseif($from_day != null && $to_day != null && $subject_type == null && $result != null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')
            //->whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }
        else
        {                      
            $requests = Track::where('subject_type', $subject_type)
                             ->where('result', $result)
                             ->where('auth_id', $auth_id)
                             ->where('created_at', '>=', $from_day)
                             ->where('created_at', '<=', $to_day)->orderBy('created_at', 'desc')
                             ->paginate(10);
        }

        $auth_ids = Track::select('auth_id')->where('auth_id', '!=' , null)
                                            ->where('subject_type', '!=', 'assignUserRoles')
                                            ->get();
        $auth_ids = $auth_ids->unique('auth_id');

        $subjects = Track::select('subject_type')->where('subject_type', '!=' , null)->where('subject_type', '!=' ,'selllogin')->where('subject_type', '!=', 'assignUserRoles')->get();
        $subjects = $subjects->unique('subject_type');


   // $requests = Track::orderBy('created_at', 'desc')->paginate(10);
     return view('owner_dashboard.sellers.log_activities_home_cop2', compact('subjects', 'auth_ids', 'requests', 'from_day', 'to_day', 'subject_type', 'result', 'auth_id', 'originalFrom', 'originalTo'));

    // return view('owner_dashboard.sellers.log_activities_home_cop2', compact('requests', 'from', 'to'));
  }

  public function requests_log2(Request $request)
  {
      set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);

     if (!$request->has('from_hour') && !$request->has('to_hour') && !$request->has('search_day') && !$request->has('subject_type') && !$request->has('result') && !$request->has('auth_id'))
      {
        $from_hour    = null;
        $to_hour      = null;
        $search_day   = null;
        $subject_type = null;
        $result       = null;
        $auth_id      = null;
      }
      else
      {
        $this->validate($request, [
          'from_hour'    => 'required|before_or_equal:to_hour',
          'to_hour'      => 'required|after_or_equal:from_hour',
          'search_day'   => 'required|date',
          'subject_type' => 'exists:requests',
          'result'       => 'exists:requests',
          'auth_id'      => 'exists:requests',
        ]);

        $from_hour    = $request->from_hour;
        $to_hour      = $request->to_hour;
        $search_day   = $request->search_day;
        $subject_type = $request->subject_type;
        $result       = $request->result;
        $auth_id      = $request->auth_id;
      }

        if ($from_hour == null && $to_hour == null && $search_day == null && $subject_type == null && $result == null && $auth_id == null) {
            $requests =  Track::where('subject_type', '!=', 'assignUserRoles')->orderBy('created_at', 'desc')
                              ->paginate(10); 
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $result == null && $auth_id == null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')->whereDate('created_at', $search_day)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $result == null && $auth_id == null)
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $result != null && $auth_id == null)
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->where('result', $result)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
         elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $result == null && $auth_id != null)
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $result != null && $auth_id == null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')->whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $result != null && $auth_id == null)
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->where('subject_type', $subject_type)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $result != null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')->whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $result == null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')->whereDate('created_at', $search_day)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $result == null && $auth_id != null)
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        elseif($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $result != null && $auth_id != null)
        {                      
            $requests = Track::where('subject_type', '!=', 'assignUserRoles')->whereDate('created_at', $search_day)
                             ->where('result', $result)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }
        else
        {                      
            $requests = Track::whereDate('created_at', $search_day)
                             ->where('subject_type', $subject_type)
                             ->where('result', $result)
                             ->where('auth_id', $auth_id)
                             ->whereTime('created_at', '>=', $from_hour)
                             ->whereTime('created_at', '<=', $to_hour)
                             ->paginate(10);
        }

        $auth_ids = Track::select('auth_id')->where('auth_id', '!=' , null)
                                            ->where('subject_type', '!=', 'assignUserRoles')
                                            ->get();
        $auth_ids = $auth_ids->unique('auth_id');

        $subjects = Track::select('subject_type')->where('subject_type', '!=' , null)->where('subject_type', '!=' ,'selllogin')->where('subject_type', '!=', 'assignUserRoles')->get();
        $subjects = $subjects->unique('subject_type');


   // $requests = Track::orderBy('created_at', 'desc')->paginate(10);
     return view('owner_dashboard.sellers.log_activities_home_cop', compact('subjects', 'auth_ids', 'requests', 'search_day', 'from_hour', 'to_hour', 'subject_type', 'result', 'auth_id'));
  }

  public function userroles_getlog_specific($id)
  {
    $specified_request = Track::where('id', $id)->first();
    $auth_user_id = $specified_request->auth_id;
    $auth_user = User::withTrashed()->where('id', $auth_user_id)->first();
    $auth_user_name = $auth_user->name;
    return view('owner_dashboard.owners.userroles_getlog_specific', compact('specified_request', 'auth_user_name'));
  }

  public function log2(Request $request)
  {
// return $request->from_day;
     // $toDay  = strstr(date($request->to_day), 'EET');
     // $to_hour = substr($toDay, 3);
     
      set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);
   // $one = $request->taken_action;
   // return $one;
    if (!$request->has('from_day') && !$request->has('to_day') && !$request->has('subject_type') && !$request->has('description'))
      {
         $initfrom = Carbon::today()->subDays(1)->toDateString();
         $initto   = Carbon::now()->toDateString();

        $initfrompicker = Carbon::today()->subDays(1)->toDateTimeString();
        $inittopicker   = Carbon::now()->toDateTimeString();

        $from_day = $initfrom.' 00:00:00';
        $to_day   = $initto.' 23:59:59';
        $originalFrom  =  date("m/d/Y h:i A", strtotime($initfrompicker));
        $originalTo  =  date("m/d/Y h:i A", strtotime($inittopicker)); 
        $subject_type = null;
        $description  = null;
      }
      else
      {
        $this->validate($request, [
         // 'from_hour'    => 'required|before_or_equal:to_hour',
         // 'to_hour'      => 'required|after_or_equal:from_hour',
          'from_day'     => 'required|before_or_equal:to_day',
          'to_day'       => 'required|after_or_equal:from_day',
          'subject_type' => 'exists:activity_log',
          'description'  => 'exists:activity_log',
        ]);

       // $originalFrom     = $request->from_day;
      //  $originalTo       = $request->to_day;
        $from_day      = $request->from_day;
        $to_day        = $request->to_day;
        $subject_type  = $request->subject_type;
        $description   = $request->description;

         
         $fromDate  =  date("Y-m-d", strtotime($request->from_day));
         $fromTime  =  date("h:i:s a", strtotime($request->from_day));
         $fromTime  =  date("H:i:s", strtotime($fromTime));

         $toDate  = date("Y-m-d", strtotime($request->to_day));
         $toTime =  date("h:i:s a", strtotime($request->to_day));
         $toTime =  date("H:i:s", strtotime($toTime));

         $from_day = $fromDate. ' ' . $fromTime; 
         $to_day = $toDate. ' ' . $toTime; 

           $originalFrom  =  date("m/d/Y h:i A", strtotime($from_day));
           $originalTo  =  date("m/d/Y h:i A", strtotime($to_day)); 
         
         // $from_day = date("Y-m-d h:i:s A", strtotime($request->from_day));
        //  $to_day = date("Y-m-d h:i:s A", strtotime($request->to_day));
      }
 // return $originalFrom;

        if ($from_day == null && $to_day == null && $subject_type == null && $description == null) 
        {
            $records =  Activity::where('causer_id', '!=', null)
                         //->where('subject_type', '!=', 'App\History')
                        // ->where('subject_type', '!=', 'App\ProductStoreQuantity')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        }
        elseif ($from_day != null && $to_day != null  && $subject_type == null && $description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $from_day)
                                ->where('created_at', '<=', $to_day)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        elseif ($from_day != null && $to_day != null && $subject_type != null && $description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('subject_type', $subject_type)
                               // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $from_day)
                                ->where('created_at', '<=', $to_day)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        elseif ($from_day != null && $to_day != null && $subject_type == null && $description != null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $description)
                                //->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $from_day)
                                ->where('created_at', '<=', $to_day)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        else
        {               
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $description)
                                ->where('subject_type', $subject_type)
                                // ->whereDate('created_at', $search_day)
                                ->where('created_at', '>=', $from_day)
                                ->where('created_at', '<=', $to_day)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        }

        $subjects     = Activity::select('subject_type')->where('causer_id', '!=' , null)->get();
        $takenActions = Activity::select('description')->get();
        $subjects     = $subjects->unique('subject_type');
        $takenActions = $takenActions->unique('description');
// return $from_day;
         return view('owner_dashboard.owners.log_activities_cop2', compact('takenActions', 'subjects', 'records', 'from_day', 'to_day', 'subject_type', 'description', 'originalFrom', 'originalTo'));

        // return view('owner_dashboard.owners.log_activities_cop2', compact('records', 'from', 'to'));
  }

  public function log(Request $request)
  {
      set_time_limit(0);
      // ini_set('max_execution_time', 0);
      ini_set("memory_limit",-1);
   // $one = $request->taken_action;
   // return $one;
    if (!$request->has('from_hour') && !$request->has('to_hour') && !$request->has('search_day') && !$request->has('subject_type') && !$request->has('description'))
      {
        $from_hour    = null;
        $to_hour      = null;
        $search_day   = null;
        $subject_type = null;
        $description = null;
      }
      else
      {
        $this->validate($request, [
          'from_hour'    => 'required|before_or_equal:to_hour',
          'to_hour'      => 'required|after_or_equal:from_hour',
          'search_day'   => 'required|date',
          'subject_type' => 'exists:activity_log',
          'description'  => 'exists:activity_log',
        ]);

        $from_hour     = $request->from_hour;
        $to_hour       = $request->to_hour;
        $search_day    = $request->search_day;
        $subject_type  = $request->subject_type;
        $description   = $request->description;

      }

        if ($from_hour == null && $to_hour == null && $search_day == null && $subject_type == null && $description == null) 
        {
            $records =  Activity::where('causer_id', '!=', null)
                         //->where('subject_type', '!=', 'App\History')
                        // ->where('subject_type', '!=', 'App\ProductStoreQuantity')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        }
        elseif ($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->whereDate('created_at', $search_day)
                                ->whereTime('created_at', '>=', $from_hour)
                                ->whereTime('created_at', '<=', $to_hour)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        elseif ($from_hour != null && $to_hour != null && $search_day != null && $subject_type != null && $description == null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('subject_type', $subject_type)
                                ->whereDate('created_at', $search_day)
                                ->whereTime('created_at', '>=', $from_hour)
                                ->whereTime('created_at', '<=', $to_hour)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        elseif ($from_hour != null && $to_hour != null && $search_day != null && $subject_type == null && $description != null)
        {
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $description)
                                ->whereDate('created_at', $search_day)
                                ->whereTime('created_at', '>=', $from_hour)
                                ->whereTime('created_at', '<=', $to_hour)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);

        }
        else
        {               
            $records =  Activity::where('causer_id', '!=', null)
                                ->where('description', $description)
                                ->where('subject_type', $subject_type)
                                ->whereDate('created_at', $search_day)
                                ->whereTime('created_at', '>=', $from_hour)
                                ->whereTime('created_at', '<=', $to_hour)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
        }

        $subjects     = Activity::select('subject_type')->where('causer_id', '!=' , null)->get();
        $takenActions = Activity::select('description')->get();
        $subjects     = $subjects->unique('subject_type');
        $takenActions = $takenActions->unique('description');
         return view('owner_dashboard.owners.log_activities_cop', compact('takenActions', 'subjects', 'records', 'search_day', 'from_hour', 'to_hour', 'subject_type', 'description'));
  }

  public function specific_log_request($id)
  {
    $item = Track::where('id', $id)->first();
     return view('owner_dashboard.sellers.log_activities_specific_request2', compact('item'));
  }

  public function specific_log($id)
  {
    $activity = Activity::where('id', $id)->first();
    // return $activity;
/*foreach ($activity->properties as $index => $value)
{
  if ($index == 'old') {
    foreach ($value as $i => $v)
    {
      if ($i == 'archive') {
        return $v;
      }
    }
  }
}*/
    $auth_user = User::where('id', $activity->causer_id)->first();
    return view('owner_dashboard.owners.log_activities_specific3', compact('activity', 'auth_user'));
  }
    public function getShowAll()
    {
        $owners = User::getRole('owner')->get();
        return view('owner_dashboard.owners.all', compact('owners'));
    }
    public function getLogin()
    {
         if(Auth::check() && Auth::user()->role('owner') && Auth::user()->suspend != 1)
        {
            return redirect()->route('owner.dashboard');
        }
        else
        {
            return view('owner_dashboard.login');
        }
    }

    public function postLogin(Request $request)
    {
      $this->validate($request, [
        'email'     => 'required|email|string',
        'password'  => 'required',
      ]);
    
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'], 'role' => 'owner']))
        {
           // $privileges = OwnerPrivilege::where('user_id', Auth::user()->id)->pluck('privilege');
           // session()->put('privileges', $privileges);

              if (Auth::user()->suspend == 1)
              {
                 return redirect()->back()->withErrors([__('translations.email_is_suspended')]);
                // redirect()->back()->withErrors('product not found');
              }
              else
              {
                return redirect()->route('owner.dashboard');
              }   
        } 
        else 
        {
            //$errors[] = 'Wrong Credentials';
            return redirect()->back()->withErrors([__('translations.your_email_and_or_password_are_incorrect')]);
        }
    }

    public function getlogout()
    {
        Auth::logout();
        return redirect()->route('owner.login');
    }


    public function getDashboard()
    {
        $privileges = OwnerPrivilege::where('user_id', Auth::user()->id)->get();
        $all_privilege = [];
        foreach ($privileges as $privilege) {
            $all_privilege[] = $privilege->privilege;
        }
        //return $all_privilege;
        $zero_products = Product::where('quantity', 0)->get();
        //$value[] = session()->get('all_privilege');

        $products_count = count(Product::all());
        
        $users_count  = User::where(['role' => 'user'])
                            ->get();
        $users_count = $users_count->where('suspend', '!=', 1)->count();

        $admins_count =  User::where(['role' => 'owner'])
                             ->get();
         $admins_count =  $admins_count->where('suspend', '!=', 1)->count();

        $customers_count = count(User::where('customerOrNot', 1)->get());
        $categories_count = count(Category::all());
        $subcategories_count = count(Subcategory::all());
        //$vendors_count = count(Vendor::all());
        $orders_count = History::where('price', '>', 0)
                                ->where('order_status' , '!=', 'in progress')
                                ->where('order_status' , '!=', 'pending')
                                ->where('order_status' , '!=', 'canceled')
                                ->groupBy('bill_id')->select('bill_id')->get();//count(Purchase::all());
         $orders_count = count($orders_count);

         // ahmed new added 
            $orders_count_pending = History::where('order_status', 'pending')->where('price', '>', 0)
                                            ->groupBy('bill_id')->select('bill_id')
                                            ->get(); 
            $orders_count_pending = count($orders_count_pending);

            $orders_count_inprogress = History::where('order_status', 'in progress')->where('price', '>', 0)
                                            ->groupBy('bill_id')->select('bill_id')
                                            ->get(); 
            $orders_count_inprogress = count($orders_count_inprogress);

            $count_banners = Bannering::count();

            $products_archived = count(Product::where('archive', 1)->get());

            $products_available_online = count(Product::where('available_online', 1)->get());

            $categories_online = CategoryOnline::count();

         // ahmed new added 
        //$affiliates_count = count(User::where('role', 'affiliate')->get());
        $today_orders = count(Purchase::where('created_at', '>=', Carbon::today())
                                       ->groupBy('bill_id')->select('bill_id')
                                       ->get());
        $stores_count = count(Store::all());
        $sellers_count = count(Seller::all());

        $last_week = [];
        $last_week_orders = [];
        $last_week[] = Carbon::now()->toFormattedDateString();
        $last_week_orders[] = Order::subday(0)->get()->count();

        for ($i=1; $i <= 6; $i++) {
            $last_week[] = Carbon::now()->subDays($i)->toFormattedDateString();
            $last_week_orders[] = Order::subday($i)->get()->count();
        }

        $best_products = Product::orderBy('num_of_orders', 'desc')->limit(5)->get();

        $active_users = Purchase::groupBy('user_id')
    ->orderBy('count', 'desc')->limit(5)
    ->get(['user_id', DB::raw('count(user_id) as count')])->pluck('user_id');

        $best_users = [];
        foreach ($active_users as $user) {
            $best_users[] = User::where('id', $user)->first();
        }


        $best_sold = History::where('order_status', '!=', 'pending')
                            ->where('order_status', '!=', 'in progress')
                            ->where('order_status', '!=', 'canceled')
                            ->groupBy('product_id')
                            ->orderBy('count', 'desc')
                            ->take(1)
                            ->get(['product_id', DB::raw('sum(quantity) as count')]);

        $best_sold_ids = $best_sold->pluck('product_id');
        $best_seller_products = Product::whereIn('id', $best_sold_ids)
                                // ->where('archive', 0)
                                ->select('id', 'name', 'subcategory_id', 'category_id')
                                ->take(1)
                                ->get();

 //       $best_visits_links = Link::orderBy('visits', 'desc')->where('visits', '!=', 0)->limit(5)->get();
   //     $best_orders_links = Link::orderBy('orders', 'desc')->where('orders', '!=', 0)->limit(5)->get();


        return view('owner_dashboard.all', compact('all_privilege', 'products_count', 'users_count', 'customers_count', 'categories_count', 'subcategories_count', 'orders_count', 'today_orders', 'stores_count', 'last_week', 'last_week_orders', 'best_products', 'best_users', 'best_visits_links', 'best_orders_links', 'sellers_count', 'orders_count_inprogress', 'orders_count_pending', 'count_banners', 'products_available_online', 'products_archived', 'best_seller_products', 'best_sold', 'categories_online', 'admins_count'));
    }

    public function getGraph()
    {
        $privileges = OwnerPrivilege::where('user_id', Auth::user()->id)->get();
        $all_privilege = [];
        foreach ($privileges as $privilege) {
            $all_privilege[] = $privilege->privilege;
        }
        //return $all_privilege;
        $zero_products = Product::where('quantity', 0)->get();
        //$value[] = session()->get('all_privilege');

        $products_count = count(Product::all());
        $users_count = count(User::all());
        $customers_count = count(User::where('customerOrNot', 1)->get());
        $categories_count = count(Category::all());
        $subcategories_count = count(Subcategory::all());
        //$vendors_count = count(Vendor::all());
        $orders_count = History::where('price', '>', 0)->groupBy('bill_id')->select('bill_id')->get();//count(Purchase::all());
         $orders_count = count($orders_count);
        //$affiliates_count = count(User::where('role', 'affiliate')->get());
        $today_orders = count(Purchase::where('created_at', '>=', Carbon::today())->get());
        $stores_count = count(Store::all());
        $sellers_count = count(Seller::all());

        $last_week = [];
        $last_week_orders = [];
        $last_week[] = Carbon::now()->toFormattedDateString();
        $last_week_orders[] = Order::subday(0)->get()->count();

        for ($i=1; $i <= 6; $i++) {
            $last_week[] = Carbon::now()->subDays($i)->toFormattedDateString();
            $last_week_orders[] = Order::subday($i)->get()->count();
        }

        $best_products = Product::orderBy('num_of_orders', 'desc')->limit(5)->get();

        $active_users = Purchase::groupBy('user_id')
    ->orderBy('count', 'desc')->limit(5)
    ->get(['user_id', DB::raw('count(user_id) as count')])->pluck('user_id');

        $best_users = [];
        foreach ($active_users as $user) {
            $best_users[] = User::where('id', $user)->first();
        }

 //       $best_visits_links = Link::orderBy('visits', 'desc')->where('visits', '!=', 0)->limit(5)->get();
   //     $best_orders_links = Link::orderBy('orders', 'desc')->where('orders', '!=', 0)->limit(5)->get();


        return view('owner_dashboard.graph', compact('all_privilege', 'products_count', 'users_count', 'customers_count', 'categories_count', 'subcategories_count', 'orders_count', 'today_orders', 'stores_count', 'last_week', 'last_week_orders', 'best_products', 'best_users', 'best_visits_links', 'best_orders_links', 'sellers_count'));
    }

    public function getMarket()
    {
        $categories = Category::take(5)->get();
        $subcategories = Subcategory::take(5)->get();
        $products = Product::take(5)->get();
        $orders = Order::take(5)->get();
        return view('owner_dashboard.market', compact('categories', 'subcategories', 'products', 'orders'));
    }

    public function getCreate()
    {
        return view('owner_dashboard.owners.create');
    }

    public function postStore(Request $request)
    {
        $this->validate($request, [
      'name' => 'required|max:255',
      'email' => 'required|unique:users,email',
      'password' => 'required|max:255',
    ]);

        $user = new User();
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->password = bcrypt($request['password']);
        $user->role = 'owner';
        $user->save();
        $arr[] = '';
        $pervs = $request->perv;
        $all_pervs = [];
        for ($i=0;$i<count($pervs);$i++) {
            $all_pervs[$i]['privilege'] = $pervs[$i];
            $all_pervs[$i]['name'] = $user->name;
            $all_pervs[$i]['email'] = $user->email;
        }
        $user->OwnerPrivilege()->createMany($all_pervs);

        /*
            $user->OwnerPrivilege()->createMany([
              'user_id' => $user->id,
                'privilege' => $pervs,
                'name' => $user->name,
                'email' => $user->email
              ]);

            $privileges = OwnerPrivilege::create([
              'user_id' => $user->id,
                'privilege' => $request[''],
                'name' => $user->name,
                'email' => $user->email
              ]);





            if(isset($request['general'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "general",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            if(isset($request['add_sub'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "add subcategory",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }
            if(isset($request['edit_sub'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "edit subcategory",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }
            if(isset($request['delete_sub'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "delete subcategory",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }
            if(isset($request['add_prod'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "add product",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }
            if(isset($request['edit_prod'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "edit product",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }
            if(isset($request['delete_prod'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "delete product",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            if(isset($request['all-shop'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "entire shop",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //customers
            if(isset($request['cus_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "customer",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //affiliates
            if(isset($request['aff_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "affiliate",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //links
            if(isset($request['link_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "link",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //vendors
            if(isset($request['ven_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "vendor",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //admins
            if(isset($request['admin_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "admin",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //quantity
            if(isset($request['quant_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "quantity",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            //owner
            if(isset($request['owner_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "owner",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            if(isset($request['video_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "video",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

            if(isset($request['csv_control'])){
              OwnerPrivilege::create([
                'user_id' => $user->id,
                'privilege' => "csv",
                'name' => $user->name,
                'email' => $user->email
              ]);
            }

        */

        return redirect()->route('manage.owner.all')->withMessage(__('translations.new_owner_added'));
    }
    public function destroy($id)
    {
      User::find($id)->delete();
      return redirect()->route('manage.owner.all')->withMessage(__('translations.owner_deleted'));
    }
    public function edit($id)
    {
      $owner = User::find($id);
      return view('owner_dashboard.owners.edit',compact('owner'));
    }
    public function update(Request $request,$id)
    {
      $this->validate($request, [
        'name' => 'required|max:255',
        'email' => ['bail' , 'required' , 'email' , Rule::unique('users')->ignore($id), 'max:255' ],
        'password' => 'nullable|max:255',
      ]);

      $user = User::find($id);
      $user->name = $request['name'];
      $user->email = $request['email'];
      if ($request->password) {
        $user->password = bcrypt($request['password']);
      }
      $user->role = 'owner';
      $user->save();
      if($id != Auth::user()->id)
      {$arr[] = '';
      $pervs = $request->perv;
      $all_pervs = [];
      for($i=0;$i<count($pervs);$i++){
        $all_pervs[$i]['privilege'] = $pervs[$i];
        $all_pervs[$i]['name'] = $user->name;
        $all_pervs[$i]['email'] = $user->email;
      }
      $user->OwnerPrivilege()->delete();
      $user->OwnerPrivilege()->createMany($all_pervs);}


      return redirect()->route('manage.owner.all')->withMessage(__('translations.owner_updated'));
    }

    public function index()
    {
      $users = User::where('role', 'owner')->get(); 
      return view('owner_dashboard.users.index')->with('users', $users);
    }

    public function create() {
    //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }
    
    public function assign_roles($id) {
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
        return view('owner_dashboard.users.edit', compact('user', 'roles')); 
    }

    public function userroles_getlog(Request $request)
    {
         if (!$request->has('from_hour') && !$request->has('to_hour') && !$request->has('search_day'))
      {
        $from_hour    = null;
        $to_hour      = null;
        $search_day   = null;
      }
      else
      {
        $this->validate($request, [
          'from_hour'    => 'required|before_or_equal:to_hour',
          'to_hour'      => 'required|after_or_equal:from_hour',
          'search_day'   => 'required|date',
        ]);

        $from_hour     = $request->from_hour;
        $to_hour       = $request->to_hour;
        $search_day    = $request->search_day;
      }
      if ($search_day == null && $from_hour == null && $to_hour == null ) {
          $logged_requests = Track::where('subject_type', 'assignUserRoles')
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
      }
      else
      {   
          $logged_requests = Track::where('subject_type', 'assignUserRoles')
                                ->whereDate('created_at', $search_day)
                                ->whereTime('created_at', '>=', $from_hour)
                                ->whereTime('created_at', '<=', $to_hour)
                                ->orderBy('created_at', 'desc')
                                ->paginate(10);
      }

        //return $logged_requests;
      /*  foreach ($logged_requests as $logged_request) {
            $item = json_decode($logged_request->request);
           /// return $item;
               foreach ($item as $key => $value) {
                    if ($key == 'admin_id') 
                    {
                       echo $value. '<br>';
                    }

                    if ($key == 'roles') 
                    {
                       foreach ($value as $key => $roleval) 
                       {
                           echo $roleval. '<br>';   
                       }
                    }
                }*/

                // $itemresponse = $logged_request->response;
                 return view('owner_dashboard.owners.userroles_getlog', compact('logged_requests', 'from_hour', 'to_hour', 'search_day'));
        // }
    }

    public function store_roles(Request $request, $id) {
     // return $id;
        $user = User::findOrFail($id); //Get role specified by id
       // return $user->roles;;
    //Validate name, email and password fields    
      /*  $this->validate($request, [
            'name'=>'required|max:120',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'required|min:6|confirmed'
        ]); */

       // $input = $request->only(['name', 'email', 'password']); 

        $roles = $request['roles']; //Retreive all roles
       // $user->fill($input)->save();

        if (isset($roles)) {        
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }
// return $roles;
       /* if(!empty($roles))
        {


            foreach ($roles as $dd) 
            {
              $roled = Role::where('id', $dd)->first();
            // return $roled->permissions;
              foreach($roled->permissions as $perm)
              {
                // echo $perm->id. '<br>';
                $p = Permission::where('id', '=', $perm->id)->first(); 
               // return $p;
             //Fetch the newly created role and assign permission
               // $role = Role::where('name', '=', $name)->first(); 
                $user->givePermissionTo($p);
              }
            }
        }*/

       return redirect()->route('users.all.roles.assign')
            ->withMessage(__('translations.roles_assigned_user_successfully'));
    }

/*    public function destroy($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message',
             'User successfully deleted.');
    }*/

    public function add_admins()
    {
      return view('owner_dashboard.owners.add_admins');
    }

    public function store_admins(Request $request)
    {
        $this->validate($request, [
            'name'   => 'required|min:3|max:30',
            'phone' => 'unique:users,phone|size:11|regex:/(01)[0-9]{9}/',
            'email'    => 'email|required|unique:users,email',
            'password'   => 'required|min:8|max:30|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
        ]);

       /* if ($request->has('phone') && $request->phone != '') {
            if(strstr($request->phone, '.')){
               return redirect()->back()->withErrors(__('translations.phone_cant_contain_dots'));
            }
        }*/
        if ($request->has('phone')) {
           $phone = $request->phone;
        }
        else{
            $phone = NULL;
        }
        $result = User::create([
            'name'          => $request->name,
            'phone'         => $phone,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'api_token'     => str_random(30),
            'role'          => 'owner',
        ]);

        if ($result) 
        {
            return redirect()->route('admins.all')->withMessage(__('translations.admin_created_successfuly'));
        }
    }

    public function all_admins()
    {
       $admins = User::where('role', 'owner')->get(); 
       return view('owner_dashboard.owners.all_admins', compact('admins'));
    }

    public function alladmins_edit($id)
    {
        $user = User::where(['id' => $id, 'role' => 'owner'])->first();
        if (!$user) {
            return redirect()->route('admins.all')->withMessage(__('translations.admin_not_found'));
        }
        else
        {
            return view('owner_dashboard.owners.alladmins_edit', compact('user'));
        }
    }

    public function store_alladmins_edit($id, Request $request)
    {
         $item = User::where(['id' => $id, 'role' => 'owner'])->first();
        // return $item;
         $this->validate($request, [
            'name'   => 'required|min:3|max:30',
            'phone' => 'size:11|regex:/(01)[0-9]{9}/|unique:users,phone,'.$item->id,
            'email'    => 'email|required|unique:users,email,'.$item->id,
            'password'   => 'min:8|max:30|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
        ]);

         if (!empty($request->password)) {
           $newwww_pass = bcrypt($request->password);
           if ($newwww_pass == $item->password) 
           {
               $passwording = $item->password;
           }
           else
           {
              $passwording = $newwww_pass;
           }
        }
        else{
            // return 'no p';
             $passwording = $item->password;
        }

        $old_name  = $item->name;
        $old_email = $item->email; 
        $old_phone = $item->phone; 
        $old_pass  = $item->password; 

        $new_name  = $request->name;
        $new_email = $request->email; 
        $new_phone = $request->phone; 
        $new_pass  = $passwording; 
       // return $passwording;
        if ($old_name == $new_name && $old_email == $new_email && $old_pass == $new_pass && $old_phone == $new_phone) {
            return redirect()->route('admins.all')->withMessage(__('translations.data_no_changed'));
         } 
         else
         {         
             $client = [
                'name'          => $request->name,
                'phone'         => $request->phone,
                'email'         => $request->email,
                'password'      => $passwording, // bcrypt($request->password),
            ];
            if ($item) {
                $item->update($client);
                return redirect()->route('admins.all')->withMessage(__('translations.admin_updated_successfuly'));
            }
        }
    }

    public function alladmins_suspend($id)
    {
        $user = User::where(['id' => $id, 'role' => 'owner'])->first();
        if (!$user) 
        {
           return redirect()->route('admins.all')->withMessage(__('translations.admin_not_found'));
        }
        else
        {
            $suspend_status = $user->suspend;
            if ($suspend_status == null) 
            {
                $user->suspend = 1; 
                $user->save(); 
                return redirect()->route('admins.all')->withMessage(__('translations.admin_suspended_successfully'));
            }
            else
            {
                $user->suspend = null; 
                $user->save(); 
                return redirect()->route('admins.all')->withMessage(__('translations.admin_unsuspended_successfully'));
            }
           // return view('owner_dashboard.owners.alladmins_edit', compact('user'));
        }
    }

   /* public function panelLog_excel(Request $request)
    {
         set_time_limit(0);
         ini_set("memory_limit",-1);

        $search_day = $request->search_day;
        $from_hour  = $request->from_hour;
        $to_hour    = $request->to_hour;
      return Excel::download(new panelLogExport($search_day, $from_hour, $to_hour), 'panelLogExport.xlsx');
    }

    public function requestLog_excel(Request $request)
    {
         set_time_limit(0);
         ini_set("memory_limit",-1);

        $search_day = $request->search_day;
        $from_hour  = $request->from_hour;
        $to_hour    = $request->to_hour;

      return Excel::download(new requestLogExport($search_day, $from_hour, $to_hour), 'requestLogExport.xlsx');
    }*/

    public function panelLog_excel(Request $request)
    {
         set_time_limit(0);
         ini_set("memory_limit",-1);

        $from         = $request->from_day.' 00:00:00';
        $to           = $request->to_day. ' 23:59:59';
        $subject_type = $request->subject_type == 'not' ? null : $request->subject_type;
        $description  = $request->description == 'not' ? null : $request->description;

      return Excel::download(new panelLogExport($from, $to, $subject_type, $description), 'panelLogExport.xlsx');
    }

    public function requestLog_excel(Request $request)
    {
         set_time_limit(0);
         ini_set("memory_limit",-1);

        $from         = $request->from_day.' 00:00:00';
        $to           = $request->to_day. ' 23:59:59';
        $subject_type = $request->subject_type == 'not' ? null : $request->subject_type;
        $auth_id      = $request->auth_id == 'not' ? null : $request->auth_id;
        $result       = $request->result == 'not' ? null : $request->result;

      return Excel::download(new requestLogExport($from, $to, $subject_type, $auth_id, $result), 'requestLogExport.xlsx');
    }

    public function giveRolesLog_excel()
    {
        set_time_limit(0);
         ini_set("memory_limit",-1);

       // $from = $request->from.' 00:00:00';
       // $to   = $request->to. ' 23:59:59';
      return Excel::download(new giveRolesLogExport(), 'giveRolesLogExport.xlsx');    
    }
}







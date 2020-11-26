<?php

namespace App\Exports;

use App\User;
use App\History;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class CustomersReportsExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    $date_from = Request::get('from');
    $date_to = Request::get('to');

    $records  = History::where('user_id', '>', 0)
                       ->where('created_at', '>=', $date_from)
                       ->where('created_at', '<=', $date_to)
                      ->get();

    $unique_users  = array();
    $repeated      = array();
    $total_price   = 0;

    foreach ($records as $record)
    {
       if (in_array($record->user_id, $repeated)) {
         continue;
       }
       else{
        $client = User::withTrashed()->select('id', 'name', 'phone', 'usertype_id')
                      ->where('id', $record->user_id)->first();

        $user_price = History::where('user_id', $record->user_id)
                              ->where('created_at', '>=', $date_from)
                              ->where('created_at', '<=', $date_to)
                              ->sum('price');
          array_push($unique_users, [
                                  'user_name'  => $client->name,
                                  'user_phone' => $client->phone,
                                  'usertype'   => $client->usertype->name,
                                  'total'      => $user_price,
                                ]);
        }
        array_push($repeated, $record->user_id);
    }

    return view('owner_dashboard.customers.reports_excel', [
        'users' => $unique_users,
    ]);
  }
}

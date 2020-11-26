<?php

namespace App\Exports;

use App\History;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class StoreWeekExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    $from = \Carbon\Carbon::today()->subDays(7)->toDateString();
    $to   = \Carbon\Carbon::today()->toDateString();

    $date_from = $from.' 00:00:00';
    $date_to   = $to.' 23:59:59';

    $id = Request::get('id');
    return view('owner_dashboard.stores.week_excel', [
        'histories' => History::where('store_id', $id)
                                ->where('created_at', '>=', $date_from)
                                ->where('created_at', '<=', $date_to)
                                ->get(),
    ]);
  }
}

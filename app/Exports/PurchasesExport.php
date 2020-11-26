<?php

namespace App\Exports;

use App\History;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PurchasesExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    return view('owner_dashboard.purchases.excel', [
        'purchases' => History::whereNotNull('store_id')->get(),
    ]);
  }
}

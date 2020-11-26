<?php

namespace App\Exports;

use App\History;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class RefundsExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    return view('owner_dashboard.products.refunds_excel', [
        'refunds' => History::where('quantity', '<', 0)->get(),
    ]);
  }
}

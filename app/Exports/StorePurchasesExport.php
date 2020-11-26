<?php

namespace App\Exports;

use App\History;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class StorePurchasesExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    $id = Request::get('id');
    return view('owner_dashboard.stores.purchases_excel', [
        'histories' => History::where('store_id', $id)->get(),
    ]);
  }
}

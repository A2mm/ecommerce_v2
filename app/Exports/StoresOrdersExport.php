<?php

namespace App\Exports;

use App\ProductStoreQuantity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;


class StoresOrdersExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    return view('owner_dashboard.stores.orders_excel', [
        'items' => ProductStoreQuantity::where('shiporder_id', '!=', 1)->get(),
    ]);
  }
}

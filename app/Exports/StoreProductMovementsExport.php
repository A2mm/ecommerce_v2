<?php

namespace App\Exports;

use App\ProductStoreQuantity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class StoreProductMovementsExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    $id = Request::get('id');
    return view('owner_dashboard.stores.products_excel', [
        'movements' => ProductStoreQuantity::where('store_id', $id)->get(),
    ]);
  }
}

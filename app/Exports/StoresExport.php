<?php

namespace App\Exports;

use App\Store;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class StoresExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
      return view('owner_dashboard.stores.excel', [
          'stores' => Store::all(),
      ]);
    }
}

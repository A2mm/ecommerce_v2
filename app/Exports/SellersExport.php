<?php

namespace App\Exports;

use App\Seller;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class SellersExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
      return view('owner_dashboard.sellers.excel', [
          'sellers' => Seller::all(),
      ]);
    }
}

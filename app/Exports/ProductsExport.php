<?php

namespace App\Exports;

use App\Product;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class ProductsExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
      return view('owner_dashboard.products.excel', [
          'products' => Product::all(),
      ]);
    }
}

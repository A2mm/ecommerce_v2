<?php

namespace App\Exports;

use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;

class CustomersExport implements FromView
{
  /**
  * @return \Illuminate\Support\FromView
  */
  public function view(): View
  {
    return view('owner_dashboard.customers.excel', [
        'customers' => User::where('role', 'user')->withTrashed()->get(),
    ]);
  }
}

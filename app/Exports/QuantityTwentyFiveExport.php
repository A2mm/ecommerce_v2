<?php

namespace App\Exports;

use App\Product;
use App\ProductStoreQuantity;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Request;


class QuantityTwentyFiveExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
      $all_products = Product::select('id', 'name')->where('archive', 0)->get();
      $rare_products = array();
      foreach ($all_products as $product)
      {
          foreach($product->stores as $store)
          {
              $quantity = ProductStoreQuantity::where(['product_id' => $product->id, 'store_id' => $store->id])->sum('quantity');

              if ($quantity < 25 && $quantity > 0)
              {
                  array_push($rare_products, [
                      'id'         => $product->id,
                      'product'    => $product->name,
                      'store'      => $store->name,
                      'quantity'   => $quantity
                  ]);
              }

          }
      }
      return view('owner_dashboard.quantity.twentyFive_excel', [
          'products' => $rare_products,
      ]);
    }
}

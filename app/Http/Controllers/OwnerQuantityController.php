<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductStoreQuantity;
use Illuminate\Http\Request;
use App\Exports\QuantityZeroExport;
use App\Exports\QuantityTwentyFiveExport;
use App\Exports\QuantityLessZeroExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\LengthAwarePaginator;

class OwnerQuantityController extends Controller
{

    /*public function lessThanThree() {
    $products = Product::where('quantity', '<', 3)->where('quantity', '>', 0)->get();

    return view('owner_dashboard.quantity.lessThree',compact('products'));

    }

    public function zero() {
    $zero_products = Product::where('quantity',0)->get();

    return view('owner_dashboard.quantity.zero',compact('zero_products'));

    }
     */

    /*public function lessThanThreeData(){
    $threeQuantity = Product::where('quantity', '<', 3)->where('quantity', '>', 0)->get();
    return Datatables::of($threeQuantity)
    ->addColumn('action', function ($threeQuantity) {
    return '<a href="'.route('manage.products.Quantity',['id' => $threeQuantity->id]).'" class="btn btn-xs btn-primary">اضافة كمية</a>
    <a href="'.route('manage.products.Quantity',['id' => $threeQuantity->id]).'" class="btn btn-xs btn-primary">حذف كمية</a>
    <input type="hidden" name="row" value="'.$threeQuantity->id.'" id="row">';
    })
    ->make(true);
    }*/

    public function lessThan25(Request $request)
    {
        /*$products = [];
        $all_products = Product::where('archive', 0)->get();
        foreach ($all_products as $product) {
            if ($product->quantity < 25 && $product->quantity > 0)
            {
                array_push($products, $product);
            }
        }*/

        $rare_products = array();
        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $all_products = Product::select('id', 'name')->where('archive', 0)->get();
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
              $search_index = '';
              $all_products = Product::select('id', 'name')->where('archive', 0)->get();
            }
            else
            {
               $all_products = Product::select('id', 'name')->where('archive', 0)
                                                           ->where('name', 'LIKE', "%{$search_index}%")
                                                           ->get();
            }
        }
       // $all_products = Product::select('id', 'name')->where('archive', 0)->get();
        foreach ($all_products as $product) {
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($rare_products);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());
  // return $request->url();
        return view('owner_dashboard.quantity.lessThree', ['rare_products' => $paginatedItems, 'search_index' => $search_index]);

        // return view('owner_dashboard.quantity.lessThree', compact('rare_products'));
    }

    /*public function zeroData(){
    $zeroQuantity = Product::where('quantity',0)->get();
    return Datatables::of($zeroQuantity)
    ->addColumn('action', function ($zeroQuantity) {
    return '<a href="'.route('manage.products.Quantity',['id' => $zeroQuantity->id]).'" class="btn btn-xs btn-primary">اضافة كمية</a>
    <input type="hidden" name="row" value="'.$zeroQuantity->id.'" id="row">';
    })
    ->make(true);
    }*/

    public function zero(Request $request)
    {
        /*
        $products = [];
        $all_products = Product::where('archive', 0)->get();
        foreach ($all_products as $product) {
            if ($product->quantity == 0) {
                array_push($products, $product);
            }
        }
        */

        $rare_products = array();
        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $all_products = Product::select('id', 'name')->where('archive', 0)->get();
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
              $search_index = '';
              $all_products = Product::select('id', 'name')->where('archive', 0)->get();
            }
            else
            {
               $all_products = Product::select('id', 'name')->where('archive', 0)
                                                           ->where('name', 'LIKE', "%{$search_index}%")
                                                           ->get();
            }
        }

        foreach ($all_products as $product)
        {
            foreach($product->stores as $store)
            {
                $quantity = ProductStoreQuantity::where(['product_id' => $product->id, 'store_id' => $store->id])->sum('quantity');

                if ($quantity == 0)
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
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($rare_products);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        return view('owner_dashboard.quantity.zero', ['rare_products' => $paginatedItems, 'search_index' => $search_index]);
      //  return view('owner_dashboard.quantity.zero', compact('rare_products'));
    }

    public function lessThanZero(Request $request)
    {
        /*
        $products = [];
        $all_products = Product::where('archive', 0)->get();
        foreach ($all_products as $product) {
            if ($product->quantity < 0) {
                array_push($products, $product);
            }
        }*/

        $rare_products = array();
        if (!$request->has('search_index') || $request->search_index == '')
        {
            $search_index = '';
            $all_products = Product::select('id', 'name')->where('archive', 0)->get();
        }
        else
        {
            $search_index = trim($request->search_index);
            if (empty($search_index))
            {
              $search_index = '';
              $all_products = Product::select('id', 'name')->where('archive', 0)->get();
            }
            else
            {
               $all_products = Product::select('id', 'name')->where('archive', 0)
                                                           ->where('name', 'LIKE', "%{$search_index}%")
                                                           ->get();
            }
        }

        foreach ($all_products as $product)
        {
            foreach($product->stores as $store)
            {
                $quantity = ProductStoreQuantity::where(['product_id' => $product->id, 'store_id' => $store->id])->sum('quantity');

                if ($quantity < 0)
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

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($rare_products);
        $perPage = 10;
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $paginatedItems= new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedItems->setPath($request->url());

        return view('owner_dashboard.quantity.lessThanZero', ['rare_products' => $paginatedItems, 'search_index' => $search_index]);
       // return view('owner_dashboard.quantity.lessThanZero', compact('rare_products'));
    }

    /*=======================================
      generate zero quantity in excel sheet
    =========================================*/
    public function zero_excel()
    {
      return Excel::download(new QuantityZeroExport(), 'zero_quantity.xlsx');
    }
    /*=============================================
      generate quantity less than 25 in excel sheet
    ===============================================*/
    public function twentyFive_excel()
    {
      return Excel::download(new QuantityTwentyFiveExport(), '25_quantity.xlsx');
    }
    /*=============================================
      generate quantity less than 0 in excel sheet
    ===============================================*/
    public function lessZero_excel()
    {
      return Excel::download(new QuantityLessZeroExport(), 'less-0.xlsx');
    }

}

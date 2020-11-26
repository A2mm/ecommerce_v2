<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product ;
use App\Review ;


class ReviewController extends Controller
{
    public function show($id)
    {
      $product = Product::findOrFail($id);
      $reviews = Review::where('product_id' , $id)->get();

      return view('owner_dashboard.products.reviews' , compact('product' , 'reviews'));
    }
}

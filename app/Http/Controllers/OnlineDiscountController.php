<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\OnlineDiscount;
use App\Product;

class OnlineDiscountController extends Controller
{
    /*==============================================
      Display creae page for online discount product
    ================================================*/
    public function create($id)
    {
       $product = Product::findOrFail($id);
       $discount = OnlineDiscount::where('product_id' , $id)->first();
       $priceDiscount = $discount ? $discount->discount : $product->productPrices() ;

       return view('owner_dashboard.online-discount.create' , compact('product' , 'priceDiscount'));
    }

    /*=================================================
      Store function for create online discount product
    ===================================================*/
    public function store(Request $request , $id)
    {
        $this->validate($request,[
          'discount' => 'required|min:1',
        ]);
        
        if ($request->discount <= 0 ) {
          return redirect()->back()->with('error' , 'يجب ان يكون سعر الخصم اكبر من 0')->withInput();
        }

         $requestData = $request->all();
         $requestData['product_id'] = $id ;
         $product = Product::findOrFail($id);
         $discount = OnlineDiscount::where('product_id' , $id)->first();
         /* if ($discount) {
           if ($requestData['discount'] > $product->productPrices()) {
             return redirect()->back()->with('error' , 'يجب ان يكون سعر الخصم اقل من سعر المنتج')->withInput();
           }
           $discount->delete();
           OnlineDiscount::create($requestData);
         }else {
           OnlineDiscount::create($requestData);
         }*/

         if ($requestData['discount'] > $product->productPrices()) {
             return redirect()->back()->with('error' , 'يجب ان يكون سعر الخصم اقل من سعر المنتج')->withInput();
         }

         if ($discount)
         {
           $discount->update(['discount' => $requestData['discount']]);
         }
         else
         {
           OnlineDiscount::create($requestData);
         }

         return redirect()->back()->with('message' , 'تم اضافة الخصم');
    }

    /*=====================================
      Remove discount from product price
    =======================================*/
    public function destroy($id)
    {
      $onlineDiscount = OnlineDiscount::where('product_id' , $id)->first();
      $onlineDiscount->delete();
      return redirect()->back()->with('message' , 'تم حذف الخصم من المنتج');
    }

}

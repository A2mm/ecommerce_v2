<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use App\Product;
use App\OnlineDiscount;
use Auth;
use Carbon\Carbon;

class CouponController extends Controller
{
    /*===========================================
      Display index page for all products coupons
    =============================================*/
    public function index()
    {
        $coupons = Coupon::all();
        return view('owner_dashboard.coupons.index', compact('coupons'));
    }

    /*======================================
      Display create page for product coupon
    ========================================*/
    public function create()
    {
        $types = ['product_discount' , 'total_price'];
        // get products that not has discount
        $productIds   = OnlineDiscount::pluck('product_id');
        $all_products = Product::whereNotIn('id', $productIds)->get();
        $products = [];
        foreach ($all_products as $product) {
            if ($product->existQuantity() > 0) {
                array_push($products, $product);
            }
        }
        return view('owner_dashboard.coupons.create', compact('types', 'products'));
    }

    /*========================================
      Store function for create product coupon
    ==========================================*/
    public function store(Request $request)
    {
      $this->validate($request, [
          'code' => 'required|min:2|max:10|unique:coupones,code,NULL,id,deleted_at,NULL',
         // 'code' => 'required|unique:coupones|min:2|max:10',
          'expire_date' => 'required',
          'expire_time' => 'required|date_format:"H:i"',
          'precentge' => 'integer',
          'type' => 'required',
      ]);
      $now = Carbon::now()->toDateTimeString();
      $expire = Carbon::parse($request->expire_date . ' ' . $request->expire_time)->toDateTimeString();
      if ($now > $expire) {
          return back()->withErrors(__('translations.expire_time_should_be_greater_than_now'))->withInput();
      }

      $code = $request->code ;

      if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $code) || strlen($code) == strlen(intval($code)))
      {
          return redirect()->back()->withInput()->with('error' , 'يجب ان يتكون الكود من ارقام و حروف فقط');
      }

      $coupon = new Coupon;
      $coupon->code = $request['code'];
      $coupon->owner_id = Auth::user()->id;
      $coupon->owner_name = Auth::user()->name;
      $coupon->expiry_date = $expire;
      $type = $request->type;
      $coupon->type = $type;
      if ($type === 'flat_rate') {
          $this->validate($request, [
              'restrict_price' => 'required|numeric|min:1',
          ]);

          $max_price = $request->restrict_price - 1;
          $message = [
            'flat_rate.max' => 'يجب الا يكون سعر الخصم اكبر من ' . $max_price ,
          ] ;

          $this->validate($request, [
              'flat_rate' => 'required|numeric|min:1|max:' . $max_price,
          ] , $message);

          $coupon->restrict_price = $request->restrict_price;
          $coupon->flat_rate = $request->flat_rate;
      }
      if ($type === 'total_price') {
          $this->validate($request, [
              'precentge' => 'required|integer|min:1|max:99',
          ]);
          $coupon->discount = $request->precentge;
      }
      if ($type === 'product_discount') {
          $this->validate($request, [
              'product_id' => 'required|exists:products,id',
              'precentge' => 'required|integer|min:1|max:99',
          ]);
          $coupon->product_id = $request->product_id;
          $coupon->discount = $request->precentge;
      }
      if (!$coupon->save()) {
          abort(500);
      }
      return redirect()->route('coupon.index')->withMessage(__('translations.copoun_created_successfuly'));

    }

    /*=====================================
      Display view page for product coupon
    =======================================*/
    public function show($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon['expiry_date'] = Carbon::parse($coupon->expiry_date)->format('Y-m-d g:i A');
        return view('owner_dashboard.coupons.view', compact('coupon'));
    }

    /*=====================================
      Display edit page for product coupon
    =======================================*/
    public function edit($id)
    {
      $coupon = Coupon::findorFail($id);
      if ($coupon->IsExpire()) {
          abort(404);
      }
      $types = ['total_price', 'product_discount'];
      $all_products = Product::all();
      $products = [];
      foreach ($all_products as $product) {
          if ($product->quantity_in_stores() > 0) {
              array_push($products, $product);
          }
      }
      $expire = explode(' ', $coupon->expiry_date);
      $coupon['expire_date'] = $expire[0];
      $time = explode(':', $expire[1]);
      $coupon['expire_time'] = $time[0] . ':' . $time[1];
      return view('owner_dashboard.coupons.edit', compact('coupon', 'types', 'products'));
    }

    /*=======================================
      Update function for edit product copoun
    =========================================*/
    public function update(Request $request , $id)
    {
      $coupon = Coupon::findOrFail($id);

        $this->validate($request, [
            //'code' => 'required|min:2|max:10|unique:coupones,deleted_at,NULL,'.$coupon->id,
            // 'code' => 'required|min:2|max:10|unique:coupones,code,' . $coupon->id,
            'expire_date' => 'required',
            'expire_time' => 'required|date_format:"H:i"',
           // 'type' => 'required|in:flat_rate,total_price,product_discount',
        ]);

        if ($coupon->IsExpire()) {
            abort(404);
        }
/*        $code =  $request->code ;

        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $code) || strlen($code) == strlen(intval($code)))
        {
            return redirect()->back()->withInput()->with('error' , 'يجب ان يتكون الكود من ارقام و حروف فقط');
        }*/

        $now = Carbon::now()->toDateTimeString();
        $expire = Carbon::parse($request->expire_date . ' ' . $request->expire_time)->toDateTimeString();
        if ($now > $expire) {
            return back()->withErrors(__('translations.expire_time_should_be_greater_than_now'))->withInput();
        }
      //  $coupon->code = $request['code'];
        $coupon->owner_id = Auth::user()->id;
        $coupon->owner_name = Auth::user()->name;
        $coupon->expiry_date = $expire;
        // $type = $request->type;
       // $coupon->type = $type;
       /* if ($type === 'flat_rate') {
            $max_price = $request->restrict_price - 1;
            $this->validate($request, [
                'restrict_price' => 'required|integer|min:1|digits_between:1,5',
                'flat_rate' => 'required|integer|digits_between:1,10|min:1|max:' . $max_price,
            ]);
            $coupon->restrict_price = $request->restrict_price;
            $coupon->flat_rate = $request->flat_rate;
            $coupon->discount = null;
            $coupon->product_id = null;
        }
        if ($type === 'total_price') {
            $this->validate($request, [
                'precentge' => 'required|integer|min:1|max:99',
            ]);
            $coupon->discount = $request->precentge;
            $coupon->restrict_price = null;
            $coupon->flat_rate = null;
            $coupon->product_id = null;
        }
        if ($type === 'product_discount') {
            $this->validate($request, [
                'product_id' => 'required|exists:products,id',
                'precentge' => 'required|integer|min:1|max:99',
            ]);
            $coupon->product_id = $request->product_id;
            $coupon->discount = $request->precentge;
            $coupon->flat_rate = null;
            $coupon->restrict_price = null;
        }*/
        if (!$coupon->save()) {
            abort(500);
        }
        return redirect()->route('coupon.index')->withMessage(__('translations.copoun_updated_successfuly'));
    }

    /*==========================================
      Destroy function for delete product copoun
    ============================================*/
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->delete();
        return redirect()->route('coupon.index')->withMessage(__('translations.copoun_deleted_successfuly'));
    }
}

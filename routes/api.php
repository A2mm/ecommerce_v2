<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'cors'], function () {

Route::post('/products', 'API\productApiController@allProducts');
Route::post('/productss', 'API\productApiController@allProductss');
Route::get('/shipments', 'API\productApiController@shipments');

Route::post('/product/show/mat', 'API\productApiController@allProductsMat');

Route::post('/product', 'API\productApiController@showOneProduct')->name('showOneProduct');
Route::get('/categoryTree', 'API\productApiController@all_catecories_subcategories')->name('categoryTree');
Route::get('/categoryTreeNothide', 'API\productApiController@all_catecories_subcategories_nothide')->name('categoryTreeNothide');

Route::post('/product/search', 'API\productApiController@search');

Route::get('/subcategory', 'API\productApiController@allSubcategory');
Route::post('/subcategory', 'API\productApiController@showOneSubcategory');

Route::get('/accessory', 'API\productApiController@allAccessory');
Route::post('/accessory', 'API\productApiController@showOneAccessory');

// new api added ahmed 

   Route::get('/latest/products', 'API\productApiController@latest_products');
   Route::get('/hot/discount/offers', 'API\productApiController@hot_discount_offers');
   Route::get('/cheapest/products', 'API\productApiController@cheapest_products');
   Route::get('/best/selling/products', 'API\productApiController@best_seller_products');

   // banner api
   Route::post('/get/banners/by/type', 'API\productApiController@get_banners');

   Route::get('/stores/address', 'API\productApiController@get_stores_adress');


// new apis added ahmed 
//SHAPES
Route::get('/shapes', 'API\productApiController@allShapes');

Route::get('/slider/{token?}', 'API\productApiController@GetImages');

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', 'API\productApiController@register');
Route::post('/verify/account', 'API\productApiController@verifyCode');
Route::post('/login', 'API\productApiController@login');
Route::post('/verify/account', 'API\productApiController@verifyAccount');
Route::get('dd', function (Request $r) {
    $user = App\User::getWithApiToken($r['api_token']);
    return $user->email;
});

/* added
Route::post('/gender/show', 'API\productApiController@getGender');

*/
//order
Route::post('/order', 'API\productApiController@getOrders');
Route::post('/order/post', 'API\productApiController@postOrder');
Route::post('/order/remove', 'API\productApiController@RemoveOrder');
Route::post('/order/edit','API\productApiController@editOrder');
//PROFILE
Route::post('/profile', 'API\productApiController@profile');

Route::post('/edit/profile', 'API\productApiController@editProfile');
Route::post('/change/password', 'API\productApiController@changePassword');

// Route::post('/editprofile', 'API\productApiController@editProfile');
// Route::post('/changepass', 'API\productApiController@changePassword');

/*
*/
//buying
Route::post('/buy', 'API\productApiController@buy');
Route::post('/payment', 'API\productApiController@Payment');

Route::get('/clientToken', 'API\productApiController@generateToken');
Route::post('/brainTreePay', 'API\productApiController@brainTree');
//Recommended
Route::post('/recommended', 'API\productApiController@recommended');


// ahmed added new 
Route::post('/history/both', 'API\productApiController@getHistory2');


//histories
Route::post('/history', 'API\productApiController@getHistory');
Route::post('/history/remove', 'API\productApiController@getRemoveHistory');


//WishList and remove note
Route::post('/wish', 'API\productApiController@getWishlist');
Route::post('/wish/add', 'API\productApiController@AddWish');
Route::post('/wish/remove', 'API\productApiController@getRemoveWish');
/*
//Auction
Route::get('/auction', 'API\productApiController@auction');
Route::post('/auction', 'API\productApiController@getAuctionProduct');
Route::post('/auction/post', 'API\productApiController@postAuction');



*/
Route::post('/review/remove', 'API\productApiController@getRemoveReview');
Route::post('/review/add', 'API\productApiController@addReview');
/*
//Vendors
Route::get('/vendors', 'API\productApiController@allVendors');
Route::post('/vendor', 'API\productApiController@getVendor');

//Suppliers
Route::get('/suppliers', 'API\productApiController@allSuppliers');
Route::post('/supplier', 'API\productApiController@getSupplier');

//Digital Products
Route::get('/digitals', 'API\productApiController@allDigitals');
Route::get('/digital', 'API\productApiController@getDigital');
Route::get('/downdigital', 'API\productApiController@downloadDigitalProduct');
*/
//Forgot Password
Route::post('/forgot', 'API\productApiController@postForgot');
Route::post('/code', 'API\productApiController@checkResetCode');
Route::post('/reset', 'API\productApiController@resetPassword');

//REORDER and EDIT QUANTITY

Route::post('/quantity/edit', 'API\productApiController@EditQuantity');
Route::post('/reorder', 'API\productApiController@reOrder');

//FACEBOOK
Route::post('/facebook', 'API\productApiController@facebook');

Route::post('/competition', 'API\productApiController@competitionUse');
Route::get('/ads', 'API\productApiController@ads');

Route::post('/checkPromo', 'API\productApiController@checkPromoCode');
/*
Route::get('/wireTransfer', 'API\productApiController@wire_transfer');
Route::post('/getSearchLists', 'API\productApiController@getSearchLists');
Route::get('/getCountries', 'API\productApiController@getCountries');

Route::post('/getWallet', 'API\productApiController@getWallet');
Route::post('/generateCode', 'API\productApiController@generateCode');

*/ // added
////////////seller////////////

Route::post('/customer/register', 'API\sellerApiController@customer_register')->middleware('track');

Route::group(['prefix' => 'seller'], function () {
    Route::post('/login', 'API\sellerApiController@login')->middleware('track');
    Route::post('/checkProducts', 'API\sellerApiController@getProductsPrices')->middleware('track');
    Route::post('/checkProducts/phone', 'API\sellerApiController@getProductsPrices_phone')->middleware('track');
    Route::post('/products', 'API\sellerApiController@getSellerProducts')->middleware('track');
    Route::post('/product', 'API\sellerApiController@getProduct')->middleware('track');
    Route::post('/putproduct', 'API\sellerApiController@putProduct')->middleware('track');
    Route::post('/checkout', 'API\sellerApiController@checkout')->middleware('track');
    Route::post('/history', 'API\sellerApiController@history')->middleware('track');
    Route::post('/scan/bill', 'API\sellerApiController@scan_bill2')->middleware('track');
    Route::post('/refund', 'API\sellerApiController@refund2')->middleware('track');
    Route::post('/store/last/7/days/history', 'API\sellerApiController@store_last_7_days_history')->middleware('track');
    Route::post('/store/last/7/days', 'API\sellerApiController@store_last_7_days')->middleware('track');
    Route::post('/history/invoice', 'API\sellerApiController@history2')->middleware('track');
    Route::post('/store/last/10/days', 'API\sellerApiController@store_last_10_days');
   // Route::post('/store/last/10/days', 'API\sellerApiController@store_last_10_days');

    Route::post('/get/inprogress', 'API\sellerApiController@get_in_progress3')->middleware('track');
   // Route::post('/deliver/inprogress', 'API\sellerApiController@seller_deliver_order');
    Route::post('/deliver/inprogress', 'API\sellerApiController@seller_deliver_order3')->middleware('track');


});

// Route::post('date', 'API\sellerApiController@date_post');

Route::get('/replaceMainImages', 'API\productApiController@replaceMainImages');
Route::get('/replaceSmallImages', 'API\productApiController@replaceSmallImages');
Route::get('/category_attributes', 'API\productApiController@category_attributes');
Route::get('/subcategory_attributes', 'API\productApiController@subcategory_attributes');
Route::post('/filtered_products', 'API\productApiController@filtered_products');
Route::get('/attribute_types', 'API\productApiController@attribute_types');
Route::get('/best_products', 'API\productApiController@best_products');
Route::get('/get_sliders','API\productApiController@getSliders');
Route::get('/get_banners','API\productApiController@getBanners');
Route::get('/get_banner','API\productApiController@getBanner');
Route::post('/get_user_api_token','API\productApiController@api_token');
Route::get('/paymentMethods','API\productApiController@payment_methods');

});




/*
public function history(Request $request)

    {
      $validator = Validator::make($request->all(), [
            'api_token' => 'required',
            'per_page' => 'required',
        ]);
        if ($validator->fails()) {
          return response()->json([
              'message' => $validator->errors()->first(),
              'code' => 400,
          ]);
        }

        $seller = Seller::where([
            'api_token' => $request->api_token,
            'suspend' => 0,
        ])->first();

        if (!$seller) {
            return response()->json(['code' => 401, 'message' => __('translations.unauthorized_seller')], 401);
        }

        // get history by dates OR not
        $per_page = $request->per_page;
        if (isset($request->date) && $request->date != '') {
          $validator = Validator::make($request->all(), [
                'date' => 'required|date_format:Y-m-d',
            ]);
            if ($validator->fails()) {
              return response()->json([
                  'message' => $validator->errors()->first(),
                  'code' => 400,
              ], 400);
            }
            $date = Carbon::parse($request->date)->toDateTimeString();
            $histories = History::where(['store_id' => $seller->store_id])
                ->whereDate('created_at', '=', $date)
                ->paginate($per_page);

        } else {
            $date = Carbon::now();
            $histories = History::where(['store_id' => $seller->store_id])
                ->whereDate('created_at', '<=', $date)
                ->select('id', 'user_id', 'product_id', 'order_status', 'quantity', 'price', 'refunded', 'created_at', 'bill_id', 'purchase_id', 'sellerdiscount')
                ->paginate($per_page);
        }
        $arr = array();
        foreach ($histories as $history) {
            // get each history by the country currency he bought by
           // $history->product;
           // if ($history->country_code == '' || $history->country_code == 'ww') {
                $currency = 'جنيه';
            //}
           // $history->country_code == 'SA' ? $currency = 'SR' : $currency = 'EGP';
                $product = Product::where('id', $history->product_id)->first();
                if ($history->quantity == 0)
                {
                   $item_price = 0;
                }
                else
                {
                    $item_price = $history->price / $history->quantity;
                    /*
                    $purchase_price = explode(' ', $history->purchase->price);
                    $purchase_price = $purchase_price[0];
                    $real_purchase_price = $history->purchase->getRealPrice();
                    if ($purchase_price == $real_purchase_price) {
                        $history['total_price'] = $history->price . ' ' . $currency;
                    } else {
                        $discount_applied = ($purchase_price / $real_purchase_price) * 100;
                        $history_total = ($discount_applied / 100) * $history->price;
                        $history['total_price'] = $history_total . ' ' . $currency;
                    }*/
//                }
                 //$history['price'] = $history->price . ' ' . $currency;

             //   $purchase    = Purchase::where('id', $history->purchase_id)->first();
              //  $price_after_discount = $purchase->price;
               // $total_price = $price_after_discount;

/*
                $history['id'] = $history->id;
                $history['user_id'] = $history->useer_id;
                $history['product_id'] = $history->product_id;
                $history['order_status'] = $history->order_status;
                $history['item_price'] = $item_price. ' '. $currency;
                $history['quantity'] = $history->sum('quantity');
                $history['total_price'] = $history->sum('price');
                $history['product_name'] = $product->name;
                $history['product_unique_id'] = $product->unique_id;
                $history['refunded'] = $history->refunded;
                // $history['product_category'] = $product->category->name;
                //$history['product_subcategory'] = $product->subcategory->name;
                $history['created_at'] = $history->created_at;
                $history['bill_id'] = $history->bill_id;
                //$history['seller_discount'] = $seller->discount;
*/
           /*     if ($history->quantity < 0)
                {
                    continue;
                }
                else
                {
                    array_push($arr, [
                        //$history['id'] = $history->id;
                        //$history['user_id'] = $history->useer_id;
                        'product_id' => $history->product_id,
                        'order_status' => $history->order_status,
                        'item_price' => $item_price. ' '. $currency,
                        'quantity' => $history->sum('quantity'),
                        'total_price' => $history->sum('price'),
                        'product_name' => $product->name,
                        'product_unique_id' => $product->unique_id,
                        'refunded' => $history->refunded,
                        'created_at' => $history->created_at,
                        'bill_id' => $history->bill_id,
                    ]);
                }

        }*/

     /*   return response()->json([
            'histories' => $arr,
            'code' => 200,
        ]);

    }
*/

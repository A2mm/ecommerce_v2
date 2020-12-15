<?php

use Illuminate\Http\Request;

Route::group(['middleware' => 'cors'], function () {

Route::post('/products', 'API\productApiController@allProducts');
Route::get('/shipments', 'API\productApiController@shipments');

Route::post('/product/show/mat', 'API\productApiController@allProductsMat');

Route::post('/product', 'API\productApiController@showOneProduct')->name('showOneProduct');
Route::get('/categoryTree', 'API\productApiController@all_catecories_subcategories')->name('categoryTree');
Route::get('/categoryTree2', 'API\productApiController@all_catecories_subcategories2')->name('categoryTree2');

Route::post('/product/search', 'API\productApiController@search');

Route::get('/subcategory', 'API\productApiController@allSubcategory');
Route::post('/subcategory', 'API\productApiController@showOneSubcategory');

Route::get('/accessory', 'API\productApiController@allAccessory');
Route::post('/accessory', 'API\productApiController@showOneAccessory');

// new api added 

   Route::get('/latest/products', 'API\productApiController@latest_products');
   Route::get('/hot/discount/offers', 'API\productApiController@hot_discount_offers');
   Route::get('/cheapest/products', 'API\productApiController@cheapest_products');
   Route::get('/best/selling/products', 'API\productApiController@best_seller_products');

   // banner api
   Route::post('/get/banners/by/type', 'API\productApiController@get_banners');

   Route::get('/stores/address', 'API\productApiController@get_stores_adress');


// new apis added  

Route::post('/register', 'API\productApiController@register');
Route::post('/verify/account', 'API\productApiController@verifyCode');
Route::post('/login', 'API\productApiController@login');
Route::post('/verify/account', 'API\productApiController@verifyAccount');

//order
Route::post('/order', 'API\productApiController@getOrders');
Route::post('/order/post', 'API\productApiController@postOrder');
Route::post('/order/remove', 'API\productApiController@RemoveOrder');
Route::post('/order/edit','API\productApiController@editOrder');
//PROFILE
Route::post('/profile', 'API\productApiController@profile');

Route::post('/edit/profile', 'API\productApiController@editProfile');
Route::post('/change/password', 'API\productApiController@changePassword');

//buying
Route::post('/buy', 'API\productApiController@buy');
Route::post('/payment', 'API\productApiController@Payment');

Route::get('/clientToken', 'API\productApiController@generateToken');
Route::post('/brainTreePay', 'API\productApiController@brainTree');
//Recommended
Route::post('/recommended', 'API\productApiController@recommended');

//histories
Route::post('/history', 'API\productApiController@getHistory');
Route::post('/history/remove', 'API\productApiController@getRemoveHistory');

//WishList and remove note
Route::post('/wish', 'API\productApiController@getWishlist');
Route::post('/wish/add', 'API\productApiController@AddWish');
Route::post('/wish/remove', 'API\productApiController@getRemoveWish');


Route::post('/review/remove', 'API\productApiController@getRemoveReview');
Route::post('/review/add', 'API\productApiController@addReview');

//Forgot Password
Route::post('/forgot', 'API\productApiController@postForgot');
Route::post('/code', 'API\productApiController@checkResetCode');
Route::post('/reset', 'API\productApiController@resetPassword');

//REORDER and EDIT QUANTITY
Route::post('/quantity/edit', 'API\productApiController@EditQuantity');
Route::post('/reorder', 'API\productApiController@reOrder');

//FACEBOOK
Route::post('/facebook', 'API\productApiController@facebook');
Route::get('/ads', 'API\productApiController@ads');
Route::post('/checkPromo', 'API\productApiController@checkPromoCode');


// start seller section
Route::post('/customer/register', 'API\sellerApiController@customer_register');

Route::group(['prefix' => 'seller'], function () {
    Route::post('/login', 'API\sellerApiController@login');
    Route::post('/checkProducts', 'API\sellerApiController@getProductsPrices');
    Route::post('/checkProducts/phone', 'API\sellerApiController@getProductsPrices_phone');
    Route::post('/products', 'API\sellerApiController@getSellerProducts');
    Route::post('/product', 'API\sellerApiController@getProduct');
    Route::post('/putproduct', 'API\sellerApiController@putProduct');
    Route::post('/checkout', 'API\sellerApiController@checkout');
    Route::post('/history', 'API\sellerApiController@history');
    Route::post('/scan/bill', 'API\sellerApiController@scan_bill2');
    Route::post('/refund', 'API\sellerApiController@refund2');
    Route::post('/store/last/7/days/history', 'API\sellerApiController@store_last_7_days_history');
    Route::post('/store/last/7/days', 'API\sellerApiController@store_last_7_days');
    Route::post('/history/invoice', 'API\sellerApiController@history2');
    Route::post('/store/last/10/days', 'API\sellerApiController@store_last_10_days');

    Route::post('/get/inprogress', 'API\sellerApiController@get_in_progress3');
    Route::post('/deliver/inprogress', 'API\sellerApiController@seller_deliver_order3');
});

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




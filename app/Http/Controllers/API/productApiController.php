<?php

namespace App\Http\Controllers\API;

use App\Cart;
use App\Category;
use App\CategoryOnline;
use App\Coupon;
use App\Country;
use App\Configuration;
use App\Currency;
use App\History;
use App\Http\Controllers\Controller;
use App\Order;
use App\PasswordReset;
use App\Product;
use App\Purchase;
use App\Review;
use App\OnlineDiscount;
use App\Subcategory;
use App\User;
use App\Vendor;
use App\Wish;
use App\Attribute;
use App\Shipment;
use App\AttributeType;
use Auth;
use Braintree_Gateway;
use Braintree_Transaction;
use Braintree_ClientToken;
use Carbon\Carbon;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Mail;
use Pusher;
use Validator;
use resources\lang;
use Illuminate\Database\Eloquent\Builder;
use App\PaymentMethod;
use App\ProductStoreQuantity;
use App\Usertypeprice;
use Log ;
use App\Bannering;
use App\BanneringType;
use App\Store;

class productApiController extends Controller
{
    public function api_token()
    {
      $users = User::select('name','api_token')->where('api_token','!=','NULL')->get();
      if($users){
        return response($users);
      }
      return response()->json(['message' =>  __('translations.user_not_found')]);
    }

    public function allProducts(Request $request)
    {
       $products = Product::select('id', 'name', 'slug', 'product_benefits')->where('archive', 0)
                                    ->where('available_online' , 1)
                                    ->whereHas('usertypepricess', function ($query)
                                    {
                                        $query->where('usertype_id', 1)->where('price', '>', 0);
                                    }); //->where('category_online_id', 1)->get();

         if ($request->has('category_id') && $request->category_id != 'all' && $request->category_id != '')
         {
            $category_validator = Validator::make($request->all(), [
                'category_id' => 'required|integer|exists:category_onlines,id',
            ]);
            if ($category_validator->fails()) {
                 return response()->json([
                    'message' => $category_validator->errors(),
                    'code'    => 400,
                ], 400);
            }
         }

         if(!isset(request()->category_id) || request()->category_id == 'all' || request()->category_id == '') {
              $products =  $products; //->get(); 
         }
         else
         {
           $products = $products->where('category_online_id', $request->category_id); //->get();
         }

         // return response()->json(['z' => $products]);
       
        if($request->has('per_page')){
            if ($request->per_page == 0) {
              $products = $products->get();
            }else {
              $products = $products->paginate($request->per_page);
            }
        }else{
          return response()->json([
            'message'=>"per_page is required", 
            'code' => 400,
        ], 400);
        }
        foreach ($products as $product) {
                $product->main_image =$product->product_main_image();
                $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
                $product->price = $product->productPrices();
                $product['tags'] = $product->tags->makeHidden(['product_id', 'deleted_at', 'updated_at']);
                $product->discount = $product->discount() . '%';
                $product->price_after_discount = $product->priceWithDiscount();
        }

        //best seller and mostly viewed products
        $best_seller = Product::select('id', 'name', 'category_id', 'subcategory_id', 'slug', 'product_benefits')->orderBy('num_of_orders', 'desc')->where('archive', 0)->first();

        if (isset($request['api_token']) && $request->api_token != '') {

            $token_validator = Validator::make($request->all(), [
                'api_token' => 'required|exists:users,api_token',
            ]);
            if ($token_validator->fails()) {
                 return response()->json([
                    'message' => $token_validator->errors(),
                    'code'    => 400,
                ], 400);
            }

            $user = User::where('api_token', $request->api_token)->first();
            $recommended = 0;
        } else {
            $recommended = -1;
        }

        $response_json =
        [
          $products,
          ];

        if ($request->has('category_id') && $request->category_id != 'all' && CategoryOnline::where('id', $request->category_id)->exists()) {
            $response_json['category'] = CategoryOnline::where('id', $request->category_id)->select('name', 'description')->get();
            $response_json['code'] = 200 ;
        } else {
            $response_json['category'] = 'false';
            $response_json['code'] = 200 ;
        }

        return response()->json([$response_json ] , 200);
    }
 
    public function showOneProduct(Request $request)
    {
      $message = [
        'id.required' => 'يرجي ادخال كود المنتج',
      ];

      if ( (!$request->has('id') || $request->id == '') && (!$request->has('slug') || $request->slug == '') ) {
           return response()->json([
                'message' => 'يرجي ادخال رقم المنتج او الكلمة الدلالية ', 
                'code' => 202,
            ], 202);
      }
        $validator = Validator::make($request->all(), [
          'id' => 'integer|exists:products,id',
          'slug' => 'exists:products,slug',
//          'api_token' => 'required|exists:users,api_token',
        ] , $message);
        if ($validator->fails()) {
               return response()->json([
                'message' => $validator->errors(), 
                'code' => 400,
            ], 400);
           }
        $id   = $request->id;
        $slug = $request->slug;
        
        if ($request->has('api_token') && $request->api_token != '') 
        {
            $T_validator = Validator::make($request->all(), [
                'api_token' => 'exists:users,api_token',
            ]);
            if ($T_validator->fails()) 
            {
                   return response()->json(['message' => $T_validator->errors(), 'code' => 400] ,400);
            }
      
            $user = User::where('api_token' , $request->api_token)->first();
        }

        else
        {
            $user = null;
        }

        if ( (!$request->has('id') || $request->id == '') && ($request->has('slug') && $request->slug != '') ) {
                 
                $product = Product::select('id', 'name', 'unique_id' , 'description' , 'seo_description', 'category_online_id', 'slug', 'product_benefits')

                ->where('slug', $request->slug)->where('archive', 0)->where('available_online' , 1)->first();

            if (!$product) {
                return response()->json([
                    'code' => 201,
                    'message' => __('translations.no_product_found'),
                ]);
            }
        }

        if ($request->has('id') && $request->id != '' && $request->has('slug') && $request->slug != '') 
        {
                $thisP = Product::select('id', 'name', 'slug')->where('id', $request->id)->first();
                if ($thisP->slug !== $request->slug) {
                    return response()->json([
                        'message' => 'هذه الكلمة الدلالية لا تعود لهذا المنتج', 
                        'code' => 202,
                    ], 202);
                }
                else
                {
                     $product = Product::select('id', 'name', 'unique_id' , 'description' , 'seo_description', 'category_online_id', 'slug', 'product_benefits')->where('id', $request->id)
                        ->where('slug', $request->slug)->where('archive', 0)->where('available_online', 1)->first();

                    if (!$product) {
                        return response()->json([
                            'code' => 201,
                            'message' => __('translations.no_product_found'),
                        ]);
                    }

                }
        }

        if ( ($request->has('id') && $request->id != '') && (!$request->has('slug') || $request->slug == '') ) {
                
                $product = Product::select('id', 'name', 'unique_id' , 'description' , 'seo_description', 'category_online_id', 'slug', 'product_benefits')

                ->where('id', $request->id)->where('archive', 0)->where('available_online' , 1)->first();

            if (!$product) {
                return response()->json([
                    'code' => 201,
                    'message' => __('translations.no_product_found'),
                ]);
            }
        }

        $product->price = $product->productPrices();
        $product['tags'] = $product->tags->makeHidden(['product_id', 'deleted_at', 'updated_at']);
        $product->description = htmlspecialchars(strip_tags(stripslashes($product->description)));
        $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
        $discount = OnlineDiscount::where('product_id' , $product->id)->first();
        if ($discount) {
          $product->price_after_discount = $product->priceWithDiscount();
          $product->discount = doubleval($product->discount());
          $product->discount .= " %";
        }else {
          $product->price_after_discount = $product->productPrices();
          $product->discount = $product->discount();
        }
        $category    =  CategoryOnline::where('id' , $product->category_online_id)->select('id' , 'name')->first();
        // $subCategory =  Subcategory::where('id' , $product->subcategory_id)->select('id' , 'name')->first();

         $product['category']    = $category;
         // $product['subcategory'] = $subCategory;

        $product->images = $product->productImages();
        $product->quantity = $product->availableQuantity();

        $category_online_id  = $product->category_online_id ;
        if ($user) {

        $wish = Wish::where('product_id' , $product->id)->where('user_id' , $user->id)->first();
        $product->in_wish_list = $wish ? true : false ;

          $reviews = Review::where('product_id' , $product->id)->select('id', 'user_name' , 'body' , 'created_at'  , 'user_id')->get();

        foreach ($reviews as $key => $review) {
          if ($review->user_id == $user->id) {
            $review->owner_review = true ;
          }else {
            $review->owner_review = false ;
          }
          $review->makeHidden('user_id');
        }
        $product->reviews = $reviews;
        }

        $product->makeHidden(['category_id' , 'subcategory_id' , 'category_online_id']);

        // $product->makeHidden(['category_id' , 'subcategory_id']);
        $relatedProducts = Product::where('category_online_id' ,$category_online_id)->where('id' , '!=' , $product->id)->select('id' , 'name', 'slug', 'product_benefits')->take(10)->get();
        foreach ($relatedProducts as $item) {
          $item->product_benefits = htmlspecialchars(strip_tags(stripslashes($item->product_benefits)));
          $item->main_image = $item->product_main_image();
          $item->price = $item->productPrices();
          $item->price_after_discount = $item->getProductPrice();
          $item->discount = $item->discount();
        }

        // $product = $product->keyBy('id');
        // $product->makeHidden('category_id');
        if (isset($request['api_token']) && $request->api_token != '')  {
            $user = User::where('api_token', $request->api_token)->first();
            $user_name = $user->name;

            $message = __('translations.user');
        } else {
            $message = __('translations.guest');
            $user_name = __('translations.guest');
        }


        if (isset($request['api_token']) && $request->api_token != '')  {
            $user = User::where('api_token', $request->api_token)->first();
            $wish = Wish::where('user_id', $user->id)->where('product_id', $product->id)->first();
            if ($wish) {
                $wishedBefore = ['status' => 1, 'wish_id' => $wish->id];
            } else {
                $wishedBefore = ['status' => 0];
            }
        } else {
            $wishedBefore = __('translations.add_to_wishlist_not_available_guest');
        }
       
        $user = User::where('api_token', $request->api_token)->first();

        $response_json =
        [
          $product,
       ];

        if (isset($in_wish_list)) {
            $response_json['in_wish_list'] = $in_wish_list;
        }
        return response()->json(['product' =>$response_json , 'related_products' => $relatedProducts , 'code' => 200] , 200);
    }

    public function search(Request $request)
    {
            $word = $request->word;
            $perPage = $request->per_page ?? 500 ;
            $products = Product::where('archive', 0)->where('available_online' , 1)->where(function ($q) use ($word) {
                $q->where('name', 'LIKE', "%{$word}%");
            })->orWhereHas('tags', function($q) use ($word){
                                                                $q->where('tag', 'like', "%{$word}%");
                                                            })->select('id' , 'name', 'slug', 'product_benefits');


            $products = $products->latest()->paginate($perPage);

            foreach ($products as $key => $item) {
                $item->product_benefits     = htmlspecialchars(strip_tags(stripslashes($item->product_benefits)));
                $item->main_image           = $item->product_main_image();
                $item->price                = $item->productPrices();
                $item->price_after_discount = $item->priceWithDiscount();
            }

        if (count($products->items()) > 0) {
            return response()->json([$products, 'code' => 200] , 200);
        } else {
            return response()->json(['message' => __('translations.false') , 'code' => 404] , 404);
        }
    }

    public function allSubcategory()
    {
        $subcategories = Subcategory::all();
        $filtred_subcategories = [];

        foreach ($subcategories as $subcategory) {
            $subcategory->image = asset($subcategory->image_path());

            if (count($subcategory->products) > 0) {
                $filtred_subcategories[] = $subcategory;
            }
        }
        return response()->json($filtred_subcategories);
    }

    public function showOneSubcategory(Request $request)
    {
        $id = $request->id;
        $subcategory = Subcategory::find($id);
        if (!$subcategory) {
            return response()->json(['code' => '400', 'message' => __('translations.subcategory_not_found')]);
        }
        $subcategory->image = asset($subcategory->image_path());
        $suppliers = $subcategory->supplier;
        return response()->json($subcategory);
    }

    public function register(Request $request)
    {
        $messages = [
          'email.required' => __('validation.custom.email.required'),
          'email.email' => __('validation.custom.email.email'),
          'password.required' => __('validation.custom.password.required'),
          'name.required' => __('validation.custom.name.required'),
          'name.max' => __('validation.custom.name.max'),
          'email.unique' => __('validation.custom.email.unique'),
          'password.min' => __('validation.custom.password.min'),
          'password.regex' => __('validation.custom.password.regex'),
          'password.same' => __('validation.custom.password.confirmed'),
          'phone.required' => __('validation.custom.phone.required'),
          'password_confirmation.required' => 'حقل تأكيد كلمة المرور مطلوب',
          'password_confirmation.same' => 'يجب أن يتطابق تأكيد كلمة المرور وكلمة المرور'
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|max:30|regex:/^[\p{L} ]+$/u',
            'email' => 'required|email|unique:users',
            'password'  => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|max:30',
            'password_confirmation' => 'required|same:password',
            'phone' => 'required|regex:/(01)[0-9]{9}/|size:11',
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                  'code' => 400,
                  'errors' => $validator->errors(), // added
                 // 'message' => $validator->errors(),
              ], 400);
        }
        $name = $request->name ;
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $name) || strlen($name) == strlen(intval($name)))
        {
          return response()->json([
            'errors' => ['name' => 'يجب ان يتكون الاسم من حروف  و ارقام فقط']]);  // added ahmed
        }

        $contactEmail = $request['email'];
        $subject      = 'project subject verify';
        $code = str_random(6);

        $phone      = $request->phone ;
        $all_phones = User::pluck('phone')->toArray();
        // check if phone exist or not
        if (in_array($phone , $all_phones)) {
          // check if phone related to user account
          $user = User::where('phone' , $phone)->first();

          if (!is_null($user->email)) {
            return response()->json([
                'code'=> 400 , 
                'errors'=> 'هذا الرقم قيد الاستخدام'], 400); // added ahmed
          }
        }
         
          $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'status' => 1,
            'code' => $code,
            'api_token' => str_random(20),
            'points' => 1000,
            'usertype_id'=> 1 ,
            'phone' => $request['phone']
          ]);
          return response()->json([
            'message'   => 'تم التسجيل ',  // 'تحقق من الرسائل القصيرة الخاصة بك لتفعيل الحساب',
            'api_token' => $user->api_token ,
            'status'     => $user->status ,
            // 'sms_verification_code' => $code ,
            'code' => 200,
          ], 200);
    }

    /*===================================
         function for verify account
    =====================================*/
    public function verifyAccount(Request $request)
    {
      $validator = Validator::make($request->all(), [
        'code' => 'required',
        'api_token' => 'required',
      ]);
      if ($validator->fails()) {
          return response()->json(['code' => 400, 'message' => $validator->errors()] , 200);
      }

      $user = User::where('api_token' , $request->api_token)->first();
      if (!$user) {
        return response()->json(['code' => 400, 'message' => 'api token غير صالح'] , 200);
      }

      if ($user->code == $request->code) {
        if ($user->status == 0) {
          $user->update(['status' => 1]);
          return response()->json(['code'=>200 , 'message'=>'تم التحقق من حسابك بنجاح'] , 200);
        }else {
          return response()->json(['code'=>405 , 'message'=>'تم التحقق من حسابك من قبل'] , 200);
        }
      }else {
        return response()->json(['code'=>400 , 'message'=>'الرمز المقدم غير صالح']);
      }
    }

    public function login(Request $request)
    {
        $messages = [
          'email.required' => __('validation.custom.email.required'),
          'email.email' => __('validation.custom.email.email'),
          'password.required' => __('validation.custom.password.required'),
          'password.min' => __('validation.custom.password.short_password'),
        ];
        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'password' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'code' => 400, 'message' => $validator->errors(), 400]);
        }
        $may_be_suspended = User::withTrashed()->where('email', $request['email'])->first();
        if (!$may_be_suspended) {
          return response()->json(['code' => 404, 'message' => 'يرجي التاكد من البريد الالكتروني او كلمة السر'], 404);
        }
        if ( $may_be_suspended && $may_be_suspended->deleted_at != null ) {
          return response()->json(['code' => 403, 'message' => __('auth.suspended')], 403);
        }
        if ( $may_be_suspended->suspend != null ) {
          return response()->json(['code' => 403, 'message' => __('auth.suspended')], 403);
        }
        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {
            if (Auth::user()->status == 0) {
                return response()->json([
                    'code' => 401,
                    // 'message' => 'you are not activated,please check your email',
                    'message' =>'لم يتم تنشيط حسابك ، يرجى التحقق من الرسائل القصيرة الخاصة بك',
                    'api_token' => Auth::user()->api_token ,
                ], 401);
            }
            $user = User::where('email', $request['email'])->first();
           
            return response()->json(['code' => 200, 'message' => true, 'api_token' => $user->api_token,
           ], 200);
        } else {
            return response()->json(['code' => 404, 'message' => 'يرجي التاكد من البريد الالكتروني او كلمة السر']);
        }
    }

    public function getOrders(Request $request)
    {
        if($request->has('api_token')){
          $api_token = $request['api_token'];
          $user = User::where('api_token', $api_token)->first();
        }else{
          return response()->json(['code' => 400, 'message'=>"API_Token is required"], 400);
        }
        if(!$user){
          return response()->json(['code' => 400, 'message' => "API Token isn't valid"], 400);
        }
        $orders = Order::with(array('product' => function ($query) {
            $query->select('id', 'name');
        }))->where('user_id', $user->id)->whereNull('seller_id')->latest()->get();
        $clear_cart = false;

        $checkout_amount = 0;
        $producNum = 0 ;
        if ($orders->count()) {
            foreach ($orders as $order) {
                $product = Product::where('id' , $order->product_id)->first();
                $order['slug'] = $product->slug;
                $order['product_benefits'] = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
                $order['order_id'] = $order->id ;
                $order['product_id'] = $order->product_id ;
                $order['product_name'] = $product->name;
                $order['main_image'] = $product->product_main_image();
                // $order['product_price'] = $product->productPrices() ;
                $order['price'] = $product->productPrices() ;
                $order['discount'] = $product->priceWithDiscount() ;
                $checkout_amount += $order->quantity * $product->priceWithDiscount();
                $producNum += $order->quantity ;
                $order['total_quantity'] = $product->availableQuantity() ;
                $order->makeHidden(['created_at','deleted_at' , 'updated_at' , 'sellerdiscount' , 'seller_id' , 'link_id' , 'store_id' , 'refunded'   , 'bill_id'  , 'purchase_id' , 'user_id' , 'status' ,  'id' , 'product']);
                $order['product']->makeHidden(['id' , 'name']);
            }
        }else {
          return response()->json([
            'message' => 'لا يوجد طلبات',
            'code' => 200 ,
          ] , 200);
        }

        // REVIEW: flag

        $orders_num = $orders->count();
        $old_purchase = Purchase::where('user_id', $user->id)->orderBy('id', 'desc')->first();

        $checkout_amount = $checkout_amount ;
          return response()->json(['products' => $orders, 'total_price' => $checkout_amount, 'number_of_products' => $producNum , 'code' => 200] , 200);
    }

    public function postOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'api_token' => 'required',
          'product_id'=> 'integer',
          'quantity'=> 'required|integer|min:1',
        ]);
        if ($validator->fails()) {
               return response()->json([
                'code' => 400,
                'message' => $validator->errors(),
            ] ,400);
           }
        $product = Product::where('id' , $request['product_id'])->where('available_online' , 1)->first();
        if (!$product) {
          return response()->json(['code' => 404, 'message' => ['product_id' => 'لا يوجد منتج']]);
        }
        $user = User::where('api_token', $request['api_token'])->first();
        if ($user->suspend != null) {
            return response()->json(['code' => 404, 'message' => ['api_token' => __('auth.suspended')]] , 404);
        }

        if ($user && $user->usertype_id == null) 
        {
             $user->update(['usertype_id' => 1]);
        }
        
        $price = Usertypeprice::where('usertype_id' , 1)->where('product_id' , $product->id)->first();
        $productQuantities = $product->existQuantity();
        $email = $user->email;
       
        if ($product) {
           
            if ($productQuantities > 0) {
                if ($product->archive == 0) {
                    if ($request->quantity <= $productQuantities) {
                        $orders = $user->orders;
                        $already_found = [];
                        $price_without_currency = filter_var($product->priceWithDiscount(), FILTER_SANITIZE_NUMBER_INT);
                        if ($orders->count() > 0) {
                            foreach ($orders as $order) {
                                if ($order->product_id == $request->product_id) {
                                    $cart = Cart::where(['product_id' => $request->product_id, 'quantity' => -$order->quantity])->first();

                                    if ($request->quantity == $order->product->availableQuantity()) 
                                    {
                                          $quantity = $request->quantity;
                                          $order->quantity = $quantity; /// addednew
                                          $order->update([
                                                'price' => ($product->priceWithDiscount()) * $quantity,
                                                    // 'country_code' => 'EG',
                                    ]);
                                    }
                                    else
                                    {
                                        $quantity = $request->quantity + $order->quantity;

                                            if ($quantity > $order->product->availableQuantity()) 
                                            {
                                           
                                               $order->quantity = $order->product->availableQuantity();
                                                $order->update([
                                                'price' => ($product->priceWithDiscount()) * $order->product->availableQuantity(),
                                    ]);
                                            } 
                                            else
                                            {
                                                 $order->quantity = $quantity;   
                                                  $order->update([
                                                        'price' => ($product->priceWithDiscount()) * $quantity,
                                    ]);
                                            }

                                         
                                     }
                                  
                                    $order->save();
                                    $cart->quantity = -$order->quantity;
                                    $cart->save();
                                    array_push($already_found, 'found');
                                    $name = $user->name;
                                    $bill_id = $order->bill_id;
                                    $created_at = $order->created_at;
                                    $data = array('email' => $user->email, 'subject' => "Cart reminder");

                                    if ($user->email && $user->email != '') {
                                        Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                            $message->from('me@gmail.com', 'project');
                                            $message->to($data['email']);
                                            $message->subject($data['subject']);
                                        });
                                    }
                                    if ($productQuantities == 0) {
                                        $product->status = 0;
                                    }
                                    $product->save();
                                    return response()->json(['message' => 'تم اضافة المنتج ' , 'code' => 200] , 200);
                                }
                            }
                        }

                        if (count($already_found) == 0) {
                          $quantity = $request->quantity;
                            $new_order = Order::create([
                                'user_id' => $user->id,
                                'product_id' => $request['product_id'],
                                'quantity' => $request['quantity'],
                                'bill_id' => rand(),
                                'price' => $price_without_currency * $request['quantity'],
                            ]);
                            $new_cart = Cart::create([
                                'product_id' => $product->id,
                                'store_id' => $product->store_id,
                                'quantity' => -$request['quantity'],
                                'reason' => 'order',
                            ]);
                            $new_order->update([
                                'price' => ($product->priceWithDiscount()) * $quantity,
                            ]);

                            $name = $user->name;
                            $bill_id = $new_order->bill_id;
                            $created_at = $new_order->created_at;
                            $data = array('email' => $user->email, 'subject' => "Cart reminder");
                            if ($email && $email != '') {
                                Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                    $message->from('me@gmail.com', 'project');
                                    $message->to($data['email']);
                                    $message->subject($data['subject']);
                                });
                            }
                        }
                        if ($productQuantities <= 0) {
                            $product->status = 0;
                        }
                        $product->save();
                        return response()->json(['message' => 'تم اضافة المنتج ' , 'code' => 200] , 200);
                    } 
                    // added ahmed
                    else 
                    {
                        $orders = $user->orders;
                        $already_found = [];
                        $price_without_currency = filter_var($product->priceWithDiscount(), FILTER_SANITIZE_NUMBER_INT);
                        if ($orders->count() > 0) 
                        {
                            foreach ($orders as $order) 
                            {
                                if ($order->product_id == $request->product_id) 
                                {
                                    $cart = Cart::where(['product_id' => $request->product_id, 'quantity' => -$order->quantity])->first();

                                          // $quantity = $request->quantity;
                                          $order->quantity = $product->existQuantity(); /// addednew  
                                          $order->update([
                                                'price' => ($product->priceWithDiscount()) * $product->existQuantity(),
                                          ]);

                                    $order->save();
                                    $cart->quantity = -$order->quantity;
                                    $cart->save();
                                    array_push($already_found, 'found');
                                    $name = $user->name;
                                    $bill_id = $order->bill_id;
                                    $created_at = $order->created_at;
                                    $data = array('email' => $user->email, 'subject' => "Cart reminder");

                                    if ($user->email && $user->email != '') 
                                    {
                                        Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                            $message->from('me@gmail.com', 'project');
                                            $message->to($data['email']);
                                            $message->subject($data['subject']);
                                        });
                                    }
                                    if ($productQuantities == 0) 
                                    {
                                        $product->status = 0;
                                    }
                                    $product->save();
                                    return response()->json(['message' => 'تم اضافة المنتج ' , 'code' => 200] , 200);
                                }
                            }
                        }

                        if (count($already_found) == 0) 
                        {
                          // $quantity = $request->quantity;
                            $new_order = Order::create([
                                'user_id' => $user->id,
                                'product_id' => $request['product_id'],
                                'quantity' => $product->existQuantity(),
                                'bill_id' => rand(),
                                'price' => $price_without_currency * $request['quantity'],
                            ]);
                            $new_cart = Cart::create([
                                'product_id' => $product->id,
                                'store_id' => $product->store_id,
                                'quantity' => -$product->existQuantity(),
                                'reason' => 'order',
                            ]);
                            $new_order->update([
                                'price' => ($product->priceWithDiscount()) * $product->existQuantity(),
                            ]);

                            if ( $request->has('affiliate') && $request->has('slug') ) {
                                $user_slug = $request['affiliate'];
                                $link_slug = $request['slug'];

                                $affiliate = User::where('slug', $user_slug)->first();
                                if ($affiliate) {
                                  $link = Link::where('slug', $link_slug)->where('user_id', $affiliate->id)->first();
                                  if ($link) {
                                    $new_order->update([
                                        'link_id' => $link->id,
                                    ]);
                                  }
                                }
                            }

                            $name = $user->name;
                            $bill_id = $new_order->bill_id;
                            $created_at = $new_order->created_at;
                            $data = array('email' => $user->email, 'subject' => "Cart reminder");
                            if ($email && $email != '') {
                                Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                    $message->from('me@gmail.com', 'project');
                                    $message->to($data['email']);
                                    $message->subject($data['subject']);
                                });
                            }
                        }
                        if ($productQuantities <= 0) 
                        {
                            $product->status = 0;
                        }
                        $product->save();
                    } 
                             return response()->json(['message' => 'تم اضافة المنتج ' , 'code' => 200] , 200);
                    // end added
                } 
                else 
                {
                    return response()->json(['message' =>['product_id' => __('translations.this_product_has_been_archived')], 'code' => 400] , 400);
                }
            } 
            else 
            {
                return response()->json(['message' => ['quantity' => __('translations.no_quantity_available')], 'code' => 400] , 400);
            }
        }
        return response()->json(['message' => ['product_id' => __('translations.unavailable_product')], 'code' => 400] , 400);
    }

    public function RemoveOrder(Request $request)
    {
      $messages = [
        'product_id.required' => 'يرجي ادخال رقم المنتج',
        'api_token.required' => 'يرجي ادخال api token',
      ] ;
        $validator = Validator::make($request->all(), [
          'product_id' => 'required' ,
          'api_token' => 'required'
        ] , $messages);
        if ($validator->fails()) {
               return response()->json($validator->errors() ,400);
           }

        $api_token = $request->api_token ;
        $user = User::where('api_token' , $api_token)->first();

        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ], 201);
        }
        $productId = $request->product_id;
        $order = Order::where('product_id' , $productId)->where('user_id' , $user->id)->first();
        if ($order) {
            $product = Product::where('id', $order->product_id)->first();
            $cart = Cart::create([
                'product_id' => $product->id,
                'store_id' => $product->store_id,
                'quantity' => $order->quantity,
                'reason' => 'user remove order',
            ]);
            $product->update([
                'quantity' => $product->quantity + $order->quantity,
            ]);

            $order->makeHidden(['created_at','deleted_at' , 'updated_at' , 'sellerdiscount' , 'seller_id' , 'link_id' , 'store_id' , 'refunded','price' , 'quantity' , 'bill_id' , 'status' , 'purchase_id']);
            if ($order->forcedelete()) {
                $user = User::where('api_token', $request->api_token)->first();
                // $orders_num = $user->orders->count();
                return response()->json( [ 'message' => 'تم الغاء الطلب' , 'code' => 200] , 200);
            }

            return response()->json( ['message' => 'تم الغاء الطلب' , 'code' => 200] , 200);
        }
        return response()->json([__('translations.no_order_found') , 'code' => 404] , 404);
    }

    public function profile(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'api_token' => 'required'
        ]);
        if ($validator->fails()) {
               return response()->json([
                'code' => 400,
                'message' => $validator->errors(),
           ], 400);
           }
        $api_token = $request['api_token'];
        $user = User::select('name', 'email','phone', 'suspend' , 'id')->where('api_token', $api_token)->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ] , 201);
        }
        if ($user->suspend != null) {
          return response()->json(['code' => 400, 'message' => __('auth.suspended')], 400);
        }
        $user->makeHidden('suspend');

        $histories = History::where('user_id', $user->id)->count();
        $wishlists = Wish::where('user_id', $user->id)->count();

        $user['count_product_in_history']            = $histories;
        $user['count_product_in_wishlist']           = $wishlists;
        $user['count_product_in_cart'] = $user->cart_summary_count();
        $user->makeHidden('id');
        return response()->json([
            'code' => 200,
            'profile' =>  $user,
        ], 200);
    }

    public function editProfile(Request $request)
    {
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ], 201);
        }
        if ($user->suspend != null) {
          return response()->json(['code' => 400, 'message' => __('auth.suspended')], 400);
        }
        $messages = [
          'email.required' => __('validation.custom.email.required'),
          'email.email' => __('validation.custom.email.email'),
          'name.required' => __('validation.custom.name.required'),
          'name.max' => __('validation.custom.name.max'),
          'email.unique' => __('validation.custom.email.unique'),
        ];
        $validator = Validator::make($request->all(), [
            'name'      => 'required|min:3|max:30|regex:/^[\p{L} ]+$/u',
            'email'     => 'required|email|unique:users,email,' . $user->id,
            'api_token' => 'required',
            'phone'     => 'required|regex:/(01)[0-9]{9}/|size:11|unique:users,phone,' .$user->id,
        ], $messages);
        if ($user->email === $request->email && $user->name === $request->name && $user->phone === $request->phone) {
            return response()->json([
                'code' => 401,
                'message' => 'لم تتغير البيانات',
            ], 401);
        }
        // if (count($validator->errors()) > 0) {
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => false,
                'code' => 201,
            ], 201);
        } else {
            $contactEmail = $request['email'];
            $subject = 'Edit Profile';
            $code = str_random(6);
            Mail::send('shop.updateVerificationPage', ['code' => $code], function ($message) use ($contactEmail, $subject) {
                $message->from('me@gmail.com', 'project');
                $message->to($contactEmail);
                $message->subject($subject);
            });
            $user->update([
                'code' => $code,
                'new_email' => $request->email,
                'new_name'  => $request->name,
                'new_phone' => $request->phone,
            ]);

            return response()->json([
                'message' => 'تحقق من بريدك الإلكتروني الجديد لتحديث الملف الشخصي',
                'code' => 200,
                'name'  => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
           ], 200);
        }
    }

    public function changePassword(Request $request)
    {
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ] , 201);
        }
        $messages = [
          'new.required' => __('validation.custom.password.required'),
          'current.required' => __('validation.custom.password.required'),
          'new_confirmation.required' => __('validation.custom.password.confirm_required'),
          'new_confirmation.same' => 'كلمة المرور غير متطابقة',
          'new.min' => __('validation.custom.password.min'),
          'current.min' => __('validation.custom.password.min'),
          'new.regex' => __('validation.custom.password.regex'),
          'new.different' => 'يجب أن يكون الرقم السري الجديد و الحالي مختلفين'
        ];
        $validator = Validator::make($request->all(), [
            'current' => 'required|min:8',
            'new' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|different:current',
            'new_confirmation' => 'required|same:new',
            'api_token' => 'required'

        ], $messages);
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => false,
                'code' => 400,
            ], 400);
        } else {
            $hashedPassword = $user->password;
            if (Hash::check($request->current, $hashedPassword)) {
                $user->fill([
                    'password' => Hash::make($request->new),
                ])->save();

                return response()->json(['code' => 200, 'message' => 'تم تغيير الرقم السري بنجاح'], 200);
            } else {
                return response()->json(['code' => 400, 'message' => 'كلمة المرور الحالية غير صحيحة'], 400);
            }
        }
    }

    public function buy(Request $request)
    {
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
            return response()->json(['code' => 404, 'message' => __('translations.user_doesnot_exist')] , 404);
        }
        if ($user->suspend != null) {
            return response()->json(['code' => 404, 'message' => __('auth.suspended')] , 404);
        }
        $messages = [
          'delivery_address.required' => __('validation.custom.delivery_address.required'),
          'delivery_address.max' => __('validation.custom.delivery_address.max'),
          'billing_address.required' => __('validation.custom.billing_address.required'),
          'billing_address.max' => __('validation.custom.billing_address.max'),
          'billing_address.min' => __('validation.custom.billing_address.min'),
          'receptor_name.required' => __('validation.custom.receptor_name.required'),
        ];
        $validator = Validator::make($request->all(), [

            'delivery_address' => 'required|max:250',
            'billing_address' => 'required|min:6|max:255',
            'receptor_mobile' => 'required|regex:/(01)[0-9]{9}/|size:11',
            'buyer_mobile'    => 'required|regex:/(01)[0-9]{9}/|size:11',
            'receptor_name'   => 'required|min:2|max:30',
            'code'            => 'nullable|max:30',
        ], $messages);
        if ($validator->fails())
        {
            return response()->json([
                'message' => $validator->errors(),
                'code'    => 400,
            ], 400);
        }
        else
        {
            $orders = Order::where('user_id', $user->id)->get(); //->with(['products']);

            $checkout_amount = 0;
            if ($orders->count())
            {
              $price_before_promo = 0 ;
                foreach ($orders as $order)
                {
                    $checkout_amount += $order->price;
                    $price_before_promo += $order->price;
                    if ($order->product->existQuantity() <= 0) {
                      return response()->json([
                        'message' => 'الكمية المطلوبة من  ( ' . $order->product->name . ' ) غير متاحة',
                        'code' => 400 ,
                      ] , 400);
                    }

                    if ($order->product->available_online != 1) {
                      return response()->json([
                        'message' => __('translations.prod_notavailable_online'),
                        'code' => 400 ,
                      ] , 400);
                    }
                }
            }

            if (isset($request->code) && $request->code !== '')
            {
                // check for the validation of the coupon code
                $now = Carbon::now()->toDateTimeString();
                $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>', $now)->first();
                if (!$coupon) {
                  $error = ['code' => ['كوبون غير صحيح']];
                    return response()->json([
                        'code' => 400,
                        'message' => $error,
                    ] , 400);
                }
                // check if user could use this coupon
                if ($user->checkPromoCode($coupon)) {
                    // get total after apply the coupon
                    $checkout_amount = $user->getTotalAfterPromo($coupon);

                } else {
                  $error = ['code' => ['لا يمكن استخدام هذا الكوبون']];
                    return response()->json([
                        'code' => 400,
                        'message' => __('translations.cannot_use_this_coupon'),
                    ] , 400);
                }
            }
            if ($checkout_amount > 0)
            {
                $shipment = Shipment::where('id' , $request['delivery_address'])->first();
                if (!$shipment) {
                  $error = ['delivery_address' => ['هذه المنطقة غبر متاحة']];
                  return response()->json(['message' => $error , 'code' => 404] , 404);
                }
                $shipmentPrice = $shipment->price ;
                $checkout_total_amount = $checkout_amount + $shipmentPrice;
                $purchase = Purchase::create([
                    'user_id' => $user->id,
                    'delivery_address' => $shipment->area,
                    'billing_address' => $request['billing_address'],
                    'receptor_mobile' => $request['receptor_mobile'],
                    'buyer_mobile' => $request['buyer_mobile'],
                    'receptor_name' => $request['receptor_name'],
                    'price' => $checkout_amount,
                    'bill_id' => rand(),
                    'purchase_status' => 'pending',
                    'shipment' => $shipmentPrice,
                ]);
                if (isset($request->code) && $request->code !== ''){
                  $purchase->update(['use_promo' => $request->code]);
                }
                $total_before = $price_before_promo + $shipmentPrice;
                $purchase->makeHidden(['created_at', 'updated_at' , 'price' , 'use_promo' , 'purchase_status' , 'user_id']);
                $purchase->Price = $purchase->getPrice();
                $purchase->price_before_promo = $price_before_promo;
                $user = User::find($user->id);
                $user->update(['customerOrNot' => 1]);
                return response()->json(['message' => 'تمت العملية بنجاح' ,'code' => 200, 'purchase Details' => $purchase, 'Total' => $checkout_total_amount , 'total_befor_promo' => $total_before] , 200);
            }
            else
            {
              return response()->json(['code' => 400 , 'message' => 'لا يوجد طلبات  حاليا'] , 400);
            }
        }
    }

    public function Payment(Request $request)
    {
        $validator = Validator::make($request->all(), [ 'type' => 'required' , 'purchase_id' =>'integer']);
        if ($validator->fails()) {return response()->json([$validator->errors() ,'code' => 400] , 400);}

        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
          return response()->json(['code' => 404, 'message' => __('validation.custom.invalid_user')] , 404);
        }
        if ($user->suspend != null) {
          return response()->json(['code' => 404, 'message' => __('auth.suspended')] , 404);
        }

        $purchase = Purchase::find($request['purchase_id']);
        if (!$purchase ) {
            return response()->json(['code' => 404, 'message' => ['purchase_id' => __('translations.purchase_doesnot_exist')]] , 404);
        }

        if ($purchase->payment_method_id != null) {
            return response()->json(['code' => 400, 'message' => 'هذه العملية تمت من قبل'] , 400);
        }

        $orders = Order::where('user_id', $user->id)->where('seller_id', null)->where('store_id', null)->get();

        if ($orders->count()) 
        {
            $new_purchase = 0;
            foreach ($orders as $order) 
            {
              $latestPrice = $order->product->priceWithDiscount() * $order->quantity;
              $order->update(['price' => $latestPrice]);
              $new_purchase += $latestPrice;
            }
            $purchase->update(['price' => $new_purchase]);
        }
         if (strlen($purchase->use_promo) >= 2)
         {
             if ($purchase->use_promo != null)
            {
                  $now = Carbon::now()->toDateTimeString();
                  $coupon = Coupon::where('code', $purchase->use_promo)->where('expiry_date', '>', $now)->first();
                  $user->updateOrder($coupon);
                 // return 'm';
            }
        }

        $purchase->update([
            'payment_method_id' => $request['type'],
            'purchase_status' => 'pending',
        ]);


        $purchases = Purchase::where([
            'user_id' => $user->id,
            'payment_method_id' => null,
        ])->where('seller_id', null)->forcedelete();

        if (isset($request->code) && $request->code !== '') {
            // check for the validation of the coupon code
            $now = Carbon::now()->toDateTimeString();
            $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>', $now)->first();
            if (!$coupon) {
                return response()->json([
                    'code' => 400,
                    'message' => 'invalid coupon',
                ] , 400);
            }
            // check if user could use this coupon
            if ($user->checkPromoCode($coupon)) {
                // get total after apply the coupon
                $checkout_amount = $user->getTotalAfterPromo($coupon);
            } else {
                return response()->json([
                    'code' => 400,
                    'message' => __('translations.cannot_use_this_coupon'),
                ] , 400);
            }
            $purchase->update([
                'price' => $checkout_amount ,
            ]);
        } else {
            // no coupon applied
            $orders = Order::where('user_id', $user->id)->get();
            $checkout_amount = 0;
            if ($orders->count()) {
                foreach ($orders as $order) {
                    $product = Product::where('id' , $order->product_id)->first();
                    $price = $product->priceWithDiscount() ;
                    $checkout_amount += $order->quantity * $price;
                }
            }
            if ($checkout_amount > 0) {
            } else {
                return response()->json([
                    'code' => 404,
                    'message' => __('translations.no_orders_found'),
                ] , 404);
            }
        }

        $user->update([
            'points' => (int) $user->points + (int) $purchase->price,
        ]);
        $orders = Order::where('user_id', $user->id)->get();
        foreach ($orders as $order) {
            $order->update([
                'purchase_id' => $purchase->id,
                'bill_id' => $purchase->bill_id,
            ]);
        }

        foreach ($orders as $order) {

            if (isset($order->link_id)) {
                $link = Link::find($order->link_id);
                $orders = (int) $link->orders;
                $new_orders = $orders + 1;
                $link->orders = $new_orders;
                $link->save();

            }

            $history = History::create([
                'user_id' => $user->id,
                'product_id' => $order->product->id,
                'purchase_id' => $order->purchase_id,
                'price' => $order->price,
                'order_status' => 'pending',
                'quantity' => $order->quantity,
                'bill_id' => $order->bill_id,
                'order_id' => $order->id,
                'original' => $order->quantity,
                // 'country_code' => $order->country_code,
            ]);
        }

        //To know best seller product

        $num_of_product_orders = $user->orders->pluck('product_id');
        $products = Product::whereIn('id', $num_of_product_orders)->get();
        foreach ($products as $product) {
            $product->update([
                'num_of_orders' => $product->num_of_orders + 1,
            ]);
        }

        $num_of_product_orders = Order::where('user_id', $user->id)->delete();

        $purchase->update(['is_payed' => 1]);
        $purchase->save();

        return response()->json(['message' => 'تم شراء المنتج بنجاح' , 'code' => 200] , 200);
    }

    public function brainTree(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'purchase_id' => 'required',
            'api_token' => 'required',
            'nonce' => 'required',
        ]);
        // return $request->all();
        $currency_configuration = Configuration::where('name', 'main_currency')->first();

        $purchase = Purchase::find($request['purchase_id']);
        if (!$purchase) {
            return response()->json(['code' => 201, 'message' => __('validation.custom.invalid_purchase')]);
        }
        $purchase->update([
            'payment_method_id' => $request['type'],
            'purchase_status' => 'pending',
        ]);
        $user = User::where('api_token', $request['api_token'])->first();
        if (!$user) {
            return response()->json(['code' => 201, 'message' => __('validation.custom.invalid_user')]);
        }

        // delete all purchases that have null methods
        $purchases = Purchase::where([
            'user_id' => $user->id,
            'payment_method_id' => null,
        ])->forcedelete();

        if (isset($request->code) && $request->code !== '') {
            $now = Carbon::now()->toDateTimeString();
            // get coupon for the code sent by the user
            $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>', $now)->first();
            if (!$coupon) {
                return response()->json([
                    'code' => 201,
                    'message' => __('validation.custom.invalid_promo'),
                ]);
            }
            // check if user could use this coupon
            if ($user->checkPromoCode($coupon, $request)) {
                $checkout_amount = $user->getTotalAfterPromo($coupon, $request);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => __('validation.custom.user_invalid_promo')
                ]);
            }
            $purchase->update([
                'price' => $checkout_amount,
            ]);
        } else {
            // no coupons used
            $orders = Order::where('user_id', $user->id)->get();
            $checkout_amount = 0;
            if ($orders->count()) {
                foreach ($orders as $order) {
                    $price = $order->getProductPrice($request);
                    $checkout_amount += $order->quantity * $price;
                }
            }
            // return $orders;
            if ($checkout_amount > 0) {
                $checkout_amount = $checkout_amount + 10;
                $purchase->update([
                    'price' => $checkout_amount,
                ]);
            } else {
                return response()->json([
                    'code' => 201,
                    'message' => __('validation.custom.something_wrong'),
                ]);
            }
        }     

        if ($request->has('country_code')) {
            $country = Country::where('short_name', $request->country_code)->first();

            if ($country) {
                $currency = $country->currency->name;
                $rate = Swap::latest($currency.'/GBP', ['cache_ttl' => 120]);
                $rate = round($rate->getValue(), 2);
                $checkout_amount = $checkout_amount * $rate;
            } else {
                $checkout_amount = $checkout_amount;
            }
        } else {
            $checkout_amount = $checkout_amount;
        }

        $price = explode(' ', $purchase->price);
        // payment process

        $payload = $request->input('payload', false);
        $nonce = $payload['nonce'];
        $result = Braintree_Transaction::sale([
                                'amount' => $checkout_amount,
                                'paymentMethodNonce' => $request->nonce,
                                'options' => [
                                           'submitForSettlement' => True
                                             ]
                  ]);
       
        if ($result->success == true) {
            // payment success
            $user->update([
                'points' => (int) $user->points + (int) $purchase->price,
            ]);
            $purchase->update([
                'payment_method_id' => $request['type'],
                'purchase_status' => __('translations.pending'),
                'is_payed' => 1,
            ]);
            $orders = Order::where('user_id', $user->id)->get();

            foreach ($orders as $order) {
                // set each order to be in history
                $history = History::create([
                    'user_id' => $user->id,
                    'price' => $order->price,
                    'product_id' => $order->product->id,
                    'order_status' => __('translations.in_progress'),
                    'quantity' => $order->quantity,
                    'bill_id' => $order->bill_id,
                    'order_id' => $order->id,
                    'purchase_id' => $order->purchase_id,
                    'country_code' => $order->country_code,
                ]);
            }

            $num_of_product_orders = $user->orders->pluck('product_id');
            $products = Product::whereIn('id', $num_of_product_orders)->get();
            foreach ($products as $product) {
                $product->update([
                    'num_of_orders' => $product->num_of_orders + 1,
                ]);
            }

            $num_of_product_orders = Order::where('user_id', $user->id)->delete();
            return response()->json(['code' => 200, 'message' => __('validation.custom.payment_success')]);
        }
        return response()->json(['code' => 201, 'message' => __('validation.custom.payment_failed')]);
    }

    public function recommended(Request $request)
    {
        if (isset($request['api_token'])) {
            $i_want_to_recommend = 20;
            $recommendations = [];
            $reco_products = [];
            $user = User::where('api_token', $request['api_token'])->first();
            if ($user) {
                $views = View::where('user_id', $user->id)->pluck('product_id');
                $products = Product::whereIn('id', $views)->doesntHave('auction')->get();
                $list_sub_wink = [];
                $all_input_for_suggestions = $products->count();
                foreach ($products as $one) {
                    $list_sub_wink[] = $one->subcategory_id;
                }
                $list_sub_wink_with_count = array_count_values($list_sub_wink);
                foreach ($list_sub_wink_with_count as $key => $value) {
                    $id = $key;
                    //$current_subcategory = Subcategory::find($id);
                    $count_suggestions_for_this_category = $value;
                    $x = round(($i_want_to_recommend * $count_suggestions_for_this_category) / $all_input_for_suggestions);
                    $recommendations = Product::select('id', 'name', 'main_image', 'price')->doesntHave('auction')->inRandomOrder()->where('subcategory_id', $id)->take($x)->get();

                    foreach ($recommendations as $recommendation) {
                        $recommendation->main_image = asset($recommendation->image_path());

                        $reco_products[] = $recommendation;
                    }
                }

                $reco_products = collect($reco_products);
                $recommended_products = $reco_products->forPage(0, 50);

                if (count($recommended_products)) {
                    $recommended_products->all();
                } else {
                    $recommended_products = __('translations.there_are_no_recommended_products_for_you_right_now');
                }
            } else {
                $recommended_products = __('translations.there_are_no_users');
            }
        } else {
            $recommended_products = __('translations.there_are_no_users');
        }

        return response()->json($recommended_products);
    }

    public function GetImages(Request $request, $token = null)
    {
        if ($token) {
            // get orders count in cart and total of orders if token sent
            $random_product = ['a(1).png', 'a(2).png', '3.png', '4.png'];
            $image_paths = [];
            foreach ($random_product as $product) {
                array_push($image_paths, asset('shop_images/slider/' . $product));
            }
            $user = User::where('api_token', $token)->first();
            $orders_num = $user->cart_summary_api();
            $orders = Order::where('user_id', $user->id)->get();
            $checkout_amount = 0;
            if ($orders->count()) {
                foreach ($orders as $order) {
                    $price = $order->getProductPrice($request);
                    $order['product_price_without_currency'] = $price;
                    $checkout_amount += $order->quantity * $price;
                }
            }
            return response()->json([
                'slider' => $image_paths,
                'orders_num' => $orders_num,
                'total price' => $checkout_amount,
            ]);
        }
        $random_product = ['a(1).png', 'a(2).png', '3.png', '4.png'];
        $image_paths = [];
        foreach ($random_product as $product) {
            array_push($image_paths, asset('shop_images/slider/' . $product));
        }
        return response()->json($image_paths);
    }

   
    public function getHistory(Request $request)
    {
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201 ,
          ] , 201);
        }

        if (is_null($request->per_page) || $request->per_page == 0) {

          $billIds = History::where('user_id' , $user->id)->pluck('bill_id')->toArray();
          $uniqueBillIds = array_values(array_unique($billIds));
          $array = [];
          foreach ($uniqueBillIds as $key => $value) {
            $array2 = [];
            $histories = History::where('user_id' , $user->id)->where('bill_id' , $value);
            $array[$key]['id'] = $value;
            $purchases = Purchase::where('user_id' , $user->id)->where('bill_id' , $value) ;
            $array[$key]['price'] = $purchases->first() ? $purchases->first()->getPrice() : null;
            $array[$key]['shipment'] = $purchases->sum('shipment');
            $array[$key]['date'] = $histories->first()->created_at;

            // ahmed added new

            $found_qty = History::where('bill_id', $value)->sum('quantity');
            $minus_qty = History::where('bill_id', $value)->where('price', '<', 0)->get();
            if ($found_qty == 0)
            {
                $array[$key]['bill_status'] = 1;
                $array[$key]['order_status'] = __('translations.hole_refunded');
            }
            if (count($minus_qty) > 0 && $found_qty != 0)
            {
                $array[$key]['bill_status'] = 2;
                $array[$key]['order_status'] = __('translations.partially_refunded');
            }
            if (count($minus_qty) < 1 && $found_qty != 0)
            {
                if (History::where('bill_id', $value)->first()->order_status == 'pending')
                {
                   $array[$key]['bill_status'] = 0;
                   $array[$key]['order_status'] = __('translations.pending');
                }
                elseif (History::where('bill_id', $value)->first()->order_status == 'in progress')
                {
                    $array[$key]['bill_status'] = 0;
                    $array[$key]['order_status'] = __('translations.in_progress');
                }
                elseif (History::where('bill_id', $value)->first()->order_status == 'canceled')
                {
                    $array[$key]['bill_status'] = 0;
                    $array[$key]['order_status'] = __('translations.canceled');
                }
                else
                {
                    $array[$key]['bill_status'] = 0;
                    $array[$key]['order_status'] = __('translations.never_refunded');
                }

            }

           // $array[$key]['order_status'] = $histories->first()->order_status();
            $products = History::where('user_id' , $user->id)->where('bill_id' , $value)->pluck('product_id')->toArray();
            $uniqueProducts = array_unique($products);

            $refunded_quantity =  0 ;
            foreach ($uniqueProducts as $index => $item) {
              $array2[$index]['id'] = $item ;
              $productName = Product::where('id' , $item)->first() ;
              $price  = History::where('user_id' , $user->id)->where('bill_id' , $value)->where('product_id' , $item);
              $array2[$index]['name'] = $productName->name ?? null ;
              $array2[$index]['slug'] = $productName->slug ?? null ;
              $array2[$index]['product_benefits'] = htmlspecialchars(strip_tags(stripslashes($productName->product_benefits))) ?? null ;
             // $order['product_benefits'] = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
              $array2[$index]['image'] = $productName->product_main_image();
              $array2[$index]['price'] = $price->first()->price / $price->first()->quantity;
              $array2[$index]['quantity'] = $price->first()->quantity ;
              $array2[$index]['archive'] = $productName->archive ;
              $quantity_refunded =   $price->sum('quantity') ;
              $array2[$index]['quantity_refunded'] =   $price->first()->quantity - $quantity_refunded  ;
              $refunded_quantity +=  $array2[$index]['quantity_refunded'] ;
              if ($price->first()->quantity == $quantity_refunded) {
                $array2[$index]['status'] = 0 ;
              }elseif ( $quantity_refunded == 0) {
                $array2[$index]['status'] = 1;
              }else {
                $array2[$index]['status'] = 2;
              }
            }
            $histories->first()->order_status == 'canceled' ? $array[$key]['shipment'] = 0 : $array[$key]['shipment'] = $array[$key]['shipment'] ;

            $basicQuantity = $histories->withTrashed()->sum('quantity') ;
            if ( $basicQuantity == 0) {
              $array[$key]['status'] = 1 ;
            }elseif ( $refunded_quantity == 0) {
              $array[$key]['status'] = 0;
            }else {
              $array[$key]['status'] = 2;
            }
            $array[$key]['products'] = $array2 ;

          }

        }else {
          $per_page = $request->per_page ;
          $billIds = History::where('user_id' , $user->id)->pluck('bill_id')->toArray();
          $uniqueBillIds = array_values(array_unique($billIds));
          $array = [];
          $count = 0 ;
          if ($request->page) {
            $page = $request->page ;
            $per_page = $request->per_page *  $page;
            $count = $request->per_page * ($page - 1) ;
          }
          foreach ($uniqueBillIds as $key => $value) {
            $array2 = [];
            if ($key < $count ) {
              continue ;
            }
            if ($count <  $per_page ) {
              $histories = History::where('user_id' , $user->id)->where('bill_id' , $value);
              $array[$key]['id'] = $value;
              $purchases = Purchase::where('user_id' , $user->id)->where('bill_id' , $value) ;
              $array[$key]['price'] = $purchases->sum('price');
              $array[$key]['shipment'] = $purchases->sum('shipment');
              $array[$key]['date'] = $histories->first()->created_at;
              // ahmed added new

              $found_qty = History::where('bill_id', $value)->sum('quantity');
              $minus_qty = History::where('bill_id', $value)->where('price', '<', 0)->get();
              if ($found_qty == 0)
              {
                  $array[$key]['bill_status'] = 1;
                  $array[$key]['order_status'] = __('translations.hole_refunded');
              }
              if (count($minus_qty) > 0 && $found_qty != 0)
              {
                  $array[$key]['bill_status'] = 2;
                  $array[$key]['order_status'] = __('translations.partially_refunded');
              }
              if (count($minus_qty) < 1 && $found_qty != 0)
              {
                  if (History::where('bill_id', $value)->first()->order_status == 'pending')
                  {
                     $array[$key]['bill_status'] = 0;
                     $array[$key]['order_status'] = __('translations.pending');
                  }
                  elseif (History::where('bill_id', $value)->first()->order_status == 'in progress')
                  {
                      $array[$key]['bill_status'] = 0;
                      $array[$key]['order_status'] = __('translations.in_progress');
                  }
                  elseif (History::where('bill_id', $value)->first()->order_status == 'canceled')
                  {
                      $array[$key]['bill_status'] = 0;
                      $array[$key]['order_status'] = __('translations.canceled');
                  }
                  else
                  {
                      $array[$key]['bill_status'] = 0;
                      $array[$key]['order_status'] = __('translations.never_refunded');
                  }

              }



              $products = History::where('user_id' , $user->id)->where('bill_id' , $value)->pluck('product_id')->toArray();
              $uniqueProducts = array_unique($products);

              $refunded_quantity = 0 ;
              foreach ($products as $index => $item) {
                $array2[$index]['id'] = $item ;
                $productName = Product::where('id' , $item)->first() ;
                $price  = History::where('user_id' , $user->id)->where('bill_id' , $value)->where('product_id' , $item);
                $array2[$index]['name'] = $productName->name ?? null ;
                 $array2[$index]['slug'] = $productName->slug ?? null ;
              $array2[$index]['product_benefits'] = htmlspecialchars(strip_tags(stripslashes($productName->product_benefits))) ?? null ;
                $array2[$index]['image'] = $productName->product_main_image();
                $array2[$index]['price'] = $price->first()->price / $price->first()->quantity;
                $array2[$index]['quantity'] = $price->first()->quantity ;
                $array2[$index]['archive'] = $productName->archive ;
                $quantity_refunded =   $price->sum('quantity') ;
                $array2[$index]['quantity_refunded'] =   $price->first()->quantity -$quantity_refunded  ;
                $refunded_quantity +=  $array2[$index]['quantity_refunded'] ;
                if ($price->first()->quantity == $quantity_refunded) {
                  $array2[$index]['status'] = 0 ;
                }elseif ( $quantity_refunded == 0) {
                  $array2[$index]['status'] = 1;
                }else {
                  $array2[$index]['status'] = 2;
                }
              }
              $histories->first()->order_status == 'canceled' ? $array[$key]['shipment'] = 0 : $array[$key]['shipment'] = $array[$key]['shipment'] ;

              $basicQuantity = $histories->withTrashed()->sum('quantity') ;
              if ( $basicQuantity == 0) {
                $array[$key]['status'] = 1 ;
              }elseif ( $refunded_quantity == 0) {
                $array[$key]['status'] = 0;
              }else {
                $array[$key]['status'] = 2;
              }

              $array[$key]['products'] = $array2 ;

            }
            $count++ ;


          }
        }
        $currentPage = $request->page  ?? null;
        return response()->json([
          'bills' => $array ,
          'current_page' => $currentPage ,
          'code' => 200,
        ]);
    }

    public function getRemoveHistory(Request $request)
    {
        $history = History::find($request->id);
        $history->delete();
        return response()->json(['message' => true]);
    }

    public function getWishlist(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'api_token' => 'required'
        ]);
        if ($validator->fails()) {
               return response()->json([
                'code' => 400,
                'message' => $validator->errors(),
            ], 400);
           }
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ], 201);
        }
        $productIds = Wish::where('user_id', $user->id)->pluck('product_id');
        $products = Product::whereIn('id' , $productIds)->select('id' , 'name' , 'archive', 'slug', 'product_benefits')->get();

        foreach ($products as $product) {
          $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
          $product->main_image = $product->product_main_image();
          $product->price = $product->priceWithDiscount();
        }
        return response()->json(['products' => $products , 'code' => 200], 200);
    }

    public function AddWish(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'api_token' => 'required',
          'product_id' => 'required',
        ]);
        if ($validator->fails()) {
               return response()->json(['message' => $validator->errors()->first(), 'code' => 400] ,400);
           }
        $user = User::where('api_token', $request->api_token)->first();
        $exist = Wish::where('product_id', $request['product_id'])->where('user_id', $user->id)->first();
        if (!Product::where('id', $request->product_id)->exists()) {
            return response()->json(['code' => 400, 'message' => 'لا يوجد منتج'], 400);
        }

        if ($exist) {
            return response()->json(['code' => 400, 'message' => 'هذا المنتج موجود بالفعل'], 400);
        } else {
            $wish = Wish::create([
                'user_id' => $user->id,
                'product_id' => $request['product_id'],
            ]);

            $wish->makeHidden(['created_at' , 'updated_at']);

            return response()->json([
               // 'wishs' => $wish,
                'code' => 200,
                'message' =>  'تم اضافة المنتج لقائمة المفضلات'
            ], 200);
        }
    }

    public function getRemoveWish(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'product_id' => 'required',
          'api_token' => 'required'
        ]);
        if ($validator->fails()) {
               return response()->json([
                'code' => 400,
                'message' => $validator->errors(),
            ], 400);
           }
        $user = User::where('api_token', $request->api_token)->first();
        // $product = Product::find
        $wish = Wish::where('user_id', $user->id)->where('product_id', $request->product_id)->first();

        if (!$wish) {
            return response()->json([
                'code' => 400,
                'message' => __('translations.wish_doesnot_exist')
            ], 400);
        }
        $wish->delete();
        return response()->json([
            'code' => 200,
            'message' => __('translations.item_removed_from_wishlist_successfully')
        ], 200);
    }

    public function getRemoveReview(Request $request)
    {

        $validator = Validator::make($request->all(), [
          'id' => 'required',
          'api_token' => 'required'
        ]);
        if ($validator->fails()) { return response()->json([ 'code' => 400, 'message' => $validator->errors()], 400);}

        $user = User::where('api_token', $request->api_token)->first();
        if (!$user) { return response()->json([ 'message' => 'api token غير صالح', 'code' => 404] , 404);}

        $review = Review::find($request->id);
        if (!$review) {
            return response()->json(['code' => 404, 'message' => 'رقم الكود غير موجود'] , 404);
        }
        if ($review->user_id == $user->id) {
            $review->delete();
            return response()->json(['message' => 'تم حذف التقييم' , 'code' => 200] , 200);
        } else {
            return response()->json(['message' => 'لا يمكن لهذا المستخدم حذف التقييم' , 'code' => 403] , 403);
        }
    }

    public function addReview(Request $request)
    {

        $messages = [
          'review.required' => __('validation.custom.review.required'),
          'product_id.required' => __('validation.custom.review.product'),
          'review.max' => __('validation.custom.review.max'),
        ];
        $validator = Validator::make($request->all(), [
          'review' => 'required|max:255',
          'product_id' => 'required' ,
          'api_token' => 'required'
        ], $messages);

        if (count($validator->errors()) > 0) {
          return response()->json([
            'errors' => $validator->errors(),
            'code' => 400,
          ] , 400);
        }
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user) { return response()->json([ 'message' => 'api token غير صالح', 'code' => 404] , 404);}

        $review = Review::create([
            'user_id' => $user->id,
            'product_id' => $request->product_id,
            'body' => $request->review,
            'user_name' => $user->name,
        ]);

        return response()->json(['message' => 'تم اضافة التقييم' , 'review' => $review ,'code' => 201] , 201);
    }

    public function allVendors()
    {
        $vendors = Vendor::all();
        return response()->json($vendors);
    }
    public function getVendor(Request $request)
    {
        $vendor = Vendor::find($request->id);
        $products = $vendor->products()->select('id', 'name', 'arabic_name', 'main_image', 'category_id', 'subcategory_id', 'price')->get();
        $products_array = [];
        foreach ($products as $product) {
          $product->main_image = asset($product->main_image_path());
        }
        return response()->json(['vendor' => $vendor, 'products' => $products]);
    }

    public function allSuppliers()
    {
        $suppliers = User::where('role', 'supplier')->get();
        return response()->json($suppliers);
    }

    public function getSupplier(Request $request)
    {
        $supplier = User::find($request->id);
        if (!User::where('id', $request->id)->exists()) {
            return response()->json(['code' => '400', 'message' => __('translations.supplier_doesnot_exist')]);
        }
        $subcategories = $supplier->supply()->get();
        return response()->json(['supplier' => $supplier, 'subcategories' => $subcategories]);
    }

    public function postForgot(Request $request)
    {
        $messages = [
        'email.required' => __('validation.custom.email.required'),
        'email.email' => __('validation.custom.email.email'),
      ];
        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
      ], $messages);
        if ($validator->fails()) {
            return response()->json(['code' => 200, 'message' => $validator->errors()]);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {

            if ( $user->suspend != null ) {
              return response()->json(['code' => 404, 'message' => __('auth.suspended')]);
            }
            $contactEmail = $request['email'];
            $subject = 'Reset password';
            $code = str_random(6);
            Mail::send('shop.resetCode', ['code' => $code], function ($message) use ($contactEmail, $subject) {
                $message->from('project@gmail.com', 'project');
                $message->to($contactEmail);
                $message->subject($subject);
            });

            $now = Carbon::now();
            $reset = passwordReset::create([
                'user_id' => $user->id,
                'code' => $code,
                'expiry_time' => $now->addHours(1),
            ]);
            return response()->json(['message' => 'تحقق من بريدك الإلكتروني للحصول على رمزك', 'code' => 200, 'api_token' => $user->api_token]);
        } else {
            return response()->json(['message' => 'لا يحتوي عنوان البريد الإلكتروني أو اسم المستخدم هذا على حساب مستخدم. هل أنت متأكد أنك قمت بالتسجيل', 'code' => 500]);
        }
    }

    public function checkResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'api_token' => 'required' ,
          'code' => 'required'
        ]);
        if ($validator->fails()) {
               return response()->json($validator->errors() ,400);
           }
        $user = User::where('api_token', $request->api_token)->first();
        if (!$user) {
          return response()->json([
            'message' => 'api token غير صالح',
            'code' => 201,
          ] , 201);
        }

        $code = passwordReset::running()->where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (!$code) {
            return response()->json(['code' => '400', 'message' => __('translations.code_not_found')]);
        }
        if ($code->code == $request->code) {
            return response()->json(['message' => 'رمز تغيير كلمة المرور صحيح', 'code' => 200]);
        } else {
            return response()->json(['message' => 'رمز تغيير كلمة المرور غير صحيح', 'code' => 500]);
        }
    }

    public function resetPassword(Request $request)
    {
        $messages = [
        'new.required' => __('validation.custom.password.required'),
        'new_confirmation.required' => __('validation.custom.password.confirm_required'),
        'new_confirmation.same' => __('validation.custom.password.confirmed'),
        'new_confirmation.min' => __('validation.custom.password.new_confirmation'),
        'new.min' => __('validation.custom.password.min'),
        'new.regex' => __('validation.custom.password.regex'),
      ];
        $validator = Validator::make($request->all(), [
          // 'new' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/|different:current',
          'new' => 'required|min:8|regex:/^(?=.*[0-9])(?=.*[a-zA-Z])([!@#$%^&*(),.?":{}<>a-zA-Z0-9]+)$/',
          'new_confirmation' => 'required|min:8|same:new',
          'api_token' => 'required',
        ], $messages);
        if ($validator->fails()) {
            // $messages = $validator->errors();
            return response()->json([
                'errors' => $validator->errors(),
                'code' => 400,
            ] , 400);
        } else {
            $user = User::where('api_token', $request->api_token)->first();
            if (!$user) {
              return response()->json([
                'message' => 'api token غير صالح',
                'code' => 404,
              ] , 404);
            }
            $user->fill([
            'password' => Hash::make($request->new),
        ])->save();

            $orders_num = $user->orders->count();
            $orders = Order::where('user_id', $user->id)->get();
            $checkout_amount = 0;
            if ($orders->count()) {
                foreach ($orders as $order) {
                    $price = $order->getProductPrice($request);
                    $order['product_price_without_currency'] = $price;
                    $checkout_amount += $order->quantity * $price;
                }
            }

            return response()->json(['message' => __('auth.password_changed'), 'code' => 200, 'api_token' => $user->api_token] , 200);
        }
    }

    public function EditQuantity(Request $request)
    {
        if (!$request->has('array')) {
            $array[] = ['quantity' => $request->quantity, 'id' => $request->id];
        } else {
            $array = $request->array;
        }

        foreach ($array as $arr) {
            $order = Order::find($arr['id']);
            if (isset($order)) {
                $product_price = $order->price / $order->quantity;

                $cart = Cart::where('product_id', $order->product->id)->where('quantity', -$order->quantity)->where('reason', 'order')->latest()->first();
                if (!$cart) {
                    $cart = Cart::where('product_id', $order->product->id)->where('quantity', -$order->quantity)->where('reason', 're-order')->latest()->first();
                }
                $cart->update([
                    'quantity' => -$arr['quantity'],
                ]);

                $order->update([
                    'quantity' => $arr['quantity'],
                ]);

                $order->update([
                    'price' => $product_price * $order->quantity,
                ]);

                $product = Product::find($order->product->id);

                $product->quantity = $product->quantity - $arr['quantity'];
                if ($product->quantity == 0) {
                    $product->status = 0;
                }
                $product->save();
            //return response()->json(['message' => 'true']);
            } else {
                return response()->json(['message' => __('translations.false')]);
            }
        }
        return response()->json(['message' => __('translations.true')]);
    }

    public function reOrder(Request $request)
    {
        $product = Product::find($request['product_id']);
        $user = User::where('api_token', $request['api_token'])->first();
        $country_configuration = Configuration::where('name', 'main_country')->first();
        if ($request->has('country_code')) {
            // $request->country_code != 'EG' && $request->country_code != 'SA' ? $country = 'ww' : $country = $request->country_code;
            $country = Country::where('short_name', $request->country_code)->first();
            if ($country) {
                $country = $request->country_code;
            } else {
                $country = $country_configuration->value;
            }
        } else {
            $country = $country_configuration->value;
        }
        if ($product) {
            if ($product->quantity > 0) {
                if ($product->archive == 0) {
                    if ($request->quantity <= $product->quantity) {
                        $orders = $user->orders;
                        $already_found = [];
                        $price_without_currency = filter_var($product->price, FILTER_SANITIZE_NUMBER_INT);
                        if ($orders->count() > 0) {
                            foreach ($orders as $order) {
                                if ($order->product_id == $request->product_id) {
                                    $cart = Cart::where(['product_id' => $request->product_id, 'quantity' => -$order->quantity])->first();
                                    $quantity = $request->quantity + $order->quantity;
                                    $order->quantity = $quantity;
                                    $price = $order->getProductPrice($request);
                                    $order->update([
                                        'price' => $price * $quantity,
                                        'country_code' => $country,
                                    ]);
                                    $order->save();
                                    $cart->quantity = -$order->quantity;
                                    $cart->save();
                                    array_push($already_found, 'found');
                                    $name = $user->name;
                                    $bill_id = $order->bill_id;
                                    $created_at = $order->created_at;
                                    $data = array('email' => $user->email, 'subject' => "Cart reminder");

                                    if ($user->email && $user->email != '') {
                                        Mail::send('shop.orderEmail', ['name' => $name, 'bill_id' => $bill_id, 'created_at' => $created_at], function ($message) use ($data) {
                                            $message->from('me@gmail.com', 'project');
                                            $message->to($data['email']);
                                            $message->subject($data['subject']);
                                        });
                                    }
                                    if ($product->quantity == 0) {
                                        $product->status = 0;
                                    }
                                    $product->save();
                                    //return response()->json(['message' => true, '_message' => 'true']);
                                }
                            }
                        }

                        if ($already_found->count() == 0) {
                            $cart = Cart::create([
                                'product_id' => $product->id,
                                'vendor_id' => $product->vendor_id,
                                'store_id' => $product->store_id,
                                'quantity' => -$request['quantity'],
                                'reason' => 're-order',
                            ]);
                            $product->update([
                                'quantity' => $product->quantity,
                            ]);

                            if ($product->quantity == 0) {
                                $product->status = 0;
                            }

                            $price_without_currency = filter_var($product->price, FILTER_SANITIZE_NUMBER_INT);
                            $user = User::where('api_token', $request['api_token'])->first();

                            $order = Order::create([
                                'user_id' => $user->id,
                                'product_id' => $request['product_id'],
                                'quantity' => $request['quantity'],
                                'bill_id' => str_random(10),
                                'price' => $price_without_currency * $request['quantity'],
                                'country_code' => $country,
                            ]);

                            $price = $order->getProductPrice($request);
                            $order->update([
                                'price' => $price * $request->quantity,
                            ]);
                            $order->save();
                        }
                        if ($product->quantity == 0) {
                            $product->status = 0;
                        }
                        $product->save();
                    //return response()->json(['message' => true, '_message' => 'true']);
                    } else {
                        return response()->json(['message' => __('translations.no_quantity_available'), '_message' => __('translations.false')]);
                    }
                } else {
                    return response()->json(['message' => __('translations.this_product_has_been_archived'), '_message' => __('translations.this_product_has_been_archived')]);
                }
            } else {
                return response()->json(['message' => __('translations.no_quantity_available'), '_message' => __('translations.false')]);
            }
        }

        $orders = Order::where('user_id', $user->id)->get(); //->with(['products']);
        $checkout_amount = 0;
        if ($orders->count()) {
            foreach ($orders as $order) {
                $price = $order->getProductPrice($request);
                $order['product_price_without_currency'] = $price;
                $checkout_amount += $order->quantity * $price;
            }
        }

        $old_purchase = Purchase::where('user_id', $user->id)->first();
        if ($checkout_amount > 0) {
            $checkout_amount = $checkout_amount + 10;
            $purchase = Purchase::create([
                'user_id' => $user->id,
                'delivery_address' => $old_purchase['delivery_address'],
                'billing_address' => $old_purchase['billing_address'],
                'receptor_mobile' => $old_purchase['receptor_mobile'],
                'buyer_mobile' => $old_purchase['buyer_mobile'],
                'receptor_name' => $old_purchase['receptor_name'],
                'price' => $checkout_amount,
                'bill_id' => rand(),
                'purchase_status' => __('translations.pending'),
                'shipment' => 10,
            ]);
        }

        $orders_num = $orders->count();


        $response = ['message' => __('translations.true'), 'total price' => $checkout_amount, 'number of orders' => $orders_num];
        if (isset($purchase)) {
            $response['details'] = $purchase;
        }
        return response()->json($response);
    }

    public function facebook(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'email' => 'required|email',
          'facebook_id' => 'required',
          'name' => 'required',
        ]);

        if ($validator->fails()) {
               return response()->json($validator->errors() ,400);
           }
        if ($request->email != '') {
            $user = User::where('facebook_id', $request->facebook_id)->orWhere('email', $request->email)->first();
        } else {
            $user = User::where('facebook_id', $request->facebook_id)->first();
        }

        if ($user) 
        {
             if ($user->suspend == 1) {
             return response()->json([
                'message' =>  __('translations.suspended_client'), 
                'code' => 202, 
            ], 201);
            }
            return response()->json([
                'code'        => 200, 
                'api_token'   => $user->api_token, 
                'facebook_id' => $request->facebook_id,
                'message'     => 'user successfully logged in'
            ], 200);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'usertype_id' => 1,
            'facebook_id' => $request->facebook_id,
            'role' => 'user',
            'api_token' => str_random(20),
            'points' => 1000,
        ]);

        return response()->json([
            'code'        => 200, 
            'api_token'   => $user->api_token, 
            'facebook_id' => $user->facebook_id,
            'message'     => 'user created successfully'
        ], 200);
    }
   
    public function checkPromoCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
          'code' => 'required',
          'api_token' => 'required',
        ]);

        if ($validator->fails()) {
               return response()->json($validator->errors() ,400);
           }
        $user = User::Where('api_token', $request->api_token)->first();
        if (!$user) {
            return response()->json([
                'code' => 201,
                'message' => __('validation.custom.invalid_user'),
                'total' => null,
            ]);
        }
        $now = Carbon::now()->toDateTimeString();
        $coupon = Coupon::where('code', $request->code)->where('expiry_date', '>', $now)->first();
        if (!$coupon) {
            return response()->json([
                'code' => 201,
                'message' => __('validation.custom.invalid_promo'),
                'total' => null,
            ]);
        }
        if ($user->checkPromoCode($coupon)) {
            $total = $user->getTotalAfterPromo($coupon);
            return response()->json([
                'code' => 200,
                'message' => __('validation.custom.valid_promo'),
                'total' => $total,
            ]);
        }
        return response()->json([
            'code' => 201,
            'message' => __('validation.custom.invalid_promo'),
            'total' => null,
        ]);
    }

    public function getSearchLists(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required',
        ]);
        $category = Category::where('id', $request->category_id)->first();
        $products = Product::where('category_id', $category->id)->doesntHave('auction');
        if (isset($request->subcategory_id) && $request->subcategory_id != 'all') {
            $subcategory = Subcategory::where('name', $request->subcategory_id)->first();
            $products->where('subcategory_id', $subcategory->id);
        }
       
        if ($request->has('country_code')) {
            $products->where('country_code', $request->country_code);
        } else {
            $products = $products;
        }
        $products = $products->where('archive', 0)->get();
        // $accessories_ids = [];
        $shapes_ids = [];
        $subcategories_ids = [];
        foreach ($products as $product) {
            // array_push($accessories_ids, $product->accessory_id);
            array_push($subcategories_ids, $product->subcategory_id);
            array_push($shapes_ids, $product->shape_id);
        }
       
        $subcategories = Subcategory::select('id', 'name')->whereIn('id', $subcategories_ids)->get();
       
        if (isset($request->subcategory_id) && $request->subcategory_id != 'all') {
            if ($request->has('country_code')) {
                $products = Product::where('category_id', $category->id)->doesntHave('auction')->where('country_code', $request->country_code)->where('archive', 0)->get();
            } else {
                $products = Product::where('category_id', $category->id)->doesntHave('auction')->where('archive', 0)->get();
            }
            $subcategories_ids = [];
            foreach ($products as $product) {
                array_push($subcategories_ids, $product->subcategory_id);
            }
            $subcategories = Subcategory::select('id', 'name')->whereIn('id', $subcategories_ids)->get();
        }
        if (isset($request->shape_id) && $request->shape_id != 'all') {
            if ($request->has('country_code')) {
                $products = Product::where('category_id', $category->id)->doesntHave('auction')->where('country_code', $request->country_code)->where('archive', 0)->get();
            } else {
                $products = Product::where('category_id', $category->id)->doesntHave('auction')->where('archive', 0)->get();
            }
            $shapes_ids = [];
            foreach ($products as $product) {
                array_push($shapes_ids, $product->shape_id);
            }
            $shapes = Shape::select('id', 'name')->whereIn('id', $shapes_ids)->get();
        }
        return response()->json([
            // 'accessories' => $accessories,
            'subcategories' => $subcategories,
            // 'shapes' => $shapes,
        ]);
    }

    public function getCountries()
    {
        $countries = Country::get(['long_name AS country', 'short_name AS code']);
        $countries = $countries->toArray();

        return response()->json(['countries' => $countries]);
    }

    public function getWallet(Request $request)
    {
        $this->validate($request, [
            'api_token' => 'required',
        ]);

        $user = User::where([
            'api_token' => $request->api_token,
        ])->first();

        if (!$user) {
            return response()->json([
                'code' => 201,
                'message' => __('validation.custom.invalid_user'),
            ]);
        }

        $wallets = Purchase::where('user_id', $user->id)->where('payment_method_id', '!=', null)->paginate(10);

        foreach ($wallets->items() as $wallet) {
            $points = explode(' ', $wallet->price);
            $wallet['points_gained'] = $points[0];
        }

        return response()->json([
            'code' => 200,
            'wallet' => $wallets,
        ]);
    }

    // generate code or not for homepage in mobile app
    public function generateCode(Request $request)
    {
        if (isset($request->state) && $request->state == 1) {
            $code = bin2hex(random_bytes(3));
            return response()->json(['code' => $code]);
        } else {
            return response()->json(['code' => '']);
        }
    }

    // replace main images by new images in uploaded folder
    public function replaceMainImages()
    {
        $dir = public_path() . '/1500';
        $files = glob($dir . '/*.{jpg}', GLOB_BRACE);
        foreach ($files as $file) {
            $filname = basename($file);
            $file = explode('.', $filname);
            $product = Product::where('unique_id', 'LIKE', '%' . $file[0])->first();
            if (!$product) {
                return response()->json(['message' => 'cant find this product ' . $file[0]]);
            }
            $old_path = $dir;
            $new_path = public_path() . '/shop_images/products';
            $main_image = uniqid() . rand(0, 100) . '.' . $file[1];
            $new_name = $new_path . '/' . $main_image;
            rename($old_path . '/' . $filname, $new_name);
            $product->update([
                'main_image' => $main_image,
            ]);
        }
        return response()->json(['message' => __('translations.images_have_been_replaced')]);
    }

    // replace small images by new images in uploaded folder
    public function replaceSmallImages()
    {
        $dir = public_path() . '/500';
        $files = glob($dir . '/*.{jpg}', GLOB_BRACE);
        foreach ($files as $file) {
            $filname = basename($file);
            $file = explode('.', $filname);
            $product = Product::where('unique_id', 'LIKE', '%' . $file[0])->first();
            if (!$product) {
                return response()->json(['message' => __('translations.cannot_find_this_product') . $file[0]]);
            }
            $old_path = $dir;
            $new_path = public_path() . '/shop_images/products';
            $small_image = uniqid() . rand(0, 100) . '.' . $file[1];
            $new_name = $new_path . '/' . $small_image;
            rename($old_path . '/' . $filname, $new_name);
            $product->update([
                'small_image' => $small_image,
            ]);
        }
        return response()->json(['message' => __('translations.images_have_been_replaced')]);
    }

    public function category_attributes(Request $request)
    {
        if ($request->category_id) {
            $category = Category::find($request->category_id);
            // return $category->attribute_types;
            if ($category) {
                // return $category->attributes->unique();
                $attributes_ids = $category->attributes->unique()->pluck('id');
                $attributes_types_ids = $category->attributes->unique()->pluck('attribute_type_id');

                $final_attributes = AttributeType::whereIn('id', $attributes_types_ids)
                ->select(['id', 'type'])
                ->with(['attributes' => function ($query) use ($attributes_ids) {
                    $query->whereIn('id', $attributes_ids);
                }])->get();
            }
        }
        return response()->json(['attributes' => $final_attributes]);
    }

    public function subcategory_attributes(Request $request)
    {
        if ($request->subcategory_id) {
            $subcategory = Subcategory::find($request->subcategory_id);
            if ($subcategory) {
                $attributes_ids = $subcategory->attribute->unique()->pluck('id');
                $attributes_types_ids = $subcategory->attribute->unique()->pluck('attribute_type_id');

                $final_attributes = AttributeType::whereIn('id', $attributes_types_ids)
                ->select(['id', 'type'])
                ->with(['attributes' => function ($query) use ($attributes_ids) {
                    $query->whereIn('id', $attributes_ids);
                }])->get();
                return response()->json(['attributes' => $final_attributes,'subcategory' => $subcategory->name]);
            }
        }
        return response()->json(['attributes' => []]);
    }

    public function filtered_products(Request $request)
    {
      $products = Product::where('archive', 0)->doesntHave('auction');
      $attributes = $request['attributes'];
      if(!is_array($attributes)){
        $attributes = json_decode($attributes);
      }
      if(is_array($attributes) && count($attributes) > 0 ) 
      {
          foreach ($attributes as $key => $value) {
            // return $value;
            $products->whereHas('attribute', function (Builder $query) use ($value) {
                $query->where('attributes.id', $value);
            });
          }
      }
      if ($request->category_id) {
          $products->whereHas('category', function (Builder $query) use ($request) {
              $query->where('categories.id', $request->category_id);
          });
      }
      if ($request->subcategory_id) {
          $products->whereHas('subcategory', function (Builder $query) use ($request) {
              $query->where('subcategories.id', $request->subcategory_id);
          });
      }
      if ($request->country_code) {
          $products->where('country_code', $request->country_code);
      }
      if ($request->has('lower_price')) {
          $products->where('price', '>=', $request->lower_price);
      }
      if ($request->has('upper_price')) {
          $products->where('price', '<=', $request->upper_price);
      }
      $products = $products->select('id', 'name', 'arabic_name', 'price', 'main_image', 'subcategory_id','category_id')->get();
      foreach ($products as $product) {
          $product->main_image = asset($product->image_path());
      }
      return response()->json(['products' => $products]);
    }

    public function attribute_types()
    {
        $attribute_types = AttributeType::select('type')->get();
        return response()->json($attribute_types);
    }

    public function all_catecories_subcategories(Request $request)
    {
        $categories = CategoryOnline::whereHas('products', function ($query) 
        {
          $query->where('available_online', 1);
        })->get(['id','name', 'description']);
       
        if ($categories->count() == 0) {
          return response()->json([
            'categories' => $categories, 
            'code' => 200, 
           ], 201);
        }

        return response()->json([
            'categories' => $categories,
            'code' => 200,
        ], 200);
    }
    public function all_catecories_subcategories2(Request $request)
    {
        if($request->has('category_id')){
          $category_id   = $request->category_id;
          $subcategories = Subcategory::whereHas('category', function (Builder $query) use ($category_id) {
              $query->where('categories.id', $category_id);
          })->get(['id','name']);

          return $subcategories;
        }
        $categories = Category::get(['id','name']);
        foreach ($categories as $category) {

          $subcategories = Subcategory::whereHas('category', function (Builder $query) use ($category) {
              $query->where('categories.id', $category->id);
          })->get(['id','name']);

              $category->subcategories = $subcategories;
        }
        return $categories;
    }

    public function best_products()
    {
        $ids = Category::whereHas('products')->get();
        if (count($ids)) {
            $category_id = $ids->random()['id'];
            $best_seller = Product::whereHas('category', function (Builder $query) use ($category_id) {
                $query->where('categories.id', $category_id);
            })->orderBy('num_of_orders', 'desc')->where('archive', 0)->doesntHave('auction');

            $best_seller = $best_seller->select('id', 'name', 'arabic_name', 'price', 'main_image', 'subcategory_id')->take(10)->get();
            foreach ($best_seller as $best_seller_) {
                $best_seller_->main_image = asset($best_seller_->image_path());
            }

            $category = $ids->where('id', $category_id)->first();
            $category_name = $category['name'];
            $category_icon = $category['icon'];

            $response_json = [$best_seller , 'category_name' => $category_name , 'category_icon' => $category_icon];
        } else {
            $response_json['category_name'] = false;
            $response_json['category_icon'] = false;
        }
        return response()->json($response_json);
    }
 
    public function payment_methods()
    {
      $payment_methods = PaymentMethod::all('id','name');
      if($payment_methods)
      {
        return response()->json($payment_methods);
      } else{
        return response()->json(['message' => __('translations.no_payment_methods_found')]);
      }

    }

    /*==================================
       Display all shipments in api
    ====================================*/
    public function shipments()
    {
      $shipments = Shipment::select('id' , 'area' , 'price')->get();
      if ($shipments->count() > 0) {
        return response()->json([
          'shipments' => $shipments ,
          'code' => 200
          ] , 200);
      }else {
        return response()->json([
          'message' => 'no shipment found!',
          'code' => 400 ,
          ] , 400);
      }
    }

    public function latest_products()
    {
      $latest_products = Product::where('archive', 0)
                                ->where('available_online', 1)
                                ->orderBy('created_at', 'desc')
                                // ->select('id', 'name', 'unique_id')
                                ->select('id', 'name', 'slug', 'product_benefits')
                                ->take(4)
                                ->get();

      foreach ($latest_products as $product) {
        $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
        $product['product_main_image'] = $product->product_main_image();
        $product['price'] = $product->productPrices();
        $product['productPrice_after_discount'] = $product->getProductPrice();
      }

      return response()->json([
          'latest_products' => $latest_products,
          'code' => 200,
          ] , 200);

    }

    public function hot_discount_offers()
    {
      $products_have_discount = OnlineDiscount::inRandomOrder()->take(4)->pluck('product_id');
// return $products_have_discount;
      $offered_products = Product::whereIn('id', $products_have_discount)
                                ->where('archive', 0)
                                ->where('available_online', 1)
                                ->orderBy('created_at', 'desc')
                               // ->select('id', 'name', 'unique_id')
                                 ->select('id', 'name', 'slug', 'product_benefits')
                                ->get();
// return $latest_products;
      foreach ($offered_products as $product) {
        $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
        $product['product_main_image'] = $product->product_main_image();
        $product['price'] = $product->productPrices();
        $product['productPrice_after_discount'] = $product->getProductPrice();
      }

      return response()->json([
          'offered_products' => $offered_products,
          'code' => 200,
          ] , 200);

    }

    public function cheapest_products()
    {
      $cheapest_prices = Usertypeprice::where('usertype_id' , 1)
                                        ->orderBy('price', 'asc')
                                        ->get();

      $least = array();
      $count = 0;
      foreach ($cheapest_prices as $cheapest) {
        if ($count < 4) {

          $thisProd = Product::where(['archive' => 0, 'id' => $cheapest->product_id])->first();
       //   return $thisProd;
          if ($thisProd)
          {
              if ($thisProd->available_online == 1) {
                array_push($least, $cheapest->product_id);
                $count++;
              }
              else
              {
                continue;
              }
          }
         }
      }
     // return $least;
      $one = array();

      foreach ($least as $latest) {
           $ggg = Product::where(['archive' => 0, 'id' => $latest])->first();
           array_push($one , [
              'id'                           => $ggg->id,
              'name'                         => $ggg->name,
             // 'unique_id'                    => $ggg->unique_id,
              'slug'                         => $ggg->slug,
              'product_benefits' => htmlspecialchars(strip_tags(stripslashes($ggg->product_benefits))),
              'product_main_image'           => $ggg->product_main_image(),
              'price'                        => $ggg->productPrices(),
              'productPrice_after_discount'  => $ggg->getProductPrice(),
           ]);
      }

      return response()->json([
          'cheapest_products' => $one,
          'code' => 200,
          ] , 200);
    }

    public function best_seller_products()
    {
       $best_sold = History::where('order_status', 'delivered')->groupBy('product_id')
                                     ->orderBy('count', 'desc')
                                     ->take(4)
                                     ->get(['product_id', DB::raw('sum(quantity) as count')]);

        $best_sold_ids = $best_sold->pluck('product_id');
        $best_seller_products = Product::whereIn('id', $best_sold_ids)
                                ->where('archive', 0)
                                ->where('available_online', 1)
                                ->select('id', 'name', 'slug', 'product_benefits')
                                ->take(4)
                                ->get();

      foreach ($best_seller_products as $product)
      {
        $product->product_benefits = htmlspecialchars(strip_tags(stripslashes($product->product_benefits)));
        $product['product_main_image'] = $product->product_main_image();
        $product['price'] = $product->productPrices();
        $product['productPrice_after_discount'] = $product->getProductPrice();
      }

      return response()->json([
          'best_seller_products' => $best_seller_products,
          'code' => 200,
          ] , 200);
    }

    public function get_banners(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'bannering_type_id' => 'required|exists:bannering_types,id',
        ]);

       if ($validator->fails())
       {
               return response()->json([
                'code' => 400,
                'message' => $validator->errors()
            ], 400);
        }
       $bannering_type_id = $request->bannering_type_id;
       $banners = Bannering::where('bannering_type_id', $bannering_type_id)
                              ->select('title', 'image', 'full_image', 'banner_link')
                              ->get();
// return $banners;
        foreach ($banners as $banner) {
            $banner->makeHidden('image');
            $banner['full_image'] = asset($banner->full_image_path());
        }

      return response()->json([
          'banners' => $banners,
          'code' => 200,
          ] , 200);
    }

     

    public function get_stores_adress()
    {
       $stores = Store::select('name', 'address', 'phone')->get();
      
       return response()->json([
          'stores' => $stores,
          'code' => 200,
          ] , 200);
    }
}
